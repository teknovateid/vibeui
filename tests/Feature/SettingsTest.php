<?php

use App\Livewire\Settings\DeleteUser;
use App\Livewire\Settings\LoginHistory;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

uses(DatabaseTransactions::class);

beforeEach(function () {
    $this->user = User::factory()->create([
        'name' => 'John Doe',
        'email' => 'john.' . uniqid() . '@example.com',
        'username' => 'johndoe_' . uniqid(),
        'phone' => '0812' . rand(10000000, 99999999),
        'password' => Hash::make('password123'),
    ]);
});

test('guests are redirected from settings to login', function () {
    $this->get(route('docs.settings.account'))
        ->assertRedirect(route('login'));
});

test('authenticated user can view settings account page', function () {
    $this->actingAs($this->user)
        ->get(route('docs.settings.account'))
        ->assertOk()
        ->assertSeeLivewire(Profile::class)
        ->assertSee('xl:grid-cols-12', false)
        ->assertSee('filepond-avatar-mode', false)
        ->assertSee(__('vibe/settings.profile.account_detail_title'))
        ->assertSee(__('vibe/settings.profile.interface_language'))
        ->assertDontSee('name="position"', false);
});

test('authenticated user can view appearance page with sidebar, header, and custom primary color controls', function () {
    $this->actingAs($this->user)
        ->get(route('docs.settings.appearance'))
        ->assertOk()
        ->assertSee('Custom primary color')
        ->assertDontSee('Brand color')
        ->assertSee('Desktop sidebar')
        ->assertSee('Application header')
        ->assertSee('sidebarCustomBg')
        ->assertSee('headerCustomBg')
        ->assertSee('tableCustomHeaderBg')
        ->assertSee('tableCustomBorder');
});

test('profile component updates user details in database', function () {
    Livewire::actingAs($this->user)
        ->test(Profile::class)
        ->assertSet('name', 'John Doe')
        ->assertSet('email', $this->user->email)
        ->set('name', 'John Updated')
        ->set('username', 'john_updated_' . uniqid())
        ->set('phone', '081399998888')
        ->call('updateProfile')
        ->assertHasNoErrors()
        ->assertDispatched('toast');

    $this->user->refresh();

    expect($this->user->name)->toBe('John Updated')
        ->and($this->user->phone)->toBe('081399998888');
});

test('profile component uploads and removes user avatar on public disk', function () {
    Config::set('filesystems.default', 'public');
    Config::set('livewire.temporary_file_upload.disk', 'public');
    Storage::fake('public');

    $file = UploadedFile::fake()->image('avatar.png', 200, 200);

    Livewire::actingAs($this->user)
        ->test(Profile::class)
        ->set('avatar_file', $file)
        ->assertHasNoErrors()
        ->assertDispatched('profile-avatar-saved')
        ->assertDispatched('toast');

    $this->user->refresh();

    expect($this->user->avatar)->not->toBeNull();
    Storage::disk('public')->assertExists($this->user->avatar);

    $storedAvatar = $this->user->avatar;

    Livewire::actingAs($this->user)
        ->test(Profile::class)
        ->call('removeAvatar')
        ->assertHasNoErrors()
        ->assertSet('avatar', null)
        ->assertSet('avatarUrl', null)
        ->assertDispatched('profile-avatar-removed')
        ->assertDispatched('toast');

    $this->user->refresh();

    expect($this->user->avatar)->toBeNull();
    Storage::disk('public')->assertMissing($storedAvatar);
});

test('profile component resends email verification notification with rate limiting', function () {
    Notification::fake();

    $unverifiedUser = User::factory()->unverified()->create();
    RateLimiter::clear('verify-email-profile|' . $unverifiedUser->id);

    Livewire::actingAs($unverifiedUser)
        ->test(Profile::class)
        ->assertSet('emailVerified', false)
        ->call('resendEmailVerification')
        ->assertDispatched('toast');

    Notification::assertSentTo($unverifiedUser, VerifyEmail::class);
});

test('password component validates password confirmation correctly', function () {
    session(['auth.password_confirmed_at' => time()]);

    Livewire::actingAs($this->user)
        ->test(Password::class)
        ->set('password', 'newpassword123')
        ->set('password_confirmation', 'differentpassword')
        ->call('updatePassword')
        ->assertHasErrors(['password']);

    // Password should NOT have changed
    $this->user->refresh();
    expect(Hash::check('password123', $this->user->password))->toBeTrue();
});

