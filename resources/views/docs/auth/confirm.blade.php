<x-docs.layouts.sidebar>
    <vibe:seo title="Konfirmasi Password (Sudo Mode) — Vibe UI" description="Dokumentasi lengkap dan demo interaktif halaman konfirmasi password (/confirm-password) serta modal otomatis in-place pada vibe:form untuk mengamankan tindakan sensitif." schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => route('docs.index')],
        ['name' => 'Authentication', 'url' => route('docs.auth.index')],
        ['name' => 'Konfirmasi Password', 'url' => route('docs.auth.confirm')]
    ]" />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">

        {{-- Main Documentation Content --}}
        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-12">

            {{-- Header --}}
            <div class="space-y-4">
                <div class="flex flex-wrap items-center gap-2">
                    <vibe:badge variant="primary" class="rounded-full">Sudo Mode</vibe:badge>
                    <vibe:badge variant="outline" class="rounded-full">Security Middleware</vibe:badge>
                    <vibe:badge variant="outline" class="rounded-full">Passkey &amp; WebAuthn</vibe:badge>
                    <span class="text-xs text-muted-foreground">Middleware: 'confirm' &amp; 'confirm:{seconds}'</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">Konfirmasi Password &amp; Sudo Mode</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    Melindungi operasi sensitif dan berisiko tinggi (seperti memperbarui profil pengguna, mengubah alamat email, mendaftarkan kunci biometrik Passkey, atau menghapus data) dengan mewajibkan verifikasi ulang kata sandi atau biometrik jika sesi aman belum terkonfirmasi dalam kurun waktu tertentu.
                </p>

                <div class="flex flex-wrap items-center gap-2.5 pt-2">
                    <vibe:button href="/confirm-password" variant="outline" size="md">
                        <svg class="size-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="18" height="11" x="3" y="11" rx="2" ry="2"/>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                        </svg>
                        Buka Halaman /confirm-password
                    </vibe:button>

                    @if(Route::has('password.lock'))
                        <vibe:button href="{{ route('password.lock') }}" variant="ghost" size="md" class="text-muted-foreground hover:text-foreground">
                            Kunci Sesi Pengujian &rarr;
                        </vibe:button>
                    @endif
                </div>
            </div>

            {{-- Status Autentikasi Pengujian --}}
            <div class="p-4 rounded-2xl border border-border bg-card shadow-2xs flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div class="size-9 rounded-xl {{ auth()->check() ? 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/20' : 'bg-amber-500/10 text-amber-600 dark:text-amber-400 border border-amber-500/20' }} flex items-center justify-center shrink-0">
                        @if(auth()->check())
                            <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                        @else
                            <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        @endif
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <h4 class="text-xs font-bold text-foreground">
                                {{ auth()->check() ? 'Terautentikasi: ' . auth()->user()->email : 'Mode Tamu (Guest)' }}
                            </h4>
                            @if(auth()->check())
                                @php
                                    $isConfirmedNow = session('auth.password_confirmed_at') && (time() - session('auth.password_confirmed_at')) < 100;
                                @endphp
                                <vibe:badge variant="{{ $isConfirmedNow ? 'success' : 'warning' }}" size="xs">
                                    {{ $isConfirmedNow ? 'Sudo Mode Aktif' : 'Konfirmasi Diperlukan' }}
                                </vibe:badge>
                            @endif
                        </div>
                        <p class="text-[11px] text-muted-foreground mt-0.5">
                            {{ auth()->check() ? 'Sandi akun demo adalah "password". Gunakan tombol kunci sesi untuk menguji ulang permintaan konfirmasi.' : 'Masuk dengan akun demo untuk menguji validasi verifikasi sandi dan passkey secara langsung.' }}
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-2 shrink-0">
                    @if(auth()->check())
                        @if(Route::has('password.lock'))
                            <vibe:button href="{{ route('password.lock') }}" variant="outline" size="sm">
                                Kunci Sesi Kembali
                            </vibe:button>
                        @endif
                    @else
                        @if (Route::has('dev.login.demo'))
                            <form method="POST" action="{{ route('dev.login.demo') }}">
                                @csrf
                                <vibe:button type="submit" variant="primary" size="sm">
                                    1-Klik Login Akun Demo
                                </vibe:button>
                            </form>
                        @endif
                    @endif
                </div>
            </div>

            {{-- 1. Demo Halaman Konfirmasi Mandiri (/confirm-password) --}}
            <section id="demo-halaman-confirm" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">1. Demo Halaman Konfirmasi Mandiri (/confirm-password)</h2>
                    <p class="text-sm text-muted-foreground">
                        Ketika pengguna mengunjungi rute sensitif secara langsung via peramban (misalnya mengakses tautan menu atau me-refresh halaman ber-middleware <code class="text-xs bg-muted px-1.5 py-0.5 rounded font-mono text-foreground">confirm</code>), sistem otomatis me-redirect ke halaman mandiri <code class="text-xs bg-muted px-1.5 py-0.5 rounded font-mono text-foreground">/confirm-password</code>:
                    </p>
                </div>

                {{-- Live Interactive Card Preview --}}
                <div class="p-6 rounded-2xl border border-border bg-muted/20 flex flex-col items-center justify-center">
                    <div class="w-full max-w-md p-6 sm:p-7 rounded-2xl border border-border/80 bg-card text-card-foreground shadow-xl space-y-6">
                        
                        {{-- Header Icon & Titles --}}
                        <div class="text-center space-y-2">
                            <div class="size-12 rounded-2xl bg-primary/10 text-primary flex items-center justify-center mx-auto border border-primary/20 shadow-xs">
                                <svg class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="18" height="11" x="3" y="11" rx="2" ry="2"/>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold tracking-tight text-foreground">Konfirmasi Kata Sandi</h3>
                            <p class="text-xs text-muted-foreground leading-relaxed">
                                Ini adalah area aman aplikasi. Harap konfirmasi kata sandi Anda sebelum melanjutkan.
                            </p>
                        </div>

                        {{-- Passkey Confirm Button --}}
                        @if(config('passkeys.enabled', true))
                            <div class="space-y-3">
                                <vibe:button 
                                    type="button" 
                                    variant="outline" 
                                    size="md" 
                                    class="w-full justify-center shadow-2xs font-medium cursor-pointer"
                                    onclick="window.vibeToast ? window.vibeToast('Demo Passkey: Menginisialisasi autentikasi biometrik WebAuthn perangkat...', { type: 'info' }) : alert('Demo Passkey')"
                                >
                                    <span class="inline-flex items-center gap-2">
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
                                        <span>Konfirmasi dengan Passkey</span>
                                    </span>
                                </vibe:button>

                                <vibe:separator text="Atau masukkan kata sandi" />
                            </div>
                        @endif

                        {{-- Form Input --}}
                        <div class="space-y-4">
                            <vibe:input 
                                id="demo-card-password"
                                name="demo_password"
                                type="password" 
                                size="md" 
                                viewable 
                                label="Kata Sandi" 
                                placeholder="Masukkan kata sandi akun..." 
                                value="password" 
                            />

                            <vibe:button 
                                type="button" 
                                variant="primary" 
                                size="md" 
                                class="w-full justify-center shadow-xs"
                                onclick="window.vibeToast ? window.vibeToast('Verifikasi sandi berhasil! Sudo mode aktif.', { type: 'success' }) : alert('Verifikasi Sukses!')"
                            >
                                Konfirmasi &amp; Lanjutkan
                            </vibe:button>
                        </div>

                        {{-- Footer Option --}}
                        <div class="pt-2 flex items-center justify-between border-t border-border text-xs">
                            <span class="text-muted-foreground">Bukan akun Anda?</span>
                            <vibe:button type="button" variant="ghost" size="xs" class="text-destructive hover:bg-destructive/10">
                                Logout
                            </vibe:button>
                        </div>

                    </div>
                </div>

                {{-- Penjelasan Implementasi Halaman --}}
                <div class="space-y-2 pt-2">
                    <p class="text-xs text-muted-foreground">
                        Halaman ini dikelola otomatis oleh komponen Livewire <code class="text-xs bg-muted px-1.5 py-0.5 rounded font-mono text-foreground">App\Livewire\Auth\ConfirmPassword</code> dan rute <code class="text-xs bg-muted px-1.5 py-0.5 rounded font-mono text-foreground">Route::get('/confirm-password', ...)->name('password.confirm')</code>:
                    </p>
                    <vibe:highlightjs language="php">
// routes/auth.php
Route::get('/confirm-password', ConfirmPassword::class)->name('password.confirm');

Route::post('/confirm-password', function (Request $request) {
    $request->validate(['password' => ['required', 'string']]);
    
    if (! Hash::check($request->password, Auth::user()->getAuthPassword())) {
        return response()->json(['errors' => ['password' => ['Kata sandi salah.']]], 422);
    }

    $request->session()->put('auth.password_confirmed_at', time());
    
    // Otomatis arahkan kembali ke intended URL setelah verifikasi
    return redirect()->intended('/dashboard');
})->name('password.confirm.post');
</vibe:highlightjs>
                </div>
            </section>

            {{-- 2. Demo Modal Konfirmasi Otomatis di <vibe:form> --}}
            <section id="demo-modal-form" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">2. Demo Modal Konfirmasi In-Place di &lt;vibe:form&gt;</h2>
                    <p class="text-sm text-muted-foreground leading-relaxed">
                        Jika pengguna melakukan aksi mutasi data via AJAX (<code class="text-xs bg-muted px-1.5 py-0.5 rounded font-mono text-foreground">POST</code>, <code class="text-xs bg-muted px-1.5 py-0.5 rounded font-mono text-foreground">PUT</code>, <code class="text-xs bg-muted px-1.5 py-0.5 rounded font-mono text-foreground">DELETE</code>) pada endpoint berproteksi konfirmasi, server merespons <code class="text-xs bg-muted px-1.5 py-0.5 rounded font-mono text-foreground">HTTP 423 Locked</code>. Komponen <code class="text-xs bg-muted px-1.5 py-0.5 rounded font-mono text-foreground">&lt;vibe:form&gt;</code> secara otomatis menangkap status tersebut, memunculkan modal in-place, lalu <strong>melanjutkan (replay) request form</strong> tanpa reload halaman dan tanpa kehilangan isian input.
                    </p>
                </div>

                {{-- Interactive Vibe Form Demo --}}
                <div class="p-6 rounded-2xl border border-border bg-card space-y-6 shadow-xs">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 border-b border-border pb-4">
                        <div class="space-y-0.5">
                            <h3 class="text-sm font-semibold text-foreground">Formulir Pembaruan Data Pengguna (Method: PUT)</h3>
                            <p class="text-xs text-muted-foreground">Endpoint: <code class="font-mono text-foreground text-[11px]">PUT /docs/auth/confirm/demo-update/42</code> (Dilindungi <code class="font-mono text-primary font-semibold text-[11px]">confirm:60</code>)</p>
                        </div>

                        <vibe:badge variant="outline" size="sm" class="font-mono">
                            Auto HTTP 423 Intercept
                        </vibe:badge>
                    </div>

                    {{-- Form Component Real Test --}}
                    <vibe:form 
                        method="PUT" 
                        action="{{ route('docs.auth.confirm.demo_update', ['id' => 42]) }}" 
                        class="space-y-4"
                        status="toast"
                    >
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <vibe:input 
                                name="name" 
                                label="Nama Pengguna" 
                                value="Alex Rivera" 
                                required 
                                size="md" 
                            />
                            <vibe:input 
                                name="email" 
                                label="Email Baru" 
                                value="alex.rivera@example.com" 
                                type="email" 
                                required 
                                size="md" 
                            />
                        </div>

                        <vibe:textarea 
                            name="notes" 
                            label="Alasan Perubahan Data Sensitif" 
                            rows="2" 
                            size="md"
                            placeholder="Tuliskan alasan pembaruan data akun pengguna..."
                        >Pembaruan berkala hak akses dan email kontak organisasi.</vibe:textarea>

                        <div class="flex flex-wrap items-center justify-between gap-3 pt-2">
                            <span class="text-xs text-muted-foreground">
                                💡 Sandi demo: <code class="font-mono text-primary font-bold">password</code>. Sesi aman berlaku 60 detik (dapat dikunci ulang di bilah atas).
                            </span>

                            <vibe:button type="submit" variant="primary" size="md">
                                <svg class="size-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                                    <polyline points="17 21 17 13 7 13 7 21"/>
                                    <polyline points="7 3 7 8 15 8"/>
                                </svg>
                                Simpan Perubahan (PUT /update/42)
                            </vibe:button>
                        </div>
                    </vibe:form>
                </div>

                {{-- Penjelasan Implementasi Vibe Form --}}
                <div class="space-y-2 pt-2">
                    <p class="text-xs text-muted-foreground">
                        Cukup gunakan tag <code class="text-xs bg-muted px-1.5 py-0.5 rounded font-mono text-foreground">&lt;vibe:form&gt;</code> seperti biasa. Fitur <code class="text-xs bg-muted px-1.5 py-0.5 rounded font-mono text-foreground">confirmPassword</code> aktif secara bawaan (<code class="text-xs bg-muted px-1.5 py-0.5 rounded font-mono text-foreground">true</code>):
                    </p>
                    <vibe:highlightjs language="blade">
<\vibe:form method="PUT" action="@{{ route('users.update', $user->id) }}" status="toast">
    <\vibe:input name="name" label="Nama" :value="$user->name" required />
    <\vibe:input name="email" label="Email" :value="$user->email" required />

    <\vibe:button type="submit" variant="primary" size="md">
        Simpan Perubahan
    </\vibe:button>
</\vibe:form>
</vibe:highlightjs>

                    {{-- Tips Integrasi dengan Sheet --}}
                    <div class="p-4 rounded-xl border border-primary/20 bg-primary/5 flex items-start gap-3 mt-4">
                        <div class="p-1.5 rounded-lg bg-primary/10 text-primary shrink-0 mt-0.5">
                            <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"/>
                                <line x1="12" y1="16" x2="12" y2="12"/>
                                <line x1="12" y1="8" x2="12.01" y2="8"/>
                            </svg>
                        </div>
                        <div class="space-y-1">
                            <h4 class="text-xs font-bold text-foreground">Integrasi Aman di dalam &lt;vibe:sheet&gt; &amp; Dialog</h4>
                            <p class="text-[11px] text-muted-foreground leading-relaxed">
                                Ketika <code class="font-mono text-foreground">&lt;vibe:form&gt;</code> diletakkan di dalam <code class="font-mono text-foreground">&lt;vibe:sheet&gt;</code> (misalnya pada drawer <em>Edit Pengguna</em>), kemunculan modal konfirmasi password in-place tidak akan memicu penutupan sheet secara tidak sengaja. Vibe UI otomatis mengisolasi event klik pada seluruh elemen dialog dan modal.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            {{-- 3. Dua Mode Operasi Middleware --}}
            <section id="mode-operasi" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">3. Dua Mode Operasi Middleware</h2>
                    <p class="text-sm text-muted-foreground">
                        Middleware <code class="text-xs bg-muted px-1.5 py-0.5 rounded font-mono text-foreground">confirm</code> mendukung dua mode perlindungan sesuai kebutuhan keamanan:
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Mode 1 --}}
                    <div class="p-5 rounded-2xl border border-border bg-card space-y-3">
                        <div class="flex items-center justify-between">
                            <h3 class="text-sm font-bold text-foreground">Mode 1: Single-Action Confirm</h3>
                            <vibe:badge variant="outline" size="xs">confirm</vibe:badge>
                        </div>
                        <p class="text-xs text-muted-foreground leading-relaxed">
                            Mewajibkan verifikasi untuk satu aksi mutasi atau halaman saja. Setelah aksi <code class="text-[11px] font-mono">PUT/POST/DELETE</code> selesai dijalankan, sesi konfirmasi langsung dihanguskan (<code class="text-[11px] font-mono">one-time consume</code>) demi proteksi maksimal pada aksi berisiko fatal seperti hapus akun.
                        </p>
                        <vibe:highlightjs language="php">
