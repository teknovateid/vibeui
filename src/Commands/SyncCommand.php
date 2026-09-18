<?php

namespace Teknovate\VibeUi\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class SyncCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vibe:sync
        {--check : Check if packages/vibe is completely synchronized without writing files}
        {--silent : Suppress informational output}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronize resources (views, css, js, lang, public) into packages/vibe';

    /**
     * Sync rule definitions.
     */
    protected function getRules(): array
    {
        return [
            [
                'src' => resource_path('views/vibe'),
                'dest' => base_path('packages/vibe/resources/views/vibe'),
                'label' => 'Views',
            ],
            [
                'src' => resource_path('css/vibe'),
                'dest' => base_path('packages/vibe/resources/css/vibe'),
                'label' => 'CSS',
            ],
            [
                'src' => resource_path('js/vibe'),
                'dest' => base_path('packages/vibe/resources/js/vibe'),
                'label' => 'JS',
            ],
            [
                'src' => public_path('vibe'),
                'dest' => base_path('packages/vibe/public/vibe'),
                'label' => 'Public',
            ],
            [
                'src' => resource_path('views/components/docs/layouts'),
                'dest' => base_path('packages/vibe/stubs/Layouts/layouts'),
                'label' => 'Docs Layouts Stubs',
                'transform' => function (string $content): string {
                    return str_replace(
                        ['<x-docs.layouts.', '</x-docs.layouts.', '<x-docs.partials.', '</x-docs.partials.'],
                        ['<x-layouts.', '</x-layouts.', '<x-partials.', '</x-partials.'],
                        $content
                    );
                },
            ],
            [
                'src' => lang_path('en/vibe'),
                'dest' => base_path('packages/vibe/lang/en/vibe'),
                'label' => 'Lang EN',
            ],
            [
                'src' => lang_path('id/vibe'),
                'dest' => base_path('packages/vibe/lang/id/vibe'),
                'label' => 'Lang ID',
            ],
            [
                'src' => resource_path('views/auth/layouts'),
                'dest' => base_path('packages/vibe/stubs/Auth/layouts'),
                'label' => 'Auth Layouts',
            ],
            [
                'src' => resource_path('views/auth'),
                'dest' => base_path('packages/vibe/stubs/Auth/views'),
                'label' => 'Auth Views',
                'shallow' => true,
            ],
            [
                'src' => resource_path('views/docs/settings'),
                'dest' => base_path('packages/vibe/stubs/Templates/settings'),
                'label' => 'Settings Templates',
                'ignore' => ['index.blade.php'],
                'transform' => function (string $content): string {
                    $content = preg_replace('/<x-docs\.layouts\.[a-z0-9_-]+>/', '<x-[path].layouts.[style]>', $content);
                    $content = preg_replace('/<\/x-docs\.layouts\.[a-z0-9_-]+>/', '</x-[path].layouts.[style]>', $content);

                    return str_replace(
                        ["route('docs.index')", "route('docs.settings.", "@include('docs.settings.", 'docs.settings.'],
                        ["route('[path].index')", "route('[path].settings.", "@include('[path].settings.", '[path].settings.'],
                        $content
                    );
                },
            ],
            [
                'src' => resource_path('views/livewire/settings'),
                'dest' => base_path('packages/vibe/stubs/Auth/views/settings'),
                'label' => 'Settings Livewire Views',
            ],
            [
                'src' => app_path('Livewire/Settings'),
                'dest' => base_path('packages/vibe/stubs/Auth/Livewire/Settings'),
                'label' => 'Settings Livewire Classes',
            ],
            [
                'src' => app_path('Livewire/Auth/Concerns'),
                'dest' => base_path('packages/vibe/stubs/Auth/Concerns'),
                'label' => 'Auth Concerns',
            ],
            [
                'src' => app_path('Livewire/Auth'),
                'dest' => base_path('packages/vibe/stubs/Auth/Livewire'),
                'label' => 'Auth Livewire Classes',
                'shallow' => true,
                'ignore' => ['Concerns'],
            ],
            [
                'src' => base_path('routes'),
                'dest' => base_path('packages/vibe/stubs/Auth/routes'),
                'label' => 'Auth Routes',
                'shallow' => true,
                'ignore' => ['console.php', 'docs.php', 'web.php'],
            ],
        ];
    }

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        if (! is_dir(base_path('packages'))) {
            $this->components->error('This command is only available in package development environments ("packages" directory not found).');

            return self::FAILURE;
        }

        $checkOnly = $this->option('check');
        $silent = $this->option('silent');

        if (! $silent) {
            $this->components->info($checkOnly ? 'Checking sync status of packages/vibe...' : 'Synchronizing resources to packages/vibe...');
        }

        $rules = $this->getRules();
        $totalSynced = 0;
        $totalDeleted = 0;
        $differences = [];

        foreach ($rules as $rule) {
            $srcDir = $rule['src'];
            $destDir = $rule['dest'];
            $transform = $rule['transform'] ?? null;
            $label = $rule['label'];

            if (! File::isDirectory($srcDir)) {
                continue;
            }

            // 1. Check/copy source files to destination
            $isShallow = ! empty($rule['shallow']);
            $srcFiles = $isShallow ? File::files($srcDir) : File::allFiles($srcDir);
            $expectedDestFiles = [];

            $ignoreList = $rule['ignore'] ?? [];

            foreach ($srcFiles as $file) {
                $relativePath = $isShallow ? $file->getFilename() : $file->getRelativePathname();
                if (in_array($relativePath, $ignoreList, true)) {
                    continue;
                }
                $destPath = $destDir.DIRECTORY_SEPARATOR.$relativePath;
                $expectedDestFiles[] = $destPath;

                $srcContent = $file->getContents();
                if ($transform) {
                    $srcContent = $transform($srcContent);
                }

                $needsUpdate = false;
                if (! File::exists($destPath)) {
                    $needsUpdate = true;
                    if ($checkOnly) {
                        $differences[] = "[Missing in package] {$label}: {$relativePath}";
                    }
                } else {
                    $destContent = File::get($destPath);
                    if ($srcContent !== $destContent) {
                        $needsUpdate = true;
                        if ($checkOnly) {
                            $differences[] = "[Content mismatch] {$label}: {$relativePath}";
                        }
                    }
                }

                if ($needsUpdate && ! $checkOnly) {
                    File::ensureDirectoryExists(dirname($destPath));
                    File::put($destPath, $srcContent);
                    $totalSynced++;
                }
            }

            // 2. Check/delete orphan files in destination
            if (File::isDirectory($destDir)) {
                $destFiles = $isShallow ? File::files($destDir) : File::allFiles($destDir);
                foreach ($destFiles as $destFile) {
                    $destPath = $destFile->getRealPath();
                    if (! in_array($destPath, $expectedDestFiles)) {
                        $relName = $isShallow ? $destFile->getFilename() : $destFile->getRelativePathname();
                        if ($checkOnly) {
                            $differences[] = "[Orphan file in package] {$label}: ".$relName;
                        } else {
                            File::delete($destPath);
                            $totalDeleted++;
                        }
                    }
                }
            }
        }

        if ($checkOnly) {
            if (count($differences) > 0) {
                $this->components->error('Sync check failed! The following files are out of sync:');
                $this->components->bulletList($differences);
                $this->line('Run <fg=yellow>php artisan vibe:sync</> to synchronize.');

                return self::FAILURE;
            }

            if (! $silent) {
                $this->components->success('packages/vibe is 100% in sync with resources.');
            }

            return self::SUCCESS;
        }

        if (! $silent) {
            $this->components->success("Synchronization complete: {$totalSynced} file(s) updated, {$totalDeleted} orphan file(s) removed.");
        }

        return self::SUCCESS;
    }
}
