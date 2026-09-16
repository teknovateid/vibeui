<x-docs.layouts.sidebar>
    <vibe:seo :title="__('docs/page/settings/index.title')" :description="__('docs/page/settings/index.subtitle')" :breadcrumbs="[
        ['name' => __('docs/page/settings/index.breadcrumb.home'), 'url' => '/'],
        ['name' => __('docs/page/settings/index.breadcrumb.pages'), 'url' => '#'],
        ['name' => __('docs/page/settings/index.breadcrumb.settings'), 'url' => route('docs.settings.account')],
        ['name' => 'Keamanan', 'url' => route('docs.settings.security')],
    ]" />

    <div class="mx-auto w-full space-y-6">
        <vibe:breadcrumb title="{!! __('docs/page/settings/index.title') !!}">
            <vibe:breadcrumb.item href="{{ route('docs.index') }}">{{ __('docs/page/settings/index.breadcrumb.home') }}</vibe:breadcrumb.item>
            <vibe:breadcrumb.item>{{ __('docs/page/settings/index.breadcrumb.pages') }}</vibe:breadcrumb.item>
            <vibe:breadcrumb.item href="{{ route('docs.settings.account') }}">{{ __('docs/page/settings/index.breadcrumb.settings') }}</vibe:breadcrumb.item>
            <vibe:breadcrumb.item active>Keamanan</vibe:breadcrumb.item>
        </vibe:breadcrumb>

        <vibe:card class="p-0 overflow-hidden">
            <div class="flex flex-col md:flex-row w-full min-h-155">
                @include('docs.settings.tabs', ['active' => 'security'])

                <div class="flex-1 min-w-0 p-6 space-y-6">
                    {{-- Header --}}
                    <div class="border-b border-border/50 pb-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <h2 class="text-lg font-bold text-foreground">Keamanan Akun</h2>
                                <p class="text-xs text-muted-foreground mt-0.5">
                                    Kelola kata sandi dan lapisan keamanan tambahan untuk akun Anda.
                                </p>
                            </div>
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:text-emerald-400">
                                <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                                Terverifikasi
                            </span>
                        </div>
                    </div>

                    @auth
                        {{-- Auth: tampilkan info akun aktif --}}
                        <div class="flex items-center gap-3 p-3.5 rounded-xl bg-muted/40 border border-border">
                            <div class="size-9 rounded-xl bg-primary/10 text-primary flex items-center justify-center shrink-0">
                                <svg class="size-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="8" r="5" />
                                    <path d="M20 21a8 8 0 0 0-16 0" />
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-semibold text-foreground">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-muted-foreground truncate">{{ auth()->user()->email }}</p>
                            </div>
                            @php
                                $confirmedAt = session('auth.password_confirmed_at', 0);
                                $timeout = 300;
                                $remainingMinutes = max(1, (int) ceil(($timeout - (time() - $confirmedAt)) / 60));
                            @endphp
                            <div class="flex items-center gap-2">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-medium bg-emerald-500/10 text-emerald-600 dark:text-emerald-400">
                                    <span class="size-1.5 rounded-full bg-emerald-500"></span>
                                    Sesi Dikonfirmasi (sisa {{ $remainingMinutes }} mnt)
                                </span>
                                <a href="{{ route('password.lock') }}" class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-medium border border-border bg-background hover:bg-muted text-muted-foreground hover:text-foreground transition-all cursor-pointer shadow-2xs" title="Kunci kembali sesi untuk menguji konfirmasi password">
                                    <svg class="size-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="18" height="11" x="3" y="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                                    <span>Kunci Sesi</span>
                                </a>
                            </div>
                        </div>
                    @else
                        {{-- Guest banner --}}
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 px-3.5 py-3 rounded-xl bg-amber-500/10 border border-amber-500/20 text-xs text-amber-700 dark:text-amber-300">
                            <div class="flex items-center gap-2.5">
                                <svg class="size-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>Ini adalah pratinjau UI. <strong>Login</strong> untuk mengelola keamanan akun nyata Anda.</span>
                            </div>
                            <div class="flex items-center gap-2 shrink-0">
                                @if(app()->environment('local', 'testing'))
                                    <form action="{{ route('dev.login.demo') }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="px-2.5 py-1 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white font-semibold transition-colors cursor-pointer text-xs">
                                            ⚡ Login Cepat Demo
                                        </button>
                                    </form>
                                @endif
                                <a href="{{ route('login') }}" class="px-3 py-1 rounded-lg bg-amber-500 text-white font-semibold hover:bg-amber-600 transition-colors">Login →</a>
                            </div>
                        </div>
                    @endauth

                    {{-- Change Password --}}
                    <div class="space-y-1">
                        <h3 class="text-sm font-semibold text-foreground">Ubah Kata Sandi</h3>
                        <p class="text-xs text-muted-foreground">Pastikan kata sandi baru Anda minimal 8 karakter dan mengandung kombinasi huruf dan angka.</p>
                    </div>

                    <div class="space-y-4 max-w-md">
                        @auth
                            <vibe:input type="password" name="current_password" label="Kata Sandi Saat Ini" viewable placeholder="Masukkan kata sandi saat ini" />
                        @endauth
                        <vibe:input type="password" name="new_password" label="Kata Sandi Baru" viewable placeholder="Minimal 8 karakter" />
                        <vibe:input type="password" name="confirm_password" label="Konfirmasi Kata Sandi Baru" viewable placeholder="Ulangi kata sandi baru" />
                    </div>

                    <div class="pt-4 border-t border-border/50 flex items-center justify-end max-w-md">
                        <vibe:button type="button" variant="primary" size="sm" class="cursor-pointer" @click="window.vibeToast ? vibeToast('Kata sandi berhasil diperbarui.', { type: 'success', title: 'Diperbarui' }) : null">
                            Perbarui Kata Sandi
                        </vibe:button>
                    </div>

                    {{-- Two-Factor Authentication --}}
                    <div class="pt-2 space-y-4" x-data="vibeTwoFactorSettings()">
                        <div class="space-y-1">
                            <div class="flex items-center justify-between">
                                <h3 class="text-sm font-semibold text-foreground">Autentikasi Dua Faktor (2FA)</h3>
                                <div>
                                    <span x-show="enabled" x-cloak class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-emerald-500/10 text-emerald-600 dark:text-emerald-400">
                                        <span class="size-1.5 rounded-full bg-emerald-500"></span>
                                        Aktif
                                    </span>
                                    <span x-show="!enabled" class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-muted text-muted-foreground">
                                        Nonaktif
                                    </span>
                                </div>
                            </div>
                            <p class="text-xs text-muted-foreground">Tambahkan lapisan keamanan ekstra. Setiap login membutuhkan kode verifikasi dari aplikasi autentikator atau email.</p>
                        </div>

                        <div class="max-w-xl border border-border/60 rounded-2xl p-4 space-y-4">
                            {{-- Header & Quick Add Button --}}
                            <div class="flex items-center justify-between gap-3">
                                <div>
                                    <p class="text-xs font-semibold text-foreground">Metode Verifikasi Dua Langkah</p>
                                    <p class="text-[11px] text-muted-foreground">Pilih metode autentikasi yang ingin Anda hubungkan dengan akun ini.</p>
                                </div>
                                <div x-show="!enabled">
                                    <vibe:button type="button" variant="primary" size="sm" @click="openSetup()" ::disabled="loading" class="cursor-pointer shrink-0">
                                        <span x-show="!loading">Aktifkan 2FA &rarr;</span>
                                        <span x-show="loading" x-cloak>Memuat...</span>
                                    </vibe:button>
                                </div>
                            </div>

                            {{-- Daftar Pilihan Metode 2FA --}}
                            <div class="space-y-2.5">
                                {{-- Metode 1: Authenticator App (TOTP) --}}
                                <div class="flex items-center justify-between gap-3 p-3 rounded-xl border border-border/60 bg-muted/20 hover:bg-muted/30 transition-colors">
                                    <div class="flex items-center gap-3 min-w-0">
                                        <div class="size-9 rounded-lg bg-primary/10 text-primary flex items-center justify-center shrink-0">
                                            <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <rect width="14" height="20" x="5" y="2" rx="2" ry="2"/><path d="M12 18h.01"/>
                                            </svg>
                                        </div>
                                        <div class="min-w-0">
                                            <div class="flex items-center gap-2">
                                                <p class="text-xs font-semibold text-foreground">Aplikasi Autentikator (TOTP)</p>
                                                <span x-show="totpEnabled" x-cloak class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-semibold bg-emerald-500/10 text-emerald-600 dark:text-emerald-400">Aktif</span>
                                                <span x-show="!totpEnabled" class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-medium bg-muted text-muted-foreground">Nonaktif</span>
                                            </div>
                                            <p class="text-[11px] text-muted-foreground truncate">Google Authenticator, Authy, atau 1Password.</p>
                                        </div>
                                    </div>
                                    <div class="shrink-0">
                                        <button 
                                            type="button" 
                                            x-show="!totpEnabled" 
                                            @click="openSetup('totp')" 
                                            :disabled="loading" 
                                            class="text-xs font-semibold text-primary hover:underline px-2.5 py-1 rounded-md border border-primary/20 hover:bg-primary/5 cursor-pointer disabled:opacity-50"
                                        >
                                            Aktifkan
                                        </button>
                                        <button 
                                            type="button" 
                                            x-show="totpEnabled" 
                                            x-cloak 
                                            @click="disable2FA('totp')" 
                                            :disabled="loading" 
                                            class="text-xs font-medium text-destructive hover:bg-destructive/10 px-2.5 py-1 rounded-md cursor-pointer disabled:opacity-50"
                                        >
                                            Nonaktifkan
                                        </button>
                                    </div>
                                </div>

                                {{-- Metode 2: Email OTP --}}
                                <div class="flex items-center justify-between gap-3 p-3 rounded-xl border border-border/60 bg-muted/20 hover:bg-muted/30 transition-colors">
                                    <div class="flex items-center gap-3 min-w-0">
                                        <div class="size-9 rounded-lg bg-blue-500/10 text-blue-600 dark:text-blue-400 flex items-center justify-center shrink-0">
                                            <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                                            </svg>
                                        </div>
                                        <div class="min-w-0">
                                            <div class="flex items-center gap-2">
                                                <p class="text-xs font-semibold text-foreground">Kode Verifikasi Email (OTP)</p>
                                                <span x-show="emailEnabled" x-cloak class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-semibold bg-emerald-500/10 text-emerald-600 dark:text-emerald-400">Aktif</span>
                                                <span x-show="!emailEnabled" class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-medium bg-muted text-muted-foreground">Nonaktif</span>
                                            </div>
                                            <p class="text-[11px] text-muted-foreground truncate" x-text="userEmail ? 'Kode 6-digit dikirim ke ' + userEmail : 'Kode 6-digit dikirim ke email terdaftar.'"></p>
                                        </div>
                                    </div>
                                    <div class="shrink-0">
                                        <button 
                                            type="button" 
                                            x-show="!emailEnabled" 
                                            @click="openSetup('email')" 
                                            :disabled="loading" 
                                            class="text-xs font-semibold text-primary hover:underline px-2.5 py-1 rounded-md border border-primary/20 hover:bg-primary/5 cursor-pointer disabled:opacity-50"
                                        >
                                            Aktifkan
                                        </button>
                                        <button 
                                            type="button" 
                                            x-show="emailEnabled" 
                                            x-cloak 
                                            @click="disable2FA('email')" 
                                            :disabled="loading" 
                                            class="text-xs font-medium text-destructive hover:bg-destructive/10 px-2.5 py-1 rounded-md cursor-pointer disabled:opacity-50"
                                        >
                                            Nonaktifkan
                                        </button>
                                    </div>
                                </div>

                                {{-- Metode 3: WhatsApp / SMS OTP (Stub) --}}
                                <div class="flex items-center justify-between gap-3 p-3 rounded-xl border border-dashed border-border/70 bg-muted/10 opacity-75">
                                    <div class="flex items-center gap-3 min-w-0">
                                        <div class="size-9 rounded-lg bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0">
                                            <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/>
                                            </svg>
                                        </div>
                                        <div class="min-w-0">
                                            <div class="flex items-center gap-2">
                                                <p class="text-xs font-semibold text-foreground">WhatsApp / SMS OTP</p>
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-medium bg-muted text-muted-foreground">Segera Hadir</span>
                                            </div>
                                            <p class="text-[11px] text-muted-foreground truncate">Verifikasi praktis langsung ke WhatsApp atau SMS.</p>
                                        </div>
                                    </div>
                                    <div class="shrink-0">
                                        <span class="text-[10px] font-mono text-muted-foreground">Stub Siap</span>
                                    </div>
                                </div>
                            </div>

                            {{-- Footer: Recovery Codes & Global Disable --}}
                            <div x-show="enabled" x-cloak class="pt-3 border-t border-border/50 flex flex-wrap items-center justify-between gap-2">
                                <div class="text-xs text-muted-foreground">
                                    <span>Kode Pemulihan Cadangan</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <vibe:button type="button" variant="outline" size="xs" @click="openRecoveryCodes()" ::disabled="loading" class="cursor-pointer">
                                        Lihat Kode Pemulihan
                                    </vibe:button>
                                    <vibe:button type="button" variant="ghost" size="xs" @click="disable2FA(null)" ::disabled="loading" class="text-destructive hover:bg-destructive/10 cursor-pointer">
                                        Nonaktifkan Semua
                                    </vibe:button>
                                </div>
                            </div>
                        </div>

                        {{-- Modal Setup 2FA --}}
                        <vibe:modal id="modal-2fa-setup" maxWidth="lg">
                            <vibe:modal.header>
                                <div class="flex items-center justify-between w-full pr-6">
                                    <div>
                                        <span x-show="step === 0">Pilih Metode Verifikasi 2FA</span>
                                        <span x-show="step === 1 && selectedMethod === 'totp'" x-cloak>Setup Aplikasi Autentikator</span>
                                        <span x-show="step === 1 && selectedMethod === 'email'" x-cloak>Verifikasi Dua Langkah via Email</span>
                                        <span x-show="step === 2" x-cloak>Simpan Kode Pemulihan Anda</span>
                                        <p class="text-xs text-muted-foreground font-normal mt-0.5">
                                            <span x-show="step === 0">Pilih bagaimana Anda ingin menerima kode verifikasi saat login.</span>
                                            <span x-show="step === 1 && selectedMethod === 'totp'" x-cloak>Langkah 1: Pindai QR code dan masukkan token verifikasi</span>
                                            <span x-show="step === 1 && selectedMethod === 'email'" x-cloak>Langkah 1: Masukkan 6-digit kode verifikasi yang dikirim ke email Anda</span>
                                            <span x-show="step === 2" x-cloak>Langkah 2: Simpan kode darurat di tempat yang aman</span>
                                        </p>
                                    </div>
                                    <div x-show="step === 1" x-cloak>
                                        <button type="button" @click="step = 0; feedback = null; resetOtpInputs()" class="text-xs text-primary hover:underline flex items-center gap-1 cursor-pointer font-medium">
                                            <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m15 18-6-6 6-6"/></svg>
                                            Ganti Metode
                                        </button>
                                    </div>
                                </div>
                            </vibe:modal.header>

                            <vibe:modal.content>
                                {{-- Feedback Alert --}}
                                <div x-show="feedback" x-cloak class="mb-4 p-3 rounded-xl text-xs" :class="feedbackType === 'success' ? 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/20' : (feedbackType === 'info' ? 'bg-primary/10 text-primary border border-primary/20' : 'bg-destructive/10 text-destructive border border-destructive/20')">
                                    <p x-text="feedback" class="font-medium"></p>
                                </div>

                                {{-- Step 0: Pilih Metode (Authenticator vs Email) --}}
                                <div x-show="step === 0" class="space-y-3">
                                    {{-- Opsi 1: Authenticator App --}}
                                    <div 
                                        @click="selectMethod('totp')" 
                                        class="group p-4 rounded-xl border border-border hover:border-primary/50 hover:bg-primary/5 cursor-pointer transition-all duration-200 flex items-start gap-4"
                                    >
                                        <div class="size-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
                                            <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <rect width="14" height="20" x="5" y="2" rx="2" ry="2"/><path d="M12 18h.01"/>
                                            </svg>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center justify-between gap-2">
                                                <p class="text-xs font-semibold text-foreground group-hover:text-primary transition-colors">Aplikasi Autentikator (TOTP)</p>
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-semibold bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 shrink-0">Disarankan</span>
                                            </div>
                                            <p class="text-[11px] text-muted-foreground mt-0.5 leading-relaxed">
                                                Gunakan Google Authenticator, Authy, atau 1Password. Menghasilkan kode instan bahkan tanpa pulsa / internet.
                                            </p>
                                        </div>
                                        <div class="shrink-0 text-muted-foreground group-hover:text-primary self-center transition-colors">
                                            <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m9 18 6-6-6-6"/></svg>
                                        </div>
                                    </div>

                                    {{-- Opsi 2: Email OTP --}}
                                    <div 
                                        @click="selectMethod('email')" 
                                        class="group p-4 rounded-xl border border-border hover:border-primary/50 hover:bg-primary/5 cursor-pointer transition-all duration-200 flex items-start gap-4"
                                    >
                                        <div class="size-10 rounded-xl bg-blue-500/10 text-blue-600 dark:text-blue-400 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
                                            <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                                            </svg>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center justify-between gap-2">
                                                <p class="text-xs font-semibold text-foreground group-hover:text-primary transition-colors">Kode Verifikasi Email (OTP)</p>
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-medium bg-blue-500/10 text-blue-600 dark:text-blue-400 shrink-0">Praktis</span>
                                            </div>
                                            <p class="text-[11px] text-muted-foreground mt-0.5 leading-relaxed">
                                                Kode 6-digit akan dikirimkan langsung ke kotak masuk email terdaftar (<span class="font-mono text-foreground font-medium" x-text="userEmail || 'email Anda'"></span>).
                                            </p>
                                        </div>
                                        <div class="shrink-0 text-muted-foreground group-hover:text-primary self-center transition-colors">
                                            <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m9 18 6-6-6-6"/></svg>
                                        </div>
                                    </div>
                                </div>

                                {{-- Step 1 (TOTP): QR Code & OTP --}}
                                <div x-show="step === 1 && selectedMethod === 'totp'" x-cloak class="space-y-5">
                                    <div class="flex flex-col sm:flex-row items-center gap-5 p-4 rounded-xl bg-muted/40 border border-border">
                                        <div class="p-2 rounded-xl bg-white shadow-2xs shrink-0 flex items-center justify-center min-w-39 min-h-39">
                                            <div x-html="qrSvg" x-show="qrSvg" class="flex items-center justify-center"></div>
                                            <div x-show="!qrSvg" class="size-35 flex items-center justify-center text-muted-foreground animate-pulse">
                                                <svg class="size-8 opacity-20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <rect width="18" height="18" x="3" y="3" rx="2"/>
                                                    <path d="M7 7h.01M17 7h.01M7 17h.01"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="space-y-2 flex-1 text-center sm:text-left">
                                            <p class="text-xs font-semibold text-foreground">Pindai dengan Aplikasi Autentikator</p>
                                            <p class="text-[11px] text-muted-foreground leading-relaxed">
                                                Buka Google Authenticator atau Authy di smartphone, lalu pindai kode QR di samping.
                                            </p>
                                            <div class="pt-1">
                                                <span class="text-[10px] text-muted-foreground block mb-1">Atau masukkan kunci manual:</span>
                                                <div class="flex items-center gap-1.5">
                                                    <code class="px-2 py-1 bg-background rounded text-[11px] font-mono border border-border text-foreground tracking-wider flex-1 truncate select-all" x-text="secretKey"></code>
                                                    <vibe:button type="button" variant="outline" size="xs" @click="copySecret()" class="cursor-pointer shrink-0">
                                                        <span x-text="copiedSecret ? 'Tersalin!' : 'Salin'"></span>
                                                    </vibe:button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="space-y-2">
                                        <label class="text-xs font-semibold text-foreground flex items-center justify-between">
                                            <span>Masukkan Kode 6-Digit dari Aplikasi</span>
                                            <span class="text-[10px] text-muted-foreground font-normal">Dapat paste langsung</span>
                                        </label>
                                        <div @otp-change="otpCode = $event.detail; if ($event.detail.length === 6) verifyOtp()">
                                            <vibe:input.otp id="setup-2fa-otp-totp" name="setup_otp_totp" length="6" size="md" />
                                        </div>
                                    </div>
                                </div>

                                {{-- Step 1 (Email): Email Info & OTP --}}
                                <div x-show="step === 1 && selectedMethod === 'email'" x-cloak class="space-y-5">
                                    <div class="p-4 rounded-xl bg-blue-500/5 border border-blue-500/20 flex items-start gap-3.5">
                                        <div class="size-9 rounded-lg bg-blue-500/10 text-blue-600 dark:text-blue-400 flex items-center justify-center shrink-0 mt-0.5">
                                            <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                                            </svg>
                                        </div>
                                        <div class="space-y-1 flex-1 text-xs">
                                            <p class="font-semibold text-foreground">Kode Verifikasi Telah Dikirim</p>
                                            <p class="text-muted-foreground leading-relaxed">
                                                Kami telah mengirimkan 6-digit kode OTP ke alamat email <span class="font-mono font-medium text-foreground" x-text="userEmail"></span>. Masukkan kode tersebut di bawah ini untuk mengonfirmasi.
                                            </p>
                                        </div>
                                    </div>

                                    <div class="space-y-2">
                                        <div class="flex items-center justify-between">
                                            <label class="text-xs font-semibold text-foreground">
                                                Masukkan Kode 6-Digit dari Email
                                            </label>
                                            <div class="text-[11px]">
                                                <span x-show="cooldown > 0" class="text-muted-foreground">Kirim ulang dalam <span class="font-mono font-semibold" x-text="cooldown"></span>s</span>
                                                <button 
                                                    type="button" 
                                                    x-show="cooldown <= 0" 
                                                    @click="resendEmailOtp()" 
                                                    :disabled="resending" 
                                                    class="text-primary hover:underline font-semibold cursor-pointer disabled:opacity-50"
                                                >
                                                    <span x-show="!resending">Kirim Ulang Kode</span>
                                                    <span x-show="resending" x-cloak>Mengirim...</span>
                                                </button>
                                            </div>
                                        </div>
                                        <div @otp-change="otpCode = $event.detail; if ($event.detail.length === 6) verifyOtp()">
                                            <vibe:input.otp id="setup-2fa-otp-email" name="setup_otp_email" length="6" size="md" />
                                        </div>
                                    </div>
                                </div>

                                {{-- Step 2: Recovery Codes --}}
                                <div x-show="step === 2" x-cloak class="space-y-4">
                                    <div class="p-3.5 rounded-xl bg-amber-500/10 border border-amber-500/20 text-xs text-amber-700 dark:text-amber-300 space-y-1">
                                        <p class="font-bold">PENTING: Simpan kode pemulihan ini!</p>
                                        <p>Jika Anda kehilangan akses ke aplikasi autentikator atau email, kode ini adalah satu-satunya cara untuk masuk kembali ke akun Anda.</p>
                                    </div>

                                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 p-3.5 rounded-xl bg-muted/40 border border-border font-mono text-xs text-foreground">
                                        <template x-for="code in recoveryCodes" :key="code">
                                            <div class="p-2 rounded-lg bg-background border border-border text-center select-all" x-text="code"></div>
                                        </template>
                                    </div>
                                </div>
                            </vibe:modal.content>

                            <vibe:modal.footer>
                                <div x-show="step === 0" class="flex items-center justify-end w-full">
                                    <vibe:button type="button" variant="outline" size="sm" @click="$vibe.modal('modal-2fa-setup').close()">
                                        Tutup
                                    </vibe:button>
                                </div>

                                <div x-show="step === 1" class="flex items-center justify-between w-full">
                                    <button type="button" @click="step = 0; feedback = null; resetOtpInputs()" class="text-xs text-muted-foreground hover:text-foreground flex items-center gap-1 cursor-pointer">
                                        &larr; Ganti Metode
                                    </button>
                                    <div class="flex items-center gap-2">
                                        <vibe:button type="button" variant="outline" size="sm" @click="$vibe.modal('modal-2fa-setup').close()">
                                            Batal
                                        </vibe:button>
                                        <vibe:button type="button" variant="primary" size="sm" @click="verifyOtp()" ::disabled="loading" class="cursor-pointer">
                                            <span x-show="!loading">Verifikasi & Aktifkan &rarr;</span>
                                            <span x-show="loading" x-cloak>Memverifikasi...</span>
                                        </vibe:button>
                                    </div>
                                </div>

                                <div x-show="step === 2" x-cloak class="flex items-center justify-between w-full">
                                    <vibe:button type="button" variant="outline" size="sm" class="cursor-pointer" @click="navigator.clipboard.writeText(recoveryCodes.join('\n')); if(window.vibeToast) vibeToast('Semua kode berhasil disalin!', { type: 'success' })">
                                        Salin Semua Kode
                                    </vibe:button>
                                    <vibe:button type="button" variant="primary" size="sm" class="cursor-pointer" @click="$vibe.modal('modal-2fa-setup').close()">
                                        Selesai &rarr;
                                    </vibe:button>
                                </div>
                            </vibe:modal.footer>
                        </vibe:modal>

                        {{-- Modal View Recovery Codes --}}
                        <vibe:modal id="modal-2fa-recovery" maxWidth="md">
                            <vibe:modal.header>
                                <span>Kode Pemulihan Cadangan (2FA)</span>
                                <p class="text-xs text-muted-foreground font-normal mt-0.5">Daftar kode pemulihan darurat sekali pakai</p>
                            </vibe:modal.header>

                            <vibe:modal.content>
                                <div class="space-y-4">
                                    <div class="p-3 rounded-xl bg-amber-500/10 border border-amber-500/20 text-xs text-amber-700 dark:text-amber-300">
                                        Setiap kode hanya dapat digunakan satu kali. Simpan kode-kode ini di tempat yang aman.
                                    </div>

                                    <div class="grid grid-cols-2 gap-2 p-3.5 rounded-xl bg-muted/40 border border-border font-mono text-xs text-foreground">
                                        <template x-for="code in recoveryCodes" :key="code">
                                            <div class="p-2 rounded-lg bg-background border border-border text-center select-all" x-text="code"></div>
                                        </template>
                                    </div>
                                </div>
                            </vibe:modal.content>

                            <vibe:modal.footer>
                                <div class="flex items-center justify-between w-full">
                                    <vibe:button type="button" variant="ghost" size="xs" class="text-destructive hover:bg-destructive/10 cursor-pointer" @click="regenerateRecoveryCodes()">
                                        Buat Ulang Kode Baru
                                    </vibe:button>
                                    <div class="flex items-center gap-2">
                                        <vibe:button type="button" variant="outline" size="xs" class="cursor-pointer" @click="navigator.clipboard.writeText(recoveryCodes.join('\n')); if(window.vibeToast) vibeToast('Kode pemulihan berhasil disalin!', { type: 'success' })">
                                            Salin Semua
                                        </vibe:button>
                                        <vibe:button type="button" variant="primary" size="xs" class="cursor-pointer" @click="$vibe.modal('modal-2fa-recovery').close()">
                                            Tutup
                                        </vibe:button>
                                    </div>
                                </div>
                            </vibe:modal.footer>
                        </vibe:modal>
                    </div>

                    {{-- Danger Zone --}}
                    <div class="pt-2 space-y-3">
                        <div class="space-y-1">
                            <h3 class="text-sm font-semibold text-destructive">Zona Berbahaya</h3>
                            <p class="text-xs text-muted-foreground">Tindakan berikut bersifat permanen dan tidak dapat dibatalkan.</p>
                        </div>
                        <div class="max-w-md p-4 rounded-2xl border border-destructive/30 bg-destructive/5 flex items-center justify-between gap-4">
                            <div>
                                <p class="text-sm font-semibold text-foreground">Hapus Akun</p>
                                <p class="text-xs text-muted-foreground mt-0.5">Menghapus akun secara permanen beserta semua data terkait.</p>
                            </div>
                            <vibe:button type="button" variant="ghost" size="sm" class="shrink-0 text-destructive border border-destructive/30 hover:bg-destructive hover:text-destructive-foreground cursor-pointer" @click="window.vibeToast ? vibeToast('Fitur hapus akun membutuhkan konfirmasi.', { type: 'warning', title: 'Perhatian' }) : null">
                                Hapus Akun
                            </vibe:button>
                        </div>
                    </div>
                </div>
            </div>
        </vibe:card>
    </div>

    @pushOnce('head', 'vibe-qrcode-script')
        @vite(['resources/js/vibe/qrcode.js'])
    @endPushOnce

    @push('body')
    <script>
        function vibeTwoFactorSettings() {
            return {
                totpEnabled: @json(auth()->user()?->hasTwoFactorEnabled('totp') ?? false),
                emailEnabled: @json(auth()->user()?->hasTwoFactorEnabled('email') ?? false),
                userEmail: @json(auth()->user()?->email ? \Teknovate\VibeUi\Vibe::twoFactor()->maskEmail(auth()->user()->email) : ''),
                isGuest: @json(!auth()->check()),
                step: 0,
                selectedMethod: 'totp',
                loading: false,
                resending: false,
                cooldown: 0,
                cooldownTimer: null,
                secretKey: '',
                qrCodeUrl: '',
                qrSvg: '',
                copiedSecret: false,
                otpCode: '',
                feedback: null,
                feedbackType: 'info',
                recoveryCodes: [],
                csrf: '{{ csrf_token() }}',

                get enabled() {
                    return this.totpEnabled || this.emailEnabled;
                },

                openSetup(method = null) {
                    if (this.isGuest) {
                        if (window.vibeToast) {
                            vibeToast('Silakan login terlebih dahulu untuk mengaktifkan 2FA akun Anda.', { type: 'warning', title: 'Perlu Login' });
                        }
                        setTimeout(() => { window.location.href = '{{ route('login') }}'; }, 800);
                        return;
                    }

                    this.feedback = null;
                    this.resetOtpInputs();

                    if (method) {
                        this.selectMethod(method);
                    } else {
                        this.step = 0;
                        $vibe.modal('modal-2fa-setup').show();
                    }
                },

                async selectMethod(method) {
                    this.selectedMethod = method;
                    this.loading = true;
                    this.feedback = null;
                    this.resetOtpInputs();

                    try {
                        const res = await fetch('{{ route('two-factor.setup') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': this.csrf,
                                'Accept': 'application/json',
                            },
                            body: JSON.stringify({ method: method })
                        });

                        if (res.status === 401) {
                            if (window.vibeToast) {
                                vibeToast('Sesi login telah berakhir. Silakan login kembali.', { type: 'warning' });
                            }
                            setTimeout(() => { window.location.href = '{{ route('login') }}'; }, 800);
                            return;
                        }

                        const data = await res.json();
                        if (!res.ok) {
                            this.feedbackType = 'error';
                            this.feedback = data.message || 'Gagal memulai konfigurasi 2FA.';
                            $vibe.modal('modal-2fa-setup').show();
                            return;
                        }

                        if (method === 'totp') {
                            this.secretKey = data.secret;
                            this.qrCodeUrl = data.qr_code_url;
                            this.renderQr();
                        } else if (method === 'email') {
                            if (data.email) {
                                this.userEmail = data.email;
                            }
                            this.startCooldown(60);
                            this.feedbackType = 'info';
                            this.feedback = data.message || 'Kode verifikasi 6-digit telah dikirimkan ke email Anda.';
                        }

                        this.step = 1;
                        $vibe.modal('modal-2fa-setup').show();
                    } catch (e) {
                        if (window.vibeToast) vibeToast('Gagal memuat konfigurasi 2FA.', { type: 'error' });
                    } finally {
                        this.loading = false;
                    }
                },

                renderQr() {
                    this.qrSvg = '';
                    const doRender = () => {
                        if (window.VibeQrCode && this.qrCodeUrl) {
                            this.qrSvg = window.VibeQrCode.renderSvg(this.qrCodeUrl, { size: 140, level: 'M' });
                        }
                    };
                    doRender();
                    if (!this.qrSvg) {
                        let interval = setInterval(() => {
                            if (window.VibeQrCode && this.qrCodeUrl) {
                                clearInterval(interval);
                                doRender();
                            }
                        }, 50);
                        setTimeout(() => clearInterval(interval), 2000);
                    }
                },

                startCooldown(seconds) {
                    if (this.cooldownTimer) clearInterval(this.cooldownTimer);
                    this.cooldown = seconds;
                    this.cooldownTimer = setInterval(() => {
                        if (this.cooldown > 0) {
                            this.cooldown--;
                        } else {
                            clearInterval(this.cooldownTimer);
                            this.cooldownTimer = null;
                        }
                    }, 1000);
                },

                async resendEmailOtp() {
                    if (this.cooldown > 0 || this.resending) return;
                    this.resending = true;
                    this.feedback = null;

                    try {
                        const res = await fetch('{{ route('two-factor.send-otp') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': this.csrf,
                                'Accept': 'application/json',
                            },
                            body: JSON.stringify({ method: 'email' })
                        });

                        const data = await res.json();
                        if (!res.ok) {
                            this.feedbackType = 'error';
                            this.feedback = data.message || 'Gagal mengirim ulang kode.';
                            return;
                        }

                        this.startCooldown(60);
                        this.feedbackType = 'info';
                        this.feedback = data.message || 'Kode verifikasi baru telah dikirimkan ke email Anda.';
                        if (window.vibeToast) vibeToast('Kode baru berhasil dikirim ke email!', { type: 'success' });
                    } catch (e) {
                        this.feedbackType = 'error';
                        this.feedback = 'Terjadi kesalahan saat mengirim ulang kode.';
                    } finally {
                        this.resending = false;
                    }
                },

                resetOtpInputs() {
                    this.otpCode = '';
                    ['setup-2fa-otp-totp', 'setup-2fa-otp-email'].forEach(id => {
                        const hidden = document.getElementById(id);
                        if (hidden) {
                            hidden.value = '';
                            hidden.dispatchEvent(new Event('input', { bubbles: true }));
                        }
                        for (let i = 0; i < 6; i++) {
                            const box = document.getElementById(id + '-' + i);
                            if (box) box.value = '';
                        }
                    });
                },

                copySecret() {
                    navigator.clipboard.writeText(this.secretKey);
                    this.copiedSecret = true;
                    setTimeout(() => { this.copiedSecret = false; }, 2000);
                },

                async verifyOtp() {
                    const hidden = document.getElementById(this.selectedMethod === 'totp' ? 'setup-2fa-otp-totp' : 'setup-2fa-otp-email');
                    const code = this.otpCode || (hidden ? hidden.value : '');
                    if (!code || code.length < 6) {
                        this.feedbackType = 'error';
                        this.feedback = 'Harap lengkapi seluruh 6 digit kode verifikasi.';
                        return;
                    }

                    this.loading = true;
                    this.feedback = null;

                    try {
                        const res = await fetch('{{ route('two-factor.confirm') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': this.csrf,
                                'Accept': 'application/json',
                            },
                            body: JSON.stringify({ 
                                code: code,
                                method: this.selectedMethod 
                            })
                        });

                        const data = await res.json();
                        if (!res.ok) {
                            this.feedbackType = 'error';
                            this.feedback = data.message || 'Kode verifikasi tidak valid.';
                            return;
                        }

                        if (this.selectedMethod === 'totp') {
                            this.totpEnabled = true;
                        } else if (this.selectedMethod === 'email') {
                            this.emailEnabled = true;
                        }

                        this.recoveryCodes = data.recovery_codes || [];
                        this.step = 2;
                        if (window.vibeToast) vibeToast(data.message || '2FA berhasil diaktifkan!', { type: 'success' });
                    } catch (e) {
                        this.feedbackType = 'error';
                        this.feedback = 'Terjadi kesalahan saat memverifikasi token.';
                    } finally {
                        this.loading = false;
                    }
                },

                async openRecoveryCodes() {
                    this.loading = true;
                    try {
                        const res = await fetch('{{ route('two-factor.recovery-codes.get') }}', {
                            headers: { 'Accept': 'application/json' }
                        });
                        const data = await res.json();
                        this.recoveryCodes = data.recovery_codes || [];
                        $vibe.modal('modal-2fa-recovery').show();
                    } catch (e) {
                        if (window.vibeToast) vibeToast('Gagal mengambil kode pemulihan.', { type: 'error' });
                    } finally {
                        this.loading = false;
                    }
                },

                async regenerateRecoveryCodes() {
                    if (!confirm('Apakah Anda yakin ingin membuat ulang kode pemulihan? Kode lama tidak akan berlaku lagi.')) return;
                    this.loading = true;
                    try {
                        const res = await fetch('{{ route('two-factor.recovery-codes') }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': this.csrf,
                                'Accept': 'application/json',
                            }
                        });
                        const data = await res.json();
                        this.recoveryCodes = data.recovery_codes || [];
                        if (window.vibeToast) vibeToast('Kode pemulihan baru berhasil dibuat.', { type: 'success' });
                    } catch (e) {
                        if (window.vibeToast) vibeToast('Gagal membuat ulang kode.', { type: 'error' });
                    } finally {
                        this.loading = false;
                    }
                },

                async disable2FA(method = null) {
                    let confirmMsg = 'Apakah Anda yakin ingin menonaktifkan seluruh Autentikasi Dua Faktor (2FA)?';
                    if (method === 'totp') {
                        confirmMsg = 'Apakah Anda yakin ingin menonaktifkan Aplikasi Autentikator (TOTP)?';
                    } else if (method === 'email') {
                        confirmMsg = 'Apakah Anda yakin ingin menonaktifkan Verifikasi Dua Langkah via Email?';
                    }

                    if (!confirm(confirmMsg)) return;
                    this.loading = true;

                    try {
                        const res = await fetch('{{ route('two-factor.disable') }}', {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': this.csrf,
                                'Accept': 'application/json',
                            },
                            body: JSON.stringify({ method: method })
                        });

                        const data = await res.json();
                        if (method === 'totp') {
                            this.totpEnabled = false;
                        } else if (method === 'email') {
                            this.emailEnabled = false;
                        } else {
                            this.totpEnabled = false;
                            this.emailEnabled = false;
                        }

                        if (window.vibeToast) vibeToast(data.message || 'Metode 2FA telah dinonaktifkan.', { type: 'info' });
                    } catch (e) {
                        if (window.vibeToast) vibeToast('Gagal menonaktifkan 2FA.', { type: 'error' });
                    } finally {
                        this.loading = false;
                    }
                }
            };
        }

        if (typeof window !== 'undefined') {
            window.vibeTwoFactorSettings = vibeTwoFactorSettings;
            if (window.Alpine) {
                window.Alpine.data('vibeTwoFactorSettings', vibeTwoFactorSettings);
            } else {
                document.addEventListener('alpine:init', () => {
                    window.Alpine.data('vibeTwoFactorSettings', vibeTwoFactorSettings);
                });
            }
        }
    </script>
    @endpush
</x-docs.layouts.sidebar>
