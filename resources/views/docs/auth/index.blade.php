<x-docs.layouts.sidebar>
    <vibe:seo title="Authentication System" description="Flux UI-inspired authentication system with flexible login credentials, viewable password toggle, and multi-layout support." schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => 'Starter Kit', 'url' => '/docs/auth'],
        ['name' => 'Authentication', 'url' => '/docs/auth']
    ]" />

    @push('head')
        @vite('resources/js/vibe/passkeys.js')
    @endpush

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">

        {{-- Main Documentation Content --}}
        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            {{-- Component Header --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <vibe:badge variant="primary" class="rounded-full">Starter Kit & Auth</vibe:badge>
                    <span class="text-xs text-muted-foreground">Security & User Management</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">Authentication System</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    Sistem otentikasi lengkap, reaktif, dan aman yang terinspirasi oleh bawaan <strong>Flux UI</strong> (Laravel Livewire Starter Kit). Dilengkapi dengan dukungan login kredensial fleksibel (Email, Username, No. HP, atau kombinasi), toggle kata sandi viewable, rate limiting, dan 3 pilihan varian layout (Card, Simple, Split).
                </p>

                {{-- Quick Links / Live Interactive Previews --}}
                <div class="flex flex-wrap items-center gap-2 pt-2">
                    <vibe:button href="/login" variant="primary" size="sm">
                        <svg class="size-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        Buka /login (Card)
                    </vibe:button>

                    <vibe:button href="/login?layout=split" variant="outline" size="sm">
                        Buka /login (Split)
                    </vibe:button>

                    <vibe:button href="/login?layout=simple" variant="outline" size="sm">
                        Buka /login (Simple)
                    </vibe:button>

                    <vibe:button href="/register" variant="outline" size="sm">
                        Buka /register
                    </vibe:button>

                    <vibe:button href="/forgot-password" variant="outline" size="sm">
                        Buka /forgot-password
                    </vibe:button>
                </div>
            </div>

            {{-- 1. Scaffolding CLI Command --}}
            <section id="scaffolding-cli" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">1. Scaffolding CLI (vibe:auth)</h2>
                    <p class="text-sm text-muted-foreground">
                        Pasang seluruh komponen Livewire auth, view Blade, dan routing ke dalam aplikasi Anda hanya dengan satu baris perintah:
                    </p>
                </div>

                <vibe:highlightjs language="bash" code="php artisan vibe:auth" />

                <div class="space-y-2 text-sm text-muted-foreground">
                    <p>Atau jalankan dengan opsi non-interaktif langsung:</p>
                    <vibe:highlightjs language="bash" code="php artisan vibe:auth --layout=card --login-by=email --force" />
                </div>
            </section>

            {{-- 2. Konfigurasi Kredensial Login Fleksibel --}}
            <section id="login-kredensial" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">2. Kustomisasi Metode Login (Credentials)</h2>
                    <p class="text-sm text-muted-foreground">
                        Sistem otentikasi Vibe UI dirancang modular. Anda dapat mengubah metode login di <code class="text-xs bg-muted px-1.5 py-0.5 rounded-md text-foreground">config/vibe.php</code> atau melalui file <code class="text-xs bg-muted px-1.5 py-0.5 rounded-md text-foreground">.env</code>:
                    </p>
                </div>

                <vibe:highlightjs language="php" code="// config/vibe.php
'auth' => [
    /*
    | Kredensial Login yang Diizinkan (Array):
    | - ['email']                      : Login hanya menggunakan email (Default)
    | - ['email', 'username']          : Login menggunakan email atau username
    | - ['email', 'username', 'phone'] : Login menggunakan email, username, atau no. hp
    | - ['username']                   : Login khusus username
    | - ['phone']                      : Login khusus nomor handphone
    */
    'login_by' => ['email'],

    /*
    | Layout Otentikasi Default:
    | - 'card'              : Tampilan kartu berelevasi di tengah (Default)
    | - 'simple'            : Tampilan minimalis rata tengah
    | - 'split'             : Tampilan split screen 2-kolom (branding + form)
    */
    'default_layout' => 'card',

    /*
    | Pengalihan Setelah Login / Registrasi Berhasil:
    | Contoh: '/docs' atau path tujuan setelah otentikasi.
    */
    'redirect_after_login' => '/docs',
]," />

                <vibe:alert variant="info" class="text-xs">
                    Pengalihan halaman setelah login menggunakan path URL seperti <code class="font-mono">'/docs'</code>. Label dan placeholder input form login juga akan <strong>otomatis menyesuaikan</strong> kombinasi kredensial yang aktif.
                </vibe:alert>
            </section>

            {{-- 3. Fitur Viewable Password Toggle --}}
            <section id="password-toggle" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">3. Viewable Password Toggle (&lt;vibe:input viewable&gt;)</h2>
                    <p class="text-sm text-muted-foreground">
                        Identik dengan komponen <code class="text-xs font-mono bg-muted px-1 py-0.5 rounded">&lt;flux:input type="password" viewable&gt;</code>, Vibe UI kini memiliki atribut <code class="text-xs font-mono bg-muted px-1 py-0.5 rounded">viewable</code> yang menambahkan toggle mata (eye / eye-off) secara instan:
                    </p>
                </div>

                <vibe:preview title="Toggle Password Interaktif">
                    <div class="max-w-sm w-full">
                        <vibe:input label="Kata Sandi" type="password" viewable placeholder="Masukkan kata sandi..." />
                    </div>
                    <x-slot:code>
                        &lt;vibe:input
                        label="Kata Sandi"
                        type="password"
                        viewable
                        placeholder="Masukkan kata sandi..."
                        /&gt;
                    </x-slot:code>
                </vibe:preview>
            </section>

            {{-- 4. Komponen Pemisah & Pembatas (<vibe:separator>) --}}
            <section id="separator-component" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">4. Komponen Pemisah (&lt;vibe:separator&gt;)</h2>
                    <p class="text-sm text-muted-foreground">
                        Garis pemisah horizontal atau vertikal dengan teks label opsional di tengah:
                    </p>
                </div>

                <vibe:preview title="Pemisah Horizontal dengan Teks">
                    <div class="w-full max-w-sm space-y-3">
                        <vibe:button variant="outline" class="w-full justify-center">Masuk dengan Google</vibe:button>
                        <vibe:separator text="atau masuk dengan kredensial" />
                        <vibe:input label="Email" type="email" placeholder="nama@domain.com" />
                    </div>
                    <x-slot:code>
                        &lt;vibe:button variant="outline" class="w-full justify-center"&gt;
                        Masuk dengan Google
                        &lt;/vibe:button&gt;

                        &lt;vibe:separator text="atau masuk dengan kredensial" /&gt;

                        &lt;vibe:input label="Email" type="email" placeholder="nama@domain.com" /&gt;
                    </x-slot:code>
                </vibe:preview>
            </section>

            {{-- 5. Login with Passkey (WebAuthn / FIDO2) --}}
            <section id="login-passkey" class="space-y-4">
                <div class="space-y-1">
                    <div class="flex items-center gap-2">
                        <h2 class="text-xl font-bold text-foreground">5. Login with Passkey (WebAuthn / FIDO2)</h2>
                        <vibe:badge variant="primary" size="sm" class="rounded-full">Passwordless</vibe:badge>
                    </div>
                    <p class="text-sm text-muted-foreground">
                        Otentikasi biometrik modern menggunakan sidik jari (Touch ID), pemindai wajah (Face ID / Windows Hello), atau kunci fisik (YubiKey) berbasis paket resmi <strong>laravel/passkeys</strong> dan <strong>@laravel/passkeys</strong>.
                    </p>
                </div>

                {{-- Important WebAuthn Security Notice --}}
                <div class="p-4 rounded-xl bg-amber-500/10 border border-amber-500/20 text-xs text-amber-700 dark:text-amber-300 space-y-1.5 leading-relaxed">
                    <div class="flex items-center gap-2 font-semibold">
                        <svg class="size-4 shrink-0 text-amber-600 dark:text-amber-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <span>Syarat Keamanan WebAuthn Browser:</span>
                    </div>
                    <ul class="list-disc list-inside space-y-1 text-muted-foreground pl-1">
                        <li><strong>Wajib Menggunakan Nama Domain:</strong> Browser melarang WebAuthn dijalankan pada IP mentah seperti <code>http://127.0.0.1:8000</code>. Buka selalu melalui <code>http://localhost:8000</code> (atau <code>localhost:8001</code>).</li>
                        <li><strong>Daftarkan Perangkat Terlebih Dahulu:</strong> WebAuthn menggunakan enkripsi kunci publik. Anda harus mendaftarkan Passkey perangkat Anda setidaknya sekali sebelum dapat menggunakannya untuk login.</li>
                    </ul>
                </div>

                <div class="space-y-3 text-sm text-muted-foreground">
                    <p>Browser secara otomatis memicu dialog biometrik bawaan OS saat fungsi client-side dipanggil:</p>
                    <vibe:highlightjs language="javascript" code="// Client-side WebAuthn verification
import { Passkeys } from '@laravel/passkeys';

// Login ceremony (pada halaman login)
await Passkeys.verify();

// Register new device passkey (saat pengguna sudah login)
await Passkeys.register({ name: 'MacBook Touch ID' });" />
                </div>

                {{-- Interactive Passkey Test Console --}}
                <div class="p-5 rounded-2xl border border-border bg-card space-y-5 shadow-xs" x-data="{
                    supported: false,
                    isIpAddress: typeof window !== 'undefined' && (window.location.hostname === '127.0.0.1' || window.location.hostname === '::1'),
                    localhostUrl: typeof window !== 'undefined' ? window.location.href.replace('127.0.0.1', 'localhost') : '',
                    registerName: 'Perangkat Saya (' + (navigator.userAgent.includes('Mac') ? 'Mac Touch ID' : (navigator.userAgent.includes('Windows') ? 'Windows Hello' : 'Biometrik')) + ')',
                    registerLoading: false,
                    feedbackMessage: null,
                    feedbackType: 'info',
                    needsPasswordConfirm: false,
                    confirmPassword: '',
                    confirmLoading: false,
                    init() {
                        this.supported = !!(window.PublicKeyCredential && (window.VibePasskeyService?.isSupported() ?? true));
                    },
                    async confirmAndRegister() {
                        this.confirmLoading = true;
                        this.feedbackMessage = null;
                        try {
                            const csrfToken = document.querySelector('meta[name=&quot;csrf-token&quot;]')?.getAttribute('content') || '';
                            const res = await fetch('/confirm-password', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': csrfToken,
                                    'Accept': 'application/json',
                                },
                                body: JSON.stringify({ password: this.confirmPassword }),
                            });
                            if (res.ok || res.status === 204 || res.redirected) {
                                this.needsPasswordConfirm = false;
                                this.confirmPassword = '';
                                await this.registerPasskey();
                            } else {
                                const data = await res.json().catch(() => ({}));
                                this.feedbackType = 'error';
                                this.feedbackMessage = data?.errors?.password?.[0] || data?.message || 'Password salah. Silakan coba lagi.';
                            }
                        } catch (err) {
                            this.feedbackType = 'error';
                            this.feedbackMessage = err.message || 'Gagal mengkonfirmasi password.';
                        } finally {
                            this.confirmLoading = false;
                        }
                    },
                    async registerPasskey() {
                        this.registerLoading = true;
                        this.feedbackMessage = null;
                        try {
                            if (!window.VibePasskeyService) {
                                throw new Error('Modul Passkey belum dimuat.');
                            }
                            const res = await window.VibePasskeyService.register(this.registerName || 'Perangkat Saya');
                            if (res.success) {
                                this.feedbackType = 'success';
                                this.feedbackMessage = 'Passkey berhasil didaftarkan! Sekarang silakan coba logout dan masuk menggunakan tombol \'Masuk dengan Passkey\' di halaman login.';
                                setTimeout(() => window.location.reload(), 2500);
                            } else {
                                this.feedbackType = 'error';
                                this.feedbackMessage = res.message || 'Pendaftaran passkey dibatalkan.';
                            }
                        } catch (err) {
                            const msg = err.message || '';
                            if (msg.toLowerCase().includes('password') || msg.toLowerCase().includes('confirm') || msg.toLowerCase().includes('423') || msg.toLowerCase().includes('403')) {
                                this.needsPasswordConfirm = true;
                                this.feedbackType = 'error';
                                this.feedbackMessage = 'Konfirmasi password diperlukan untuk mendaftarkan passkey. Silakan masukkan password Anda.';
                            } else {
                                this.feedbackType = 'error';
                                this.feedbackMessage = msg || 'Terjadi kesalahan saat pendaftaran passkey.';
                            }
                        } finally {
                            this.registerLoading = false;
                        }
                    },
                    async tryRegisterPasskey() {
                        this.registerLoading = true;
                        this.feedbackMessage = null;
                        try {
                            if (!window.VibePasskeyService) throw new Error('Modul Passkey belum dimuat.');
                            // Pre-check: hit options endpoint to detect if password confirmation is needed
                            const csrfToken = document.querySelector('meta[name=&quot;csrf-token&quot;]')?.getAttribute('content') || '';
                            const check = await fetch('/user/passkeys/options', {
                                headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': csrfToken }
                            });
                            if (check.status === 423 || check.status === 403) {
                                this.needsPasswordConfirm = true;
                                this.feedbackType = 'error';
                                this.feedbackMessage = 'Konfirmasi password diperlukan untuk mendaftarkan passkey. Silakan masukkan password Anda di bawah.';
                                this.registerLoading = false;
                                return;
                            }
                            const res = await window.VibePasskeyService.register(this.registerName || 'Perangkat Saya');
                            if (res.success) {
                                this.feedbackType = 'success';
                                this.feedbackMessage = 'Passkey berhasil didaftarkan! Sekarang silakan coba logout dan masuk menggunakan tombol \'Masuk dengan Passkey\' di halaman login.';
                                setTimeout(() => window.location.reload(), 2500);
                            } else {
                                this.feedbackType = 'error';
                                this.feedbackMessage = res.message || 'Pendaftaran passkey dibatalkan.';
                            }
                        } catch (err) {
                            this.feedbackType = 'error';
                            this.feedbackMessage = err.message || 'Terjadi kesalahan saat pendaftaran passkey.';
                        } finally {
                            this.registerLoading = false;
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
                                <h3 class="text-sm font-semibold text-foreground">Uji Coba Langsung Passkey (WebAuthn)</h3>
                                <p class="text-xs text-muted-foreground">Tes registrasi & autentikasi biometrik langsung dari browser Anda</p>
                            </div>
                        </div>

                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-medium" :class="supported ? 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400' : 'bg-destructive/10 text-destructive'">
                            <span class="size-1.5 rounded-full" :class="supported ? 'bg-emerald-500' : 'bg-destructive'"></span>
                            <span x-text="supported ? 'Browser Didukung' : 'Tidak Didukung'"></span>
                        </span>
                    </div>

                    {{-- Warning if user is currently on 127.0.0.1 --}}
                    <template x-if="isIpAddress">
                        <div class="p-3 rounded-xl bg-amber-500/10 border border-amber-500/20 text-xs text-amber-700 dark:text-amber-300 flex items-center justify-between gap-3">
                            <span class="leading-relaxed">Anda sedang mengakses via <strong>127.0.0.1</strong>. Buka via <strong>localhost</strong> agar WebAuthn dapat berjalan normal.</span>
                            <a :href="localhostUrl" class="shrink-0 px-3 py-1.5 bg-amber-500 text-white rounded-lg font-medium hover:bg-amber-600 transition-colors text-xs">
                                Buka di Localhost &rarr;
                            </a>
                        </div>
                    </template>

                    {{-- Feedback message banner --}}
                    <div x-show="feedbackMessage" x-cloak class="p-3.5 rounded-xl text-xs space-y-1" :class="feedbackType === 'success' ? 'bg-emerald-500/10 text-emerald-700 dark:text-emerald-300 border border-emerald-500/20' : 'bg-destructive/10 text-destructive border border-destructive/20'">
                        <p class="font-semibold" x-text="feedbackType === 'success' ? 'Berhasil!' : 'Perhatian:'"></p>
                        <p x-text="feedbackMessage" class="leading-relaxed"></p>
                    </div>

                    @auth
                        {{-- Logged in state: Register Passkey UI --}}
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
                                    <p class="text-xs text-muted-foreground italic">Belum ada passkey yang terdaftar di akun ini. Silakan daftarkan perangkat Anda di bawah.</p>
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

                            {{-- Form to add new passkey --}}
                            <div class="pt-2 border-t border-border space-y-3">
                                <h4 class="text-xs font-semibold text-foreground">Daftarkan Passkey Perangkat Ini</h4>

                                {{-- Step 1: Device name + register button --}}
                                <div x-show="!needsPasswordConfirm" class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2">
                                    <input type="text" x-model="registerName" placeholder="Nama perangkat (misal: Touch ID MacBook)" class="flex-1 px-3 py-2 text-xs rounded-lg border border-input bg-background text-foreground shadow-2xs focus:ring-1 focus:ring-ring focus:outline-none" />
                                    <vibe:button type="button" variant="primary" size="sm" @click="tryRegisterPasskey()" ::disabled="registerLoading" class="shrink-0 cursor-pointer">
                                        <template x-if="!registerLoading">
                                            <span class="inline-flex items-center gap-1.5">
                                                <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                                </svg>
                                                <span>Daftarkan Passkey</span>
                                            </span>
                                        </template>
                                        <template x-if="registerLoading">
                                            <span class="inline-flex items-center gap-1.5">
                                                <svg class="animate-spin size-3.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                                <span>Memeriksa...</span>
                                            </span>
                                        </template>
                                    </vibe:button>
                                </div>

                                {{-- Step 2: Inline password confirmation (appears when password.confirm middleware is triggered) --}}
                                <div x-show="needsPasswordConfirm" x-cloak class="space-y-3 p-3.5 rounded-xl bg-amber-500/10 border border-amber-500/20">
                                    <div class="flex items-center gap-2 text-xs font-semibold text-amber-700 dark:text-amber-300">
                                        <svg class="size-3.5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                        Konfirmasi Password Diperlukan
                                    </div>
                                    <p class="text-[11px] text-amber-700/80 dark:text-amber-300/70 leading-relaxed">
                                        Untuk keamanan, masukkan password akun Anda untuk melanjutkan pendaftaran passkey.
                                    </p>
                                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2">
                                        <input
                                            type="password"
                                            x-model="confirmPassword"
                                            @keydown.enter="confirmAndRegister()"
                                            placeholder="Masukkan password akun Anda..."
                                            autocomplete="current-password"
                                            class="flex-1 px-3 py-2 text-xs rounded-lg border border-amber-400/50 bg-background text-foreground shadow-2xs focus:ring-1 focus:ring-amber-400 focus:outline-none"
                                        />
                                        <div class="flex items-center gap-2 shrink-0">
                                            <vibe:button type="button" variant="primary" size="sm" @click="confirmAndRegister()" ::disabled="confirmLoading || !confirmPassword" class="cursor-pointer">
                                                <template x-if="!confirmLoading">
                                                    <span>Konfirmasi & Daftar</span>
                                                </template>
                                                <template x-if="confirmLoading">
                                                    <span class="inline-flex items-center gap-1.5">
                                                        <svg class="animate-spin size-3.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                                        Memverifikasi...
                                                    </span>
                                                </template>
                                            </vibe:button>
                                            <button type="button" @click="needsPasswordConfirm = false; confirmPassword = ''; feedbackMessage = null" class="text-xs text-muted-foreground hover:text-foreground transition-colors cursor-pointer">
                                                Batal
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        {{-- Guest state: prompt login or 1-click test login --}}
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

            {{-- 6. Rute yang Tersedia --}}
            <section id="daftar-rute" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">6. Daftar Endpoint & Rute Bawaan</h2>
                    <p class="text-sm text-muted-foreground">
                        Seluruh rute telah dikonfigurasi di <code class="text-xs font-mono bg-muted px-1.5 py-0.5 rounded">routes/auth.php</code> dan paket <code class="text-xs font-mono bg-muted px-1.5 py-0.5 rounded">laravel/passkeys</code>:
                    </p>
                </div>

                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column>HTTP Method</vibe:table.column>
                        <vibe:table.column>URI</vibe:table.column>
                        <vibe:table.column>Handler / Paket</vibe:table.column>
                        <vibe:table.column>Keterangan</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-emerald-600">GET</vibe:table.cell>
                            <vibe:table.cell class="font-mono font-medium text-foreground">/login</vibe:table.cell>
                            <vibe:table.cell class="font-mono text-xs text-muted-foreground">App\Livewire\Auth\Login</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">Halaman login (Kredensial & Passkey)</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-emerald-600">GET</vibe:table.cell>
                            <vibe:table.cell class="font-mono font-medium text-foreground">/passkeys/login/options</vibe:table.cell>
                            <vibe:table.cell class="font-mono text-xs text-muted-foreground">laravel/passkeys</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">WebAuthn challenge untuk login</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-amber-600">POST</vibe:table.cell>
                            <vibe:table.cell class="font-mono font-medium text-foreground">/passkeys/login</vibe:table.cell>
                            <vibe:table.cell class="font-mono text-xs text-muted-foreground">laravel/passkeys</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">Verifikasi assertion & login passkey</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-emerald-600">GET</vibe:table.cell>
                            <vibe:table.cell class="font-mono font-medium text-foreground">/user/passkeys/options</vibe:table.cell>
                            <vibe:table.cell class="font-mono text-xs text-muted-foreground">laravel/passkeys</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">Pendaftaran passkey perangkat baru</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-amber-600">POST</vibe:table.cell>
                            <vibe:table.cell class="font-mono font-medium text-foreground">/user/passkeys</vibe:table.cell>
                            <vibe:table.cell class="font-mono text-xs text-muted-foreground">laravel/passkeys</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">Simpan kredensial passkey baru</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-rose-600">DELETE</vibe:table.cell>
                            <vibe:table.cell class="font-mono font-medium text-foreground">/user/passkeys/{passkey}</vibe:table.cell>
                            <vibe:table.cell class="font-mono text-xs text-muted-foreground">laravel/passkeys</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">Hapus passkey yang terdaftar</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-emerald-600">GET</vibe:table.cell>
                            <vibe:table.cell class="font-mono font-medium text-foreground">/register</vibe:table.cell>
                            <vibe:table.cell class="font-mono text-xs text-muted-foreground">App\Livewire\Auth\Register</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">Pendaftaran akun pengguna</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-emerald-600">GET</vibe:table.cell>
                            <vibe:table.cell class="font-mono font-medium text-foreground">/forgot-password</vibe:table.cell>
                            <vibe:table.cell class="font-mono text-xs text-muted-foreground">App\Livewire\Auth\ForgotPassword</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">Permintaan link reset password</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-emerald-600">GET</vibe:table.cell>
                            <vibe:table.cell class="font-mono font-medium text-foreground">/reset-password/{token}</vibe:table.cell>
                            <vibe:table.cell class="font-mono text-xs text-muted-foreground">App\Livewire\Auth\ResetPassword</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">Eksekusi reset kata sandi baru</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-emerald-600">GET</vibe:table.cell>
                            <vibe:table.cell class="font-mono font-medium text-foreground">/verify-email</vibe:table.cell>
                            <vibe:table.cell class="font-mono text-xs text-muted-foreground">App\Livewire\Auth\VerifyEmail</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">Notifikasi verifikasi email</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-amber-600">POST</vibe:table.cell>
                            <vibe:table.cell class="font-mono font-medium text-foreground">/logout</vibe:table.cell>
                            <vibe:table.cell class="font-mono text-xs text-muted-foreground">Session Invalidate & Logout</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">Keluar dari sesi akun</vibe:table.cell>
                        </vibe:table.row>
                    </vibe:table.rows>
                </vibe:table>
            </section>

        </div>

        {{-- Table of Contents Sidebar (Right Side) --}}
        <aside class="col-span-12 order-1 md:order-2 md:col-span-3 w-full md:sticky md:top-6 group-has-[header.sticky]/docs:md:top-20">
            <vibe:toc selector="#docs-content" />
        </aside>

    </div>
</x-docs.layouts.sidebar>
