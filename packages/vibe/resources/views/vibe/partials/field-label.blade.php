@blaze

@props([
    'for' => null,
    'label' => null,
    'required' => false,
    'description' => null,
    'descriptionId' => null,
    'labelClass' => 'block text-xs font-semibold text-foreground mb-1.5 select-none',
    'descriptionClass' => 'mb-1.5 text-xs text-muted-foreground',
])

@if ($label)
    <label @if($for) for="{{ $for }}" @endif {{ $attributes->merge(['class' => $labelClass]) }}>
        {{ $label }}
        @if ($required)
            <span class="text-destructive font-bold ml-0.5" aria-hidden="true">*</span>
        @endif
    </label>
@endif

@if ($description)
    <p @if($descriptionId) id="{{ $descriptionId }}" @endif class="{{ $descriptionClass }}">{{ $description }}</p>
@endif
