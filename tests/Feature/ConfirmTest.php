<?php

use App\Livewire\Auth\ConfirmPassword;
use App\Models\User;
use Livewire\Livewire;

test('livewire confirm password flow and navigation away', function () {
    $user = User::factory()->create();

    // 1. Visit /docs/settings/security -> redirected to /confirm-password
    $response = $this->actingAs($user)->get('/docs/settings/security');
    $response->assertRedirect('/confirm-password');

    // Check session after step 1
    $targetRoute = session('auth.target_route');
    $isSinglePage = session('auth.is_single_page_confirm');
    expect($targetRoute)->toBe('docs.settings.security');
    expect($isSinglePage)->toBeTrue();

    // 2. User confirms password via Livewire component
    Livewire::actingAs($user)
        ->test(ConfirmPassword::class)
        ->set('password', 'password')
        ->call('confirmPassword')
        ->assertRedirect('/docs/settings/security');

    // 3. User visits /docs/settings/security now
    $response = $this->actingAs($user)->get('/docs/settings/security');
    $response->assertStatus(200);

    // 4. User navigates to /docs/settings/account
    $response = $this->actingAs($user)->get('/docs/settings/account');
    $response->assertStatus(200);

    // 5. User navigates back to /docs/settings/security -> redirected to confirm
    $response = $this->actingAs($user)->get('/docs/settings/security');
    $response->assertRedirect('/confirm-password');

    // 6. User re-confirms via POST endpoint
    $response = $this->actingAs($user)->post('/confirm-password', ['password' => 'password']);
    $response->assertRedirect('/docs/settings/security');

    // 7. User visits security now -> 200 OK
    $response = $this->actingAs($user)->get('/docs/settings/security');
    $response->assertStatus(200);

    // 8. User navigates directly to passkey (different confirm route) -> must redirect to confirm
    $response = $this->actingAs($user)->get('/docs/settings/passkey');
    $response->assertRedirect('/confirm-password');
});

test('idle timeout middleware sets dynamic headers and redirects dynamically', function () {
    $user = User::factory()->create();

    // 1. Visit idle-protected route -> check dynamic headers
    $response = $this->actingAs($user)->get('/docs/settings/login-history');
    $response->assertStatus(200);
    $response->assertHeader('X-Vibe-Idle-Timeout', '10');
    $response->assertHeader('X-Vibe-Confirm-Url', route('password.confirm', [], false));
    $response->assertHeader('X-Vibe-Idle-Lock-Url', route('password.idle-lock', [], false));
    $response->assertHeader('X-Vibe-Keep-Alive-Url', route('auth.keep-alive', [], false));

    // 2. Trigger idle-lock endpoint -> redirects dynamically to password.confirm with intended URL
    $response = $this->actingAs($user)->get('/confirm-password/idle-lock?intended=' . urlencode('/custom/page'));
    $response->assertRedirect(route('password.confirm'));
    expect(session('status'))->toBe('idle_timeout');
    expect(session('auth.session_locked'))->toBeTrue();
    expect(session('url.intended'))->toBe('/custom/page');

    // 3. Keep-alive returns 423 when session is locked
    $response = $this->actingAs($user)->get('/keep-alive');
    $response->assertStatus(423);

    // 4. Confirming password unlocks session
    Livewire::actingAs($user)
        ->test(ConfirmPassword::class)
        ->set('password', 'password')
        ->call('confirmPassword')
        ->assertRedirect('/custom/page');

    expect(session('auth.session_locked'))->toBeNull();

    // 5. Keep-alive succeeds after unlock
    $response = $this->actingAs($user)->get('/keep-alive');
    $response->assertStatus(200);
});

test('passkey confirmation authorizes target route and does not wipe state', function () {
    $user = User::factory()->create();

    // 1. User attempts to access security area
    $response = $this->actingAs($user)->get('/docs/settings/security');
    $response->assertRedirect('/confirm-password');

    expect(session('auth.target_route'))->toBe('docs.settings.security');

    // 2. Passkey verification options request (GET /passkeys/confirm/options or JSON request)
    // MUST NOT clear auth.target_route in TrackNavigationState
    $response = $this->actingAs($user)->getJson('/passkeys/confirm/options');
    expect(session('auth.target_route'))->toBe('docs.settings.security');

    // 3. Dispatch PasskeyVerified event (as happens upon successful biometric verification)
    $passkey = new \Laravel\Passkeys\Passkey;
    \Laravel\Passkeys\Events\PasskeyVerified::dispatch($user, $passkey);

    // Verify session state updated by event listener
    expect(session('auth.confirmed_route'))->toBe('docs.settings.security');
    expect(session('auth.is_single_page_confirm'))->toBeTrue();
    expect(session('auth.session_locked'))->toBeNull();

    // 4. Redirecting to security area succeeds (200 OK, not redirected back to confirm)
    $response = $this->actingAs($user)->get('/docs/settings/security');
    $response->assertStatus(200);
});

test('passkey confirmation unlocks session after idle timeout lock', function () {
    $user = User::factory()->create();

    // 1. Session gets idle-locked
    $response = $this->actingAs($user)->get('/confirm-password/idle-lock?intended=' . urlencode('/docs/settings/security'));
    $response->assertRedirect('/confirm-password');
    expect(session('auth.session_locked'))->toBeTrue();
    expect(session('url.intended'))->toBe('/docs/settings/security');

    // 2. User confirms with Passkey
    $passkey = new \Laravel\Passkeys\Passkey;
    \Laravel\Passkeys\Events\PasskeyVerified::dispatch($user, $passkey);

    expect(session('auth.session_locked'))->toBeNull();
    expect(session('auth.confirmed_route'))->toBe('/docs/settings/security');

    // 3. User visits security area -> 200 OK
    $response = $this->actingAs($user)->get('/docs/settings/security');
    $response->assertStatus(200);
});



