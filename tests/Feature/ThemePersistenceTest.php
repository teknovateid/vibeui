<?php

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Gate;
use Teknovate\VibeUi\Models\ThemeSetting;
use Teknovate\VibeUi\Services\ThemeService;

uses(DatabaseTransactions::class);

beforeEach(function () {
    $themeService = app(ThemeService::class);
    $themeService->clearCache();
    ThemeSetting::where('key', 'global')->delete();
    $themeService->clearCache();
});

test('theme service resolves config storage mode by default and allows persistent db cache override', function () {
    Config::set('vibe.theme.storage_mode', 'hybrid');
    $themeService = app(ThemeService::class);

    expect($themeService->getStorageMode())->toBe('hybrid');

    $saved = $themeService->saveStorageMode('global_only', 'Tester');

    expect($saved['storage_mode'])->toBe('global_only')
        ->and($themeService->getStorageMode())->toBe('global_only');
});

test('theme storage mode endpoint validates input, respects gate authorization, and persists mode', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->postJson(route('vibe.theme.global.storage-mode'), [
            'storage_mode' => 'invalid_mode',
        ])
        ->assertUnprocessable()
        ->assertJsonValidationErrors(['storage_mode']);

    Config::set('vibe.theme.gate', 'vibe.manage-theme-test');
    Gate::define('vibe.manage-theme-test', fn ($authUser) => false);

    $this->actingAs($user)
        ->postJson(route('vibe.theme.global.storage-mode'), [
            'storage_mode' => 'global_only',
        ])
        ->assertForbidden();

    Gate::define('vibe.manage-theme-test', fn ($authUser) => true);

    $this->actingAs($user)
        ->postJson(route('vibe.theme.global.storage-mode'), [
            'storage_mode' => 'global_only',
        ])
        ->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonPath('storage_mode', 'global_only')
        ->assertJsonPath('theme.storage_mode', 'global_only');

    $this->actingAs($user)
        ->getJson(route('vibe.theme.global.show'))
        ->assertOk()
        ->assertJsonPath('storage_mode', 'global_only')
        ->assertJsonPath('can_manage', true);

    Config::set('vibe.theme.gate', null);
});

test('resetting global theme tokens preserves configured storage mode', function () {
    $themeService = app(ThemeService::class);
    $themeService->saveGlobalTheme(
        tokens: ['customHex' => '#4f46e5', 'mode' => 'dark'],
        css: ':root { --primary: #4f46e5; }',
        isLocked: true,
        updatedBy: 'Admin',
        storageMode: 'global_only',
    );

    expect($themeService->getStorageMode())->toBe('global_only');

    $themeService->resetGlobalTheme();

    $global = $themeService->getGlobalTheme();

    expect($global['tokens'])->toBeNull()
        ->and($global['css'])->toBeNull()
        ->and($global['is_locked'])->toBeFalse()
        ->and($themeService->getStorageMode())->toBe('global_only');
});

test('vibeStyles injects global_only storage mode while keeping light/dark mode in localStorage', function () {
    $themeService = app(ThemeService::class);
    $themeService->saveGlobalTheme(
        tokens: ['customHex' => '#2563eb', 'mode' => 'light'],
        css: ':root { --primary: #2563eb; }',
        isLocked: false,
        updatedBy: 'Admin',
        storageMode: 'global_only',
    );

    $rendered = Blade::render('@vibeStyles');

    expect($rendered)
        ->toContain("window.VIBE_THEME_STORAGE_MODE = 'global_only'")
        ->toContain("var allowLocalMode = (mode === 'global_only') || !isLocked")
        ->toContain("var allowLocalTokens = (mode === 'local_only') || (mode === 'hybrid' && !isLocked)")
        ->toContain(':root { --primary: #2563eb; }');
});

test('appearance settings page renders vibe:radio controls for selecting storage method', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('docs.settings.appearance'))
        ->assertOk()
        ->assertSee('name="theme_storage_mode"', false)
        ->assertSee('value="hybrid"', false)
        ->assertSee('value="local_only"', false)
        ->assertSee('value="global_only"', false)
        ->assertSee('changeStorageMode(', false)
        ->assertSee('name="is_global_locked"', false)
        ->assertSee('vibe-check-icon', false)
        ->assertSee(__('vibe/settings.appearance.storage_mode_title'))
        ->assertDontSee('switchScope(', false)
        ->assertDontSee(__('vibe/settings.appearance.local_pref_tab'))
        ->assertDontSee(__('vibe/settings.appearance.global_system_tab'));
});

test('appearance settings font radio cards and font module avoid duplicate selectFont overrides and register all four fonts', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('docs.settings.appearance'))
        ->assertOk()
        ->assertSee('role="radiogroup"', false)
        ->assertSee('@click="selectFont(f.name, f.value)"', false)
        ->assertSee("selectedFontName === f.name ? 'border-primary bg-primary text-primary-foreground'", false)
        ->assertSee(':style="{ fontFamily: f.value }"', false)
        ->assertDontSee('block pt-1 font-mono', false);

    $appearanceJs = file_get_contents(resource_path('js/vibe/appearance.js'));
    expect($appearanceJs)
        ->toContain('resolveFont(')
        ->toContain('ensureFontLoaded(');

    expect(substr_count($appearanceJs, 'selectFont('))->toBe(1)
        ->and(substr_count($appearanceJs, 'selectRadius('))->toBe(1);

    $viteConfig = file_get_contents(base_path('vite.config.js'));
    expect($viteConfig)
        ->toContain("bunny('Figtree'")
        ->toContain("bunny('Inter'")
        ->toContain("bunny('Plus Jakarta Sans'")
        ->toContain("bunny('Outfit'");
});

