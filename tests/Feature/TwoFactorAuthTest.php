<?php

use App\Livewire\Auth\Login;
use App\Livewire\Auth\TwoFactorChallenge;
use App\Livewire\Settings\TwoFactor;
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

test('authenticated user can setup and confirm 2fa via livewire component', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $test = Livewire::test(TwoFactor::class)
        ->assertSet('totpEnabled', false)
        ->call('setupTotp')
        ->assertDispatched('open-modal', 'modal-2fa-totp');

    $secret = $test->get('secretKey');
    expect($secret)->not->toBeEmpty();
    expect($test->get('qrCodeUrl'))->not->toBeEmpty();

    // Confirm with valid OTP
    $validOtp = Vibe::twoFactor()->calculateOtp($secret);
    $test->set('code', $validOtp)
        ->call('confirmTwoFactor')
        ->assertSet('step', 1)
        ->assertSet('totpEnabled', true)
        ->assertDispatched('vibe-toast');

    expect($test->get('recoveryCodes'))->toHaveCount(8);

    $user->refresh();
    expect($user->hasTwoFactorEnabled('totp'))->toBeTrue();

    // Disable
    $test->call('disable', 'totp')
        ->assertSet('totpEnabled', false)
        ->assertDispatched('vibe-toast');

    $user->refresh();
    expect($user->hasTwoFactorEnabled('totp'))->toBeFalse();
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
        ->assertSee('Aktifkan')
        ->assertSee('Aplikasi Autentikator (TOTP)')
        ->assertSee('Kode Verifikasi Email (OTP)')
        ->assertSee('vibeTwoFactorSettings')
        ->assertSee('Passkey (WebAuthn)')
        ->assertSee('passkeyController');
});

