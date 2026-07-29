<?php

namespace Teknovate\VibeUi\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CleanCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vibe:clean {--force : Force delete without confirmation}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove published Vibe UI components that are not used in your project';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $publishedDir = resource_path('views/vibe');
        if (!File::isDirectory($publishedDir)) {
            $this->components->info('No published components found.');
            return;
        }

        $publishedComponents = array_map('basename', File::directories($publishedDir));
        if (empty($publishedComponents)) {
            $this->components->info('No published components found.');
            return;
        }

        // Scan all blade files in resources/views (including other vibe components)
        $viewsDir = resource_path('views');
        $allFiles = File::allFiles($viewsDir);
        
        $bladeFiles = array_filter($allFiles, function ($file) {
            return str_ends_with($file->getFilename(), '.blade.php');
        });

        $usedComponents = [];
        foreach ($bladeFiles as $file) {
            $content = file_get_contents($file->getPathname());
            foreach ($publishedComponents as $component) {
                // Check if component tag is used
                // e.g., <vibe:button or <x-vibe::button or <vibe:button>
                if (
                    str_contains($content, "<vibe:{$component}") || 
                    str_contains($content, "<x-vibe::{$component}") ||
                    str_contains($content, "</vibe:{$component}>") ||
                    str_contains($content, "</x-vibe::{$component}>")
                ) {
                    $usedComponents[] = $component;
                }
            }
        }

        $usedComponents = array_unique($usedComponents);
        $unusedComponents = array_diff($publishedComponents, $usedComponents);

        if (empty($unusedComponents)) {
            $this->components->info('All published components are currently being used. Nothing to clean.');
            return;
        }

        $this->components->warn('The following components appear to be UNUSED in your views:');
        $this->components->bulletList($unusedComponents);

        if ($this->option('force') || $this->confirm('Do you want to delete these unused components?')) {
            foreach ($unusedComponents as $component) {
                File::deleteDirectory(resource_path("views/vibe/{$component}"));
                
                // delete JS if exists
                if (File::exists(resource_path("js/vibe/plugins/alpine/{$component}.js"))) {
                    File::delete(resource_path("js/vibe/plugins/alpine/{$component}.js"));
                }
                if (File::exists(resource_path("js/vibe/plugins/vanilla/{$component}.js"))) {
                    File::delete(resource_path("js/vibe/plugins/vanilla/{$component}.js"));
                }
            }
            $this->components->success('Unused components have been successfully removed.');
        } else {
            $this->components->info('Cleanup cancelled.');
        }
    }
}
