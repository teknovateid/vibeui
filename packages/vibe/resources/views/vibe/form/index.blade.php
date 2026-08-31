@blaze(fold: true)

@props([
    'id' => null,
    'saveToStorage' => false,
    'storageType' => 'session', // local, session
    'expireHours' => 24,
])

<form 
    id="{{ $id }}"
    {{ $attributes->merge(['class' => '']) }}
    @if($saveToStorage && $id)
        x-data="vibeForm('{{ $id }}', {{ $expireHours }}, '{{ $storageType }}')"
        @input.debounce.500ms="saveToStorage($el)"
        @submit="clearStorage()"
    @endif
>
    {{ $slot }}

    @if($saveToStorage && $id)
        <script>
            document.addEventListener('alpine:init', () => {
                if (!window.Alpine.data('vibeForm')) {
                    window.Alpine.data('vibeForm', (formId, expireHours, storageType) => ({
                        storageKey: (window.VIBE_PREFIX || 'vibe') + '-form',
                        
                        getStorageEngine() {
                            return storageType === 'session' ? window.sessionStorage : window.localStorage;
                        },

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
                                return JSON.parse(this.getStorageEngine().getItem(this.storageKey)) || [];
                            } catch (e) {
                                return [];
                            }
                        },
                        
                        setStorageData(data) {
                            this.getStorageEngine().setItem(this.storageKey, JSON.stringify(data));
                        },
                        
                        saveToStorage(formEl) {
                            // Extract form data
                            const formData = new FormData(formEl);
                            const dataObj = {};
                            
                            // Don't save livewire internal fields
                            for (let [key, value] of formData.entries()) {
                                // Skip files, livewire internals, csrf
                                if (value instanceof File || key.startsWith('_') || key === 'components') continue;
                                dataObj[key] = value;
                            }
                            
                            if (Object.keys(dataObj).length === 0) return;
                            
                            let storageArray = this.getStorageData();
                            const existingIndex = storageArray.findIndex(item => item.id === formId);
                            
                            const expirationDate = new Date();
                            expirationDate.setHours(expirationDate.getHours() + expireHours);
                            
                            const newItem = {
                                id: formId,
                                data: dataObj,
                                expiredAt: expirationDate.getTime()
                            };
                            
                            if (existingIndex > -1) {
                                storageArray[existingIndex] = newItem;
                            } else {
                                storageArray.push(newItem);
                            }
                            
                            this.setStorageData(storageArray);
                        },
                        
                        restoreFromStorage() {
                            let storageArray = this.getStorageData();
                            const now = new Date().getTime();
                            
                            // Clean up expired items globally while we are at it
                            let cleanedArray = storageArray.filter(item => item.expiredAt && item.expiredAt > now);
                            if (cleanedArray.length !== storageArray.length) {
                                this.setStorageData(cleanedArray);
                                storageArray = cleanedArray;
                            }
                            
                            const myData = storageArray.find(item => item.id === formId);
                            
                            if (myData && myData.data) {
                                setTimeout(() => {
                                    Object.entries(myData.data).forEach(([key, value]) => {
                                        // Handle input arrays e.g. name="hobbies[]"
                                        const inputName = key.endsWith('[]') ? key : key;
                                        const input = this.$el.querySelector(`[name="${inputName}"]`);
                                        
                                        if (input && input.value !== value) {
                                            input.value = value;
                                            input.dispatchEvent(new Event('input', { bubbles: true }));
                                        }
                                    });
                                }, 50);
                            }
                        },
                        
                        clearStorage() {
                            let storageArray = this.getStorageData();
                            storageArray = storageArray.filter(item => item.id !== formId);
                            this.setStorageData(storageArray);
                        }
                    }));
                }
            });
        </script>
    @endif
</form>