test('password component updates password in database when valid', function () {
    session(['auth.password_confirmed_at' => time()]);

    Livewire::actingAs($this->user)
        ->test(Password::class)
        ->set('password', 'newpassword123')
        ->set('password_confirmation', 'newpassword123')
        ->call('updatePassword')
        ->assertHasNoErrors()
        ->assertDispatched('toast');

    $this->user->refresh();
    expect(Hash::check('newpassword123', $this->user->password))->toBeTrue();
});

test('login history component renders sessions and terminates a session with password', function () {
    $otherSessionId = 'other_device_session_' . uniqid();
    DB::table('sessions')->insert([
        'id' => $otherSessionId,
        'user_id' => $this->user->id,
        'ip_address' => '10.0.0.1',
        'user_agent' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 17_0 like Mac OS X) AppleWebKit/605.1.15',
        'payload' => 'dummy_payload',
        'last_activity' => time() - 3600,
    ]);

    Livewire::actingAs($this->user)
        ->test(LoginHistory::class)
        ->assertSee('iPhone')
        ->call('confirmLogout', 'single', $otherSessionId)
        ->assertSet('confirmingLogout', true)
        ->set('password', 'wrong-password')
        ->call('executeLogout')
        ->assertHasErrors(['password'])
        ->set('password', 'password123')
        ->call('executeLogout')
        ->assertDispatched('toast');

    $exists = DB::table('sessions')->where('id', $otherSessionId)->exists();
    expect($exists)->toBeFalse();
});

test('delete user component validates password and deletes user account', function () {
    Livewire::actingAs($this->user)
        ->test(DeleteUser::class)
        ->call('confirmUserDeletion')
        ->assertSet('confirmingDeletion', true)
        ->set('password', 'wrong-pass')
        ->call('deleteUser')
        ->assertHasErrors(['password']);

    expect(User::find($this->user->id))->not->toBeNull();

    Livewire::actingAs($this->user)
        ->test(DeleteUser::class)
        ->set('password', 'password123')
        ->call('deleteUser')
        ->assertRedirect('/');

    expect(User::find($this->user->id))->toBeNull();
});

test('security settings page omits sessions section and uses uniform column widths', function () {
    $response = $this->actingAs($this->user)
        ->withSession([
            'auth.password_confirmed_at' => time(),
            'auth.confirmed_route' => 'docs.settings.security',
        ])
        ->get(route('docs.settings.security'))
        ->assertOk()
        ->assertDontSeeLivewire(LoginHistory::class)
        ->assertDontSee(__('vibe/settings.security.sessions_title'))
        ->assertDontSee(__('vibe/settings.login_history.all_sessions'))
        ->assertSee('xl:grid-cols-12', false)
        ->assertSee('xl:col-span-4', false)
        ->assertSee('xl:col-span-8', false)
        ->assertDontSee('gap-x-20', false);

    $html = $response->getContent();
    expect(substr_count($html, 'xl:grid-cols-12'))->toBeGreaterThanOrEqual(4);
});

test('login history settings page exclusively renders sessions section with uniform column widths', function () {
    $this->actingAs($this->user)
        ->withSession([
            'auth.password_confirmed_at' => time(),
        ])
        ->get(route('docs.settings.login-history'))
        ->assertOk()
        ->assertSeeLivewire(LoginHistory::class)
        ->assertSee(__('vibe/settings.security.sessions_title'))
        ->assertSee(__('vibe/settings.login_history.all_sessions'))
        ->assertSee('xl:grid-cols-12', false)
        ->assertSee('xl:col-span-4', false)
        ->assertSee('xl:col-span-8', false)
        ->assertDontSee('gap-x-20', false);
});

test('appearance settings page uses uniform column widths', function () {
    $response = $this->actingAs($this->user)
        ->get(route('docs.settings.appearance'))
        ->assertOk()
        ->assertSee('xl:grid-cols-12', false)
        ->assertSee('xl:col-span-4', false)
        ->assertSee('xl:col-span-8', false)
        ->assertDontSee('gap-x-20', false);

    $html = $response->getContent();
    expect(substr_count($html, 'xl:grid-cols-12'))->toBe(13);
});
