@blaze

@props([
    'label' => null,
    'id' => null,
    'name' => null,
    'rows' => 3,
    'placeholder' => null,
    'size' => 'md', // sm, md, lg, xl
    'variant' => 'outline', // outline, filled, flush, ghost, accent
    'autoResize' => false,
    'showCount' => false,
    'maxlength' => null,
    'description' => null,
    'info' => null,
    'error' => null,
    'errorName' => null,
    'wrapperClass' => null,
])

@php
    $name = $name ?? $attributes->whereStartsWith('wire:model')->first();
    $id = $id ?? ($name ?? uniqid('textarea-'));
    $errorKey = $errorName ?? ($name ? str_replace(['[', ']'], ['.', ''], rtrim($name, ']')) : null);

    $hasError = !empty($error) || ($errorKey && $errors->has($errorKey));
    $errorMessage = ($error && !is_bool($error)) ? $error : ($errorKey ? $errors->first($errorKey) : null);

    $baseClasses = 'block w-full transition-colors duration-150 placeholder:text-muted-foreground focus-visible:outline-none disabled:pointer-events-none disabled:opacity-50 disabled:bg-muted/40 read-only:bg-muted/20 read-only:cursor-default';

    $sizeClasses = match ($size) {
        'sm' => 'text-xs rounded-md px-3 py-1.5',
        'lg' => 'text-sm rounded-lg px-4 py-2.5',
        'xl' => 'text-base rounded-xl px-5 py-3',
        default => 'text-sm rounded-lg px-3.5 py-2',
    };

    if ($variant === 'flush') {
        $sizeClasses = match ($size) {
            'sm' => 'text-xs px-0 py-1.5 rounded-none',
            'lg' => 'text-sm px-0 py-2.5 rounded-none',
            'xl' => 'text-base px-0 py-3 rounded-none',
            default => 'text-sm px-0 py-2 rounded-none',
        };
    }

    $variantClasses = match ($variant) {
        'filled' => $hasError 
            ? 'bg-destructive/10 border border-destructive text-destructive placeholder:text-destructive/50 focus-visible:bg-background focus-visible:border-destructive focus-visible:ring-2 focus-visible:ring-destructive/20' 
            : 'bg-muted/60 border border-transparent text-foreground hover:bg-muted/80 focus-visible:bg-background focus-visible:border-ring focus-visible:ring-2 focus-visible:ring-ring/20',
        'flush' => $hasError 
            ? 'border-b border-destructive text-destructive placeholder:text-destructive/50 bg-transparent focus-visible:border-destructive focus-visible:ring-0' 
            : 'border-b border-input text-foreground bg-transparent focus-visible:border-ring focus-visible:ring-0',
        'ghost' => $hasError 
            ? 'border-transparent text-destructive placeholder:text-destructive/50 bg-transparent focus-visible:ring-2 focus-visible:ring-destructive/20' 
            : 'border-transparent text-foreground bg-transparent hover:bg-muted/40 focus-visible:bg-transparent focus-visible:ring-2 focus-visible:ring-ring/20',
        'accent' => $hasError 
            ? 'bg-destructive/10 border border-destructive text-destructive placeholder:text-destructive/50 focus-visible:bg-background focus-visible:border-destructive focus-visible:ring-2 focus-visible:ring-destructive/20' 
            : 'bg-accent/15 border border-accent/40 text-foreground placeholder:text-muted-foreground hover:bg-accent/25 focus-visible:bg-background focus-visible:border-accent focus-visible:ring-2 focus-visible:ring-accent/25',
        default => $hasError 
            ? 'border border-destructive bg-background text-destructive placeholder:text-destructive/50 focus-visible:border-destructive focus-visible:ring-2 focus-visible:ring-destructive/20' 
            : 'border border-input bg-background text-foreground shadow-2xs focus-visible:border-ring focus-visible:ring-2 focus-visible:ring-ring/20',
    };

    $compiledClasses = trim("{$baseClasses} {$sizeClasses} {$variantClasses}");
@endphp

<div class="{{ $wrapperClass }}" x-data="{
    count: 0,
    init() {
        this.count = this.$refs.textarea ? this.$refs.textarea.value.length : 0;
        if ({{ $autoResize ? 'true' : 'false' }}) {
            this.$nextTick(() => this.resize());
        }
    },
    resize() {
        if (!{{ $autoResize ? 'true' : 'false' }}) return;
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
            rows="{{ $rows }}"
            @if($placeholder) placeholder="{{ $placeholder }}" @endif
            @if($maxlength) maxlength="{{ $maxlength }}" @endif
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
    @if ($hasError && $errorMessage)
        <p id="{{ $id }}-error" class="mt-1 text-xs text-destructive flex items-center gap-1">
            <svg class="size-3.5 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
            </svg>
            {{ $errorMessage }}
        </p>
    @elseif ($info)
        <p id="{{ $id }}-info" class="mt-1 text-xs text-muted-foreground">{{ $info }}</p>
    @endif
</div>
