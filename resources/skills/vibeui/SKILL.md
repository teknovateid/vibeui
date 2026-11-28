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
5. **Monorepo / Package Development Check**: If `packages/vibe/` exists in the workspace root (package source repository), never edit components, CSS, JS, or views directly inside `packages/vibe/` — edit in `resources/` (or `.agents/skills/vibeui/` for this skill; sync runs via Vite `vibeSyncPlugin` or `php artisan vibe:sync`), and avoid `npm run build` while the Vite dev server is running.

## Workflow

### 1. Scaffold with Artisan Generators First

Before hand-rolling panels, CRUD pages, auth flows, or DataTables, check if a Vibe UI generator fits the task:

- **Interactive console**: `php artisan vibe`
- **Panel / Layout shell**: `php artisan vibe:layout <path>`
- **Page / Resource pages**: `php artisan vibe:page <layout> <name> [--resource] [--blank]`
- **Schema-driven CRUD**: `php artisan vibe:crud <layout> <name> [--type=crud-index|crud-sheet|crud-resource] [--model=Model]`
- **Livewire DataTable**: `php artisan vibe:table <NameTable> [--model=Model] [--force]`
- **Authentication suite**: `php artisan vibe:auth [--layout=card|simple|split]`
- **Publish component for customization**: `php artisan vibe:component <name>`

See [CLI Commands, Middleware, and Theming](./references/cli-and-theming.md) for full flags, base layout requirements (`@vibeStyles`), middleware aliases, and CSS tokens.

### 2. Compose Views with `<vibe:*>` Components

- Check [Component & Props Reference](./references/components.md) before inventing prop names or slots.
- Use `<vibe:form>` for AJAX form submission with built-in loading state, validation errors, toast/alert feedback, draft persistence (`saveToStorage`), and automatic HTTP 423 password-confirmation modal (`confirmPassword`).
- Trigger overlays via Alpine events:
  - Modal: `$dispatch('open-modal', 'modal-id')` / `$dispatch('close-modal', 'modal-id')`
  - Sheet / Sidebar: `$dispatch('open-sheet', 'sheet-id')` / `$dispatch('close-sheet', 'sheet-id')` / `$dispatch('toggle-sheet', 'sheet-id')`
- Trigger feedback from Blade/Livewire or JS:
  - Directives: `@vibeToast(['type' => 'success', 'title' => 'Saved'])` and `@vibeAlert(['type' => 'success', 'title' => 'Done'])`
  - Events: `$dispatch('toast', { type: 'success', title: '...', message: '...' })` or `$dispatch('alert', { ... })`

### 3. Verify Changes

1. Clear Laravel compiled views and caches after edits:
   ```bash
   php artisan optimize:clear
   ```
2. Run relevant Pest / PHPUnit tests (and `php artisan vibe:sync --check` if developing inside the `packages/vibe/` monorepo).
