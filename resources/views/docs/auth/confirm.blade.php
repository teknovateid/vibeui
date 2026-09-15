<x-docs.layouts.sidebar>
    <vibe:seo title="Konfirmasi Password (Sudo Mode) — Vibe UI" description="Dokumentasi dan demo interaktif middleware konfirmasi password (confirm, confirm:300, sudo mode) di Vibe UI untuk mengamankan tindakan sensitif." schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => 'Authentication', 'url' => route('docs.auth.installation')],
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
                    <span class="text-xs text-muted-foreground">Middleware: 'confirm' & 'confirm:300'</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">Konfirmasi Password</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    Melindungi aksi-aksi sensitif (seperti mengubah email, menghapus akun, mengekspor data, atau mendaftarkan Passkey) dengan mewajibkan pengguna mengonfirmasi kata sandi ulang jika belum diverifikasi dalam jangka waktu tertentu.
                </p>

                <div class="flex flex-wrap items-center gap-2 pt-2">
                    <vibe:button href="/confirm-password" variant="outline" size="sm">
                        <svg class="size-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <rect width="18" height="11" x="3" y="11" rx="2" ry="2"/>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                        </svg>
                        Buka Halaman /confirm-password
                    </vibe:button>

                    @if(Route::has('password.lock'))
                        <vibe:button href="{{ route('password.lock') }}" variant="ghost" size="sm" class="text-muted-foreground hover:text-foreground">
                            Kunci Sesi Pengujian &rarr;
                        </vibe:button>
                    @endif
                </div>
            </div>

            {{-- 1. Live Interactive Demo: Simulator Konfirmasi Password --}}
            <section id="demo-konfirmasi" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">1. Simulator Interaktif (Live Demo)</h2>
                    <p class="text-sm text-muted-foreground">
                        Uji coba alur verifikasi password via request AJAX tanpa berpindah halaman:
                    </p>
                </div>

                @php
                    $confirmedAt = session('auth.password_confirmed_at', 0);
                    $timeout = 300;
                    $isConfirmed = $confirmedAt && (time() - $confirmedAt) < $timeout;
                    $remainingSecs = max(0, $timeout - (time() - $confirmedAt));
                @endphp

                <div class="p-6 rounded-2xl border border-border bg-card space-y-6 shadow-xs" x-data="{
                    isConfirmed: {{ $isConfirmed ? 'true' : 'false' }},
                    remaining: {{ $remainingSecs }},
                    password: '',
                    loading: false,
                    modalOpen: false,
                    showPassword: false,
                    feedback: null,
                    feedbackType: 'info',
                    sensitiveActionTriggered: false,

                    init() {
                        if (this.isConfirmed && this.remaining > 0) {
                            setInterval(() => {
                                if (this.remaining > 0) {
                                    this.remaining--;
                                } else {
                                    this.isConfirmed = false;
                                }
                            }, 1000);
                        }
                    },

                    triggerSensitiveAction() {
                        if (this.isConfirmed && this.remaining > 0) {
                            this.sensitiveActionTriggered = true;
                            this.feedbackType = 'success';
                            this.feedback = 'Aksi sensitif berhasil dijalankan karena sesi Anda sudah terkonfirmasi!';
                            setTimeout(() => { this.sensitiveActionTriggered = false; }, 3000);
                        } else {
                            this.modalOpen = true;
                            this.password = '';
                            this.feedback = null;
                        }
                    },

                    async submitConfirm() {
                        if (!this.password) return;
                        this.loading = true;
                        this.feedback = null;

                        try {
                            const csrf = document.querySelector('meta[name=&quot;csrf-token&quot;]')?.getAttribute('content') || '{{ csrf_token() }}';
                            const res = await fetch('/confirm-password', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': csrf,
                                    'Accept': 'application/json'
                                },
                                body: JSON.stringify({ password: this.password })
                            });

                            if (res.ok || res.status === 204 || res.redirected) {
                                this.isConfirmed = true;
                                this.remaining = 300;
                                this.modalOpen = false;
                                this.feedbackType = 'success';
                                this.feedback = 'Konfirmasi berhasil! Sesi aman aktif selama 5 menit.';
                            } else {
                                const data = await res.json().catch(() => ({}));
                                this.feedbackType = 'error';
                                this.feedback = data?.errors?.password?.[0] || data?.message || 'Kata sandi salah. Silakan coba lagi.';
                            }
                        } catch (err) {
                            this.feedbackType = 'error';
                            this.feedback = err.message || 'Gagal menghubungi server.';
                        } finally {
                            this.loading = false;
                        }
                    },

                    lockSession() {
                        window.location.href = '{{ route('password.lock') }}';
                    }
                }">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 border-b border-border pb-4">
                        <div class="space-y-1">
                            <div class="flex items-center gap-2">
                                <span class="size-2.5 rounded-full" :class="isConfirmed ? 'bg-emerald-500 animate-pulse' : 'bg-amber-500'"></span>
                                <h3 class="text-sm font-semibold text-foreground" x-text="isConfirmed ? 'Status: Sesi Terkonfirmasi' : 'Status: Perlu Konfirmasi Ulang'"></h3>
                            </div>
                            <p class="text-xs text-muted-foreground">
                                <template x-if="isConfirmed">
                                    <span>Sisa masa berlaku sesi terverifikasi: <strong class="text-foreground" x-text="Math.floor(remaining / 60) + 'm ' + (remaining % 60) + 's'"></strong></span>
                                </template>
                                <template x-if="!isConfirmed">
                                    <span>Sesi belum terkonfirmasi kata sandi atau waktu telah kedaluwarsa.</span>
                                </template>
                            </p>
                        </div>

                        <div class="flex items-center gap-2">
                            <template x-if="isConfirmed">
                                <vibe:button type="button" variant="outline" size="xs" @click="lockSession()" class="cursor-pointer">
                                    <svg class="size-3.5 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="18" height="11" x="3" y="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                                    Kunci Sesi Kembali
                                </vibe:button>
                            </template>
                        </div>
                    </div>

                    {{-- Feedback Banner --}}
                    <div x-show="feedback" x-cloak class="p-3.5 rounded-xl text-xs space-y-1" :class="feedbackType === 'success' ? 'bg-emerald-500/10 text-emerald-700 dark:text-emerald-300 border border-emerald-500/20' : 'bg-destructive/10 text-destructive border border-destructive/20'">
                        <p class="font-semibold" x-text="feedbackType === 'success' ? '✓ Berhasil!' : '⚠ Perhatian:'"></p>
                        <p x-text="feedback" class="leading-relaxed"></p>
                    </div>

                    <div class="p-4 rounded-xl bg-muted/40 border border-border space-y-3">
                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
                            <div class="space-y-0.5">
                                <p class="text-xs font-semibold text-foreground">Tindakan Berisiko Tinggi (Contoh: Reset API Key)</p>
                                <p class="text-[11px] text-muted-foreground">Aksi ini dilindungi oleh middleware konfirmasi kata sandi.</p>
                            </div>

                            <vibe:button type="button" variant="primary" size="sm" @click="triggerSensitiveAction()" class="cursor-pointer">
                                <svg class="size-4 mr-1.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10"/></svg>
                                Eksekusi Aksi Sensitif
                            </vibe:button>
                        </div>
                    </div>

                    {{-- Modal Konfirmasi Kata Sandi --}}
                    <div x-show="modalOpen" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-background/80 backdrop-blur-xs">
                        <div @click.away="modalOpen = false" class="w-full max-w-md p-6 rounded-2xl border border-border bg-card shadow-xl space-y-4 animate-in fade-in zoom-in-95 duration-200">
                            <div class="flex items-center gap-3">
                                <div class="p-2.5 rounded-xl bg-primary/10 text-primary">
                                    <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold text-foreground">Konfirmasi Kata Sandi Akun</h4>
                                    <p class="text-xs text-muted-foreground">Ini adalah area aman. Harap masukkan kata sandi akun Anda untuk melanjutkan.</p>
                                </div>
                            </div>

                            <form @submit.prevent="submitConfirm()" class="space-y-3 pt-2">
                                <div class="space-y-1">
                                    <label class="text-xs font-semibold text-foreground">Kata Sandi</label>
                                    <div class="relative">
                                        <input :type="showPassword ? 'text' : 'password'" x-model="password" placeholder="Masukkan kata sandi..." class="w-full px-3 py-2 pr-9 text-xs rounded-lg border border-input bg-background text-foreground shadow-2xs focus:ring-1 focus:ring-primary focus:outline-none" required autofocus />
                                        <button type="button" @click="showPassword = !showPassword" class="absolute right-2.5 top-1/2 -translate-y-1/2 text-muted-foreground hover:text-foreground cursor-pointer" tabindex="-1">
                                            <svg x-show="!showPassword" class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                                            <svg x-show="showPassword" x-cloak class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/><path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/><path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"/><line x1="2" x2="22" y1="2" y2="22"/></svg>
                                        </button>
                                    </div>
                                </div>

                                <div class="flex items-center justify-end gap-2 pt-2">
                                    <vibe:button type="button" variant="ghost" size="sm" @click="modalOpen = false">Batal</vibe:button>
                                    <vibe:button type="submit" variant="primary" size="sm" ::disabled="loading || !password">
                                        <template x-if="!loading"><span>Konfirmasi</span></template>
                                        <template x-if="loading"><span>Memverifikasi...</span></template>
                                    </vibe:button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </section>

            {{-- 2. Dua Mode Middleware: 'confirm' vs 'confirm:300' --}}
            <section id="dua-mode" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">2. Mode Operasi Middleware</h2>
                    <p class="text-sm text-muted-foreground">
                        Middleware <code class="text-xs bg-muted px-1.5 py-0.5 rounded font-mono text-foreground">RequirePasswordConfirmation</code> di Vibe UI mendukung 2 mode:
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="p-5 rounded-2xl border border-border bg-card space-y-2.5">
                        <div class="flex items-center justify-between">
                            <h3 class="text-sm font-bold text-foreground">Mode 1: Single-Page Confirm</h3>
                            <vibe:badge variant="outline" size="xs">confirm</vibe:badge>
                        </div>
                        <p class="text-xs text-muted-foreground leading-relaxed">
                            Secara khusus mewajibkan konfirmasi untuk halaman tersebut saja. Pengguna hanya dapat mengakses halaman yang dituju satu kali setelah kata sandi diverifikasi. Begitu berpindah halaman, sesi konfirmasi di-reset otomatis demi keamanan maksimal.
                        </p>
                        <vibe:highlightjs language="php">
