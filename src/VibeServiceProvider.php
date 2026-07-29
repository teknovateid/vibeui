<?php

namespace Teknovate\VibeUi;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Teknovate\VibeUi\Commands\LayoutCommand;
use Teknovate\VibeUi\Commands\ComponentCommand;
use Teknovate\VibeUi\Commands\VibeCommand;
use Teknovate\VibeUi\Commands\CleanCommand;
use Teknovate\VibeUi\Commands\PageCommand;

class VibeServiceProvider extends ServiceProvider
{

    public function register(): void {}

    public function boot(): void
    {
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
        ]);
    }
}
