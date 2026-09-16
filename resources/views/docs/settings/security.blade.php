<x-docs.layouts.sidebar>
    <vibe:seo :title="__('docs/page/settings/index.title')" :description="__('docs/page/settings/index.subtitle')" :breadcrumbs="[
        ['name' => __('docs/page/settings/index.breadcrumb.home'), 'url' => '/'],
        ['name' => __('docs/page/settings/index.breadcrumb.pages'), 'url' => '#'],
        ['name' => __('docs/page/settings/index.breadcrumb.settings'), 'url' => route('docs.settings.account')],
        ['name' => 'Keamanan', 'url' => route('docs.settings.security')],
    ]" />

    <div class="space-y-6 mx-auto w-full">
        <vibe:breadcrumb title="{!! __('docs/page/settings/index.title') !!}">
            <vibe:breadcrumb.item href="{{ route('docs.index') }}">{{ __('docs/page/settings/index.breadcrumb.home') }}</vibe:breadcrumb.item>
            <vibe:breadcrumb.item>{{ __('docs/page/settings/index.breadcrumb.pages') }}</vibe:breadcrumb.item>
            <vibe:breadcrumb.item href="{{ route('docs.settings.account') }}">{{ __('docs/page/settings/index.breadcrumb.settings') }}</vibe:breadcrumb.item>
            <vibe:breadcrumb.item active>Keamanan</vibe:breadcrumb.item>
        </vibe:breadcrumb>

        <vibe:card class="p-0 overflow-hidden">
            <vibe:tabs selected="security" variant="sidebar" class="min-h-155">
                @include('docs.settings.tabs', ['active' => 'security'])

                <div class="flex flex-col gap-6 p-6 w-full">
                    {{-- Header --}}
                    <div class="pb-4 border-border/50 border-b">
                        <div class="flex justify-between items-center">
                            <div>
                                <h2 class="font-bold text-foreground text-lg">Keamanan Akun</h2>
                                <p class="mt-0.5 text-muted-foreground text-xs">
                                    Kelola kata sandi dan lapisan keamanan tambahan untuk akun Anda.
                                </p>
                            </div>
                        </div>
                    </div>


                    <div class="space-y-6 flex flex-col xl:flex-row items-start w-full gap-x-20">
                        <div class="space-y-1 max-w-lg w-full">
                            <h3 class="font-semibold text-foreground text-base">Ubah Kata Sandi</h3>
                            <p class="text-muted-foreground text-xs">Pastikan kata sandi baru Anda minimal 8 karakter dan mengandung kombinasi huruf dan angka.</p>
                        </div>

                        <div class="space-y-4 w-full">
                            <vibe:input type="password" name="current_password" label="Kata Sandi Saat Ini" viewable placeholder="Masukkan kata sandi saat ini" />
                            <vibe:input type="password" name="new_password" label="Kata Sandi Baru" viewable placeholder="Minimal 8 karakter" />
                            <vibe:input type="password" name="confirm_password" label="Konfirmasi Kata Sandi Baru" viewable placeholder="Ulangi kata sandi baru" />
                            <vibe:button type="button" variant="primary" size="sm" class="cursor-pointer float-end flex " @click="window.vibeToast ? vibeToast('Kata sandi berhasil diperbarui.', { type: 'success', title: 'Diperbarui' }) : null">
                                Perbarui Kata Sandi
                            </vibe:button>
                        </div>
                    </div>

                    <vibe:separator />

                    <div class="space-y-6 flex flex-col xl:flex-row items-start w-full gap-x-20" x-data="passkeyController()">
                        <div class="space-y-1 max-w-lg w-full">
                            <div class="flex items-center gap-2">
                                <h3 class="font-semibold text-foreground text-base">Passkey (WebAuthn)</h3>
                                <vibe:badge size="sm" variant="success" dot class="rounded-full" x-show="supported" x-cloak>
                                    Browser Didukung
                                </vibe:badge>
                                <vibe:badge size="sm" variant="destructive" class="rounded-full" x-show="!supported">
                                    Tidak Didukung
                                </vibe:badge>
                            </div>
                            <p class="text-muted-foreground text-xs">
                                Daftarkan Touch ID, Face ID, Windows Hello, atau kunci fisik (YubiKey) untuk login cepat tanpa kata sandi.
                            </p>
                        </div>

                        <div class="space-y-4 w-full">
                            <div x-show="isIpAddress" x-cloak>
                                <vibe:card.alert variant="warning" size="sm">
                                    <div class="flex sm:flex-row flex-col justify-between sm:items-center gap-3 w-full">
                                        <span>Anda mengakses via <strong>127.0.0.1</strong>. Buka via <strong>localhost</strong> agar WebAuthn berfungsi.</span>
                                        <a :href="localhostUrl" class="bg-amber-500 hover:bg-amber-600 px-2.5 py-1 rounded-lg font-medium text-white text-xs transition-colors shrink-0">Buka di Localhost &rarr;</a>
                                    </div>
                                </vibe:card.alert>
                            </div>

                            {{-- Feedback Message --}}
                            <div x-show="feedbackMessage && feedbackType === 'success'" x-cloak>
                                <vibe:card.alert variant="success" size="sm" title="✓ Berhasil!">
                                    <span x-text="feedbackMessage"></span>
                                </vibe:card.alert>
                            </div>
                            <div x-show="feedbackMessage && feedbackType !== 'success'" x-cloak>
                                <vibe:card.alert variant="destructive" size="sm" title="⚠ Perhatian:">
                                    <span x-text="feedbackMessage"></span>
                                </vibe:card.alert>
                            </div>

                            @php
                                $userPasskeys = auth()->user()?->passkeys ?? collect();
                            @endphp

                            <div class="space-y-4">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <p class="font-semibold text-foreground text-sm">Passkey Terdaftar</p>
                                        <p class="text-xs text-muted-foreground">Kunci biometrik yang terhubung ke akun Anda.</p>
                                    </div>
                                    <vibe:badge size="sm" variant="secondary" class="rounded-full">{{ $userPasskeys->count() }} Terdaftar</vibe:badge>
                                </div>

                                @if ($userPasskeys->isEmpty())
                                    <div class="flex items-center gap-3.5 bg-muted p-3.5 rounded-xl">
                                        <div class="flex justify-center items-center bg-primary/10 rounded-xl size-9 shrink-0">
                                            <svg class="size-4 text-primary shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
                                        </div>
                                        <div>
                                            <p class="font-semibold text-foreground text-sm">Belum ada passkey terdaftar</p>
                                            <p class="text-xs text-muted-foreground">Tambahkan perangkat Anda di bawah untuk mengaktifkan login biometrik.</p>
                                        </div>
                                    </div>
                                @else
                                    <div class="rounded-xl divide-y divide-border/40 overflow-hidden">
                                        @foreach ($userPasskeys as $passkey)
                                            <div class="flex justify-between items-center gap-3 bg-muted p-3">
                                                <div class="flex items-center gap-3 min-w-0">
                                                    <div class="flex justify-center items-center bg-primary/10 rounded-lg size-8 text-primary shrink-0">
                                                        <svg class="size-4 text-primary shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
                                                    </div>
                                                    <div class="min-w-0">
                                                        <p class="font-semibold text-foreground text-sm truncate">{{ $passkey->name }}</p>
                                                        <p class="text-xs text-muted-foreground">Ditambahkan {{ $passkey->created_at?->diffForHumans() }}</p>
                                                    </div>
                                                </div>
                                                <vibe:button.delete class="rounded-full" size="xs" :url="route('passkey.destroy', $passkey)" title="Hapus Passkey" message="Hapus passkey '{{ $passkey->name }}'? Anda tidak bisa login dengan perangkat ini lagi.">
                                                    Hapus
                                                </vibe:button.delete>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                <div class="space-y-3 pt-3 border-border/50 border-t">
                                    <vibe:form :ajax="false" @submit.prevent="submitRegisterPasskey()" class="space-y-3">
                                        <div class="space-y-1.5">
                                            <vibe:input x-model="registerName" label="Daftarkan Passkey Baru" description="Daftarkan biometrik perangkat saat ini." placeholder="Contoh: MacBook Pro Touch ID" required />
                                        </div>

                                        <div class="flex sm:flex-row flex-col justify-between items-start sm:items-center gap-3 pt-0.5">
                                            <span class="flex items-center gap-1.5 text-xs text-muted-foreground">
                                                Sensor biometrik akan langsung dipicu saat tombol ditekan.
                                            </span>

                                            <vibe:button type="submit" variant="primary" size="sm" ::disabled="registering || loading || !registerName" class="cursor-pointer shrink-0">
                                                <template x-if="!registering && !loading">
                                                    <span class="inline-flex items-center gap-1.5">
                                                        <span>Daftarkan Passkey</span>
                                                    </span>
                                                </template>
                                                <template x-if="registering || loading">
                                                    <span class="inline-flex items-center gap-1.5">
                                                        <svg class="size-3 animate-spin" viewBox="0 0 24 24" fill="none">
                                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                        </svg>
                                                        <span x-text="statusText || 'Memproses...'"></span>
                                                    </span>
                                                </template>
                                            </vibe:button>
                                        </div>
                                    </vibe:form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <vibe:separator />

                    {{-- 2FA Section with Alpine Scope enclosing Section & Modals --}}
                    <div x-data="vibeTwoFactorSettings()">
                        <div class="space-y-6 flex flex-col xl:flex-row items-start w-full gap-x-20">
                            <div class="space-y-1 max-w-lg w-full">
                                <div class="flex items-center gap-2">
                                    <h3 class="font-semibold text-foreground text-base">Autentikasi Dua Faktor (2FA)</h3>
                                    <div>
                                        <vibe:badge size="sm" variant="success" class="rounded-full font-semibold" x-show="enabled" x-cloak>
                                            Aktif
                                        </vibe:badge>
                                        <vibe:badge size="sm" variant="secondary" class="rounded-full font-medium" x-show="!enabled">
                                            Nonaktif
                                        </vibe:badge>
                                    </div>
                                </div>
                                <p class="text-muted-foreground text-xs">Tambahkan lapisan keamanan ekstra. Setiap login membutuhkan kode verifikasi dari aplikasi autentikator atau email.</p>
                            </div>

                            <div class="space-y-4 w-full">
                                {{-- Header & Quick Add Button --}}
                                <div class="flex justify-between items-center gap-3">
                                    <div>
                                        <p class="font-semibold text-foreground text-sm">Metode Verifikasi Dua Langkah</p>
                                        <p class="text-xs text-muted-foreground">Pilih metode autentikasi yang ingin Anda hubungkan dengan akun ini.</p>
                                    </div>

                                </div>

                                {{-- Daftar Pilihan Metode 2FA --}}
                                <div class="space-y-2.5">
                                    {{-- Metode 1: Authenticator App (TOTP) --}}
                                    <div class="flex justify-between items-center gap-3 bg-muted p-3 rounded-xl transition-colors">
                                        <div class="flex items-center gap-3 min-w-0">
                                            <div class="flex justify-center items-center bg-primary/10 rounded-lg size-9 text-primary shrink-0">
                                                <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <rect width="14" height="20" x="5" y="2" rx="2" ry="2" />
                                                    <path d="M12 18h.01" />
                                                </svg>
                                            </div>
                                            <div class="min-w-0">
                                                <div class="flex items-center gap-2">
                                                    <p class="font-semibold text-foreground text-sm">Aplikasi Autentikator (TOTP)</p>
                                                </div>
                                                <p class="text-xs text-muted-foreground truncate">Google Authenticator, Authy, atau 1Password.</p>
                                            </div>
                                        </div>
                                        <div class="shrink-0 flex items-center gap-1.5">
                                            <vibe:button variant="primary" type="button" size="xs" x-show="!totpEnabled" @click="openSetup('totp')" ::disabled="loading" class="rounded-full">
                                                Aktifkan
                                            </vibe:button>
                                            <vibe:button.delete class="rounded-full" size="xs" x-show="totpEnabled" x-cloak action="disable2FA('totp', true)" title="Nonaktifkan Autentikator" message="Apakah Anda yakin ingin menonaktifkan Aplikasi Autentikator (TOTP)?">
                                                Nonaktifkan
                                            </vibe:button.delete>
                                        </div>
                                    </div>

                                    {{-- Metode 2: Email OTP --}}
                                    <div class="flex justify-between items-center gap-3 bg-muted p-3 rounded-xl transition-colors">
                                        <div class="flex items-center gap-3 min-w-0">
                                            <div class="flex justify-center items-center bg-blue-500/10 rounded-lg size-9 text-blue-600 dark:text-blue-400 shrink-0">
                                                <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <rect width="20" height="16" x="2" y="4" rx="2" />
                                                    <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                                                </svg>
                                            </div>
                                            <div class="min-w-0">
                                                <div class="flex items-center gap-2">
                                                    <p class="font-semibold text-foreground text-sm">Kode Verifikasi Email (OTP)</p>
                                                </div>
                                                <p class="text-xs text-muted-foreground truncate" x-text="userEmail ? 'Kode 6-digit dikirim ke ' + userEmail : 'Kode 6-digit dikirim ke email terdaftar.'"></p>
                                            </div>
                                        </div>
                                        <div class="shrink-0 flex items-center gap-1.5">
                                            <vibe:button variant="primary" type="button" size="xs" x-show="!emailEnabled" @click="openSetup('email')" ::disabled="loading" class="rounded-full">
                                                Aktifkan
                                            </vibe:button>
                                            <vibe:button.delete class="rounded-full" size="xs" x-show="emailEnabled" x-cloak action="disable2FA('email', true)" title="Nonaktifkan Verifikasi Email" message="Apakah Anda yakin ingin menonaktifkan Verifikasi Dua Langkah via Email?">
                                                Nonaktifkan
                                            </vibe:button.delete>
                                        </div>
                                    </div>

                                    {{-- Metode 3: WhatsApp / SMS OTP (Stub) --}}
                                    <div class="flex justify-between items-center gap-3 bg-muted/10 opacity-75 p-3 border border-border/70 border-dashed rounded-xl">
                                        <div class="flex items-center gap-3 min-w-0">
                                            <div class="flex justify-center items-center bg-emerald-500/10 rounded-lg size-9 text-emerald-600 dark:text-emerald-400 shrink-0">
                                                <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z" />
                                                </svg>
                                            </div>
                                            <div class="min-w-0">
                                                <div class="flex items-center gap-2">
                                                    <p class="font-semibold text-foreground text-sm">WhatsApp / SMS OTP</p>
                                                    <vibe:badge size="sm" variant="secondary" class="rounded-full">Segera Hadir</vibe:badge>
                                                </div>
                                                <p class="text-xs text-muted-foreground truncate">Verifikasi praktis langsung ke WhatsApp atau SMS.</p>
                                            </div>
                                        </div>
                                        <div class="shrink-0">
                                            <vibe:badge size="sm" variant="outline" class="rounded-full font-mono">Stub Siap</vibe:badge>
                                        </div>
                                    </div>
                                </div>

                                {{-- Footer: Recovery Codes & Global Disable --}}
                                <div x-show="enabled" x-cloak class="flex flex-wrap justify-between items-center gap-2 pt-3 border-border/50 border-t">
                                    <div class="text-muted-foreground text-xs">
                                        <span>Kode Pemulihan Cadangan</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <vibe:button type="button" variant="outline" size="xs" @click="openRecoveryCodes()" ::disabled="loading" class="cursor-pointer">
                                            Lihat Kode Pemulihan
                                        </vibe:button>
                                        <vibe:button.delete size="xs" action="disable2FA(null, true)" title="Nonaktifkan Semua 2FA" message="Apakah Anda yakin ingin menonaktifkan seluruh Autentikasi Dua Faktor (2FA)?">
                                            Nonaktifkan Semua
                                        </vibe:button.delete>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Modal Setup 2FA: Authenticator App (TOTP) --}}
                        <vibe:modal id="modal-2fa-totp">
                            <vibe:form id="form-2fa-totp" action="{{ route('two-factor.confirm') }}" method="POST" @vibe-success="handleConfirmSuccess($event.detail, 'totp')" @vibe-error="handleConfirmError($event.detail)">
                                @csrf
                                <input type="hidden" name="method" value="totp" />

                                <vibe:modal.header>
                                    <div class="font-semibold text-foreground text-base">
                                        <span x-show="step === 0">Setup Aplikasi Autentikator</span>
                                        <span x-show="step === 1" x-cloak>Simpan Kode Pemulihan Anda</span>
                                    </div>
                                    <p class="mt-0.5 font-normal text-muted-foreground text-xs">
                                        <span x-show="step === 0">Pindai kode QR dan masukkan 6-digit kode verifikasi untuk mengaktifkan.</span>
                                        <span x-show="step === 1" x-cloak>Simpan kode darurat sekali pakai di tempat yang aman.</span>
                                    </p>
                                </vibe:modal.header>

                                <vibe:modal.content>
                                    {{-- Feedback Alert --}}
                                    <div x-show="feedback && feedbackType === 'success'" x-cloak class="mb-4">
                                        <vibe:card.alert variant="success" size="sm">
                                            <span x-text="feedback"></span>
                                        </vibe:card.alert>
                                    </div>
                                    <div x-show="feedback && feedbackType === 'error'" x-cloak class="mb-4">
                                        <vibe:card.alert variant="destructive" size="sm">
                                            <span x-text="feedback"></span>
                                        </vibe:card.alert>
                                    </div>

                                    {{-- Step 0: QR Code & OTP --}}
                                    <div x-show="step === 0" class="space-y-5">
                                        <div class="flex sm:flex-row flex-col items-center gap-5 bg-muted/40 p-4 border border-border rounded-xl">
                                            <vibe:display.qrcode 
                                                x-bind:value="qrCodeUrl" 
                                                :size="180" 
                                                level="M" 
                                                :margin="4"
                                                class="rounded-xl bg-white shadow-2xs border border-border/80 shrink-0" 
                                            />
                                            <div class="flex-1 space-y-2 sm:text-left text-center">
                                                <p class="font-semibold text-foreground text-sm">Pindai dengan Aplikasi Autentikator</p>
                                                <p class="text-xs text-muted-foreground leading-relaxed">
                                                    Buka Google Authenticator, Authy, atau 1Password di smartphone, lalu pindai kode QR di samping.
                                                </p>
                                                <div class="pt-1">
                                                    <span class="block mb-1 text-xs text-muted-foreground">Atau masukkan kunci manual:</span>
                                                    <div class="flex items-center gap-1.5">
                                                        <code class="flex-1 bg-background px-2.5 py-1 border border-border rounded font-mono text-xs text-foreground truncate tracking-wider select-all" x-text="secretKey"></code>
                                                        <vibe:button type="button" variant="outline" size="xs" @click="copySecret()" class="cursor-pointer shrink-0">
                                                            <span x-text="copiedSecret ? 'Tersalin!' : 'Salin'"></span>
                                                        </vibe:button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="space-y-2">
                                            <label class="flex justify-between items-center font-semibold text-foreground text-xs">
                                                <span>Masukkan Kode 6-Digit dari Aplikasi</span>
                                                <span class="font-normal text-xs text-muted-foreground">Dapat paste langsung</span>
                                            </label>
                                            <div>
                                                <vibe:input.otp id="setup-2fa-otp-totp" name="code" :auto-submit="true" length="6" size="md" />
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Step 1: Recovery Codes --}}
                                    <div x-show="step === 1" x-cloak class="space-y-4">
                                        <vibe:card.alert variant="warning" size="sm" title="PENTING: Simpan kode pemulihan ini!">
                                            Jika Anda kehilangan akses ke aplikasi autentikator, kode ini adalah satu-satunya cara untuk masuk kembali ke akun Anda.
                                        </vibe:card.alert>

                                        <div class="gap-2 grid grid-cols-2 sm:grid-cols-4 bg-muted/40 p-3.5 border border-border rounded-xl font-mono text-foreground text-xs">
                                            <template x-for="code in recoveryCodes" :key="code">
                                                <div class="bg-background p-2 border border-border rounded-lg text-center select-all" x-text="code"></div>
                                            </template>
                                        </div>
                                    </div>
                                </vibe:modal.content>

                                <vibe:modal.footer>
                                    <div x-show="step === 0" class="flex justify-between items-center w-full">
                                        <vibe:button type="button" variant="outline" size="sm" @click="$vibe.modal('modal-2fa-totp').close()">
                                            Batal
                                        </vibe:button>
                                        <vibe:button type="submit" variant="primary" size="sm" ::disabled="loading" class="cursor-pointer">
                                            <span x-show="!loading">Aktifkan 2FA &rarr;</span>
                                            <span x-show="loading" x-cloak>Memverifikasi...</span>
                                        </vibe:button>
                                    </div>

                                    <div x-show="step === 1" x-cloak class="flex justify-between items-center w-full">
                                        <vibe:button type="button" variant="outline" size="sm" class="cursor-pointer" @click="navigator.clipboard.writeText(recoveryCodes.join('\n')); if(window.vibeToast) vibeToast('Semua kode berhasil disalin!', { type: 'success' })">
                                            Salin Semua Kode
                                        </vibe:button>
                                        <vibe:button type="button" variant="primary" size="sm" class="cursor-pointer" @click="$vibe.modal('modal-2fa-totp').close()">
                                            Selesai &rarr;
                                        </vibe:button>
                                    </div>
                                </vibe:modal.footer>
                            </vibe:form>
                        </vibe:modal>

                        {{-- Modal Setup 2FA: Email OTP --}}
                        <vibe:modal id="modal-2fa-email">
                            <vibe:form id="form-2fa-email" action="{{ route('two-factor.confirm') }}" method="POST" @vibe-success="handleConfirmSuccess($event.detail, 'email')" @vibe-error="handleConfirmError($event.detail)">
                                @csrf
                                <input type="hidden" name="method" value="email" />

                                <vibe:modal.header>
                                    <div class="font-semibold text-foreground text-base">
                                        <span x-show="step === 0">Verifikasi Dua Langkah via Email</span>
                                        <span x-show="step === 1" x-cloak>Simpan Kode Pemulihan Anda</span>
                                    </div>
                                    <p class="mt-0.5 font-normal text-muted-foreground text-xs">
                                        <span x-show="step === 0">Masukkan 6-digit kode verifikasi yang dikirimkan ke email Anda.</span>
                                        <span x-show="step === 1" x-cloak>Simpan kode darurat sekali pakai di tempat yang aman.</span>
                                    </p>
                                </vibe:modal.header>

                                <vibe:modal.content>
                                    {{-- Feedback Alert --}}
                                    <div x-show="feedback && feedbackType === 'success'" x-cloak class="mb-4">
                                        <vibe:card.alert variant="success" size="sm">
                                            <span x-text="feedback"></span>
                                        </vibe:card.alert>
                                    </div>
                                    <div x-show="feedback && feedbackType === 'info'" x-cloak class="mb-4">
                                        <vibe:card.alert variant="info" size="sm">
                                            <span x-text="feedback"></span>
                                        </vibe:card.alert>
                                    </div>
                                    <div x-show="feedback && feedbackType === 'error'" x-cloak class="mb-4">
                                        <vibe:card.alert variant="destructive" size="sm">
                                            <span x-text="feedback"></span>
                                        </vibe:card.alert>
                                    </div>

                                    {{-- Step 0: Email Info & OTP --}}
                                    <div x-show="step === 0" class="space-y-5">
                                        <div class="flex items-start gap-3.5 bg-blue-500/5 p-4 border border-blue-500/20 rounded-xl">
                                            <div class="flex justify-center items-center bg-blue-500/10 mt-0.5 rounded-lg size-9 text-blue-600 dark:text-blue-400 shrink-0">
                                                <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <rect width="20" height="16" x="2" y="4" rx="2" />
                                                    <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                                                </svg>
                                            </div>
                                            <div class="flex-1 space-y-1 text-xs">
                                                <p class="font-semibold text-foreground text-sm">Kode Verifikasi Telah Dikirim</p>
                                                <p class="text-muted-foreground leading-relaxed">
                                                    Kami telah mengirimkan 6-digit kode OTP ke alamat email <span class="font-mono font-medium text-foreground" x-text="userEmail"></span>. Masukkan kode tersebut di bawah ini untuk mengonfirmasi.
                                                </p>
                                            </div>
                                        </div>

                                        <div class="space-y-2">
                                            <div class="flex justify-between items-center">
                                                <label class="font-semibold text-foreground text-xs">
                                                    Masukkan Kode 6-Digit dari Email
                                                </label>
                                                <div class="text-xs">
                                                    <span x-show="cooldown > 0" class="text-muted-foreground">Kirim ulang dalam <span class="font-mono font-semibold" x-text="cooldown"></span>s</span>
                                                    <vibe:button type="button" variant="link" size="xs" x-show="cooldown <= 0" @click="resendEmailOtp()" ::disabled="resending" class="cursor-pointer font-semibold">
                                                        <span x-show="!resending">Kirim Ulang Kode</span>
                                                        <span x-show="resending" x-cloak>Mengirim...</span>
                                                    </vibe:button>
                                                </div>
                                            </div>
                                            <div>
                                                <vibe:input.otp id="setup-2fa-otp-email" name="code" :auto-submit="true" length="6" size="md" />
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Step 1: Recovery Codes --}}
                                    <div x-show="step === 1" x-cloak class="space-y-4">
                                        <vibe:card.alert variant="warning" size="sm" title="PENTING: Simpan kode pemulihan ini!">
                                            Jika Anda kehilangan akses ke email Anda, kode ini adalah satu-satunya cara untuk masuk kembali ke akun Anda.
                                        </vibe:card.alert>

                                        <div class="gap-2 grid grid-cols-2 sm:grid-cols-4 bg-muted/40 p-3.5 border border-border rounded-xl font-mono text-foreground text-xs">
                                            <template x-for="code in recoveryCodes" :key="code">
                                                <div class="bg-background p-2 border border-border rounded-lg text-center select-all" x-text="code"></div>
                                            </template>
                                        </div>
                                    </div>
                                </vibe:modal.content>

                                <vibe:modal.footer>
                                    <div x-show="step === 0" class="flex justify-between items-center w-full">
                                        <vibe:button type="button" variant="outline" size="sm" @click="$vibe.modal('modal-2fa-email').close()">
                                            Batal
                                        </vibe:button>
                                        <vibe:button type="submit" variant="primary" size="sm" ::disabled="loading" class="cursor-pointer">
                                            <span x-show="!loading">Aktifkan 2FA &rarr;</span>
                                            <span x-show="loading" x-cloak>Memverifikasi...</span>
                                        </vibe:button>
                                    </div>

                                    <div x-show="step === 1" x-cloak class="flex justify-between items-center w-full">
                                        <vibe:button type="button" variant="outline" size="sm" class="cursor-pointer" @click="navigator.clipboard.writeText(recoveryCodes.join('\n')); if(window.vibeToast) vibeToast('Semua kode berhasil disalin!', { type: 'success' })">
                                            Salin Semua Kode
                                        </vibe:button>
                                        <vibe:button type="button" variant="primary" size="sm" class="cursor-pointer" @click="$vibe.modal('modal-2fa-email').close()">
                                            Selesai &rarr;
                                        </vibe:button>
                                    </div>
                                </vibe:modal.footer>
                            </vibe:form>
                        </vibe:modal>

                        {{-- Modal View Recovery Codes --}}
                        <vibe:modal id="modal-2fa-recovery" maxWidth="md">
                            <vibe:modal.header>
                                <div class="font-semibold text-foreground text-base">Kode Pemulihan Cadangan (2FA)</div>
                                <p class="mt-0.5 font-normal text-muted-foreground text-xs">Daftar kode pemulihan darurat sekali pakai</p>
                            </vibe:modal.header>

                            <vibe:modal.content>
                                <div class="space-y-4">
                                    <vibe:card.alert variant="warning" size="sm">
                                        Setiap kode hanya dapat digunakan satu kali. Simpan kode-kode ini di tempat yang aman.
                                    </vibe:card.alert>

                                    <div class="gap-2 grid grid-cols-2 bg-muted/40 p-3.5 border border-border rounded-xl font-mono text-foreground text-xs">
                                        <template x-for="code in recoveryCodes" :key="code">
                                            <div class="bg-background p-2 border border-border rounded-lg text-center select-all" x-text="code"></div>
                                        </template>
                                    </div>
                                </div>
                            </vibe:modal.content>

                            <vibe:modal.footer>
                                <div class="flex justify-between items-center w-full">
                                    <vibe:button type="button" variant="ghost" size="xs" class="hover:bg-destructive/10 text-destructive cursor-pointer" @click="regenerateRecoveryCodes()">
                                        Buat Ulang Kode Baru
                                    </vibe:button>
                                    <div class="flex items-center gap-2">
                                        <vibe:button type="button" variant="outline" size="xs" class="cursor-pointer" @click="navigator.clipboard.writeText(recoveryCodes.join('\n')); if(window.vibeToast) vibeToast('Kode pemulihan berhasil disalin!', { type: 'success' })">
                                            Salin Semua
                                        </vibe:button>
                                        <vibe:button type="button" variant="primary" size="xs" class="cursor-pointer" @click="$vibe.modal('modal-2fa-recovery').close()">
                                            Tutup
                                        </vibe:button>
                                    </div>
                                </div>
                            </vibe:modal.footer>
                        </vibe:modal>
                    </div>

                    <vibe:separator />

                    <div class="space-y-6 flex flex-col xl:flex-row items-start w-full gap-x-20">
                        <div class="space-y-1 max-w-lg w-full">
                            <h3 class="font-semibold text-destructive text-base">Zona Berbahaya</h3>
                            <p class="text-muted-foreground text-xs">Tindakan berikut bersifat permanen dan tidak dapat dibatalkan.</p>
                        </div>

                        <div class="space-y-4 w-full">
                            <div class="flex justify-between items-center gap-4">
                                <div>
                                    <p class="font-semibold text-foreground text-sm">Hapus Akun</p>
                                    <p class="mt-0.5 text-muted-foreground text-xs">Menghapus akun secara permanen beserta semua data terkait.</p>
                                </div>
                                <vibe:button type="button" variant="destructive" size="sm" class="cursor-pointer shrink-0">
                                    Hapus Akun
                                </vibe:button>
                            </div>
                        </div>
                    </div>

                </div>
            </vibe:tabs>
        </vibe:card>
    </div>

    @pushOnce('head', 'vibe-security-scripts')
        @vite(['resources/js/vibe/qrcode.js', 'resources/js/vibe/passkeys.js'])
    @endPushOnce

    @push('body')
        <script>
            function vibeTwoFactorSettings() {
                return {
                    totpEnabled: @json(auth()->user()?->hasTwoFactorEnabled('totp') ?? false),
                    emailEnabled: @json(auth()->user()?->hasTwoFactorEnabled('email') ?? false),
                    userEmail: @json(auth()->user()?->email ? \Teknovate\VibeUi\Vibe::twoFactor()->maskEmail(auth()->user()->email) : ''),
                    isGuest: @json(!auth()->check()),
                    step: 0,
                    selectedMethod: 'totp',
                    loading: false,
                    isProcessing: false,
                    resending: false,
                    cooldown: 0,
                    cooldownTimer: null,
                    emailOtpSent: false,
                    secretKey: '',
                    qrCodeUrl: '',
                    copiedSecret: false,
                    otpCode: '',
                    feedback: null,
                    feedbackType: 'info',
                    recoveryCodes: [],
                    csrf: '{{ csrf_token() }}',

                    get enabled() {
                        return this.totpEnabled || this.emailEnabled;
                    },

                    openSetup(method = 'totp') {
                        if (this.isGuest) {
                            if (window.vibeToast) {
                                vibeToast('Silakan login terlebih dahulu untuk mengaktifkan 2FA akun Anda.', {
                                    type: 'warning',
                                    title: 'Perlu Login'
                                });
                            }
                            return;
                        }

                        this.selectedMethod = method;
                        this.step = 0;
                        this.feedback = null;
                        this.qrCodeUrl = '';
                        this.resetOtpInputs();

                        if (method === 'email') {
                            $vibe.modal('modal-2fa-email').show();
                            // Jika cooldown masih berjalan, OTP sudah dikirim — jangan kirim ulang
                            if (this.emailOtpSent && this.cooldown > 0) {
                                this.feedbackType = 'info';
                                this.feedback = 'Kode sudah dikirim ke email Anda. Tunggu ' + this.cooldown + ' detik untuk meminta kode baru.';
                                return;
                            }
                            // Reset flag untuk sesi baru (cooldown habis atau pertama kali)
                            this.emailOtpSent = false;
                            this.loadSetup(method);
                        } else {
                            $vibe.modal('modal-2fa-totp').show();
                            this.loadSetup(method);
                        }
                    },

                    selectMethod(method) {
                        this.openSetup(method);
                    },

                    async loadSetup(method) {
                        this.loading = true;
                        this.isProcessing = true;
                        this.feedback = null;

                        try {
                            const res = await fetch('{{ route('two-factor.setup') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': this.csrf,
                                    'Accept': 'application/json',
                                },
                                body: JSON.stringify({
                                    method: method
                                })
                            });

                            if (res.status === 401) {
                                if (window.vibeToast) {
                                    vibeToast('Sesi login telah berakhir. Silakan login kembali.', {
                                        type: 'warning'
                                    });
                                }
                                return;
                            }

                            const data = await res.json();
                            if (!res.ok) {
                                this.feedbackType = 'error';
                                this.feedback = data.message || 'Gagal memulai konfigurasi 2FA.';
                                return;
                            }

                            if (method === 'totp') {
                                this.secretKey = data.secret;
                                this.qrCodeUrl = data.qr_code_url;
                            } else if (method === 'email') {
                                if (data.email) {
                                    this.userEmail = data.email;
                                }
                                // Gunakan cooldown_seconds dari server (dari hit baru atau sisa throttle)
                                const cooldownSecs = data.cooldown_seconds || 60;
                                this.startCooldown(cooldownSecs);
                                this.emailOtpSent = true;
                                this.feedbackType = data.throttled ? 'error' : 'info';
                                this.feedback = data.message || 'Kode verifikasi 6-digit telah dikirimkan ke email Anda.';
                            }
                        } catch (e) {
                            this.feedbackType = 'error';
                            this.feedback = 'Gagal memuat konfigurasi 2FA.';
                            if (window.vibeToast) vibeToast('Gagal memuat konfigurasi 2FA.', {
                                type: 'error'
                            });
                        } finally {
                            this.loading = false;
                            this.isProcessing = false;
                        }
                    },

                    startCooldown(seconds) {
                        if (this.cooldownTimer) clearInterval(this.cooldownTimer);
                        this.cooldown = seconds;
                        this.cooldownTimer = setInterval(() => {
                            if (this.cooldown > 0) {
                                this.cooldown--;
                            } else {
                                clearInterval(this.cooldownTimer);
                                this.cooldownTimer = null;
                            }
                        }, 1000);
                    },

                    async resendEmailOtp() {
                        if (this.cooldown > 0 || this.resending) return;
                        this.resending = true;
                        this.feedback = null;

                        try {
                            const res = await fetch('{{ route('two-factor.send-otp') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': this.csrf,
                                    'Accept': 'application/json',
                                },
                                body: JSON.stringify({
                                    method: 'email'
                                })
                            });

                            const data = await res.json();

                            // Handle throttled (429) atau error lainnya
                            if (!res.ok) {
                                const cooldownSecs = data.cooldown_seconds || 0;
                                if (cooldownSecs > 0) this.startCooldown(cooldownSecs);
                                this.feedbackType = 'error';
                                this.feedback = data.message || 'Gagal mengirim ulang kode.';
                                return;
                            }

                            const cooldownSecs = data.cooldown_seconds || 60;
                            this.startCooldown(cooldownSecs);
                            this.emailOtpSent = true;
                            this.feedbackType = 'info';
                            this.feedback = data.message || 'Kode verifikasi baru telah dikirimkan ke email Anda.';
                            if (window.vibeToast) vibeToast('Kode baru berhasil dikirim ke email!', {
                                type: 'success'
                            });
                        } catch (e) {
                            this.feedbackType = 'error';
                            this.feedback = 'Terjadi kesalahan saat mengirim ulang kode.';
                        } finally {
                            this.resending = false;
                        }
                    },

                    resetOtpInputs() {
                        this.otpCode = '';
                        ['setup-2fa-otp-totp', 'setup-2fa-otp-email'].forEach(id => {
                            const hidden = document.getElementById(id);
                            if (hidden) {
                                hidden.value = '';
                                hidden.dispatchEvent(new Event('input', {
                                    bubbles: true
                                }));
                                hidden.dispatchEvent(new Event('change', {
                                    bubbles: true
                                }));
                            }
                            for (let i = 0; i < 6; i++) {
                                const box = document.getElementById(id + '-' + i);
                                if (box) {
                                    box.value = '';
                                    box.dispatchEvent(new Event('input', {
                                        bubbles: true
                                    }));
                                }
                            }
                        });
                    },

                    copySecret() {
                        navigator.clipboard.writeText(this.secretKey);
                        this.copiedSecret = true;
                        setTimeout(() => {
                            this.copiedSecret = false;
                        }, 2000);
                    },

                    handleConfirmSuccess(detail, method) {
                        const data = detail.data || {};
                        if (method === 'totp') {
                            this.totpEnabled = true;
                        } else if (method === 'email') {
                            this.emailEnabled = true;
                        }

                        this.recoveryCodes = data.recovery_codes || [];
                        this.step = 1;
                        this.feedback = null;
                        if (window.vibeToast) {
                            vibeToast(data.message || '2FA berhasil diaktifkan!', {
                                type: 'success'
                            });
                        }
                    },

                    handleConfirmError(detail) {
                        const err = detail.error || {};
                        this.feedbackType = 'error';
                        this.feedback = err.message || (err.errors ? Object.values(err.errors).flat()[0] : 'Kode verifikasi tidak valid.');
                    },

                    verifyOtp(method = null) {
                        const m = method || this.selectedMethod || 'totp';
                        const form = document.getElementById(m === 'email' ? 'form-2fa-email' : 'form-2fa-totp');
                        if (form) {
                            if (typeof form.requestSubmit === 'function') {
                                form.requestSubmit();
                            } else {
                                form.submit();
                            }
                        }
                    },

                    async openRecoveryCodes() {
                        this.loading = true;
                        this.isProcessing = true;
                        try {
                            const res = await fetch('{{ route('two-factor.recovery-codes.get') }}', {
                                headers: {
                                    'Accept': 'application/json'
                                }
                            });
                            const data = await res.json();
                            this.recoveryCodes = data.recovery_codes || [];
                            $vibe.modal('modal-2fa-recovery').show();
                        } catch (e) {
                            if (window.vibeToast) vibeToast('Gagal mengambil kode pemulihan.', {
                                type: 'error'
                            });
                        } finally {
                            this.loading = false;
                            this.isProcessing = false;
                        }
                    },

                    async regenerateRecoveryCodes() {
                        if (!confirm('Apakah Anda yakin ingin membuat ulang kode pemulihan? Kode lama tidak akan berlaku lagi.')) return;
                        this.loading = true;
                        this.isProcessing = true;
                        try {
                            const res = await fetch('{{ route('two-factor.recovery-codes') }}', {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': this.csrf,
                                    'Accept': 'application/json',
                                }
                            });
                            const data = await res.json();
                            this.recoveryCodes = data.recovery_codes || [];
                            if (window.vibeToast) vibeToast('Kode pemulihan baru berhasil dibuat.', {
                                type: 'success'
                            });
                        } catch (e) {
                            if (window.vibeToast) vibeToast('Gagal membuat ulang kode.', {
                                type: 'error'
                            });
                        } finally {
                            this.loading = false;
                            this.isProcessing = false;
                        }
                    },

                    async disable2FA(method = null, skipConfirm = false) {
                        if (!skipConfirm) {
                            let confirmMsg = 'Apakah Anda yakin ingin menonaktifkan seluruh Autentikasi Dua Faktor (2FA)?';
                            if (method === 'totp') {
                                confirmMsg = 'Apakah Anda yakin ingin menonaktifkan Aplikasi Autentikator (TOTP)?';
                            } else if (method === 'email') {
                                confirmMsg = 'Apakah Anda yakin ingin menonaktifkan Verifikasi Dua Langkah via Email?';
                            }

                            if (!confirm(confirmMsg)) return;
                        }
                        this.loading = true;
                        this.isProcessing = true;

                        try {
                            const res = await fetch('{{ route('two-factor.disable') }}', {
                                method: 'DELETE',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': this.csrf,
                                    'Accept': 'application/json',
                                },
                                body: JSON.stringify({
                                    method: method
                                })
                            });

                            const data = await res.json();
                            if (method === 'totp') {
                                this.totpEnabled = false;
                            } else if (method === 'email') {
                                this.emailEnabled = false;
                            } else {
                                this.totpEnabled = false;
                                this.emailEnabled = false;
                            }

                            if (window.vibeToast) vibeToast(data.message || 'Metode 2FA telah dinonaktifkan.', {
                                type: 'info'
                            });
                        } catch (e) {
                            if (window.vibeToast) vibeToast('Gagal menonaktifkan 2FA.', {
                                type: 'error'
                            });
                        } finally {
                            this.loading = false;
                            this.isProcessing = false;
                        }
                    }
                };
            }

            function passkeyController() {
                return {
                    supported: false,
                    isIpAddress: typeof window !== 'undefined' && (window.location.hostname === '127.0.0.1' || window.location.hostname === '::1'),
                    localhostUrl: typeof window !== 'undefined' ? window.location.href.replace('127.0.0.1', 'localhost') : '',
                    registerName: 'Perangkat Saya (' + (navigator.userAgent.includes('Mac') ? 'Mac Touch ID' : (navigator.userAgent.includes('Windows') ? 'Windows Hello' : 'Biometrik')) + ')',
                    loading: false,
                    registering: false,
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
                        this.registering = true;
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
                                this.statusText = 'Mengarahkan ke halaman konfirmasi kata sandi...';
                                window.location.href = '{{ route('password.confirm') }}';
                            } else {
                                this.feedbackType = 'error';
                                this.feedbackMessage = regRes.message || 'Pendaftaran passkey dibatalkan oleh pengguna.';
                            }
                        } catch (err) {
                            if (err?.response?.status === 423 || err?.status === 423 || err?.message?.includes('423') || err?.message?.toLowerCase().includes('password confirmation')) {
                                this.statusText = 'Mengarahkan ke halaman konfirmasi kata sandi...';
                                window.location.href = '{{ route('password.confirm') }}';
                                return;
                            }
                            this.feedbackType = 'error';
                            this.feedbackMessage = err.message || 'Terjadi kesalahan saat memproses pendaftaran passkey.';
                        } finally {
                            this.loading = false;
                            this.registering = false;
                            this.statusText = '';
                        }
                    }
                };
            }

            if (typeof window !== 'undefined') {
                window.passkeyController = passkeyController;
                window.vibeTwoFactorSettings = vibeTwoFactorSettings;
                if (window.Alpine) {
                    window.Alpine.data('passkeyController', passkeyController);
                    window.Alpine.data('vibeTwoFactorSettings', vibeTwoFactorSettings);
                } else {
                    document.addEventListener('alpine:init', () => {
                        window.Alpine.data('passkeyController', passkeyController);
                        window.Alpine.data('vibeTwoFactorSettings', vibeTwoFactorSettings);
                    });
                }
            }
        </script>
    @endpush
</x-docs.layouts.sidebar>
