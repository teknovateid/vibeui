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
        ];
    }

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
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
            $srcFiles = File::allFiles($srcDir);
            $expectedDestFiles = [];

            foreach ($srcFiles as $file) {
                $relativePath = $file->getRelativePathname();
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
                $destFiles = File::allFiles($destDir);
                foreach ($destFiles as $destFile) {
                    $destPath = $destFile->getRealPath();
                    if (! in_array($destPath, $expectedDestFiles)) {
                        if ($checkOnly) {
                            $differences[] = "[Orphan file in package] {$label}: ".$destFile->getRelativePathname();
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
