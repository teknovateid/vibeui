<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Blade;

test('renders swipe component with default attributes', function () {
    $html = Blade::render('<vibe:swipe name="confirm_order" label="Slide to Pay" />');

    expect($html)
        ->toContain('data-vibe-swipe')
        ->toContain('name="confirm_order"')
        ->toContain('x-ref="hiddenInput"')
        ->toContain("value: '1'")
        ->toContain(':value="isConfirmed ? value : \'\'"')
        ->toContain(':tabindex="disabled || readonly ? -1 : 0"')
        ->toContain('Slide to Pay');
});

test('renders swipe component with type submit without duplicate form.requestSubmit call after triggerBtn.click', function () {
    $html = Blade::render('<vibe:swipe type="submit" label="Slide to Submit" />');

    expect($html)
        ->toContain('type="submit"')
        ->toContain('this.$nextTick(() => {')
        ->toContain('this.$refs.triggerBtn.click()')
        ->not->toContain("this.\$refs.triggerBtn.click();\n\n            // If submit button in form");
});

test('handles special characters and quotes in value prop safely with @js', function () {
    $html = Blade::render('<vibe:swipe name="order" value="John\'s & Special Order" />');

    expect($html)
        ->toContain('value: \'John\u0027s \u0026 Special Order\'')
        ->toContain(':value="isConfirmed ? value : \'\'"')
        ->not->toContain("value: 'John's");
});

test('renders loading label when loading prop is supplied', function () {
    $html = Blade::render('<vibe:swipe label="Slide to Pay" loadingLabel="Custom Processing..." />');

    expect($html)
        ->toContain('Custom Processing...')
        ->toContain('x-show="isLoading"');
});

