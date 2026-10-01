@blaze

@props([
    'id' => null,
    'ajax' => true,
    'saveToStorage' => false,
    'storageType' => 'session', // local, session
    'expireHours' => 24,
    'status' => 'toast',        // false | true | 'toast' | 'alert'
    'delay' => null,          // milliseconds (int|string), null = auto (1000ms if status active + has onSuccess/redirectTo)
    'redirectTo' => null,     // URL to redirect after successful submit
    'onSuccess' => null,      // JS expression executed after delay on success, e.g. "$vibe.sheet('id').close()"
    'onError' => null,        // JS expression executed on error
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
        expireHours: {{ $expireHours }},
        status: {{ $status ? (is_string($status) ? "'" . $status . "'" : 'true') : 'false' }},
        delay: {{ $delay !== null ? (int)$delay : 'null' }},
        redirectTo: {{ $redirectTo ? "'" . $redirectTo . "'" : 'null' }},
        onSuccess: {{ $onSuccess ? "'" . addslashes($onSuccess) . "'" : 'null' }},
        onError: {{ $onError ? "'" . addslashes($onError) . "'" : 'null' }}
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
        submit() {},
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
