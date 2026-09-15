<x-docs.layouts.sidebar>
    <vibe:seo title="Autentikasi Biometrik Passkey (WebAuthn) — Vibe UI" description="Dokumentasi lengkap dan konsol uji coba langsung Passkey (FIDO2/WebAuthn) untuk login tanpa kata sandi menggunakan biometrik perangkat." schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => 'Authentication', 'url' => route('docs.auth.installation')],
        ['name' => 'Passkey (WebAuthn)', 'url' => route('docs.auth.passkey')]
    ]" />

    @push('head')
        @vite('resources/js/vibe/passkeys.js')
    @endpush

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">

        {{-- Main Documentation Content --}}
        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-12">

            {{-- Header --}}
            <div class="space-y-4">
                <div class="flex flex-wrap items-center gap-2">
                    <vibe:badge variant="primary" class="rounded-full">Passwordless</vibe:badge>
                    <vibe:badge variant="outline" class="rounded-full">FIDO2 / WebAuthn</vibe:badge>
                    <span class="text-xs text-muted-foreground">laravel/passkeys & @laravel/passkeys</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">Passkey (WebAuthn)</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    Otentikasi biometrik modern menggunakan sidik jari (Touch ID), pemindai wajah (Face ID / Windows Hello), atau kunci keamanan fisik (YubiKey). Menghilangkan risiko serangan phishing dan credential stuffing secara total karena kata sandi tidak lagi disimpan atau dikirim ke server.
                </p>

                <div class="flex flex-wrap items-center gap-2 pt-2">
                    <vibe:button href="/login" variant="primary" size="sm">
                        <svg class="size-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        Uji Login dengan Passkey
                    </vibe:button>
                    <vibe:button href="{{ route('docs.settings.passkey') }}" variant="outline" size="sm">
                        Pengaturan Passkey Akun &rarr;
                    </vibe:button>
                </div>
            </div>

            {{-- Important WebAuthn Security Notice --}}
            <div class="p-4 rounded-xl bg-amber-500/10 border border-amber-500/20 text-xs text-amber-700 dark:text-amber-300 space-y-2 leading-relaxed">
                <div class="flex items-center gap-2 font-semibold">
                    <svg class="size-4 shrink-0 text-amber-600 dark:text-amber-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <span>Aturan Keamanan WebAuthn & Pendaftaran Passkey:</span>
                </div>
                <ul class="list-disc list-inside space-y-1 text-muted-foreground pl-1">
                    <li><strong>Wajib Menggunakan Nama Domain:</strong> Browser melarang WebAuthn dijalankan pada IP mentah seperti <code>http://127.0.0.1:8000</code>. Akses selalu melalui <code>http://localhost:8000</code> atau domain HTTPS.</li>
                    <li><strong>Verifikasi Kata Sandi Sebelum Pendaftaran:</strong> Pengguna <strong>wajib memasukkan kata sandi akun terlebih dahulu</strong> untuk mencegah pendaftaran perangkat tanpa izin pada sesi yang tertinggal.</li>
                    <li><strong>Enkripsi Kunci Asimetris:</strong> Kunci privat disimpan aman di Secure Enclave perangkat dan tidak pernah dikirim ke jaringan.</li>
                </ul>
            </div>

            {{-- 1. Interactive Passkey Test Console --}}
            <section id="demo-passkey" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">1. Konsol Uji Coba Passkey (Live Console)</h2>
                    <p class="text-sm text-muted-foreground">
                        Uji verifikasi biometrik langsung dari peramban Anda:
                    </p>
                </div>

                <div class="p-6 rounded-2xl border border-border bg-card space-y-5 shadow-xs" x-data="{
                    supported: false,
                    isIpAddress: typeof window !== 'undefined' && (window.location.hostname === '127.0.0.1' || window.location.hostname === '::1'),
                    localhostUrl: typeof window !== 'undefined' ? window.location.href.replace('127.0.0.1', 'localhost') : '',
                    registerName: 'Perangkat Saya (' + (navigator.userAgent.includes('Mac') ? 'Mac Touch ID' : (navigator.userAgent.includes('Windows') ? 'Windows Hello' : 'Biometrik')) + ')',
                    accountPassword: '',
                    showPassword: false,
                    loading: false,
                    statusText: '',
                    feedbackMessage: null,
                    feedbackType: 'info',
                    init() {
                        this.supported = !!(window.PublicKeyCredential && (window.VibePasskeyService?.isSupported() ?? true));
                    },
                    async submitRegisterPasskey() {
                        if (!this.accountPassword) {
                            this.feedbackType = 'error';
                            this.feedbackMessage = 'Harap masukkan kata sandi akun Anda terlebih dahulu untuk verifikasi keamanan.';
                            return;
                        }

                        this.loading = true;
                        this.statusText = 'Memverifikasi kata sandi akun...';
                        this.feedbackMessage = null;

                        try {
                            const csrfToken = document.querySelector('meta[name=&quot;csrf-token&quot;]')?.getAttribute('content') || '{{ csrf_token() }}';
                            const verifyRes = await fetch('/confirm-password', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': csrfToken,
                                    'Accept': 'application/json',
                                },
                                body: JSON.stringify({ password: this.accountPassword }),
                            });

                            if (!verifyRes.ok && verifyRes.status !== 204 && !verifyRes.redirected) {
                                const data = await verifyRes.json().catch(() => ({}));
                                this.feedbackType = 'error';
                                this.feedbackMessage = data?.errors?.password?.[0] || data?.message || 'Kata sandi salah. Silakan coba lagi.';
                                this.loading = false;
                                return;
                            }

                            this.statusText = 'Menyiapkan sensor biometrik perangkat...';
                            if (!window.VibePasskeyService) {
                                throw new Error('Modul Passkey belum dimuat di peramban ini.');
                            }

                            const regRes = await window.VibePasskeyService.register(this.registerName || 'Perangkat Saya');
                            if (regRes.success) {
                                this.feedbackType = 'success';
                                this.feedbackMessage = 'Passkey berhasil didaftarkan! Anda kini dapat masuk menggunakan biometrik perangkat.';
                                this.accountPassword = '';
                                setTimeout(() => window.location.reload(), 2000);
                            } else {
                                this.feedbackType = 'error';
                                this.feedbackMessage = regRes.message || 'Pendaftaran passkey dibatalkan oleh pengguna.';
                            }
                        } catch (err) {
                            this.feedbackType = 'error';
                            this.feedbackMessage = err.message || 'Terjadi kesalahan saat memproses pendaftaran passkey.';
                        } finally {
                            this.loading = false;
                            this.statusText = '';
                        }
                    }
                }">
                    <div class="flex items-center justify-between border-b border-border pb-3">
                        <div class="flex items-center gap-2.5">
                            <div class="p-2 rounded-lg bg-primary/10 text-primary">
                                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path d="M12 10a2 2 0 0 0-2 2c0 1.02-.1 2.51-.26 4" />
                                    <path d="M14 13.12c0 2.38 0 6.38-1 8.88" />
                                    <path d="M17.29 21.02c.12-.6.43-2.3.5-3.02" />
                                    <path d="M2 12a10 10 0 0 1 18-6" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-foreground">Status Kompatibilitas Sensor Biometrik</h3>
                                <p class="text-xs text-muted-foreground">FIDO2 / WebAuthn browser support check</p>
                            </div>
                        </div>

                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-medium" :class="supported ? 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400' : 'bg-destructive/10 text-destructive'">
                            <span class="size-1.5 rounded-full" :class="supported ? 'bg-emerald-500' : 'bg-destructive'"></span>
                            <span x-text="supported ? 'Didukung Browser' : 'Tidak Didukung'"></span>
                        </span>
                    </div>

                    {{-- Warning if user is currently on 127.0.0.1 --}}
                    <template x-if="isIpAddress">
                        <div class="p-3 rounded-xl bg-amber-500/10 border border-amber-500/20 text-xs text-amber-700 dark:text-amber-300 flex items-center justify-between gap-3">
                            <span class="leading-relaxed">Anda sedang mengakses via <strong>127.0.0.1</strong>. Buka via <strong>localhost</strong> agar WebAuthn dapat berjalan.</span>
                            <a :href="localhostUrl" class="shrink-0 px-3 py-1.5 bg-amber-500 text-white rounded-lg font-medium hover:bg-amber-600 transition-colors text-xs">
                                Buka di Localhost &rarr;
                            </a>
                        </div>
                    </template>

                    {{-- Feedback message banner --}}
                    <div x-show="feedbackMessage" x-cloak class="p-3.5 rounded-xl text-xs space-y-1" :class="feedbackType === 'success' ? 'bg-emerald-500/10 text-emerald-700 dark:text-emerald-300 border border-emerald-500/20' : 'bg-destructive/10 text-destructive border border-destructive/20'">
                        <p class="font-semibold" x-text="feedbackType === 'success' ? '✓ Berhasil!' : '⚠ Perhatian:'"></p>
                        <p x-text="feedbackMessage" class="leading-relaxed"></p>
                    </div>

                    @auth
                        {{-- Logged in state: Register Passkey Form --}}
                        <div class="space-y-4">
                            <div class="p-3.5 rounded-xl bg-muted/40 border border-border flex items-center justify-between">
                                <div class="text-xs space-y-0.5">
                                    <div class="text-muted-foreground">Login sebagai:</div>
                                    <div class="font-semibold text-foreground">{{ auth()->user()->name }} ({{ auth()->user()->email }})</div>
                                </div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <vibe:button type="submit" variant="ghost" size="xs" class="text-muted-foreground hover:text-destructive">
                                        Logout
                                    </vibe:button>
                                </form>
                            </div>

                            {{-- Passkeys list --}}
                            @php
                                $userPasskeys = auth()->user()->passkeys ?? collect();
                            @endphp
                            <div class="space-y-2">
                                <h4 class="text-xs font-semibold text-foreground uppercase tracking-wider">Passkey Terdaftar ({{ $userPasskeys->count() }})</h4>
                                @if ($userPasskeys->isEmpty())
                                    <p class="text-xs text-muted-foreground italic">Belum ada passkey yang terdaftar di akun ini. Daftarkan perangkat Anda di bawah.</p>
                                @else
                                    <div class="divide-y divide-border rounded-xl border border-border overflow-hidden">
                                        @foreach ($userPasskeys as $key)
                                            <div class="p-3 bg-card flex items-center justify-between text-xs">
                                                <div class="space-y-0.5">
                                                    <div class="font-medium text-foreground flex items-center gap-1.5">
                                                        <svg class="size-3.5 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <path d="M12 10a2 2 0 0 0-2 2c0 1.02-.1 2.51-.26 4" />
                                                        </svg>
                                                        {{ $key->name }}
                                                    </div>
                                                    <div class="text-[10px] text-muted-foreground">Ditambahkan {{ $key->created_at?->diffForHumans() }}</div>
                                                </div>
                                                <form method="POST" action="/user/passkeys/{{ $key->id }}" onsubmit="return confirm('Hapus passkey ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-destructive/70 hover:text-destructive text-[11px] font-medium cursor-pointer">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            {{-- Form Daftarkan Passkey --}}
                            <div class="pt-2 border-t border-border space-y-3">
                                <div>
                                    <h4 class="text-xs font-semibold text-foreground">Daftarkan Passkey Perangkat Ini</h4>
                                    <p class="text-[11px] text-muted-foreground">Masukkan kata sandi akun Anda terlebih dahulu untuk verifikasi keamanan.</p>
                                </div>

                                <form @submit.prevent="submitRegisterPasskey()" class="p-3.5 rounded-xl bg-muted/30 border border-border/70 space-y-3">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                        <div class="space-y-1">
                                            <label class="text-xs font-semibold text-foreground">Nama Perangkat</label>
                                            <input type="text" x-model="registerName" placeholder="Nama perangkat..." class="w-full px-3 py-2 text-xs rounded-lg border border-input bg-background text-foreground shadow-2xs focus:ring-1 focus:ring-primary focus:outline-none" required />
                                        </div>
                                        <div class="space-y-1">
                                            <label class="text-xs font-semibold text-foreground flex items-center justify-between">
                                                <span>Kata Sandi Akun</span>
                                                <span class="text-[10px] text-muted-foreground font-normal">Wajib verifikasi</span>
                                            </label>
                                            <div class="relative">
                                                <input :type="showPassword ? 'text' : 'password'" x-model="accountPassword" placeholder="Masukkan kata sandi akun..." autocomplete="current-password" class="w-full px-3 py-2 pr-9 text-xs rounded-lg border border-input bg-background text-foreground shadow-2xs focus:ring-1 focus:ring-primary focus:outline-none" required />
                                                <button type="button" @click="showPassword = !showPassword" class="absolute right-2.5 top-1/2 -translate-y-1/2 text-muted-foreground hover:text-foreground cursor-pointer" tabindex="-1">
                                                    <svg x-show="!showPassword" class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                                                    <svg x-show="showPassword" x-cloak class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/><path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/><path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"/><line x1="2" x2="22" y1="2" y2="22"/></svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-2 pt-1">
                                        <div class="text-[11px] text-muted-foreground flex items-center gap-1.5">
                                            <svg class="size-3.5 text-primary shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                                            <span>Kata sandi divalidasi via <code>/confirm-password</code> sebelum pendaftaran biometrik.</span>
                                        </div>

                                        <vibe:button type="submit" variant="primary" size="sm" ::disabled="loading || !accountPassword" class="shrink-0 cursor-pointer">
                                            <template x-if="!loading">
                                                <span class="inline-flex items-center gap-1.5">
                                                    <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
                                                    <span>Konfirmasi & Daftarkan Passkey</span>
                                                </span>
                                            </template>
                                            <template x-if="loading">
                                                <span class="inline-flex items-center gap-1.5">
                                                    <svg class="animate-spin size-3.5" viewBox="0 0 24 24" fill="none"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                                    <span x-text="statusText || 'Memproses...'"></span>
                                                </span>
                                            </template>
                                        </vibe:button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @else
                        {{-- Guest state --}}
                        <div class="space-y-3">
                            <p class="text-xs text-muted-foreground leading-relaxed">
                                Untuk mencoba mendaftarkan Passkey, Anda perlu masuk ke akun terlebih dahulu. Anda dapat masuk menggunakan akun demo berikut:
                            </p>

                            <div class="p-3 rounded-xl bg-muted/50 border border-border flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 text-xs">
                                <div>
                                    <span class="text-muted-foreground">Akun Demo: </span>
                                    <code class="font-semibold text-foreground">demo@vibeui.test</code>
                                    <span class="text-muted-foreground"> / Kata Sandi: </span>
                                    <code class="font-semibold text-foreground">password</code>
                                </div>
                                <div class="flex items-center gap-2 shrink-0">
                                    @if (Route::has('dev.login.demo'))
                                        <form method="POST" action="{{ route('dev.login.demo') }}">
                                            @csrf
                                            <vibe:button type="submit" variant="primary" size="xs" class="cursor-pointer">
                                                1-Klik Login Demo
                                            </vibe:button>
                                        </form>
                                    @endif
                                    <vibe:button href="/login" variant="outline" size="xs">
                                        Buka Halaman Login
                                    </vibe:button>
                                </div>
                            </div>
                        </div>
                    @endauth
                </div>
            </section>

            {{-- 2. Integrasi Kode Javascript Client-Side --}}
            <section id="integrasi-client" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">2. Integrasi Client-Side (@laravel/passkeys)</h2>
                    <p class="text-sm text-muted-foreground">
                        Panggil modul Javascript resmi untuk mendaftarkan dan memverifikasi Passkey:
                    </p>
                </div>

                <vibe:highlightjs language="javascript">
// 1. Pendaftaran Passkey Baru (setelah verifikasi password akun)
async function registerPasskey(name) {
    const response = await window.VibePasskeyService.register(name);
    if (response.success) {
        console.log('Passkey berhasil didaftarkan ke peramban!');
    }
}

// 2. Login dengan Passkey (Passwordless)
async function loginWithPasskey() {
    const response = await window.VibePasskeyService.authenticate();
    if (response.success) {
        window.location.href = '/docs';
    }
}
</vibe:highlightjs>
            </section>

        </div>

        {{-- Table of Contents (TOC) --}}
        <div class="col-span-12 md:col-span-3 order-1 md:order-2 sticky top-6 space-y-4">
            <vibe:toc selector="#docs-content" />
        </div>

    </div>
</x-docs.layouts.sidebar>
