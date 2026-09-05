@blaze(fold: true)

@props([
    'id' => null,
    'saveToStorage' => false,
    'storageType' => 'session', // local, session
    'expireHours' => 24,
])

@if($saveToStorage && $id)
    @pushOnce('body', 'vibe-form')
        @vite(['resources/js/vibe/form.js'])
    @endPushOnce
@endif

<form 
    id="{{ $id }}"
    {{ $attributes->merge(['class' => '']) }}
    @if($saveToStorage && $id)
        x-data="typeof window.vibeForm === 'function' ? window.vibeForm('{{ $id }}', {{ $expireHours }}, '{{ $storageType }}') : {
            init() {
                var self = this;
                var bindForm = function() {
                    if (typeof window.vibeForm === 'function') {
                        Object.assign(self, window.vibeForm('{{ $id }}', {{ $expireHours }}, '{{ $storageType }}'));
                        self.init();
                    }
                };
                window.addEventListener('vibe-form-ready', bindForm, { once: true });
                var timer = setInterval(function() {
                    if (typeof window.vibeForm === 'function') {
                        clearInterval(timer);
                        bindForm();
                    }
                }, 40);
                setTimeout(function() { clearInterval(timer); }, 3000);
            },
            saveToStorage() {},
            clearStorage() {}
        }"
        @input.debounce.500ms="saveToStorage($el)"
        @submit="clearStorage()"
    @endif
>
    {{ $slot }}

</form>
