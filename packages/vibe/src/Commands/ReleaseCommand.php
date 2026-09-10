<?php

namespace Teknovate\VibeUi\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Process;
use Teknovate\VibeUi\Vibe;

use function Laravel\Prompts\confirm;
use function Laravel\Prompts\select;
use function Laravel\Prompts\text;

class ReleaseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vibe:release
        {--target-version= : Specify explicit version number (e.g. 0.1.0)}
        {--dry-run : Simulate release without modifying files or git tags}
        {--skip-tests : Skip pint and test verification}
        {--skip-sync : Skip auto-syncing resources into packages/vibe}
        {--force : Force release even with dirty working directory}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Interactive version bumper, changelog generator, and release tagger for Vibe UI';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->newLine();
        $this->line(' <fg=cyan;options=bold>🚀 Vibe UI Release Assistant</>');
        $this->line(' <fg=gray>Automating SemVer bumping, changelog generation, and Git tagging</>');
        $this->newLine();

        $dryRun = $this->option('dry-run');
        if ($dryRun) {
            $this->components->warn('DRY RUN MODE: No files or git tags will be committed/pushed.');
        }

        // 1. Verify Git Repository & Branch
        $branchResult = Process::run('git rev-parse --abbrev-ref HEAD');
        if ($branchResult->failed()) {
            $this->components->error('Not a valid git repository.');

            return self::FAILURE;
        }
        $currentBranch = trim($branchResult->output());
        $this->components->info("Current Branch: <fg=yellow>{$currentBranch}</>");

        // 2. Check for Dirty Working Directory
        $statusResult = Process::run('git status --porcelain');
        $isDirty = ! empty(trim($statusResult->output()));

        if ($isDirty && ! $this->option('force')) {
            $this->components->error('Working directory has uncommitted changes:');
            $this->line($statusResult->output());
            $this->line('Please commit or stash your changes before releasing, or use <fg=yellow>--force</>.');

            return self::FAILURE;
        }

        // 3. Pre-Release Asset Sync
        if (! $this->option('skip-sync')) {
            $this->components->task('Synchronizing resources to packages/vibe', function () {
                $this->callSilent('vibe:sync');

                return true;
            });
        }

        // 4. Determine Current Tag & Version
        $tagResult = Process::run('git describe --tags --abbrev=0');
        $latestTag = $tagResult->successful() ? trim($tagResult->output()) : null;

        if ($latestTag) {
            $currentVersion = ltrim($latestTag, 'v');
            $this->components->info("Latest Git Tag: <fg=green>{$latestTag}</> (v{$currentVersion})");
            $gitLogCommand = "git log {$latestTag}..HEAD --oneline --no-merges";
        } else {
            $currentVersion = Vibe::version();
            $this->components->warn("No git tags found. Baseline version from Vibe::VERSION: <fg=green>v{$currentVersion}</>");
            $gitLogCommand = 'git log --oneline --no-merges -n 50';
        }

        // 5. Scan and Categorize Commits
        $logResult = Process::run($gitLogCommand);
        $rawCommits = array_filter(explode("\n", trim($logResult->output())));

        $features = [];
        $fixes = [];
        $improvements = [];
        $chores = [];
        $breaking = [];

        foreach ($rawCommits as $line) {
            if (empty(trim($line))) {
                continue;
            }
            // Line format: [hash] [type]: [message]
            $parts = explode(' ', $line, 2);
            $hash = $parts[0];
            $msg = $parts[1] ?? '';

            if (preg_match('/^(BREAKING CHANGE|.*!):/i', $msg)) {
                $breaking[] = ['hash' => $hash, 'msg' => $msg];
            } elseif (preg_match('/^feat(\([^)]+\))?:/i', $msg)) {
                $features[] = ['hash' => $hash, 'msg' => $msg];
            } elseif (preg_match('/^fix(\([^)]+\))?:/i', $msg)) {
                $fixes[] = ['hash' => $hash, 'msg' => $msg];
            } elseif (preg_match('/^(perf|refactor)(\([^)]+\))?:/i', $msg)) {
                $improvements[] = ['hash' => $hash, 'msg' => $msg];
            } else {
                $chores[] = ['hash' => $hash, 'msg' => $msg];
            }
        }

        $totalCommits = count($rawCommits);
        $this->components->info("Analyzed <fg=cyan>{$totalCommits}</> commits since last release.");
        $this->line(' - 🚀 Features: '.count($features));
        $this->line(' - 🐛 Fixes: '.count($fixes));
        $this->line(' - ⚡ Refactors/Perf: '.count($improvements));
        $this->line(' - 🧰 Chores/Docs: '.count($chores));
        if (count($breaking) > 0) {
            $this->line(' - 💥 Breaking Changes: <fg=red>'.count($breaking).'</>');
        }
        $this->newLine();

        // 6. Calculate SemVer Candidates
        $parts = explode('.', $currentVersion);
        $major = (int) ($parts[0] ?? 0);
        $minor = (int) ($parts[1] ?? 0);
        $patch = (int) ($parts[2] ?? 0);

        $nextPatch = "{$major}.{$minor}.".($patch + 1);
        $nextMinor = "{$major}.".($minor + 1).'.0';
        $nextMajor = ($major + 1).'.0.0';

        // Recommend bump based on commits
        if (count($breaking) > 0) {
            $recommended = $major === 0 ? $nextMinor : $nextMajor;
        } elseif (count($features) > 0) {
            $recommended = $nextMinor;
        } else {
            $recommended = $nextPatch;
        }

        // If no tags existed, recommend v0.1.0
        if (! $latestTag) {
            $recommended = '0.1.0';
        }

        // 7. Select Version
        $targetVersion = $this->option('target-version');
        if (! $targetVersion) {
            $choice = select(
                label: 'Select the new release version:',
                options: [
                    'recommended' => "Recommended ({$recommended})",
                    'patch' => "Patch ({$nextPatch})",
                    'minor' => "Minor ({$nextMinor})",
                    'major' => "Major ({$nextMajor})",
                    'custom' => 'Custom version...',
                ],
                default: 'recommended'
            );

            if ($choice === 'recommended') {
                $targetVersion = $recommended;
            } elseif ($choice === 'patch') {
                $targetVersion = $nextPatch;
            } elseif ($choice === 'minor') {
                $targetVersion = $nextMinor;
            } elseif ($choice === 'major') {
                $targetVersion = $nextMajor;
            } else {
                $targetVersion = text(
                    label: 'Enter custom SemVer (e.g. 0.2.0):',
                    required: true,
                    validate: fn (string $val) => preg_match('/^\d+\.\d+\.\d+(-[a-zA-Z0-9.]+)?$/', $val) ? null : 'Invalid SemVer format (must be X.Y.Z)'
                );
            }
        }

        $targetTag = "v{$targetVersion}";
        $this->components->info("Target Release Version: <fg=green;options=bold>{$targetTag}</>");

        // 8. Generate Changelog Content
        $changelogEntry = $this->buildChangelogEntry($targetVersion, $features, $fixes, $improvements, $chores, $breaking);

        $this->line('<fg=gray>Generated Changelog Preview:</>');
        $this->line(str_repeat('-', 50));
        $this->line($changelogEntry);
        $this->line(str_repeat('-', 50));
        $this->newLine();

        if (! confirm("Proceed with release {$targetTag}?", true)) {
            $this->components->warn('Release cancelled by user.');

            return self::SUCCESS;
        }

        if ($dryRun) {
            $this->components->success("DRY RUN completed. Target {$targetTag} calculated successfully without making changes.");

            return self::SUCCESS;
        }

        // 9. Update Changelog Files
        $this->prependChangelog(base_path('CHANGELOG.md'), $changelogEntry);
        $this->prependChangelog(base_path('packages/vibe/CHANGELOG.md'), $changelogEntry);
        $this->components->task('Updated CHANGELOG.md files', fn () => true);

        // 10. Update Vibe.php Version Constant
        $this->updateVibeVersionClass($targetVersion);
        $this->components->task('Updated Vibe::VERSION in packages/vibe/src/Vibe.php', fn () => true);

        // 11. Git Commit and Tag
        Process::run('git add CHANGELOG.md packages/vibe/CHANGELOG.md packages/vibe/src/Vibe.php');

        // Also stage any synced package assets if exists
        Process::run('git add packages/vibe/');

        $commitMsg = "chore(release): {$targetTag}";
        $commitResult = Process::run(['git', 'commit', '-m', $commitMsg]);
        if ($commitResult->failed()) {
            $this->components->error('Failed to create git commit: '.$commitResult->errorOutput());

            return self::FAILURE;
        }
        $this->components->task("Created git commit [{$commitMsg}]", fn () => true);

        $tagResult = Process::run(['git', 'tag', '-a', $targetTag, '-m', "Release {$targetTag}"]);
        if ($tagResult->failed()) {
            $this->components->error('Failed to create git tag: '.$tagResult->errorOutput());

            return self::FAILURE;
        }
        $this->components->task("Created git tag [{$targetTag}]", fn () => true);

        $this->newLine();
        $this->components->success("🎉 Release {$targetTag} created successfully!");
        $this->newLine();

        // 12. Next Steps / Push Tag Prompt
        $this->line('To publish this release to GitHub and trigger the Subtree Split workflow:');
        $this->line("  <fg=yellow>git push origin {$currentBranch}</>");
        $this->line("  <fg=yellow>git push origin {$targetTag}</>");
        $this->newLine();

        if (confirm('Would you like to push this release and tag to origin now?', false)) {
            $this->components->task("Pushing branch {$currentBranch} to origin", function () use ($currentBranch) {
                return Process::run(['git', 'push', 'origin', $currentBranch])->successful();
            });

            $this->components->task("Pushing tag {$targetTag} to origin", function () use ($targetTag) {
                return Process::run(['git', 'push', 'origin', $targetTag])->successful();
            });

            $this->components->success("Tag {$targetTag} pushed! GitHub Actions will now split and release packages/vibe to teknovateid/vibe-ui.");
        }

        return self::SUCCESS;
    }

    /**
     * Build Markdown formatted changelog entry.
     */
    protected function buildChangelogEntry(string $version, array $features, array $fixes, array $improvements, array $chores, array $breaking): string
    {
        $date = date('Y-m-d');
        $lines = ["## [{$version}] - {$date}", ''];

        if (! empty($breaking)) {
            $lines[] = '### 💥 Breaking Changes';
            foreach ($breaking as $item) {
                $lines[] = "- {$item['msg']} ({$item['hash']})";
            }
            $lines[] = '';
        }

        if (! empty($features)) {
            $lines[] = '### 🚀 Features';
            foreach ($features as $item) {
                $lines[] = "- {$item['msg']} ({$item['hash']})";
            }
            $lines[] = '';
        }

        if (! empty($fixes)) {
            $lines[] = '### 🐛 Bug Fixes';
            foreach ($fixes as $item) {
                $lines[] = "- {$item['msg']} ({$item['hash']})";
            }
            $lines[] = '';
        }

        if (! empty($improvements)) {
            $lines[] = '### ⚡ Performance & Refactoring';
            foreach ($improvements as $item) {
                $lines[] = "- {$item['msg']} ({$item['hash']})";
            }
            $lines[] = '';
        }

        if (! empty($chores)) {
            $lines[] = '### 🧰 Maintenance & Documentation';
            foreach ($chores as $item) {
                $lines[] = "- {$item['msg']} ({$item['hash']})";
            }
            $lines[] = '';
        }

        return implode("\n", $lines);
    }

    /**
     * Prepend changelog entry to the top of a CHANGELOG.md file.
     */
    protected function prependChangelog(string $filePath, string $entry): void
    {
        $header = "# Changelog\n\nAll notable changes to **Vibe UI** (`teknovate/vibeui`) will be documented in this file.\n\n";

        if (File::exists($filePath)) {
            $existing = File::get($filePath);
            // Remove existing header if present
            if (str_starts_with($existing, "# Changelog\n\n")) {
                $existing = substr($existing, strlen($header));
            }
            $content = $header.$entry."\n\n".ltrim($existing);
        } else {
            $content = $header.$entry."\n";
        }

        File::put($filePath, $content);
    }

    /**
     * Update VERSION constant in Vibe.php.
     */
    protected function updateVibeVersionClass(string $version): void
    {
        $vibeClassPath = base_path('packages/vibe/src/Vibe.php');
        if (File::exists($vibeClassPath)) {
            $content = File::get($vibeClassPath);
            $updated = preg_replace("/const VERSION = '[^']+';/", "const VERSION = '{$version}';", $content);
            File::put($vibeClassPath, $updated);
        }
    }
}
