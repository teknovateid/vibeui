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

        app('blade.compiler')->prepareStringsForCompilationUsing(function ($string) {
            $string = preg_replace('/<vibe:([a-zA-Z0-9\-\.]+)/', '<x-vibe::$1', $string);
            $string = preg_replace('/<\/vibe:([a-zA-Z0-9\-\.]+)/', '</x-vibe::$1', $string);
            return $string;
        });

        $this->commands([
            LayoutCommand::class,
            ComponentCommand::class,
            VibeCommand::class,
            CleanCommand::class,
            PageCommand::class,
            InstallCommand::class,
        ]);
    }
}
