@blaze(fold: true)

@props([
    'placeholder' => 'Tambah tugas baru... (tekan Enter)',
    'group' => null,
    'buttonText' => 'Tambah',
])

<div 
    x-data="{
        newTitle: '',
        submitAdd() {
            const val = (this.newTitle || '').trim();
            if (!val) return;
            if (typeof add === 'function') {
                add(val, '{{ $group }}');
            } else {
                const todoEl = this.$el.closest('[data-vibe-todo]') || document.querySelector('[data-vibe-todo]');
                if (todoEl && todoEl._x_dataStack && todoEl._x_dataStack[0] && typeof todoEl._x_dataStack[0].add === 'function') {
                    todoEl._x_dataStack[0].add(val, '{{ $group }}');
                } else if (todoEl) {
                    todoEl.dispatchEvent(new CustomEvent('vibe:todo-add', { bubbles: true, detail: { title: val, group: '{{ $group }}' } }));
                }
            }
            this.newTitle = '';
        }
    }"
    {{ $attributes->twMerge(['class' => 'relative flex items-center gap-2 w-full']) }}
>
    <div class="relative flex-1">
        <input
            type="text"
            x-model="newTitle"
            @keydown.enter.prevent="submitAdd()"
            @keydown.escape="newTitle = ''"
            placeholder="{{ $placeholder }}"
            class="w-full h-10 px-3.5 pr-10 text-sm rounded-xl border border-input bg-background text-foreground placeholder:text-muted-foreground transition-all duration-150 focus:outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary"
        />

        {{-- Enter Icon Indicator --}}
        <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-muted-foreground/50">
            <kbd class="hidden sm:inline-flex items-center gap-0.5 text-[10px] font-mono bg-muted px-1.5 py-0.5 rounded border border-border">↵</kbd>
        </div>
    </div>

    <vibe:button 
        type="button"
        size="md"
        @click="submitAdd()"
        class="shrink-0 rounded-xl"
        ::disabled="!newTitle || !newTitle.trim()"
    >
        <svg class="size-4 mr-1.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="12" y1="5" x2="12" y2="19"></line>
            <line x1="5" y1="12" x2="19" y2="12"></line>
        </svg>
        {{ $buttonText }}
    </vibe:button>
</div>
