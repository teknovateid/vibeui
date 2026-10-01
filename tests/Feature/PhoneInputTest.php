<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Blade;
use Livewire\Component;
use Livewire\Livewire;

test('renders phone input with default formatted mode without hidden input', function () {
    $html = Blade::render('<vibe:input.phone name="phone" value="081234567890" />');

    expect($html)
        ->toContain('name="phone"')
        ->toContain('cleanMode: false')
        ->not->toContain('type="hidden"');
});

test('renders phone input with clean mode rendering hidden input for clean digits', function () {
    $html = Blade::render('<vibe:input.phone name="phone" value="081234567890" clean />');

    expect($html)
        ->toContain('cleanMode: true')
        ->toContain('withPrefix: true')
        ->toContain('id="phone-display"')
        ->toContain('type="hidden"')
        ->toContain('id="phone"')
        ->toContain('value="6281234567890"');
});

test('renders phone input with clean mode and cleanPrefix false for local format', function () {
    $html = Blade::render('<vibe:input.phone name="phone" value="+62 812-3456-7890" clean :clean-prefix="false" />');

    expect($html)
        ->toContain('cleanMode: true')
        ->toContain('withPrefix: false')
        ->toContain('type="hidden"')
        ->toContain('value="081234567890"');
});

test('renders phone input with clean="local" string shorthand', function () {
    $html = Blade::render('<vibe:input.phone name="phone" value="6281234567890" clean="local" />');

    expect($html)
        ->toContain('cleanMode: true')
        ->toContain('withPrefix: false')
        ->toContain('type="hidden"')
        ->toContain('value="081234567890"');
});

class PhoneInputLivewireTestComponent extends Component
{
    public string $phone = '628987654321';

    public function render(): string
    {
        return <<<'BLADE'
<div>
    <vibe:input.phone wire:model="phone" clean label="Phone Number" />
</div>
BLADE;
    }
}

test('phone input integrates with Livewire component wire:model in clean mode', function () {
    Livewire::test(PhoneInputLivewireTestComponent::class)
        ->assertSee('cleanMode: true')
        ->assertSee('phoneVal: \'628987654321\'', false)
        ->assertSee('value="628987654321"', false)
        ->assertSee('wire:model="phone"', false);
});
