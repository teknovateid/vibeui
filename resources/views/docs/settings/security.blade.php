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
            <div class="flex flex-col md:flex-row w-full min-h-[620px]">
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
                        <div class="flex items-center gap-3 px-3.5 py-3 rounded-xl bg-amber-500/10 border border-amber-500/20 text-xs text-amber-700 dark:text-amber-300">
                            <svg class="size-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Ini adalah pratinjau UI. <strong>Login</strong> untuk mengelola keamanan akun nyata Anda.</span>
                            <a href="/login" class="ml-auto shrink-0 px-3 py-1 rounded-lg bg-amber-500 text-white font-semibold hover:bg-amber-600 transition-colors">Login →</a>
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
                    <div class="pt-2 space-y-4">
                        <div class="space-y-1">
                            <h3 class="text-sm font-semibold text-foreground">Autentikasi Dua Faktor (2FA)</h3>
                            <p class="text-xs text-muted-foreground">Tambahkan lapisan keamanan ekstra. Setiap login membutuhkan kode verifikasi dari aplikasi autentikator.</p>
                        </div>

                        <div class="max-w-md border border-border/60 rounded-2xl p-4 space-y-4">
                            <vibe:switch name="enable_2fa" label="Aktifkan 2FA via Authenticator App" description="Gunakan Google Authenticator, Authy, atau aplikasi TOTP lainnya." />

                            <div class="p-3.5 rounded-xl bg-muted/40 border border-border/60 space-y-2">
                                <p class="text-xs font-semibold text-foreground">Metode 2FA yang Didukung</p>
                                <div class="space-y-1.5 text-xs text-muted-foreground">
                                    <div class="flex items-center gap-2">
                                        <svg class="size-3.5 text-emerald-500 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                            <polyline points="20 6 9 17 4 12" />
                                        </svg>
                                        <span>Authenticator App (TOTP) — Google Authenticator, Authy</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <svg class="size-3.5 text-emerald-500 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                            <polyline points="20 6 9 17 4 12" />
                                        </svg>
                                        <span>SMS / WhatsApp OTP</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <svg class="size-3.5 text-muted-foreground/40 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <line x1="18" x2="6" y1="6" y2="18" />
                                            <line x1="6" x2="18" y1="6" y2="18" />
                                        </svg>
                                        <span class="text-muted-foreground/50">Email OTP (segera hadir)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
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
</x-docs.layouts.sidebar>
