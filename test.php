<?php

namespace Teknovate\VibeUi;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Teknovate\VibeUi\Commands\LayoutCommand;
use Teknovate\VibeUi\Commands\ComponentCommand;
use Teknovate\VibeUi\Commands\VibeCommand;
use Teknovate\VibeUi\Commands\CleanCommand;
use Teknovate\VibeUi\Commands\PageCommand;
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
            __DIR__.'/../public' => public_path('vendor/vibe'),
        ], 'vibe-assets');

        Blade::anonymousComponentPath(resource_path('views/vibe'), 'vibe');

        app('blade.compiler')->prepareStringsForCompilationUsing([$this, 'parseVibeTags']);

        $this->commands([
            LayoutCommand::class,
            ComponentCommand::class,
            VibeCommand::class,
            CleanCommand::class,
            PageCommand::class,
            InstallCommand::class,
        ]);
    }

    /**
     * Parse <vibe: tags into standard <x-vibe:: tags.
     * Also fixes syntax conflicts caused by third-party compilers (like Blaze).
     */
    public function parseVibeTags(string $string): string
    {
        // 1. Convert <vibe: tags to standard Laravel <x-vibe:: tags
        $string = preg_replace('/<vibe:([a-zA-Z0-9\-\.]+)/', '<x-vibe::$1', $string);
        $string = preg_replace('/<\/vibe:([a-zA-Z0-9\-\.]+)/', '</x-vibe::$1', $string);

        // 2. Fix Blaze Compiler Conflict
        // If the Blaze compiler has already processed the file (e.g. via @blaze(fold: true)),
        // it will have converted {{ $var }} inside attributes into <?php echo e($var); ?' . '>.
        // Laravel's ComponentTagCompiler uses a strict regex that fails when it sees the '>' 
        // inside the PHP block. To fix this, we revert the echoes back to Blade syntax 
        // just for the compilation phase. Laravel will naturally re-compile them at the end.
        if (str_contains($string, '<x-vibe::')) {
            $string = preg_replace('/<\?php\s*echo\s*e\((.*?)\);\s*\?' . '>/s', '{{ $1 }}', $string);
            $string = preg_replace('/<\?php\s*echo\s*(.*?);\s*\?' . '>/s', '{!! $1 !!}', $string);
        }

        return $string;
    }
}
