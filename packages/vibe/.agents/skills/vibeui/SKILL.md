---
name: vibeui
description: >-
  Guide for building Laravel Blade, Livewire 3, and Tailwind CSS v4 interfaces
  with Vibe UI (teknovate/vibeui). Use when creating or editing Blade views,
  forms, modals, sheets, tables, DataTables, navigation layouts, authentication
  flows, theme tokens, or running php artisan vibe* commands.
---

# Vibe UI (`teknovate/vibeui`)

Use this skill whenever working in a Laravel project powered by Vibe UI to ensure correct `<vibe:*>` component syntax, Livewire/Alpine integration, theme tokens, and Artisan scaffolding.

## Critical Rules

1. **Always use `<vibe:component>` tag syntax** — never use `<x-vibe::component>`. Vibe UI converts `<vibe:*>` tags via `VibeServiceProvider::parseVibeTags` and registers `vibe:` as a native Livewire Blaze prefix.
2. **Never use a `pill` prop** on `<vibe:input>` or `<vibe:button>`. Use Tailwind's `class="rounded-full"` instead.
3. **Use semantic theme tokens, not hardcoded colors** — prefer `bg-background`, `text-foreground`, `bg-card`, `text-card-foreground`, `bg-primary`, `text-primary-foreground`, `bg-muted`, `text-muted-foreground`, `border-border`, `bg-sidebar`, `bg-header`, `bg-table-header`, etc., so light/dark mode and live theme overrides work automatically.
4. **Merge custom component classes with `twMerge`** — when publishing or writing custom components, apply `{{ $attributes->twMerge(['class' => '...']) }}` or `@twMerge(...)`.
5. **Prefer existing `<vibe:*>` primitives and minimal overrides (`ponytail`)** — compose views with built-in components and utilities (`$vibe`, `VibeClipboard`, `VibeFormA11y`) instead of writing custom overlays, form validation scripts, or duplicated CSS/JS.
6. **Respect modern web semantics & accessibility** — `<vibe:modal>` uses native `<dialog>` top-layer semantics, `<vibe:toast>` renders in Top Layer (`popover="manual"`) with `role="status"`, `<vibe:switch>` enhances native `switch` controls, and Vibe UI forms pair `:user-invalid` with `aria-invalid` / `aria-describedby`. Avoid bypassing native semantics (`tabindex="-1"` on interactive toggles, unsafe `innerHTML`, or non-IME-safe Enter handlers).
7. **Never edit `vendor/teknovate/vibeui/` directly**: Customize components by publishing them into `resources/` via `php artisan vibe:component <name>` (published views in `resources/views/vibe/` automatically take precedence over package views), or customize theme tokens and defaults in `resources/css/vibe/app.css` and `config/vibe.php`.

## Workflow

### 1. Install & Scaffold with Artisan Generators First

Before hand-rolling layouts, panels, CRUD pages, auth flows, or DataTables:

- **Install in a fresh app** (after `composer require teknovate/vibeui`): `php artisan vibe:install`, then `php artisan migrate` (creates `theme_settings` and app tables)
- **Interactive console**: `php artisan vibe`
- **Panel / Layout shell**: `php artisan vibe:layout <path>`
- **Page / Resource pages**: `php artisan vibe:page <layout> <name> [--resource] [--blank]`
- **Schema-driven CRUD**: `php artisan vibe:crud <layout> <name> [--type=crud-index|crud-sheet|crud-resource] [--model=Model]`
- **Livewire DataTable**: `php artisan vibe:table <NameTable> [--model=Model] [--force]`
- **Authentication suite**: `php artisan vibe:auth [--layout=card|simple|split] [--migrate]`
- **Publish component for local customization**: `php artisan vibe:component <name|all>`

See [CLI Commands, Middleware, and Theming](./references/cli-and-theming.md) for full flags, `<head>` layout requirements (`@vibeStyles` and CSRF meta), middleware aliases, and CSS tokens.

### 2. Compose Views with `<vibe:*>` Components

- Check [Component & Props Reference](./references/components.md) before inventing prop names or slots.
- Use `<vibe:form>` for AJAX form submission with built-in loading state, validation error handling (`status="toast"|"alert"`), draft persistence (`saveToStorage`), and automatic HTTP 423 password-confirmation modal (`confirmPassword`). In `onSuccess` / `onError` JS callbacks, use the injected `$vibe`, `data`, `response`, and `$el` variables (not Alpine `$dispatch`).
- Trigger overlays from Blade/Alpine or JS (`window.$vibe`):
  - Modal: `$dispatch('open-modal', 'modal-id')` / `$dispatch('close-modal', 'modal-id')` or `$vibe.modal('modal-id').open()` / `.close()`
  - Sheet / Sidebar: `$dispatch('open-sheet', 'sheet-id')` / `$dispatch('close-sheet', 'sheet-id')` / `$dispatch('toggle-sheet', 'sheet-id')` or `$vibe.sheet('sheet-id').toggle()`
- Trigger feedback from Blade or JS:
  - Directives: `@vibeToast(['type' => 'success', 'title' => 'Saved'])` and `@vibeAlert(['type' => 'success', 'title' => 'Done'])`
  - Events / JS: `$dispatch('toast', { type: 'success', title: '...', message: '...' })` or `$vibe.toast.success('...')` / `$vibe.alert.confirm(...)`

### 3. Verify Changes

1. Clear Laravel compiled views and caches after edits:
   ```bash
   php artisan optimize:clear
   ```
2. Run relevant Pest / PHPUnit tests (`php artisan test`), and ensure Vite compiles updated CSS/JS/Blade classes (`npm run build` or running `npm run dev`).
