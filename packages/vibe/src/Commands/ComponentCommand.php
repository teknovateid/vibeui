<?php

namespace Teknovate\VibeUi\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Support\Facades\File;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use function Laravel\Prompts\search;

class ComponentCommand extends Command implements PromptsForMissingInput
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vibe:component
        {name : The name of the component.}
        {--silent : Silent mode.}';



    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish Vibe UI components';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $name = str()->slug($this->argument('name'));
        $silent = $this->option('silent');

        if ($name == 'all') {
            if (!$this->confirm('Are you sure you want to publish all components?')) return;
            foreach ($this->getAvailableComponents() as $component) {
                $this->call('vibe:component', ['name' => $component, '--silent' => true]);
            }
            $this->components->success("All components published.");
            $this->components->bulletList($this->getAvailableComponents());
            $this->newLine();
            return;
        }

        if (! in_array(strtolower($name), array_map('strtolower', $this->getAvailableComponents()))) {
            $this->components->error("Component '{$name}' not found.");
            $this->components->bulletList($this->getAvailableComponents());
            $this->newLine();
            return;
        }

        $component = $this->publishComponent($name);
        $alpine = $this->publishAlpine($name);
        $vanilla = $this->publishVanilla($name);

        if (!$silent) {
            $this->components->success("Component '{$name}' published.");
            $include = [];
            if ($component) {
                $include[] = "resources/views/vibe/{$name}";
            }
            if ($alpine) {
                $include[] = "resources/js/plugins/alpine/{$name}.js";
            }
            if ($vanilla) {
                $include[] = "resources/js/plugins/vanilla/{$name}.js";
            }
            $this->components->bulletList($include);
            $this->newLine();
        }
    }

    protected function publishComponent($name)
    {
        $dirComponents = __DIR__ . '/../../resources/views/vibe/' . $name;
        if (File::isDirectory($dirComponents)) {
            if (!File::isDirectory(resource_path('views/vibe'))) {
                File::makeDirectory(resource_path('views/vibe'), 0777, true);
            }
            File::copyDirectory($dirComponents, resource_path('views/vibe/' . $name));
            return true;
        } else {
            return false;
        }
    }

    protected function publishAlpine($name)
    {
        $fileAlpine = __DIR__ . '/../../resources/js/plugins/alpine/' . $name . '.js';
        if (File::isFile($fileAlpine)) {
            if (!File::isDirectory(resource_path('js/vibe/plugins/alpine'))) {
                File::makeDirectory(resource_path('js/vibe/plugins/alpine'), 0777, true);
            }
            File::copy($fileAlpine, resource_path('js/vibe/plugins/alpine/' . $name . '.js'));
            return true;
        } else {
            return false;
        }
    }
    protected function publishVanilla($name)
    {
        $fileVanilla = __DIR__ . '/../../resources/js/plugins/vanilla/' . $name . '.js';
        if (File::isFile($fileVanilla)) {
            if (!File::isDirectory(resource_path('js/vibe/plugins/vanilla'))) {
                File::makeDirectory(resource_path('js/vibe/plugins/vanilla'), 0777, true);
            }
            File::copy($fileVanilla, resource_path('js/vibe/plugins/vanilla/' . $name . '.js'));
            return true;
        } else {
            return false;
        }
    }

    protected function getAvailableComponents(): array
    {
        $dir = __DIR__ . '/../../resources/views/vibe/';
        if (!File::isDirectory($dir)) {
            return [];
        }

        $components = [];
        $directories = File::directories($dir);
        foreach ($directories as $directory) {
            $components[] = basename($directory);
        }

        return $components;
    }

    protected function promptForMissingArguments(InputInterface $input, OutputInterface $output): void
    {
        if ($this->didReceiveOptions($input)) {
            return;
        }

        if (! $input->getArgument('name')) {
            $components = array_merge(['all'], $this->getAvailableComponents());
            
            $name = search(
                label: 'What is the name of the component you want to publish?',
                options: fn (string $value) => strlen($value) > 0
                    ? array_values(array_filter($components, fn ($component) => str_contains(strtolower($component), strtolower($value))))
                    : $components,
                placeholder: 'Search component (or type "all")...'
            );
            $input->setArgument('name', $name);
        }
    }
}
