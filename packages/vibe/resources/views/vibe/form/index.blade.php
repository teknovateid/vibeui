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
    'confirmPassword' => true, // Auto show confirm password modal on HTTP 423
    'confirmPasswordUrl' => null,
    'locale' => null,
])

@php
    $confirmPasswordPostUrl = $confirmPasswordUrl ?: (Route::has('password.confirm.post') ? route('password.confirm.post') : '/confirm-password');

    $resolvedLocale = $locale ?? app()->getLocale();
    $rawTranslations = trans('vibe/form', [], $resolvedLocale);
    if (!is_array($rawTranslations)) {
        $rawTranslations = trans('vibe::vibe/form', [], $resolvedLocale);
    }
    $i18n = is_array($rawTranslations) ? $rawTranslations : [];
@endphp

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
        onError: {{ $onError ? "'" . addslashes($onError) . "'" : 'null' }},
        confirmPassword: {{ $confirmPassword ? 'true' : 'false' }},
        confirmPasswordUrl: '{{ $confirmPasswordPostUrl }}',
        i18n: {{ \Illuminate\Support\Js::from($i18n) }}
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
        handleKeydownEnter(e) {},
        saveToStorage() {},
        clearStorage() {},
        showConfirmPasswordModal: false,
        confirmPasswordInput: '',
        confirmPasswordLoading: false,
        confirmPasswordError: null,
        showConfirmPasswordText: false,
        submitConfirmPassword() {},
        closeConfirmPasswordModal() {}
    }"
    @submit="handleSubmit($event)"
    @keydown.enter="handleKeydownEnter($event)"
    @if($saveToStorage && $id)
        @input.debounce.500ms="saveToStorage($el)"
    @endif
>
    {{ $slot }}

    @if($confirmPassword && $ajax)
        <template x-teleport="body">
            <div x-show="showConfirmPasswordModal" x-cloak class="fixed inset-0 z-60 overflow-y-auto" role="dialog" aria-modal="true" style="display: none;">
                <div class="flex justify-center min-h-screen p-4 text-center items-center">
                    {{-- Backdrop --}}
                    <div x-show="showConfirmPasswordModal" x-transition.opacity class="fixed inset-0 bg-black/60 backdrop-blur-xs" @click="closeConfirmPasswordModal()"></div>

                    {{-- Modal Card --}}
                    <div x-show="showConfirmPasswordModal" 
                         x-transition:enter="ease-out duration-300"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="ease-in duration-200"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         @keydown.escape.window="if (showConfirmPasswordModal) closeConfirmPasswordModal()"
                         class="relative w-full max-w-md p-6 overflow-hidden text-left bg-card text-card-foreground border border-border rounded-2xl shadow-2xl space-y-4">
                        
                        <div class="flex items-start gap-3">
                            <div class="p-2.5 rounded-xl bg-primary/10 text-primary shrink-0">
                                <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M2 16c0-2.828 0-4.243.879-5.121C3.757 10 5.172 10 8 10h8c2.828 0 4.243 0 5.121.879C22 11.757 22 13.172 22 16c0 2.828 0 4.243-.879 5.121C20.243 22 18.828 22 16 22H8c-2.828 0-4.243 0-5.121-.879C2 20.243 2 18.828 2 16Z" />
                                    <circle cx="12" cy="16" r="2" />
                                    <path d="M6 10V8a6 6 0 1 1 12 0v2" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-foreground">{{ $i18n['confirm_password'] ?? 'Konfirmasi Kata Sandi' }}</h4>
                                <p class="text-xs text-muted-foreground mt-0.5">{{ $i18n['confirm_password_description'] ?? 'Ini adalah area aman aplikasi. Harap konfirmasi kata sandi Anda sebelum melanjutkan.' }}</p>
                            </div>
                        </div>

                        <div class="space-y-3 pt-1">
                            <template x-if="confirmPasswordError">
                                <div class="p-2.5 rounded-lg bg-destructive/10 text-destructive text-xs border border-destructive/20 font-medium" x-text="confirmPasswordError"></div>
                            </template>

                            <div class="space-y-1">
                                <label class="text-xs font-semibold text-foreground">{{ $i18n['password'] ?? 'Kata Sandi' }}</label>
                                <div class="relative">
                                    <input 
                                        :type="showConfirmPasswordText ? 'text' : 'password'" 
                                        x-model="confirmPasswordInput" 
                                        x-ref="confirmPasswordInputRef"
                                        @keydown.enter.prevent.stop="submitConfirmPassword()"
                                        placeholder="{{ $i18n['password_placeholder'] ?? '••••••••' }}" 
                                        class="w-full px-3 py-2 pr-9 text-xs rounded-lg border border-input bg-background text-foreground shadow-2xs focus:ring-1 focus:ring-primary focus:outline-none" 
                                    />
                                    <button type="button" @click="showConfirmPasswordText = !showConfirmPasswordText" class="absolute right-2.5 top-1/2 -translate-y-1/2 text-muted-foreground hover:text-foreground cursor-pointer" tabindex="-1">
                                        <svg x-show="!showConfirmPasswordText" class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3.275 15.296C2.425 14.192 2 13.639 2 12c0-1.639.425-2.192 1.275-3.296C4.972 6.5 7.818 4 12 4s7.028 2.5 8.725 4.704C21.575 9.808 22 10.36 22 12c0 1.639-.425 2.192-1.275 3.296C19.028 17.5 16.182 20 12 20s-7.028-2.5-8.725-4.704Z"/><circle cx="12" cy="12" r="3"/></svg>
                                        <svg x-show="showConfirmPasswordText" x-cloak class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 14C5 14 2 7 2 7M22 7C22 7 21.059 9.197 19 11.129c-.913.857-2.045 1.662-3.413 2.2a9.7 9.7 0 0 1-3.587.671m0 0V16.5m3.587-3.171L17 15.5m2-4.371L20.5 12.63M8.413 13.329L7 15.5M5 11.129 3.5 12.63"/></svg>
                                    </button>
                                </div>
                            </div>

                            <div class="flex items-center justify-end gap-2 pt-2">
                                <button type="button" @click="closeConfirmPasswordModal()" class="px-3 py-1.5 text-xs font-medium rounded-lg border border-border hover:bg-muted cursor-pointer transition-colors">
                                    {{ $i18n['cancel'] ?? 'Batal' }}
                                </button>
                                <button type="button" @click="submitConfirmPassword()" :disabled="confirmPasswordLoading" class="px-3.5 py-1.5 text-xs font-semibold rounded-lg bg-primary text-primary-foreground hover:bg-primary/90 cursor-pointer transition-colors inline-flex items-center gap-1.5 disabled:opacity-50">
                                    <svg x-show="confirmPasswordLoading" class="size-3 animate-spin" viewBox="0 0 24 24" fill="none" stroke="currentColor"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                    <span x-text="confirmPasswordLoading ? '{{ addslashes($i18n['verifying'] ?? 'Memverifikasi...') }}' : '{{ addslashes($i18n['confirm_and_continue'] ?? 'Konfirmasi & Lanjutkan') }}'"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    @endif
</form>
