# Vibe UI CLI, Layout Setup & Theming Reference

## Artisan Commands

| Command | Purpose |
| :--- | :--- |
| `php artisan vibe` | Interactive console menu for Vibe UI generators and maintenance. |
| `php artisan vibe:install [--skip-npm]` | Publishes `config/vibe.php`, `resources/{css,js}/vibe/`, `public/vibe/`, `lang/*/vibe/`, `.agents/skills/vibeui/`, registers Vite entry points & Bunny fonts, injects CSS/JS imports, updates `package.json`, and registers `/locale/{locale}` route. |
| `php artisan vibe:layout <path>` | Generates a panel layout under `resources/views/components/<path>/layouts/`, `resources/views/<path>/`, settings views, and `routes/<path>.php`. |
| `php artisan vibe:page <layout> <name> [-r\|--resource] [-b\|--blank]` | Generates views inside an existing layout group and appends routes to `routes/<layout>.php`. |
| `php artisan vibe:crud <layout> <name> [--type=] [--model=]` | Generates schema-driven CRUD views (`crud-index` modal, `crud-sheet` slide-over, or `crud-resource` index/create/edit). |
| `php artisan vibe:table <name> [--model=] [--force]` | Creates a Livewire DataTable extending `Teknovate\VibeUi\DataTable\VibeDataTableComponent` and ensures `config/livewire-tables.php` disables core asset auto-injection. |
| `php artisan vibe:auth [--layout=card\|simple\|split] [--login-by=] [--with-passkeys\|--without-passkeys] [--with-qr-login\|--without-qr-login] [--migrate] [--force\|--skip-existing]` | Scaffolds authentication Livewire components, routes, views, settings, passkeys, 2FA, and QR login. |
| `php artisan vibe:component <name\|all>` | Publishes component Blade views (and matching JS/CSS if present) into `resources/` for local customization. |
| `php artisan vibe:clean [--force]` | Removes published components in `resources/views/vibe/` that are unused in `resources/views/`. |
| `php artisan vendor:publish --tag=vibe-skills --force` | Publishes/updates only the `.agents/skills/vibeui/` AI agent skill. |

## Base HTML Layout Contract

Layouts wrapping Vibe UI pages must include `@vibeStyles` in `<head>` (loads fonts, anti-FOUC theme override, dark class restoration, and `window.VIBE_*` globals) along with `@vite` and Livewire hooks:

```blade
<head>
    @vibeStyles
    @stack('seo')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @stack('head')
</head>
<body class="font-medium font-sans antialiased bg-background text-foreground vibe-scrollbar">
    {{ $slot }}
    <vibe:alert position="top-right" />
    <vibe:toast position="top-right" />
    @livewireScripts
    @stack('body')
</body>
```

## Middleware & Helpers

`VibeServiceProvider` registers these middleware aliases and `web` middleware:
- `confirm` / `password.confirm` (`RequirePasswordConfirmation`) — single-page password/passkey confirmation support.
- `idle` (`VibeIdleTimeout`) — locks inactive sessions (e.g., `idle:300`) and sets `vibeIdleTimeout`.
- `locale` / `setlocale` (`SetLocale`) — also pushed to the `web` group alongside `TrackNavigationState`.

Global PHP helpers & facades:
- `twMerge(...$args)` and `$attributes->twMerge(...)` / `@twMerge(...)`
- `vibe_parse_template($content, $data = [], $escape = true, $stripMissing = false)` / `Teknovate\VibeUi\Vibe::parseTemplate(...)`
- `Teknovate\VibeUi\Vibe::version()`

## Theme Tokens, Custom Variants & Config

- **CSS entry**: `resources/css/app.css` imports `./vibe/app.css` and `tailwindcss`.
- **Theme CSS variables** (`resources/css/vibe/app.css`):
  - Surfaces & borders: `--background`, `--foreground`, `--card`, `--popover`, `--container`, `--border`, `--input`, `--ring`, `--radius`
  - Semantic states: `--primary`, `--secondary`, `--muted`, `--destructive`, `--success`, `--warning`, `--info` (plus `*-foreground`)
  - Shell & tables: `--sidebar`, `--sidebar-foreground`, `--sidebar-border`, `--nav-active-bg`, `--nav-active-fg`, `--nav-hover-bg`, `--nav-hover-fg`, `--nav-indicator`, `--header`, `--header-foreground`, `--header-border`, `--table-header`, `--table-body`, `--table-footer`, `--table-row-hover`, `--table-row-selected`, `--table-border`
- **Custom Tailwind v4 variants** (`resources/css/vibe/custom-variant.css`):
  `minified`, `expanded`, `collapsed`, `sidebar-minified`, `sidebar-collapsed`, `sidebar-expanded`, `select`, and scoped `dark` (respects `.light` and `[data-canvas-theme="light"]`).
- **Config (`config/vibe.php`)**:
  - `prefix`: localStorage/cookie prefix (default `'vibe'`)
  - `theme.storage_mode`: `'hybrid'`, `'local_only'`, or `'global_only'` (via `VIBE_THEME_STORAGE_MODE`)
  - `theme.gate`: optional Laravel Gate name controlling global theme persistence (`VIBE_THEME_GATE`)
  - `auth`, `history`, `seo`: defaults for auth layouts/login modes/QR login, page history tracking, and `<vibe:seo>`.
