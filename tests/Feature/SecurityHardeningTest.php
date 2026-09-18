<?php

use App\Livewire\Auth\ConfirmPassword;
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\TwoFactorChallenge;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Livewire;
use Teknovate\VibeUi\Vibe;

uses(DatabaseTransactions::class);

test('two factor challenge locks out after 5 consecutive failed attempts', function () {
    $user = User::factory()->create([
        'email' => '2fa-lockout@example.com',
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

    $throttleKey = '2fa-challenge|' . $user->id . '|127.0.0.1';
    RateLimiter::clear($throttleKey);

    // Fail 5 times
    for ($i = 0; $i < 5; $i++) {
        Livewire::test(TwoFactorChallenge::class)
            ->set('code', '000000')
            ->call('challenge')
            ->assertHasErrors(['code']);
    }

    // 6th attempt must be throttled
    Livewire::test(TwoFactorChallenge::class)
        ->set('code', '000000')
        ->call('challenge')
        ->assertHasErrors(['code']);

    expect(RateLimiter::tooManyAttempts($throttleKey, 5))->toBeTrue();
});

test('open redirect attempts via idle-lock intended parameter are neutralized', function () {
    $user = User::factory()->create();

    // Malicious external target
    $response = $this->actingAs($user)->get('/confirm-password/idle-lock?intended=' . urlencode('https://evil-phishing.com/steal'));
    $response->assertRedirect(route('password.confirm'));

    // url.intended in session must NOT be the evil external site
    $sessionIntended = session('url.intended');
    expect($sessionIntended)->not->toBe('https://evil-phishing.com/steal');
    expect(str_starts_with($sessionIntended, 'https://evil-phishing.com'))->toBeFalse();
});

test('open redirect attempts via protocol-relative URLs are neutralized', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/confirm-password/idle-lock?intended=' . urlencode('//evil-phishing.com'));
    $response->assertRedirect(route('password.confirm'));

    $sessionIntended = session('url.intended');
    expect($sessionIntended)->not->toBe('//evil-phishing.com');
    expect(str_starts_with($sessionIntended, '//'))->toBeFalse();
});

test('password update in settings requires password confirmation and consumes session on success', function () {
    $user = User::factory()->create([
        'password' => Hash::make('old-password-123'),
    ]);

    // 1. Calling updatePassword without confirmed session redirects to confirm password
    Livewire::actingAs($user)
        ->test(Password::class)
        ->set('password', 'new-password-456')
        ->set('password_confirmation', 'new-password-456')
        ->call('updatePassword')
        ->assertRedirect('/confirm-password');

    // Password must still be old password
    expect(Hash::check('old-password-123', $user->fresh()->password))->toBeTrue();

    // 2. Set valid confirmation session
    session([
        'auth.password_confirmed_at' => time(),
        'auth.confirmed_route' => 'docs.settings.security',
        'auth.is_single_page_confirm' => true,
    ]);

    // 3. Updating password with confirmed session succeeds
    Livewire::actingAs($user)
        ->test(Password::class)
        ->set('password', 'new-password-456')
        ->set('password_confirmation', 'new-password-456')
        ->call('updatePassword')
        ->assertHasNoErrors();

    // Password is now updated
    expect(Hash::check('new-password-456', $user->fresh()->password))->toBeTrue();

    // One-Time Consume: confirmation session MUST be forgotten immediately
    expect(session('auth.password_confirmed_at'))->toBeNull();
    expect(session('auth.confirmed_route'))->toBeNull();
});

test('changing user email in profile resets email_verified_at', function () {
    $user = User::factory()->create([
        'email' => 'initial-verified@example.com',
        'email_verified_at' => now(),
    ]);

    Livewire::actingAs($user)
        ->test(Profile::class)
        ->set('email', 'new-unverified@example.com')
        ->call('updateProfile')
        ->assertHasNoErrors();

    $user->refresh();
    expect($user->email)->toBe('new-unverified@example.com');
    expect($user->email_verified_at)->toBeNull();
});

test('updating profile without changing email preserves email_verified_at', function () {
    $verifiedTime = now()->subDays(5);
    $user = User::factory()->create([
        'email' => 'keep-verified@example.com',
        'email_verified_at' => $verifiedTime,
    ]);

    Livewire::actingAs($user)
        ->test(Profile::class)
        ->set('name', 'Updated Name')
        ->call('updateProfile')
        ->assertHasNoErrors();

    $user->refresh();
    expect($user->name)->toBe('Updated Name');
    expect($user->email_verified_at)->not->toBeNull();
});

test('forgot password sendResetLink is rate limited', function () {
    RateLimiter::clear('forgot-password|127.0.0.1');

    for ($i = 0; $i < 5; $i++) {
        Livewire::test(ForgotPassword::class)
            ->set('email', "test{$i}@example.com")
            ->call('sendResetLink');
    }

    // 6th attempt must be throttled
    Livewire::test(ForgotPassword::class)
        ->set('email', 'another@example.com')
        ->call('sendResetLink')
        ->assertHasErrors(['email']);
});

test('sec-fetch-dest media tags are blocked from triggering session locks', function () {
    $user = User::factory()->create();

    // Requesting idle-lock via <img> tag should be blocked (403)
    $response = $this->actingAs($user)
        ->withHeaders(['Sec-Fetch-Dest' => 'image'])
        ->get('/confirm-password/idle-lock');

    $response->assertStatus(403);
});
