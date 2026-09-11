# 🎨 Vibe UI

<p align="center">
  <img src="public/vibe/logo/logo-full.svg" alt="Vibe UI Logo" width="120" height="120" onerror="this.style.display='none'">
</p>

<p align="center">
  <strong>A modern, reactive Blade & Livewire UI component library for Laravel.</strong><br>
  Crafted for speed, aesthetic excellence, and developer happiness — inspired by Flux UI.
</p>

<p align="center">
  <a href="https://packagist.org/packages/teknovate/vibeui"><img src="https://img.shields.io/packagist/v/teknovate/vibeui.svg?style=flat-square&color=6366f1" alt="Latest Version"></a>
  <a href="https://php.net"><img src="https://img.shields.io/badge/php-%3E%3D8.3-8892BF.svg?style=flat-square" alt="PHP Version"></a>
  <a href="https://laravel.com"><img src="https://img.shields.io/badge/laravel-%3E%3D11.x-FF2D20.svg?style=flat-square" alt="Laravel Version"></a>
  <a href="https://tailwindcss.com"><img src="https://img.shields.io/badge/tailwind-v4-38B2AC.svg?style=flat-square" alt="Tailwind CSS v4"></a>
  <a href="LICENSE.md"><img src="https://img.shields.io/badge/license-MIT-green.svg?style=flat-square" alt="License"></a>
</p>

---

## 📖 Overview

**Vibe UI** is a full-featured UI component ecosystem designed specifically for **Laravel 11+**, **Livewire 3**, and **Tailwind CSS v4**. It bridges the gap between raw utility classes and complex reactive logic by providing elegant, declarative custom Blade tags.

