<x-[path].layouts.[style]>
    <vibe:seo :title="__('docs/page/settings/index.title')" :description="__('docs/page/settings/index.subtitle')" :breadcrumbs="[
        ['name' => __('docs/page/settings/index.breadcrumb.home'), 'url' => '/'],
        ['name' => __('docs/page/settings/index.breadcrumb.pages'), 'url' => '#'],
        ['name' => __('docs/page/settings/index.breadcrumb.settings'), 'url' => route('[path].settings.index')],
    ]" />

    @push('head')
        @vite('resources/js/vibe/passkeys.js')
    @endpush

    <div class="mx-auto w-full space-y-6">
        <vibe:breadcrumb title="{!! __('docs/page/settings/index.title') !!}">
            <vibe:breadcrumb.item href="{{ route('[path].index') }}">{{ __('docs/page/settings/index.breadcrumb.home') }}</vibe:breadcrumb.item>
            <vibe:breadcrumb.item>{{ __('docs/page/settings/index.breadcrumb.pages') }}</vibe:breadcrumb.item>
            <vibe:breadcrumb.item active>{{ __('docs/page/settings/index.breadcrumb.settings') }}</vibe:breadcrumb.item>
        </vibe:breadcrumb>

        <vibe:card class="p-0 overflow-hidden">
            <vibe:tabs default="{{ auth()->check() ? 'account' : 'appearance' }}" layout="cols" variant="sidebar" syncUrl="tab" class="w-full">

                {{-- ================================================================= --}}
                {{-- TABS LIST (sidebar kiri)                                          --}}
                {{-- ================================================================= --}}
                <vibe:tabs.list class="w-56 shrink-0 flex flex-col gap-0.5 p-3 border-r border-border/60 bg-muted/40">
                    <p class="px-2 pt-1 pb-1 text-[10px] font-bold uppercase tracking-widest text-muted-foreground/60">Akun</p>
                    <vibe:tabs.tab name="account">
                        <x-slot:icon>
                            <svg class="size-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="8" r="5" />
                                <path d="M20 21a8 8 0 0 0-16 0" />
                            </svg>
                        </x-slot:icon>
                        <span>{{ __('docs/page/settings/index.tabs.profile.label') }}</span>
                        @auth<span class="ml-auto size-1.5 rounded-full bg-emerald-500 shrink-0"></span>@endauth
                    </vibe:tabs.tab>

                    <vibe:tabs.tab name="security">
                        <x-slot:icon>
                            <svg class="size-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="18" height="11" x="3" y="11" rx="2" ry="2" />
                                <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                            </svg>
                        </x-slot:icon>
                        <span>{{ __('docs/page/settings/index.tabs.security.label') }}</span>
                    </vibe:tabs.tab>

                    {{-- Group: Preferensi --}}
                    <p class="px-2 pt-3 pb-1 text-[10px] font-bold uppercase tracking-widest text-muted-foreground/60">Preferensi</p>

                    <vibe:tabs.tab name="appearance">
                        <x-slot:icon>
                            <svg class="size-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z" />
                                <path d="M5 3v4" />
                                <path d="M19 17v4" />
                            </svg>
                        </x-slot:icon>
                        <span class="flex-1 text-left">{{ __('docs/page/settings/index.tabs.appearance.label') }}</span>
                    </vibe:tabs.tab>

                    <vibe:tabs.tab name="notifications">
                        <x-slot:icon>
                            <svg class="size-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9" />
                                <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0" />
                            </svg>
                        </x-slot:icon>
                        <span>{{ __('docs/page/settings/index.tabs.notifications.label') }}</span>
                    </vibe:tabs.tab>

                    {{-- Group: Sesi & Perangkat (auth only) --}}
                    @auth
                        <p class="px-2 pt-3 pb-1 text-[10px] font-bold uppercase tracking-widest text-muted-foreground/60">Sesi & Perangkat</p>

                        <vibe:tabs.tab name="login-history">
                            <x-slot:icon>
                                <svg class="size-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8" />
                                    <path d="M3 3v5h5" />
                                    <path d="M12 7v5l4 2" />
                                </svg>
                            </x-slot:icon>
                            <span>Riwayat Login</span>
                        </vibe:tabs.tab>

                        <vibe:tabs.tab name="passkey">
                            <x-slot:icon>
                                <svg class="size-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 10a2 2 0 0 0-2 2c0 1.02-.1 2.51-.26 4" />
                                    <path d="M14 13.12c0 2.38 0 6.38-1 8.88" />
                                    <path d="M17.29 21.02c.12-.6.43-2.3.5-3.02" />
                                    <path d="M2 12a10 10 0 0 1 18-6" />
                                </svg>
                            </x-slot:icon>
                            <span>Passkey</span>
                            @php $passkeyCount = auth()->user()->passkeys?->count() ?? 0; @endphp
                            @if ($passkeyCount > 0)
                                <span class="ml-auto text-[10px] font-bold px-1.5 py-0.5 rounded-full bg-primary/10 text-primary">{{ $passkeyCount }}</span>
                            @endif
                        </vibe:tabs.tab>

                        <div class="mt-auto pt-3 border-t border-border/40">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl text-sm font-medium text-muted-foreground hover:bg-destructive/10 hover:text-destructive transition-all cursor-pointer">
                                    <svg class="size-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                                        <polyline points="16 17 21 12 16 7" />
                                        <line x1="21" x2="9" y1="12" y2="12" />
                                    </svg>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    @else
                        <p class="px-2 pt-3 pb-1 text-[10px] font-bold uppercase tracking-widest text-muted-foreground/60">Sesi & Perangkat</p>
                        <vibe:tabs.tab name="login-history">
                            <svg class="size-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8" />
                                <path d="M3 3v5h5" />
                                <path d="M12 7v5l4 2" />
                            </svg>
                            <span>Riwayat Login</span>
                            <svg class="size-3.5 ml-auto text-muted-foreground/60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect width="18" height="11" x="3" y="11" rx="2" />
                                <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                            </svg>
                        </vibe:tabs.tab>
                        <vibe:tabs.tab name="passkey">
                            <svg class="size-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 10a2 2 0 0 0-2 2c0 1.02-.1 2.51-.26 4" />
                                <path d="M14 13.12c0 2.38 0 6.38-1 8.88" />
                                <path d="M17.29 21.02c.12-.6.43-2.3.5-3.02" />
                                <path d="M2 12a10 10 0 0 1 18-6" />
                            </svg>
                            <span>Passkey</span>
                            <svg class="size-3.5 ml-auto text-muted-foreground/60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect width="18" height="11" x="3" y="11" rx="2" />
                                <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                            </svg>
                        </vibe:tabs.tab>
                    @endauth
                </vibe:tabs.list>

                {{-- ================================================================= --}}
                {{-- PANEL 1: ACCOUNT                                                  --}}
                {{-- ================================================================= --}}
                <vibe:tabs.panel name="account" class="flex-1 min-w-0 p-6 space-y-6">
                    {{-- Header --}}
                    <div class="border-b border-border/50 pb-4">

                        <h2 class="text-lg font-bold text-foreground">Profil Akun</h2>
                        <p class="text-xs text-muted-foreground mt-0.5">
                            Kelola informasi publik dan preferensi akun Anda.
                        </p>
                    </div>

                    @auth
                        {{-- Logged-in: data nyata --}}

                        {{-- Auth Info Banner --}}
                        <div class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-xs text-emerald-700 dark:text-emerald-300">
                            <span class="size-2 rounded-full bg-emerald-500 shrink-0 animate-pulse"></span>
                            <span>Login sebagai <strong>{{ auth()->user()->name }}</strong> &mdash; data di bawah adalah informasi akun Anda yang sebenarnya.</span>
                        </div>

                        {{-- Avatar & Identity --}}
                        <div class="flex items-center gap-4">
                            @php
                                $initials = collect(explode(' ', auth()->user()->name))
                                    ->map(fn($w) => strtoupper(substr($w, 0, 1)))
                                    ->take(2)
                                    ->join('');
                            @endphp
                            <div class="size-16 rounded-2xl bg-primary/10 text-primary flex items-center justify-center text-xl font-bold ring-2 ring-primary/20 shrink-0 select-none">
                                {{ $initials }}
                            </div>
                            <div class="space-y-1">
                                <h4 class="text-sm font-semibold text-foreground">Foto Profil</h4>
                                <p class="text-xs text-muted-foreground">Foto profil diambil dari Gravatar berdasarkan email Anda.</p>
                                <div class="flex items-center gap-2 pt-1">
                                    <vibe:button type="button" size="sm" variant="outline" class="text-xs cursor-pointer">
                                        Ubah Foto
                                    </vibe:button>
                                    <vibe:button type="button" size="sm" variant="ghost" class="text-xs text-destructive hover:bg-destructive/10 cursor-pointer">
                                        Hapus Foto
                                    </vibe:button>
                                </div>
                            </div>
                        </div>

                        {{-- Form Fields (data nyata dari auth()) --}}
                        <div class="space-y-4 max-w-xl">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <vibe:input name="full_name" label="Nama Lengkap" value="{{ auth()->user()->name }}" placeholder="Nama lengkap Anda" />
                                <vibe:input type="email" name="email" label="Alamat Email" value="{{ auth()->user()->email }}" placeholder="nama@domain.com" />
                            </div>
                            @if (isset(auth()->user()->username))
                                <vibe:input name="username" label="Username" value="{{ auth()->user()->username ?? '' }}" placeholder="username_anda" />
                            @endif
                            @if (isset(auth()->user()->phone))
                                <vibe:input name="phone" label="No. Handphone" value="{{ auth()->user()->phone ?? '' }}" placeholder="+62 812 xxxx xxxx" />
                            @endif
                            <vibe:textarea name="bio" label="Bio" placeholder="Ceritakan sedikit tentang Anda..." rows="2"></vibe:textarea>

                            {{-- Language Selector --}}
                            <div class="space-y-2 pt-2">
                                <label class="text-xs font-semibold text-foreground uppercase tracking-wider block">Bahasa Antarmuka</label>
                                <div class="inline-flex p-1 rounded-xl bg-muted/50 border border-border/60 gap-1">
                                    <vibe:button variant="ghost" size="sm" href="{{ route('locale.switch', 'id') }}" class="px-3 py-1.5 rounded-lg text-xs transition-all {{ app()->getLocale() === 'id' ? 'bg-card text-foreground shadow-xs font-semibold' : 'text-muted-foreground hover:text-foreground' }}">
                                        🇮🇩 Bahasa Indonesia
                                    </vibe:button>
                                    <vibe:button variant="ghost" size="sm" href="{{ route('locale.switch', 'en') }}" class="px-3 py-1.5 rounded-lg text-xs transition-all {{ app()->getLocale() === 'en' ? 'bg-card text-foreground shadow-xs font-semibold' : 'text-muted-foreground hover:text-foreground' }}">
                                        🇺🇸 English (US)
                                    </vibe:button>
                                </div>
                            </div>
                        </div>

                        {{-- Save Action --}}
                        <div class="pt-4 border-t border-border/50 flex items-center justify-end">
                            <vibe:button type="button" variant="primary" size="sm" class="cursor-pointer" @click="window.vibeToast ? vibeToast('Profil berhasil disimpan.', { type: 'success', title: 'Tersimpan' }) : null">
                                Simpan Perubahan
                            </vibe:button>
                        </div>
                    @else
                        {{-- Guest: dummy data + login prompt --}}

                        {{-- Guest Banner --}}
                        <div class="flex items-center gap-3 px-3.5 py-3 rounded-xl bg-amber-500/10 border border-amber-500/20 text-xs text-amber-700 dark:text-amber-300">
                            <svg class="size-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Ini adalah pratinjau UI. <strong>Login</strong> untuk mengelola profil akun nyata Anda.</span>
                            <a href="/login" class="ml-auto shrink-0 px-3 py-1 rounded-lg bg-amber-500 text-white font-semibold hover:bg-amber-600 transition-colors">Login →</a>
                        </div>

                        {{-- Avatar & Identity (dummy) --}}
                        <div class="flex items-center gap-4">
                            <vibe:avatar size="lg" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=75&w=128&h=128&auto=format&fit=crop" alt="User Avatar" class="ring-2 ring-primary/20 shrink-0" />
                            <div class="space-y-1">
                                <h4 class="text-sm font-semibold text-foreground">Foto Profil</h4>
                                <div class="flex items-center gap-2">
                                    <vibe:button type="button" size="sm" variant="outline" class="text-xs cursor-pointer">
                                        Ubah Foto
                                    </vibe:button>
                                    <vibe:button type="button" size="sm" variant="ghost" class="text-xs text-destructive hover:bg-destructive/10 cursor-pointer">
                                        Hapus Foto
                                    </vibe:button>
                                </div>
                            </div>
                        </div>

                        {{-- Essential Fields (dummy) --}}
                        <div class="space-y-4 max-w-xl">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <vibe:input name="full_name" label="Nama Lengkap" value="Masum Parvej" placeholder="Nama lengkap Anda" />
                                <vibe:input type="email" name="email" label="Alamat Email" value="masum@hugeicons.com" placeholder="nama@domain.com" />
                            </div>
                            <vibe:textarea name="bio" label="Bio" placeholder="Ceritakan sedikit tentang Anda..." rows="2">UI/UX Designer & Design Systems Architect at Teknovate.</vibe:textarea>

                            <div class="space-y-2 pt-2">
                                <label class="text-xs font-semibold text-foreground uppercase tracking-wider block">Bahasa Antarmuka</label>
                                <div class="inline-flex p-1 rounded-xl bg-muted/50 border border-border/60 gap-1">
                                    <vibe:button variant="ghost" size="sm" href="{{ route('locale.switch', 'id') }}" class="px-3 py-1.5 rounded-lg text-xs transition-all {{ app()->getLocale() === 'id' ? 'bg-card text-foreground shadow-xs font-semibold' : 'text-muted-foreground hover:text-foreground' }}">
                                        🇮🇩 Bahasa Indonesia
                                    </vibe:button>
                                    <vibe:button variant="ghost" size="sm" href="{{ route('locale.switch', 'en') }}" class="px-3 py-1.5 rounded-lg text-xs transition-all {{ app()->getLocale() === 'en' ? 'bg-card text-foreground shadow-xs font-semibold' : 'text-muted-foreground hover:text-foreground' }}">
                                        🇺🇸 English (US)
                                    </vibe:button>
                                </div>
                            </div>
                        </div>

                        <div class="pt-4 border-t border-border/50 flex items-center justify-end">
                            <vibe:button type="button" variant="primary" size="sm" class="cursor-pointer" @click="window.vibeToast ? vibeToast('Profil berhasil disimpan.', { type: 'success', title: 'Tersimpan' }) : null">
                                Simpan Perubahan
                            </vibe:button>
                        </div>
                    @endauth
                </vibe:tabs.panel>

                {{-- ================================================================= --}}
                {{-- PANEL 2: SECURITY                                                 --}}
                {{-- ================================================================= --}}
                <vibe:tabs.panel name="security" class="flex-1 min-w-0 p-6 space-y-6">

                    {{-- Header --}}
                    <div class="border-b border-border/50 pb-4">
                        <h2 class="text-lg font-bold text-foreground">Keamanan Akun</h2>
                        <p class="text-xs text-muted-foreground mt-0.5">
                            Kelola kata sandi dan lapisan keamanan tambahan untuk akun Anda.
                        </p>
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
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-medium bg-emerald-500/10 text-emerald-600 dark:text-emerald-400">
                                <span class="size-1.5 rounded-full bg-emerald-500"></span>
                                Aktif
                            </span>
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
                </vibe:tabs.panel>

                {{-- ================================================================= --}}
                {{-- PANEL 3: APPEARANCE (LIVE THEME ENGINE)                           --}}
                {{-- ================================================================= --}}
                <vibe:tabs.panel name="appearance" class="flex-1 min-w-0 p-6 sm:p-8 space-y-8">
                    <div x-data="appearanceController()" x-init="init()" class="space-y-8">
                        {{-- 1. Header Bar with Status & Actions --}}
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-border/60">
                            <div class="flex items-start gap-3.5">
                                <div class="size-11 rounded-2xl bg-primary/10 text-primary flex items-center justify-center shrink-0 ring-1 ring-primary/20 shadow-xs">
                                    <svg class="size-5.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z" />
                                        <path d="M5 3v4" />
                                        <path d="M19 17v4" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="flex items-center gap-2.5">
                                        <h2 class="text-xl font-bold tracking-tight text-foreground">
                                            {{ __('docs/page/settings/index.tabs.appearance.label') }}
                                        </h2>
                                        <vibe:badge variant="success" size="sm" class="rounded-full" dot dotPulse>
                                            Live Engine
                                        </vibe:badge>
                                    </div>
                                    <p class="text-xs text-muted-foreground mt-1 leading-relaxed max-w-xl">
                                        {{ __('docs/page/settings/index.tabs.appearance.desc') }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2 shrink-0 self-end sm:self-auto">
                                <button type="button" @click="resetToDefault()" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-border/80 bg-background/80 hover:bg-muted text-xs font-medium text-muted-foreground hover:text-foreground transition-all cursor-pointer shadow-2xs">
                                    <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8" />
                                        <path d="M3 3v5h5" />
                                    </svg>
                                    <span>Reset</span>
                                </button>
                                <button type="button" @click="savePreferences()" class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-xl bg-primary text-primary-foreground hover:opacity-90 text-xs font-semibold shadow-xs transition-all cursor-pointer active:scale-95">
                                    <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="20 6 9 17 4 12" />
                                    </svg>
                                    <span>Simpan Tema</span>
                                </button>
                            </div>
                        </div>

                        {{-- 3. Mode Antarmuka (Light / Dark / System) with Visual Cards --}}
                        <div class="space-y-3">
                            <div>
                                <label class="text-xs font-bold uppercase tracking-wider text-foreground block">
                                    {{ __('docs/page/settings/index.appearance.theme_mode_title') }}
                                </label>
                                <p class="text-xs text-muted-foreground mt-0.5">
                                    {{ __('docs/page/settings/index.appearance.theme_mode_desc') }}
                                </p>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                {{-- Light Card --}}
                                <button type="button" @click="setMode('light', $event)" class="relative text-left p-4 rounded-2xl border transition-all duration-200 cursor-pointer group flex flex-col justify-between gap-3.5 overflow-hidden" :class="mode === 'light' ? 'bg-card border-primary ring-2 ring-primary/20 shadow-md' : 'bg-muted/30 border-border hover:border-primary/50 hover:bg-muted/50'">
                                    <div class="flex items-center justify-between">
                                        <div class="size-9 rounded-xl bg-amber-500/10 text-amber-500 flex items-center justify-center border border-amber-500/20">
                                            <svg class="size-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <circle cx="12" cy="12" r="4" />
                                                <path d="M12 2v2" />
                                                <path d="M12 20v2" />
                                                <path d="m4.93 4.93 1.41 1.41" />
                                                <path d="m17.66 17.66 1.41 1.41" />
                                                <path d="M2 12h2" />
                                                <path d="M20 12h2" />
                                                <path d="m6.34 17.66-1.41 1.41" />
                                                <path d="m19.07 4.93-1.41 1.41" />
                                            </svg>
                                        </div>
                                        <div x-show="mode === 'light'" class="size-5 rounded-full bg-primary text-primary-foreground flex items-center justify-center text-[11px] shadow-xs">
                                            <svg class="size-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                                                <polyline points="20 6 9 17 4 12" />
                                            </svg>
                                        </div>
                                    </div>
                                    {{-- Mini UI representation --}}
                                    <div class="h-12 w-full rounded-xl bg-white border border-zinc-200 p-1.5 flex gap-1.5 shadow-2xs">
                                        <div class="w-1/4 h-full rounded-md bg-zinc-100"></div>
                                        <div class="flex-1 h-full flex flex-col gap-1.5 justify-center">
                                            <div class="w-full h-2 rounded-xs bg-zinc-100"></div>
                                            <div class="w-2/3 h-2 rounded-xs bg-primary/40"></div>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-foreground">Terang (Light)</p>
                                        <p class="text-[11px] text-muted-foreground mt-0.5">Tampilan cerah dengan kontras jernih</p>
                                    </div>
                                </button>

                                {{-- Dark Card --}}
                                <button type="button" @click="setMode('dark', $event)" class="relative text-left p-4 rounded-2xl border transition-all duration-200 cursor-pointer group flex flex-col justify-between gap-3.5 overflow-hidden" :class="mode === 'dark' ? 'bg-card border-primary ring-2 ring-primary/20 shadow-md' : 'bg-muted/30 border-border hover:border-primary/50 hover:bg-muted/50'">
                                    <div class="flex items-center justify-between">
                                        <div class="size-9 rounded-xl bg-indigo-500/10 text-indigo-400 flex items-center justify-center border border-indigo-500/20">
                                            <svg class="size-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z" />
                                            </svg>
                                        </div>
                                        <div x-show="mode === 'dark'" class="size-5 rounded-full bg-primary text-primary-foreground flex items-center justify-center text-[11px] shadow-xs">
                                            <svg class="size-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                                                <polyline points="20 6 9 17 4 12" />
                                            </svg>
                                        </div>
                                    </div>
                                    {{-- Mini UI representation --}}
                                    <div class="h-12 w-full rounded-xl bg-zinc-950 border border-zinc-800 p-1.5 flex gap-1.5 shadow-2xs">
                                        <div class="w-1/4 h-full rounded-md bg-zinc-900"></div>
                                        <div class="flex-1 h-full flex flex-col gap-1.5 justify-center">
                                            <div class="w-full h-2 rounded-xs bg-zinc-900"></div>
                                            <div class="w-2/3 h-2 rounded-xs bg-primary/50"></div>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-foreground">Gelap (Dark)</p>
                                        <p class="text-[11px] text-muted-foreground mt-0.5">Kontras tinggi & nyaman di malam hari</p>
                                    </div>
                                </button>

                                {{-- System Card --}}
                                <button type="button" @click="setMode('system', $event)" class="relative text-left p-4 rounded-2xl border transition-all duration-200 cursor-pointer group flex flex-col justify-between gap-3.5 overflow-hidden" :class="mode === 'system' ? 'bg-card border-primary ring-2 ring-primary/20 shadow-md' : 'bg-muted/30 border-border hover:border-primary/50 hover:bg-muted/50'">
                                    <div class="flex items-center justify-between">
                                        <div class="size-9 rounded-xl bg-cyan-500/10 text-cyan-500 flex items-center justify-center border border-cyan-500/20">
                                            <svg class="size-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <rect width="20" height="14" x="2" y="3" rx="2" />
                                                <line x1="8" x2="16" y1="21" y2="21" />
                                                <line x1="12" x2="12" y1="17" y2="21" />
                                            </svg>
                                        </div>
                                        <div x-show="mode === 'system'" class="size-5 rounded-full bg-primary text-primary-foreground flex items-center justify-center text-[11px] shadow-xs">
                                            <svg class="size-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                                                <polyline points="20 6 9 17 4 12" />
                                            </svg>
                                        </div>
                                    </div>
                                    {{-- Mini UI representation (split) --}}
                                    <div class="h-12 w-full rounded-xl border border-zinc-300 dark:border-zinc-700 flex overflow-hidden shadow-2xs">
                                        <div class="w-1/2 h-full bg-white p-1.5 flex gap-1 items-center">
                                            <div class="w-1/3 h-full rounded-xs bg-zinc-100"></div>
                                            <div class="flex-1 h-2 bg-primary/30 rounded-xs"></div>
                                        </div>
                                        <div class="w-1/2 h-full bg-zinc-950 p-1.5 flex gap-1 items-center border-l border-zinc-700">
                                            <div class="w-1/3 h-full rounded-xs bg-zinc-900"></div>
                                            <div class="flex-1 h-2 bg-primary/50 rounded-xs"></div>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-foreground">Sistem (Otomatis)</p>
                                        <p class="text-[11px] text-muted-foreground mt-0.5">Sinkron dengan setelan sistem operasi</p>
                                    </div>
                                </button>
                            </div>
                        </div>

                        {{-- 4. Warna Aksen Utama (--primary) --}}
                        <div class="space-y-3 pt-6 border-t border-border/50">
                            <div class="flex items-center justify-between">
                                <div>
                                    <label class="text-xs font-bold uppercase tracking-wider text-foreground block">
                                        {{ __('docs/page/settings/index.appearance.primary_color_title') }}
                                    </label>
                                    <p class="text-xs text-muted-foreground mt-0.5">
                                        {{ __('docs/page/settings/index.appearance.primary_color_desc') }}
                                    </p>
                                </div>
                                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-muted/60 border border-border/80 shadow-2xs">
                                    <span class="size-2.5 rounded-full" :style="{ backgroundColor: getActivePrimaryColor() }"></span>
                                    <span class="font-semibold text-foreground" x-text="getActiveColorName()"></span>
                                </div>
                            </div>

                            <div class="flex flex-wrap items-center gap-3 pt-1">
                                <template x-for="(val, key) in presets" :key="key">
                                    <button type="button" @click="selectPreset(key)" :title="val.name" class="size-10 rounded-2xl transition-all duration-200 hover:scale-110 active:scale-95 cursor-pointer flex items-center justify-center relative shadow-xs group" :class="selectedPreset === key ? 'ring-2 ring-primary ring-offset-2 ring-offset-background scale-105 shadow-sm' : 'hover:shadow-md'" :style="{ backgroundColor: val.color }">
                                        <svg x-show="selectedPreset === key" class="size-4 text-white drop-shadow-xs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="20 6 9 17 4 12" />
                                        </svg>
                                    </button>
                                </template>

                                {{-- Custom Color Picker Pill --}}
                                <label title="Pilih Warna Kustom" class="h-10 px-3.5 rounded-2xl border-2 border-dashed transition-all cursor-pointer relative flex items-center gap-2 group hover:border-primary shrink-0" :class="selectedPreset === 'custom' ? 'border-primary ring-2 ring-primary/30 bg-primary/5 shadow-xs' : 'border-border/80 hover:bg-muted/40'">
                                    <input type="color" x-model="customHex" @input="applyCustomHex(customHex)" class="absolute inset-0 opacity-0 cursor-pointer size-full" />
                                    <span class="size-4 rounded-full border border-black/10 shadow-2xs" :style="{ backgroundColor: customHex }"></span>
                                    <span class="text-xs font-mono font-semibold" :class="selectedPreset === 'custom' ? 'text-primary' : 'text-muted-foreground group-hover:text-foreground'" x-text="customHex"></span>
                                    <svg class="size-3.5 text-muted-foreground group-hover:text-primary transition-colors" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M12 5v14" />
                                        <path d="M5 12h14" />
                                    </svg>
                                </label>
                            </div>
                        </div>

                        {{-- 5. Kustomisasi Sidebar --}}
                        <div class="space-y-4 pt-6 border-t border-border/50">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                                <div>
                                    <div class="flex items-center gap-2">
                                        <label class="text-xs font-bold uppercase tracking-wider text-foreground block">
                                            {{ __('docs/page/settings/index.appearance.sidebar_title') }}
                                        </label>
                                        <span class="text-[10px] font-semibold px-2 py-0.5 rounded-md bg-muted text-muted-foreground border border-border/60" x-text="getActiveSidebarName()"></span>
                                    </div>
                                    <p class="text-xs text-muted-foreground mt-0.5">
                                        {{ __('docs/page/settings/index.appearance.sidebar_desc') }}
                                    </p>
                                </div>
                            </div>

                            {{-- Sidebar Preset Cards --}}
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-2.5">
                                <template x-for="(val, key) in sidebarPresets" :key="key">
                                    <button type="button" @click="selectSidebarPreset(key)" class="p-2.5 rounded-xl border transition-all duration-200 cursor-pointer text-left flex flex-col gap-2 group relative" :class="selectedSidebarPreset === key ? 'bg-card border-primary ring-2 ring-primary/20 shadow-xs' : 'bg-muted/20 border-border/70 hover:border-primary/40 hover:bg-muted/50'">
                                        {{-- Visual Mini Sidebar Strip --}}
                                        <div class="h-10 w-full rounded-lg border flex overflow-hidden shadow-2xs" :style="{
                                            backgroundColor: (mode === 'dark' ? val.dark.bg : val.light.bg),
                                            borderColor: (mode === 'dark' ? val.dark.border : val.light.border)
                                        }">
                                            <div class="w-1/3 h-full border-r p-1 flex flex-col gap-1" :style="{ borderColor: (mode === 'dark' ? val.dark.border : val.light.border) }">
                                                <div class="size-1.5 rounded-full" :style="{ backgroundColor: getActivePrimaryColor() }"></div>
                                                <div class="w-full h-1 rounded-xs opacity-40" :style="{ backgroundColor: (mode === 'dark' ? val.dark.fg : val.light.fg) }"></div>
                                            </div>
                                            <div class="flex-1 h-full p-1 flex items-center justify-center">
                                                <div class="w-3/4 h-1.5 rounded-xs opacity-20" :style="{ backgroundColor: (mode === 'dark' ? val.dark.fg : val.light.fg) }"></div>
                                            </div>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <span class="text-[11px] font-semibold truncate text-foreground" x-text="val.name"></span>
                                            <span x-show="selectedSidebarPreset === key" class="size-1.5 rounded-full bg-primary shrink-0"></span>
                                        </div>
                                    </button>
                                </template>

                                {{-- Custom Sidebar Button --}}
                                <button type="button" @click="selectedSidebarPreset = 'custom'; updateGeneratedCss(); injectOverrideCss();" class="p-2.5 rounded-xl border transition-all duration-200 cursor-pointer text-left flex flex-col gap-2 group relative" :class="selectedSidebarPreset === 'custom' ? 'bg-card border-primary ring-2 ring-primary/20 shadow-xs' : 'bg-muted/20 border-border/70 hover:border-primary/40 hover:bg-muted/50'">
                                    <div class="h-10 w-full rounded-lg border-2 border-dashed border-border/80 flex items-center justify-center shadow-2xs" :style="{ backgroundColor: customSidebarBg }">
                                        <span class="text-xs font-bold" :style="{ color: customSidebarFg }">🎨</span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-[11px] font-semibold text-foreground">Kustom</span>
                                        <span x-show="selectedSidebarPreset === 'custom'" class="size-1.5 rounded-full bg-primary shrink-0"></span>
                                    </div>
                                </button>
                            </div>

                            {{-- Custom Sidebar Color Studio --}}
                            <div x-show="selectedSidebarPreset === 'custom'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="p-4 rounded-2xl bg-card border border-border/70 shadow-xs space-y-4">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-bold text-foreground">Studio Warna Sidebar Kustom</span>
                                    <button type="button" @click="autoAdjustSidebarColors()" class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-muted hover:bg-muted/80 text-xs text-muted-foreground hover:text-foreground font-medium transition-colors cursor-pointer">
                                        <svg class="size-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M12 2v4" />
                                            <path d="m4.93 4.93 2.83 2.83" />
                                            <path d="M2 12h4" />
                                            <path d="m4.93 19.07 2.83-2.83" />
                                        </svg>
                                        <span>Auto Kontras Teks</span>
                                    </button>
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3.5">
                                    {{-- Background --}}
                                    <div class="p-3 rounded-xl bg-muted/40 border border-border/60 space-y-2">
                                        <label class="text-[11px] font-semibold text-foreground block">{{ __('docs/page/settings/index.appearance.sidebar_bg') }}</label>
                                        <div class="flex items-center gap-2">
                                            <label class="size-9 rounded-xl border border-border shadow-2xs cursor-pointer shrink-0 relative overflow-hidden flex items-center justify-center" :style="{ backgroundColor: customSidebarBg }">
                                                <input type="color" x-model="customSidebarBg" @input="applyCustomSidebarBg(customSidebarBg)" class="absolute inset-0 opacity-0 cursor-pointer size-full" />
                                            </label>
                                            <input type="text" x-model="customSidebarBg" @change="applyCustomSidebarBg(customSidebarBg)" class="w-full text-xs font-mono px-3 py-2 rounded-xl border border-border bg-background text-foreground focus:ring-2 focus:ring-primary focus:outline-none" />
                                        </div>
                                    </div>

                                    {{-- Foreground --}}
                                    <div class="p-3 rounded-xl bg-muted/40 border border-border/60 space-y-2">
                                        <label class="text-[11px] font-semibold text-foreground block">{{ __('docs/page/settings/index.appearance.sidebar_fg') }}</label>
                                        <div class="flex items-center gap-2">
                                            <label class="size-9 rounded-xl border border-border shadow-2xs cursor-pointer shrink-0 relative overflow-hidden flex items-center justify-center" :style="{ backgroundColor: customSidebarFg }">
                                                <input type="color" x-model="customSidebarFg" @input="applyCustomSidebarFg(customSidebarFg)" class="absolute inset-0 opacity-0 cursor-pointer size-full" />
                                            </label>
                                            <input type="text" x-model="customSidebarFg" @change="applyCustomSidebarFg(customSidebarFg)" class="w-full text-xs font-mono px-3 py-2 rounded-xl border border-border bg-background text-foreground focus:ring-2 focus:ring-primary focus:outline-none" />
                                        </div>
                                    </div>

                                    {{-- Border --}}
                                    <div class="p-3 rounded-xl bg-muted/40 border border-border/60 space-y-2">
                                        <label class="text-[11px] font-semibold text-foreground block">{{ __('docs/page/settings/index.appearance.sidebar_border') }}</label>
                                        <div class="flex items-center gap-2">
                                            <label class="size-9 rounded-xl border border-border shadow-2xs cursor-pointer shrink-0 relative overflow-hidden flex items-center justify-center" :style="{ backgroundColor: customSidebarBorder }">
                                                <input type="color" x-model="customSidebarBorder" @input="applyCustomSidebarBorder(customSidebarBorder)" class="absolute inset-0 opacity-0 cursor-pointer size-full" />
                                            </label>
                                            <input type="text" x-model="customSidebarBorder" @change="applyCustomSidebarBorder(customSidebarBorder)" class="w-full text-xs font-mono px-3 py-2 rounded-xl border border-border bg-background text-foreground focus:ring-2 focus:ring-primary focus:outline-none" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- 6. Kustomisasi Header --}}
                        <div class="space-y-4 pt-6 border-t border-border/50">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                                <div>
                                    <div class="flex items-center gap-2">
                                        <label class="text-xs font-bold uppercase tracking-wider text-foreground block">
                                            {{ __('docs/page/settings/index.appearance.header_title') }}
                                        </label>
                                        <span class="text-[10px] font-semibold px-2 py-0.5 rounded-md bg-muted text-muted-foreground border border-border/60" x-text="getActiveHeaderName()"></span>
                                    </div>
                                    <p class="text-xs text-muted-foreground mt-0.5">
                                        {{ __('docs/page/settings/index.appearance.header_desc') }}
                                    </p>
                                </div>
                            </div>

                            {{-- Header Preset Cards --}}
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-2.5">
                                <template x-for="(val, key) in headerPresets" :key="key">
                                    <button type="button" @click="selectHeaderPreset(key)" class="p-2.5 rounded-xl border transition-all duration-200 cursor-pointer text-left flex flex-col gap-2 group relative" :class="selectedHeaderPreset === key ? 'bg-card border-primary ring-2 ring-primary/20 shadow-xs' : 'bg-muted/20 border-border/70 hover:border-primary/40 hover:bg-muted/50'">
                                        {{-- Visual Mini Header Strip --}}
                                        <div class="h-10 w-full rounded-lg border flex flex-col overflow-hidden shadow-2xs" :style="{
                                            backgroundColor: (mode === 'dark' ? val.dark.bg : val.light.bg),
                                            borderColor: (mode === 'dark' ? val.dark.border : val.light.border)
                                        }">
                                            <div class="h-4 w-full border-b px-1.5 flex items-center justify-between" :style="{ borderColor: (mode === 'dark' ? val.dark.border : val.light.border) }">
                                                <div class="w-1/3 h-1 rounded-xs opacity-50" :style="{ backgroundColor: (mode === 'dark' ? val.dark.fg : val.light.fg) }"></div>
                                                <div class="size-2 rounded-full" :style="{ backgroundColor: getActivePrimaryColor() }"></div>
                                            </div>
                                            <div class="flex-1 w-full p-1 flex items-center justify-center bg-black/5 dark:bg-white/5">
                                                <div class="w-1/2 h-1 rounded-xs opacity-20" :style="{ backgroundColor: (mode === 'dark' ? val.dark.fg : val.light.fg) }"></div>
                                            </div>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <span class="text-[11px] font-semibold truncate text-foreground" x-text="val.name"></span>
                                            <span x-show="selectedHeaderPreset === key" class="size-1.5 rounded-full bg-primary shrink-0"></span>
                                        </div>
                                    </button>
                                </template>

                                {{-- Custom Header Button --}}
                                <button type="button" @click="selectedHeaderPreset = 'custom'; updateGeneratedCss(); injectOverrideCss();" class="p-2.5 rounded-xl border transition-all duration-200 cursor-pointer text-left flex flex-col gap-2 group relative" :class="selectedHeaderPreset === 'custom' ? 'bg-card border-primary ring-2 ring-primary/20 shadow-xs' : 'bg-muted/20 border-border/70 hover:border-primary/40 hover:bg-muted/50'">
                                    <div class="h-10 w-full rounded-lg border-2 border-dashed border-border/80 flex items-center justify-center shadow-2xs" :style="{ backgroundColor: customHeaderBg }">
                                        <span class="text-xs font-bold" :style="{ color: customHeaderFg }">✨</span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-[11px] font-semibold text-foreground">Kustom</span>
                                        <span x-show="selectedHeaderPreset === 'custom'" class="size-1.5 rounded-full bg-primary shrink-0"></span>
                                    </div>
                                </button>
                            </div>

                            {{-- Custom Header Color Studio --}}
                            <div x-show="selectedHeaderPreset === 'custom'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="p-4 rounded-2xl bg-card border border-border/70 shadow-xs space-y-4">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-bold text-foreground">Studio Warna Header Kustom</span>
                                    <button type="button" @click="autoAdjustHeaderColors()" class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-muted hover:bg-muted/80 text-xs text-muted-foreground hover:text-foreground font-medium transition-colors cursor-pointer">
                                        <svg class="size-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M12 2v4" />
                                            <path d="m4.93 4.93 2.83 2.83" />
                                            <path d="M2 12h4" />
                                            <path d="m4.93 19.07 2.83-2.83" />
                                        </svg>
                                        <span>Auto Kontras Teks</span>
                                    </button>
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3.5">
                                    {{-- Background --}}
                                    <div class="p-3 rounded-xl bg-muted/40 border border-border/60 space-y-2">
                                        <label class="text-[11px] font-semibold text-foreground block">{{ __('docs/page/settings/index.appearance.header_bg') }}</label>
                                        <div class="flex items-center gap-2">
                                            <label class="size-9 rounded-xl border border-border shadow-2xs cursor-pointer shrink-0 relative overflow-hidden flex items-center justify-center" :style="{ backgroundColor: customHeaderBg }">
                                                <input type="color" x-model="customHeaderBg" @input="applyCustomHeaderBg(customHeaderBg)" class="absolute inset-0 opacity-0 cursor-pointer size-full" />
                                            </label>
                                            <input type="text" x-model="customHeaderBg" @change="applyCustomHeaderBg(customHeaderBg)" class="w-full text-xs font-mono px-3 py-2 rounded-xl border border-border bg-background text-foreground focus:ring-2 focus:ring-primary focus:outline-none" />
                                        </div>
                                    </div>

                                    {{-- Foreground --}}
                                    <div class="p-3 rounded-xl bg-muted/40 border border-border/60 space-y-2">
                                        <label class="text-[11px] font-semibold text-foreground block">{{ __('docs/page/settings/index.appearance.header_fg') }}</label>
                                        <div class="flex items-center gap-2">
                                            <label class="size-9 rounded-xl border border-border shadow-2xs cursor-pointer shrink-0 relative overflow-hidden flex items-center justify-center" :style="{ backgroundColor: customHeaderFg }">
                                                <input type="color" x-model="customHeaderFg" @input="applyCustomHeaderFg(customHeaderFg)" class="absolute inset-0 opacity-0 cursor-pointer size-full" />
                                            </label>
                                            <input type="text" x-model="customHeaderFg" @change="applyCustomHeaderFg(customHeaderFg)" class="w-full text-xs font-mono px-3 py-2 rounded-xl border border-border bg-background text-foreground focus:ring-2 focus:ring-primary focus:outline-none" />
                                        </div>
                                    </div>

                                    {{-- Border --}}
                                    <div class="p-3 rounded-xl bg-muted/40 border border-border/60 space-y-2">
                                        <label class="text-[11px] font-semibold text-foreground block">{{ __('docs/page/settings/index.appearance.header_border') }}</label>
                                        <div class="flex items-center gap-2">
                                            <label class="size-9 rounded-xl border border-border shadow-2xs cursor-pointer shrink-0 relative overflow-hidden flex items-center justify-center" :style="{ backgroundColor: customHeaderBorder }">
                                                <input type="color" x-model="customHeaderBorder" @input="applyCustomHeaderBorder(customHeaderBorder)" class="absolute inset-0 opacity-0 cursor-pointer size-full" />
                                            </label>
                                            <input type="text" x-model="customHeaderBorder" @change="applyCustomHeaderBorder(customHeaderBorder)" class="w-full text-xs font-mono px-3 py-2 rounded-xl border border-border bg-background text-foreground focus:ring-2 focus:ring-primary focus:outline-none" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- 7. Bentuk Radius & Tipografi --}}
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 pt-6 border-t border-border/50">
                            {{-- Corner Radius --}}
                            <div class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <label class="text-xs font-bold uppercase tracking-wider text-foreground block">
                                        {{ __('docs/page/settings/index.appearance.radius_title') }}
                                    </label>
                                    <span class="text-xs font-mono font-semibold text-primary px-2.5 py-0.5 rounded-md bg-primary/10 border border-primary/20" x-text="selectedRadius"></span>
                                </div>
                                <div class="grid grid-cols-5 gap-2">
                                    <template x-for="r in radii" :key="r.value">
                                        <button type="button" @click="selectRadius(r.value)" class="p-2.5 rounded-xl border transition-all duration-200 cursor-pointer flex flex-col items-center gap-2 group text-center" :class="selectedRadius === r.value ? 'bg-card border-primary ring-2 ring-primary/20 shadow-xs' : 'bg-muted/20 border-border hover:border-primary/40 hover:bg-muted/50'">
                                            <div class="size-7 border-2 border-primary/70 bg-primary/10 transition-all flex items-center justify-center" :style="{ borderRadius: r.value }">
                                                <span class="size-2 bg-primary" :style="{ borderRadius: r.value }"></span>
                                            </div>
                                            <span class="text-[11px] font-medium text-foreground truncate w-full" x-text="r.label"></span>
                                        </button>
                                    </template>
                                </div>
                            </div>

                            {{-- Font Family --}}
                            <div class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <label class="text-xs font-bold uppercase tracking-wider text-foreground block">
                                        {{ __('docs/page/settings/index.appearance.font_title') }}
                                    </label>
                                    <span class="text-xs font-medium text-primary px-2.5 py-0.5 rounded-md bg-primary/10 border border-primary/20" x-text="selectedFontName"></span>
                                </div>
                                <div class="grid grid-cols-2 gap-2">
                                    <template x-for="f in fonts" :key="f.name">
                                        <button type="button" @click="selectFont(f.value, f.name)" class="p-2.5 rounded-xl border transition-all duration-200 cursor-pointer text-left flex items-center gap-3 group" :class="selectedFontName === f.name ? 'bg-card border-primary ring-2 ring-primary/20 shadow-xs' : 'bg-muted/20 border-border hover:border-primary/40 hover:bg-muted/50'">
                                            <span class="text-xl font-bold text-foreground/80 group-hover:text-primary transition-colors" :style="{ fontFamily: f.value }">Aa</span>
                                            <div class="min-w-0 flex-1">
                                                <p class="text-xs font-semibold text-foreground truncate" :style="{ fontFamily: f.value }" x-text="f.name"></p>
                                                <p class="text-[10px] text-muted-foreground truncate" x-text="f.desc"></p>
                                            </div>
                                            <span x-show="selectedFontName === f.name" class="size-1.5 rounded-full bg-primary shrink-0"></span>
                                        </button>
                                    </template>
                                </div>
                            </div>
                        </div>

                        {{-- 8. Bahasa Antarmuka (Interface Language) --}}
                        <div class="space-y-3 pt-6 border-t border-border/50">
                            <div class="flex items-center justify-between">
                                <label class="text-xs font-bold uppercase tracking-wider text-foreground block">
                                    {{ __('docs/page/settings/index.profile.language') }}
                                </label>
                                <span class="text-xs text-muted-foreground font-medium">{{ app()->getLocale() === 'id' ? 'Bahasa Indonesia (Aktif)' : 'English (Active)' }}</span>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 max-w-md">
                                <a href="{{ route('locale.switch', 'id') }}" class="p-3 rounded-xl border transition-all flex items-center gap-3 {{ app()->getLocale() === 'id' ? 'bg-card border-primary ring-2 ring-primary/20 shadow-xs' : 'bg-muted/20 border-border hover:bg-muted/40 text-muted-foreground hover:text-foreground' }}">
                                    <span class="text-xl">🇮🇩</span>
                                    <div>
                                        <p class="text-xs font-semibold text-foreground">Bahasa Indonesia</p>
                                        <p class="text-[10px] text-muted-foreground">ID - Standar Nasional</p>
                                    </div>
                                    @if (app()->getLocale() === 'id')
                                        <span class="ml-auto size-1.5 rounded-full bg-primary"></span>
                                    @endif
                                </a>
                                <a href="{{ route('locale.switch', 'en') }}" class="p-3 rounded-xl border transition-all flex items-center gap-3 {{ app()->getLocale() === 'en' ? 'bg-card border-primary ring-2 ring-primary/20 shadow-xs' : 'bg-muted/20 border-border hover:bg-muted/40 text-muted-foreground hover:text-foreground' }}">
                                    <span class="text-xl">🇺🇸</span>
                                    <div>
                                        <p class="text-xs font-semibold text-foreground">English</p>
                                        <p class="text-[10px] text-muted-foreground">US - International</p>
                                    </div>
                                    @if (app()->getLocale() === 'en')
                                        <span class="ml-auto size-1.5 rounded-full bg-primary"></span>
                                    @endif
                                </a>
                            </div>
                        </div>
                    </div>


                    {{-- Alpine.js Appearance Manager Script --}}
                </vibe:tabs.panel>

                {{-- ================================================================= --}}
                {{-- PANEL 4: NOTIFICATIONS                                            --}}
                {{-- ================================================================= --}}
                <vibe:tabs.panel name="notifications" class="flex-1 min-w-0 p-6 space-y-6">

                    {{-- Header --}}
                    <div class="border-b border-border/50 pb-4">
                        <h2 class="text-lg font-bold text-foreground">Preferensi Notifikasi</h2>
                        <p class="text-xs text-muted-foreground mt-0.5">
                            Atur notifikasi apa yang ingin Anda terima dan melalui kanal apa.
                        </p>
                    </div>

                    {{-- Email Notifications --}}
                    <div class="space-y-2">
                        <h3 class="text-sm font-semibold text-foreground">Notifikasi Email</h3>
                        <div class="max-w-xl space-y-0 divide-y divide-border/40 border border-border/60 rounded-2xl overflow-hidden">
                            <div class="p-4">
                                <vibe:switch name="alert_security" label="Peringatan Keamanan" description="Notifikasi login dari perangkat baru, perubahan kata sandi, dan aktivitas mencurigakan." checked />
                            </div>
                            <div class="p-4">
                                <vibe:switch name="alert_orders" label="Pembaruan Pesanan" description="Status pemrosesan, pengiriman, dan konfirmasi pesanan." checked />
                            </div>
                            <div class="p-4">
                                <vibe:switch name="alert_product" label="Pembaruan Produk" description="Fitur baru, rilis komponen, dan changelog Vibe UI." />
                            </div>
                            <div class="p-4">
                                <vibe:switch name="alert_newsletter" label="Newsletter Bulanan" description="Ringkasan bulanan tips, tutorial, dan update dari tim Teknovate." />
                            </div>
                        </div>
                    </div>

                    {{-- Push / In-App Notifications --}}
                    <div class="space-y-2 pt-2">
                        <h3 class="text-sm font-semibold text-foreground">Notifikasi In-App</h3>
                        <div class="max-w-xl space-y-0 divide-y divide-border/40 border border-border/60 rounded-2xl overflow-hidden">
                            <div class="p-4">
                                <vibe:switch name="alert_sound" label="Efek Suara Notifikasi" description="Mainkan suara saat notifikasi baru masuk di dalam aplikasi." checked />
                            </div>
                            <div class="p-4">
                                <vibe:switch name="alert_desktop" label="Notifikasi Desktop" description="Tampilkan notifikasi sistem operasi meski browser diminimalkan." />
                            </div>
                        </div>
                    </div>

                    {{-- Save Action --}}
                    <div class="pt-4 border-t border-border/50 flex items-center justify-end">
                        <vibe:button type="button" variant="primary" size="sm" class="cursor-pointer" @click="window.vibeToast ? vibeToast('Preferensi notifikasi disimpan.', { type: 'success', title: 'Tersimpan' }) : null">
                            Simpan Preferensi
                        </vibe:button>
                    </div>
                </vibe:tabs.panel>

                {{-- ================================================================= --}}
                {{-- PANEL 5: LOGIN HISTORY (auth only)                               --}}
                {{-- ================================================================= --}}
                <vibe:tabs.panel name="login-history" class="flex-1 min-w-0 p-6 space-y-6">

                        {{-- Header --}}
                        <div class="border-b border-border/50 pb-4">
                            <h2 class="text-lg font-bold text-foreground">Riwayat Login & Sesi Aktif</h2>
                            <p class="text-xs text-muted-foreground mt-0.5">
                                Pantau semua aktivitas login dan akhiri sesi yang tidak dikenal.
                            </p>
                        </div>

                        @auth
                            {{-- Current Session Banner --}}
                            <div class="flex items-center gap-3 p-3.5 rounded-xl bg-emerald-500/10 border border-emerald-500/20">
                                <span class="size-2.5 rounded-full bg-emerald-500 animate-pulse shrink-0"></span>
                                <div class="flex-1 min-w-0 text-xs">
                                    <span class="font-semibold text-emerald-700 dark:text-emerald-300">Sesi Aktif Saat Ini</span>
                                    <span class="text-muted-foreground"> — {{ request()->userAgent() ? Str::limit(request()->userAgent(), 60) : 'Browser Anda' }}</span>
                                </div>
                                <span class="text-xs text-muted-foreground shrink-0">IP: {{ request()->ip() }}</span>
                            </div>

                            {{-- Login History Table --}}
                            <div class="space-y-2">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-sm font-semibold text-foreground">Semua Sesi</h3>
                                    <vibe:button type="button" variant="ghost" size="sm" class="text-xs text-destructive hover:bg-destructive/10 cursor-pointer" @click="window.vibeToast ? vibeToast('Semua sesi lain telah diakhiri.', { type: 'success', title: 'Sesi Diakhiri' }) : null">
                                        Akhiri Semua Sesi Lain
                                    </vibe:button>
                                </div>

                                {{-- Mock login history data --}}
                                @php
                                    $loginHistory = [
                                        [
                                            'device' => 'Windows PC',
                                            'browser' => 'Chrome 127',
                                            'os' => 'Windows 11',
                                            'ip' => request()->ip(),
                                            'location' => 'Makassar, Indonesia',
                                            'time' => 'Baru saja',
                                            'current' => true,
                                            'icon' => 'monitor',
                                        ],
                                        [
                                            'device' => 'MacBook Pro',
                                            'browser' => 'Safari 17',
                                            'os' => 'macOS Sonoma',
                                            'ip' => '103.147.8.22',
                                            'location' => 'Jakarta, Indonesia',
                                            'time' => '2 jam lalu',
                                            'current' => false,
                                            'icon' => 'laptop',
                                        ],
                                        [
                                            'device' => 'iPhone 15',
                                            'browser' => 'Safari Mobile',
                                            'os' => 'iOS 17',
                                            'ip' => '36.78.120.45',
                                            'location' => 'Surabaya, Indonesia',
                                            'time' => 'Kemarin, 20:14',
                                            'current' => false,
                                            'icon' => 'smartphone',
                                        ],
                                        [
                                            'device' => 'Android',
                                            'browser' => 'Chrome Mobile 127',
                                            'os' => 'Android 14',
                                            'ip' => '180.252.10.88',
                                            'location' => 'Bandung, Indonesia',
                                            'time' => '3 hari lalu',
                                            'current' => false,
                                            'icon' => 'smartphone',
                                        ],
                                        [
                                            'device' => 'Linux Desktop',
                                            'browser' => 'Firefox 128',
                                            'os' => 'Ubuntu 24.04',
                                            'ip' => '202.43.72.15',
                                            'location' => 'Tidak Diketahui',
                                            'time' => '5 hari lalu',
                                            'current' => false,
                                            'icon' => 'monitor',
                                        ],
                                    ];
                                @endphp

                                <div class="border border-border/60 rounded-2xl overflow-hidden divide-y divide-border/40">
                                    @foreach ($loginHistory as $session)
                                        <div class="p-4 flex items-start gap-4 {{ $session['current'] ? 'bg-emerald-500/5' : 'bg-card hover:bg-muted/20' }} transition-colors">
                                            {{-- Device Icon --}}
                                            <div class="size-9 rounded-xl shrink-0 flex items-center justify-center {{ $session['current'] ? 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400' : 'bg-muted/60 text-muted-foreground' }}">
                                                @if ($session['icon'] === 'smartphone')
                                                    <svg class="size-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                        <rect width="14" height="20" x="5" y="2" rx="2" ry="2" />
                                                        <path d="M12 18h.01" />
                                                    </svg>
                                                @else
                                                    <svg class="size-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                        <rect width="20" height="14" x="2" y="3" rx="2" />
                                                        <line x1="8" x2="16" y1="21" y2="21" />
                                                        <line x1="12" x2="12" y1="17" y2="21" />
                                                    </svg>
                                                @endif
                                            </div>

                                            {{-- Session Info --}}
                                            <div class="flex-1 min-w-0 space-y-1">
                                                <div class="flex items-center gap-2 flex-wrap">
                                                    <span class="text-sm font-semibold text-foreground">{{ $session['device'] }}</span>
                                                    @if ($session['current'])
                                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-semibold bg-emerald-500/10 text-emerald-600 dark:text-emerald-400">
                                                            <span class="size-1.5 rounded-full bg-emerald-500"></span>
                                                            Sesi Ini
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="flex flex-wrap items-center gap-x-3 gap-y-0.5 text-xs text-muted-foreground">
                                                    <span>{{ $session['browser'] }} · {{ $session['os'] }}</span>
                                                    <span class="font-mono">{{ $session['ip'] }}</span>
                                                    <span>{{ $session['location'] }}</span>
                                                </div>
                                                <p class="text-xs text-muted-foreground/70">{{ $session['time'] }}</p>
                                            </div>

                                            {{-- Action --}}
                                            @if (!$session['current'])
                                                <button type="button" data-device="{{ $session['device'] }}" class="shrink-0 text-xs text-muted-foreground hover:text-destructive font-medium transition-colors cursor-pointer mt-0.5" @click="window.vibeToast ? vibeToast('Sesi ' + $el.dataset.device + ' telah diakhiri.', { type: 'success', title: 'Sesi Diakhiri' }) : null">
                                                    Akhiri
                                                </button>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>

                                <p class="text-xs text-muted-foreground italic">
                                    * Data riwayat login di atas adalah demo. Implementasi nyata memerlukan paket seperti <code class="font-mono bg-muted px-1 py-0.5 rounded">spatie/laravel-login-activity</code> atau model sesi kustom.
                                </p>
                            </div>
                        @else
                            {{-- Guest: redirect prompt --}}
                            <div class="flex flex-col items-center justify-center py-16 text-center space-y-4">
                                <div class="size-16 rounded-2xl bg-muted/60 flex items-center justify-center">
                                    <svg class="size-8 text-muted-foreground" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <rect width="18" height="11" x="3" y="11" rx="2" ry="2" />
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-sm font-semibold text-foreground">Login Diperlukan</h3>
                                    <p class="text-xs text-muted-foreground mt-1 max-w-xs mx-auto">
                                        Riwayat login dan sesi aktif hanya tersedia setelah Anda masuk ke akun.
                                    </p>
                                </div>
                                <vibe:button href="/login" variant="primary" size="sm">
                                    Masuk ke Akun
                                </vibe:button>
                            </div>
                        @endauth
                    </vibe:tabs.panel>

                    {{-- ================================================================= --}}
                    {{-- PANEL 6: PASSKEY (auth only)                                     --}}
                    {{-- ================================================================= --}}
                    <vibe:tabs.panel name="passkey" class="flex-1 min-w-0 p-6 space-y-6">
                        @push('head')
                            @vite('resources/js/vibe/passkeys.js')
                        @endpush

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
                            <div x-data="{
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
                                        this.feedbackMessage = 'Harap masukkan kata sandi akun Anda terlebih dahulu.';
                                        return;
                                    }

                                    this.loading = true;
                                    this.statusText = 'Memverifikasi kata sandi...';
                                    this.feedbackMessage = null;

                                    try {
                                        // 1. Verifikasi kata sandi terlebih dahulu
                                        const csrfToken = document.querySelector('meta[name=\"csrf-token\"]')?getAttribute('content') || '{{ csrf_token() }}';
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
                                            this.feedbackMessage = data?.errors?.password?.[0] || data?.message || 'Kata sandi salah. Silakan periksa kembali.';
                                            this.loading = false;
                                            return;
                                        }

                                        // 2. Jika kata sandi benar, lanjutkan pendaftaran WebAuthn Passkey
                                        this.statusText = 'Menyiapkan sensor biometrik perangkat...';
                                        if (!window.VibePasskeyService) {
                                            throw new Error('Modul Passkey belum dimuat.');
                                        }

                                        const regRes = await window.VibePasskeyService.register(this.registerName || 'Perangkat Saya');
                                        if (regRes.success) {
                                            this.feedbackType = 'success';
                                            this.feedbackMessage = 'Passkey berhasil didaftarkan! Halaman akan diperbarui...';
                                            this.accountPassword = '';
                                            setTimeout(() => window.location.reload(), 1500);
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

                                {{-- Add New Passkey (Wajib Kata Sandi Terlebih Dahulu) --}}
                                <div class="pt-3 border-t border-border/50 space-y-4">
                                    <div>
                                        <h3 class="text-sm font-semibold text-foreground">Daftarkan Passkey Baru</h3>
                                        <p class="text-xs text-muted-foreground mt-0.5">
                                            Untuk alasan keamanan, masukkan kata sandi akun Anda terlebih dahulu sebelum mendaftarkan Passkey baru.
                                        </p>
                                    </div>

                                    <form @submit.prevent="submitRegisterPasskey()" class="p-4 rounded-2xl bg-muted/30 border border-border/60 space-y-3.5">
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                            <div class="space-y-1.5">
                                                <label class="text-xs font-semibold text-foreground">Nama Perangkat</label>
                                                <input
                                                    type="text"
                                                    x-model="registerName"
                                                    placeholder="Contoh: MacBook Pro Touch ID"
                                                    class="w-full px-3 py-2 text-sm rounded-xl border border-input bg-background text-foreground shadow-2xs focus:ring-2 focus:ring-primary focus:outline-none"
                                                    required
                                                />
                                            </div>
                                            <div class="space-y-1.5">
                                                <label class="text-xs font-semibold text-foreground flex items-center justify-between">
                                                    <span>Kata Sandi Akun</span>
                                                    <span class="text-[10px] text-muted-foreground font-normal">Verifikasi Keamanan</span>
                                                </label>
                                                <div class="relative">
                                                    <input
                                                        :type="showPassword ? 'text' : 'password'"
                                                        x-model="accountPassword"
                                                        placeholder="Masukkan kata sandi akun..."
                                                        autocomplete="current-password"
                                                        class="w-full px-3 py-2 pr-10 text-sm rounded-xl border border-input bg-background text-foreground shadow-2xs focus:ring-2 focus:ring-primary focus:outline-none"
                                                        required
                                                    />
                                                    <button
                                                        type="button"
                                                        @click="showPassword = !showPassword"
                                                        class="absolute right-2.5 top-1/2 -translate-y-1/2 text-muted-foreground hover:text-foreground cursor-pointer"
                                                        tabindex="-1"
                                                    >
                                                        <svg x-show="!showPassword" class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                                                        <svg x-show="showPassword" x-cloak class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/><path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/><path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"/><line x1="2" x2="22" y1="2" y2="22"/></svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 pt-1">
                                            <div class="text-[11px] text-muted-foreground flex items-center gap-1.5">
                                                <svg class="size-3.5 text-primary shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                                                <span>Kata sandi diverifikasi terlebih dahulu sebelum memicu sensor biometrik.</span>
                                            </div>

                                            <vibe:button type="submit" variant="primary" size="sm" ::disabled="loading || !accountPassword" class="cursor-pointer shrink-0">
                                                <template x-if="!loading">
                                                    <span class="inline-flex items-center gap-1.5">
                                                        <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                                        </svg>
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
                    </vibe:tabs.panel>

            </vibe:tabs>
        </vibe:card>
    </div>

    @push('body')
        <script>
            function appearanceController() {
                const prefix = window.VIBE_PREFIX || '{{ config('vibe.prefix', 'vibe') }}';
                const themeKey = prefix + '-theme';
                const styleId = prefix + '-theme-override';

                return {
                    mode: window.VibeTheme?.getConfig()?.mode || (document.documentElement.classList.contains('dark') ? 'dark' : 'light'),
                    selectedPreset: 'zinc',
                    customHex: '#6366f1',
                    selectedRadius: '0.5rem',
                    generatedCss: '',
                    showCssDrawer: false,
                    copied: false,

                    selectedSidebarPreset: 'default',
                    customSidebarBg: '#ffffff',
                    customSidebarFg: '#0a0b0a',
                    customSidebarBorder: '#e5e6e5',

                    selectedHeaderPreset: 'default',
                    customHeaderBg: '#ffffff',
                    customHeaderFg: '#0a0b0a',
                    customHeaderBorder: '#e5e6e5',

                    presets: {
                        zinc: {
                            name: 'Zinc',
                            color: '#0a0b0a',
                            light: '#0a0b0a',
                            lightFg: '#f9fafa',
                            dark: '#f9fafa',
                            darkFg: '#0a0b0a'
                        },
                        indigo: {
                            name: 'Indigo',
                            color: '#6366f1',
                            light: '#4f46e5',
                            lightFg: '#ffffff',
                            dark: '#818cf8',
                            darkFg: '#0a0b0a'
                        },
                        violet: {
                            name: 'Violet',
                            color: '#8b5cf6',
                            light: '#7c3aed',
                            lightFg: '#ffffff',
                            dark: '#a78bfa',
                            darkFg: '#0a0b0a'
                        },
                        blue: {
                            name: 'Blue',
                            color: '#2563eb',
                            light: '#2563eb',
                            lightFg: '#ffffff',
                            dark: '#38bdf8',
                            darkFg: '#0a0b0a'
                        },
                        emerald: {
                            name: 'Emerald',
                            color: '#10b981',
                            light: '#059669',
                            lightFg: '#ffffff',
                            dark: '#34d399',
                            darkFg: '#0a0b0a'
                        },
                        rose: {
                            name: 'Rose',
                            color: '#f43f5e',
                            light: '#e11d48',
                            lightFg: '#ffffff',
                            dark: '#fb7185',
                            darkFg: '#0a0b0a'
                        },
                        amber: {
                            name: 'Amber',
                            color: '#f59e0b',
                            light: '#d97706',
                            lightFg: '#ffffff',
                            dark: '#fbbf24',
                            darkFg: '#0a0b0a'
                        },
                        cyan: {
                            name: 'Cyan',
                            color: '#06b6d4',
                            light: '#0891b2',
                            lightFg: '#ffffff',
                            dark: '#22d3ee',
                            darkFg: '#0a0b0a'
                        }
                    },

                    sidebarPresets: {
                        default: {
                            name: 'Default',
                            light: {
                                bg: '#ffffff',
                                fg: '#0a0b0a',
                                border: '#e5e6e5',
                                accent: '#f4f5f5',
                                accentFg: '#0a0b0a'
                            },
                            dark: {
                                bg: '#121312',
                                fg: '#f9fafa',
                                border: '#262726',
                                accent: '#1e1f1e',
                                accentFg: '#f9fafa'
                            }
                        },
                        dark: {
                            name: 'Dark Contrast',
                            light: {
                                bg: '#121312',
                                fg: '#f9fafa',
                                border: '#262726',
                                accent: '#1e1f1e',
                                accentFg: '#f9fafa'
                            },
                            dark: {
                                bg: '#0d0e0d',
                                fg: '#f9fafa',
                                border: '#222322',
                                accent: '#191a19',
                                accentFg: '#f9fafa'
                            }
                        },
                        zinc: {
                            name: 'Zinc Slate',
                            light: {
                                bg: '#18181b',
                                fg: '#f4f4f5',
                                border: '#27272a',
                                accent: '#27272a',
                                accentFg: '#f4f4f5'
                            },
                            dark: {
                                bg: '#09090b',
                                fg: '#f4f4f5',
                                border: '#27272a',
                                accent: '#18181b',
                                accentFg: '#f4f4f5'
                            }
                        },
                        subtle: {
                            name: 'Subtle Muted',
                            light: {
                                bg: '#f4f5f5',
                                fg: '#0a0b0a',
                                border: '#e5e6e5',
                                accent: '#e5e6e5',
                                accentFg: '#0a0b0a'
                            },
                            dark: {
                                bg: '#1a1b1a',
                                fg: '#f9fafa',
                                border: '#2b2c2b',
                                accent: '#262726',
                                accentFg: '#f9fafa'
                            }
                        },
                        navy: {
                            name: 'Deep Navy',
                            light: {
                                bg: '#0a0f24',
                                fg: '#f1f5f9',
                                border: '#1e293b',
                                accent: '#1e293b',
                                accentFg: '#f1f5f9'
                            },
                            dark: {
                                bg: '#060919',
                                fg: '#f1f5f9',
                                border: '#172033',
                                accent: '#111827',
                                accentFg: '#f1f5f9'
                            }
                        }
                    },

                    headerPresets: {
                        default: {
                            name: 'Default',
                            light: {
                                bg: '#ffffff',
                                fg: '#0a0b0a',
                                border: '#e5e6e5',
                                accent: '#f4f5f5',
                                accentFg: '#0a0b0a'
                            },
                            dark: {
                                bg: '#121312',
                                fg: '#f9fafa',
                                border: '#262726',
                                accent: '#1e1f1e',
                                accentFg: '#f9fafa'
                            }
                        },
                        glass: {
                            name: 'Translucent Glass',
                            light: {
                                bg: 'rgba(255, 255, 255, 0.85)',
                                fg: '#0a0b0a',
                                border: 'rgba(229, 230, 229, 0.8)',
                                accent: '#f4f5f5',
                                accentFg: '#0a0b0a'
                            },
                            dark: {
                                bg: 'rgba(18, 19, 18, 0.85)',
                                fg: '#f9fafa',
                                border: 'rgba(38, 39, 38, 0.8)',
                                accent: '#1e1f1e',
                                accentFg: '#f9fafa'
                            }
                        },
                        subtle: {
                            name: 'Subtle Muted',
                            light: {
                                bg: '#f4f5f5',
                                fg: '#0a0b0a',
                                border: '#e5e6e5',
                                accent: '#e5e6e5',
                                accentFg: '#0a0b0a'
                            },
                            dark: {
                                bg: '#1a1b1a',
                                fg: '#f9fafa',
                                border: '#2b2c2b',
                                accent: '#262726',
                                accentFg: '#f9fafa'
                            }
                        },
                        dark: {
                            name: 'Dark Contrast',
                            light: {
                                bg: '#121312',
                                fg: '#f9fafa',
                                border: '#262726',
                                accent: '#1e1f1e',
                                accentFg: '#f9fafa'
                            },
                            dark: {
                                bg: '#0d0e0d',
                                fg: '#f9fafa',
                                border: '#222322',
                                accent: '#191a19',
                                accentFg: '#f9fafa'
                            }
                        },
                        navy: {
                            name: 'Deep Navy',
                            light: {
                                bg: '#0a0f24',
                                fg: '#f1f5f9',
                                border: '#1e293b',
                                accent: '#1e293b',
                                accentFg: '#f1f5f9'
                            },
                            dark: {
                                bg: '#060919',
                                fg: '#f1f5f9',
                                border: '#172033',
                                accent: '#111827',
                                accentFg: '#f1f5f9'
                            }
                        }
                    },

                    radii: [{
                            label: '0 (Tajam)',
                            value: '0rem'
                        },
                        {
                            label: '0.25rem',
                            value: '0.25rem'
                        },
                        {
                            label: '0.5rem',
                            value: '0.5rem'
                        },
                        {
                            label: '0.75rem',
                            value: '0.75rem'
                        },
                        {
                            label: '1rem',
                            value: '1rem'
                        }
                    ],

                    fonts: [{
                            name: 'Figtree',
                            desc: 'Default Vibe UI',
                            value: "'Figtree', ui-sans-serif, system-ui, sans-serif"
                        },
                        {
                            name: 'Inter',
                            desc: 'Clean & Precision',
                            value: "'Inter', ui-sans-serif, system-ui, sans-serif"
                        },
                        {
                            name: 'Plus Jakarta',
                            desc: 'Modern Geometric',
                            value: "'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif"
                        },
                        {
                            name: 'Outfit',
                            desc: 'Friendly Display',
                            value: "'Outfit', ui-sans-serif, system-ui, sans-serif"
                        }
                    ],
                    selectedFontName: 'Figtree',
                    selectedFontValue: "'Figtree', ui-sans-serif, system-ui, sans-serif",

                    init() {
                        try {
                            const stored = localStorage.getItem(themeKey);
                            if (stored) {
                                const parsed = JSON.parse(stored);
                                if (parsed.mode) this.mode = parsed.mode;
                                if (parsed.preset) this.selectedPreset = parsed.preset;
                                if (parsed.customHex) this.customHex = parsed.customHex;
                                if (parsed.radius) this.selectedRadius = parsed.radius;
                                if (parsed.fontName) this.selectedFontName = parsed.fontName;
                                if (parsed.fontValue) this.selectedFontValue = parsed.fontValue;

                                if (parsed.sidebarPreset) this.selectedSidebarPreset = parsed.sidebarPreset;
                                if (parsed.customSidebarBg) this.customSidebarBg = parsed.customSidebarBg;
                                if (parsed.customSidebarFg) this.customSidebarFg = parsed.customSidebarFg;
                                if (parsed.customSidebarBorder) this.customSidebarBorder = parsed.customSidebarBorder;

                                if (parsed.headerPreset) this.selectedHeaderPreset = parsed.headerPreset;
                                if (parsed.customHeaderBg) this.customHeaderBg = parsed.customHeaderBg;
                                if (parsed.customHeaderFg) this.customHeaderFg = parsed.customHeaderFg;
                                if (parsed.customHeaderBorder) this.customHeaderBorder = parsed.customHeaderBorder;
                            }
                        } catch (e) {}

                        this.updateGeneratedCss();
                        this.injectOverrideCss();
                    },

                    setMode(newMode, event = null) {
                        this.mode = newMode;
                        if (window.VibeTheme) {
                            window.VibeTheme.setMode(newMode, event);
                        } else {
                            if (newMode === 'dark') document.documentElement.classList.add('dark');
                            else if (newMode === 'light') document.documentElement.classList.remove('dark');
                        }
                        this.updateGeneratedCss();
                        this.injectOverrideCss();
                    },

                    selectPreset(key) {
                        this.selectedPreset = key;
                        this.updateGeneratedCss();
                        this.injectOverrideCss();
                    },

                    applyCustomHex(hex) {
                        this.selectedPreset = 'custom';
                        this.customHex = hex;
                        this.updateGeneratedCss();
                        this.injectOverrideCss();
                    },

                    selectRadius(value) {
                        this.selectedRadius = value;
                        this.updateGeneratedCss();
                        this.injectOverrideCss();
                    },

                    selectFont(value, name) {
                        this.selectedFontValue = value;
                        this.selectedFontName = name;
                        this.updateGeneratedCss();
                        this.injectOverrideCss();
                    },

                    isLightColor(hex) {
                        if (!hex) return true;
                        let c = hex.replace('#', '');
                        if (c.length === 3) c = c[0] + c[0] + c[1] + c[1] + c[2] + c[2];
                        if (c.length < 6) return true;
                        const r = parseInt(c.substring(0, 2), 16) || 0;
                        const g = parseInt(c.substring(2, 4), 16) || 0;
                        const b = parseInt(c.substring(4, 6), 16) || 0;
                        return ((r * 299) + (g * 587) + (b * 114)) / 1000 > 128;
                    },

                    getActiveColorName() {
                        if (this.selectedPreset === 'custom') return this.customHex;
                        return this.presets[this.selectedPreset]?.name || 'Zinc';
                    },

                    getActiveColors() {
                        if (this.selectedPreset === 'custom') {
                            return {
                                light: this.customHex,
                                lightFg: '#ffffff',
                                dark: this.customHex,
                                darkFg: '#ffffff'
                            };
                        }
                        return this.presets[this.selectedPreset] || this.presets.zinc;
                    },

                    getActivePrimaryColor() {
                        if (this.selectedPreset === 'custom') return this.customHex;
                        return this.presets[this.selectedPreset]?.color || '#0a0b0a';
                    },

                    getActivePrimaryFg() {
                        if (this.selectedPreset === 'custom') {
                            return this.isLightColor(this.customHex) ? '#0a0b0a' : '#ffffff';
                        }
                        const p = this.presets[this.selectedPreset] || this.presets.zinc;
                        return (this.mode === 'dark') ? p.darkFg : p.lightFg;
                    },

                    getActiveSidebarName() {
                        if (this.selectedSidebarPreset === 'custom') return this.customSidebarBg;
                        return this.sidebarPresets[this.selectedSidebarPreset]?.name || 'Default';
                    },

                    getActiveHeaderName() {
                        if (this.selectedHeaderPreset === 'custom') return this.customHeaderBg;
                        return this.headerPresets[this.selectedHeaderPreset]?.name || 'Default';
                    },

                    getSidebarColors() {
                        if (this.selectedSidebarPreset === 'custom') {
                            const isLight = this.isLightColor(this.customSidebarBg);
                            const autoFg = isLight ? '#0a0b0a' : '#f9fafa';
                            const autoBorder = isLight ? '#e5e6e5' : '#262726';
                            const autoAccent = isLight ? '#f4f5f5' : '#1e1f1e';
                            const fg = this.customSidebarFg || autoFg;
                            const border = this.customSidebarBorder || autoBorder;
                            return {
                                light: {
                                    bg: this.customSidebarBg,
                                    fg: fg,
                                    border: border,
                                    accent: autoAccent,
                                    accentFg: fg
                                },
                                dark: {
                                    bg: this.customSidebarBg,
                                    fg: fg,
                                    border: border,
                                    accent: autoAccent,
                                    accentFg: fg
                                }
                            };
                        }
                        return this.sidebarPresets[this.selectedSidebarPreset] || this.sidebarPresets.default;
                    },

                    getActiveSidebarBg() {
                        const s = this.getSidebarColors();
                        return (this.mode === 'dark') ? s.dark.bg : s.light.bg;
                    },

                    getActiveSidebarFg() {
                        const s = this.getSidebarColors();
                        return (this.mode === 'dark') ? s.dark.fg : s.light.fg;
                    },

                    getActiveSidebarBorder() {
                        const s = this.getSidebarColors();
                        return (this.mode === 'dark') ? s.dark.border : s.light.border;
                    },

                    getHeaderColors() {
                        if (this.selectedHeaderPreset === 'custom') {
                            const isLight = this.isLightColor(this.customHeaderBg);
                            const autoFg = isLight ? '#0a0b0a' : '#f9fafa';
                            const autoBorder = isLight ? '#e5e6e5' : '#262726';
                            const autoAccent = isLight ? '#f4f5f5' : '#1e1f1e';
                            const fg = this.customHeaderFg || autoFg;
                            const border = this.customHeaderBorder || autoBorder;
                            return {
                                light: {
                                    bg: this.customHeaderBg,
                                    fg: fg,
                                    border: border,
                                    accent: autoAccent,
                                    accentFg: fg
                                },
                                dark: {
                                    bg: this.customHeaderBg,
                                    fg: fg,
                                    border: border,
                                    accent: autoAccent,
                                    accentFg: fg
                                }
                            };
                        }
                        return this.headerPresets[this.selectedHeaderPreset] || this.headerPresets.default;
                    },

                    getActiveHeaderBg() {
                        const h = this.getHeaderColors();
                        return (this.mode === 'dark') ? h.dark.bg : h.light.bg;
                    },

                    getActiveHeaderFg() {
                        const h = this.getHeaderColors();
                        return (this.mode === 'dark') ? h.dark.fg : h.light.fg;
                    },

                    getActiveHeaderBorder() {
                        const h = this.getHeaderColors();
                        return (this.mode === 'dark') ? h.dark.border : h.light.border;
                    },

                    selectSidebarPreset(key) {
                        this.selectedSidebarPreset = key;
                        if (key !== 'custom') {
                            const preset = this.sidebarPresets[key];
                            const active = this.mode === 'dark' ? preset.dark : preset.light;
                            this.customSidebarBg = active.bg;
                            this.customSidebarFg = active.fg;
                            this.customSidebarBorder = active.border;
                        }
                        this.updateGeneratedCss();
                        this.injectOverrideCss();
                    },

                    applyCustomSidebarBg(val) {
                        this.selectedSidebarPreset = 'custom';
                        this.customSidebarBg = val;
                        const isLight = this.isLightColor(val);
                        this.customSidebarFg = isLight ? '#0a0b0a' : '#f9fafa';
                        this.customSidebarBorder = isLight ? '#e5e6e5' : '#262726';
                        this.updateGeneratedCss();
                        this.injectOverrideCss();
                    },

                    applyCustomSidebarFg(val) {
                        this.selectedSidebarPreset = 'custom';
                        this.customSidebarFg = val;
                        this.updateGeneratedCss();
                        this.injectOverrideCss();
                    },

                    applyCustomSidebarBorder(val) {
                        this.selectedSidebarPreset = 'custom';
                        this.customSidebarBorder = val;
                        this.updateGeneratedCss();
                        this.injectOverrideCss();
                    },

                    autoAdjustSidebarColors() {
                        const isLight = this.isLightColor(this.customSidebarBg);
                        this.customSidebarFg = isLight ? '#0a0b0a' : '#f9fafa';
                        this.customSidebarBorder = isLight ? '#e5e6e5' : '#262726';
                        this.updateGeneratedCss();
                        this.injectOverrideCss();
                        if (window.vibeToast) {
                            vibeToast('Kontras warna sidebar berhasil disesuaikan secara otomatis.', {
                                type: 'info',
                                title: 'Auto Kontras'
                            });
                        }
                    },

                    selectHeaderPreset(key) {
                        this.selectedHeaderPreset = key;
                        if (key !== 'custom') {
                            const preset = this.headerPresets[key];
                            const active = this.mode === 'dark' ? preset.dark : preset.light;
                            this.customHeaderBg = active.bg;
                            this.customHeaderFg = active.fg;
                            this.customHeaderBorder = active.border;
                        }
                        this.updateGeneratedCss();
                        this.injectOverrideCss();
                    },

                    applyCustomHeaderBg(val) {
                        this.selectedHeaderPreset = 'custom';
                        this.customHeaderBg = val;
                        const isLight = this.isLightColor(val);
                        this.customHeaderFg = isLight ? '#0a0b0a' : '#f9fafa';
                        this.customHeaderBorder = isLight ? '#e5e6e5' : '#262726';
                        this.updateGeneratedCss();
                        this.injectOverrideCss();
                    },

                    applyCustomHeaderFg(val) {
                        this.selectedHeaderPreset = 'custom';
                        this.customHeaderFg = val;
                        this.updateGeneratedCss();
                        this.injectOverrideCss();
                    },

                    applyCustomHeaderBorder(val) {
                        this.selectedHeaderPreset = 'custom';
                        this.customHeaderBorder = val;
                        this.updateGeneratedCss();
                        this.injectOverrideCss();
                    },

                    autoAdjustHeaderColors() {
                        const isLight = this.isLightColor(this.customHeaderBg);
                        this.customHeaderFg = isLight ? '#0a0b0a' : '#f9fafa';
                        this.customHeaderBorder = isLight ? '#e5e6e5' : '#262726';
                        this.updateGeneratedCss();
                        this.injectOverrideCss();
                        if (window.vibeToast) {
                            vibeToast('Kontras warna header berhasil disesuaikan secara otomatis.', {
                                type: 'info',
                                title: 'Auto Kontras'
                            });
                        }
                    },

                    updateGeneratedCss() {
                        const colors = this.getActiveColors();
                        const radius = this.selectedRadius;
                        const font = this.selectedFontValue;
                        const sidebar = this.getSidebarColors();
                        const header = this.getHeaderColors();

                        const radiusRules = radius === '0rem' ? `
    --radius: 0rem !important;
    --radius-xs: 0rem !important;
    --radius-sm: 0rem !important;
    --radius-md: 0rem !important;
    --radius-lg: 0rem !important;
    --radius-xl: 0rem !important;
    --radius-2xl: 0rem !important;
    --radius-3xl: 0rem !important;
` : `
    --radius: ${radius} !important;
    --radius-xs: calc(${radius} * 0.3) !important;
    --radius-sm: calc(${radius} * 0.5) !important;
    --radius-md: calc(${radius} * 0.75) !important;
    --radius-lg: ${radius} !important;
    --radius-xl: calc(${radius} * 1.25) !important;
    --radius-2xl: calc(${radius} * 1.5) !important;
    --radius-3xl: calc(${radius} * 2) !important;
`;

                        this.generatedCss = `
:root:root,
html:root:root,
html.light:root,
html[data-canvas-theme="light"]:root,
html:not(#__vibe_shield__):root {
    --primary: ${colors.light} !important;
    --primary-foreground: ${colors.lightFg} !important;
    --ring: ${colors.light} !important;
    --font-sans: ${font} !important;
    font-family: ${font} !important;
    --sidebar: ${sidebar.light.bg} !important;
    --sidebar-foreground: ${sidebar.light.fg} !important;
    --sidebar-border: ${sidebar.light.border} !important;
    --sidebar-accent: ${sidebar.light.accent} !important;
    --sidebar-accent-foreground: ${sidebar.light.accentFg} !important;
    --header: ${header.light.bg} !important;
    --header-foreground: ${header.light.fg} !important;
    --header-border: ${header.light.border} !important;
    --header-accent: ${header.light.accent} !important;
    --header-accent-foreground: ${header.light.accentFg} !important;
${radiusRules}
}

html.dark:root:root,
html.dark[data-canvas-theme="dark"]:root,
html.dark:not(#__vibe_shield__):root {
    --primary: ${colors.dark} !important;
    --primary-foreground: ${colors.darkFg} !important;
    --ring: ${colors.dark} !important;
    --font-sans: ${font} !important;
    font-family: ${font} !important;
    --sidebar: ${sidebar.dark.bg} !important;
    --sidebar-foreground: ${sidebar.dark.fg} !important;
    --sidebar-border: ${sidebar.dark.border} !important;
    --sidebar-accent: ${sidebar.dark.accent} !important;
    --sidebar-accent-foreground: ${sidebar.dark.accentFg} !important;
    --header: ${header.dark.bg} !important;
    --header-foreground: ${header.dark.fg} !important;
    --header-border: ${header.dark.border} !important;
    --header-accent: ${header.dark.accent} !important;
    --header-accent-foreground: ${header.dark.accentFg} !important;
${radiusRules}
}

body {
    font-family: ${font} !important;
}`;
                    },

                    injectOverrideCss() {
                        if (window.VibeTheme?.applyComponentThemes) {
                            window.VibeTheme.applyComponentThemes({
                                css: this.generatedCss
                            });
                        } else {
                            let styleEl = document.getElementById(styleId);
                            if (!styleEl) {
                                styleEl = document.createElement('style');
                                styleEl.id = styleId;
                                styleEl.setAttribute('data-navigate-once', 'true');
                                document.head.appendChild(styleEl);
                            }
                            styleEl.textContent = this.generatedCss;
                        }
                    },

                    copyCss() {
                        if (navigator.clipboard && navigator.clipboard.writeText) {
                            navigator.clipboard.writeText(this.generatedCss).then(() => {
                                this.copied = true;
                                if (window.vibeToast) {
                                    vibeToast('{{ __('docs/page/settings/index.appearance.copied') }}', {
                                        type: 'success',
                                        title: 'CSS Disalin'
                                    });
                                }
                                setTimeout(() => {
                                    this.copied = false;
                                }, 2500);
                            });
                        }
                    },

                    savePreferences() {
                        const extraData = {
                            mode: this.mode,
                            preset: this.selectedPreset,
                            customHex: this.customHex,
                            radius: this.selectedRadius,
                            fontName: this.selectedFontName,
                            fontValue: this.selectedFontValue,
                            sidebarPreset: this.selectedSidebarPreset,
                            customSidebarBg: this.customSidebarBg,
                            customSidebarFg: this.customSidebarFg,
                            customSidebarBorder: this.customSidebarBorder,
                            headerPreset: this.selectedHeaderPreset,
                            customHeaderBg: this.customHeaderBg,
                            customHeaderFg: this.customHeaderFg,
                            customHeaderBorder: this.customHeaderBorder,
                        };

                        if (window.VibeTheme?.setCssOverride) {
                            window.VibeTheme.setCssOverride(this.generatedCss, extraData);
                        } else {
                            let currentConfig = {};
                            try {
                                const stored = localStorage.getItem(themeKey);
                                if (stored) currentConfig = JSON.parse(stored);
                            } catch (e) {}

                            Object.assign(currentConfig, extraData);
                            currentConfig.css = this.generatedCss;
                            localStorage.setItem(themeKey, JSON.stringify(currentConfig));
                        }

                        try {
                            localStorage.removeItem(prefix + '-app-css-overrides');
                        } catch (e) {}

                        if (window.vibeToast) {
                            vibeToast('{{ __('docs/page/settings/index.appearance.toast_saved') }}', {
                                type: 'success',
                                title: 'Tema Disimpan'
                            });
                        }
                    },

                    resetToDefault() {
                        this.selectedPreset = 'zinc';
                        this.customHex = '#6366f1';
                        this.selectedRadius = '0.5rem';
                        this.selectedFontName = 'Figtree';
                        this.selectedFontValue = "'Figtree', ui-sans-serif, system-ui, sans-serif";

                        this.selectedSidebarPreset = 'default';
                        this.customSidebarBg = '#ffffff';
                        this.customSidebarFg = '#0a0b0a';
                        this.customSidebarBorder = '#e5e6e5';

                        this.selectedHeaderPreset = 'default';
                        this.customHeaderBg = '#ffffff';
                        this.customHeaderFg = '#0a0b0a';
                        this.customHeaderBorder = '#e5e6e5';

                        if (window.VibeTheme?.clearCssOverride) {
                            window.VibeTheme.clearCssOverride();
                        } else {
                            const styleEl = document.getElementById(styleId);
                            if (styleEl) styleEl.textContent = '';
                        }

                        try {
                            localStorage.removeItem(prefix + '-app-css-overrides');
                        } catch (e) {}

                        this.updateGeneratedCss();

                        if (window.vibeToast) {
                            vibeToast('{{ __('docs/page/settings/index.appearance.toast_reset') }}', {
                                type: 'info',
                                title: 'Reset Selesai'
                            });
                        }
                    }
                };
            }
        </script>
    @endpush
</x-[path].layouts.[style]>
