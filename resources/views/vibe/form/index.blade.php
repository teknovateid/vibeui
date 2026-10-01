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
    $formUid = $id ?: 'form-' . \Illuminate\Support\Str::random(8);
@endphp

@pushOnce('head', 'vibe-form')
    @vite(['resources/js/vibe/form.js'])
@endPushOnce

@if(config('passkeys.enabled', true))
    @pushOnce('head', 'vibe-passkeys')
        @vite(['resources/js/vibe/passkeys.js'])
    @endPushOnce
@endif

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
        confirmPasskeyLoading: false,
        confirmPasswordError: null,
        showConfirmPasswordText: false,
        submitConfirmPassword() {},
        confirmWithPasskey() {},
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
            <div x-show="showConfirmPasswordModal" x-cloak class="fixed inset-0 z-60 overflow-y-auto" role="dialog" aria-modal="true" data-vibe-sheet-ignore="true" style="display: none;">
                <div class="flex justify-center min-h-screen p-4 text-center items-center">
                    {{-- Backdrop --}}
                    <div x-show="showConfirmPasswordModal" x-transition.opacity class="fixed inset-0 bg-black/60 backdrop-blur-xs" data-vibe-sheet-ignore="true" @click="closeConfirmPasswordModal()"></div>

                    {{-- Modal Card --}}
                    <div x-show="showConfirmPasswordModal" 
                         x-transition:enter="ease-out duration-300"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="ease-in duration-200"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         @keydown.escape.window="if (showConfirmPasswordModal) closeConfirmPasswordModal()"
                         class="relative w-full max-w-md p-6 overflow-hidden text-left bg-card text-card-foreground border border-border/80 rounded-2xl shadow-2xl space-y-4">
                        
                        {{-- Header with Icon --}}
                        <div class="flex items-start gap-3.5">
                            <div class="size-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center shrink-0 border border-primary/20 shadow-xs">
                                <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="18" height="11" x="3" y="11" rx="2" ry="2"/>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-base font-semibold text-foreground tracking-tight">{{ $i18n['confirm_password'] ?? __('auth/titles.confirm_password') }}</h3>
                                <p class="text-xs text-muted-foreground mt-0.5 leading-relaxed">{{ $i18n['confirm_password_description'] ?? __('auth/titles.confirm_password_description') }}</p>
                            </div>
                        </div>

                        {{-- Error Alert --}}
                        <template x-if="confirmPasswordError">
                            <div class="p-3 rounded-xl bg-destructive/10 text-destructive text-xs border border-destructive/20 font-medium flex items-start gap-2.5 animate-vibe-shake">
                                <svg class="size-4 shrink-0 mt-0.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"/>
                                    <line x1="12" y1="8" x2="12" y2="12"/>
                                    <line x1="12" y1="16" x2="12.01" y2="16"/>
                                </svg>
                                <span class="flex-1 leading-relaxed" x-text="confirmPasswordError"></span>
                            </div>
                        </template>

                        {{-- Passkey Confirm Button --}}
                        @if (config('passkeys.enabled', true))
                            <div class="space-y-3 pt-1">
                                <vibe:button 
                                    type="button" 
                                    variant="outline" 
                                    size="md" 
                                    class="w-full justify-center shadow-2xs font-medium cursor-pointer" 
                                    @click="confirmWithPasskey()"
                                    ::disabled="confirmPasskeyLoading"
                                >
                                    <span x-show="!confirmPasskeyLoading" class="inline-flex items-center gap-2">
                                        <svg class="size-4 text-primary shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M12 10a2 2 0 0 0-2 2c0 1.02-.1 2.51-.26 4" />
                                            <path d="M14 13.12c0 2.38 0 6.38-1 8.88" />
                                            <path d="M17.29 21.02c.12-.6.43-2.3.5-3.02" />
                                            <path d="M2 12a10 10 0 0 1 18-6" />
                                            <path d="M2 16h.01" />
                                            <path d="M21.8 16c.2-2 .131-5.354 0-6" />
                                            <path d="M5 19.5C5.5 18 6 15 6 12a6 6 0 0 1 .34-2" />
                                            <path d="M8.65 22c.21-.66.45-1.32.57-2" />
                                            <path d="M9 6.8a6 6 0 0 1 9 5.2v2" />
                                        </svg>
                                        <span>{{ __('auth/passkey.confirm_button') }}</span>
                                    </span>
                                    <span x-show="confirmPasskeyLoading" x-cloak class="inline-flex items-center justify-center gap-2">
                                        <svg class="animate-spin size-4 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        <span>{{ __('auth/passkey.connecting') }}</span>
                                    </span>
                                </vibe:button>

                                <vibe:separator text="{{ __('auth/passkey.confirm_separator') }}" />
                            </div>
                        @endif

                        {{-- Password Input with <vibe:input> --}}
                        <div class="space-y-4">
                            <vibe:input 
                                id="vibe-confirm-pwd-{{ $formUid }}"
                                name="password"
                                type="password" 
                                size="md"
                                viewable 
                                autocomplete="current-password"
                                :label="$i18n['password'] ?? __('auth/fields.password')" 
                                :placeholder="$i18n['password_placeholder'] ?? __('auth/fields.password_placeholder')"
                                x-model="confirmPasswordInput" 
                                x-ref="confirmPasswordInputRef"
                                @keydown.enter.prevent.stop="submitConfirmPassword()"
                            />

                            {{-- Footer Buttons (vibe:button size md) --}}
                            <div class="flex items-center justify-end gap-2.5 pt-2">
                                <vibe:button 
                                    type="button" 
                                    variant="outline" 
                                    size="md" 
                                    @click="closeConfirmPasswordModal()"
                                >
                                    {{ $i18n['cancel'] ?? __('auth/actions.cancel') }}
                                </vibe:button>

                                <vibe:button 
                                    type="button" 
                                    variant="primary" 
                                    size="md" 
                                    @click="submitConfirmPassword()" 
                                    ::disabled="confirmPasswordLoading"
                                    class="shadow-xs"
                                >
                                    <svg x-show="confirmPasswordLoading" x-cloak class="size-4 animate-spin shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    <span x-text="confirmPasswordLoading ? '{{ addslashes($i18n['verifying'] ?? __('auth/actions.verifying')) }}' : '{{ addslashes($i18n['confirm_and_continue'] ?? __('auth/actions.confirm')) }}'"></span>
                                </vibe:button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    @endif
</form>
