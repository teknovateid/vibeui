@blaze

@props([
    'id' => null,
    'ajax' => true,
    'saveToStorage' => false,
    'storageType' => 'session', // local, session
    'expireHours' => 24,
])

@pushOnce('head', 'vibe-form')
    @vite(['resources/js/vibe/form.js'])
@endPushOnce

<form 
    @if($id) id="{{ $id }}" @endif
    {{ $attributes->merge(['class' => '']) }}
    x-data="typeof window.vibeForm === 'function' ? window.vibeForm({
        id: '{{ $id }}',
        ajax: {{ $ajax ? 'true' : 'false' }},
        saveToStorage: {{ ($saveToStorage && $id) ? 'true' : 'false' }},
        storageType: '{{ $storageType }}',
        expireHours: {{ $expireHours }}
    }) : {
        loading: false,
        submitted: false,
        init() {
            var self = this;
            var bindForm = function() {
                if (typeof window.vibeForm === 'function') {
                    clearInterval(timer);
                    if (window.Alpine && typeof window.Alpine.initTree === 'function' && self.$el) {
                        var el = self.$el;
                        if (typeof window.Alpine.destroyTree === 'function') {
                            try { window.Alpine.destroyTree(el); } catch (e) {}
                        }
                        delete el._x_dataStack;
                        window.Alpine.initTree(el);
                    }
                }
            };
            window.addEventListener('vibe-form-ready', bindForm, { once: true });
            var timer = setInterval(function() {
                if (typeof window.vibeForm === 'function') {
                    bindForm();
                }
            }, 25);
            setTimeout(function() { clearInterval(timer); }, 3000);
        },
        handleSubmit(e) {
            if ({{ $ajax ? 'true' : 'false' }}) {
                e.preventDefault();
            }
        },
        saveToStorage() {},
        clearStorage() {}
    }"
    @submit="handleSubmit($event)"
    @if($saveToStorage && $id)
        @input.debounce.500ms="saveToStorage($el)"
    @endif
>
    {{ $slot }}

</form>
