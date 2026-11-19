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
