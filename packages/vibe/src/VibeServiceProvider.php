<?php

namespace Teknovate\VibeUi;

require_once __DIR__.'/helpers.php';

use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\ComponentAttributeBag;
use Livewire\Blaze\BlazeManager;
use Rappasoft\LaravelLivewireTables\Mechanisms\RappasoftFrontendAssets;
use TailwindMerge\Contracts\TailwindMergeContract;
use TailwindMerge\TailwindMerge;
use Teknovate\VibeUi\Commands\CleanCommand;
use Teknovate\VibeUi\Commands\ComponentCommand;
use Teknovate\VibeUi\Commands\CrudCommand;
use Teknovate\VibeUi\Commands\InstallCommand;
use Teknovate\VibeUi\Commands\LayoutCommand;
use Teknovate\VibeUi\Commands\PageCommand;
use Teknovate\VibeUi\Commands\ReleaseCommand;
use Teknovate\VibeUi\Commands\SyncCommand;
use Teknovate\VibeUi\Commands\TableMakeCommand;
use Teknovate\VibeUi\Commands\VibeCommand;

class VibeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/vibe.php', 'vibe'
        );

        // Register TailwindMerge bindings
        if (! $this->app->bound(TailwindMergeContract::class)) {
            $this->app->singleton(TailwindMergeContract::class, static function ($app): TailwindMerge {
                $factory = TailwindMerge::factory()
                    ->withConfiguration(config('tailwind-merge', []));

                try {
                    if ($app->bound('cache')) {
                        $factory->withCache($app->make('cache')->store());
                    }
                } catch (\Throwable $e) {
                    // Ignore cache store failure (e.g. during early bootstrap or testing)
                }

                return $factory->make();
            });

            $this->app->alias(TailwindMergeContract::class, 'tailwind-merge');
            $this->app->alias(TailwindMergeContract::class, TailwindMerge::class);
        }
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/vibe.php' => config_path('vibe.php'),
            ], 'vibe-config');

            $this->publishes([
                __DIR__.'/../resources/css/vibe' => resource_path('css/vibe'),
                __DIR__.'/../resources/js/vibe' => resource_path('js/vibe'),
                __DIR__.'/../public' => public_path(),
            ], 'vibe-assets');

            $this->publishes([
                __DIR__.'/../lang' => $this->app->langPath(),
            ], 'vibe-lang');
        }

        // Load translations from package lang folder
        $this->loadTranslationsFrom(__DIR__.'/../lang', 'vibe');

        // Automatically exclude theme cookie from Laravel cookie encryption so no manual app.php configuration is needed
        $prefix = config('vibe.prefix', 'vibe');
        if (class_exists(EncryptCookies::class)) {
            EncryptCookies::except([
                $prefix.'_theme',
            ]);
        }

        // Register anonymous component path for the 'vibe' namespace.
        // Allows calling <x-vibe::button>, <x-vibe::card>, etc.
        Blade::anonymousComponentPath(resource_path('views/vibe'), 'vibe');

        // Override livewire-tables views with Vibe UI custom theme views
        $vibeDatatableViews = resource_path('views/vibe/datatable');
        if (is_dir($vibeDatatableViews)) {
            View::prependNamespace('livewire-tables', $vibeDatatableViews);
        }
        $packageDatatableViews = __DIR__.'/../resources/views/vibe/datatable';
        if (is_dir($packageDatatableViews)) {
            View::prependNamespace('livewire-tables', $packageDatatableViews);
        }

        // Configure Rappasoft Livewire Tables script attributes for Livewire SPA wire:navigate
        if (class_exists(RappasoftFrontendAssets::class)) {
            app(RappasoftFrontendAssets::class)->useRappasoftTableScriptTagAttributes([
                'data-navigate-once' => 'true',
                'onload' => 'window.VibeInitDataTable ? window.VibeInitDataTable() : null',
            ]);
        }

        // Register custom @alert directive
        Blade::directive('vibeAlert', function ($expression) {
            return "<?php
                \$args = [{$expression}];
                \$eventName = count(\$args) > 1 ? \$args[0] : 'alert';
                \$payload = count(\$args) > 1 ? \$args[1] : \$args[0];
                echo '<script>
                    (function() {
                        var fired = false;
                        var trigger = function() {
                            if (fired) return;
                            fired = true;
                            window.dispatchEvent(new CustomEvent(\'' . \$eventName . '\', { detail: ' . json_encode(\$payload) . ' }));
                        };
                        if (document.readyState === \"loading\") {
                            document.addEventListener(\"alpine:initialized\", function() {
                                setTimeout(trigger, 10);
                            });
                            window.addEventListener(\"DOMContentLoaded\", function() {
                                setTimeout(trigger, 50);
                            });
                        } else {
                            setTimeout(trigger, 50);
                        }
                    })();
                </script>';
            ?>";
        });

        // Register custom @toast directive
        Blade::directive('vibeToast', function ($expression) {
            return "<?php
                \$args = [{$expression}];
                \$eventName = count(\$args) > 1 ? \$args[0] : 'toast';
                \$payload = count(\$args) > 1 ? \$args[1] : \$args[0];
                echo '<script>
                    (function() {
                        var fired = false;
                        var trigger = function() {
                            if (fired) return;
                            fired = true;
                            window.dispatchEvent(new CustomEvent(\'' . \$eventName . '\', { detail: ' . json_encode(\$payload) . ' }));
                        };
                        if (document.readyState === \"loading\") {
                            document.addEventListener(\"alpine:initialized\", function() {
                                setTimeout(trigger, 10);
                            });
                            window.addEventListener(\"DOMContentLoaded\", function() {
                                setTimeout(trigger, 50);
                            });
                        } else {
                            setTimeout(trigger, 50);
                        }
                    })();
                </script>';
            ?>";
        });

        // Register custom @vibeStyles directive for theme init (Anti-FOUC), fonts preloading, and global configuration in <head>
        Blade::directive('vibeStyles', function () {
            return "<?php
                if (class_exists(\Illuminate\Support\Facades\Vite::class)) {
                    try {
                        \$fonts = \Illuminate\Support\Facades\Vite::fonts();
                        echo str_replace('<link ', '<link data-navigate-once ', str_replace('<style', '<style data-navigate-once', \$fonts));
                    } catch (\Throwable \$e) {}
                }
                \$prefix = \Illuminate\Support\Facades\Config::get('vibe.prefix', 'vibe');
                \$historyConfig = json_encode(\Illuminate\Support\Facades\Config::get('vibe.history'));
                
                // Pre-rendered Anti-FOUC Theme Shield style tag
                echo '<style id=\"' . \$prefix . '-theme-override\" data-navigate-once=\"true\"></style>';

                echo '<script>
                    (function() {
                        window.VIBE_PREFIX = \'' . \$prefix . '\';
                        window.VIBE_HISTORY_CONFIG = ' . \$historyConfig . ';
                        if (\'scrollRestoration\' in history) {
                            history.scrollRestoration = \'manual\';
                        }
                        try {
                            var k = window.VIBE_PREFIX + \'-theme\';
                            var s = localStorage.getItem(k);
                            var d = false;
                            var parsed = null;
                            if (s) {
                                if (s === \'dark\') d = true;
                                else if (s === \'system\') d = window.matchMedia(\'(prefers-color-scheme: dark)\').matches;
                                else if (s === \'light\') d = false;
                                else {
                                    parsed = JSON.parse(s);
                                    d = parsed.mode === \'dark\' || (parsed.mode === \'system\' && window.matchMedia(\'(prefers-color-scheme: dark)\').matches);
                                }
                            } else {
                                d = window.matchMedia(\'(prefers-color-scheme: dark)\').matches;
                            }
                            if (d) {
                                document.documentElement.classList.add(\'dark\');
                                try {
                                    document.cookie = window.VIBE_PREFIX + \'_theme=dark; path=/; max-age=31536000; SameSite=Lax\';
                                } catch (e) {}
                            } else {
                                document.documentElement.classList.remove(\'dark\');
                                try {
                                    document.cookie = window.VIBE_PREFIX + \'_theme=light; path=/; max-age=31536000; SameSite=Lax\';
                                } catch (e) {}
                            }

                            // Anti-FOUC Theme CSS Override:
                            if (parsed) {
                                var css = parsed.css;
                                if (!css && (parsed.preset || parsed.customHex)) {
                                    var presets = {
                                        zinc: { light: \'#0a0b0a\', lightFg: \'#f9fafa\', dark: \'#f9fafa\', darkFg: \'#0a0b0a\' },
                                        indigo: { light: \'#4f46e5\', lightFg: \'#ffffff\', dark: \'#818cf8\', darkFg: \'#0a0b0a\' },
                                        violet: { light: \'#7c3aed\', lightFg: \'#ffffff\', dark: \'#a78bfa\', darkFg: \'#0a0b0a\' },
                                        blue: { light: \'#2563eb\', lightFg: \'#ffffff\', dark: \'#38bdf8\', darkFg: \'#0a0b0a\' },
                                        emerald: { light: \'#059669\', lightFg: \'#ffffff\', dark: \'#34d399\', darkFg: \'#0a0b0a\' },
                                        rose: { light: \'#e11d48\', lightFg: \'#ffffff\', dark: \'#fb7185\', darkFg: \'#0a0b0a\' },
                                        amber: { light: \'#d97706\', lightFg: \'#ffffff\', dark: \'#fbbf24\', darkFg: \'#0a0b0a\' },
                                        cyan: { light: \'#0891b2\', lightFg: \'#ffffff\', dark: \'#22d3ee\', darkFg: \'#0a0b0a\' }
                                    };
                                    var col = parsed.customHex ? { light: parsed.customHex, lightFg: \'#ffffff\', dark: parsed.customHex, darkFg: \'#ffffff\' } : (presets[parsed.preset] || presets.zinc);
                                    var rad = parsed.radius || \'0.5rem\';
                                    var font = parsed.fontValue || \"\'Figtree\', ui-sans-serif, system-ui, sans-serif\";
                                    var radRules = rad === \'0rem\' ? 
                                        \'--radius:0rem !important;--radius-xs:0rem !important;--radius-sm:0rem !important;--radius-md:0rem !important;--radius-lg:0rem !important;--radius-xl:0rem !important;--radius-2xl:0rem !important;--radius-3xl:0rem !important;\' :
                                        \'--radius:\'+rad+\' !important;--radius-xs:calc(\'+rad+\'*0.3) !important;--radius-sm:calc(\'+rad+\'*0.5) !important;--radius-md:calc(\'+rad+\'*0.75) !important;--radius-lg:\'+rad+\' !important;--radius-xl:calc(\'+rad+\'*1.25) !important;--radius-2xl:calc(\'+rad+\'*1.5) !important;--radius-3xl:calc(\'+rad+\'*2) !important;\';
                                    css = \':root:root,html:root:root,html.light:root,html:not(#__vibe_shield__):root{--primary:\'+col.light+\' !important;--primary-foreground:\'+col.lightFg+\' !important;--ring:\'+col.light+\' !important;--font-sans:\'+font+\' !important;font-family:\'+font+\' !important;\'+radRules+\'}html.dark:root:root,html.dark:not(#__vibe_shield__):root{--primary:\'+col.dark+\' !important;--primary-foreground:\'+col.darkFg+\' !important;--ring:\'+col.dark+\' !important;--font-sans:\'+font+\' !important;font-family:\'+font+\' !important;\'+radRules+\'}body{font-family:\'+font+\' !important;}\';
                                }
                                if (css) {
                                    var styleEl = document.getElementById(window.VIBE_PREFIX + \'-theme-override\');
                                    if (styleEl) {
                                        styleEl.textContent = css;
                                    }
                                }
                            }

                            // Prevent Alpine / Livewire wire:navigate from stripping the \'dark\' class during HTML attribute replacement
                            var origRemoveAttr = Element.prototype.removeAttribute;
                            Element.prototype.removeAttribute = function(attr) {
                                if (this === document.documentElement && attr === \'class\') {
                                    if (document.documentElement.classList.contains(\'dark\')) {
                                        this.className = \'dark\';
                                        return;
                                    }
                                }
                                return origRemoveAttr.apply(this, arguments);
                            };
                        } catch (e) {}

                        // Scroll Anti-FOUC (Instant Micro-Shielding):
                        try {
                            var p = window.VIBE_PREFIX;
                            var mainKey = p + \'-scroll-\' + window.location.pathname;
                            var sideKey = p + \'-scroll-sidebar-menu-body\';
                            var ms = parseInt(sessionStorage.getItem(mainKey) || \'0\', 10);
                            var ss = parseInt(sessionStorage.getItem(sideKey) || \'0\', 10);

                            if (ms > 0) document.documentElement.classList.add(\'vibe-restoring-main\');
                            if (ss > 0) document.documentElement.classList.add(\'vibe-restoring-side\');

                            var unshieldMain = function() {
                                document.documentElement.classList.remove(\'vibe-restoring-main\');
                            };
                            var unshieldSide = function() {
                                document.documentElement.classList.remove(\'vibe-restoring-side\');
                            };

                            var enforceScroll = function() {
                                if (ms > 0) {
                                    var main = document.getElementById(\'docs-main-scroll\');
                                    if (main) {
                                        main.scrollTop = ms;
                                        if (main.scrollTop >= ms - 15) {
                                            unshieldMain();
                                        }
                                    }
                                }
                                if (ss > 0) {
                                    var side = document.getElementById(\'sidebar-menu-body\');
                                    if (side) {
                                        side.scrollTop = ss;
                                        if (side.scrollTop >= ss - 15) {
                                            unshieldSide();
                                        }
                                    }
                                }
                                var others = document.querySelectorAll(\'[data-vibe-scroll]\');
                                for (var i = 0; i < others.length; i++) {
                                    var id = others[i].getAttribute(\'data-vibe-scroll\');
                                    if (id) {
                                        var val = parseInt(sessionStorage.getItem(p + \'-scroll-\' + id) || \'0\', 10);
                                        if (val > 0 && others[i].scrollTop < val) others[i].scrollTop = val;
                                    }
                                }
                            };

                            if (\'MutationObserver\' in window) {
                                var obs = new MutationObserver(enforceScroll);
                                obs.observe(document.documentElement, { childList: true, subtree: true });
                                
                                var cleanup = function() {
                                    enforceScroll();
                                    obs.disconnect();
                                    unshieldMain();
                                    unshieldSide();

                                    // Remove anti-FOUC transition blocker
                                    var style = document.getElementById(\'vibe-anti-fouc-transitions\');
                                    if (style) style.remove();
                                };

                                document.addEventListener(\'DOMContentLoaded\', cleanup);
                                document.addEventListener(\'livewire:navigated\', cleanup);

                                // Fast safety timeout: never keep shielded for more than 80ms
                                setTimeout(cleanup, 80);
                            }
                        } catch (e) {}
                    })();
                </script>
                <style id=\"vibe-anti-fouc-transitions\">
                    *, *::before, *::after {
                        transition: none !important;
                    }
                </style>';
            ?>";
        });

        // Register the <vibe:> tag parser BEFORE Blaze hooks in.
        // Using direct prepareStringsForCompilationUsing (no booted wrapper)
        // ensures our callback is index-0 in the precompiler queue.
        // When Blaze later registers via booted(), it appends at index-1 and
        // thus runs AFTER our vibe: → x-vibe:: conversion.
        app('blade.compiler')->prepareStringsForCompilationUsing([$this, 'parseVibeTags']);

        // Register 'vibe:' as a native Blaze prefix via Reflection.
        // This makes Blaze's Tokenizer understand <vibe:*> tags the same way
        // it natively understands <flux:*> tags — critical for @blaze(fold: true)
        // to work correctly when vibe components call other vibe components.
        $this->registerVibeAsBlazePrefixAfterBoot();

        // Register TailwindMerge directives and ComponentAttributeBag macros
        $this->registerTailwindMerge();

        if ($this->app->runningInConsole()) {
            $this->commands([
                LayoutCommand::class,
                ComponentCommand::class,
                VibeCommand::class,
                CleanCommand::class,
                PageCommand::class,
                CrudCommand::class,
                InstallCommand::class,
                TableMakeCommand::class,
                SyncCommand::class,
                ReleaseCommand::class,
            ]);
        }
    }

    /**
     * Inject 'vibe:' as a native prefix in Livewire Blaze's Tokenizer.
     *
     * Flux UI works with @blaze(fold: true) because 'flux:' is hardcoded in
     * Blaze's Tokenizer::$prefixes. We mirror that behaviour for 'vibe:' using
     * Reflection so Blaze can parse and fold <vibe:*> components natively,
     * without removing @blaze(fold: true) from any view.
     */
    protected function registerVibeAsBlazePrefixAfterBoot(): void
    {
        $this->app->booted(function () {
            $this->injectVibePrefixIntoBlaze();
        });
    }

    /**
     * Use Reflection to add 'vibe:' to Blaze's Tokenizer $prefixes array.
     */
    protected function injectVibePrefixIntoBlaze(): void
    {
        // Silently skip if Blaze is not installed
        if (! class_exists(BlazeManager::class)) {
            return;
        }

        try {
            /** @var BlazeManager $manager */
            $manager = app(BlazeManager::class);

            // BlazeManager creates the parser as: new Parser(new Tokenizer, ...)
            // We access the parser's tokenizer via Reflection.
            $managerReflection = new \ReflectionClass($manager);

            if (! $managerReflection->hasProperty('parser')) {
                return;
            }

            $parserProp = $managerReflection->getProperty('parser');
            $parserProp->setAccessible(true);
            $parser = $parserProp->getValue($manager);

            if (! $parser) {
                return;
            }

            $parserReflection = new \ReflectionClass($parser);

            if (! $parserReflection->hasProperty('tokenizer')) {
                return;
            }

            $tokenizerProp = $parserReflection->getProperty('tokenizer');
            $tokenizerProp->setAccessible(true);
            $tokenizer = $tokenizerProp->getValue($parser);

            if (! $tokenizer) {
                return;
            }

            // Inject 'vibe:' just like 'flux:' is defined natively in Blaze.
            $tokenizerReflection = new \ReflectionClass($tokenizer);

            if (! $tokenizerReflection->hasProperty('prefixes')) {
                return;
            }

            $prefixesProp = $tokenizerReflection->getProperty('prefixes');
            $prefixesProp->setAccessible(true);
            $prefixes = $prefixesProp->getValue($tokenizer);

            // Only add if not already registered
            if (! isset($prefixes['vibe:'])) {
                $prefixes = array_merge(
                    ['vibe:' => ['namespace' => 'vibe::', 'slot' => 'x-slot']],
                    $prefixes
                );
                $prefixesProp->setValue($tokenizer, $prefixes);
            }

        } catch (\Throwable $e) {
            // Fail silently — the parser fallback via prepareStringsForCompilationUsing
            // already handles tag conversion for non-folded templates.
            report($e);
        }
    }

    /**
     * Parse <vibe:*> tags into standard Laravel <x-vibe::*> tags.
     *
     * This fallback precompiler handles non-@blaze templates (or templates
     * where Blaze is not installed). Blaze-folded templates are handled
     * natively via the injected 'vibe:' prefix in Blaze's Tokenizer.
     *
     * Example conversions:
     *   <vibe:card>    → <x-vibe::card>
     *   </vibe:button> → </x-vibe::button>
     */
    public function parseVibeTags(string $string): string
    {
        // 1. Fast-path: Skip immediately if template does not contain any <vibe: tags
        if (! str_contains($string, '<vibe:')) {
            return $string;
        }

        // 2. Shield <vibe:* and <x-* tags inside <vibe:preview.code>...</vibe:preview.code> blocks
        // so Blade and Blaze do not compile them into rendered components, while allowing
        // dynamic Blade expressions (like {{ __('...') }}) to evaluate for multilingual docs.
        if (str_contains($string, '<vibe:preview.code')) {
            $string = preg_replace_callback('/(<vibe:preview\.code[^>]*>)(.*?)(<\/vibe:preview\.code>)/s', function ($m) {
                $inner = preg_replace('/<(\/?)(vibe:|x-)/', '<$1\\\\$2', $m[2]);

                return $m[1].$inner.$m[3];
            }, $string);
        }

        // 3. Fast-path: If template has no @verbatim, convert directly without array allocation & preg_split
        if (! str_contains($string, '@verbatim')) {
            $string = preg_replace('/<vibe:([a-zA-Z0-9\-\.]+)/', '<x-vibe::$1', $string);

            return preg_replace('/<\/vibe:([a-zA-Z0-9\-\.]+)/', '</x-vibe::$1', $string);
        }

        // 4. Protect @verbatim ... @endverbatim blocks from tag conversion
        $parts = preg_split('/(?<!@)(@verbatim.*?@endverbatim)/s', $string, -1, PREG_SPLIT_DELIM_CAPTURE);

        foreach ($parts as &$part) {
            if (str_starts_with($part, '@verbatim')) {
                continue;
            }

            // Convert opening <vibe:component> tags
            $part = preg_replace('/<vibe:([a-zA-Z0-9\-\.]+)/', '<x-vibe::$1', $part);

            // Convert closing </vibe:component> tags
            $part = preg_replace('/<\/vibe:([a-zA-Z0-9\-\.]+)/', '</x-vibe::$1', $part);
        }

        return implode('', $parts);
    }

    /**
     * Register TailwindMerge Blade directives and ComponentAttributeBag macros.
     */
    protected function registerTailwindMerge(): void
    {
        // 1. Blade directive: @twMerge(...)
        $this->app->afterResolving('blade.compiler', function (BladeCompiler $bladeCompiler): void {
            $name = config('tailwind-merge.blade_directive', 'twMerge');

            if ($name !== null && ! array_key_exists($name, $bladeCompiler->getCustomDirectives())) {
                $bladeCompiler->directive($name, fn (?string $expression): string => "<?php echo twMerge({$expression}); ?>");
            }
        });

        // 2. ComponentAttributeBag macro: twMerge
        if (! ComponentAttributeBag::hasMacro('twMerge')) {
            ComponentAttributeBag::macro('twMerge', function (...$args): ComponentAttributeBag {
                /** @var ComponentAttributeBag $this */
                $this->offsetSet('class', resolve(TailwindMergeContract::class)->merge($args, ($this->get('class', ''))));

                return $this;
            });
        }

        // 3. ComponentAttributeBag macro: twMergeFor
        if (! ComponentAttributeBag::hasMacro('twMergeFor')) {
            ComponentAttributeBag::macro('twMergeFor', function (string $for, ...$args): ComponentAttributeBag {
                /** @var ComponentAttributeBag $this */
                $instance = resolve(TailwindMergeContract::class);
                $attribute = 'class'.($for !== '' ? ':'.$for : '');
                $classes = $this->get($attribute, '');
                $this->offsetSet('class', $instance->merge($args, $classes));

                return $this->only('class');
            });
        }

        // 4. ComponentAttributeBag macro: withoutTwMergeClasses
        if (! ComponentAttributeBag::hasMacro('withoutTwMergeClasses')) {
            ComponentAttributeBag::macro('withoutTwMergeClasses', function (): ComponentAttributeBag {
                /** @var ComponentAttributeBag $this */
                return $this->whereDoesntStartWith('class:');
            });
        }
    }
}
