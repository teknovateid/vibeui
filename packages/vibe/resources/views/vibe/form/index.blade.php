@props([
    'id' => null,
    'persist' => false,
    'expireInHours' => 24,
])

<form 
    {{ $attributes->merge(['class' => 'space-y-4']) }}
    @if($persist && $id)
        x-data="{
            formId: '{{ $id }}',
            expireHours: {{ $expireInHours }},
            
            init() {
                // 1. Restore data
                let saved = Alpine.store('vibeForms').get(this.formId);
                if (saved) {
                    // Timeout allows DOM (and Livewire) to be fully ready before dispatching events
                    setTimeout(() => {
                        Object.keys(saved).forEach(name => {
                            let el = this.$el.querySelector(`[name='${name}']`);
                            if (el && el.value !== saved[name]) {
                                el.value = saved[name];
                                // Trigger Alpine/Livewire models
                                el.dispatchEvent(new Event('input', { bubbles: true }));
                                el.dispatchEvent(new Event('change', { bubbles: true }));
                            }
                        });
                    }, 100);
                }
                
                // 2. Watch for changes
                this.$el.addEventListener('input', this.debounce(() => {
                    this.saveData();
                }, 500));
            },
            
            saveData() {
                let data = {};
                let formData = new FormData(this.$el);
                for (let [key, value] of formData.entries()) {
                    if (key !== '_token' && key !== '_method') {
                        data[key] = value;
                    }
                }
                Alpine.store('vibeForms').save(this.formId, data, this.expireHours);
            },

            clearData() {
                Alpine.store('vibeForms').clear(this.formId);
            },

            debounce(func, wait) {
                let timeout;
                return function executedFunction(...args) {
                    const later = () => {
                        clearTimeout(timeout);
                        func(...args);
                    };
                    clearTimeout(timeout);
                    timeout = setTimeout(later, wait);
                };
            }
        }"
        @submit="clearData"
    @endif
>
    {{ $slot }}
</form>
