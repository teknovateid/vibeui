@props([
    'id' => null,
    'remember' => false, 
    'dismissible' => true,
    'show' => false,
])

@php
    $modalId = $id ?? uniqid('modal-');
@endphp

<div 
    x-data="{ 
        open: {{ $show ? 'true' : 'false' }},
        modalId: '{{ $modalId }}',
        isRemember: {{ $remember ? 'true' : 'false' }},
        
        init() {
            if (this.isRemember && this.modalId) {
                if (Alpine.store('vibeModals').isDismissed(this.modalId)) {
                    this.open = false;
                }
            }
        },
        
        close() {
            this.open = false;
            if (this.isRemember && this.modalId) {
                Alpine.store('vibeModals').dismiss(this.modalId);
            }
        }
    }"
    x-show="open"
    @open-modal.window="if ($event.detail === modalId) open = true"
    @close-modal.window="if ($event.detail === modalId) close()"
    class="fixed inset-0 z-50 overflow-y-auto"
    aria-labelledby="modal-title" 
    role="dialog" 
    aria-modal="true"
    style="display: none;"
>
    <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div x-show="open" x-transition.opacity class="fixed inset-0 transition-opacity bg-gray-500/75 dark:bg-gray-900/80" aria-hidden="true" @if($dismissible) @click="close" @endif></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div x-show="open" 
            x-transition:enter="ease-out duration-300" 
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
            x-transition:leave="ease-in duration-200" 
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
            class="relative inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white dark:bg-vibe-900 rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6"
        >
            <div class="absolute top-0 right-0 hidden pt-4 pr-4 sm:block">
                @if($dismissible)
                <button @click="close" type="button" class="text-gray-400 bg-white dark:bg-vibe-900 rounded-md hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <span class="sr-only">Close</span>
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                @endif
            </div>
            
            {{ $slot }}
        </div>
    </div>
</div>
