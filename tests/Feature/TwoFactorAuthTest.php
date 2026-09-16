<?php

use App\Livewire\Auth\Login;
use App\Livewire\Auth\TwoFactorChallenge;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use Teknovate\VibeUi\Vibe;

uses(DatabaseTransactions::class);

test('two factor challenge screen redirects to login when no 2fa session exists', function () {
    $response = $this->get('/two-factor-challenge');

    $response->assertRedirect(route('login'));
});

test('user with 2fa enabled is redirected to two factor challenge on login', function () {
    $user = User::factory()->create([
        'email' => '2fa-user@example.com',
        'password' => Hash::make('password123'),
    ]);

    $twoFactor = Vibe::twoFactor();
    $secret = $twoFactor->generateSecretKey();

    $user->twoFactorAuthenticators()->create([
        'method' => 'totp',
        'secret' => $secret,
        'recovery_codes' => $user->generateTwoFactorRecoveryCodes(),
        'confirmed_at' => now(),
    ]);

    Livewire::test(Login::class)
        ->set('login', '2fa-user@example.com')
        ->set('password', 'password123')
        ->call('authenticate')
        ->assertRedirect(route('two-factor.challenge'));

    $this->assertGuest();
    $this->assertEquals($user->id, session('auth.2fa.user_id'));
});

test('user can complete two factor challenge with valid totp code', function () {
    $user = User::factory()->create([
        'email' => '2fa-login@example.com',
        'password' => Hash::make('password123'),
    ]);

    $twoFactor = Vibe::twoFactor();
    $secret = $twoFactor->generateSecretKey();

    $user->twoFactorAuthenticators()->create([
        'method' => 'totp',
        'secret' => $secret,
        'recovery_codes' => $user->generateTwoFactorRecoveryCodes(),
        'confirmed_at' => now(),
    ]);

    $validOtp = $twoFactor->calculateOtp($secret);

    // Set 2FA pending session
    session(['auth.2fa.user_id' => $user->id]);

    Livewire::test(TwoFactorChallenge::class)
        ->set('code', $validOtp)
        ->call('challenge')
        ->assertHasNoErrors()
        ->assertRedirect(route('docs.index'));

    $this->assertAuthenticatedAs($user);
    $this->assertNull(session('auth.2fa.user_id'));
});

test('user fails two factor challenge with invalid totp code', function () {
    $user = User::factory()->create([
        'email' => '2fa-invalid@example.com',
        'password' => Hash::make('password123'),
    ]);

    $twoFactor = Vibe::twoFactor();
    $secret = $twoFactor->generateSecretKey();

    $user->twoFactorAuthenticators()->create([
        'method' => 'totp',
        'secret' => $secret,
        'recovery_codes' => $user->generateTwoFactorRecoveryCodes(),
        'confirmed_at' => now(),
    ]);

    session(['auth.2fa.user_id' => $user->id]);

    Livewire::test(TwoFactorChallenge::class)
        ->set('code', '000000')
        ->call('challenge')
        ->assertHasErrors(['code']);

    $this->assertGuest();
});

test('user can complete two factor challenge with recovery code', function () {
    $user = User::factory()->create([
        'email' => '2fa-recovery@example.com',
        'password' => Hash::make('password123'),
    ]);

    $twoFactor = Vibe::twoFactor();
    $secret = $twoFactor->generateSecretKey();
    $recoveryCodes = $user->generateTwoFactorRecoveryCodes();

    $auth = $user->twoFactorAuthenticators()->create([
        'method' => 'totp',
        'secret' => $secret,
        'recovery_codes' => $recoveryCodes,
        'confirmed_at' => now(),
    ]);

    session(['auth.2fa.user_id' => $user->id]);

    $codeToUse = $recoveryCodes[0];

    Livewire::test(TwoFactorChallenge::class)
        ->call('toggleRecovery')
        ->set('recovery_code', $codeToUse)
        ->call('challenge')
        ->assertHasNoErrors()
        ->assertRedirect(route('docs.index'));

    $this->assertAuthenticatedAs($user);

    // Verify recovery code was consumed
    $auth->refresh();
    $this->assertCount(7, $auth->recovery_codes);
    $this->assertNotContains($codeToUse, $auth->recovery_codes);
});

test('authenticated user can setup and confirm 2fa via api endpoints', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    // 1. Setup
    $setupRes = $this->postJson('/two-factor/setup');
    $setupRes->assertStatus(200);
    $secret = $setupRes->json('secret');
    $this->assertNotEmpty($secret);
    $this->assertNotEmpty($setupRes->json('qr_code_url'));

    // 2. Confirm with valid OTP
    $validOtp = Vibe::twoFactor()->calculateOtp($secret);
    $confirmRes = $this->postJson('/two-factor/confirm', ['code' => $validOtp]);
    $confirmRes->assertStatus(200);
    $confirmRes->assertJsonFragment(['status' => 'success']);
    $this->assertCount(8, $confirmRes->json('recovery_codes'));

    $user->refresh();
    $this->assertTrue($user->hasTwoFactorEnabled('totp'));

    // 3. Status
    $statusRes = $this->getJson('/two-factor/status');
    $statusRes->assertStatus(200);
    $statusRes->assertJsonFragment(['enabled' => true, 'recovery_codes_count' => 8]);

    // 4. Disable
    $disableRes = $this->deleteJson('/two-factor/disable');
    $disableRes->assertStatus(200);

    $user->refresh();
    $this->assertFalse($user->hasTwoFactorEnabled('totp'));
});

