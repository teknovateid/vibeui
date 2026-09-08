<x-docs.layouts.sidebar>
    <vibe:seo :title="__('docs/page/settings/index.title')" :description="__('docs/page/settings/index.subtitle')" :breadcrumbs="[
        ['name' => __('docs/page/settings/index.breadcrumb.home'), 'url' => '/'],
        ['name' => __('docs/page/settings/index.breadcrumb.pages'), 'url' => '#'],
        ['name' => __('docs/page/settings/index.breadcrumb.settings'), 'url' => route('docs.settings.index')],
    ]" />

    <div class="mx-auto w-full space-y-6">
        <vibe:breadcrumb title="{!! __('docs/page/settings/index.title') !!}">
            <vibe:breadcrumb.item href="{{ route('docs.index') }}">{{ __('docs/page/settings/index.breadcrumb.home') }}</vibe:breadcrumb.item>
            <vibe:breadcrumb.item>{{ __('docs/page/settings/index.breadcrumb.pages') }}</vibe:breadcrumb.item>
            <vibe:breadcrumb.item active>{{ __('docs/page/settings/index.breadcrumb.settings') }}</vibe:breadcrumb.item>
        </vibe:breadcrumb>
        <vibe:card class="p-0">
            <vibe:tabs default="appearance" layout="cols" variant="sidebar" class="w-full">
                <vibe:tabs.list class="shrink-0">
                    {{-- 1. Profile Tab --}}
                    <vibe:tabs.tab name="profile">
                        <x-slot:icon>
                            <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="8" r="5" />
                                <path d="M20 21a8 8 0 0 0-16 0" />
                            </svg>
                        </x-slot:icon>
                        <span>{{ __('docs/page/settings/index.tabs.profile.label') }}</span>
                    </vibe:tabs.tab>

                    {{-- 2. Appearance Tab (Live app.css Overrides) --}}
                    <vibe:tabs.tab name="appearance">
                        <x-slot:icon>
                            <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z" />
                                <path d="M5 3v4" />
                                <path d="M19 17v4" />
                            </svg>
                        </x-slot:icon>
                        <span class="flex-1 text-left">{{ __('docs/page/settings/index.tabs.appearance.label') }}</span>
                        <vibe:badge variant="primary" size="sm" class="text-[10px] py-0 px-1.5">Live</vibe:badge>
                    </vibe:tabs.tab>

                    {{-- 3. Notifications Tab --}}
                    <vibe:tabs.tab name="notifications">
                        <x-slot:icon>
                            <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9" />
                                <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0" />
                            </svg>
                        </x-slot:icon>
                        <span>{{ __('docs/page/settings/index.tabs.notifications.label') }}</span>
                    </vibe:tabs.tab>

                    {{-- 4. Security Tab --}}
                    <vibe:tabs.tab name="security">
                        <x-slot:icon>
                            <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="18" height="11" x="3" y="11" rx="2" ry="2" />
                                <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                            </svg>
                        </x-slot:icon>
                        <span>{{ __('docs/page/settings/index.tabs.security.label') }}</span>
                    </vibe:tabs.tab>
                </vibe:tabs.list>

                {{-- ========================================================================= --}}
                {{-- PANEL 1: PROFILE                                                          --}}
                {{-- ========================================================================= --}}
                <vibe:tabs.panel name="profile" class="flex-1 min-w-0 p-6 space-y-6">
                    <div class="border-b border-border/50 pb-4">
                        <h2 class="text-lg font-bold text-foreground">
                            {{ __('docs/page/settings/index.tabs.profile.label') }}
                        </h2>
                        <p class="text-xs text-muted-foreground mt-0.5">
                            {{ __('docs/page/settings/index.tabs.profile.desc') }}
                        </p>
                    </div>

                    {{-- Avatar & Identity --}}
                    <div class="flex items-center gap-4">
                        <vibe:avatar size="lg" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=75&w=128&h=128&auto=format&fit=crop" alt="User Avatar" class="ring-2 ring-primary/20 shrink-0" />
                        <div class="space-y-1">
                            <h4 class="text-sm font-semibold text-foreground">Foto Profil</h4>
                            <div class="flex items-center gap-2">
                                <vibe:button type="button" size="sm" variant="outline" class="text-xs cursor-pointer">
                                    {{ __('docs/page/settings/index.profile.change_avatar') }}
                                </vibe:button>
                                <vibe:button type="button" size="sm" variant="ghost" class="text-xs text-destructive hover:bg-destructive/10 cursor-pointer">
                                    {{ __('docs/page/settings/index.profile.remove_avatar') }}
                                </vibe:button>
                            </div>
                        </div>
                    </div>

                    {{-- Essential Fields --}}
                    <div class="space-y-4 max-w-xl">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <vibe:input name="full_name" label="{{ __('docs/page/settings/index.profile.name') }}" value="Masum Parvej" placeholder="{{ __('docs/page/settings/index.profile.name_placeholder') }}" />
                            <vibe:input type="email" name="email" label="{{ __('docs/page/settings/index.profile.email') }}" value="masum@hugeicons.com" placeholder="{{ __('docs/page/settings/index.profile.email_placeholder') }}" />
                        </div>
                        <vibe:textarea name="bio" label="{{ __('docs/page/settings/index.profile.bio') }}" placeholder="{{ __('docs/page/settings/index.profile.bio_placeholder') }}" rows="2">UI/UX Designer & Design Systems Architect at Teknovate.</vibe:textarea>

                        {{-- Language Selector --}}
                        <div class="space-y-2 pt-2">
                            <label class="text-xs font-semibold text-foreground uppercase tracking-wider block">
                                {{ __('docs/page/settings/index.profile.language') }}
                            </label>
                            <div class="inline-flex p-1 rounded-xl bg-muted/50 border border-border/60 gap-1">
                                <vibe:button variant="ghost" size="sm" href="{{ route('locale.switch', 'id') }}" class="px-3 py-1.5 rounded-lg text-xs transition-all {{ app()->getLocale() === 'id' ? 'bg-card text-foreground shadow-xs font-semibold' : 'text-muted-foreground hover:text-foreground' }}">
                                    🇮🇩 Bahasa Indonesia (ID)
                                </vibe:button>
                                <vibe:button variant="ghost" size="sm" href="{{ route('locale.switch', 'en') }}" class="px-3 py-1.5 rounded-lg text-xs transition-all {{ app()->getLocale() === 'en' ? 'bg-card text-foreground shadow-xs font-semibold' : 'text-muted-foreground hover:text-foreground' }}">
                                    🇺🇸 English (US)
                                </vibe:button>
                            </div>
                        </div>
                    </div>

                    {{-- Save Profile Action --}}
                    <div class="pt-4 border-t border-border/50 flex items-center justify-end">
                        <vibe:button type="button" variant="primary" size="sm" class="cursor-pointer" @click="window.vibeToast ? vibeToast('Profil pengguna berhasil disimpan.', { type: 'success', title: 'Tersimpan' }) : null">
                            {{ __('docs/page/settings/index.profile.save_btn') }}
                        </vibe:button>
                    </div>
                </vibe:tabs.panel>

                {{-- ========================================================================= --}}
                {{-- PANEL 2: APPEARANCE (LIVE APP.CSS OVERRIDES)                             --}}
                {{-- ========================================================================= --}}
                <vibe:tabs.panel name="appearance" class="flex-1 min-w-0 p-6 space-y-6">
                    <div x-data="appearanceController()" x-init="init()" class="space-y-6">
                        <div class="border-b border-border/50 pb-4">
                            <h2 class="text-lg font-bold text-foreground">
                                {{ __('docs/page/settings/index.tabs.appearance.label') }}
                            </h2>
                            <p class="text-xs text-muted-foreground mt-0.5">
                                {{ __('docs/page/settings/index.tabs.appearance.desc') }}
                            </p>
                        </div>

                        {{-- 1. Mode Antarmuka (Light / Dark / System) --}}
                        <div class="space-y-2">
                            <label class="text-xs font-semibold text-foreground uppercase tracking-wider block">
                                {{ __('docs/page/settings/index.appearance.theme_mode_title') }}
                            </label>
                            <div class="inline-flex p-1 rounded-xl bg-muted/50 border border-border/60 gap-1">
                                <button type="button" @click="setMode('light', $event)" :class="mode === 'light' ? 'bg-card text-foreground shadow-xs font-semibold' : 'text-muted-foreground hover:text-foreground'" class="flex items-center gap-2 px-3 py-1.5 rounded-lg text-xs transition-all cursor-pointer">
                                    <svg class="size-3.5 text-amber-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
                                    <span>Terang</span>
                                </button>
                                <button type="button" @click="setMode('dark', $event)" :class="mode === 'dark' ? 'bg-card text-foreground shadow-xs font-semibold' : 'text-muted-foreground hover:text-foreground'" class="flex items-center gap-2 px-3 py-1.5 rounded-lg text-xs transition-all cursor-pointer">
                                    <svg class="size-3.5 text-indigo-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z" />
                                    </svg>
                                    <span>Gelap</span>
                                </button>
                                <button type="button" @click="setMode('system', $event)" :class="mode === 'system' ? 'bg-card text-foreground shadow-xs font-semibold' : 'text-muted-foreground hover:text-foreground'" class="flex items-center gap-2 px-3 py-1.5 rounded-lg text-xs transition-all cursor-pointer">
                                    <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect width="20" height="14" x="2" y="3" rx="2" />
                                        <line x1="8" x2="16" y1="21" y2="21" />
                                        <line x1="12" x2="12" y1="17" y2="21" />
                                    </svg>
                                    <span>Sistem</span>
                                </button>
                            </div>
                        </div>

                        {{-- 2. Warna Aksen (--primary) --}}
                        <div class="space-y-2 pt-4 border-t border-border/50">
                            <div class="flex items-center justify-between">
                                <label class="text-xs font-semibold text-foreground uppercase tracking-wider">
                                    {{ __('docs/page/settings/index.appearance.primary_color_title') }}
                                </label>
                                <span class="text-xs text-muted-foreground font-medium" x-text="getActiveColorName()"></span>
                            </div>
                            <div class="flex flex-wrap items-center gap-2.5 pt-1">
                                <template x-for="(val, key) in presets" :key="key">
                                    <button type="button" @click="selectPreset(key)" :title="val.name" class="size-7 rounded-full transition-transform hover:scale-110 cursor-pointer flex items-center justify-center relative focus:outline-none ring-offset-2 ring-offset-background" :class="selectedPreset === key ? 'ring-2 ring-primary scale-110' : ''" :style="{ backgroundColor: val.color }">
                                        <span x-show="selectedPreset === key" class="size-2 rounded-full bg-white shadow-xs"></span>
                                    </button>
                                </template>

                                {{-- Custom Hex Dot --}}
                                <label title="Pilih Warna Kustom" class="size-7 rounded-full border-2 border-dashed border-border hover:border-primary flex items-center justify-center cursor-pointer relative overflow-hidden transition-all shrink-0" :class="selectedPreset === 'custom' ? 'border-primary ring-2 ring-primary ring-offset-2' : ''">
                                    <input type="color" x-model="customHex" @input="applyCustomHex(customHex)" class="absolute inset-0 opacity-0 cursor-pointer size-full" />
                                    <span x-show="selectedPreset !== 'custom'" class="text-xs font-bold text-muted-foreground">+</span>
                                    <span x-show="selectedPreset === 'custom'" class="size-full" :style="{ backgroundColor: customHex }"></span>
                                </label>
                            </div>
                        </div>

                        {{-- 3. Radius Sudut Komponen (--radius) --}}
                        <div class="space-y-2 pt-4 border-t border-border/50">
                            <div class="flex items-center justify-between">
                                <label class="text-xs font-semibold text-foreground uppercase tracking-wider">
                                    {{ __('docs/page/settings/index.appearance.radius_title') }}
                                </label>
                                <span class="text-xs text-muted-foreground font-mono" x-text="selectedRadius"></span>
                            </div>
                            <div class="inline-flex flex-wrap p-1 rounded-xl bg-muted/50 border border-border/60 gap-1">
                                <template x-for="r in radii" :key="r.value">
                                    <button type="button" @click="selectRadius(r.value)" :class="selectedRadius === r.value ? 'bg-card text-foreground shadow-xs font-semibold' : 'text-muted-foreground hover:text-foreground'" class="px-3 py-1.5 rounded-lg text-xs transition-all cursor-pointer font-mono" x-text="r.label"></button>
                                </template>
                            </div>
                        </div>

                        {{-- 4. Font Tipografi Sans (--font-sans) --}}
                        <div class="space-y-2 pt-4 border-t border-border/50">
                            <div class="flex items-center justify-between">
                                <label class="text-xs font-semibold text-foreground uppercase tracking-wider">
                                    {{ __('docs/page/settings/index.appearance.font_title') }}
                                </label>
                                <span class="text-xs text-muted-foreground font-medium" x-text="selectedFontName"></span>
                            </div>
                            <div class="inline-flex flex-wrap p-1 rounded-xl bg-muted/50 border border-border/60 gap-1">
                                <template x-for="f in fonts" :key="f.name">
                                    <button type="button" @click="selectFont(f.value, f.name)" :class="selectedFontName === f.name ? 'bg-card text-foreground shadow-xs font-semibold' : 'text-muted-foreground hover:text-foreground'" class="px-3 py-1.5 rounded-lg text-xs transition-all cursor-pointer" :style="{ fontFamily: f.value }" x-text="f.name"></button>
                                </template>
                            </div>
                        </div>

                        {{-- 5. Bahasa Antarmuka (Interface Language) --}}
                        <div class="space-y-2 pt-4 border-t border-border/50">
                            <div class="flex items-center justify-between">
                                <label class="text-xs font-semibold text-foreground uppercase tracking-wider">
                                    {{ __('docs/page/settings/index.profile.language') }}
                                </label>
                                <span class="text-xs text-muted-foreground font-medium">{{ app()->getLocale() === 'id' ? 'Bahasa Indonesia' : 'English' }}</span>
                            </div>
                            <div class="inline-flex p-1 rounded-xl bg-muted/50 border border-border/60 gap-1">
                                <vibe:button variant="ghost" size="sm" href="{{ route('locale.switch', 'id') }}" class="px-3 py-1.5 rounded-lg text-xs transition-all {{ app()->getLocale() === 'id' ? 'bg-card text-foreground shadow-xs font-semibold' : 'text-muted-foreground hover:text-foreground' }}">
                                    🇮🇩 Bahasa Indonesia (ID)
                                </vibe:button>
                                <vibe:button variant="ghost" size="sm" href="{{ route('locale.switch', 'en') }}" class="px-3 py-1.5 rounded-lg text-xs transition-all {{ app()->getLocale() === 'en' ? 'bg-card text-foreground shadow-xs font-semibold' : 'text-muted-foreground hover:text-foreground' }}">
                                    🇺🇸 English (US)
                                </vibe:button>
                            </div>
                        </div>

                        {{-- 6. Mini Live Sandbox & Actions --}}
                        <div class="pt-4 border-t border-border/50 space-y-3">
                            <div class="p-4 rounded-xl bg-muted/30 border border-border/50 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                <div class="flex flex-wrap items-center gap-3">
                                    <vibe:button variant="primary" size="sm">Tombol Utama</vibe:button>
                                    <vibe:badge variant="primary" size="sm">Aksen Aktif</vibe:badge>
                                    <div class="w-36 sm:w-44">
                                        <vibe:input size="sm" placeholder="Focus ring..." value="Live Preview" />
                                    </div>
                                </div>
                                <div class="flex items-center gap-2 self-end sm:self-auto">
                                    <vibe:button type="button" size="sm" variant="ghost" class="text-xs cursor-pointer" @click="resetToDefault()">
                                        {{ __('docs/page/settings/index.appearance.reset_btn') }}
                                    </vibe:button>
                                    <vibe:button type="button" size="sm" variant="primary" class="text-xs cursor-pointer" @click="savePreferences()">
                                        {{ __('docs/page/settings/index.appearance.save_btn') }}
                                    </vibe:button>
                                </div>
                            </div>
                        </div>
                    </div>
                </vibe:tabs.panel>

                {{-- ========================================================================= --}}
                {{-- PANEL 3: NOTIFICATIONS                                                    --}}
                {{-- ========================================================================= --}}
                <vibe:tabs.panel name="notifications" class="flex-1 min-w-0 p-6 space-y-6">
                    <div class="border-b border-border/50 pb-4">
                        <h2 class="text-lg font-bold text-foreground">
                            {{ __('docs/page/settings/index.tabs.notifications.label') }}
                        </h2>
                        <p class="text-xs text-muted-foreground mt-0.5">
                            {{ __('docs/page/settings/index.tabs.notifications.desc') }}
                        </p>
                    </div>

                    <div class="space-y-4 max-w-xl divide-y divide-border/40">
                        <div>
                            <vibe:switch name="alert_security" :label="__('docs/page/settings/index.notifications.security_alerts')" :description="__('docs/page/settings/index.notifications.security_alerts_desc')" checked />
                        </div>
                        <div class="pt-4">
                            <vibe:switch name="alert_orders" :label="__('docs/page/settings/index.notifications.order_updates')" :description="__('docs/page/settings/index.notifications.order_updates_desc')" checked />
                        </div>
                        <div class="pt-4">
                            <vibe:switch name="alert_sound" :label="__('docs/page/settings/index.notifications.sound_effects')" :description="__('docs/page/settings/index.notifications.sound_effects_desc')" checked />
                        </div>
                    </div>

                    <div class="pt-4 border-t border-border/50 flex items-center justify-end">
                        <vibe:button type="button" variant="primary" size="sm" class="cursor-pointer" @click="window.vibeToast ? vibeToast('Preferensi notifikasi disimpan.', { type: 'success', title: 'Tersimpan' }) : null">
                            {{ __('docs/page/settings/index.notifications.save_btn') }}
                        </vibe:button>
                    </div>
                </vibe:tabs.panel>

                {{-- ========================================================================= --}}
                {{-- PANEL 4: SECURITY                                                         --}}
                {{-- ========================================================================= --}}
                <vibe:tabs.panel name="security" class="flex-1 min-w-0 p-6 space-y-6">
                    <div class="border-b border-border/50 pb-4">
                        <h2 class="text-lg font-bold text-foreground">
                            {{ __('docs/page/settings/index.tabs.security.label') }}
                        </h2>
                        <p class="text-xs text-muted-foreground mt-0.5">
                            {{ __('docs/page/settings/index.tabs.security.desc') }}
                        </p>
                    </div>

                    <div class="space-y-4 max-w-md">
                        <vibe:input type="password" name="new_password" label="{{ __('docs/page/settings/index.security.new_password') }}" placeholder="Minimal 8 karakter" />
                        <vibe:input type="password" name="confirm_password" label="{{ __('docs/page/settings/index.security.confirm_password') }}" placeholder="Ulangi kata sandi" />
                    </div>

                    <div class="pt-4 border-t border-border/50 max-w-md">
                        <vibe:switch name="enable_2fa" :label="__('docs/page/settings/index.security.two_factor_title')" :description="__('docs/page/settings/index.security.two_factor_desc')" />
                    </div>

                    <div class="pt-4 border-t border-border/50 flex items-center justify-end">
                        <vibe:button type="button" variant="primary" size="sm" class="cursor-pointer" @click="window.vibeToast ? vibeToast('Kata sandi berhasil diperbarui.', { type: 'success', title: 'Diperbarui' }) : null">
                            {{ __('docs/page/settings/index.security.update_password_btn') }}
                        </vibe:button>
                    </div>
                </vibe:tabs.panel>
            </vibe:tabs>
        </vibe:card>
    </div>

    {{-- Alpine.js Appearance Manager Script --}}
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

                    radii: [{
                            label: '0 (Sharp)',
                            value: '0rem'
                        },
                        {
                            label: '0.25rem',
                            value: '0.25rem'
                        },
                        {
                            label: '0.5rem (Default)',
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
                            value: "'Figtree', ui-sans-serif, system-ui, sans-serif"
                        },
                        {
                            name: 'Inter',
                            value: "'Inter', ui-sans-serif, system-ui, sans-serif"
                        },
                        {
                            name: 'Plus Jakarta',
                            value: "'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif"
                        },
                        {
                            name: 'Outfit',
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

                    updateGeneratedCss() {
                        const colors = this.getActiveColors();
                        const radius = this.selectedRadius;
                        const font = this.selectedFontValue;

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

                    savePreferences() {
                        if (window.VibeTheme?.setCssOverride) {
                            window.VibeTheme.setCssOverride(this.generatedCss, {
                                mode: this.mode,
                                preset: this.selectedPreset,
                                customHex: this.customHex,
                                radius: this.selectedRadius,
                                fontName: this.selectedFontName,
                                fontValue: this.selectedFontValue,
                            });
                        } else {
                            let currentConfig = {};
                            try {
                                const stored = localStorage.getItem(themeKey);
                                if (stored) currentConfig = JSON.parse(stored);
                            } catch (e) {}

                            currentConfig.mode = this.mode;
                            currentConfig.preset = this.selectedPreset;
                            currentConfig.customHex = this.customHex;
                            currentConfig.radius = this.selectedRadius;
                            currentConfig.fontName = this.selectedFontName;
                            currentConfig.fontValue = this.selectedFontValue;
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
</x-docs.layouts.sidebar>