Route::middleware(['auth', 'confirm'])->group(function () {
    Route::view('/settings/security', 'settings.security');
});
</vibe:highlightjs>
                    </div>

                    <div class="p-5 rounded-2xl border border-border bg-card space-y-2.5">
                        <div class="flex items-center justify-between">
                            <h3 class="text-sm font-bold text-foreground">Mode 2: Durasi Waktu (Timeout)</h3>
                            <vibe:badge variant="primary" size="xs">confirm:300</vibe:badge>
                        </div>
                        <p class="text-xs text-muted-foreground leading-relaxed">
                            Membuka sesi konfirmasi selama sejumlah detik (misal 300 detik = 5 menit). Selama jangka waktu tersebut belum kedaluwarsa, seluruh rute yang dilindungi middleware ini dapat diakses bebas tanpa diminta password berulang kali.
                        </p>
                        <vibe:highlightjs language="php">
Route::middleware(['auth', 'confirm:300'])->group(function () {
    Route::get('/billing/invoices', [BillingController::class, 'index']);
});
</vibe:highlightjs>
                    </div>
                </div>
            </section>

            {{-- 3. Respons JSON untuk API & Livewire --}}
            <section id="respons-json" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">3. Penanganan Respons API & AJAX</h2>
                    <p class="text-sm text-muted-foreground">
                        Jika request membutuhkan konfirmasi kata sandi dan dikirim dengan header <code class="text-xs bg-muted px-1.5 py-0.5 rounded font-mono text-foreground">Accept: application/json</code>, middleware akan merespons dengan kode HTTP <code class="text-xs bg-muted px-1.5 py-0.5 rounded font-mono text-foreground">423 Locked</code>:
                    </p>
                </div>

                <vibe:highlightjs language="json">
{
    "message": "Password confirmation required."
}
</vibe:highlightjs>

                <p class="text-xs text-muted-foreground">
                    Sedangkan untuk form biasa atau browser visit langsung, middleware otomatis me-redirect ke rute nama <code>password.confirm</code> (default: <code>/confirm-password</code>).
                </p>
            </section>

        </div>

        {{-- Table of Contents (TOC) --}}
        <div class="col-span-12 md:col-span-3 order-1 md:order-2 sticky top-6 space-y-4">
            <vibe:toc selector="#docs-content" />
        </div>

    </div>
</x-docs.layouts.sidebar>
