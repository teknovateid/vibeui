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
                {{-- PANEL 2: APPEARANCE (LIVE THEME ENGINE)                                   --}}
                {{-- ========================================================================= --}}
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
</x-docs.layouts.sidebar>
