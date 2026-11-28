@blaze

@props([
    'label' => null,
    'id' => null,
    'name' => null,
    'rows' => 3,
    'placeholder' => null,
    'size' => 'md', // xs, sm, md, lg, xl
    'variant' => 'primary', // primary, outline, filled, flush, ghost
    'autoResize' => false,
    'showCount' => false,
    'maxlength' => null,
    'description' => null,
    'info' => null,
    'error' => null,
    'errorName' => null,
    'wrapperClass' => null,
    'animation' => false,
])

@php
    $name = $name ?? $attributes->whereStartsWith('wire:model')->first();
    $id = $id ?? ($name ?? uniqid('textarea-'));
    $errorKey = $errorName ?? ($name ? str_replace(['[', ']'], ['.', ''], rtrim($name, ']')) : null);

    $hasError = !empty($error) || ($errorKey && $errors->has($errorKey));
    $errorMessage = ($error && !is_bool($error)) ? $error : ($errorKey ? $errors->first($errorKey) : null);

    $baseClasses = 'block w-full transition-colors duration-150 placeholder:text-muted-foreground focus-visible:outline-none disabled:pointer-events-none disabled:opacity-50 disabled:bg-muted/40 read-only:bg-muted/20 read-only:cursor-default';

    [$sizeTextPad, $sizeRadius] = match ($size) {
        'xs' => ['text-xs py-1.5', 'px-2.5 rounded-md'],
        'sm' => ['text-xs py-1.5', 'px-3 rounded-md'],
        'lg' => ['text-sm py-2.5', 'px-4 rounded-lg'],
        'xl' => ['text-base py-3', 'px-5 rounded-xl'],
        default => ['text-sm py-2', 'px-3.5 rounded-lg'],
    };

    $sizeClasses = $variant === 'flush'
        ? "{$sizeTextPad} px-0 rounded-none"
        : "{$sizeTextPad} {$sizeRadius}";

    $variantClasses = match ($variant) {
        'filled' => $hasError 
            ? 'bg-destructive/10 border border-destructive text-destructive placeholder:text-destructive/50 focus-visible:bg-background focus-visible:border-destructive focus-visible:ring-2 focus-visible:ring-destructive/20' 
            : 'bg-muted/60 border border-transparent text-foreground hover:bg-muted/80 focus-visible:bg-background focus-visible:border-primary focus-visible:ring-2 focus-visible:ring-primary/20',
        'flush' => $hasError 
            ? 'border-b border-destructive text-destructive placeholder:text-destructive/50 bg-transparent focus-visible:border-destructive focus-visible:ring-0' 
            : 'border-b border-input text-foreground bg-transparent focus-visible:border-primary focus-visible:ring-0',
        'ghost' => $hasError 
            ? 'border-transparent text-destructive placeholder:text-destructive/50 bg-transparent focus-visible:ring-2 focus-visible:ring-destructive/20' 
            : 'border-transparent text-foreground bg-transparent hover:bg-muted/40 focus-visible:bg-transparent focus-visible:ring-2 focus-visible:ring-primary/20',
        'outline' => $hasError 
            ? 'border border-destructive bg-background text-destructive placeholder:text-destructive/50 focus-visible:border-destructive focus-visible:ring-2 focus-visible:ring-destructive/20' 
            : 'border border-input bg-background text-foreground shadow-2xs focus-visible:border-ring focus-visible:ring-2 focus-visible:ring-ring/20',
        'primary' => $hasError 
            ? 'border border-destructive bg-background text-destructive placeholder:text-destructive/50 focus-visible:border-destructive focus-visible:ring-2 focus-visible:ring-destructive/20' 
            : 'border border-input bg-background text-foreground shadow-2xs focus-visible:border-primary focus-visible:ring-2 focus-visible:ring-primary/20',
        default => $hasError 
            ? 'border border-destructive bg-background text-destructive placeholder:text-destructive/50 focus-visible:border-destructive focus-visible:ring-2 focus-visible:ring-destructive/20' 
            : 'border border-input bg-background text-foreground shadow-2xs focus-visible:border-primary focus-visible:ring-2 focus-visible:ring-primary/20',
    };

    $animationClass = match ($animation) {
        true, 'auto' => ($hasError ? 'animate-vibe-shake' : ''),
        'shake' => 'animate-vibe-shake',
        'pop', 'bounce' => 'animate-vibe-pop',
        'pulse' => 'animate-vibe-pulse',
        'wobble' => 'animate-vibe-wobble',
        default => '',
    };

    $compiledClasses = trim("{$baseClasses} {$sizeClasses} {$variantClasses} {$animationClass}");

    $describedBy = [];
    if ($hasError && $errorMessage) {
        $describedBy[] = "{$id}-error";
    } elseif ($description) {
        $describedBy[] = "{$id}-description";
    }
    if ($info && !$hasError) {
        $describedBy[] = "{$id}-info";
    }
    $describedByString = !empty($describedBy) ? implode(' ', $describedBy) : null;