test('user can setup and confirm two factor authentication via email otp in livewire component', function () {
    \Illuminate\Support\Facades\Notification::fake();

    $user = User::factory()->create([
        'email' => 'setup-email-2fa@example.com',
        'password' => Hash::make('password123'),
    ]);

    $this->actingAs($user);

    $test = Livewire::test(TwoFactor::class)
        ->assertSet('emailEnabled', false)
        ->call('setupEmail')
        ->assertSet('emailOtpSent', true)
        ->assertSet('selectedMethod', 'email')
        ->assertDispatched('open-modal', 'modal-2fa-email');

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

    $test->set('code', $otp)
        ->call('confirmTwoFactor')
        ->assertSet('step', 1)
        ->assertSet('emailEnabled', true)
        ->assertDispatched('vibe-toast');

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

    $user->twoFactorAuthenticators()->create([
        'method' => 'email',
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

    $user->twoFactorAuthenticators()->create([
        'method' => 'whatsapp',
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

test('email 2fa setup does not resend email when cooldown is still active', function () {
    \Illuminate\Support\Facades\Notification::fake();

    $user = User::factory()->create([
        'email' => 'cooldown-test-' . uniqid() . '@example.com',
        'password' => Hash::make('password123'),
    ]);

    $this->actingAs($user);

    $test = Livewire::test(TwoFactor::class)
        ->assertSet('emailEnabled', false)
        ->call('setupEmail')
        ->assertSet('emailOtpSent', true)
        ->assertSet('cooldown', 60)
        ->assertDispatched('open-modal', 'modal-2fa-email');

    // Email harus terkirim 1 kali
    \Illuminate\Support\Facades\Notification::assertSentTimes(
        \Teknovate\VibeUi\Notifications\TwoFactorCodeNotification::class,
        1
    );

    // Panggil setupEmail lagi saat cooldown masih berjalan (simulasi modal ditutup dan dibuka lagi)
    $test->call('setupEmail')
        ->assertSet('emailOtpSent', true)
        ->assertDispatched('open-modal', 'modal-2fa-email');

    // Email TIDAK boleh dikirim lagi (tetap 1 kali)
    \Illuminate\Support\Facades\Notification::assertSentTimes(
        \Teknovate\VibeUi\Notifications\TwoFactorCodeNotification::class,
        1
    );

    // Begitu pula resendEmailOtp saat cooldown masih aktif tidak mengirim email tambahan
    $test->call('resendEmailOtp');
    \Illuminate\Support\Facades\Notification::assertSentTimes(
        \Teknovate\VibeUi\Notifications\TwoFactorCodeNotification::class,
        1
    );
});

test('two factor challenge renders proper translations and toggles method selector screen', function () {
    app()->setLocale('id');

    $user = User::factory()->create([
        'email' => 'toggle-test-' . uniqid() . '@example.com',
        'password' => Hash::make('password123'),
    ]);

    $user->twoFactorAuthenticators()->create([
        'method' => 'totp',
        'secret' => Vibe::twoFactor()->generateSecretKey(),
        'recovery_codes' => $user->generateTwoFactorRecoveryCodes(),
        'confirmed_at' => now(),
    ]);

    session(['auth.2fa.user_id' => $user->id]);

    $component = Livewire::test(TwoFactorChallenge::class);

    // Layar 1 (Challenge Form) - Bahasa Indonesia
    $component
        ->assertDontSee('auth.titles.two_factor_challenge')
        ->assertSee('Autentikasi Dua Faktor (2FA)')
        ->assertSee('Coba cara verifikasi lain')
        ->assertSet('showingMethodSelector', false);

    // Beralih ke Layar 2 (Pilih Metode Verifikasi)
    $component
        ->call('toggleMethodSelector')
        ->assertSet('showingMethodSelector', true)
        ->assertSee('Pilih Metode Verifikasi')
        ->assertSee('Kembali ke verifikasi')
        ->assertDontSee('Batal dan kembali ke login')
        ->assertDontSee('Cancel and back to login');

    // Kembali lagi ke Layar 1
    $component
        ->call('toggleMethodSelector')
        ->assertSet('showingMethodSelector', false)
        ->assertSee('Autentikasi Dua Faktor (2FA)')
        ->assertSee('Coba cara verifikasi lain')
        ->assertSee('Batal dan kembali ke login');
});

test('unconfigured methods such as whatsapp and sms are not shown when user has not enabled them in database', function () {
    $user = User::factory()->create([
        'email' => 'db-test-' . uniqid() . '@example.com',
        'phone' => '081234567890',
        'password' => Hash::make('password123'),
    ]);

    // User hanya mengaktifkan TOTP dan Email di database
    $user->twoFactorAuthenticators()->create([
        'method' => 'totp',
        'secret' => Vibe::twoFactor()->generateSecretKey(),
        'confirmed_at' => now(),
    ]);

    $user->twoFactorAuthenticators()->create([
        'method' => 'email',
        'confirmed_at' => now(),
    ]);

    session(['auth.2fa.user_id' => $user->id]);

    // Di challenge, HANYA totp dan email yang muncul. WhatsApp dan SMS TIDAK BOLEH muncul!
    Livewire::test(TwoFactorChallenge::class)
        ->call('toggleMethodSelector')
        ->assertSee('Aplikasi Autentikator')
        ->assertSee('Kode Verifikasi Email')
        ->assertDontSee('WhatsApp OTP')
        ->assertDontSee('SMS OTP');
});

test('invalid recovery code displays properly translated validation error message', function () {
    app()->setLocale('en');

    $user = User::factory()->create([
        'email' => 'recovery-lang-test@example.com',
        'password' => Hash::make('password123'),
    ]);

    $user->twoFactorAuthenticators()->create([
        'method' => 'totp',
        'secret' => Vibe::twoFactor()->generateSecretKey(),
        'recovery_codes' => $user->generateTwoFactorRecoveryCodes(),
        'confirmed_at' => now(),
    ]);

    session(['auth.2fa.user_id' => $user->id]);

    Livewire::test(TwoFactorChallenge::class)
        ->call('selectMethod', 'recovery')
        ->set('recovery_code', 'invalid-code-1234')
        ->call('challenge')
        ->assertHasErrors(['recovery_code'])
        ->assertDontSee('auth.two_factor.invalid_recovery_code')
        ->assertSee('The recovery code provided is invalid or has already been used.');

    app()->setLocale('id');

    Livewire::test(TwoFactorChallenge::class)
        ->call('selectMethod', 'recovery')
        ->set('recovery_code', 'invalid-code-1234')
        ->call('challenge')
        ->assertHasErrors(['recovery_code'])
        ->assertDontSee('auth.two_factor.invalid_recovery_code')
        ->assertSee('Kode pemulihan yang Anda masukkan tidak valid atau sudah digunakan.');
});

