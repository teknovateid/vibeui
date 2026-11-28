# Vibe UI CLI, Layout Setup & Theming Reference

## Artisan Commands

| Command | Purpose |
| :--- | :--- |
| `php artisan vibe` | Interactive console menu for Vibe UI generators and maintenance. |
| `php artisan vibe:install [--skip-npm]` | Publishes `config/vibe.php`, `resources/{css,js}/vibe/`, `public/`, `lang/*/vibe/`, and `.agents/skills/vibeui/`, registers Vite entry points & Bunny fonts, injects CSS/JS imports, updates `package.json`, and registers `/locale/{locale}` in `routes/web.php`. Run `php artisan migrate` afterward. |
| `php artisan vibe:layout <path>` | Generates a panel layout (e.g. `sidebar`, `sidebar-classic`) under `resources/views/components/<path>/layouts/`, `resources/views/components/<path>/partials/`, `resources/views/<path>/`, settings views, and `routes/<path>.php`. |
| `php artisan vibe:page <layout> <name> [-r\|--resource] [-b\|--blank]` | Generates views inside an existing layout group and appends routes to `routes/<layout>.php`. |
| `php artisan vibe:crud <layout> <name> [--type=] [--model=]` | Generates schema-driven CRUD views (`crud-index` modal, `crud-sheet` slide-over, or `crud-resource` index/create/edit). |
| `php artisan vibe:table <name> [--model=] [--force]` | Creates a Livewire DataTable extending `Teknovate\VibeUi\DataTable\VibeDataTableComponent` and ensures `config/livewire-tables.php` disables core/third-party asset auto-injection. |
| `php artisan vibe:auth [--layout=card\|simple\|split] [--login-by=] [--with-passkeys\|--without-passkeys] [--with-qr-login\|--without-qr-login] [--migrate] [--force\|--skip-existing]` | Scaffolds auth Livewire components (`app/Livewire/Auth/*`), views, `routes/auth.php`, settings, `config/passkeys.php`, 2FA, QR login, and migrations (`add_vibe_auth_tables`, `create_passkeys_table`). |
| `php artisan vibe:component <name\|all> [--silent]` | Publishes component Blade views (plus matching JS/CSS if present; ensures `config/livewire-tables.php` for `datatable`) into `resources/` for local customization. |
| `php artisan vibe:clean [--force]` | Removes published components in `resources/views/vibe/` that are unused in `resources/views/`. |
| `php artisan vendor:publish --tag=vibe-skills --force` | Publishes/updates `.agents/skills/vibeui/`. Other package tags: `vibe-config`, `vibe-assets`, `vibe-lang`, `vibe-migrations`. |

## Base HTML Layout Contract

Layouts wrapping Vibe UI pages must include `color-scheme` metadata, a `csrf-token` meta tag, and `@vibeStyles` in `<head>` (emits `<meta name="color-scheme">`, loads fonts, anti-FOUC theme override, dark class restoration, and `window.VIBE_*` globals) along with `@vite` and Livewire hooks:

```blade
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="light dark">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <script data-navigate-once="true">
        window.VibeCommonI18n = @js(__('vibe/common'));
    </script>
    @livewireScripts
    @stack('body')
</body>
```

## Middleware, Package Routes & Helpers

`VibeServiceProvider` automatically loads theme API routes (`/vibe-api/theme/*`, `vibe.theme.*`), the `create_theme_settings_table` migration, and excludes the theme cookie (`config('vibe.prefix') . '_theme'`) from `EncryptCookies`. It registers these middleware aliases and `web` middleware:
- `confirm` / `password.confirm` (`RequirePasswordConfirmation`) — single-page password/passkey confirmation support.
- `idle` (`VibeIdleTimeout`) — locks inactive sessions (e.g., `idle:300`) and sets `vibeIdleTimeout`.
- `locale` / `setlocale` (`SetLocale`) — also pushed to the `web` group alongside `TrackNavigationState`.

Global PHP helpers, attribute bag macros & facade methods:
- `twMerge(...$args)` and `$attributes->twMerge(...)` / `$attributes->twMergeFor($for, ...)` / `$attributes->withoutTwMergeClasses()` / `@twMerge(...)`
- `vibe_parse_template($content, $data = [], $escape = true, $stripMissing = false)` / `Teknovate\VibeUi\Vibe::parseTemplate(...)`
- `Teknovate\VibeUi\Vibe::version()`

## Theme Tokens, Custom Variants & Config

- **CSS entry**: `resources/css/app.css` imports `./vibe/app.css` before `@import 'tailwindcss';` (`app.css` imports `vibe.css`, `custom-variant.css`, and `animation.css`).
- **Theme CSS variables** (`resources/css/vibe/app.css`):
  - Surfaces & borders: `--background`, `--foreground`, `--card`, `--card-foreground`, `--popover`, `--popover-foreground`, `--container`, `--container-foreground`, `--container-border`, `--border`, `--input`, `--ring`, `--radius`
  - Semantic states: `--primary`, `--secondary`, `--muted`, `--destructive`, `--success`, `--warning`, `--info` (plus `*-foreground`) and `--chart-1`..`--chart-5`
  - Shell & tables: `--sidebar`, `--sidebar-foreground`, `--sidebar-border`, `--nav-active-bg`, `--nav-active-fg`, `--nav-hover-bg`, `--nav-hover-fg`, `--nav-indicator`, `--header`, `--header-foreground`, `--header-border`, `--table-header`, `--table-header-foreground`, `--table-body`, `--table-footer`, `--table-row-hover`, `--table-row-selected`, `--table-border`
- **Custom Tailwind v4 variants** (`resources/css/vibe/custom-variant.css`):
  `minified`, `expanded`, `collapsed`, `sidebar-minified`, `sidebar-collapsed`, `sidebar-expanded`, `select`, and scoped `dark` (respects `.light` and `[data-canvas-theme="light"]`).
- **Config (`config/vibe.php` & `config/passkeys.php`)**:
  - `prefix`: localStorage/cookie prefix (default `'vibe'`)
  - `theme.storage_mode`: `'hybrid'`, `'local_only'`, or `'global_only'` (`VIBE_THEME_STORAGE_MODE`)
  - `theme.gate`: optional Laravel Gate name controlling global theme persistence (`VIBE_THEME_GATE`)
  - `auth`, `history`, `seo`, `models`, `notifications`: defaults for auth layouts/login modes/2FA password confirmation/QR login, page history tracking, `<vibe:seo>`, and custom model/notification overrides.
