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
    // Rute docs.settings.security tidak punya {param} URI, jadi disimpan sebagai route name
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
    // auth.confirmed_route sekarang selalu menyimpan URL path agar middleware bisa matching
    expect(session('auth.confirmed_route'))->toBe('docs/settings/security');
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
    // auth.confirmed_route menyimpan URL path tanpa leading slash (konsisten dengan $routePath di middleware)
    expect(session('auth.confirmed_route'))->toBe('docs/settings/security');

    // 3. User visits security area -> 200 OK
    $response = $this->actingAs($user)->get('/docs/settings/security');
    $response->assertStatus(200);
});

test('idle timeout persists lock when navigating away and returning to idle-protected routes', function () {
    $user = User::factory()->create();

    // 1. Visit /docs/settings/login-history (idle protected)
    $response = $this->actingAs($user)->get('/docs/settings/login-history');
    $response->assertStatus(200);

    // 2. Simulate idle lock triggering
    $response = $this->actingAs($user)->get('/confirm-password/idle-lock?intended=' . urlencode('/docs/settings/login-history'));
    $response->assertRedirect(route('password.confirm'));
    expect(session('auth.session_locked'))->toBeTrue();

    // 3. User navigates away to a non-idle page (e.g. /docs/settings/account)
    $response = $this->actingAs($user)->get('/docs/settings/account');
    $response->assertStatus(200);
    expect(session('auth.session_locked'))->toBeTrue();

    // 4. User navigates back to /docs/settings/login-history without confirming password
    // Even if recently active on another page, it MUST redirect back to password confirmation
    $response = $this->actingAs($user)->get('/docs/settings/login-history');
    $response->assertRedirect(route('password.confirm'));
    expect(session('status'))->toBe('idle_timeout');

    // 5. User unlocks with password
    Livewire::actingAs($user)
        ->test(ConfirmPassword::class)
        ->set('password', 'password')
        ->call('confirmPassword')
        ->assertRedirect('/docs/settings/login-history');

    expect(session('auth.session_locked'))->toBeNull();

    // 6. User can now access /docs/settings/login-history
    $response = $this->actingAs($user)->get('/docs/settings/login-history');
    $response->assertStatus(200);
});

test('idle timeout middleware locks session on server-side inactivity and prevents re-entering', function () {
    $user = User::factory()->create();

    // 1. Visit /docs/settings/login-history
    $this->actingAs($user)->get('/docs/settings/login-history')->assertStatus(200);

    // 2. Fast forward inactivity by 15 seconds (timeout is 10s)
    session(['auth.last_activity_time' => time() - 15]);

    // 3. Next visit to idle route triggers lock
    $response = $this->actingAs($user)->get('/docs/settings/login-history');
    $response->assertRedirect(route('password.confirm'));
    expect(session('auth.session_locked'))->toBeTrue();

    // 4. Navigate away to another page
    $this->actingAs($user)->get('/docs/settings/account')->assertStatus(200);

    // 5. Navigate back to idle route within 2 seconds
    session(['auth.last_activity_time' => time()]);
    $response = $this->actingAs($user)->get('/docs/settings/login-history');
    $response->assertRedirect(route('password.confirm'));
});

test('confirm with timeout duration allows cross page navigation within timeout window', function () {
    $user = User::factory()->create();

    \Illuminate\Support\Facades\Route::middleware(['web', 'auth', 'confirm:100'])->group(function () {
        \Illuminate\Support\Facades\Route::get('/test-users', fn () => response('users index'))->name('test-users.index');
        \Illuminate\Support\Facades\Route::put('/test-users/update', fn () => response('users updated'))->name('test-users.update');
    });
    \Illuminate\Support\Facades\Route::middleware(['web', 'auth'])->get('/test-dashboard', fn () => response('dashboard'))->name('test-dashboard');

    // 1. Visit /test-users -> redirected to /confirm-password
    $response = $this->actingAs($user)->get('/test-users');
    $response->assertRedirect('/confirm-password');

    // 2. User confirms password via Livewire component
    Livewire::actingAs($user)
        ->test(ConfirmPassword::class)
        ->set('password', 'password')
        ->call('confirmPassword')
        ->assertRedirect('/test-users');

    // 3. User visits /test-users -> 200 OK
    $response = $this->actingAs($user)->get('/test-users');
    $response->assertStatus(200);

    // 4. User performs update
    $response = $this->actingAs($user)->put('/test-users/update');
    $response->assertStatus(200);

    // 5. User visits /test-dashboard
    $response = $this->actingAs($user)->get('/test-dashboard');
    $response->assertStatus(200);

    // 6. User visits /test-users again within 100s -> should still be 200 OK without redirecting to confirm!
    $response = $this->actingAs($user)->get('/test-users');
    $response->assertStatus(200);

    // 7. Fast forward time past 100 seconds (105s ago)
    session(['auth.password_confirmed_at' => time() - 105]);

    // 8. User visits /test-users after timeout expired -> redirected to confirm
    $response = $this->actingAs($user)->get('/test-users');
    $response->assertRedirect('/confirm-password');

    // 9. Re-confirm via POST /confirm-password endpoint
    $response = $this->actingAs($user)->post('/confirm-password', ['password' => 'password']);
    $response->assertRedirect('/test-users');

    // 10. Visit dashboard and back to users -> remains accessible
    $this->actingAs($user)->get('/test-dashboard')->assertStatus(200);
    $this->actingAs($user)->get('/test-users')->assertStatus(200);
});

