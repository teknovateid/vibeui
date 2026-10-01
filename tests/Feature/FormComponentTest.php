<?php

use Illuminate\Support\Facades\Blade;

test('vibe:form renders with auto confirm password modal by default', function () {
    $html = Blade::render(
        '<vibe:form id="test-form" action="/test">Fields</vibe:form>'
    );

    expect($html)
        ->toContain('confirmPassword: true')
        ->toContain('showConfirmPasswordModal')
        ->toContain('x-teleport="body"')
        ->toContain('submitConfirmPassword()')
        ->toContain('closeConfirmPasswordModal()')
        ->toContain('confirmPasswordInput');
});

test('vibe:form disables confirm password modal when confirmPassword is false', function () {
    $html = Blade::render(
        '<vibe:form id="test-form" action="/test" :confirm-password="false">Fields</vibe:form>'
    );

    expect($html)
        ->toContain('confirmPassword: false')
        ->not->toContain('x-teleport="body"')
        ->not->toContain('Konfirmasi Kata Sandi');
});

test('vibe:form disables confirm password modal when ajax is false', function () {
    $html = Blade::render(
        '<vibe:form id="test-form" action="/test" :ajax="false">Fields</vibe:form>'
    );

    expect($html)
        ->toContain('ajax: false')
        ->not->toContain('x-teleport="body"')
        ->not->toContain('Konfirmasi Kata Sandi');
});

test('vibe:form accepts custom confirm password url', function () {
    $html = Blade::render(
        '<vibe:form id="test-form" action="/test" confirm-password-url="/custom-confirm">Fields</vibe:form>'
    );

    expect($html)
        ->toContain("confirmPasswordUrl: '/custom-confirm'");
});