test('global theme save endpoint persists tokens and css in global_only mode and appearance.js uses unified buildThemeCss', function () {
    $user = User::factory()->create();

    $tokens = [
        'mode' => 'system',
        'customHex' => '#2563eb',
        'selectedRadius' => '0.75rem',
        'selectedFontName' => 'Outfit',
        'selectedFontValue' => "'Outfit', ui-sans-serif, system-ui, sans-serif",
        'tablesView' => 'compact',
    ];
    $css = ":root, html, body { --primary: #2563eb !important; --font-sans: 'Outfit', ui-sans-serif, system-ui, sans-serif !important; }";

    $this->actingAs($user)
        ->postJson(route('vibe.theme.global.save'), [
            'tokens' => $tokens,
            'css' => $css,
            'is_locked' => false,
            'storage_mode' => 'global_only',
        ])
        ->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonPath('storage_mode', 'global_only')
        ->assertJsonPath('theme.tokens.selectedFontName', 'Outfit')
        ->assertJsonPath('theme.tokens.customHex', '#2563eb')
        ->assertJsonPath('theme.css', $css);

    $this->actingAs($user)
        ->getJson(route('vibe.theme.global.show'))
        ->assertOk()
        ->assertJsonPath('storage_mode', 'global_only')
        ->assertJsonPath('theme.tokens.selectedFontName', 'Outfit')
        ->assertJsonPath('theme.css', $css);

    $appearanceJs = file_get_contents(resource_path('js/vibe/appearance.js'));
    expect($appearanceJs)
        ->toContain('buildThemeCss()')
        ->toContain('return this.buildThemeCss();')
        ->toContain('flushPendingGlobalSave()')
        ->toContain('_pendingGlobalSave');

    $themeJs = file_get_contents(resource_path('js/vibe/theme.js'));
    expect($themeJs)
        ->toContain('_liveGlobalOverride');
});

test('vibeStyles adds fallback bunny stylesheet link for global selected font only when missing from Vite fonts', function () {
    $themeService = app(ThemeService::class);
    $themeService->saveGlobalTheme(
        tokens: ['selectedFontName' => 'Outfit'],
        css: ":root { --font-sans: 'Outfit', ui-sans-serif, system-ui, sans-serif !important; }",
        isLocked: false,
        updatedBy: 'Admin',
        storageMode: 'global_only',
    );

    \Illuminate\Support\Facades\Vite::shouldReceive('fonts')
        ->once()
        ->andReturn('<style>@font-face { font-family: "Instrument Sans"; }</style>');

    $missingRendered = Blade::render('@vibeStyles');
    expect($missingRendered)
        ->toContain('id="vibe-bunny-font-outfit"')
        ->toContain('https://fonts.bunny.net/css?family=outfit:400,500,600,700&display=swap');

    \Illuminate\Support\Facades\Vite::shouldReceive('fonts')
        ->once()
        ->andReturn('<style>@font-face { font-family: "Outfit"; }</style>');

    $presentRendered = Blade::render('@vibeStyles');
    expect($presentRendered)
        ->not->toContain('id="vibe-bunny-font-outfit"');
});

test('theme service and vibeStyles sanitize CSS and JSON payloads to prevent stored XSS', function () {
    $themeService = app(ThemeService::class);
    $maliciousCss = ":root { --primary: #2563eb; }\n</style><script>alert(1)</script><img src=x onerror=alert(2)>\n@import url(https://evil.example/x.css);\nbody { background: expression(alert(3)); }";
    $maliciousTokens = [
        'customHex' => '</script><script>alert(4)</script>',
        'mode' => 'light',
    ];

    $saved = $themeService->saveGlobalTheme(
        tokens: $maliciousTokens,
        css: $maliciousCss,
        isLocked: false,
        updatedBy: 'Auditor',
        storageMode: 'global_only',
    );

    expect($saved['css'])
        ->toContain('--primary: #2563eb;')
        ->not->toContain('</style>')
        ->not->toContain('<script>')
        ->not->toContain('<img')
        ->not->toContain('@import')
        ->not->toContain('expression(');

    $rendered = Blade::render('@vibeStyles');

    expect($rendered)
        ->not->toContain('</style><script>')
        ->not->toContain('</script><script>')
        ->toContain('\u003C\/script\u003E\u003Cscript\u003Ealert(4)\u003C\/script\u003E');
});

test('theme gate authorization respects dynamic Gate::before abilities even without Gate::define', function () {
    $allowedUser = User::factory()->create();
    $deniedUser = User::factory()->create();

    Config::set('vibe.theme.gate', 'dynamic.spatie.like.permission');

    Gate::before(function ($user, string $ability) use ($allowedUser) {
        if ($ability === 'dynamic.spatie.like.permission') {
            return (int) $user->id === (int) $allowedUser->id ? true : null;
        }

        return null;
    });

    $themeService = app(ThemeService::class);
    expect($themeService->canManage($deniedUser))->toBeFalse()
        ->and($themeService->canManage($allowedUser))->toBeTrue();

    $this->actingAs($deniedUser)
        ->postJson(route('vibe.theme.global.storage-mode'), [
            'storage_mode' => 'global_only',
        ])
        ->assertForbidden();

    $this->actingAs($allowedUser)
        ->postJson(route('vibe.theme.global.storage-mode'), [
            'storage_mode' => 'global_only',
        ])
        ->assertOk();

    Config::set('vibe.theme.gate', null);
});
