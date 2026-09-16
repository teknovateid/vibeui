<div class="space-y-5" x-data="{ selectorOpen: @entangle('showingMethodSelector') }">
    {{-- Error Feedback --}}
    @if ($errors->any())
        <vibe:card.alert variant="destructive" size="sm" dismissible>
            <x-slot:description>
                {{ $errors->first() }}
            </x-slot:description>
        </vibe:card.alert>
    @endif

    {{-- Info Notifikasi Pengiriman Kode (Email / WhatsApp / SMS) --}}
    @if ($sentMessage && in_array($selectedMethod, ['email', 'whatsapp', 'sms']))
        <div class="p-3 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-xs text-emerald-700 dark:text-emerald-400 flex items-start justify-between gap-3">
            <div class="flex items-start gap-2">
                <svg class="size-4 shrink-0 mt-0.5 text-emerald-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <polyline points="20 6 9 17 4 12"/>
                </svg>
                <div class="space-y-0.5">
                    <p class="font-semibold">{{ $sentMessage }}</p>
                    <p class="text-[11px] text-muted-foreground">Periksa kotak masuk Anda dan masukkan kode 6-digit.</p>
                </div>
            </div>

            <button 
                type="button" 
                wire:click="sendOtp" 
                wire:loading.attr="disabled"
                class="shrink-0 text-[11px] font-semibold text-emerald-600 dark:text-emerald-400 hover:underline cursor-pointer disabled:opacity-50"
            >
                <span wire:loading.remove wire:target="sendOtp">Kirim Ulang</span>
                <span wire:loading wire:target="sendOtp">Mengirim...</span>
            </button>
        </div>
    @endif

    {{-- Form Verifikasi Utama --}}
    <form wire:submit="challenge" class="space-y-5">
        @if ($selectedMethod !== 'recovery')
            {{-- Mode Kode OTP 6-Digit (TOTP, Email, WhatsApp, SMS) --}}
            <div class="space-y-3">
                <div class="space-y-1 text-center sm:text-left">
                    <div class="flex items-center justify-between">
                        <label class="text-xs font-semibold text-foreground flex items-center gap-1.5">
                            @if ($selectedMethod === 'totp')
                                <svg class="size-3.5 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect width="14" height="20" x="5" y="2" rx="2" ry="2"/><path d="M12 18h.01"/>
                                </svg>
                                <span>Kode Aplikasi Autentikator</span>
                            @elseif ($selectedMethod === 'email')
                                <svg class="size-3.5 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                                </svg>
                                <span>Kode Verifikasi Email</span>
                            @elseif ($selectedMethod === 'whatsapp')
                                <svg class="size-3.5 text-emerald-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/>
                                </svg>
                                <span>Kode WhatsApp OTP</span>
                            @elseif ($selectedMethod === 'sms')
                                <svg class="size-3.5 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                                </svg>
                                <span>Kode SMS OTP</span>
                            @endif
                        </label>

                        @if (isset($availableMethods[$selectedMethod]['badge']))
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-semibold bg-primary/10 text-primary">
                                {{ $availableMethods[$selectedMethod]['badge'] }}
                            </span>
                        @endif
                    </div>

                    <p class="text-xs text-muted-foreground">
                        @if ($selectedMethod === 'totp')
                            Buka Google Authenticator atau Authy di smartphone Anda dan masukkan kode 6-digit.
                        @elseif ($selectedMethod === 'email')
                            Masukkan kode 6 digit yang dikirimkan ke email Anda.
                        @elseif ($selectedMethod === 'whatsapp')
                            Masukkan kode 6 digit yang dikirimkan ke akun WhatsApp Anda.
                        @elseif ($selectedMethod === 'sms')
                            Masukkan kode 6 digit yang dikirimkan via SMS.
                        @endif
                    </p>
                </div>

                <div class="py-2 flex justify-center sm:justify-start">
                    <vibe:input.otp 
                        id="two-factor-otp"
                        name="code"
                        length="6"
                        wire:model="code"
                        auto-submit
                    />
                </div>

                @if (in_array($selectedMethod, ['email', 'whatsapp', 'sms']))
                    <div class="flex items-center justify-between text-xs text-muted-foreground pt-1">
                        <span>Tidak menerima kode?</span>
                        <button 
                            type="button" 
                            wire:click="sendOtp" 
                            wire:loading.attr="disabled"
                            class="text-primary hover:underline font-medium cursor-pointer"
                        >
                            <span wire:loading.remove wire:target="sendOtp">Kirim Ulang Kode</span>
                            <span wire:loading wire:target="sendOtp">Mengirimkan...</span>
                        </button>
                    </div>
                @endif
            </div>

            {{-- Tombol Submit --}}
            <div class="pt-1 space-y-3">
                <vibe:button type="submit" variant="primary" class="w-full justify-center shadow-xs cursor-pointer" wire:loading.attr="disabled" wire:target="challenge">
                    <span wire:loading.remove wire:target="challenge">Verifikasi & Masuk &rarr;</span>
                    <span wire:loading.inline-flex wire:target="challenge" class="inline-flex items-center justify-center gap-2">
                        <svg class="animate-spin size-4 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span>Memverifikasi Kode...</span>
                    </span>
                </vibe:button>
            </div>
        @else
            {{-- Mode Kode Pemulihan Darurat --}}
            <div class="space-y-3">
                <div class="p-3.5 rounded-xl bg-amber-500/10 border border-amber-500/20 text-xs text-amber-700 dark:text-amber-300 space-y-1">
                    <p class="font-semibold flex items-center gap-1.5">
                        <svg class="size-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                        </svg>
                        <span>Mode Kode Pemulihan Cadangan</span>
                    </p>
                    <p class="leading-relaxed">
                        Gunakan salah satu dari kode pemulihan darurat Anda. Setiap kode hanya dapat dipakai 1 kali.
                    </p>
                </div>

                <vibe:input 
                    wire:model="recovery_code"
                    id="recovery_code"
                    name="recovery_code"
                    label="Kode Pemulihan (Recovery Code)"
                    placeholder="xxxx-xxxx-xxxx"
                    required
                    autofocus
                    autocomplete="one-time-code"
                />
            </div>

            {{-- Tombol Submit Recovery --}}
            <div class="pt-1 space-y-3">
                <vibe:button type="submit" variant="primary" class="w-full justify-center shadow-xs cursor-pointer" wire:loading.attr="disabled" wire:target="challenge">
                    <span wire:loading.remove wire:target="challenge">Masuk dengan Kode Pemulihan &rarr;</span>
                    <span wire:loading.inline-flex wire:target="challenge" class="inline-flex items-center justify-center gap-2">
                        <svg class="animate-spin size-4 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span>Memverifikasi Kode...</span>
                    </span>
                </vibe:button>
            </div>
        @endif
    </form>

    {{-- Provider Switcher: Coba Cara Lain --}}
    @if (count($availableMethods) > 1)
        <div class="pt-2 border-t border-border space-y-2">
            <button 
                type="button" 
                wire:click="toggleMethodSelector" 
                class="w-full py-2 px-3 rounded-xl border border-border/80 bg-muted/30 hover:bg-muted/60 text-xs font-medium text-foreground flex items-center justify-between transition-colors cursor-pointer"
            >
                <span class="flex items-center gap-2">
                    <svg class="size-3.5 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/><path d="m10 15 5-3-5-3v6Z"/>
                    </svg>
                    <span>Coba cara verifikasi lain</span>
                </span>
                <svg class="size-3.5 text-muted-foreground transition-transform duration-200" :class="{ 'rotate-180': selectorOpen }" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="m6 9 6 6 6-6"/>
                </svg>
            </button>

            {{-- Daftar Pilihan Metode --}}
            <div x-show="selectorOpen" x-cloak class="p-1.5 rounded-2xl border border-border bg-card shadow-xs space-y-1">
                @foreach ($availableMethods as $methodKey => $methodInfo)
                    <button 
                        type="button" 
                        wire:click="selectMethod('{{ $methodKey }}')" 
                        class="w-full p-2.5 rounded-xl text-left flex items-center justify-between transition-colors cursor-pointer {{ $selectedMethod === $methodKey ? 'bg-primary/10 text-primary border border-primary/20' : 'hover:bg-muted text-foreground' }}"
                    >
                        <div class="flex items-center gap-3 min-w-0">
                            <div class="size-8 rounded-lg flex items-center justify-center shrink-0 {{ $selectedMethod === $methodKey ? 'bg-primary text-primary-foreground' : 'bg-muted text-muted-foreground' }}">
                                @if ($methodKey === 'totp')
                                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="14" height="20" x="5" y="2" rx="2" ry="2"/><path d="M12 18h.01"/></svg>
                                @elseif ($methodKey === 'email')
                                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                                @elseif ($methodKey === 'whatsapp')
                                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
                                @elseif ($methodKey === 'sms')
                                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                                @elseif ($methodKey === 'recovery')
                                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="7.5" cy="15.5" r="5.5"/><path d="m21 2-9.6 9.6"/><path d="m15.5 7.5 3 3L22 7l-3-3"/></svg>
                                @endif
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-xs font-semibold truncate">{{ $methodInfo['name'] }}</p>
                                <p class="text-[11px] text-muted-foreground truncate">{{ $methodInfo['description'] }}</p>
                            </div>
                        </div>

                        @if ($selectedMethod === $methodKey)
                            <svg class="size-4 text-primary shrink-0 ml-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                        @endif
                    </button>
                @endforeach
            </div>
        </div>
    @endif

    {{-- Cancel link --}}
    <div class="pt-2 flex items-center justify-center text-xs">
        <button type="button" wire:click="cancel" class="text-muted-foreground hover:text-foreground inline-flex items-center gap-1.5 transition-colors cursor-pointer">
            <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="m15 18-6-6 6-6"/>
            </svg>
            <span>Batal dan kembali ke login</span>
        </button>
    </div>
</div>
