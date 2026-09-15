<x-docs.layouts.sidebar>
    <vibe:seo title="Autentikasi Dua Faktor (2FA) — Vibe UI" description="Dokumentasi dan demo interaktif Autentikasi Dua Faktor (2FA TOTP, Authenticator App, Recovery Codes) di Vibe UI." schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => 'Authentication', 'url' => route('docs.auth.installation')],
        ['name' => 'Two-Factor (2FA)', 'url' => route('docs.auth.two-factor')]
    ]" />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">

        {{-- Main Content --}}
        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-12">

            {{-- Header --}}
            <div class="space-y-4">
                <div class="flex flex-wrap items-center gap-2">
                    <vibe:badge variant="primary" class="rounded-full">Multi-Factor</vibe:badge>
                    <vibe:badge variant="outline" class="rounded-full">TOTP & Recovery Codes</vibe:badge>
                    <span class="text-xs text-muted-foreground">Google Authenticator / Authy Compatible</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">Autentikasi Dua Faktor (2FA)</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    Melindungi akun pengguna dari pencurian kata sandi dengan menambahkan langkah verifikasi token unik 6 digit berbasis waktu (TOTP). Kompatibel penuh dengan Google Authenticator, Microsoft Authenticator, 1Password, dan Authy.
                </p>

                <div class="flex flex-wrap items-center gap-2 pt-2">
                    <vibe:button href="{{ route('docs.settings.security') }}" variant="outline" size="sm">
                        Buka Pengaturan Keamanan Akun &rarr;
                    </vibe:button>
                </div>
            </div>

            {{-- 1. Live Interactive Demo: 2FA Setup Simulator --}}
            <section id="demo-2fa" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">1. Simulator Pendaftaran & Verifikasi 2FA (Live Demo)</h2>
                    <p class="text-sm text-muted-foreground">
                        Rasakan pengalaman setup 2FA dari sudut pandang pengguna, lengkap dengan QR Code simulasi, input OTP interaktif, dan recovery codes:
                    </p>
                </div>

                <div class="p-6 rounded-2xl border border-border bg-card space-y-6 shadow-xs" x-data="{
                    step: 1, // 1: Setup/QR, 2: Recovery Codes, 3: Completed
                    secretKey: 'JBSWY3DPEHPK3PXP',
                    copiedSecret: false,
                    loading: false,
                    feedback: null,
                    feedbackType: 'info',
                    otpCode: '',
                    recoveryCodes: [
                        'a8f9-4b21-9c3e',
                        '7e12-88f0-1a2b',
                        'd345-6671-889a',
                        '991c-2234-55ff',
                        '12ab-99ef-8833',
                        'ff23-7744-11cc',
                        '44bb-6611-9988',
                        '33aa-11ff-7722'
                    ],

                    copySecret() {
                        navigator.clipboard.writeText(this.secretKey);
                        this.copiedSecret = true;
                        setTimeout(() => { this.copiedSecret = false; }, 2000);
                    },

                    verifyOtp() {
                        const hidden = document.getElementById('demo-2fa-otp');
                        const code = this.otpCode || (hidden ? hidden.value : '');
                        if (!code || code.length < 6) {
                            this.feedbackType = 'error';
                            this.feedback = 'Harap lengkapi seluruh 6 digit kode autentikator.';
                            return;
                        }

                        this.loading = true;
                        this.feedback = null;

                        setTimeout(() => {
                            this.loading = false;
                            this.step = 2;
                            this.feedbackType = 'success';
                            this.feedback = 'Kode valid! 2FA berhasil diaktifkan. Simpan kode pemulihan berikut di tempat yang aman.';
                        }, 800);
                    },

                    finishSetup() {
                        this.step = 3;
                    },

                    resetDemo() {
                        this.step = 1;
                        this.otpCode = '';
                        this.feedback = null;
                        let hidden = document.getElementById('demo-2fa-otp');
                        if (hidden) {
                            hidden.value = '';
                            hidden.dispatchEvent(new Event('input', { bubbles: true }));
                        }
                    }
                }">
                    {{-- Status Steps Header --}}
                    <div class="flex items-center justify-between border-b border-border pb-4">
                        <div class="flex items-center gap-2">
                            <span class="size-2 rounded-full" :class="step === 3 ? 'bg-emerald-500' : 'bg-primary animate-pulse'"></span>
                            <h3 class="text-sm font-semibold text-foreground">
                                <span x-show="step === 1">Langkah 1: Pindai QR Code & Masukkan Token</span>
                                <span x-show="step === 2" x-cloak>Langkah 2: Simpan Kode Pemulihan (Recovery Codes)</span>
                                <span x-show="step === 3" x-cloak>2FA Telah Aktif pada Akun Ini</span>
                            </h3>
                        </div>

                        <template x-if="step === 3">
                            <vibe:button type="button" variant="outline" size="xs" @click="resetDemo()">
                                Ulangi Simulasi Demo
                            </vibe:button>
                        </template>
                    </div>

                    {{-- Feedback Banner --}}
                    <div x-show="feedback" x-cloak class="p-3.5 rounded-xl text-xs space-y-1" :class="feedbackType === 'success' ? 'bg-emerald-500/10 text-emerald-700 dark:text-emerald-300 border border-emerald-500/20' : 'bg-destructive/10 text-destructive border border-destructive/20'">
                        <p class="font-semibold" x-text="feedbackType === 'success' ? '✓ Berhasil' : '⚠ Kesalahan'"></p>
                        <p x-text="feedback" class="leading-relaxed"></p>
                    </div>

                    {{-- Step 1: Scan QR & Input OTP --}}
                    <div x-show="step === 1" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                            {{-- Real Scannable QR Code Card --}}
                            <div class="p-5 rounded-xl bg-muted/40 border border-border flex flex-col items-center justify-center text-center space-y-3">
                                <vibe:display.qrcode 
                                    value="otpauth://totp/Vibe%20UI:demo@example.com?secret=JBSWY3DPEHPK3PXP&issuer=Vibe%20UI"
                                    size="150"
                                    level="M"
                                    class="p-2.5 rounded-xl bg-white shadow-xs border border-border/80"
                                />
                                <div class="space-y-1">
                                    <p class="text-xs font-semibold text-foreground">Pindai dengan Aplikasi Autentikator</p>
                                    <p class="text-[11px] text-muted-foreground">Buka Google Authenticator atau Authy di smartphone Anda.</p>
                                </div>
                            </div>

                            {{-- Secret Key & 6-Digit OTP Form --}}
                            <div class="space-y-4">
                                <div class="space-y-1.5">
                                    <label class="text-xs font-semibold text-foreground">Kunci Rahasia Manual</label>
                                    <div class="flex items-center gap-2">
                                        <code class="px-3 py-2 bg-muted rounded-lg font-mono text-xs text-foreground flex-1 tracking-wider border border-border" x-text="secretKey"></code>
                                        <vibe:button type="button" variant="outline" size="sm" @click="copySecret()" class="cursor-pointer shrink-0">
                                            <span x-text="copiedSecret ? 'Tersalin!' : 'Salin Kunci'"></span>
                                        </vibe:button>
                                    </div>
                                    <p class="text-[11px] text-muted-foreground">Gunakan kunci di atas jika kamera ponsel tidak dapat memindai QR.</p>
                                </div>

                                <div class="space-y-2 pt-2">
                                    <label class="text-xs font-semibold text-foreground flex items-center justify-between">
                                        <span>Kode 6-Digit Verifikasi</span>
                                        <span class="text-[10px] text-muted-foreground font-normal">Dapat paste langsung</span>
                                    </label>

                                    {{-- 6 boxes OTP input using vibe:input.otp --}}
                                    <div @otp-change="otpCode = $event.detail; if ($event.detail.length === 6) verifyOtp()">
                                        <vibe:input.otp 
                                            id="demo-2fa-otp"
                                            name="demo_otp"
                                            length="6"
                                            size="md"
                                        />
                                    </div>
                                </div>

                                <vibe:button type="button" variant="primary" size="sm" @click="verifyOtp()" ::disabled="loading" class="w-full justify-center cursor-pointer mt-2">
                                    <template x-if="!loading"><span>Verifikasi & Aktifkan 2FA &rarr;</span></template>
                                    <template x-if="loading"><span>Memverifikasi Kode...</span></template>
                                </vibe:button>
                            </div>
                        </div>
                    </div>

                    {{-- Step 2: Emergency Recovery Codes --}}
                    <div x-show="step === 2" x-cloak class="space-y-4 animate-in fade-in duration-200">
                        <div class="p-4 rounded-xl bg-amber-500/10 border border-amber-500/20 text-xs text-amber-700 dark:text-amber-300 space-y-1">
                            <p class="font-bold">PENTING: Simpan Kode Pemulihan Anda!</p>
                            <p>Jika Anda kehilangan akses ke smartphone atau aplikasi autentikator, kode-kode ini adalah satu-satunya cara untuk masuk kembali ke akun Anda. Setiap kode hanya dapat digunakan satu kali.</p>
                        </div>

                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5 p-4 rounded-xl bg-muted/40 border border-border font-mono text-xs text-foreground">
                            <template x-for="code in recoveryCodes" :key="code">
                                <div class="p-2 rounded-lg bg-background border border-border text-center" x-text="code"></div>
                            </template>
                        </div>

                        <div class="flex items-center justify-between pt-2">
                            <vibe:button type="button" variant="outline" size="sm" @click="navigator.clipboard.writeText(recoveryCodes.join('\n')); feedbackType = 'success'; feedback = 'Semua kode pemulihan berhasil disalin ke clipboard!';" class="cursor-pointer">
                                Salin Semua Kode
                            </vibe:button>
                            <vibe:button type="button" variant="primary" size="sm" @click="finishSetup()" class="cursor-pointer">
                                Selesai & Simpan &rarr;
                            </vibe:button>
                        </div>
                    </div>

                    {{-- Step 3: 2FA Active State --}}
                    <div x-show="step === 3" x-cloak class="p-6 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-center space-y-3 animate-in fade-in duration-200">
                        <div class="size-12 rounded-full bg-emerald-500 text-white flex items-center justify-center mx-auto">
                            <svg class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                        </div>
                        <h4 class="text-base font-bold text-foreground">Autentikasi Dua Faktor Aktif</h4>
                        <p class="text-xs text-muted-foreground max-w-md mx-auto">
                            Akun Anda kini dilindungi oleh verifikasi dua langkah. Saat login berikutnya, Anda akan diminta memasukkan kode 6 digit dari aplikasi autentikator.
                        </p>
                    </div>
                </div>
            </section>

            {{-- 2. Alur Login dengan 2FA Challenge --}}
            <section id="alur-login-2fa" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">2. Alur Tantangan Otentikasi (2FA Challenge Flow)</h2>
                    <p class="text-sm text-muted-foreground">
                        Bagaimana sistem menangani pengguna yang mengaktifkan 2FA saat proses login:
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="p-4 rounded-xl border border-border bg-card space-y-2">
                        <div class="size-7 rounded-lg bg-primary/10 text-primary flex items-center justify-center text-xs font-bold">1</div>
                        <h4 class="text-xs font-bold text-foreground">Validasi Kredensial</h4>
                        <p class="text-xs text-muted-foreground leading-relaxed">Pengguna memasukkan email/username dan kata sandi di formulir <code>/login</code> seperti biasa.</p>
                    </div>

                    <div class="p-4 rounded-xl border border-border bg-card space-y-2">
                        <div class="size-7 rounded-lg bg-primary/10 text-primary flex items-center justify-center text-xs font-bold">2</div>
                        <h4 class="text-xs font-bold text-foreground">Pengalihan ke Tantangan 2FA</h4>
                        <p class="text-xs text-muted-foreground leading-relaxed">Jika akun memiliki 2FA aktif, user tidak langsung login melainkan dialihkan ke layar input token TOTP.</p>
                    </div>

                    <div class="p-4 rounded-xl border border-border bg-card space-y-2">
                        <div class="size-7 rounded-lg bg-primary/10 text-primary flex items-center justify-center text-xs font-bold">3</div>
                        <h4 class="text-xs font-bold text-foreground">Otentikasi Sukses</h4>
                        <p class="text-xs text-muted-foreground leading-relaxed">Token diverifikasi secara kriptografis menggunakan algoritma TOTP (RFC 6238) sebelum sesi diberikan.</p>
                    </div>
                </div>
            </section>

            {{-- 3. Komponen Input OTP --}}
            <section id="komponen-otp" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">3. Sintaks Komponen OTP Form</h2>
                    <p class="text-sm text-muted-foreground">
                        Gunakan pola form input OTP di Blade/Livewire untuk tantangan login:
                    </p>
                </div>

                <vibe:highlightjs language="blade">
{{-- Form Tantangan 2FA pada Login Menggunakan vibe:input.otp --}}
<form wire:submit="verifyTwoFactor" class="space-y-4">
    <\vibe:input.otp 
        label="Kode Verifikasi 6 Digit" 
        name="code" 
        length="6"
        auto-submit
        wire:model="twoFactorCode" 
    />

    <\vibe:button type="submit" variant="primary" class="w-full justify-center">
        Masuk ke Akun
    </\vibe:button>
</form>
</vibe:highlightjs>

                <div class="pt-1">
                    <vibe:button href="{{ route('docs.input.otp') }}" variant="outline" size="xs">
                        Lihat Dokumentasi Lengkap &lt;vibe:input.otp&gt; &rarr;
                    </vibe:button>
                </div>
            </section>

        </div>

        {{-- Table of Contents (TOC) --}}
        <div class="col-span-12 md:col-span-3 order-1 md:order-2 sticky top-6 space-y-4">
            <vibe:toc selector="#docs-content" />
        </div>

    </div>
</x-docs.layouts.sidebar>
