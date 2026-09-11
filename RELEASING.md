# 🚀 Vibe UI Release & Versioning Guide

This document outlines the versioning philosophy, release workflow, and distribution architecture for the **Vibe UI** package (`teknovate/vibeui`) maintained within a **single monorepo repository** (`teknovateid/vibeui`).

---

## 🏗️ 1. Architecture & Distribution Model

Vibe UI combines both the interactive documentation web application and the core package source code into a single Git repository:

```text
[Repository: https://github.com/teknovateid/vibeui]
 ├── development        --> Active daily development branch (docs + package)
 ├── production         --> Stable release branch for documentation & tagged releases
 ├── composer.json      --> Host Documentation App (name: "laravel/laravel", type: "project")
 │                          Configured with local path repository: "./packages/*" (@dev symlink)
 └── packages/vibe/     --> Core Distribution Package (name: "teknovate/vibeui", type: "library")
           │
           │  (Automated git subtree split during release tagging)
           ▼
     [Git Tag vX.Y.Z]   (Contains ONLY the contents of packages/vibe/)
           │
           ▼
     [Packagist.org]
           │
           ▼
   composer require teknovate/vibeui
```

### Why Subtree Split on Tagging?

The root of this repository is a complete Laravel application containing documentation pages, interactive live examples, and development tooling. 

When a release is created, our automated release command (`php artisan vibe:release`) performs a **Git subtree split** on `packages/vibe/`. This ensures that:
- End users installing `teknovate/vibeui` via Composer **only receive clean, pure package files** (`src/`, `resources/`, `config/`, etc.).
- No documentation host files (`app/`, `database/`, `routes/web.php`, `artisan`) leak into consumer vendor folders.
- Everything remains maintainable in one unified repository.

---

## 📝 2. Semantic Versioning & Conventional Commits

Vibe UI strictly adheres to [Semantic Versioning (SemVer)](https://semver.org/): `MAJOR.MINOR.PATCH`.

Release automation analyzes the Git commit history since the previous tag to determine the appropriate version bump and generate clean changelog notes. Contributors must always format commit messages using [Conventional Commits](https://www.conventionalcommits.org/):

| Commit Prefix | Category | SemVer Impact | Description |
| :--- | :--- | :--- | :--- |
| `feat:` | Features | **MINOR** (`0.1.0` $\rightarrow$ `0.2.0`) | Introduces a new component, prop, or capability. |
| `fix:` | Bug Fixes | **PATCH** (`0.1.0` $\rightarrow$ `0.1.1`) | Fixes a bug or unexpected behavior. |
| `refactor:` / `perf:` | Improvements | **PATCH** (`0.1.0` $\rightarrow$ `0.1.1`) | Code restructuring, styling refinements, or performance optimizations. |
| `BREAKING CHANGE:` / `feat!:` | Breaking Changes | **MAJOR** (`0.9.0` $\rightarrow$ `1.0.0`) | Incompatible API changes or structural migrations. |
| `docs:` / `chore:` / `style:` / `test:` | Maintenance | **None / Included in Chores** | Documentation updates, internal maintenance, or test suites. |

---

## 🎯 3. Step-by-Step Release Workflow

Releasing a new version is completely automated through our interactive CLI assistant.

### Step 1: Ensure Working Tree is Clean

Before starting a release, ensure all pending changes on `development` are committed and tested:

```bash
git status
php artisan optimize:clear
```

### Step 2: Run the Release Assistant

Launch the interactive release command:

```bash
php artisan vibe:release
```

*(You can also access this via the central console command `php artisan vibe` and selecting the **Release** option).*

### Step 3: What the System Automates

The release assistant executes the following pipeline in seconds:

1. **Repository Validation:** Checks current Git branch and ensures no uncommitted working tree changes exist.
2. **Pre-Release Asset Sync:** Verifies that `packages/vibe/` is 100% synchronized with `resources/` and `lang/` using `vibe:sync`.
3. **Commit Analysis:** Scans all commits since the last Git tag, categorizing them into Features, Fixes, Refactoring, and Chores.
4. **SemVer Calculation:** Suggests the next version based on commit conventions. You can choose:
   - `recommended` (calculated automatically)
   - `patch`
   - `minor`
   - `major`
   - `custom` (specify an arbitrary version number)
5. **Changelog Generation:** Prepends a formatted Markdown release entry to both `CHANGELOG.md` and `packages/vibe/CHANGELOG.md`.
6. **Version Bump:** Updates the `Vibe::VERSION` constant in `packages/vibe/src/Vibe.php`.
7. **Release Commit:** Creates an annotated Git commit `chore(release): vX.Y.Z`.
8. **Subtree Tag Creation:** Extracts `packages/vibe/` into an isolated subtree commit and creates an annotated tag `vX.Y.Z`.
9. **Branch Synchronization:** Fast-forwards the `production` branch to match the release commit.

### Step 4: Push to GitHub

Once the tag is generated, push the branch and tags to GitHub:

```bash
git push origin production --tags
```

*(The CLI assistant will offer an interactive confirmation to push automatically if desired).*

---

## ⚙️ 4. One-Time Packagist Setup

Once published to GitHub, Packagist distributes the package to the global PHP ecosystem:

1. Visit [packagist.org/packages/submit](https://packagist.org/packages/submit).
2. Enter the repository URL:
   ```text
   https://github.com/teknovateid/vibeui
   ```
3. Click **Check**, then click **Submit**. Packagist will immediately detect the package name **`teknovate/vibeui`**.
4. Configure the **GitHub Service Hook** (or webhook) in the Packagist settings so that every newly pushed Git tag automatically triggers a Packagist update within seconds.

---

## 🛠️ 5. Command Reference & CLI Flags

The `vibe:release` command supports several flags for automated environments and CI/CD:

```bash
# Dry-run mode: preview commit analysis, version bump, and changelog without writing files or tags
php artisan vibe:release --dry-run

# Specify an explicit version instead of interactive prompts
php artisan vibe:release --target-version=0.2.0

# Skip automatic pre-release asset synchronization
php artisan vibe:release --skip-sync

# Skip Pint code style formatting and test checks
php artisan vibe:release --skip-tests

# Force release even if the working directory has uncommitted files
php artisan vibe:release --force
```

### Companion Utility: Asset Parity Check

To verify that `packages/vibe/` is completely up-to-date with `resources/` (useful for GitHub Actions or pre-commit hooks):

```bash
php artisan vibe:sync --check
```

---

## 🚨 6. Troubleshooting & Rollbacks

### Accidental Tag Created (Before Pushing)

If you created a tag locally that should not be released:

```bash
# Delete local tag
git tag -d v0.X.Y

# Revert the release commit
git reset --hard HEAD~1
```

### Deleting a Pushed Tag (Emergency)

If a broken release tag was already pushed to GitHub:

```bash
# Delete local tag
git tag -d v0.X.Y

# Delete remote tag
git push --delete origin v0.X.Y
```

After removing a remote tag, log in to [packagist.org](https://packagist.org) and click **Update** on the package dashboard to purge the retracted version.
