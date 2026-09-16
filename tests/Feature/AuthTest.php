<?php

use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;

uses(DatabaseTransactions::class);

test('login screen can be rendered in default card layout', function () {
    $response = $this->get('/login');

    $response->assertStatus(200);
    $response->assertSeeLivewire(Login::class);
});

test('login screen can be rendered in split layout', function () {
    $response = $this->get('/login?layout=split');

    $response->assertStatus(200);
    $response->assertSee('Next-Gen Blade UI Kit');
});

test('login screen can be rendered in simple layout', function () {
    $response = $this->get('/login?layout=simple');

    $response->assertStatus(200);
});

test('users can authenticate using email', function () {
    $user = User::factory()->create([
        'email' => 'testuser@example.com',
        'password' => Hash::make('password123'),
    ]);

    Livewire::test(Login::class)
        ->set('login', 'testuser@example.com')
        ->set('password', 'password123')
        ->call('authenticate')
        ->assertHasNoErrors()
        ->assertRedirect(route('docs.index'));

    $this->assertAuthenticatedAs($user);
});

test('users can authenticate using username when configured with array', function () {
    config(['vibe.auth.login_by' => ['email', 'username']]);

    $user = User::factory()->create([
        'username' => 'arrayuser',
        'password' => Hash::make('password123'),
    ]);

    Livewire::test(Login::class)
        ->set('login', 'arrayuser')
        ->set('password', 'password123')
        ->call('authenticate')
        ->assertHasNoErrors()
        ->assertRedirect(route('docs.index'));

    $this->assertAuthenticatedAs($user);
});

test('users can authenticate using phone when configured with array', function () {
    config(['vibe.auth.login_by' => ['email', 'username', 'phone']]);

    $user = User::factory()->create([
        'phone' => '08987654321',
        'password' => Hash::make('password123'),
    ]);

    Livewire::test(Login::class)
        ->set('login', '08987654321')
        ->set('password', 'password123')
        ->call('authenticate')
        ->assertHasNoErrors()
        ->assertRedirect(route('docs.index'));

    $this->assertAuthenticatedAs($user);
});

test('users can authenticate using username when configured with legacy string', function () {
    config(['vibe.auth.login_by' => 'email_or_username']);

    $user = User::factory()->create([
        'username' => 'customuser',
        'password' => Hash::make('password123'),
    ]);

    Livewire::test(Login::class)
        ->set('login', 'customuser')
        ->set('password', 'password123')
        ->call('authenticate')
        ->assertHasNoErrors()
        ->assertRedirect(route('docs.index'));

    $this->assertAuthenticatedAs($user);
});

test('users can authenticate using phone when configured with legacy any', function () {
    config(['vibe.auth.login_by' => 'any']);

    $user = User::factory()->create([
        'phone' => '081299887766',
        'password' => Hash::make('password123'),
    ]);

    Livewire::test(Login::class)
        ->set('login', '081299887766')
        ->set('password', 'password123')
        ->call('authenticate')
        ->assertHasNoErrors()
        ->assertRedirect(route('docs.index'));

    $this->assertAuthenticatedAs($user);
});

test('users can not authenticate with invalid password', function () {
    $user = User::factory()->create([
        'email' => 'wrongpass@example.com',
        'password' => Hash::make('password123'),
    ]);

    Livewire::test(Login::class)
        ->set('login', 'wrongpass@example.com')
        ->set('password', 'wrong-password')
        ->call('authenticate')
        ->assertHasErrors(['login']);

    $this->assertGuest();
});

test('register screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
    $response->assertSeeLivewire(Register::class);
});

test('new users can register', function () {
    Livewire::test(Register::class)
        ->set('name', 'Budi Santoso')
        ->set('username', 'budisantoso')
        ->set('email', 'budi@example.com')
        ->set('phone', '089912345678')
        ->set('password', 'password123')
        ->set('password_confirmation', 'password123')
        ->call('register')
        ->assertHasNoErrors()
        ->assertRedirect(route('docs.index'));

    $this->assertAuthenticated();
    $this->assertDatabaseHas('users', [
        'email' => 'budi@example.com',
        'username' => 'budisantoso',
    ]);
});

test('forgot password screen can be rendered', function () {
    $response = $this->get('/forgot-password');

    $response->assertStatus(200);
    $response->assertSeeLivewire(ForgotPassword::class);
});

