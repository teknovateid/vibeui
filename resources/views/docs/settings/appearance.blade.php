<x-docs.layouts.sidebar>
    <vibe:seo :title="__('vibe/settings.title')" :description="__('vibe/settings.subtitle')" :breadcrumbs="[
        ['name' => __('vibe/settings.breadcrumb.home'), 'url' => '/'],
        ['name' => __('vibe/settings.breadcrumb.pages'), 'url' => '#'],
        ['name' => __('vibe/settings.breadcrumb.settings'), 'url' => route('docs.settings.account')],
        ['name' => __('vibe/settings.tabs.appearance.label'), 'url' => route('docs.settings.appearance')],
    ]" />

    <div class="mx-auto w-full space-y-6">
        <vibe:breadcrumb :title="__('vibe/settings.title')">
            <vibe:breadcrumb.item href="{{ route('docs.index') }}">{{ __('vibe/settings.breadcrumb.home') }}</vibe:breadcrumb.item>
            <vibe:breadcrumb.item>{{ __('vibe/settings.breadcrumb.pages') }}</vibe:breadcrumb.item>
            <vibe:breadcrumb.item href="{{ route('docs.settings.account') }}">{{ __('vibe/settings.breadcrumb.settings') }}</vibe:breadcrumb.item>
            <vibe:breadcrumb.item active>{{ __('vibe/settings.tabs.appearance.label') }}</vibe:breadcrumb.item>
        </vibe:breadcrumb>

        <vibe:card class="p-0 overflow-hidden">
            <vibe:tabs selected="appearance" variant="sidebar" class="min-h-155">
                @include('docs.settings.tabs', ['active' => 'appearance'])

                <div class="flex-1 min-w-0 p-6 space-y-8" 
                    x-data="Object.assign(appearanceController(), {
                        styleNames: @js(__('vibe/settings.appearance.style_names')),
                        radiiLabels: @js(__('vibe/settings.appearance.radii_labels')),
                        surfacePresetsI18n: @js(__('vibe/settings.appearance.surface_presets')),
                        fontsI18n: @js(__('vibe/settings.appearance.fonts_desc')),
                        i18n: @js(__('vibe/settings.appearance.toasts')),
                    })" 
                    x-init="init()"
                >
                    {{-- Header with Status & Quick Actions --}}
                    <div class="pb-4 border-border/50 border-b">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            <div>
                                <div class="flex items-center gap-2">
                                    <h2 class="font-bold text-foreground text-lg">{{ __('vibe/settings.appearance.header_title') ?? 'Appearance & Theme Tokens' }}</h2>
                                    <vibe:badge variant="success" size="sm" class="rounded-full" dot dotPulse>
                                        {{ __('vibe/settings.appearance.live_engine') }}
                                    </vibe:badge>
                                </div>
                                <p class="mt-0.5 text-muted-foreground text-xs">
                                    {{ __('vibe/settings.appearance.header_desc') }}
                                </p>
                            </div>

                            <div class="flex items-center gap-2 shrink-0">
                                <vibe:button 
                                    type="button" 
                                    variant="outline" 
                                    size="sm" 
                                    class="cursor-pointer text-xs" 
                                    @click="resetToDefault()"
                                >
                                    <svg class="size-3.5 text-muted-foreground" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8" />
                                        <path d="M3 3v5h5" />
                                    </svg>
                                    <span>{{ __('vibe/settings.appearance.reset_btn_short') ?? 'Reset' }}</span>
                                </vibe:button>

                                <vibe:button 
                                    type="button" 
                                    variant="primary" 
                                    size="sm" 
                                    class="cursor-pointer text-xs" 
                                    @click="copyCssVariables()"
                                >
                                    <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect width="14" height="14" x="8" y="8" rx="2" ry="2" />
                                        <path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2" />
                                    </svg>
                                    <span x-text="copied ? @js(__('vibe/settings.appearance.copied')) : @js(__('vibe/settings.appearance.copy_css'))">{{ __('vibe/settings.appearance.copy_css') }}</span>
                                </vibe:button>
                            </div>
                        </div>
                    </div>

                    {{-- 1. Custom Primary Color (--primary, --primary-foreground, --ring) --}}
                    <div class="space-y-6 flex flex-col xl:flex-row items-start w-full gap-x-20">
                        <div class="space-y-1 max-w-lg w-full">
                            <div class="flex items-center gap-2">
                                <h3 class="font-semibold text-foreground text-base">{{ __('vibe/settings.appearance.primary_color_title') }}</h3>
                                <span class="text-[10px] font-medium px-2 py-0.5 rounded-full bg-primary/10 text-primary border border-primary/20">{{ __('vibe/settings.appearance.modes_badge') }}</span>
                            </div>
                            <p class="text-muted-foreground text-xs">{{ __('vibe/settings.appearance.primary_color_desc') }}</p>
                        </div>

                        <div class="space-y-4 w-full">
                            {{-- Preset Swatches --}}
                            <div class="flex items-center gap-2.5 flex-wrap">
                                <template x-for="color in primaryColors" :key="color.hex">
                                    <button 
                                        type="button" 
                                        @click="selectPrimaryColor(color.hex)"
                                        class="size-8 rounded-full transition-all duration-150 cursor-pointer shrink-0 shadow-2xs hover:scale-110 relative flex items-center justify-center"
                                        :style="{ backgroundColor: color.hex }"
                                        :class="customHex.toLowerCase() === color.hex.toLowerCase() ? 'ring-2 ring-offset-2 ring-primary scale-110 shadow-md' : 'hover:opacity-90'"
                                        :title="color.name"
                                    >
                                        <svg x-show="customHex.toLowerCase() === color.hex.toLowerCase()" class="size-4 text-white drop-shadow-sm" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                                            <polyline points="20 6 9 17 4 12" />
                                        </svg>
                                    </button>
                                </template>
                            </div>

                            {{-- Custom Color Input --}}
                            <div class="flex items-center gap-3 pt-1">
                                <span class="text-xs text-muted-foreground font-medium">{{ __('vibe/settings.appearance.custom_color_label') }}</span>
                                <div class="w-36">
                                    <vibe:input 
                                        size="sm" 
                                        prefix="#" 
                                        x-model="customHexInput" 
                                        @input="onHexInput($event.target.value)" 
                                        class="font-mono font-semibold uppercase" 
                                        placeholder="18181B" 
                                        maxlength="6" 
                                    />
                                </div>
                                <label 
                                    class="relative size-8 rounded-full ring-2 ring-offset-2 cursor-pointer shadow-xs transition-transform hover:scale-105 shrink-0 flex items-center justify-center overflow-hidden" 
                                    :style="{ backgroundColor: customHex, borderColor: customHex, '--tw-ring-color': customHex }"
                                    :title="@js(__('vibe/settings.appearance.color_picker_title'))"
                                >
                                    <input 
                                        type="color" 
                                        x-model="customHex" 
                                        @input.debounce.50ms="onColorPickerChange($event.target.value)" 
                                        class="opacity-0 absolute inset-0 size-full cursor-pointer" 
                                    />
                                </label>
                            </div>

                            
                        </div>
                    </div>

                    <vibe:separator />

                    {{-- 2. Interface Theme Mode & High Contrast --}}
                    <div class="space-y-6 flex flex-col xl:flex-row items-start w-full gap-x-20">
                        <div class="space-y-1 max-w-lg w-full">
                            <h3 class="font-semibold text-foreground text-base">{{ __('vibe/settings.appearance.theme_mode_title') }}</h3>
                            <p class="text-muted-foreground text-xs">{{ __('vibe/settings.appearance.theme_mode_desc') }}</p>
                        </div>

                        <div class="space-y-4 w-full">
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 max-w-2xl 2xl:max-w-3xl">
                                {{-- Card 1: System preference --}}
                                <button 
                                    type="button" 
                                    @click="setMode('system', $event)" 
                                    class="group text-left cursor-pointer transition-all duration-200"
                                >
                                    <div 
                                        class="relative w-full aspect-16/10 rounded-xl border p-1.5 transition-all overflow-hidden bg-card"
                                        :class="mode === 'system' ? 'border-primary ring-2 ring-primary/20 shadow-md' : 'border-border/80 hover:border-border hover:bg-muted/30'"
                                    >
                                        {{-- Mini window illustration (Split light & dark) --}}
                                        <div class="size-full rounded-lg overflow-hidden border border-border/60 flex flex-col bg-background">
                                            <div class="h-3.5 border-b border-border/40 flex items-center justify-between px-1.5 shrink-0 bg-muted/40">
                                                <div class="flex items-center gap-1">
                                                    <span class="size-1.5 rounded-full bg-red-400"></span>
                                                    <span class="size-1.5 rounded-full bg-amber-400"></span>
                                                    <span class="size-1.5 rounded-full bg-emerald-400"></span>
                                                </div>
                                            </div>
                                            <div class="flex-1 flex overflow-hidden">
                                                <div class="w-1/2 bg-white p-1.5 border-r border-zinc-200 flex gap-1.5">
                                                    <div class="w-1/4 h-full flex flex-col gap-1 py-0.5">
                                                        <div class="size-2 rounded-full bg-zinc-300"></div>
                                                        <div class="w-full h-1 bg-zinc-200 rounded-xs"></div>
                                                        <div class="w-3/4 h-1 bg-zinc-200 rounded-xs"></div>
                                                    </div>
                                                    <div class="flex-1 flex flex-col gap-1">
                                                        <span class="text-[6.5px] font-bold text-zinc-700 leading-none">Dashboard</span>
                                                        <div class="flex-1 rounded-sm bg-zinc-100 border border-zinc-200/80"></div>
                                                    </div>
                                                </div>
                                                <div class="w-1/2 bg-zinc-900 p-1.5 flex gap-1.5">
                                                    <div class="w-full flex flex-col gap-1">
                                                        <div class="h-2 w-12 bg-zinc-800 rounded-xs"></div>
                                                        <div class="flex-1 rounded-sm bg-zinc-800/90 border border-zinc-700/60"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div x-show="mode === 'system'" class="absolute bottom-2 left-2 size-4.5 rounded-full bg-primary text-primary-foreground flex items-center justify-center shadow-xs">
                                            <svg class="size-2.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.5">
                                                <polyline points="20 6 9 17 4 12" />
                                            </svg>
                                        </div>
                                    </div>
                                    <span class="text-xs font-semibold text-foreground block pt-2">{{ __('vibe/settings.appearance.modes.system') }}</span>
                                </button>

                                {{-- Card 2: Light --}}
                                <button 
                                    type="button" 
                                    @click="setMode('light', $event)" 
                                    class="group text-left cursor-pointer transition-all duration-200"
                                >
                                    <div 
                                        class="relative w-full aspect-16/10 rounded-xl border p-1.5 transition-all overflow-hidden bg-card"
                                        :class="mode === 'light' ? 'border-primary ring-2 ring-primary/20 shadow-md' : 'border-border/80 hover:border-border hover:bg-muted/30'"
                                    >
                                        <div class="size-full rounded-lg overflow-hidden border border-zinc-200 flex flex-col bg-white">
                                            <div class="h-3.5 border-b border-zinc-200 flex items-center px-1.5 shrink-0 bg-zinc-50">
                                                <div class="flex items-center gap-1">
                                                    <span class="size-1.5 rounded-full bg-red-400"></span>
                                                    <span class="size-1.5 rounded-full bg-amber-400"></span>
                                                    <span class="size-1.5 rounded-full bg-emerald-400"></span>
                                                </div>
                                            </div>
                                            <div class="flex-1 flex p-1.5 gap-2">
                                                <div class="w-1/4 h-full flex flex-col gap-1 py-0.5 border-r border-zinc-100 pr-1">
                                                    <div class="size-2 rounded-full bg-zinc-300"></div>
                                                    <div class="w-full h-1 bg-zinc-200 rounded-xs"></div>
                                                    <div class="w-3/4 h-1 bg-zinc-200 rounded-xs"></div>
                                                </div>
                                                <div class="flex-1 flex flex-col gap-1.5">
                                                    <span class="text-[6.5px] font-bold text-zinc-700 leading-none">Dashboard</span>
                                                    <div class="flex-1 rounded-sm bg-zinc-100/90 border border-zinc-200/80"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div x-show="mode === 'light'" class="absolute bottom-2 left-2 size-4.5 rounded-full bg-primary text-primary-foreground flex items-center justify-center shadow-xs">
                                            <svg class="size-2.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.5">
                                                <polyline points="20 6 9 17 4 12" />
                                            </svg>
                                        </div>
                                    </div>
                                    <span class="text-xs font-semibold text-foreground block pt-2">{{ __('vibe/settings.appearance.modes.light') }}</span>
                                </button>

                                {{-- Card 3: Dark --}}
                                <button 
                                    type="button" 
                                    @click="setMode('dark', $event)" 
                                    class="group text-left cursor-pointer transition-all duration-200"
                                >
                                    <div 
                                        class="relative w-full aspect-16/10 rounded-xl border p-1.5 transition-all overflow-hidden bg-card"
                                        :class="mode === 'dark' ? 'border-primary ring-2 ring-primary/20 shadow-md' : 'border-border/80 hover:border-border hover:bg-muted/30'"
                                    >
                                        <div class="size-full rounded-lg overflow-hidden border border-zinc-800 flex flex-col bg-zinc-950">
                                            <div class="h-3.5 border-b border-zinc-800 flex items-center px-1.5 shrink-0 bg-zinc-900">
                                                <div class="flex items-center gap-1">
                                                    <span class="size-1.5 rounded-full bg-red-400"></span>
                                                    <span class="size-1.5 rounded-full bg-amber-400"></span>
                                                    <span class="size-1.5 rounded-full bg-emerald-400"></span>
                                                </div>
                                            </div>
                                            <div class="flex-1 flex p-1.5 gap-2">
                                                <div class="w-1/4 h-full flex flex-col gap-1 py-0.5 border-r border-zinc-800/80 pr-1">
                                                    <div class="size-2 rounded-full bg-zinc-700"></div>
                                                    <div class="w-full h-1 bg-zinc-800 rounded-xs"></div>
                                                    <div class="w-3/4 h-1 bg-zinc-800 rounded-xs"></div>
                                                </div>
                                                <div class="flex-1 flex flex-col gap-1.5">
                                                    <span class="text-[6.5px] font-bold text-zinc-300 leading-none">Dashboard</span>
                                                    <div class="flex-1 rounded-sm bg-zinc-900 border border-zinc-800"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div x-show="mode === 'dark'" class="absolute bottom-2 left-2 size-4.5 rounded-full bg-primary text-primary-foreground flex items-center justify-center shadow-xs">
                                            <svg class="size-2.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.5">
                                                <polyline points="20 6 9 17 4 12" />
                                            </svg>
                                        </div>
                                    </div>
                                    <span class="text-xs font-semibold text-foreground block pt-2">{{ __('vibe/settings.appearance.modes.dark') }}</span>
                                </button>
                            </div>

                            {{-- High Contrast Toggle --}}
                            <vibe:card class="max-w-2xl 2xl:max-w-3xl p-3.5 border border-border/80 bg-card hover:border-border transition-all shadow-2xs">
                                <div class="flex items-center gap-3">
                                    <div class="size-8 rounded-lg bg-primary/10 text-primary flex items-center justify-center shrink-0 ring-1 ring-primary/20">
                                        <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="10" />
                                            <path d="M12 18a6 6 0 0 0 0-12v12z" fill="currentColor" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <vibe:switch 
                                            :label="__('vibe/settings.appearance.high_contrast_label')" 
                                            :description="__('vibe/settings.appearance.high_contrast_desc')" 
                                            labelPlacement="justify" 
                                            size="sm" 
                                            x-model="highContrast" 
                                            @change="toggleHighContrast($el.checked)" 
                                        />
                                    </div>
                                </div>
                            </vibe:card>
                        </div>
                    </div>

                    <vibe:separator />

                    {{-- 3. Canvas & Surface Palette (--background, --card, --popover) --}}
                    <div class="space-y-6 flex flex-col xl:flex-row items-start w-full gap-x-20">
                        <div class="space-y-1 max-w-lg w-full">
                            <div class="flex items-center gap-2">
                                <h3 class="font-semibold text-foreground text-base">{{ __('vibe/settings.appearance.canvas_title') }}</h3>
                                <span class="text-[10px] font-medium px-2 py-0.5 rounded-full border transition-colors" :class="isDarkNow ? 'bg-zinc-900 text-zinc-200 border-zinc-700' : 'bg-amber-100/70 text-amber-900 border-amber-300'" x-text="isDarkNow ? @js(__('vibe/settings.appearance.modes.dark')) : @js(__('vibe/settings.appearance.modes.light'))"></span>
                            </div>
                            <p class="text-muted-foreground text-xs">{{ __('vibe/settings.appearance.canvas_desc') }}</p>
                        </div>

                        <div class="space-y-3 w-full max-w-2xl 2xl:max-w-3xl">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <template x-for="surface in surfacePresets" :key="surface.id">
                                    <button 
                                        type="button" 
                                        @click="selectSurfacePreset(surface.id)"
                                        class="p-3 rounded-xl border text-left flex items-start gap-3 transition-all cursor-pointer group"
                                       :class="selectedSurface === surface.id ? 'border-primary bg-primary/5 ring-1 ring-primary' : 'border-border/80 bg-card hover:bg-muted/40'"
                                    >
                                        {{-- Visual Surface Preview Dot --}}
                                        <div class="size-9 rounded-lg border border-border/80 p-1 flex items-center justify-center shrink-0 shadow-2xs" :style="{ backgroundColor: isDarkNow ? surface.dark.bg : surface.light.bg }">
                                            <div class="size-4 rounded-sm border border-border/60 shadow-2xs" :style="{ backgroundColor: isDarkNow ? surface.dark.card : surface.light.card }"></div>
                                        </div>

                                        <div class="min-w-0 flex-1">
                                            <div class="flex items-center justify-between">
                                                <span class="text-xs font-bold text-foreground" x-text="surfacePresetsI18n[surface.id]?.name || surface.name"></span>
                                                <span x-show="selectedSurface === surface.id" class="text-primary font-bold text-xs">&check;</span>
                                            </div>
                                            <p class="text-[11px] text-muted-foreground mt-0.5 leading-snug" x-text="surfacePresetsI18n[surface.id]?.desc || surface.desc"></p>
                                        </div>
                                    </button>
                                </template>
                            </div>
                        </div>
                    </div>

                    <vibe:separator />

                    {{-- 4. Desktop Sidebar (--sidebar, --sidebar-border, --sidebar-accent) --}}
                    <div class="space-y-6 flex flex-col xl:flex-row items-start w-full gap-x-20">
                        <div class="space-y-1 max-w-lg w-full">
                            <div class="flex items-center gap-2">
                                <h3 class="font-semibold text-foreground text-base">{{ __('vibe/settings.appearance.desktop_sidebar_title') }}</h3>
                                <span class="text-[10px] font-medium px-2 py-0.5 rounded-full border transition-colors" :class="isDarkNow ? 'bg-zinc-900 text-zinc-200 border-zinc-700' : 'bg-amber-100/70 text-amber-900 border-amber-300'" x-text="isDarkNow ? @js(__('vibe/settings.appearance.modes.dark')) : @js(__('vibe/settings.appearance.modes.light'))"></span>
                            </div>
                            <p class="text-muted-foreground text-xs">{{ __('vibe/settings.appearance.sidebar_desc') }}</p>
                        </div>

                        <div class="space-y-4 w-full max-w-xl">

                            {{-- Sidebar Style Cards --}}
                            <div class="space-y-2">
                                <label class="text-xs font-semibold text-foreground block">{{ __('vibe/settings.appearance.sidebar_surface_style') }}</label>
                                <div class="grid grid-cols-2 sm:grid-cols-3 gap-2.5">
                                    <template x-for="st in sidebarStyles" :key="st.id">
                                        <vibe:button 
                                            type="button" 
                                            variant="outline" 
                                            size="sm" 
                                            @click="selectSidebarStyle(st.id)"
                                            class="h-auto py-2.5 text-xs font-medium justify-center transition-all"
                                            x-bind:class="sidebarStyle === st.id ? 'border-primary bg-primary/10 text-primary font-semibold ring-1 ring-primary hover:bg-primary/15' : 'border-border/80 text-muted-foreground hover:text-foreground hover:bg-muted/40'"
                                            x-text="styleNames[st.id] || st.name"
                                        >
                                        </vibe:button>
                                    </template>
                                </div>
                            </div>

                            {{-- Custom Sidebar Color Picker (Shown when style is 'custom') --}}
                            <vibe:card x-show="sidebarStyle === 'custom'" x-cloak class="p-3.5 border border-primary/30 bg-primary/5 space-y-3">
                                <span class="text-xs font-semibold text-foreground block">{{ __('vibe/settings.appearance.sidebar_title') }}</span>
                                
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    {{-- Sidebar Background --}}
                                    <div class="space-y-1">
                                        <label class="text-[11px] text-muted-foreground font-medium block">{{ __('vibe/settings.appearance.background_color') }} (<code class="text-[10px] font-mono">--sidebar</code>)</label>
                                        <div class="flex items-center gap-2">
                                            <label 
                                                class="relative size-7 rounded-lg ring-1 ring-border cursor-pointer shadow-2xs shrink-0 overflow-hidden"
                                                :style="{ backgroundColor: sidebarCustomBg }"
                                            >
                                                <input 
                                                    type="color" 
                                                    x-model="sidebarCustomBg" 
                                                    @input.debounce.50ms="onSidebarCustomBgChange($event.target.value)" 
                                                    class="opacity-0 absolute inset-0 size-full cursor-pointer" 
                                                />
                                            </label>
                                            <div class="w-28">
                                                <vibe:input 
                                                    size="sm" 
                                                    prefix="#" 
                                                    x-model="sidebarCustomBgInput" 
                                                    @input="onSidebarCustomBgInput($event.target.value)" 
                                                    class="font-mono font-semibold uppercase" 
                                                    maxlength="6" 
                                                />
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Sidebar Border --}}
                                    <div class="space-y-1">
                                        <label class="text-[11px] text-muted-foreground font-medium block">{{ __('vibe/settings.appearance.border_color') }} (<code class="text-[10px] font-mono">--sidebar-border</code>)</label>
                                        <div class="flex items-center gap-2">
                                            <label 
                                                class="relative size-7 rounded-lg ring-1 ring-border cursor-pointer shadow-2xs shrink-0 overflow-hidden"
                                                :style="{ backgroundColor: sidebarCustomBorder }"
                                            >
                                                <input 
                                                    type="color" 
                                                    x-model="sidebarCustomBorder" 
                                                    @input.debounce.50ms="onSidebarCustomBorderChange($event.target.value)" 
                                                    class="opacity-0 absolute inset-0 size-full cursor-pointer" 
                                                />
                                            </label>
                                            <div class="w-28">
                                                <vibe:input 
                                                    size="sm" 
                                                    prefix="#" 
                                                    x-model="sidebarCustomBorderInput" 
                                                    @input="onSidebarCustomBorderInput($event.target.value)" 
                                                    class="font-mono font-semibold uppercase" 
                                                    maxlength="6" 
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </vibe:card>

                            {{-- Sidebar Border Mode --}}
                            <div class="space-y-1.5">
                                <label class="text-xs font-semibold text-foreground block">{{ __('vibe/settings.appearance.sidebar_border_mode_label') }}</label>
                                <div class="grid grid-cols-3 gap-2">
                                    <vibe:button 
                                        type="button" 
                                        variant="outline" 
                                        size="sm" 
                                        @click="selectSidebarBorderMode('default')" 
                                        class="text-xs justify-center transition-all"
                                        x-bind:class="sidebarBorderMode === 'default' ? 'border-primary bg-primary/10 text-primary font-semibold ring-1 ring-primary hover:bg-primary/15' : 'border-border/80 text-muted-foreground hover:text-foreground'"
                                    >
                                        {{ __('vibe/settings.appearance.border_mode.default') }}
                                    </vibe:button>
                                    <vibe:button 
                                        type="button" 
                                        variant="outline" 
                                        size="sm" 
                                        @click="selectSidebarBorderMode('none')" 
                                        class="text-xs justify-center transition-all"
                                        x-bind:class="sidebarBorderMode === 'none' ? 'border-primary bg-primary/10 text-primary font-semibold ring-1 ring-primary hover:bg-primary/15' : 'border-border/80 text-muted-foreground hover:text-foreground'"
                                    >
                                        {{ __('vibe/settings.appearance.border_mode.none') }}
                                    </vibe:button>
                                    <vibe:button 
                                        type="button" 
                                        variant="outline" 
                                        size="sm" 
                                        @click="selectSidebarBorderMode('high')" 
                                        class="text-xs justify-center transition-all"
                                        x-bind:class="sidebarBorderMode === 'high' ? 'border-primary bg-primary/10 text-primary font-semibold ring-1 ring-primary hover:bg-primary/15' : 'border-border/80 text-muted-foreground hover:text-foreground'"
                                    >
                                        {{ __('vibe/settings.appearance.border_mode.high') }}
                                    </vibe:button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <vibe:separator />

                    {{-- 5. Navigation Items (--nav-active-bg, --nav-active-fg, --nav-indicator) --}}
                    <div class="space-y-6 flex flex-col xl:flex-row items-start w-full gap-x-20">
                        <div class="space-y-1 max-w-lg w-full">
                            <div class="flex items-center gap-2">
                                <h3 class="font-semibold text-foreground text-base">{{ __('vibe/settings.appearance.nav_title') }}</h3>
                                <span class="text-[10px] font-medium px-2 py-0.5 rounded-full border transition-colors" :class="isDarkNow ? 'bg-zinc-900 text-zinc-200 border-zinc-700' : 'bg-amber-100/70 text-amber-900 border-amber-300'" x-text="isDarkNow ? @js(__('vibe/settings.appearance.modes.dark')) : @js(__('vibe/settings.appearance.modes.light'))"></span>
                            </div>
                            <p class="text-muted-foreground text-xs">{{ __('vibe/settings.appearance.nav_desc') }}</p>
                        </div>

                        <div class="space-y-4 w-full max-w-xl">
                            {{-- Nav Style Preset Cards --}}
                            <div class="space-y-2">
                                <label class="text-xs font-semibold text-foreground block">{{ __('vibe/settings.appearance.nav_style_label') }}</label>
                                <div class="grid grid-cols-2 sm:grid-cols-3 gap-2.5">
                                    <template x-for="st in navStyles" :key="st.id">
                                        <vibe:button 
                                            type="button" 
                                            variant="outline" 
                                            size="sm" 
                                            @click="selectNavStyle(st.id)"
                                            class="h-auto py-2.5 text-xs font-medium justify-center transition-all"
                                            x-bind:class="navStyle === st.id ? 'border-primary bg-primary/10 text-primary font-semibold ring-1 ring-primary hover:bg-primary/15' : 'border-border/80 text-muted-foreground hover:text-foreground hover:bg-muted/40'"
                                            x-text="styleNames[st.id] || st.name"
                                        >
                                        </vibe:button>
                                    </template>
                                </div>
                            </div>

                            {{-- Custom Nav Color Pickers (Shown when style is 'custom') --}}
                            <vibe:card x-show="navStyle === 'custom'" x-cloak class="p-3.5 border border-primary/30 bg-primary/5 space-y-3">
                                <span class="text-xs font-semibold text-foreground block">{{ __('vibe/settings.appearance.nav_custom_title') }}</span>
                                
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                    {{-- Nav Active Bg --}}
                                    <div class="space-y-1">
                                        <label class="text-[11px] text-muted-foreground font-medium block">{{ __('vibe/settings.appearance.nav_active_bg') }} (<code class="text-[10px] font-mono">--nav-active-bg</code>)</label>
                                        <div class="flex items-center gap-2">
                                            <label 
                                                class="relative size-7 rounded-lg ring-1 ring-border cursor-pointer shadow-2xs shrink-0 overflow-hidden"
                                                :style="{ backgroundColor: navCustomActiveBg }"
                                            >
                                                <input 
                                                    type="color" 
                                                    x-model="navCustomActiveBg" 
                                                    @input.debounce.50ms="onNavCustomActiveBgChange($event.target.value)" 
                                                    class="opacity-0 absolute inset-0 size-full cursor-pointer" 
                                                />
                                            </label>
                                            <div class="w-full">
                                                <vibe:input 
                                                    size="sm" 
                                                    prefix="#" 
                                                    x-model="navCustomActiveBgInput" 
                                                    @input="onNavCustomActiveBgInput($event.target.value)" 
                                                    class="font-mono font-semibold uppercase" 
                                                    maxlength="6" 
                                                />
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Nav Active Fg --}}
                                    <div class="space-y-1">
                                        <label class="text-[11px] text-muted-foreground font-medium block">{{ __('vibe/settings.appearance.nav_active_fg') }} (<code class="text-[10px] font-mono">--nav-active-fg</code>)</label>
                                        <div class="flex items-center gap-2">
                                            <label 
                                                class="relative size-7 rounded-lg ring-1 ring-border cursor-pointer shadow-2xs shrink-0 overflow-hidden"
                                                :style="{ backgroundColor: navCustomActiveFg }"
                                            >
                                                <input 
                                                    type="color" 
                                                    x-model="navCustomActiveFg" 
                                                    @input.debounce.50ms="onNavCustomActiveFgChange($event.target.value)" 
                                                    class="opacity-0 absolute inset-0 size-full cursor-pointer" 
                                                />
                                            </label>
                                            <div class="w-full">
                                                <vibe:input 
                                                    size="sm" 
                                                    prefix="#" 
                                                    x-model="navCustomActiveFgInput" 
                                                    @input="onNavCustomActiveFgInput($event.target.value)" 
                                                    class="font-mono font-semibold uppercase" 
                                                    maxlength="6" 
                                                />
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Nav Indicator Color --}}
                                    <div class="space-y-1">
                                        <label class="text-[11px] text-muted-foreground font-medium block">{{ __('vibe/settings.appearance.nav_indicator') }} (<code class="text-[10px] font-mono">--nav-indicator</code>)</label>
                                        <div class="flex items-center gap-2">
                                            <label 
                                                class="relative size-7 rounded-lg ring-1 ring-border cursor-pointer shadow-2xs shrink-0 overflow-hidden"
                                                :style="{ backgroundColor: navCustomIndicator }"
                                            >
                                                <input 
                                                    type="color" 
                                                    x-model="navCustomIndicator" 
                                                    @input.debounce.50ms="onNavCustomIndicatorChange($event.target.value)" 
                                                    class="opacity-0 absolute inset-0 size-full cursor-pointer" 
                                                />
                                            </label>
                                            <div class="w-full">
                                                <vibe:input 
                                                    size="sm" 
                                                    prefix="#" 
                                                    x-model="navCustomIndicatorInput" 
                                                    @input="onNavCustomIndicatorInput($event.target.value)" 
                                                    class="font-mono font-semibold uppercase" 
                                                    maxlength="6" 
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </vibe:card>

                            {{-- Nav Density Options --}}
                            <div class="space-y-1.5">
                                <label class="text-xs font-semibold text-foreground block">{{ __('vibe/settings.appearance.nav_density_label') }}</label>
                                <div class="grid grid-cols-3 gap-2">
                                    <vibe:button 
                                        type="button" 
                                        variant="outline" 
                                        size="sm" 
                                        @click="selectNavDensity('compact')" 
                                        class="text-xs justify-center transition-all"
                                        x-bind:class="navDensity === 'compact' ? 'border-primary bg-primary/10 text-primary font-semibold ring-1 ring-primary hover:bg-primary/15' : 'border-border/80 text-muted-foreground hover:text-foreground'"
                                    >
                                        {{ __('vibe/settings.appearance.nav_density.compact') }}
                                    </vibe:button>
                                    <vibe:button 
                                        type="button" 
                                        variant="outline" 
                                        size="sm" 
                                        @click="selectNavDensity('default')" 
                                        class="text-xs justify-center transition-all"
                                        x-bind:class="navDensity === 'default' ? 'border-primary bg-primary/10 text-primary font-semibold ring-1 ring-primary hover:bg-primary/15' : 'border-border/80 text-muted-foreground hover:text-foreground'"
                                    >
                                        {{ __('vibe/settings.appearance.nav_density.default') }}
                                    </vibe:button>
                                    <vibe:button 
                                        type="button" 
                                        variant="outline" 
                                        size="sm" 
                                        @click="selectNavDensity('relaxed')" 
                                        class="text-xs justify-center transition-all"
                                        x-bind:class="navDensity === 'relaxed' ? 'border-primary bg-primary/10 text-primary font-semibold ring-1 ring-primary hover:bg-primary/15' : 'border-border/80 text-muted-foreground hover:text-foreground'"
                                    >
                                        {{ __('vibe/settings.appearance.nav_density.relaxed') }}
                                    </vibe:button>
                                </div>
                            </div>

                            {{-- Active Indicator Switch --}}
                            <vibe:card class="p-3.5 border border-border/80 bg-card">
                                <vibe:switch 
                                    :label="__('vibe/settings.appearance.nav_indicator_label')" 
                                    :description="__('vibe/settings.appearance.nav_indicator_desc')" 
                                    labelPlacement="justify" 
                                    size="md" 
                                    x-model="navIndicator" 
                                    @change="toggleNavIndicator($el.checked)" 
                                />
                            </vibe:card>
                        </div>
                    </div>

                    <vibe:separator />

                    {{-- 6. Application Header (--header, --header-border, --header-accent) --}}
                    <div class="space-y-6 flex flex-col xl:flex-row items-start w-full gap-x-20">
                        <div class="space-y-1 max-w-lg w-full">
                            <div class="flex items-center gap-2">
                                <h3 class="font-semibold text-foreground text-base">{{ __('vibe/settings.appearance.desktop_header_title') }}</h3>
                                <span class="text-[10px] font-medium px-2 py-0.5 rounded-full border transition-colors" :class="isDarkNow ? 'bg-zinc-900 text-zinc-200 border-zinc-700' : 'bg-amber-100/70 text-amber-900 border-amber-300'" x-text="isDarkNow ? @js(__('vibe/settings.appearance.modes.dark')) : @js(__('vibe/settings.appearance.modes.light'))"></span>
                            </div>
                            <p class="text-muted-foreground text-xs">{{ __('vibe/settings.appearance.header_desc') }}</p>
                        </div>

                        <div class="space-y-4 w-full max-w-xl">
                            {{-- Header Blur Glassmorphism Switch --}}
                            <vibe:card class="p-3.5 border border-border/80 bg-card">
                                <vibe:switch 
                                    :label="__('vibe/settings.appearance.header_blur_label')" 
                                    :description="__('vibe/settings.appearance.header_blur_desc')" 
                                    labelPlacement="justify" 
                                    size="md" 
                                    x-model="headerGlassEffect" 
                                    @change="toggleHeaderGlassEffect($el.checked)" 
                                />
                            </vibe:card>

                            {{-- Header Style Cards --}}
                            <div class="space-y-2">
                                <label class="text-xs font-semibold text-foreground block">{{ __('vibe/settings.appearance.header_surface_style') }}</label>
                                <div class="grid grid-cols-2 sm:grid-cols-3 gap-2.5">
                                    <template x-for="st in headerStyles" :key="st.id">
                                        <vibe:button 
                                            type="button" 
                                            variant="outline" 
                                            size="sm" 
                                            @click="selectHeaderStyle(st.id)"
                                            class="h-auto py-2.5 text-xs font-medium justify-center transition-all"
                                            x-bind:class="headerStyle === st.id ? 'border-primary bg-primary/10 text-primary font-semibold ring-1 ring-primary hover:bg-primary/15' : 'border-border/80 text-muted-foreground hover:text-foreground hover:bg-muted/40'"
                                            x-text="styleNames[st.id] || st.name"
                                        >
                                        </vibe:button>
                                    </template>
                                </div>
                            </div>

                            {{-- Custom Header Color Picker (Shown when style is 'custom') --}}
                            <vibe:card x-show="headerStyle === 'custom'" x-cloak class="p-3.5 border border-primary/30 bg-primary/5 space-y-3">
                                <span class="text-xs font-semibold text-foreground block">{{ __('vibe/settings.appearance.header_title') }}</span>
                                
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    {{-- Header Background --}}
                                    <div class="space-y-1">
                                        <label class="text-[11px] text-muted-foreground font-medium block">{{ __('vibe/settings.appearance.background_color') }} (<code class="text-[10px] font-mono">--header</code>)</label>
                                        <div class="flex items-center gap-2">
                                            <label 
                                                class="relative size-7 rounded-lg ring-1 ring-border cursor-pointer shadow-2xs shrink-0 overflow-hidden"
                                                :style="{ backgroundColor: headerCustomBg }"
                                            >
                                                <input 
                                                    type="color" 
                                                    x-model="headerCustomBg" 
                                                    @input.debounce.50ms="onHeaderCustomBgChange($event.target.value)" 
                                                    class="opacity-0 absolute inset-0 size-full cursor-pointer" 
                                                />
                                            </label>
                                            <div class="w-28">
                                                <vibe:input 
                                                    size="sm" 
                                                    prefix="#" 
                                                    x-model="headerCustomBgInput" 
                                                    @input="onHeaderCustomBgInput($event.target.value)" 
                                                    class="font-mono font-semibold uppercase" 
                                                    maxlength="6" 
                                                />
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Header Border --}}
                                    <div class="space-y-1">
                                        <label class="text-[11px] text-muted-foreground font-medium block">{{ __('vibe/settings.appearance.border_color') }} (<code class="text-[10px] font-mono">--header-border</code>)</label>
                                        <div class="flex items-center gap-2">
                                            <label 
                                                class="relative size-7 rounded-lg ring-1 ring-border cursor-pointer shadow-2xs shrink-0 overflow-hidden"
                                                :style="{ backgroundColor: headerCustomBorder }"
                                            >
                                                <input 
                                                    type="color" 
                                                    x-model="headerCustomBorder" 
                                                    @input.debounce.50ms="onHeaderCustomBorderChange($event.target.value)" 
                                                    class="opacity-0 absolute inset-0 size-full cursor-pointer" 
                                                />
                                            </label>
                                            <div class="w-28">
                                                <vibe:input 
                                                    size="sm" 
                                                    prefix="#" 
                                                    x-model="headerCustomBorderInput" 
                                                    @input="onHeaderCustomBorderInput($event.target.value)" 
                                                    class="font-mono font-semibold uppercase" 
                                                    maxlength="6" 
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </vibe:card>

                            {{-- Header Border Mode --}}
                            <div class="space-y-1.5">
                                <label class="text-xs font-semibold text-foreground block">{{ __('vibe/settings.appearance.header_border_mode_label') }}</label>
                                <div class="grid grid-cols-3 gap-2">
                                    <vibe:button 
                                        type="button" 
                                        variant="outline" 
                                        size="sm" 
                                        @click="selectHeaderBorderMode('default')" 
                                        class="text-xs justify-center transition-all"
                                        x-bind:class="headerBorderMode === 'default' ? 'border-primary bg-primary/10 text-primary font-semibold ring-1 ring-primary hover:bg-primary/15' : 'border-border/80 text-muted-foreground hover:text-foreground'"
                                    >
                                        {{ __('vibe/settings.appearance.border_mode.default') }}
                                    </vibe:button>
                                    <vibe:button 
                                        type="button" 
                                        variant="outline" 
                                        size="sm" 
                                        @click="selectHeaderBorderMode('none')" 
                                        class="text-xs justify-center transition-all"
                                        x-bind:class="headerBorderMode === 'none' ? 'border-primary bg-primary/10 text-primary font-semibold ring-1 ring-primary hover:bg-primary/15' : 'border-border/80 text-muted-foreground hover:text-foreground'"
                                    >
                                        {{ __('vibe/settings.appearance.border_mode.none') }}
                                    </vibe:button>
                                    <vibe:button 
                                        type="button" 
                                        variant="outline" 
                                        size="sm" 
                                        @click="selectHeaderBorderMode('high')" 
                                        class="text-xs justify-center transition-all"
                                        x-bind:class="headerBorderMode === 'high' ? 'border-primary bg-primary/10 text-primary font-semibold ring-1 ring-primary hover:bg-primary/15' : 'border-border/80 text-muted-foreground hover:text-foreground'"
                                    >
                                        {{ __('vibe/settings.appearance.border_mode.high') }}
                                    </vibe:button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <vibe:separator />

                    {{-- 7. Semantic Status Colors (--success, --warning, --destructive, --info) --}}
                    <div class="space-y-6 flex flex-col xl:flex-row items-start w-full gap-x-20">
                        <div class="space-y-1 max-w-lg w-full">
                            <h3 class="font-semibold text-foreground text-base">{{ __('vibe/settings.appearance.semantic_title') }}</h3>
                            <p class="text-muted-foreground text-xs">{{ __('vibe/settings.appearance.semantic_desc') }}</p>
                        </div>

                        <div class="space-y-4 w-full max-w-xl">
                            {{-- Preset Status Themes --}}
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                <template x-for="st in semanticPresets" :key="st.id">
                                    <button 
                                        type="button" 
                                        @click="selectSemanticPreset(st.id)"
                                        class="p-3 rounded-xl border text-left transition-all cursor-pointer group"
                                        :class="selectedSemantic === st.id ? 'border-primary bg-primary/5 ring-1 ring-primary' : 'border-border/80 bg-card hover:bg-muted/40'"
                                    >
                                        <div class="flex items-center justify-between mb-2">
                                            <span class="text-xs font-semibold text-foreground" x-text="st.name"></span>
                                            <span x-show="selectedSemantic === st.id" class="text-primary font-bold text-xs">&check;</span>
                                        </div>
                                        {{-- 4 status dots --}}
                                        <div class="flex items-center gap-1.5">
                                            <span class="size-4 rounded-full shadow-2xs" :style="{ backgroundColor: st.colors.success }"></span>
                                            <span class="size-4 rounded-full shadow-2xs" :style="{ backgroundColor: st.colors.warning }"></span>
                                            <span class="size-4 rounded-full shadow-2xs" :style="{ backgroundColor: st.colors.destructive }"></span>
                                            <span class="size-4 rounded-full shadow-2xs" :style="{ backgroundColor: st.colors.info }"></span>
                                        </div>
                                    </button>
                                </template>
                            </div>

                            {{-- Live Badge Preview --}}
                            <vibe:card variant="muted" class="p-3 border border-border/60 flex flex-wrap items-center gap-2">
                                <vibe:badge variant="success" class="rounded-full shadow-2xs font-medium" x-bind:style="{ backgroundColor: currentSemanticColors.success, color: '#ffffff' }">{{ __('vibe/settings.appearance.status_success') }}</vibe:badge>
                                <vibe:badge variant="warning" class="rounded-full shadow-2xs font-medium" x-bind:style="{ backgroundColor: currentSemanticColors.warning, color: '#ffffff' }">{{ __('vibe/settings.appearance.status_warning') }}</vibe:badge>
                                <vibe:badge variant="destructive" class="rounded-full shadow-2xs font-medium" x-bind:style="{ backgroundColor: currentSemanticColors.destructive, color: '#ffffff' }">{{ __('vibe/settings.appearance.status_destructive') }}</vibe:badge>
                                <vibe:badge variant="info" class="rounded-full shadow-2xs font-medium" x-bind:style="{ backgroundColor: currentSemanticColors.info, color: '#ffffff' }">{{ __('vibe/settings.appearance.status_info') }}</vibe:badge>
                            </vibe:card>
                        </div>
                    </div>

                    <vibe:separator />

                    {{-- 8. Data Charts Palette (--chart-1 s/d --chart-5) --}}
                    <div class="space-y-6 flex flex-col xl:flex-row items-start w-full gap-x-20">
                        <div class="space-y-1 max-w-lg w-full">
                            <h3 class="font-semibold text-foreground text-base">{{ __('vibe/settings.appearance.charts_title') }}</h3>
                            <p class="text-muted-foreground text-xs">{{ __('vibe/settings.appearance.charts_desc') }}</p>
                        </div>

                        <div class="space-y-4 w-full max-w-xl">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <template x-for="ch in chartPresets" :key="ch.id">
                                    <button 
                                        type="button" 
                                        @click="selectChartPreset(ch.id)"
                                        class="p-3 rounded-xl border text-left transition-all cursor-pointer group"
                                        :class="selectedChartPreset === ch.id ? 'border-primary bg-primary/5 ring-1 ring-primary' : 'border-border/80 bg-card hover:bg-muted/40'"
                                    >
                                        <div class="flex items-center justify-between mb-2">
                                            <span class="text-xs font-semibold text-foreground" x-text="ch.name"></span>
                                            <span x-show="selectedChartPreset === ch.id" class="text-primary font-bold text-xs">&check;</span>
                                        </div>
                                        {{-- 5-bar palette preview --}}
                                        <div class="h-3.5 w-full rounded-md flex overflow-hidden shadow-2xs">
                                            <div class="w-1/5 h-full" :style="{ backgroundColor: ch.colors[0] }"></div>
                                            <div class="w-1/5 h-full" :style="{ backgroundColor: ch.colors[1] }"></div>
                                            <div class="w-1/5 h-full" :style="{ backgroundColor: ch.colors[2] }"></div>
                                            <div class="w-1/5 h-full" :style="{ backgroundColor: ch.colors[3] }"></div>
                                            <div class="w-1/5 h-full" :style="{ backgroundColor: ch.colors[4] }"></div>
                                        </div>
                                    </button>
                                </template>
                            </div>
                        </div>
                    </div>

                    <vibe:separator />

                    {{-- 9. Border Radius (--radius, --radius-xs s/d --radius-3xl) --}}
                    <div class="space-y-6 flex flex-col xl:flex-row items-start w-full gap-x-20">
                        <div class="space-y-1 max-w-lg w-full">
                            <h3 class="font-semibold text-foreground text-base">{{ __('vibe/settings.appearance.radius_title') }}</h3>
                            <p class="text-muted-foreground text-xs">{{ __('vibe/settings.appearance.radius_desc') }}</p>
                        </div>

                        <div class="space-y-3 w-full max-w-xl">
                            <div class="grid grid-cols-2 sm:grid-cols-5 gap-2.5">
                                <template x-for="r in radii" :key="r.value">
                                    <button 
                                        type="button" 
                                        @click="selectRadius(r.value)"
                                        class="p-2.5 rounded-xl border text-left flex flex-col items-center gap-2 transition-all cursor-pointer group"
                                        :class="selectedRadius === r.value ? 'border-primary bg-primary/5 ring-1 ring-primary' : 'border-border/80 bg-card hover:bg-muted/40'"
                                    >
                                        <div 
                                            class="size-8 border-2 border-dashed border-primary/60 bg-primary/10 transition-all"
                                            :style="{ borderRadius: r.value }"
                                        ></div>
                                        <div class="text-center">
                                            <span class="text-xs font-semibold text-foreground block" x-text="radiiLabels[r.value] || r.label"></span>
                                            <span class="text-[10px] text-muted-foreground font-mono" x-text="r.value"></span>
                                        </div>
                                    </button>
                                </template>
                            </div>
                        </div>
                    </div>

                    <vibe:separator />

                    {{-- 10. Typography (--font-sans) --}}
                    <div class="space-y-6 flex flex-col xl:flex-row items-start w-full gap-x-20">
                        <div class="space-y-1 max-w-lg w-full">
                            <h3 class="font-semibold text-foreground text-base">{{ __('vibe/settings.appearance.font_title') }}</h3>
                            <p class="text-muted-foreground text-xs">{{ __('vibe/settings.appearance.font_desc') }}</p>
                        </div>

                        <div class="space-y-3 w-full max-w-xl">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <template x-for="f in fonts" :key="f.name">
                                    <button 
                                        type="button" 
                                        @click="selectFont(f.name, f.value)"
                                        class="p-3.5 rounded-xl border text-left flex items-start justify-between gap-3 transition-all cursor-pointer group"
                                        :class="selectedFontName === f.name ? 'border-primary bg-primary/5 ring-1 ring-primary' : 'border-border/80 bg-card hover:bg-muted/40'"
                                    >
                                        <div class="space-y-0.5 min-w-0">
                                            <div class="flex items-center gap-2">
                                                <span class="text-sm font-bold text-foreground" :style="{ fontFamily: f.value }" x-text="f.name"></span>
                                                <vibe:badge size="sm" variant="primary" class="rounded-full" x-show="f.name === 'Figtree'">{{ __('vibe/settings.appearance.default_badge') }}</vibe:badge>
                                            </div>
                                            <p class="text-[11px] text-muted-foreground" x-text="fontsI18n[f.name] || f.desc"></p>
                                            <span class="text-xs text-foreground/80 block pt-1 font-mono tracking-tight" :style="{ fontFamily: f.value }">
                                                Aa Bb Gg 123
                                            </span>
                                        </div>

                                        <div 
                                            class="size-4.5 rounded-full border flex items-center justify-center shrink-0 mt-0.5 transition-colors"
                                            :class="selectedFontName === f.name ? 'border-primary bg-primary text-primary-foreground' : 'border-border/80 bg-muted/40'"
                                        >
                                            <svg x-show="selectedFontName === f.name" class="size-2.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                                                <polyline points="20 6 9 17 4 12" />
                                            </svg>
                                        </div>
                                    </button>
                                </template>
                            </div>
                        </div>
                    </div>

                    <vibe:separator />

                    {{-- 11. Tables View & Custom Colors --}}
                    <div class="space-y-6 flex flex-col xl:flex-row items-start w-full gap-x-20">
                        <div class="space-y-1 max-w-lg w-full">
                            <div class="flex items-center gap-2">
                                <h3 class="font-semibold text-foreground text-base">{{ __('vibe/settings.appearance.table_title') }}</h3>
                                <span class="text-[10px] font-medium px-2 py-0.5 rounded-full border transition-colors" :class="isDarkNow ? 'bg-zinc-900 text-zinc-200 border-zinc-700' : 'bg-amber-100/70 text-amber-900 border-amber-300'" x-text="isDarkNow ? @js(__('vibe/settings.appearance.modes.dark')) : @js(__('vibe/settings.appearance.modes.light'))"></span>
                            </div>
                            <p class="text-muted-foreground text-xs">{{ __('vibe/settings.appearance.table_desc') }}</p>
                        </div>

                        <div class="space-y-5 w-full max-w-xl">
                            {{-- Density Cards --}}
                            <div class="space-y-2">
                                <label class="text-xs font-semibold text-foreground block">{{ __('vibe/settings.appearance.table_density_label') }}</label>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 max-w-lg">
                                    {{-- Default Card --}}
                                    <button 
                                        type="button" 
                                        @click="setTablesView('default')" 
                                        class="group text-left cursor-pointer transition-all duration-200"
                                    >
                                        <div 
                                            class="relative w-full aspect-16/10 rounded-xl border p-2 transition-all overflow-hidden bg-card"
                                            :class="tablesView === 'default' ? 'border-primary ring-2 ring-primary/20 shadow-md' : 'border-border/80 hover:border-border hover:bg-muted/30'"
                                        >
                                            <div class="size-full rounded-lg overflow-hidden border border-table-border flex flex-col bg-background p-2">
                                                <div class="flex items-center justify-between pb-1.5 border-b border-table-border shrink-0 bg-table-header px-1.5 -mx-2 -mt-2 pt-1.5 rounded-t-lg">
                                                    <span class="text-[7.5px] font-bold text-table-header-foreground uppercase tracking-wider">{{ __('vibe/settings.appearance.table_demo.customer') }}</span>
                                                    <span class="h-2 w-7 bg-muted rounded-full"></span>
                                                </div>
                                                <div class="flex-1 flex flex-col justify-around py-0.5 divide-y divide-table-border/60">
                                                    <div class="flex items-center gap-1.5 py-0.5">
                                                        <span class="size-1.5 rounded-full bg-primary/70 shrink-0"></span>
                                                        <span class="h-1 w-10 bg-muted-foreground/30 rounded-xs"></span>
                                                        <span class="h-1 w-14 bg-muted-foreground/20 rounded-xs"></span>
                                                        <span class="h-1 w-8 bg-muted-foreground/20 rounded-xs ml-auto"></span>
                                                    </div>
                                                    <div class="flex items-center gap-1.5 py-0.5">
                                                        <span class="size-1.5 rounded-full bg-primary/70 shrink-0"></span>
                                                        <span class="h-1 w-12 bg-muted-foreground/30 rounded-xs"></span>
                                                        <span class="h-1 w-10 bg-muted-foreground/20 rounded-xs"></span>
                                                        <span class="h-1 w-6 bg-muted-foreground/20 rounded-xs ml-auto"></span>
                                                    </div>
                                                    <div class="flex items-center gap-1.5 py-0.5">
                                                        <span class="size-1.5 rounded-full bg-primary/70 shrink-0"></span>
                                                        <span class="h-1 w-9 bg-muted-foreground/30 rounded-xs"></span>
                                                        <span class="h-1 w-12 bg-muted-foreground/20 rounded-xs"></span>
                                                        <span class="h-1 w-7 bg-muted-foreground/20 rounded-xs ml-auto"></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div x-show="tablesView === 'default'" class="absolute bottom-2 left-2 size-4.5 rounded-full bg-primary text-primary-foreground flex items-center justify-center shadow-xs">
                                                <svg class="size-2.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.5">
                                                    <polyline points="20 6 9 17 4 12" />
                                                </svg>
                                            </div>
                                        </div>
                                        <span class="text-xs font-semibold text-foreground block pt-2">{{ __('vibe/settings.appearance.table_density.default') }}</span>
                                    </button>

                                    {{-- Compact Card --}}
                                    <button 
                                        type="button" 
                                        @click="setTablesView('compact')" 
                                        class="group text-left cursor-pointer transition-all duration-200"
                                    >
                                        <div 
                                            class="relative w-full aspect-16/10 rounded-xl border p-2 transition-all overflow-hidden bg-card"
                                            :class="tablesView === 'compact' ? 'border-primary ring-2 ring-primary/20 shadow-md' : 'border-border/80 hover:border-border hover:bg-muted/30'"
                                        >
                                            <div class="size-full rounded-lg overflow-hidden border border-table-border flex flex-col bg-background p-2">
                                                <div class="flex items-center justify-between pb-1 border-b border-table-border shrink-0 bg-table-header px-1.5 -mx-2 -mt-2 pt-1.5 rounded-t-lg">
                                                    <span class="text-[7.5px] font-bold text-table-header-foreground uppercase tracking-wider">{{ __('vibe/settings.appearance.table_demo.customer') }}</span>
                                                    <span class="h-2 w-7 bg-muted rounded-full"></span>
                                                </div>
                                                <div class="flex-1 flex flex-col justify-around py-0 divide-y divide-table-border/40">
                                                    <div class="flex items-center gap-1.5 py-px">
                                                        <span class="size-1 rounded-full bg-primary/70 shrink-0"></span>
                                                        <span class="h-0.75 w-10 bg-muted-foreground/30 rounded-xs"></span>
                                                        <span class="h-0.75 w-14 bg-muted-foreground/20 rounded-xs"></span>
                                                    </div>
                                                    <div class="flex items-center gap-1.5 py-px">
                                                        <span class="size-1 rounded-full bg-primary/70 shrink-0"></span>
                                                        <span class="h-0.75 w-12 bg-muted-foreground/30 rounded-xs"></span>
                                                        <span class="h-0.75 w-10 bg-muted-foreground/20 rounded-xs"></span>
                                                    </div>
                                                    <div class="flex items-center gap-1.5 py-px">
                                                        <span class="size-1 rounded-full bg-primary/70 shrink-0"></span>
                                                        <span class="h-0.75 w-9 bg-muted-foreground/30 rounded-xs"></span>
                                                        <span class="h-0.75 w-12 bg-muted-foreground/20 rounded-xs"></span>
                                                    </div>
                                                    <div class="flex items-center gap-1.5 py-px">
                                                        <span class="size-1 rounded-full bg-primary/70 shrink-0"></span>
                                                        <span class="h-0.75 w-11 bg-muted-foreground/30 rounded-xs"></span>
                                                        <span class="h-0.75 w-8 bg-muted-foreground/20 rounded-xs"></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div x-show="tablesView === 'compact'" class="absolute bottom-2 left-2 size-4.5 rounded-full bg-primary text-primary-foreground flex items-center justify-center shadow-xs">
                                                <svg class="size-2.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.5">
                                                    <polyline points="20 6 9 17 4 12" />
                                                </svg>
                                            </div>
                                        </div>
                                        <span class="text-xs font-semibold text-foreground block pt-2">{{ __('vibe/settings.appearance.table_density.compact') }}</span>
                                    </button>
                                </div>
                            </div>

                            {{-- Table Surface Style Presets --}}
                            <div class="space-y-2 pt-2">
                                <label class="text-xs font-semibold text-foreground block">{{ __('vibe/settings.appearance.table_surface_style') }}</label>
                                <div class="grid grid-cols-2 sm:grid-cols-3 gap-2.5">
                                    <template x-for="st in tableStyles" :key="st.id">
                                        <vibe:button 
                                            type="button" 
                                            variant="outline" 
                                            size="sm" 
                                            @click="selectTableStyle(st.id)" 
                                            class="h-auto py-2.5 text-xs font-medium justify-center transition-all cursor-pointer"
                                            x-bind:class="tableStyle === st.id ? 'border-primary bg-primary/10 text-primary font-semibold ring-1 ring-primary hover:bg-primary/15' : 'border-border/80 text-muted-foreground hover:text-foreground hover:bg-muted/40'"
                                            x-text="styleNames[st.id] || st.name"
                                        >
                                        </vibe:button>
                                    </template>
                                </div>
                            </div>

                            {{-- Custom Table Color Picker (Shown when tableStyle === 'custom') --}}
                            <vibe:card x-show="tableStyle === 'custom'" x-cloak class="p-3.5 border border-primary/30 bg-primary/5 space-y-3">
                                <span class="text-xs font-semibold text-foreground block">{{ __('vibe/settings.appearance.table_title') }}</span>
                                
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                    {{-- Table Header Background --}}
                                    <div class="space-y-1">
                                        <label class="text-[11px] text-muted-foreground font-medium block">{{ __('vibe/settings.appearance.table_header_bg') }} (<code class="text-[10px] font-mono">--table-header</code>)</label>
                                        <div class="flex items-center gap-2">
                                            <label 
                                                class="relative size-7 rounded-lg ring-1 ring-border cursor-pointer shadow-2xs shrink-0 overflow-hidden"
                                                :style="{ backgroundColor: tableCustomHeaderBg }"
                                            >
                                                <input 
                                                    type="color" 
                                                    x-model="tableCustomHeaderBg" 
                                                    @input.debounce.50ms="onTableCustomHeaderBgChange($event.target.value)" 
                                                    class="opacity-0 absolute inset-0 size-full cursor-pointer" 
                                                />
                                            </label>
                                            <div class="w-24">
                                                <vibe:input 
                                                    size="sm" 
                                                    prefix="#" 
                                                    x-model="tableCustomHeaderBgInput" 
                                                    @input="onTableCustomHeaderBgInput($event.target.value)" 
                                                    class="font-mono font-semibold uppercase text-xs" 
                                                    maxlength="6" 
                                                />
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Table Border --}}
                                    <div class="space-y-1">
                                        <label class="text-[11px] text-muted-foreground font-medium block">{{ __('vibe/settings.appearance.table_border') }} (<code class="text-[10px] font-mono">--table-border</code>)</label>
                                        <div class="flex items-center gap-2">
                                            <label 
                                                class="relative size-7 rounded-lg ring-1 ring-border cursor-pointer shadow-2xs shrink-0 overflow-hidden"
                                                :style="{ backgroundColor: tableCustomBorder }"
                                            >
                                                <input 
                                                    type="color" 
                                                    x-model="tableCustomBorder" 
                                                    @input.debounce.50ms="onTableCustomBorderChange($event.target.value)" 
                                                    class="opacity-0 absolute inset-0 size-full cursor-pointer" 
                                                />
                                            </label>
                                            <div class="w-24">
                                                <vibe:input 
                                                    size="sm" 
                                                    prefix="#" 
                                                    x-model="tableCustomBorderInput" 
                                                    @input="onTableCustomBorderInput($event.target.value)" 
                                                    class="font-mono font-semibold uppercase text-xs" 
                                                    maxlength="6" 
                                                />
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Table Row Hover --}}
                                    <div class="space-y-1">
                                        <label class="text-[11px] text-muted-foreground font-medium block">{{ __('vibe/settings.appearance.table_row_hover') }} (<code class="text-[10px] font-mono">--table-row-hover</code>)</label>
                                        <div class="flex items-center gap-2">
                                            <label 
                                                class="relative size-7 rounded-lg ring-1 ring-border cursor-pointer shadow-2xs shrink-0 overflow-hidden"
                                                :style="{ backgroundColor: tableCustomRowHover }"
                                            >
                                                <input 
                                                    type="color" 
                                                    x-model="tableCustomRowHover" 
                                                    @input.debounce.50ms="onTableCustomRowHoverChange($event.target.value)" 
                                                    class="opacity-0 absolute inset-0 size-full cursor-pointer" 
                                                />
                                            </label>
                                            <div class="w-24">
                                                <vibe:input 
                                                    size="sm" 
                                                    prefix="#" 
                                                    x-model="tableCustomRowHoverInput" 
                                                    @input="onTableCustomRowHoverInput($event.target.value)" 
                                                    class="font-mono font-semibold uppercase text-xs" 
                                                    maxlength="6" 
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </vibe:card>

                            {{-- Live Table Mini Preview --}}
                            <div class="space-y-2 pt-1">
                                <div class="flex items-center justify-between">
                                    <label class="text-xs font-semibold text-foreground block">{{ __('vibe/settings.appearance.table_preview_title') }}</label>
                                    <span class="text-[10px] text-muted-foreground">{{ __('vibe/settings.appearance.table_preview_desc') }}</span>
                                </div>
                                <div class="rounded-xl border border-table-border bg-card overflow-hidden shadow-2xs">
                                    <table class="w-full text-xs text-left border-collapse">
                                        <thead class="bg-table-header text-table-header-foreground border-b border-table-border font-semibold uppercase tracking-wider text-[10px]">
                                            <tr>
                                                <th class="py-2.5 px-3 w-8 text-center">
                                                    <vibe:checkbox checked disabled class="pointer-events-none" />
                                                </th>
                                                <th class="py-2.5 px-3">{{ __('vibe/settings.appearance.table_demo.customer') }}</th>
                                                <th class="py-2.5 px-3">{{ __('vibe/settings.appearance.table_demo.status') }}</th>
                                                <th class="py-2.5 px-3 text-right">{{ __('vibe/settings.appearance.table_demo.amount') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-table-border text-foreground">
                                            <tr class="transition-colors hover:bg-table-row-hover">
                                                <td class="py-2.5 px-3 text-center">
                                                    <vibe:checkbox disabled class="pointer-events-none" />
                                                </td>
                                                <td class="py-2.5 px-3 font-medium">Acme Corporation</td>
                                                <td class="py-2.5 px-3"><vibe:badge size="sm" variant="success" class="rounded-full">{{ __('vibe/settings.appearance.table_demo.completed') }}</vibe:badge></td>
                                                <td class="py-2.5 px-3 text-right font-mono">Rp 1.450.000</td>
                                            </tr>
                                            <tr class="transition-colors hover:bg-table-row-hover">
                                                <td class="py-2.5 px-3 text-center">
                                                    <vibe:checkbox disabled class="pointer-events-none" />
                                                </td>
                                                <td class="py-2.5 px-3 font-medium">Globex Industries</td>
                                                <td class="py-2.5 px-3"><vibe:badge size="sm" variant="warning" class="rounded-full">{{ __('vibe/settings.appearance.table_demo.pending') }}</vibe:badge></td>
                                                <td class="py-2.5 px-3 text-right font-mono">Rp 820.000</td>
                                            </tr>
                                        </tbody>
                                        <tfoot class="border-t border-table-border bg-table-footer text-table-header-foreground font-medium text-[10px] uppercase tracking-wider">
                                            <tr>
                                                <td colspan="3" class="py-2 px-3">{{ __('vibe/settings.appearance.table_demo.total_records', ['count' => 2]) }}</td>
                                                <td class="py-2 px-3 text-right font-mono font-bold text-foreground">Rp 2.270.000</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <vibe:separator />

                    {{-- 12. Motion & Visual Effects --}}
                    <div class="space-y-6 flex flex-col xl:flex-row items-start w-full gap-x-20">
                        <div class="space-y-1 max-w-lg w-full">
                            <h3 class="font-semibold text-foreground text-base">{{ __('vibe/settings.appearance.motion_title') }}</h3>
                            <p class="text-muted-foreground text-xs">{{ __('vibe/settings.appearance.motion_desc') }}</p>
                        </div>

                        <div class="space-y-3 w-full max-w-xl">
                            <vibe:card class="p-3.5 border border-border/80 bg-card">
                                <vibe:switch 
                                    :label="__('vibe/settings.appearance.motion_label')" 
                                    :description="__('vibe/settings.appearance.motion_desc_detail')" 
                                    labelPlacement="justify" 
                                    size="sm" 
                                    x-model="motionActive" 
                                    @change="toggleMotion($el.checked)" 
                                />
                            </vibe:card>

                            <vibe:card class="p-3.5 border border-border/80 bg-card">
                                <vibe:switch 
                                    :label="__('vibe/settings.appearance.glass_label')" 
                                    :description="__('vibe/settings.appearance.glass_desc')" 
                                    labelPlacement="justify" 
                                    size="sm" 
                                    x-model="glassEffect" 
                                    @change="toggleGlassEffect($el.checked)" 
                                />
                            </vibe:card>
                        </div>
                    </div>

                </div>
            </vibe:tabs>
        </vibe:card>
    </div>
</x-docs.layouts.sidebar>