test('confirm on PUT route with parameterized URI succeeds without missing parameter error', function () {
    $user = User::factory()->create();

    \Illuminate\Support\Facades\Route::middleware(['web', 'auth', 'confirm:100'])->group(function () {
        \Illuminate\Support\Facades\Route::put('/dashboard/users/update/{id}', fn ($id) => response()->json(['updated' => $id]))->name('dashboard.users.update');
    });

    // 1. AJAX PUT request without confirmed session returns 423
    $response = $this->actingAs($user)->putJson('/dashboard/users/update/42');
    $response->assertStatus(423);

    // 2. Client confirms password and passes target_url
    $response = $this->actingAs($user)->postJson('/confirm-password', [
        'password' => 'password',
        'target_url' => '/dashboard/users/update/42',
    ]);
    $response->assertNoContent();

    // 3. Replay AJAX PUT request succeeds with 200 OK!
    $response = $this->actingAs($user)->putJson('/dashboard/users/update/42');
    $response->assertStatus(200);
    $response->assertJson(['updated' => '42']);
});

test('confirm on PUT route with parameterized URI without target_url relying on session succeeds', function () {
    $user = User::factory()->create();

    \Illuminate\Support\Facades\Route::middleware(['web', 'auth', 'confirm'])->group(function () {
        \Illuminate\Support\Facades\Route::put('/dashboard/users/update-pure/{id}', fn ($id) => response()->json(['updated' => $id]))->name('dashboard.users.update-pure');
    });

    // 1. AJAX PUT request without confirmed session returns 423
    $response = $this->actingAs($user)->putJson('/dashboard/users/update-pure/77');
    $response->assertStatus(423);

    // Session must have saved route path, not naked route name that would trigger UrlGenerationException
    expect(session('auth.target_route'))->toBe('dashboard/users/update-pure/77');

    // 2. Client confirms password without target_url (relying strictly on session auth.target_route)
    $response = $this->actingAs($user)->postJson('/confirm-password', [
        'password' => 'password',
    ]);
    $response->assertNoContent();

    // 3. Replay AJAX PUT request succeeds with 200 OK!
    $response = $this->actingAs($user)->putJson('/dashboard/users/update-pure/77');
    $response->assertStatus(200);
    $response->assertJson(['updated' => '77']);
});

test('confirm on parameterized PUT route via passkey succeeds', function () {
    $user = User::factory()->create();

    \Illuminate\Support\Facades\Route::middleware(['web', 'auth', 'confirm:100'])->group(function () {
        \Illuminate\Support\Facades\Route::put('/dashboard/users/update/{id}', fn ($id) => response()->json(['updated' => $id]))->name('dashboard.users.update.passkey');
    });

    // 1. Initial PUT gets 423
    $response = $this->actingAs($user)->putJson('/dashboard/users/update/99');
    $response->assertStatus(423);

    // 2. Verify with Passkey event
    $passkey = new \Laravel\Passkeys\Passkey;
    \Laravel\Passkeys\Events\PasskeyVerified::dispatch($user, $passkey);

    // 3. Replay PUT request succeeds!
    $response = $this->actingAs($user)->putJson('/dashboard/users/update/99');
    $response->assertStatus(200);
    $response->assertJson(['updated' => '99']);
});

test('docs confirm demo auto-logs in demo user in local/testing and handles confirmation', function () {
    // 1. Visit docs confirm as guest in testing environment -> automatically logs in demo user
    $response = $this->get('/docs/auth/confirm');
    $response->assertStatus(200);
    $this->assertAuthenticated();

    // 2. Initial PUT request without confirmed password gets 423
    $response = $this->putJson('/docs/auth/confirm/demo-update/42', ['name' => 'Demo User']);
    $response->assertStatus(423);

    // 3. Confirm password
    $confirmResponse = $this->postJson('/confirm-password', [
        'password' => 'password',
        'target_url' => '/docs/auth/confirm/demo-update/42',
    ]);
    $confirmResponse->assertNoContent();

    // 4. Replay PUT request succeeds
    $response = $this->putJson('/docs/auth/confirm/demo-update/42', ['name' => 'Alex Rivera']);
    $response->assertStatus(200);
    $response->assertJson(['success' => true]);
});

test('passkeys confirm options requires authentication', function () {
    // Unauthenticated request receives 401 Unauthorized
    $response = $this->getJson('/passkeys/confirm/options');
    $response->assertStatus(401);

    // Authenticated request receives 200 OK with options
    $user = User::factory()->create();
    $response = $this->actingAs($user)->getJson('/passkeys/confirm/options');
    $response->assertStatus(200);
    $response->assertJsonStructure(['options']);
});