test('auth documentation page is accessible', function () {
    $response = $this->get('/docs/auth/installation');

    $response->assertStatus(200);
    $response->assertSee('Instalasi Autentikasi');
});

test('passkey login options endpoint returns valid challenge', function () {
    $response = $this->getJson('/passkeys/login/options');

    $response->assertStatus(200);
    $response->assertJsonStructure(['options' => ['challenge']]);
});

test('authenticated users can get registration options for passkey with confirmed password', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)
        ->withSession(['auth.password_confirmed_at' => time()])
        ->getJson('/user/passkeys/options');

    $response->assertStatus(200);
    $response->assertJsonStructure(['options' => ['challenge', 'user']]);
});

test('login screen displays passkey login button and webauthn autocomplete', function () {
    $response = $this->get('/login');

    $response->assertStatus(200);
    $response->assertSee(__('auth/passkey.login_button'));
    $response->assertSee('autocomplete="username webauthn"', false);
});

test('auth screens render properly in indonesian locale', function () {
    app()->setLocale('id');

    $response = $this->get('/login');
    $response->assertStatus(200);
    $response->assertSee('Masuk ke Akun Anda');
    $response->assertSee('Masuk dengan Passkey');
    $response->assertSee('Kata Sandi');

    $registerResponse = $this->get('/register');
    $registerResponse->assertStatus(200);
    $registerResponse->assertSee('Buat Akun Baru');
    $registerResponse->assertSee('Nama Lengkap');
});

test('auth screens render properly in english locale', function () {
    app()->setLocale('en');

    $response = $this->get('/login');
    $response->assertStatus(200);
    $response->assertSee('Log in to your account');
    $response->assertSee('Sign in with Passkey');
    $response->assertSee('Password');

    $registerResponse = $this->get('/register');
    $registerResponse->assertStatus(200);
    $registerResponse->assertSee('Create an account');
    $registerResponse->assertSee('Full Name');
});

test('login redirects using route name when configured', function () {
    config(['vibe.auth.redirect_after_login' => 'docs.index']);

    $user = User::factory()->create([
        'email' => 'routeuser@example.com',
        'password' => Hash::make('password123'),
    ]);

    Livewire::test(Login::class)
        ->set('login', 'routeuser@example.com')
        ->set('password', 'password123')
        ->call('authenticate')
        ->assertHasNoErrors()
        ->assertRedirect(route('docs.index'));
});

test('login redirects using URL path when configured with path string', function () {
    config(['vibe.auth.redirect_after_login' => '/docs']);

    $user = User::factory()->create([
        'email' => 'pathuser@example.com',
        'password' => Hash::make('password123'),
    ]);

    Livewire::test(Login::class)
        ->set('login', 'pathuser@example.com')
        ->set('password', 'password123')
        ->call('authenticate')
        ->assertHasNoErrors()
        ->assertRedirect(url('/docs'));
});

test('login screen displays status card alert when session status is present', function () {
    $response = $this->withSession(['status' => 'Password reset successful'])
        ->get('/login');

    $response->assertStatus(200);
    $response->assertSee('Password reset successful');
});

test('login screen displays warning card alert with action when session warning is present', function () {
    $response = $this->withSession([
        'warning' => 'Development IP Notice',
        'localhost_url' => 'http://localhost:8000/login',
    ])->get('/login');

    $response->assertStatus(200);
    $response->assertSee('Development IP Notice');
    $response->assertSee('http://localhost:8000/login');
});

test('login screen displays error card alert when passkey error is present', function () {
    $response = $this->withSession(['error' => 'Biometric credential cancelled'])
        ->get('/login');

    $response->assertStatus(200);
    $response->assertSee('Biometric credential cancelled');
});

test('forgot password screen displays status card alert', function () {
    $response = $this->withSession(['status' => 'Reset link sent to your email'])
        ->get('/forgot-password');

    $response->assertStatus(200);
    $response->assertSee('Reset link sent to your email');
});

test('confirm password screen displays warning card alert on idle timeout', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)
        ->withSession(['status' => 'idle_timeout'])
        ->get('/confirm-password');

    $response->assertStatus(200);
    $response->assertSee(__('auth/messages.session_locked'));
});




