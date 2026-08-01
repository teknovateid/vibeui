@blaze
@props([
    'id' => null,
    'saveToStorage' => false,
    'expireHours' => 24,
])

<form 
    id="{{ $id }}"
    {{ $attributes->merge(['class' => '']) }}
    @if($saveToStorage && $id)
        x-data="vibeForm('{{ $id }}', {{ $expireHours }})"
        @input.debounce.500ms="saveToStorage($el)"
        @submit="clearStorage()"
    @endif
>
    {{ $slot }}

    @if($saveToStorage && $id)
        @pushOnce('body')
        <script>
            document.addEventListener('alpine:init', () => {
                if (!window.Alpine.data('vibeForm')) {
                    window.Alpine.data('vibeForm', (formId, expireHours) => ({
                        storageKey: (window.VIBE_PREFIX || 'vibe') + '-form',
                        
                        init() {
                            this.restoreFromStorage();
                            
                            // Re-restore data when a sheet or modal opens, 
                            // to override Livewire's $this->reset() if the form is inside them
                            window.addEventListener('open-sheet', () => {
                                setTimeout(() => this.restoreFromStorage(), 100);
                            });
                            window.addEventListener('open-modal', () => {
                                setTimeout(() => this.restoreFromStorage(), 100);
                            });
                        },
                        
                        getStorageData() {
                            try {
                                return JSON.parse(localStorage.getItem(this.storageKey)) || [];
                            } catch (e) {
                                return [];
                            }
                        },
                        
                        saveToStorage(el) {
                            if (!formId) return;
                            
                            const formData = new FormData(el);
                            const data = Object.fromEntries(formData.entries());
                            
                            // Remove empty or specific Livewire payload fields
                            delete data['_token'];
                            for (let key in data) {
                                if (key.startsWith('components.') || key.startsWith('serverMemo.')) {
                                    delete data[key];
                                }
                            }
                            
                            const now = new Date().getTime();
                            const expireMs = expireHours * 60 * 60 * 1000;
                            
                            let storageData = this.getStorageData();
                            if (!Array.isArray(storageData)) storageData = [];
                            
                            const index = storageData.findIndex(item => item.id === formId);
                            const newItem = {
                                id: formId,
                                data: data,
                                expiry: now + expireMs
                            };
                            
                            if (index !== -1) {
                                storageData[index] = newItem;
                            } else {
                                storageData.push(newItem);
                            }
                            
                            // Cleanup expired items
                            storageData = storageData.filter(item => item.expiry > now);
                            
                            localStorage.setItem(this.storageKey, JSON.stringify(storageData));
                        },
                        
                        restoreFromStorage() {
                            if (!formId) return;
                            
                            const storageData = this.getStorageData();
                            if (!Array.isArray(storageData)) return;
                            
                            const item = storageData.find(item => item.id === formId);
                            
                            if (item && item.expiry > new Date().getTime()) {
                                const data = item.data;
                                // Loop through elements and dispatch input event so Livewire picks it up
                                for (let key in data) {
                                    let el = document.querySelector(`form#${formId} [name="${key}"]`);
                                    if (!el) {
                                        el = document.querySelector(`form#${formId} [wire\\:model="${key}"]`);
                                    }
                                    if (el) {
                                        if (el.type === 'checkbox' || el.type === 'radio') {
                                            el.checked = data[key] === 'on' || data[key] === el.value;
                                            el.dispatchEvent(new Event('change', { bubbles: true }));
                                        } else {
                                            el.value = data[key];
                                            el.dispatchEvent(new Event('input', { bubbles: true }));
                                        }
                                    }
                                }
                            } else if (item) {
                                // Item expired, clean it up
                                this.clearStorage();
                            }
                        },
                        
                        clearStorage() {
                            if (!formId) return;
                            
                            let storageData = this.getStorageData();
                            if (Array.isArray(storageData)) {
                                storageData = storageData.filter(item => item.id !== formId);
                                localStorage.setItem(this.storageKey, JSON.stringify(storageData));
                            }
                        }
                    }));
                }
            });
        </script>
        @endPushOnce
    @endif
</form>
