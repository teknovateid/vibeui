@blaze

@aware([
    'editable' => false,
])

@props([
    'as' => 'p',
])

@php
    $isEditable = $attributes->has('editable') 
        ? filter_var($attributes->get('editable'), FILTER_VALIDATE_BOOLEAN) 
        : (bool) $editable;
        
    $initialValue = trim((string) $slot);
@endphp

@if (! $isEditable)
    <{{ $as }} data-todo-description {{ $attributes->twMerge(['class' => 'text-xs text-muted-foreground leading-normal']) }}>
        {{ $slot }}
    </{{ $as }}>
@else
    <div 
        x-data="{
            editing: false,
            value: @js($initialValue),
            previousValue: @js($initialValue),
            startEdit() {
                this.previousValue = this.value;
                this.editing = true;
                this.$nextTick(() => {
                    const input = this.$refs.descInput;
                    if (input) { input.focus(); input.select(); }
                });
            },
            saveEdit() {
                if (!this.editing) return;
                this.editing = false;
                const clean = (this.value || '').trim();
                this.value = clean;
                this.$dispatch('vibe:todo-description-changed', { value: clean });
                const itemEl = this.$el.closest('[data-todo-item]');
                const itemId = itemEl?.dataset?.todoItem || itemEl?.dataset?.id;
                if (itemId) {
                    this.$dispatch('vibe:todo-item-update', { id: itemId, itemId: itemId, description: clean });
                    const rootEl = this.$el.closest('[data-vibe-todo]');
                    if (rootEl && rootEl._x_dataStack) {
                        for (let i = rootEl._x_dataStack.length - 1; i >= 0; i--) {
                            if (typeof rootEl._x_dataStack[i].updateItem === 'function') {
                                rootEl._x_dataStack[i].updateItem(itemId, { description: clean });
                                break;
                            }
                        }
                    }
                }
            },
            cancelEdit() {
                this.editing = false;
                this.value = this.previousValue;
            }
        }"
        class="group/desc relative min-w-0"
    >
        {{-- Normal view --}}
        <div 
            x-show="!editing" 
            @dblclick.stop="startEdit()"
            class="flex items-center gap-1.5 min-w-0"
        >
            <{{ $as }} 
                data-todo-description 
                x-text="value"
                {{ $attributes->twMerge(['class' => 'text-xs text-muted-foreground leading-normal cursor-text']) }}
            >
                {{ $slot }}
            </{{ $as }}>

            <button 
                type="button" 
                @click.stop="startEdit()" 
                title="Ubah deskripsi"
                aria-label="Ubah deskripsi"
                class="hidden group-hover:inline-flex group-hover/desc:inline-flex p-0.5 rounded text-muted-foreground/50 hover:text-foreground transition-all shrink-0 cursor-pointer"
            >
                <svg class="size-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 20h9"/>
                    <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/>
                </svg>
            </button>
        </div>

        {{-- Edit Form --}}
        <div 
            x-show="editing" 
            x-cloak 
            @click.stop 
            @mousedown.stop 
            @dragstart.stop.prevent
            @click.outside="saveEdit()"
            class="flex items-center gap-1.5 w-full pt-0.5"
        >
            <input 
                x-ref="descInput"
                type="text" 
                x-model="value" 
                @keydown.enter.prevent="saveEdit()" 
                @keydown.escape.prevent="cancelEdit()" 
                class="text-xs bg-background border border-primary/50 focus:border-primary focus:ring-2 focus:ring-primary/20 rounded-md px-2 py-0.5 w-full outline-none shadow-xs text-foreground transition-all"
                placeholder="Rincian deskripsi..."
            />
            <button 
                type="button" 
                @click.stop="saveEdit()" 
                class="px-2 py-0.5 text-xs font-semibold rounded bg-primary text-primary-foreground hover:bg-primary/90 transition-all cursor-pointer shadow-xs shrink-0"
            >
                Simpan
            </button>
            <button 
                type="button" 
                @click.stop="cancelEdit()" 
                class="px-2 py-0.5 text-xs font-medium rounded hover:bg-muted text-muted-foreground hover:text-foreground transition-all cursor-pointer shrink-0"
            >
                Batal
            </button>
        </div>
    </div>
@endif
