<x-docs.layouts.sidebar>
    <vibe:seo title="Instalasi & Konfigurasi Auth — Vibe UI" description="Panduan instalasi dan scaffolding sistem autentikasi Vibe UI: CLI interaktif vibe:auth, multi-layout (card, simple, split), kredensial fleksibel (email, username, no. hp), dan komponen formulir." schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => 'Authentication', 'url' => route('docs.auth.installation')],
        ['name' => 'Instalasi Auth', 'url' => route('docs.auth.installation')]
    ]" />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">

        {{-- Main Documentation Content --}}
        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-12">

            {{-- Component Header --}}
            <div class="space-y-4">
                <div class="flex flex-wrap items-center gap-2">
                    <vibe:badge variant="primary" class="rounded-full">Starter Kit & Auth</vibe:badge>
                    <vibe:badge variant="outline" class="rounded-full">Production Ready</vibe:badge>
                    <span class="text-xs text-muted-foreground">Livewire 3 + Tailwind CSS</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">Instalasi Autentikasi</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    Sistem otentikasi lengkap, modern, dan reaktif yang terinspirasi oleh standar <strong>Flux UI</strong>. Dapat di-scaffold ke dalam aplikasi Laravel Anda dengan satu baris perintah interaktif, menyediakan 3 pilihan tata letak responsif (Card, Simple, Split), serta mendukung multi-kredensial login (Email, Username, No. HP).
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
                        Pasang seluruh komponen Livewire auth, template Blade, migrasi, dan routing ke dalam aplikasi Laravel Anda dengan satu baris perintah:
                    </p>
                </div>

                <vibe:highlightjs language="bash" code="php artisan vibe:auth" />

                <div class="space-y-2 text-sm text-muted-foreground">
                    <p>Atau jalankan secara non-interaktif dengan menyertakan argumen:</p>
                    <vibe:highlightjs language="bash" code="php artisan vibe:auth --layout=card --login-by=email --force" />
                </div>

                <div class="p-4 rounded-xl bg-muted/40 border border-border space-y-2 text-xs text-muted-foreground">
                    <p class="font-semibold text-foreground">Struktur Berkas yang Dihasilkan:</p>
                    <ul class="list-disc list-inside space-y-1 pl-1 font-mono text-[11px]">
                        <li>app/Livewire/Auth/{Login, Register, ForgotPassword, ResetPassword, VerifyEmail, ConfirmPassword}.php</li>
                        <li>resources/views/auth/{login, register, forgot-password, reset-password, verify-email, confirm-password}.blade.php</li>
                        <li>resources/views/auth/layouts/{card, simple, split}.blade.php</li>
                        <li>routes/auth.php & config/vibe.php</li>
                    </ul>
                </div>
            </section>

            {{-- 2. Varian Layout Autentikasi --}}
            <section id="varian-layout" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">2. Pilihan Layout Responsif (Multi-Layout)</h2>
                    <p class="text-sm text-muted-foreground">
                        Vibe UI menyediakan 3 pilihan layout responsif yang siap pakai sesuai dengan karakter aplikasi yang Anda bangun:
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 pt-1">
                    {{-- Card Layout --}}
                    <div class="p-5 rounded-2xl border border-border bg-card space-y-3 flex flex-col justify-between hover:border-primary/50 transition-colors">
                        <div class="space-y-2">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold uppercase tracking-wider text-primary">Card Layout</span>
                                <vibe:badge variant="primary" size="xs" class="rounded-full">Default</vibe:badge>
                            </div>
                            <p class="text-xs text-muted-foreground leading-relaxed">
                                Form dibungkus dalam kartu berbayang terpusat di tengah layar. Sangat cocok untuk dashboard admin, portal SaaS, dan aplikasi enterprise.
                            </p>
                        </div>
                        <vibe:button href="/login?layout=card" variant="outline" size="xs" class="w-full justify-center">
                            Lihat Demo Card &rarr;
                        </vibe:button>
                    </div>

                    {{-- Simple Layout --}}
                    <div class="p-5 rounded-2xl border border-border bg-card space-y-3 flex flex-col justify-between hover:border-primary/50 transition-colors">
                        <div class="space-y-2">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold uppercase tracking-wider text-foreground">Simple Layout</span>
                                <vibe:badge variant="outline" size="xs" class="rounded-full">Minimalist</vibe:badge>
                            </div>
                            <p class="text-xs text-muted-foreground leading-relaxed">
                                Tampilan bersih tanpa bingkai kartu (frameless). Sangat pas untuk aplikasi mobile-first, portal edukasi, atau web bergaya clean modern.
                            </p>
                        </div>
                        <vibe:button href="/login?layout=simple" variant="outline" size="xs" class="w-full justify-center">
                            Lihat Demo Simple &rarr;
                        </vibe:button>
                    </div>

                    {{-- Split Layout --}}
                    <div class="p-5 rounded-2xl border border-border bg-card space-y-3 flex flex-col justify-between hover:border-primary/50 transition-colors">
                        <div class="space-y-2">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold uppercase tracking-wider text-foreground">Split Screen</span>
                                <vibe:badge variant="secondary" size="xs" class="rounded-full">Modern</vibe:badge>
                            </div>
                            <p class="text-xs text-muted-foreground leading-relaxed">
                                Tampilan 2 kolom layar penuh. Sisi kiri memuat ilustrasi branding / testimonial, sisi kanan memuat formulir interaktif.
                            </p>
                        </div>
                        <vibe:button href="/login?layout=split" variant="outline" size="xs" class="w-full justify-center">
                            Lihat Demo Split &rarr;
                        </vibe:button>
                    </div>
                </div>

                <div class="space-y-2 text-sm text-muted-foreground pt-1">
                    <p>Atur layout default aplikasi di <code class="text-xs bg-muted px-1.5 py-0.5 rounded-md text-foreground font-mono">config/vibe.php</code>, atau ganti secara dinamis per halaman lewat parameter URL <code class="text-xs bg-muted px-1.5 py-0.5 rounded-md text-foreground font-mono">?layout=split</code>:</p>
                    <vibe:highlightjs language="php">
