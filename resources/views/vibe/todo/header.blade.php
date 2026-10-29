@blaze(fold: true)

@aware([
    'lock' => false,
    'locked' => false,
    'lockable' => false,
])

@props([
    'as' => 'div',
])

@php
    $resolvedLock = $attributes->has('lock') 
        ? filter_var($attributes->get('lock'), FILTER_VALIDATE_BOOLEAN) 
        : ($attributes->has('locked') 
            ? filter_var($attributes->get('locked'), FILTER_VALIDATE_BOOLEAN) 
            : (bool) ($lock || $locked));

    $resolvedLockable = $attributes->has('lockable')
        ? filter_var($attributes->get('lockable'), FILTER_VALIDATE_BOOLEAN)
        : (bool) $lockable;
@endphp

<div data-todo-header {{ $attributes->twMerge(['class' => 'flex items-center justify-between gap-2 pb-1.5 border-b border-border/40 w-full text-xs text-muted-foreground']) }}>
    @if ($resolvedLockable)
        <button
            type="button"
            draggable="false"
            data-todo-lock-btn
            aria-pressed="{{ $resolvedLock ? 'true' : 'false' }}"
            aria-label="{{ $resolvedLock ? 'Buka kunci kartu' : 'Kunci kartu' }}"
            title="{{ $resolvedLock ? 'Buka kunci kartu' : 'Kunci kartu' }}"
            @click.stop="typeof toggleLock === 'function' ? toggleLock($el.closest('[data-todo-item]')?.dataset?.id) : null"
            class="p-1 -ml-1 rounded-md transition-all cursor-pointer flex items-center justify-center shrink-0 {{ $resolvedLock ? 'text-amber-500 dark:text-amber-400' : 'text-muted-foreground opacity-60 hover:opacity-100 hover:text-foreground hover:bg-muted' }}"
        >
            <svg data-lock-icon-locked class="size-3.5 {{ $resolvedLock ? '' : 'hidden' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <rect width="18" height="11" x="3" y="11" rx="2" ry="2"/>
                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
            </svg>
            <svg data-lock-icon-unlocked class="size-3.5 {{ $resolvedLock ? 'hidden' : '' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <rect width="18" height="11" x="3" y="11" rx="2" ry="2"/>
                <path d="M7 11V7a5 5 0 0 1 9.9-1"/>
            </svg>
        </button>
    @elseif ($resolvedLock)
        <div data-todo-lock-indicator class="inline-flex items-center gap-1 text-muted-foreground/60 shrink-0" aria-label="Terkunci" title="Terkunci (tidak dapat dipindah)">
            <svg class="size-3.5 select-none pointer-events-none" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <rect width="18" height="11" x="3" y="11" rx="2" ry="2"/>
                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
            </svg>
        </div>
    @endif

    {{ $slot }}
</div>