@endphp

<div {{ $attributes->only('class')->twMerge(['class' => trim("w-full {$wrapperClass}")]) }} x-data="{
    count: 0,
    supportsFieldSizing: typeof CSS !== 'undefined' && typeof CSS.supports === 'function' && CSS.supports('field-sizing', 'content'),
    init() {
        this.count = this.$refs.textarea ? this.$refs.textarea.value.length : 0;
        if ({{ $autoResize ? 'true' : 'false' }}) {
            this.$nextTick(() => this.resize());
        }
    },
    resize() {
        if (!{{ $autoResize ? 'true' : 'false' }} || this.supportsFieldSizing) return;
        this.$refs.textarea.style.height = 'auto';
        this.$refs.textarea.style.height = (this.$refs.textarea.scrollHeight + 2) + 'px';
    }
}">
    {{-- Top Label & Character Counter --}}
    @if ($label || ($showCount && $maxlength))
        <div class="flex items-center justify-between mb-1.5 select-none">
            @if ($label)
                <label for="{{ $id }}" class="block text-xs font-semibold text-foreground">
                    {{ $label }}
                    @if ($attributes->has('required') && $attributes->get('required') !== false)
                        <span class="text-destructive font-bold ml-0.5" aria-hidden="true">*</span>
                    @endif
                </label>
            @endif

            @if ($showCount && $maxlength)
                <span class="text-[11px] font-mono text-muted-foreground ml-auto" id="{{ $id }}-counter">
                    <span x-text="count">0</span>/{{ $maxlength }}
                </span>
            @endif
        </div>
    @endif

    @if ($description)
        <p id="{{ $id }}-description" class="mb-1.5 text-xs text-muted-foreground">{{ $description }}</p>
    @endif

    <div class="relative">
        <textarea
            x-ref="textarea"
            id="{{ $id }}"
            @if($name) name="{{ $name }}" @endif
            data-error="{{ $id }}-error"
            rows="{{ $rows }}"
            @if($placeholder) placeholder="{{ $placeholder }}" @endif
            @if($maxlength) maxlength="{{ $maxlength }}" @endif
            @if($hasError) aria-invalid="true" data-vibe-server-invalid="true" @else aria-invalid="false" @endif
            @if($describedByString) aria-describedby="{{ $describedByString }}" @endif
            @if($autoResize) style="field-sizing: content;" @endif
            @input="count = $event.target.value.length; resize();"
            {{ $attributes->twMerge(['class' => $compiledClasses . ($autoResize ? ' overflow-hidden resize-none' : '')]) }}
        >{{ $slot }}</textarea>

        {{-- Bottom Counter if no top label was present --}}
        @if ($showCount && $maxlength && !$label)
            <div class="flex justify-end mt-1">
                <span class="text-[11px] font-mono text-muted-foreground">
                    <span x-text="count">0</span>/{{ $maxlength }}
                </span>
            </div>
        @endif
    </div>

    {{-- Error Message / Info --}}
    <vibe:partials.field-message :id="$id" :hasError="$hasError" :errorMessage="$errorMessage" :info="$info" marginClass="mt-1" />
</div>
