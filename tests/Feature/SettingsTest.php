<?php

use App\Livewire\Settings\DeleteUser;
use App\Livewire\Settings\LoginHistory;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;

uses(DatabaseTransactions::class);

beforeEach(function () {
    $this->user = User::factory()->create([
        'name' => 'John Doe',
        'email' => 'john.' . uniqid() . '@example.com',
        'username' => 'johndoe_' . uniqid(),
        'phone' => '0812' . rand(10000000, 99999999),
        'position' => 'Senior Developer',
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
        ->assertSeeLivewire(Profile::class);
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
        ->assertSee('headerCustomBg');
});

test('profile component updates user details in database', function () {
    Livewire::actingAs($this->user)
        ->test(Profile::class)
        ->assertSet('name', 'John Doe')
        ->assertSet('email', $this->user->email)
        ->set('name', 'John Updated')
        ->set('position', 'Engineering Lead')
        ->call('updateProfile')
        ->assertHasNoErrors()
        ->assertDispatched('toast');

    $this->user->refresh();

    expect($this->user->name)->toBe('John Updated');
    expect($this->user->position)->toBe('Engineering Lead');
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

test('login history component renders sessions and terminates a session', function () {
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
        ->call('terminateSession', $otherSessionId)
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
