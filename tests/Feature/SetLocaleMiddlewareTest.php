<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Teknovate\VibeUi\Http\Middleware\SetLocale;

beforeEach(function () {
    app()->setLocale('id');
});

test('setlocale middleware alias is registered in router', function () {
    $router = app('router');
    $middleware = $router->getMiddleware();

    expect($middleware)->toHaveKey('setlocale');
    expect($middleware['setlocale'])->toBe(SetLocale::class);
});

test('setlocale middleware sets locale from session', function () {
    Route::get('/test-setlocale-session', function () {
        return response()->json(['locale' => app()->getLocale()]);
    })->middleware(['web', 'setlocale']);

    $response = $this->withSession(['locale' => 'en'])->get('/test-setlocale-session');

    $response->assertStatus(200);
    expect($response->json('locale'))->toBe('en');
    expect(app()->getLocale())->toBe('en');
});

test('setlocale middleware supports explicit parameter like setlocale:en', function () {
    Route::get('/test-setlocale-param', function () {
        return response()->json(['locale' => app()->getLocale()]);
    })->middleware(['web', 'setlocale:en']);

    $response = $this->get('/test-setlocale-param');

    $response->assertStatus(200);
    expect($response->json('locale'))->toBe('en');
});

test('setlocale middleware ignores unsupported locales', function () {
    Route::get('/test-setlocale-invalid', function () {
        return response()->json(['locale' => app()->getLocale()]);
    })->middleware(['web', 'setlocale']);

    app()->setLocale('id');

    $response = $this->withSession(['locale' => 'fr'])->get('/test-setlocale-invalid');

    $response->assertStatus(200);
    expect($response->json('locale'))->toBe('id');
});

test('locale switch endpoint updates session and sets locale', function () {
    $response = $this->get(route('locale.switch', ['locale' => 'en']));
    $response->assertSessionHas('locale', 'en');
});
