<?php

namespace Teknovate\VibeUi;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Teknovate\VibeUi\Commands\LayoutCommand;
use Teknovate\VibeUi\Commands\ComponentCommand;
use Teknovate\VibeUi\Commands\VibeCommand;
use Teknovate\VibeUi\Commands\CleanCommand;
use Teknovate\VibeUi\Commands\PageCommand;
use Teknovate\VibeUi\Commands\CrudCommand;
use Teknovate\VibeUi\Commands\InstallCommand;

class VibeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/vibe.php', 'vibe'
        );
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/vibe.php' => config_path('vibe.php'),
        ], 'vibe-config');

        $this->publishes([
            __DIR__.'/../resources/css/vibe' => resource_path('css/vibe'),
            __DIR__.'/../resources/js/vibe' => resource_path('js/vibe'),
            __DIR__.'/../public' => public_path(),
        ], 'vibe-assets');

        // Register anonymous component path for the 'vibe' namespace.
        // Allows calling <x-vibe::button>, <x-vibe::card>, etc.
        Blade::anonymousComponentPath(resource_path('views/vibe'), 'vibe');

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
                                setTimeout(trigger, 150);
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
                                setTimeout(trigger, 150);
                            });
                        } else {
                            setTimeout(trigger, 50);
                        }
                    })();
                </script>';
            ?>";
        });

        // Register custom @vibeStyles directive for theme init (Anti-FOUC) and global configuration in <head>
        Blade::directive('vibeStyles', function () {
            return "<?php
                \$prefix = config('vibe.prefix', 'vibe');
                \$historyConfig = json_encode(config('vibe.history'));
                echo '<script>
                    (function() {
                        window.VIBE_PREFIX = \'' . \$prefix . '\';
                        window.VIBE_HISTORY_CONFIG = ' . \$historyConfig . ';
                        try {
                            var k = window.VIBE_PREFIX + \'-theme\';
                            var s = localStorage.getItem(k);
                            var d = false;
                            if (s) {
                                if (s === \'dark\') d = true;
                                else if (s === \'system\') d = window.matchMedia(\'(prefers-color-scheme: dark)\').matches;
                                else {
                                    var c = JSON.parse(s);
                                    d = c.mode === \'dark\' || (c.mode === \'system\' && window.matchMedia(\'(prefers-color-scheme: dark)\').matches);
                                }
                            } else {
                                d = window.matchMedia(\'(prefers-color-scheme: dark)\').matches;
                            }
                            if (d) {
                                document.documentElement.classList.add(\'dark\');
                            } else {
                                document.documentElement.classList.remove(\'dark\');
                            }
                        } catch (e) {}

                        // Scroll Anti-FOUC without blinking/hiding elements:
                        // Continuously enforce scroll positions during HTML parsing so the very first paint is correct.
                        try {
                            var p = window.VIBE_PREFIX;
                            var getSaved = function(id) {
                                var k = (id === \'docs-main-scroll\') ? p + \'-scroll-\' + window.location.pathname : p + \'-scroll-\' + id;
                                return parseInt(sessionStorage.getItem(k) || \'0\', 10);
                            };
                            
                            var enforceScroll = function() {
                                var main = document.getElementById(\'docs-main-scroll\');
                                if (main) {
                                    var ms = getSaved(\'docs-main-scroll\');
                                    if (ms > 0) main.scrollTop = ms;
                                }
                                var side = document.getElementById(\'sidebar-menu-body\');
                                if (side) {
                                    var ss = getSaved(\'sidebar-menu-body\');
                                    if (ss > 0) side.scrollTop = ss;
                                }
                                // Handle any other dynamically added scroll containers
                                var others = document.querySelectorAll(\'[data-vibe-scroll]\');
                                for (var i = 0; i < others.length; i++) {
                                    var id = others[i].getAttribute(\'data-vibe-scroll\');
                                    if (id) {
                                        var val = getSaved(id);
                                        if (val > 0) others[i].scrollTop = val;
                                    }
                                }
                            };

                            if (\'MutationObserver\' in window) {
                                var obs = new MutationObserver(enforceScroll);
                                obs.observe(document.documentElement, { childList: true, subtree: true });
                                
                                // Disconnect observer once DOM is fully built to save performance
                                document.addEventListener(\'DOMContentLoaded\', function() {
                                    enforceScroll();
                                    obs.disconnect();
                                    
                                    // Remove anti-FOUC transition blocker
                                    setTimeout(function() {
                                        var style = document.getElementById(\'vibe-anti-fouc-transitions\');
                                        if (style) style.remove();
                                    }, 50);
                                });
                            }
                        } catch (e) {}
                    })();
                </script>
                <style id=\"vibe-anti-fouc-transitions\">
                    *, *::before, *::after {
                        transition: none !important;
                        animation-duration: 0ms !important;
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

        $this->commands([
            LayoutCommand::class,
            ComponentCommand::class,
            VibeCommand::class,
            CleanCommand::class,
            PageCommand::class,
            CrudCommand::class,
            InstallCommand::class,
        ]);
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
        if (! class_exists(\Livewire\Blaze\BlazeManager::class)) {
            return;
        }

        try {
            /** @var \Livewire\Blaze\BlazeManager $manager */
            $manager = app(\Livewire\Blaze\BlazeManager::class);

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
        // Convert opening <vibe:component> tags
        $string = preg_replace('/<vibe:([a-zA-Z0-9\-\.]+)/', '<x-vibe::$1', $string);

        // Convert closing </vibe:component> tags
        $string = preg_replace('/<\/vibe:([a-zA-Z0-9\-\.]+)/', '</x-vibe::$1', $string);

        return $string;
    }
}