This repository serves as both the **documentation playground** and the **monorepo host** for developing the core library distributed as [`teknovate/vibeui`](https://packagist.org/packages/teknovate/vibeui).

> [!NOTE]
> **Heavily Inspired by Flux UI:** Vibe UI brings the refined aesthetic standards, accessibility foundations, and developer ergonomics popularized by Flux UI directly into the Laravel open-source ecosystem.

---

## ✨ Key Features

- 🏷️ **Short & Intuitive Blade Syntax:** Use clean custom tags like `<vibe:button>`, `<vibe:card>`, and `<vibe:table>` instead of verbose namespaced tags.
- 🌓 **First-Class Dark Mode & Curated Tokens:** Built-in semantic design tokens, zero-FOUC theme switching, and accessible contrast ratios out of the box.
- ⚡ **High-Velocity Scaffolding:** Pre-configured components for inputs, selects, modals, sheets, dropdowns, tables, and FilePond uploads.
- 🖱️ **Advanced Context Menu Suite:** Single-instance global context menu system supporting cards, standard Blade tables, and Livewire DataTables.
- 🌐 **Full Multi-Language (i18n) Support:** Native bilingual dictionary support (Indonesian & English) across all interactive components, dialogs, and docs.
- 🧩 **Deep Livewire 3 & Alpine Integration:** Automatic lazy-loading skeleton placeholders, state preservation, and confirmation dialogs.
- 💡 **Comprehensive DX:** Out-of-the-box VS Code snippets and IntelliSense attribute autocomplete (`html.customData`).

---

## 🚀 Quick Look

Here is how clean and declarative your Blade views become with Vibe UI:

```html
{{-- Interactive Buttons --}}
<vibe:button variant="primary" size="md">
    <svg class="size-4 mr-1.5" ...></svg>
    Save Changes
</vibe:button>

{{-- Form Control with Floating Label --}}
<vibe:input
    name="email"
    type="email"
    label="Email Address"
    placeholder="you@example.com"
    required
/>

{{-- Confirmed Destructive Action --}}
<vibe:button.delete
    wire:click="delete(1)"
    title="Delete Item?"
    message="Are you sure you want to delete this record? This action cannot be undone."
/>

{{-- Context Menu Integration --}}
<vibe:context menu="row-menu">
    <vibe:card class="cursor-context-menu select-none">
        <p class="text-sm">Right-click anywhere inside this card</p>
    </vibe:card>
</vibe:context>

<vibe:context.menu id="row-menu" width="48">
    <vibe:context.item @click="$wire.edit(1)">Edit Record</vibe:context.item>
    <vibe:context.divider />
    <vibe:context.item.delete wire:click="delete(1)" />
</vibe:context.menu>
```

---

## 📦 Installation

To install Vibe UI into your existing Laravel project:

```bash
composer require teknovate/vibeui
```

### Initial Scaffolding

Run the install command to publish necessary assets and configuration:

```bash
php artisan vibe:install
```

### Tailwind CSS Setup

Ensure your `@tailwindcss/vite` or `resources/css/app.css` imports Vibe UI styles:

```css
@import "tailwindcss";
@import "../../vendor/teknovate/vibeui/resources/css/vibe/vibe.css";
```

---

## 📂 Repository Architecture (Monorepo)

The repository uses a monorepo structure separating the documentation host application from the core library:

```text
vibe-ui/
├── app/                  # Host application logic (Docs & Livewire demos)
├── config/               # Host configuration
├── lang/                 # Multilingual translation dictionaries (en, id)
├── resources/            # SINGLE SOURCE OF TRUTH for UI components & assets
│   ├── css/vibe/         # CSS styles and design tokens
│   ├── js/vibe/          # Alpine.js helpers and state managers
│   └── views/vibe/       # Blade templates for all UI components
│
├── packages/vibe/        # Core Distribution Package (teknovate/vibeui)
│   ├── src/              # PHP ServiceProvider, Commands, and DataTable classes
│   ├── resources/        # Auto-synced from resources/
│   ├── lang/             # Auto-synced from lang/
│   ├── composer.json     # Package manifest for Packagist
│   └── CHANGELOG.md      # Package release history
│
└── vite.config.js        # Configured with real-time vibeSyncPlugin
```

### ⚠️ Single Source of Truth Rule

> [!IMPORTANT]
> **NEVER** edit files directly inside the `packages/vibe/` directory.  
> All component templates, styles, scripts, and localization files must be authored in `resources/` and `lang/`.  
> The Vite development server runs the custom `vibeSyncPlugin` (in `vite.config.js`), which **automatically synchronizes changes in real-time** into `packages/vibe/`.

---

## 🛠️ Developer Tooling & Commands

Vibe UI includes dedicated Artisan commands to streamline workflows:

| Command | Description |
| :--- | :--- |
| `php artisan vibe:install` | Publishes initial package configuration and assets. |
| `php artisan vibe:sync` | Manually synchronizes all assets from `resources/` to `packages/vibe/`. |
| `php artisan vibe:sync --check` | Verifies 100% asset parity between source and package (ideal for CI/CD). |
| `php artisan vibe:release` | Interactive release assistant: SemVer calculation, changelog generation, and subtree tagging. |
| `php artisan vibe:clean` | Clears and resets Vibe UI component caches. |

---

## 💻 Local Development Workflow

1. **Clone the repository:**
   ```bash
   git clone https://github.com/teknovateid/vibeui.git
   cd vibeui
   ```

2. **Install dependencies:**
   ```bash
   composer install
   npm install
   ```

3. **Configure environment:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Start the development servers:**
   ```bash
   npm run dev
   php artisan serve
   ```

5. **Browse the documentation & component playground:**  
   Open `http://localhost:8000` in your browser.

---

## 🚀 Versioning & Releases

Vibe UI strictly follows [Semantic Versioning (SemVer)](https://semver.org/) and uses Conventional Commits for automated changelog generation.

For complete step-by-step instructions on creating new releases, Git subtree splitting, and Packagist synchronization, see **[RELEASING.md](RELEASING.md)**.

---

## 🤝 Contributing

Contributions are welcome! Please follow these guidelines:
1. Fork the repository and create a new feature branch from `development`.
2. Ensure your commit messages adhere to [Conventional Commits](https://www.conventionalcommits.org/).
3. Make all UI edits inside `resources/` (never directly inside `packages/vibe/`).
4. Run `php artisan optimize:clear` and test components across both English and Indonesian locales.
5. Submit a Pull Request targeting the `development` branch.

---

## 📄 License

Vibe UI is open-source software licensed under the **[MIT License](LICENSE.md)**.