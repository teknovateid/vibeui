<x-docs.layouts.sidebar>
    <vibe:seo :title="__('docs/page/settings/index.title')" :description="__('docs/page/settings/index.subtitle')" :breadcrumbs="[
        ['name' => __('docs/page/settings/index.breadcrumb.home'), 'url' => '/'],
        ['name' => __('docs/page/settings/index.breadcrumb.pages'), 'url' => '#'],
        ['name' => __('docs/page/settings/index.breadcrumb.settings'), 'url' => route('docs.settings.account')],
        ['name' => 'Passkey', 'url' => route('docs.settings.passkey')],
    ]" />

    @push('head')
        @vite('resources/js/vibe/passkeys.js')
    @endpush

    <div class="mx-auto w-full space-y-6">
        <vibe:breadcrumb title="{!! __('docs/page/settings/index.title') !!}">
            <vibe:breadcrumb.item href="{{ route('docs.index') }}">{{ __('docs/page/settings/index.breadcrumb.home') }}</vibe:breadcrumb.item>
            <vibe:breadcrumb.item>{{ __('docs/page/settings/index.breadcrumb.pages') }}</vibe:breadcrumb.item>
            <vibe:breadcrumb.item href="{{ route('docs.settings.account') }}">{{ __('docs/page/settings/index.breadcrumb.settings') }}</vibe:breadcrumb.item>
            <vibe:breadcrumb.item active>Passkey</vibe:breadcrumb.item>
        </vibe:breadcrumb>

        <vibe:card class="p-0 overflow-hidden">
            <div class="flex flex-col md:flex-row w-full min-h-155">
                @include('docs.settings.tabs', ['active' => 'passkey'])

                <div class="flex-1 min-w-0 p-6 space-y-6">

                    {{-- Header --}}
                    <div class="border-b border-border/50 pb-4">
                        <div class="flex items-center gap-2.5">
                            <h2 class="text-lg font-bold text-foreground">Passkey (WebAuthn)</h2>
                            <vibe:badge variant="primary" size="sm" class="rounded-full">Passwordless</vibe:badge>
                        </div>
                        <p class="text-xs text-muted-foreground mt-0.5">
                            Daftarkan perangkat biometrik (Touch ID, Windows Hello, YubiKey) untuk login tanpa kata sandi.
                        </p>
                    </div>

                    @auth
                        @php
                            $confirmedAt = session('auth.password_confirmed_at', 0);
                            $timeout = 300;
                            $remainingMinutes = max(1, (int) ceil(($timeout - (time() - $confirmedAt)) / 60));
                        @endphp
                        <div class="flex items-center justify-between p-3 rounded-xl bg-muted/40 border border-border text-xs">
                            <div class="flex items-center gap-2 text-muted-foreground">
                                <span class="size-2 rounded-full bg-emerald-500"></span>
                                <span>Sesi terkonfirmasi kata sandi (sisa {{ $remainingMinutes }} mnt).</span>
                            </div>
                            <a href="{{ route('password.lock') }}" class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-medium border border-border bg-background hover:bg-muted text-muted-foreground hover:text-foreground transition-all cursor-pointer shadow-2xs" title="Kunci kembali sesi untuk menguji konfirmasi password">
                                <svg class="size-3 text-muted-foreground" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="18" height="11" x="3" y="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                                <span>Kunci Sesi</span>
                            </a>
                        </div>

                        <div x-data="passkeyController()" class="space-y-6">
                            {{-- Browser Support Badge --}}
                            <div class="flex items-center justify-between">
                                <div class="space-y-0.5">
                                    <h3 class="text-sm font-semibold text-foreground">Status Browser</h3>
                                    <p class="text-xs text-muted-foreground">WebAuthn / FIDO2 harus didukung oleh browser Anda.</p>
                                </div>
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold" :class="supported ? 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400' : 'bg-destructive/10 text-destructive'">
                                    <span class="size-2 rounded-full" :class="supported ? 'bg-emerald-500' : 'bg-destructive'"></span>
                                    <span x-text="supported ? 'Browser Didukung' : 'Tidak Didukung'"></span>
                                </span>
                            </div>

                            {{-- IP Address Warning --}}
                            <template x-if="isIpAddress">
                                <div class="p-3.5 rounded-xl bg-amber-500/10 border border-amber-500/20 text-xs text-amber-700 dark:text-amber-300 flex items-center justify-between gap-3">
                                    <span>Anda mengakses via <strong>127.0.0.1</strong>. Buka via <strong>localhost</strong> agar WebAuthn berfungsi.</span>
                                    <a :href="localhostUrl" class="shrink-0 px-3 py-1.5 bg-amber-500 text-white rounded-lg font-medium hover:bg-amber-600 transition-colors">Buka di Localhost →</a>
                                </div>
                            </template>

                            {{-- Feedback Message --}}
                            <div x-show="feedbackMessage" x-cloak class="p-3.5 rounded-xl text-xs space-y-1" :class="feedbackType === 'success' ? 'bg-emerald-500/10 text-emerald-700 dark:text-emerald-300 border border-emerald-500/20' : 'bg-destructive/10 text-destructive border border-destructive/20'">
                                <p class="font-semibold" x-text="feedbackType === 'success' ? '✓ Berhasil!' : '⚠ Perhatian:'"></p>
                                <p x-text="feedbackMessage" class="leading-relaxed"></p>
                            </div>

                            {{-- Registered Passkeys List --}}
                            @php
                                $userPasskeys = auth()->user()->passkeys ?? collect();
                            @endphp

                            <div class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-sm font-semibold text-foreground">
                                        Passkey Terdaftar
                                        <span class="ml-1.5 px-1.5 py-0.5 text-[10px] font-bold rounded-full bg-primary/10 text-primary">{{ $userPasskeys->count() }}</span>
                                    </h3>
                                </div>

                                @if ($userPasskeys->isEmpty())
                                    <div class="flex items-center gap-3.5 p-4 rounded-xl bg-muted/40 border border-dashed border-border/80">
                                        <div class="size-10 rounded-xl bg-muted flex items-center justify-center shrink-0">
                                            <svg class="size-5 text-muted-foreground" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                                <path d="M12 10a2 2 0 0 0-2 2c0 1.02-.1 2.51-.26 4" />
                                                <path d="M14 13.12c0 2.38 0 6.38-1 8.88" />
                                                <path d="M2 12a10 10 0 0 1 18-6" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-foreground">Belum ada passkey</p>
                                            <p class="text-xs text-muted-foreground mt-0.5">Daftarkan perangkat Anda di bawah untuk mulai menggunakan login biometrik.</p>
                                        </div>
                                    </div>
                                @else
                                    <div class="border border-border/60 rounded-2xl overflow-hidden divide-y divide-border/40">
                                        @foreach ($userPasskeys as $passkey)
                                            <div class="p-4 flex items-center justify-between gap-4 bg-card hover:bg-muted/20 transition-colors">
                                                <div class="flex items-center gap-3 min-w-0">
                                                    <div class="size-9 rounded-xl bg-primary/10 text-primary flex items-center justify-center shrink-0">
                                                        <svg class="size-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                            <path d="M12 10a2 2 0 0 0-2 2c0 1.02-.1 2.51-.26 4" />
                                                            <path d="M14 13.12c0 2.38 0 6.38-1 8.88" />
                                                            <path d="M17.29 21.02c.12-.6.43-2.3.5-3.02" />
                                                            <path d="M2 12a10 10 0 0 1 18-6" />
                                                        </svg>
                                                    </div>
                                                    <div class="min-w-0">
                                                        <p class="text-sm font-semibold text-foreground truncate">{{ $passkey->name }}</p>
                                                        <p class="text-xs text-muted-foreground">Ditambahkan {{ $passkey->created_at?->diffForHumans() }}</p>
                                                    </div>
                                                </div>
                                                <form method="POST" action="/user/passkeys/{{ $passkey->id }}" onsubmit="return confirm('Hapus passkey \'{{ $passkey->name }}\'? Anda tidak bisa login dengan perangkat ini lagi.');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-xs text-muted-foreground hover:text-destructive font-medium transition-colors cursor-pointer px-2 py-1 rounded-lg hover:bg-destructive/10">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            {{-- Add New Passkey (Sudo Mode / Protected by /confirm-password) --}}
                            <div class="pt-3 border-t border-border/50 space-y-4">
                                <div>
                                    <h3 class="text-sm font-semibold text-foreground">Daftarkan Passkey Baru</h3>
                                    <p class="text-xs text-muted-foreground mt-0.5">
                                        Daftarkan biometrik (Touch ID, Face ID, Windows Hello, atau YubiKey) pada perangkat ini.
                                    </p>
                                </div>

                                <form @submit.prevent="submitRegisterPasskey()" class="p-4 rounded-2xl bg-muted/30 border border-border/60 space-y-3.5">
                                    <div class="space-y-1.5 max-w-md">
                                        <label class="text-xs font-semibold text-foreground">Nama Perangkat</label>
                                        <input
                                            type="text"
                                            x-model="registerName"
                                            placeholder="Contoh: MacBook Pro Touch ID"
                                            class="w-full px-3 py-2 text-sm rounded-xl border border-input bg-background text-foreground shadow-2xs focus:ring-2 focus:ring-primary focus:outline-none"
                                            required
                                        />
                                    </div>

                                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 pt-1">
                                        <div class="text-[11px] text-muted-foreground flex items-center gap-1.5">
                                            <svg class="size-3.5 text-primary shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 10a2 2 0 0 0-2 2c0 1.02-.1 2.51-.26 4"/><path d="M14 13.12c0 2.38 0 6.38-1 8.88"/><path d="M2 12a10 10 0 0 1 18-6"/></svg>
                                            <span>Sensor biometrik perangkat akan langsung dipicu saat tombol ditekan.</span>
                                        </div>

                                        <vibe:button type="submit" variant="primary" size="sm" ::disabled="loading || !registerName" class="cursor-pointer shrink-0">
                                            <template x-if="!loading">
                                                <span class="inline-flex items-center gap-1.5">
                                                    <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                                    </svg>
                                                    <span>Daftarkan Passkey</span>
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

                            {{-- Info Note --}}
                            <div class="p-3.5 rounded-xl bg-muted/40 border border-border/60 text-xs text-muted-foreground space-y-1 leading-relaxed">
                                <p class="font-semibold text-foreground">Cara Kerja Passkey</p>
                                <p>Passkey menggunakan enkripsi kunci publik. Kunci privat tersimpan aman di perangkat Anda dan tidak pernah dikirim ke server. Browser akan meminta verifikasi biometrik (sidik jari / wajah) saat login.</p>
                            </div>
                        </div>
                    @else
                        {{-- Guest: lock screen --}}
                        <div class="flex flex-col items-center justify-center py-16 text-center space-y-4">
                            <div class="size-16 rounded-2xl bg-muted/60 flex items-center justify-center">
                                <svg class="size-8 text-muted-foreground" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M12 10a2 2 0 0 0-2 2c0 1.02-.1 2.51-.26 4" />
                                    <path d="M14 13.12c0 2.38 0 6.38-1 8.88" />
                                    <path d="M2 12a10 10 0 0 1 18-6" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-foreground">Login Diperlukan</h3>
                                <p class="text-xs text-muted-foreground mt-1 max-w-xs mx-auto">
                                    Manajemen Passkey hanya tersedia setelah Anda masuk ke akun.
                                </p>
                            </div>
                            <vibe:button href="/login" variant="primary" size="sm">Masuk ke Akun</vibe:button>
                        </div>
                    @endauth

                </div>
            </div>
        </vibe:card>
    </div>

    @push('body')
        <script>
            function passkeyController() {
                return {
                    supported: false,
                    isIpAddress: typeof window !== 'undefined' && (window.location.hostname === '127.0.0.1' || window.location.hostname === '::1'),
                    localhostUrl: typeof window !== 'undefined' ? window.location.href.replace('127.0.0.1', 'localhost') : '',
                    registerName: 'Perangkat Saya (' + (navigator.userAgent.includes('Mac') ? 'Mac Touch ID' : (navigator.userAgent.includes('Windows') ? 'Windows Hello' : 'Biometrik')) + ')',
                    loading: false,
                    statusText: '',
                    feedbackMessage: null,
                    feedbackType: 'info',
                    init() {
                        this.supported = !!(window.PublicKeyCredential && (window.VibePasskeyService?.isSupported() ?? true));
                    },
                    async submitRegisterPasskey() {
                        if (!this.registerName) {
                            this.feedbackType = 'error';
                            this.feedbackMessage = 'Harap masukkan nama perangkat.';
                            return;
                        }

                        this.loading = true;
                        this.statusText = 'Menyiapkan sensor biometrik perangkat...';
                        this.feedbackMessage = null;

                        try {
                            if (!window.VibePasskeyService) {
                                throw new Error('Modul Passkey belum dimuat.');
                            }

                            const regRes = await window.VibePasskeyService.register(this.registerName || 'Perangkat Saya');
                            if (regRes.success) {
                                this.feedbackType = 'success';
                                this.feedbackMessage = 'Passkey berhasil didaftarkan! Halaman akan diperbarui...';
                                setTimeout(() => window.location.reload(), 1500);
                            } else if (regRes.confirmationRequired) {
                                // Sesi konfirmasi password telah kedaluwarsa, arahkan ke /confirm-password
                                this.statusText = 'Mengarahkan ke halaman konfirmasi kata sandi...';
                                window.location.href = '{{ route("password.confirm") }}';
                            } else {
                                this.feedbackType = 'error';
                                this.feedbackMessage = regRes.message || 'Pendaftaran passkey dibatalkan oleh pengguna.';
                            }
                        } catch (err) {
                            if (err?.response?.status === 423 || err?.status === 423 || err?.message?.includes('423') || err?.message?.toLowerCase().includes('password confirmation')) {
                                this.statusText = 'Mengarahkan ke halaman konfirmasi kata sandi...';
                                window.location.href = '{{ route("password.confirm") }}';
                                return;
                            }
                            this.feedbackType = 'error';
                            this.feedbackMessage = err.message || 'Terjadi kesalahan saat memproses pendaftaran passkey.';
                        } finally {
                            this.loading = false;
                            this.statusText = '';
                        }
                    }
                };
            }
        </script>
    @endpush
</x-docs.layouts.sidebar>
