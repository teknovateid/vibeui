@blaze

@props([
    'id' => null,
    'hasError' => false,
    'errorMessage' => null,
    'info' => null,
    'marginClass' => 'mt-1.5',
    'errorBindId' => null,
    'infoBindId' => null,
])

@if ($hasError && $errorMessage)
    <p
        @if($errorBindId) :id="{{ $errorBindId }}" @elseif($id) id="{{ $id }}-error" @endif
        role="alert"
        class="{{ $marginClass }} text-xs font-medium text-destructive flex items-center gap-1"
    >
        <svg class="size-3.5 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10" />
            <path d="M12 8v5M12 16h.01" />
        </svg>
        <span>{{ $errorMessage }}</span>
    </p>
@elseif ($info)
    <p
        @if($infoBindId) :id="{{ $infoBindId }}" @elseif($id) id="{{ $id }}-info" @endif
        class="{{ $marginClass }} text-xs text-muted-foreground"
    >{{ $info }}</p>
@endif