Route::middleware(['auth', 'confirm'])->group(function () {
    Route::delete('/user/account', [UserController::class, 'destroy']);
});
</vibe:highlightjs>
                    </div>

                    {{-- Mode 2 --}}
                    <div class="p-5 rounded-2xl border border-border bg-card space-y-3">
                        <div class="flex items-center justify-between">
                            <h3 class="text-sm font-bold text-foreground">Mode 2: Jendela Waktu (Timeout)</h3>
                            <vibe:badge variant="primary" size="xs">confirm:{detik}</vibe:badge>
                        </div>
                        <p class="text-xs text-muted-foreground leading-relaxed">
                            Membuka jendela waktu aman (misalnya 100 detik atau 300 detik). Selama jendela waktu tersebut belum habis, pengguna bebas berpindah antar halaman atau melakukan aksi pembaruan berulang tanpa diminta kata sandi terus-menerus.
                        </p>
                        <vibe:highlightjs language="php">
Route::prefix('users')->middleware(['auth', 'confirm:100'])->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::post('/store', [UserController::class, 'store']);
    Route::put('/update/{id}', [UserController::class, 'update']);
});
</vibe:highlightjs>
                    </div>
                </div>
            </section>

            {{-- 4. Penanganan Rute Mutasi Berparameter ({id}) --}}
            <section id="route-parameter" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">4. Penanganan Rute Berparameter ({id})</h2>
                    <p class="text-sm text-muted-foreground leading-relaxed">
                        Pada rute seperti <code class="text-xs bg-muted px-1.5 py-0.5 rounded font-mono text-foreground">Route::put('/update/{id}')</code>, pemanggilan helper Laravel <code class="text-xs bg-muted px-1.5 py-0.5 rounded font-mono text-foreground">route('users.update')</code> secara polos akan menimbulkan galat <code class="text-xs text-destructive bg-destructive/10 px-1.5 py-0.5 rounded font-mono">Missing required parameter for [Route: users.update] [Missing parameter: id]</code>.
                    </p>
                </div>

                <div class="p-5 rounded-2xl border border-border bg-card space-y-4">
                    <div class="flex items-start gap-3">
                        <div class="p-2 rounded-xl bg-primary/10 text-primary shrink-0">
                            <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10" />
                                <path d="m9 12 2 2 4-4" />
                            </svg>
                        </div>
                        <div class="space-y-1">
                            <h4 class="text-sm font-bold text-foreground">Otomatisasi Target URL di Vibe UI</h4>
                            <p class="text-xs text-muted-foreground leading-relaxed">
                                Vibe UI menangani ini secara elegan di dua lapisan:
                            </p>
                            <ul class="list-disc list-inside text-xs text-muted-foreground space-y-1 pt-1">
                                <li><strong>Client Payload:</strong> Komponen <code class="font-mono text-foreground">form.js</code> otomatis mengirimkan <code class="font-mono text-foreground">target_url: form.action</code> (yang sudah berisi ID konkret, misal <code class="font-mono text-foreground">/dashboard/users/update/42</code>) saat memverifikasi sandi ke endpoint <code class="font-mono text-foreground">POST /confirm-password</code>.</li>
                                <li><strong>Safe Route Resolution:</strong> Fungsi sanitasi internal membungkus pemanggilan rute dalam penanganan aman (<code class="font-mono text-foreground">try/catch</code>) sehingga tidak akan mengalami *crash* saat nama rute membutuhkan parameter wajib.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>

            {{-- 5. Autentikasi Biometrik Passkey (WebAuthn) di Sudo Mode --}}
            <section id="passkey-sudo" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">5. Autentikasi Biometrik Passkey (WebAuthn)</h2>
                    <p class="text-sm text-muted-foreground leading-relaxed">
                        Baik pada halaman mandiri maupun modal in-place <code class="text-xs bg-muted px-1.5 py-0.5 rounded font-mono text-foreground">&lt;vibe:form&gt;</code>, pengguna dapat memverifikasi identitas menggunakan Touch ID, Face ID, atau Windows Hello secara instan tanpa mengetikkan kata sandi:
                    </p>
                </div>

                <div class="p-5 rounded-2xl border border-border bg-card space-y-3">
                    <div class="flex items-center gap-3">
                        <div class="p-2 rounded-xl bg-primary/10 text-primary shrink-0">
                            <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 10a2 2 0 0 0-2 2c0 1.02-.1 2.51-.26 4" />
                                <path d="M14 13.12c0 2.38 0 6.38-1 8.88" />
                                <path d="M17.29 21.02c.12-.6.43-2.3.5-3.02" />
                                <path d="M2 12a10 10 0 0 1 18-6" />
                            </svg>
                        </div>
                        <h4 class="text-sm font-bold text-foreground">Alur Kerja Biometrik Terpadu</h4>
                    </div>
                    <ol class="list-decimal list-inside text-xs text-muted-foreground space-y-1.5 pl-1 leading-relaxed">
                        <li>Pengguna mengklik tombol <strong>Konfirmasi dengan Passkey</strong> pada modal atau halaman.</li>
                        <li>Peramban memicu dialog biometrik sistem operasi via modul <code class="font-mono text-foreground">@laravel/passkeys</code>.</li>
                        <li>Setelah sidik jari atau wajah terverifikasi, payload asimetris dikirim ke <code class="font-mono text-foreground">POST /passkeys/confirm</code>.</li>
                        <li>Event <code class="font-mono text-foreground">Laravel\Passkeys\Events\PasskeyVerified</code> dipancarkan di backend, menandai sesi terkonfirmasi dan memperbarui stempel waktu aktivitas.</li>
                        <li>Modal in-place tertutup secara otomatis dan form melanjutkan pengiriman data.</li>
                    </ol>
                </div>
            </section>

            {{-- 6. Tabel Referensi Props <vibe:form> --}}
            <section id="props-referensi" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">6. Konfigurasi &amp; Props &lt;vibe:form&gt;</h2>
                    <p class="text-sm text-muted-foreground">
                        Opsi konfigurasi pada komponen form terkait penanganan konfirmasi kata sandi:
                    </p>
                </div>

                <div class="rounded-2xl border border-border overflow-hidden">
                    <table class="w-full text-left text-xs border-collapse">
                        <thead>
                            <tr class="border-b border-border bg-muted/40 font-semibold text-foreground">
                                <th class="p-3.5">Prop</th>
                                <th class="p-3.5">Tipe</th>
                                <th class="p-3.5">Default</th>
                                <th class="p-3.5">Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border text-muted-foreground">
                            <tr>
                                <td class="p-3.5 font-mono text-foreground font-semibold">confirmPassword / confirm-password</td>
                                <td class="p-3.5 font-mono">bool</td>
                                <td class="p-3.5 font-mono text-primary">true</td>
                                <td class="p-3.5">Mengaktifkan penangkapan otomatis respons HTTP 423 dan menampilkan modal konfirmasi in-place dengan dukungan Passkey.</td>
                            </tr>
                            <tr>
                                <td class="p-3.5 font-mono text-foreground font-semibold">confirmPasswordUrl / confirm-password-url</td>
                                <td class="p-3.5 font-mono">string|null</td>
                                <td class="p-3.5 font-mono text-primary">null</td>
                                <td class="p-3.5">Endpoint URL verifikasi kata sandi (POST). Secara default menggunakan rute <code class="font-mono">password.confirm.post</code> atau <code class="font-mono">/confirm-password</code>.</td>
                            </tr>
                            <tr>
                                <td class="p-3.5 font-mono text-foreground font-semibold">status</td>
                                <td class="p-3.5 font-mono">string|bool</td>
                                <td class="p-3.5 font-mono text-primary">'toast'</td>
                                <td class="p-3.5">Format notifikasi feedback sukses/error setelah form di-submit ('toast', 'alert', atau false).</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

            {{-- Navigation Footer --}}
            <div class="pt-8 border-t border-border flex flex-col sm:flex-row items-center justify-between gap-4">
                <a href="{{ route('docs.auth.installation') }}" class="w-full sm:w-auto inline-flex items-center gap-2 p-3.5 rounded-xl border border-border bg-card hover:border-primary/50 transition-colors group">
                    <svg class="size-4 text-muted-foreground group-hover:text-primary transition-colors" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M15 19l-7-7 7-7"/></svg>
                    <div>
                        <span class="text-[10px] uppercase font-bold text-muted-foreground tracking-wider block">Sebelumnya</span>
                        <span class="text-xs font-semibold text-foreground group-hover:text-primary transition-colors">Instalasi &amp; Scaffolding CLI</span>
                    </div>
                </a>

                <a href="{{ route('docs.auth.idle') }}" class="w-full sm:w-auto inline-flex items-center justify-between sm:justify-end gap-2 p-3.5 rounded-xl border border-border bg-card hover:border-primary/50 transition-colors group text-right">
                    <div>
                        <span class="text-[10px] uppercase font-bold text-muted-foreground tracking-wider block">Selanjutnya</span>
                        <span class="text-xs font-semibold text-foreground group-hover:text-primary transition-colors">Idle Timeout &amp; Session Lock &rarr;</span>
                    </div>
                </a>
            </div>

        </div>

        {{-- Table of Contents Sidebar --}}
        <aside class="col-span-12 order-1 md:order-2 md:col-span-3 w-full md:sticky md:top-6 group-has-[header.sticky]/docs:md:top-20">
            <vibe:toc selector="#docs-content" />
        </aside>

    </div>
</x-docs.layouts.sidebar>
