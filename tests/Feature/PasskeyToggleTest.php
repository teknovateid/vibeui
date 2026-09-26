<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;

test('passkey UI elements are displayed when passkeys are enabled', function () {
    Config::set('passkeys.enabled', true);

    $response = $this->get('/login');
    $response->assertStatus(200);
    $response->assertSee('vibeLoginWithPasskey');
    $response->assertSee('webauthn');
});

test('passkey UI elements are completely hidden when passkeys are disabled', function () {
    Config::set('passkeys.enabled', false);

    $response = $this->get('/login');
    $response->assertStatus(200);
    $response->assertDontSee('vibeLoginWithPasskey');
    $response->assertDontSee('webauthn');
});

test('confirm password view hides passkeys button when passkeys are disabled', function () {
    $user = User::factory()->create();

    // Authenticate and lock session to simulate confirm password view
    $response = $this->actingAs($user)->get('/confirm-password');
    $response->assertStatus(200);

    // Default: enabled
    Config::set('passkeys.enabled', true);
    $enabledResponse = $this->actingAs($user)->get('/confirm-password');
    $enabledResponse->assertSee('vibeConfirmWithPasskey');

    // Disabled
    Config::set('passkeys.enabled', false);
    $disabledResponse = $this->actingAs($user)->get('/confirm-password');
    $disabledResponse->assertDontSee('vibeConfirmWithPasskey');
    $disabledResponse->assertDontSee('resources/js/vibe/passkeys.js');
});

test('settings passkey route redirects to settings security when passkeys are disabled', function () {
    $user = User::factory()->create([
        'email_verified_at' => now(),
    ]);

    Config::set('passkeys.enabled', false);

    $response = $this->actingAs($user)
        ->withSession([
            'auth.password_confirmed_at' => time(),
            'auth.confirmed_route' => 'docs.settings.passkey',
        ])
        ->get(route('docs.settings.passkey'));

    $response->assertRedirect(route('docs.settings.security'));
});

test('settings security view hides passkey section when passkeys are disabled', function () {
    $user = User::factory()->create([
        'email_verified_at' => now(),
    ]);

    Config::set('passkeys.enabled', false);

    $response = $this->actingAs($user)
        ->withSession([
            'auth.password_confirmed_at' => time(),
            'auth.confirmed_route' => 'docs.settings.security',
        ])
        ->get(route('docs.settings.security'));

    $response->assertStatus(200);
    $response->assertDontSee('passkeyController()');
    $response->assertDontSee('resources/js/vibe/passkeys.js');
});
