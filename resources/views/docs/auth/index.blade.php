<x-docs.layouts.sidebar>
    <vibe:seo 
        title="Sistem Autentikasi Modern — Vibe UI" 
        description="Dokumentasi lengkap dan ikhtisar arsitektur sistem autentikasi Vibe UI: Scaffolding CLI vibe:auth, multi-layout (Card, Simple, Split), kredensial fleksibel (email, username, no. hp), konfirmasi password (sudo mode), idle timeout, 2FA TOTP, dan login biometrik Passkey (WebAuthn)." 
        schema="techarticle" 
        :breadcrumbs="[
            ['name' => 'Home', 'url' => '/'],
            ['name' => 'Docs', 'url' => route('docs.index')],
            ['name' => 'Authentication', 'url' => route('docs.auth.index')],
            ['name' => 'Ikhtisar', 'url' => route('docs.auth.index')]
        ]" 
    />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">

        {{-- Main Documentation Content --}}
        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            {{-- Hero Header --}}
            <div class="space-y-4">
                <div class="flex flex-wrap items-center gap-2">
                    <vibe:badge variant="primary" class="rounded-full">Flux UI Standard</vibe:badge>
                    <vibe:badge variant="outline" class="rounded-full">Livewire 3 + Tailwind</vibe:badge>
                    <vibe:badge variant="secondary" class="rounded-full">WebAuthn / Passkey</vibe:badge>
                    <vibe:badge variant="success" class="rounded-full font-medium">Production Ready</vibe:badge>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">Sistem Autentikasi Vibe UI</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    Sistem autentikasi dan starter kit komprehensif, modular, dan reaktif yang dirancang dengan standar keindahan <strong>Flux UI</strong>. Menyediakan 3 pilihan tata letak responsif (Card, Simple, Split), dukungan login multi-kredensial otomatis (Email, Username, No. HP), proteksi inaktivitas workstation (Idle Timeout), verifikasi password untuk aksi sensitif (Sudo Mode), verifikasi dua langkah (2FA TOTP), serta autentikasi biometrik modern tanpa kata sandi <strong>Passkey (WebAuthn / FIDO2)</strong>.
                </p>

                {{-- Quick Links / Live Interactive Previews --}}
                <div class="pt-2">
                    <p class="text-xs font-semibold text-foreground uppercase tracking-wider mb-2">Pratinjau Halaman Nyata:</p>
                    <div class="flex flex-wrap items-center gap-2">
                        <vibe:button href="/login" variant="primary" size="sm">
                            <svg class="size-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                            /login (Card)
                        </vibe:button>

                        <vibe:button href="/login?layout=split" variant="outline" size="sm">
                            /login (Split Screen)
                        </vibe:button>

                        <vibe:button href="/login?layout=simple" variant="outline" size="sm">
                            /login (Simple Frameless)
                        </vibe:button>

                        <vibe:button href="/register" variant="outline" size="sm">
                            /register
                        </vibe:button>

                        <vibe:button href="/forgot-password" variant="outline" size="sm">
                            /forgot-password
                        </vibe:button>

                        <vibe:button href="/confirm-password" variant="outline" size="sm">
                            /confirm-password
                        </vibe:button>
                    </div>
                </div>
            </div>

            {{-- 1. Peta Modul Autentikasi --}}
            <section id="peta-modul" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">1. Peta Modul & Panduan Lengkap</h2>
                    <p class="text-sm text-muted-foreground">
                        Jelajahi dokumentasi mendalam untuk masing-masing bagian dari sistem autentikasi Vibe UI:
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Modul 1: Instalasi & CLI --}}
                    <a href="{{ route('docs.auth.installation') }}" class="group block p-5 rounded-2xl border border-border bg-card hover:border-primary/50 transition-all shadow-2xs hover:shadow-xs space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="p-2.5 rounded-xl bg-primary/10 text-primary group-hover:scale-105 transition-transform">
                                <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polyline points="4 17 10 11 4 5"></polyline>
                                    <line x1="12" y1="19" x2="20" y2="19"></line>
                                </svg>
                            </div>
                            <vibe:badge variant="outline" size="xs" class="rounded-full">CLI & Form</vibe:badge>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-foreground group-hover:text-primary transition-colors">
                                Instalasi & Scaffolding CLI &rarr;
                            </h3>
                            <p class="text-xs text-muted-foreground mt-1 leading-relaxed">
                                Panduan pemasangan satu baris perintah <code>php artisan vibe:auth</code>, konfigurasi kredensial (email, username, no. hp), 3 pilihan tata letak (Card, Simple, Split), serta komponen form pembantu.
                            </p>
                        </div>
                    </a>

                    {{-- Modul 2: Konfirmasi Password --}}
                    <a href="{{ route('docs.auth.confirm') }}" class="group block p-5 rounded-2xl border border-border bg-card hover:border-primary/50 transition-all shadow-2xs hover:shadow-xs space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="p-2.5 rounded-xl bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 group-hover:scale-105 transition-transform">
                                <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect width="18" height="11" x="3" y="11" rx="2" ry="2"/>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                                </svg>
                            </div>
                            <vibe:badge variant="outline" size="xs" class="rounded-full">Sudo Mode</vibe:badge>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-foreground group-hover:text-primary transition-colors">
                                Konfirmasi Password (Sudo Mode) &rarr;
                            </h3>
                            <p class="text-xs text-muted-foreground mt-1 leading-relaxed">
                                Proteksi operasi berisiko tinggi (ganti email, hapus akun, reset API token) dengan middleware <code>confirm</code> &amp; <code>confirm:300</code>, simulator live modal, dan rute penguncian sesi.
                            </p>
                        </div>
                    </a>

                    {{-- Modul 3: Idle Timeout --}}
                    <a href="{{ route('docs.auth.idle') }}" class="group block p-5 rounded-2xl border border-border bg-card hover:border-primary/50 transition-all shadow-2xs hover:shadow-xs space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="p-2.5 rounded-xl bg-amber-500/10 text-amber-600 dark:text-amber-400 group-hover:scale-105 transition-transform">
                                <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"/>
                                    <polyline points="12 6 12 12 16 14"/>
                                </svg>
                            </div>
                            <vibe:badge variant="outline" size="xs" class="rounded-full">Auto Lock</vibe:badge>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-foreground group-hover:text-primary transition-colors">
                                Idle Timeout & Session Lock &rarr;
                            </h3>
                            <p class="text-xs text-muted-foreground mt-1 leading-relaxed">
                                Pencegah akses workstation tanpa pengawasan. Memantau keaktifan mouse/keyboard di peramban, mengunci sesi otomatis via middleware <code>idle:{detik}</code>, dan playground interaktif.
                            </p>
                        </div>
                    </a>

                    {{-- Modul 4: Two-Factor (2FA) --}}
                    <a href="{{ route('docs.auth.two-factor') }}" class="group block p-5 rounded-2xl border border-border bg-card hover:border-primary/50 transition-all shadow-2xs hover:shadow-xs space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="p-2.5 rounded-xl bg-purple-500/10 text-purple-600 dark:text-purple-400 group-hover:scale-105 transition-transform">
                                <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect width="14" height="20" x="5" y="2" rx="2" ry="2"/>
                                    <line x1="12" y1="18" x2="12.01" y2="18"/>
                                </svg>
                            </div>
                            <vibe:badge variant="outline" size="xs" class="rounded-full">TOTP RFC 6238</vibe:badge>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-foreground group-hover:text-primary transition-colors">
                                Autentikasi Dua Faktor (2FA) &rarr;
                            </h3>
                            <p class="text-xs text-muted-foreground mt-1 leading-relaxed">
                                Keamanan berlapis kompatibel dengan Google Authenticator &amp; Authy. Lengkap dengan pairing QR Code via <code>&lt;vibe:display.qrcode&gt;</code>, input OTP 6 kotak, dan kode pemulihan.
                            </p>
                        </div>
                    </a>

                    {{-- Modul 5: Passkey WebAuthn --}}
                    <a href="{{ route('docs.auth.passkey') }}" class="group block p-5 rounded-2xl border border-border bg-card hover:border-primary/50 transition-all shadow-2xs hover:shadow-xs space-y-3 md:col-span-2">
                        <div class="flex items-center justify-between">
                            <div class="p-2.5 rounded-xl bg-sky-500/10 text-sky-600 dark:text-sky-400 group-hover:scale-105 transition-transform">
                                <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M12 10a2 2 0 0 0-2 2c0 1.02-.1 2.51-.26 4"/>
                                    <path d="M14 13.12c0 2.38 0 6.38-1 8.88"/>
                                    <path d="M17.29 21.02c.12-.6.43-2.3.5-3.02"/>
                                    <path d="M2 12a10 10 0 0 1 18-6"/>
                                </svg>
                            </div>
                            <div class="flex items-center gap-2">
                                <vibe:badge variant="primary" size="xs" class="rounded-full">Passwordless</vibe:badge>
                                <vibe:badge variant="outline" size="xs" class="rounded-full">FIDO2 / WebAuthn</vibe:badge>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-foreground group-hover:text-primary transition-colors">
                                Autentikasi Biometrik Passkey (WebAuthn) &rarr;
                            </h3>
                            <p class="text-xs text-muted-foreground mt-1 leading-relaxed">
                                Masa depan autentikasi modern tanpa risiko phishing. Masuk dalam hitungan detik menggunakan Touch ID, Face ID, Windows Hello, atau kunci fisik YubiKey berbasis paket resmi <code>laravel/passkeys</code>.
                            </p>
                        </div>
                    </a>
                </div>
            </section>

            {{-- 2. Alur Lifecycle Keamanan --}}
            <section id="alur-keamanan" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">2. Siklus Hidup & Arsitektur Keamanan</h2>
                    <p class="text-sm text-muted-foreground">
                        Bagaimana seluruh lapisan keamanan bekerja selaras menjaga akun pengguna dari login hingga logout:
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
                    <div class="p-4 rounded-xl border border-border bg-card space-y-2">
                        <div class="size-6 rounded-lg bg-primary/10 text-primary flex items-center justify-center text-xs font-bold">1</div>
                        <h4 class="text-xs font-bold text-foreground">Masuk / Autentikasi</h4>
                        <p class="text-[11px] text-muted-foreground leading-relaxed">
                            Validasi kredensial (Email, Username, No. HP) atau pemicu biometrik Passkey instan.
                        </p>
                    </div>

                    <div class="p-4 rounded-xl border border-border bg-card space-y-2">
                        <div class="size-6 rounded-lg bg-purple-500/10 text-purple-600 dark:text-purple-400 flex items-center justify-center text-xs font-bold">2</div>
                        <h4 class="text-xs font-bold text-foreground">Tantangan 2FA</h4>
                        <p class="text-[11px] text-muted-foreground leading-relaxed">
                            Jika 2FA aktif, pengguna dialihkan ke layar input token TOTP 6 digit sebelum sesi diberikan.
                        </p>
                    </div>

                    <div class="p-4 rounded-xl border border-border bg-card space-y-2">
                        <div class="size-6 rounded-lg bg-amber-500/10 text-amber-600 dark:text-amber-400 flex items-center justify-center text-xs font-bold">3</div>
                        <h4 class="text-xs font-bold text-foreground">Pemantau Inaktivitas</h4>
                        <p class="text-[11px] text-muted-foreground leading-relaxed">
                            Middleware <code>idle</code> mengawasi aktivitas. Jika pasif melebihi batas waktu, sesi otomatis dikunci.
                        </p>
                    </div>

                    <div class="p-4 rounded-xl border border-border bg-card space-y-2">
                        <div class="size-6 rounded-lg bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-xs font-bold">4</div>
                        <h4 class="text-xs font-bold text-foreground">Sudo Mode Sensitif</h4>
                        <p class="text-[11px] text-muted-foreground leading-relaxed">
                            Aksi berisiko tinggi (ganti email/passkey) mewajibkan verifikasi ulang via <code>confirm</code>.
                        </p>
                    </div>
                </div>
            </section>

            {{-- 3. Matriks Fitur & Perlindungan --}}
            <section id="matriks-fitur" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">3. Matriks Fitur & Kompatibilitas</h2>
                    <p class="text-sm text-muted-foreground">
                        Ringkasan teknis dari teknologi autentikasi yang disertakan dalam Vibe UI:
                    </p>
                </div>

                <div class="overflow-x-auto rounded-xl border border-border">
                    <table class="w-full text-left text-xs border-collapse">
                        <thead>
                            <tr class="bg-muted/50 border-b border-border text-foreground font-semibold">
                                <th class="p-3">Fitur Keamanan</th>
                                <th class="p-3">Mekanisme Backend</th>
                                <th class="p-3">Implementasi Klien</th>
                                <th class="p-3">Tingkat Perlindungan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border text-muted-foreground">
                            <tr>
                                <td class="p-3 font-medium text-foreground">Multi-Credential Login</td>
                                <td class="p-3 font-mono text-[11px]">Login.php (Auto-detect regex)</td>
                                <td class="p-3">&lt;vibe:input&gt; fleksibel</td>
                                <td class="p-3"><vibe:badge variant="outline" size="xs">Standar</vibe:badge></td>
                            </tr>
                            <tr>
                                <td class="p-3 font-medium text-foreground">Multi-Layout Responsif</td>
                                <td class="p-3 font-mono text-[11px]">config/vibe.php + query param</td>
                                <td class="p-3">Card, Simple, Split Screen</td>
                                <td class="p-3"><vibe:badge variant="outline" size="xs">Tampilan</vibe:badge></td>
                            </tr>
                            <tr>
                                <td class="p-3 font-medium text-foreground">Konfirmasi Sandi (Sudo Mode)</td>
                                <td class="p-3 font-mono text-[11px]">Middleware 'confirm' / 'confirm:300'</td>
                                <td class="p-3">Modal AJAX / /confirm-password</td>
                                <td class="p-3"><vibe:badge variant="primary" size="xs">Tinggi</vibe:badge></td>
                            </tr>
                            <tr>
                                <td class="p-3 font-medium text-foreground">Proteksi Inaktivitas (Idle Lock)</td>
                                <td class="p-3 font-mono text-[11px]">Middleware 'idle:{sec}' (VibeIdleTimeout)</td>
                                <td class="p-3">Alpine.js Mouse &amp; Key Tracker</td>
                                <td class="p-3"><vibe:badge variant="primary" size="xs">Tinggi</vibe:badge></td>
                            </tr>
                            <tr>
                                <td class="p-3 font-medium text-foreground">Two-Factor Authentication (2FA)</td>
                                <td class="p-3 font-mono text-[11px]">TwoFactor.php (TOTP RFC 6238)</td>
                                <td class="p-3">&lt;vibe:display.qrcode&gt; &amp; &lt;vibe:input.otp&gt;</td>
                                <td class="p-3"><vibe:badge variant="success" size="xs">Sangat Tinggi</vibe:badge></td>
                            </tr>
                            <tr>
                                <td class="p-3 font-medium text-foreground">Passkey Biometrik (Passwordless)</td>
                                <td class="p-3 font-mono text-[11px]">laravel/passkeys</td>
                                <td class="p-3">@laravel/passkeys + WebAuthn API</td>
                                <td class="p-3"><vibe:badge variant="success" size="xs">Maksimal (Anti-Phishing)</vibe:badge></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

            {{-- 4. Struktur Berkas yang Dihasilkan --}}
            <section id="struktur-berkas" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">4. Struktur Berkas Scaffolding Starter Kit</h2>
                    <p class="text-sm text-muted-foreground">
                        Semua berkas yang dipasang secara otomatis ke aplikasi Anda ketika menjalankan perintah <code>vibe:auth</code>:
                    </p>
                </div>

                <div class="p-5 rounded-2xl bg-muted/40 border border-border text-xs font-mono space-y-2 text-muted-foreground">
                    <div class="text-foreground font-semibold pb-1 border-b border-border/60">Arsitektur Berkas Auth Vibe UI:</div>
                    <ul class="space-y-1.5 pl-2 leading-relaxed text-[11px]">
                        <li>📁 <span class="text-foreground font-semibold">app/Livewire/Auth/</span>
                            <ul class="pl-4 space-y-0.5 border-l border-border/80 ml-1">
                                <li>📄 Login.php <span class="text-muted-foreground/70">— Komponen form login reaktif</span></li>
                                <li>📄 Register.php <span class="text-muted-foreground/70">— Komponen pendaftaran akun baru</span></li>
                                <li>📄 ForgotPassword.php <span class="text-muted-foreground/70">— Reset sandi via email</span></li>
                                <li>📄 ResetPassword.php <span class="text-muted-foreground/70">— Form penetapan kata sandi baru</span></li>
                                <li>📄 VerifyEmail.php <span class="text-muted-foreground/70">— Notifikasi verifikasi email</span></li>
                                <li>📄 ConfirmPassword.php <span class="text-muted-foreground/70">— Halaman konfirmasi sandi sudo mode</span></li>
                            </ul>
                        </li>
                        <li>📁 <span class="text-foreground font-semibold">resources/views/auth/</span>
                            <ul class="pl-4 space-y-0.5 border-l border-border/80 ml-1">
                                <li>📄 login.blade.php, register.blade.php, forgot-password.blade.php, dll.</li>
                                <li>📁 <span class="text-foreground font-semibold">layouts/</span> &rarr; card.blade.php, simple.blade.php, split.blade.php</li>
                            </ul>
                        </li>
                        <li>📁 <span class="text-foreground font-semibold">routes/</span> &rarr; auth.php <span class="text-muted-foreground/70">— Rute lengkap sistem autentikasi</span></li>
                        <li>📁 <span class="text-foreground font-semibold">config/</span> &rarr; vibe.php &amp; passkeys.php <span class="text-muted-foreground/70">— Konfigurasi layout, kredensial &amp; WebAuthn</span></li>
                    </ul>
                </div>
            </section>

            {{-- 5. Mulai Cepat (Quickstart) --}}
            <section id="mulai-cepat" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">5. Mulai Cepat dalam 3 Langkah</h2>
                    <p class="text-sm text-muted-foreground">
                        Pasang seluruh fungsionalitas di atas ke dalam proyek Anda sekarang:
                    </p>
                </div>

                <div class="space-y-3">
                    <div class="p-4 rounded-xl border border-border bg-card space-y-2">
                        <div class="flex items-center gap-2 text-xs font-bold text-foreground">
                            <span class="size-5 rounded-full bg-primary text-primary-foreground flex items-center justify-center text-[10px]">1</span>
                            Jalankan Perintah Scaffolding
                        </div>
                        <vibe:highlightjs language="bash" code="php artisan vibe:auth" />
                    </div>

                    <div class="p-4 rounded-xl border border-border bg-card space-y-2">
                        <div class="flex items-center gap-2 text-xs font-bold text-foreground">
                            <span class="size-5 rounded-full bg-primary text-primary-foreground flex items-center justify-center text-[10px]">2</span>
                            Pilih Layout & Mode Login (Interaktif)
                        </div>
                        <p class="text-xs text-muted-foreground">
                            CLI akan menanyakan tata letak default (Card / Simple / Split) dan metode kredensial (Email / Username / Phone).
                        </p>
                    </div>

                    <div class="p-4 rounded-xl border border-border bg-card space-y-2">
                        <div class="flex items-center gap-2 text-xs font-bold text-foreground">
                            <span class="size-5 rounded-full bg-primary text-primary-foreground flex items-center justify-center text-[10px]">3</span>
                            Jalankan Migrasi Database
                        </div>
                        <vibe:highlightjs language="bash" code="php artisan migrate" />
                    </div>
                </div>

                {{-- Bottom Pagination Next Link --}}
                <div class="pt-6 border-t border-border flex justify-end">
                    <a href="{{ route('docs.auth.installation') }}" class="inline-flex items-center gap-3 p-4 rounded-xl border border-border bg-card hover:border-primary/50 transition-colors group text-right">
                        <div>
                            <span class="text-[10px] uppercase font-bold text-muted-foreground tracking-wider block">Langkah Berikutnya</span>
                            <span class="text-sm font-semibold text-foreground group-hover:text-primary transition-colors">Panduan Instalasi &amp; Konfigurasi &rarr;</span>
                        </div>
                    </a>
                </div>
            </section>

        </div>

        {{-- Table of Contents (TOC) --}}
        <div class="col-span-12 md:col-span-3 order-1 md:order-2 sticky top-6 space-y-4">
            <vibe:toc selector="#docs-content" />
        </div>

    </div>
</x-docs.layouts.sidebar>