// config/vibe.php
'auth' => [
    'default_layout' => 'card', // Opsi: 'card', 'simple', 'split'
],
</vibe:highlightjs>
                </div>
            </section>

            {{-- 3. Konfigurasi Kredensial Login Fleksibel --}}
            <section id="login-kredensial" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">3. Kustomisasi Metode Login (Flexible Credentials)</h2>
                    <p class="text-sm text-muted-foreground">
                        Sistem otentikasi Vibe UI dirancang adaptif. Pengguna dapat login menggunakan alamat email, nama pengguna (username), nomor telepon, atau kombinasi ketiganya:
                    </p>
                </div>

                <vibe:highlightjs language="php">
// config/vibe.php
'auth' => [
    /*
    | Kredensial Login yang Diizinkan (Array):
    | - ['email']                      : Login hanya menggunakan email (Standar)
    | - ['email', 'username']          : Login menggunakan email atau username
    | - ['email', 'username', 'phone'] : Login menggunakan email, username, atau no. HP
    | - ['username']                   : Login khusus username
    | - ['phone']                      : Login khusus nomor handphone
    */
    'login_by' => ['email', 'username'],

    /*
    | Pengalihan Setelah Login & Logout Berhasil:
    */
    'redirect_after_login' => '/docs',
    'redirect_after_logout' => '/login',
],
</vibe:highlightjs>

                <vibe:alert variant="info" class="text-xs">
                    Komponen Livewire <code>Login.php</code> secara otomatis menguji format input saat form dikirim: jika berformat alamat email akan divalidasi via kolom <code>email</code>, jika berupa format nomor HP divalidasi via kolom <code>phone</code>, dan jika berupa teks biasa divalidasi via <code>username</code>.
                </vibe:alert>
            </section>

            {{-- 4. Komponen Form Bawaan (Viewable Password & Separator) --}}
            <section id="komponen-pendukung" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">4. Komponen Form Pendukung Autentikasi</h2>
                    <p class="text-sm text-muted-foreground">
                        Komponen pelengkap yang menyempurnakan pengalaman pengguna pada saat otentikasi:
                    </p>
                </div>

                <div class="space-y-6">
                    <vibe:preview title="Toggle Intip Kata Sandi (Input Viewable)">
                        <div class="max-w-sm w-full">
                            <vibe:input label="Kata Sandi Akun" type="password" viewable placeholder="Masukkan kata sandi..." />
                        </div>
                        <x-slot:code>
&lt;vibe:input
    label="Kata Sandi Akun"
    type="password"
    viewable
    placeholder="Masukkan kata sandi..."
/&gt;
                        </x-slot:code>
                    </vibe:preview>

                    <vibe:preview title="Pemisah Form dengan Teks (Separator)">
                        <div class="w-full max-w-sm space-y-3">
                            <vibe:button variant="outline" class="w-full justify-center">
                                <svg class="size-4 mr-2" viewBox="0 0 24 24"><path fill="currentColor" d="M12.545 10.239v3.821h5.445c-.712 2.315-2.647 3.972-5.445 3.972a6.033 6.033 0 1 1 0-12.064c1.498 0 2.866.549 3.921 1.453l2.814-2.814A9.97 9.97 0 0 0 12.545 2C7.021 2 2.543 6.477 2.543 12s4.478 10 10.002 10c8.396 0 10.249-7.85 9.426-11.761h-9.426Z"/></svg>
                                Masuk dengan Google
                            </vibe:button>
                            <vibe:separator text="atau masuk dengan email" />
                            <vibe:input label="Email" type="email" placeholder="nama@domain.com" />
                        </div>
                        <x-slot:code>
&lt;vibe:button variant="outline" class="w-full justify-center"&gt;
    Masuk dengan Google
&lt;/vibe:button&gt;

&lt;vibe:separator text="atau masuk dengan email" /&gt;

&lt;vibe:input label="Email" type="email" placeholder="nama@domain.com" /&gt;
                        </x-slot:code>
                    </vibe:preview>
                </div>
            </section>

        </div>

        {{-- Table of Contents (TOC) --}}
        <div class="col-span-12 md:col-span-3 order-1 md:order-2 sticky top-6 space-y-4">
            <vibe:toc selector="#docs-content" />
        </div>

    </div>
</x-docs.layouts.sidebar>
