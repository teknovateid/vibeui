# 🎨 Vibe UI (`teknovate/vibeui`)

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

## 📦 Installation

Install Vibe UI via Composer:

```bash
composer require teknovate/vibeui
```

### Setup & Asset Publishing

Run the automated installer to publish configuration and assets:

```bash
php artisan vibe:install
```

### Tailwind CSS Integration

Import Vibe UI's stylesheets in your main CSS file (e.g. `resources/css/app.css`):

```css
@import "tailwindcss";
@import "../../vendor/teknovate/vibeui/resources/css/vibe/vibe.css";
```

---

## ✨ Key Features

- 🏷️ **Short & Intuitive Tag Syntax:** Write `<vibe:button>`, `<vibe:card>`, `<vibe:table>`, `<vibe:context>` directly in your Blade views.
- 🌓 **Curated Dark Mode:** Built-in semantic design tokens, zero-FOUC theme switching, and accessible contrast.
- ⚡ **High Velocity:** Pre-configured components for inputs, selects, modals, sheets, dropdowns, tables, and FilePond uploads.
- 🖱️ **Context Menu Suite:** Reactive right-click menus for cards, tables, and Livewire DataTables.
- 🌐 **Full Multi-Language (i18n):** Native bilingual support (English & Indonesian) for interactive components, dialogs, and messages.
- 🧩 **Deep Livewire 3 Integration:** Out-of-the-box loading skeletons, state management, and confirmation dialogs.

---

## 🚀 Quick Usage Example

```html
{{-- Buttons & Badges --}}
<vibe:button variant="primary" size="md">
    Save Changes
</vibe:button>

{{-- Form Input with Floating Label --}}
<vibe:input
    name="email"
    type="email"
    label="Email Address"
    placeholder="you@example.com"
    required
/>

{{-- Confirmed Delete Button --}}
<vibe:button.delete
    wire:click="delete(1)"
    title="Delete Record?"
    message="Are you sure you want to delete this record? This action cannot be undone."
/>

{{-- Right-Click Context Menu --}}
<vibe:context menu="user-menu">
    <vibe:card class="cursor-context-menu select-none">
        <p class="text-sm">Right-click on this card</p>
    </vibe:card>
</vibe:context>

<vibe:context.menu id="user-menu" width="48">
    <vibe:context.item @click="$wire.edit(1)">Edit</vibe:context.item>
    <vibe:context.divider />
    <vibe:context.item.delete wire:click="delete(1)" />
</vibe:context.menu>
```

---

## 🛠️ Scaffolding Commands

| Command | Description |
| :--- | :--- |
| `php artisan vibe:install` | Publishes package assets and configuration. |
| `php artisan vibe:clean` | Clears Vibe UI component caches. |

---

## 📄 License

Vibe UI is open-sourced software licensed under the **[MIT License](LICENSE.md)**.
