<?php

namespace Teknovate\VibeUi\Commands;

use Illuminate\Console\Command;

use function Laravel\Prompts\select;

class VibeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vibe';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Vibe UI Interactive Console';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->newLine();
        $this->line(' <fg=cyan;options=bold>
 __      ___ _          _    _ _____ 
 \ \    / (_) |        | |  | |_   _|
  \ \  / / _| |__   ___| |  | | | |  
   \ \/ / | | \'_ \ / _ \ |  | | | |  
    \  /  | | |_) |  __/ |__| |_| |_ 
     \/   |_|_.__/ \___|\____/|_____|
        </>');
        $this->line(' <fg=gray>Teknovate Vibe UI Interactive Console</>');
        $this->newLine();

        $action = select(
            'What would you like to do?',
            [
                'install' => 'Install Vibe UI (Publish config & inject assets)',
                'component' => 'Publish a Vibe UI component',
                'table' => 'Create a new Livewire DataTable component',
                'page' => 'Generate a new page inside a layout',
                'layout' => 'Generate a layout panel',
                'sync' => 'Synchronize resources into packages/vibe',
                'release' => 'Create a new release (Bump version, changelog, and tag)',
                'clean' => 'Clean unused published components',
                'exit' => 'Exit',
            ]
        );

        if ($action === 'exit') {
            $this->components->info('Goodbye!');

            return;
        }

        if ($action === 'install') {
            $this->call('vibe:install');
        } elseif ($action === 'component') {
            $this->call('vibe:component');
        } elseif ($action === 'table') {
            $this->call('vibe:table');
        } elseif ($action === 'layout') {
            $this->call('vibe:layout');
        } elseif ($action === 'page') {
            $this->call('vibe:page');
        } elseif ($action === 'sync') {
            $this->call('vibe:sync');
        } elseif ($action === 'release') {
            $this->call('vibe:release');
        } elseif ($action === 'clean') {
            $this->call('vibe:clean');
        }
    }
}