test('security settings page renders two factor setup ui', function () {
    $user = User::factory()->create([
        'email_verified_at' => now(),
    ]);

    $this->actingAs($user)
        ->withSession([
            'auth.password_confirmed_at' => time(),
            'auth.confirmed_route' => 'docs.settings.security',
        ])
        ->get(route('docs.settings.security'))
        ->assertOk()
        ->assertSee('Autentikasi Dua Faktor (2FA)')
        ->assertSee('Aktifkan 2FA')
        ->assertSee('Aplikasi Autentikator (TOTP)')
        ->assertSee('Kode Verifikasi Email (OTP)')
        ->assertSee('vibeTwoFactorSettings')
        ->assertSee('Passkey (WebAuthn)')
        ->assertSee('passkeyController');
});

test('user can setup and confirm two factor authentication via email otp', function () {
    \Illuminate\Support\Facades\Notification::fake();

    $user = User::factory()->create([
        'email' => 'setup-email-2fa@example.com',
        'password' => Hash::make('password123'),
    ]);

    // 1. Setup endpoint with method=email
    $response = $this->actingAs($user)
        ->postJson(route('two-factor.setup'), ['method' => 'email'])
        ->assertOk()
        ->assertJson([
            'method' => 'email',
        ]);

    $otp = null;
    \Illuminate\Support\Facades\Notification::assertSentTo(
        $user,
        \Teknovate\VibeUi\Notifications\TwoFactorCodeNotification::class,
        function ($notification) use (&$otp) {
            $otp = $notification->code;
            return true;
        }
    );

    expect($otp)->not->toBeNull();

    // 2. Confirm endpoint with method=email and valid otp
    $this->actingAs($user)
        ->postJson(route('two-factor.confirm'), [
            'method' => 'email',
            'code' => $otp,
        ])
        ->assertOk()
        ->assertJsonStructure(['status', 'method', 'recovery_codes']);

    $user->refresh();
    expect($user->hasTwoFactorEnabled('email'))->toBeTrue();
});

test('user can switch provider to email and complete challenge via email otp', function () {
    \Illuminate\Support\Facades\Notification::fake();

    $user = User::factory()->create([
        'email' => 'user-email-2fa@example.com',
        'password' => Hash::make('password123'),
    ]);

    $user->twoFactorAuthenticators()->create([
        'method' => 'totp',
        'secret' => Vibe::twoFactor()->generateSecretKey(),
        'confirmed_at' => now(),
    ]);

    session(['auth.2fa.user_id' => $user->id]);

    $test = Livewire::test(TwoFactorChallenge::class)
        ->assertSet('selectedMethod', 'totp')
        ->call('selectMethod', 'email')
        ->assertSet('selectedMethod', 'email')
        ->assertSet('codeSent', true);

    \Illuminate\Support\Facades\Notification::assertSentTo(
        $user,
        \Teknovate\VibeUi\Notifications\TwoFactorCodeNotification::class,
        function ($notification) use ($test) {
            $otp = $notification->code;
            $test->set('code', $otp)
                ->call('challenge')
                ->assertHasNoErrors()
                ->assertRedirect(route('docs.index'));

            return true;
        }
    );

    $this->assertAuthenticatedAs($user);
});

test('whatsapp and sms otp stubs are prepared and verify otp successfully', function () {
    $user = User::factory()->create([
        'username' => 'test_user_otp_' . uniqid(),
        'phone' => '081234567890',
        'password' => Hash::make('password123'),
    ]);

    $user->twoFactorAuthenticators()->create([
        'method' => 'totp',
        'secret' => Vibe::twoFactor()->generateSecretKey(),
        'confirmed_at' => now(),
    ]);

    session(['auth.2fa.user_id' => $user->id]);

    $test = Livewire::test(TwoFactorChallenge::class)
        ->call('selectMethod', 'whatsapp')
        ->assertSet('selectedMethod', 'whatsapp')
        ->assertSet('codeSent', true);

    $otp = Vibe::twoFactor()->createOtpForUser($user, 'whatsapp', 10);

    $test->set('code', $otp)
        ->call('challenge')
        ->assertHasNoErrors()
        ->assertRedirect(route('docs.index'));

    $this->assertAuthenticatedAs($user);
});

test('two factor notification can be resolved dynamically or customized via Vibe::useTwoFactorNotification', function () {
    expect(Vibe::twoFactorNotification())->toBe(\Teknovate\VibeUi\Notifications\TwoFactorCodeNotification::class);

    Vibe::useTwoFactorNotification('App\\Notifications\\CustomTestNotification');
    expect(Vibe::twoFactorNotification())->toBe('App\\Notifications\\CustomTestNotification');

    // Reset back
    Vibe::useTwoFactorNotification(\Teknovate\VibeUi\Notifications\TwoFactorCodeNotification::class);
});
