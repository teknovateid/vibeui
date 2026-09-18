<x-docs.layouts.sidebar>
    <vibe:seo :title="__('vibe/settings.title')" :description="__('vibe/settings.subtitle')" :breadcrumbs="[
        ['name' => __('vibe/settings.breadcrumb.home'), 'url' => '/'],
        ['name' => __('vibe/settings.breadcrumb.pages'), 'url' => '#'],
        ['name' => __('vibe/settings.breadcrumb.settings'), 'url' => route('docs.settings.account')],
        ['name' => __('vibe/settings.tabs.appearance.label'), 'url' => route('docs.settings.appearance')],
    ]" />

    <div class="mx-auto w-full space-y-6">
        <vibe:breadcrumb title="{!! __('vibe/settings.title') !!}">
            <vibe:breadcrumb.item href="{{ route('docs.index') }}">{{ __('vibe/settings.breadcrumb.home') }}</vibe:breadcrumb.item>
            <vibe:breadcrumb.item>{{ __('vibe/settings.breadcrumb.pages') }}</vibe:breadcrumb.item>
            <vibe:breadcrumb.item href="{{ route('docs.settings.account') }}">{{ __('vibe/settings.breadcrumb.settings') }}</vibe:breadcrumb.item>
            <vibe:breadcrumb.item active>{{ __('vibe/settings.tabs.appearance.label') }}</vibe:breadcrumb.item>
        </vibe:breadcrumb>

        <vibe:card class="p-0 overflow-hidden">
            <vibe:tabs selected="appearance" variant="sidebar" class="min-h-155">
                @include('docs.settings.tabs', ['active' => 'appearance'])

                <div class="flex-1 min-w-0 p-6 space-y-8" x-data="appearanceController()" x-init="init()">
                    {{-- Header with Status & Quick Actions --}}
                    <div class="pb-4 border-border/50 border-b">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            <div>
                                <div class="flex items-center gap-2">
                                    <h2 class="font-bold text-foreground text-lg">{{ __('vibe/settings.appearance.header_title') ?? 'Appearance & Theme Tokens' }}</h2>
                                    <vibe:badge variant="success" size="sm" class="rounded-full" dot dotPulse>
                                        Live Engine
                                    </vibe:badge>
                                </div>
                                <p class="mt-0.5 text-muted-foreground text-xs">
                                    Kustomisasi seluruh token desain warna (`vibe/app.css`), kanvas, tipografi, dan tata letak secara real-time.
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
                                    <span>Reset Bawaan</span>
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
                                    <span x-text="copied ? 'Tersalin!' : 'Salin CSS Tokens'">Salin CSS Tokens</span>
                                </vibe:button>
                            </div>
                        </div>
                    </div>

                    {{-- 1. Custom Primary Color (--primary, --primary-foreground, --ring) --}}
                    <div class="space-y-6 flex flex-col xl:flex-row items-start w-full gap-x-20">
                        <div class="space-y-1 max-w-lg w-full">
                            <h3 class="font-semibold text-foreground text-base">Custom primary color</h3>
                            <p class="text-muted-foreground text-xs">Mengatur token warna primer utama (<code class="font-mono text-[11px] text-primary">--primary</code>, <code class="font-mono text-[11px] text-primary">--ring</code>) untuk tombol, badge, fokus kontrol, dan elemen interaktif.</p>
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
                                <span class="text-xs text-muted-foreground font-medium">Custom color:</span>
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
                                    title="Pilih warna primer kustom dari color picker"
                                >
                                    <input 
                                        type="color" 
                                        x-model="customHex" 
                                        @input="onColorPickerChange($event.target.value)" 
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
                            <h3 class="font-semibold text-foreground text-base">Interface theme</h3>
                            <p class="text-muted-foreground text-xs">Pilih mode tema global terang, gelap, atau sinkron otomatis dengan preferensi sistem.</p>
                        </div>

                        <div class="space-y-4 w-full">
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 max-w-2xl">
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
                                    <span class="text-xs font-semibold text-foreground block pt-2">System preference</span>
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
                                    <span class="text-xs font-semibold text-foreground block pt-2">Light</span>
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
                                    <span class="text-xs font-semibold text-foreground block pt-2">Dark</span>
                                </button>
                            </div>

                            {{-- High Contrast Toggle --}}
                            <vibe:card variant="muted" class="max-w-2xl p-3.5 mt-3 border border-border/60">
                                <vibe:switch 
                                    label="Mode Kontras Tinggi (High Contrast)" 
                                    description="Meningkatkan ketajaman token pembatas (`--border`) untuk keterbacaan optimal." 
                                    labelPlacement="justify" 
                                    size="sm" 
                                    x-model="highContrast" 
                                    @change="toggleHighContrast(highContrast)" 
                                />
                            </vibe:card>
                        </div>
                    </div>

                    <vibe:separator />

                    {{-- 3. Canvas & Surface Palette (--background, --card, --popover) --}}
                    <div class="space-y-6 flex flex-col xl:flex-row items-start w-full gap-x-20">
                        <div class="space-y-1 max-w-lg w-full">
                            <h3 class="font-semibold text-foreground text-base">Canvas & surface palette</h3>
                            <p class="text-muted-foreground text-xs">Pilih nuansa warna dasar kanvas (<code class="font-mono text-[11px] text-primary">--background</code>, <code class="font-mono text-[11px] text-primary">--card</code>, <code class="font-mono text-[11px] text-primary">--popover</code>).</p>
                        </div>

                        <div class="space-y-3 w-full max-w-2xl">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <template x-for="surface in surfacePresets" :key="surface.id">
                                    <button 
                                        type="button" 
                                        @click="selectSurfacePreset(surface.id)"
                                        class="p-3 rounded-xl border text-left flex items-start gap-3 transition-all cursor-pointer group"
                                        :class="selectedSurface === surface.id ? 'border-primary bg-primary/5 ring-1 ring-primary' : 'border-border/80 bg-card hover:bg-muted/40'"
                                    >
                                        {{-- Visual Surface Preview Dot --}}
                                        <div class="size-9 rounded-lg border border-border/80 p-1 flex items-center justify-center shrink-0 shadow-2xs" :style="{ backgroundColor: mode === 'dark' ? surface.dark.bg : surface.light.bg }">
                                            <div class="size-4 rounded-sm border border-border/60 shadow-2xs" :style="{ backgroundColor: mode === 'dark' ? surface.dark.card : surface.light.card }"></div>
                                        </div>

                                        <div class="min-w-0 flex-1">
                                            <div class="flex items-center justify-between">
                                                <span class="text-xs font-bold text-foreground" x-text="surface.name"></span>
                                                <span x-show="selectedSurface === surface.id" class="text-primary font-bold text-xs">&check;</span>
                                            </div>
                                            <p class="text-[11px] text-muted-foreground mt-0.5 leading-snug" x-text="surface.desc"></p>
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
                            <h3 class="font-semibold text-foreground text-base">Desktop sidebar</h3>
                            <p class="text-muted-foreground text-xs">Kustomisasi token bilah sisi (<code class="font-mono text-[11px] text-primary">--sidebar</code>, <code class="font-mono text-[11px] text-primary">--sidebar-border</code>), palet permukaan, garis batas, dan transparansi.</p>
                        </div>

                        <div class="space-y-4 w-full max-w-xl">

                            {{-- Sidebar Style Cards --}}
                            <div class="space-y-2">
                                <label class="text-xs font-semibold text-foreground block">Sidebar surface style</label>
                                <div class="grid grid-cols-2 sm:grid-cols-3 gap-2.5">
                                    <template x-for="st in sidebarStyles" :key="st.id">
                                        <vibe:button 
                                            type="button" 
                                            variant="outline" 
                                            size="sm" 
                                            @click="selectSidebarStyle(st.id)"
                                            class="h-auto py-2.5 text-xs font-medium justify-center transition-all"
                                            x-bind:class="sidebarStyle === st.id ? 'border-primary bg-primary/10 text-primary font-semibold ring-1 ring-primary hover:bg-primary/15' : 'border-border/80 text-muted-foreground hover:text-foreground hover:bg-muted/40'"
                                            x-text="st.name"
                                        >
                                        </vibe:button>
                                    </template>
                                </div>
                            </div>

                            {{-- Custom Sidebar Color Picker (Shown when style is 'custom') --}}
                            <vibe:card x-show="sidebarStyle === 'custom'" x-cloak class="p-3.5 border border-primary/30 bg-primary/5 space-y-3">
                                <span class="text-xs font-semibold text-foreground block">Kustomisasi Warna Sidebar</span>
                                
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    {{-- Sidebar Background --}}
                                    <div class="space-y-1">
                                        <label class="text-[11px] text-muted-foreground font-medium block">Warna Latar (<code class="text-[10px] font-mono">--sidebar</code>)</label>
                                        <div class="flex items-center gap-2">
                                            <label 
                                                class="relative size-7 rounded-lg ring-1 ring-border cursor-pointer shadow-2xs shrink-0 overflow-hidden"
                                                :style="{ backgroundColor: sidebarCustomBg }"
                                            >
                                                <input 
                                                    type="color" 
                                                    x-model="sidebarCustomBg" 
                                                    @input="onSidebarCustomBgChange($event.target.value)" 
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
                                        <label class="text-[11px] text-muted-foreground font-medium block">Warna Border (<code class="text-[10px] font-mono">--sidebar-border</code>)</label>
                                        <div class="flex items-center gap-2">
                                            <label 
                                                class="relative size-7 rounded-lg ring-1 ring-border cursor-pointer shadow-2xs shrink-0 overflow-hidden"
                                                :style="{ backgroundColor: sidebarCustomBorder }"
                                            >
                                                <input 
                                                    type="color" 
                                                    x-model="sidebarCustomBorder" 
                                                    @input="onSidebarCustomBorderChange($event.target.value)" 
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
                                <label class="text-xs font-semibold text-foreground block">Batas Garis Sisi (Border)</label>
                                <div class="grid grid-cols-3 gap-2">
                                    <vibe:button 
                                        type="button" 
                                        variant="outline" 
                                        size="sm" 
                                        @click="selectSidebarBorderMode('default')" 
                                        class="text-xs justify-center transition-all"
                                        x-bind:class="sidebarBorderMode === 'default' ? 'border-primary bg-primary/10 text-primary font-semibold ring-1 ring-primary hover:bg-primary/15' : 'border-border/80 text-muted-foreground hover:text-foreground'"
                                    >
                                        Standar
                                    </vibe:button>
                                    <vibe:button 
                                        type="button" 
                                        variant="outline" 
                                        size="sm" 
                                        @click="selectSidebarBorderMode('none')" 
                                        class="text-xs justify-center transition-all"
                                        x-bind:class="sidebarBorderMode === 'none' ? 'border-primary bg-primary/10 text-primary font-semibold ring-1 ring-primary hover:bg-primary/15' : 'border-border/80 text-muted-foreground hover:text-foreground'"
                                    >
                                        Tanpa Garis
                                    </vibe:button>
                                    <vibe:button 
                                        type="button" 
                                        variant="outline" 
                                        size="sm" 
                                        @click="selectSidebarBorderMode('high')" 
                                        class="text-xs justify-center transition-all"
                                        x-bind:class="sidebarBorderMode === 'high' ? 'border-primary bg-primary/10 text-primary font-semibold ring-1 ring-primary hover:bg-primary/15' : 'border-border/80 text-muted-foreground hover:text-foreground'"
                                    >
                                        Tegas
                                    </vibe:button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <vibe:separator />

                    {{-- 5. Navigation Items (--nav-active-bg, --nav-active-fg, --nav-indicator) --}}
                    <div class="space-y-6 flex flex-col xl:flex-row items-start w-full gap-x-20">
                        <div class="space-y-1 max-w-lg w-full">
                            <h3 class="font-semibold text-foreground text-base">Navigation items (Nav)</h3>
                            <p class="text-muted-foreground text-xs">Kustomisasi token item navigasi (<code class="font-mono text-[11px] text-primary">--nav-active-bg</code>, <code class="font-mono text-[11px] text-primary">--nav-active-fg</code>, <code class="font-mono text-[11px] text-primary">--nav-indicator</code>), gaya aktif, garis indikator, dan kerapatan baris.</p>
                        </div>

                        <div class="space-y-4 w-full max-w-xl">
                            {{-- Nav Style Preset Cards --}}
                            <div class="space-y-2">
                                <label class="text-xs font-semibold text-foreground block">Gaya Navigasi Aktif</label>
                                <div class="grid grid-cols-2 sm:grid-cols-3 gap-2.5">
                                    <template x-for="st in navStyles" :key="st.id">
                                        <vibe:button 
                                            type="button" 
                                            variant="outline" 
                                            size="sm" 
                                            @click="selectNavStyle(st.id)"
                                            class="h-auto py-2.5 text-xs font-medium justify-center transition-all"
                                            x-bind:class="navStyle === st.id ? 'border-primary bg-primary/10 text-primary font-semibold ring-1 ring-primary hover:bg-primary/15' : 'border-border/80 text-muted-foreground hover:text-foreground hover:bg-muted/40'"
                                            x-text="st.name"
                                        >
                                        </vibe:button>
                                    </template>
                                </div>
                            </div>

                            {{-- Custom Nav Color Pickers (Shown when style is 'custom') --}}
                            <vibe:card x-show="navStyle === 'custom'" x-cloak class="p-3.5 border border-primary/30 bg-primary/5 space-y-3">
                                <span class="text-xs font-semibold text-foreground block">Kustomisasi Warna Navigasi</span>
                                
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                    {{-- Nav Active Bg --}}
                                    <div class="space-y-1">
                                        <label class="text-[11px] text-muted-foreground font-medium block">Latar Aktif (<code class="text-[10px] font-mono">--nav-active-bg</code>)</label>
                                        <div class="flex items-center gap-2">
                                            <label 
                                                class="relative size-7 rounded-lg ring-1 ring-border cursor-pointer shadow-2xs shrink-0 overflow-hidden"
                                                :style="{ backgroundColor: navCustomActiveBg }"
                                            >
                                                <input 
                                                    type="color" 
                                                    x-model="navCustomActiveBg" 
                                                    @input="onNavCustomActiveBgChange($event.target.value)" 
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
                                        <label class="text-[11px] text-muted-foreground font-medium block">Teks Aktif (<code class="text-[10px] font-mono">--nav-active-fg</code>)</label>
                                        <div class="flex items-center gap-2">
                                            <label 
                                                class="relative size-7 rounded-lg ring-1 ring-border cursor-pointer shadow-2xs shrink-0 overflow-hidden"
                                                :style="{ backgroundColor: navCustomActiveFg }"
                                            >
                                                <input 
                                                    type="color" 
                                                    x-model="navCustomActiveFg" 
                                                    @input="onNavCustomActiveFgChange($event.target.value)" 
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
                                        <label class="text-[11px] text-muted-foreground font-medium block">Garis Indikator (<code class="text-[10px] font-mono">--nav-indicator</code>)</label>
                                        <div class="flex items-center gap-2">
                                            <label 
                                                class="relative size-7 rounded-lg ring-1 ring-border cursor-pointer shadow-2xs shrink-0 overflow-hidden"
                                                :style="{ backgroundColor: navCustomIndicator }"
                                            >
                                                <input 
                                                    type="color" 
                                                    x-model="navCustomIndicator" 
                                                    @input="onNavCustomIndicatorChange($event.target.value)" 
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
                                <label class="text-xs font-semibold text-foreground block">Kerapatan Navigasi (Density)</label>
                                <div class="grid grid-cols-3 gap-2">
                                    <vibe:button 
                                        type="button" 
                                        variant="outline" 
                                        size="sm" 
                                        @click="selectNavDensity('compact')" 
                                        class="text-xs justify-center transition-all"
                                        x-bind:class="navDensity === 'compact' ? 'border-primary bg-primary/10 text-primary font-semibold ring-1 ring-primary hover:bg-primary/15' : 'border-border/80 text-muted-foreground hover:text-foreground'"
                                    >
                                        Kompak (32px)
                                    </vibe:button>
                                    <vibe:button 
                                        type="button" 
                                        variant="outline" 
                                        size="sm" 
                                        @click="selectNavDensity('default')" 
                                        class="text-xs justify-center transition-all"
                                        x-bind:class="navDensity === 'default' ? 'border-primary bg-primary/10 text-primary font-semibold ring-1 ring-primary hover:bg-primary/15' : 'border-border/80 text-muted-foreground hover:text-foreground'"
                                    >
                                        Standar (36px)
                                    </vibe:button>
                                    <vibe:button 
                                        type="button" 
                                        variant="outline" 
                                        size="sm" 
                                        @click="selectNavDensity('relaxed')" 
                                        class="text-xs justify-center transition-all"
                                        x-bind:class="navDensity === 'relaxed' ? 'border-primary bg-primary/10 text-primary font-semibold ring-1 ring-primary hover:bg-primary/15' : 'border-border/80 text-muted-foreground hover:text-foreground'"
                                    >
                                        Luas (40px)
                                    </vibe:button>
                                </div>
                            </div>

                            {{-- Active Indicator Switch --}}
                            <vibe:card class="p-3.5 border border-border/80 bg-card">
                                <vibe:switch 
                                    label="Active item indicator" 
                                    description="Tampilkan garis aksen vertikal di tepi kiri pada item navigasi yang sedang aktif." 
                                    labelPlacement="justify" 
                                    size="md" 
                                    x-model="navIndicator" 
                                    @change="toggleNavIndicator(navIndicator)" 
                                />
                            </vibe:card>
                        </div>
                    </div>

                    <vibe:separator />

                    {{-- 6. Application Header (--header, --header-border, --header-accent) --}}
                    <div class="space-y-6 flex flex-col xl:flex-row items-start w-full gap-x-20">
                        <div class="space-y-1 max-w-lg w-full">
                            <h3 class="font-semibold text-foreground text-base">Application header</h3>
                            <p class="text-muted-foreground text-xs">Kustomisasi token bilah atas (<code class="font-mono text-[11px] text-primary">--header</code>, <code class="font-mono text-[11px] text-primary">--header-border</code>), gaya permukaan, garis batas, dan transparansi blur.</p>
                        </div>

                        <div class="space-y-4 w-full max-w-xl">
                            {{-- Header Blur Glassmorphism Switch --}}
                            <vibe:card class="p-3.5 border border-border/80 bg-card">
                                <vibe:switch 
                                    label="Header backdrop blur" 
                                    description="Efek kaca transparan (*glassmorphism*) saat konten halaman bergulir di bawah bilah atas." 
                                    labelPlacement="justify" 
                                    size="md" 
                                    x-model="headerGlassEffect" 
                                    @change="toggleHeaderGlassEffect(headerGlassEffect)" 
                                />
                            </vibe:card>

                            {{-- Header Style Cards --}}
                            <div class="space-y-2">
                                <label class="text-xs font-semibold text-foreground block">Header surface style</label>
                                <div class="grid grid-cols-2 sm:grid-cols-3 gap-2.5">
                                    <template x-for="st in headerStyles" :key="st.id">
                                        <vibe:button 
                                            type="button" 
                                            variant="outline" 
                                            size="sm" 
                                            @click="selectHeaderStyle(st.id)"
                                            class="h-auto py-2.5 text-xs font-medium justify-center transition-all"
                                            x-bind:class="headerStyle === st.id ? 'border-primary bg-primary/10 text-primary font-semibold ring-1 ring-primary hover:bg-primary/15' : 'border-border/80 text-muted-foreground hover:text-foreground hover:bg-muted/40'"
                                            x-text="st.name"
                                        >
                                        </vibe:button>
                                    </template>
                                </div>
                            </div>

                            {{-- Custom Header Color Picker (Shown when style is 'custom') --}}
                            <vibe:card x-show="headerStyle === 'custom'" x-cloak class="p-3.5 border border-primary/30 bg-primary/5 space-y-3">
                                <span class="text-xs font-semibold text-foreground block">Kustomisasi Warna Header</span>
                                
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    {{-- Header Background --}}
                                    <div class="space-y-1">
                                        <label class="text-[11px] text-muted-foreground font-medium block">Warna Latar (<code class="text-[10px] font-mono">--header</code>)</label>
                                        <div class="flex items-center gap-2">
                                            <label 
                                                class="relative size-7 rounded-lg ring-1 ring-border cursor-pointer shadow-2xs shrink-0 overflow-hidden"
                                                :style="{ backgroundColor: headerCustomBg }"
                                            >
                                                <input 
                                                    type="color" 
                                                    x-model="headerCustomBg" 
                                                    @input="onHeaderCustomBgChange($event.target.value)" 
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
                                        <label class="text-[11px] text-muted-foreground font-medium block">Warna Border (<code class="text-[10px] font-mono">--header-border</code>)</label>
                                        <div class="flex items-center gap-2">
                                            <label 
                                                class="relative size-7 rounded-lg ring-1 ring-border cursor-pointer shadow-2xs shrink-0 overflow-hidden"
                                                :style="{ backgroundColor: headerCustomBorder }"
                                            >
                                                <input 
                                                    type="color" 
                                                    x-model="headerCustomBorder" 
                                                    @input="onHeaderCustomBorderChange($event.target.value)" 
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
                                <label class="text-xs font-semibold text-foreground block">Batas Garis Bawah (Border)</label>
                                <div class="grid grid-cols-3 gap-2">
                                    <vibe:button 
                                        type="button" 
                                        variant="outline" 
                                        size="sm" 
                                        @click="selectHeaderBorderMode('default')" 
                                        class="text-xs justify-center transition-all"
                                        x-bind:class="headerBorderMode === 'default' ? 'border-primary bg-primary/10 text-primary font-semibold ring-1 ring-primary hover:bg-primary/15' : 'border-border/80 text-muted-foreground hover:text-foreground'"
                                    >
                                        Standar
                                    </vibe:button>
                                    <vibe:button 
                                        type="button" 
                                        variant="outline" 
                                        size="sm" 
                                        @click="selectHeaderBorderMode('none')" 
                                        class="text-xs justify-center transition-all"
                                        x-bind:class="headerBorderMode === 'none' ? 'border-primary bg-primary/10 text-primary font-semibold ring-1 ring-primary hover:bg-primary/15' : 'border-border/80 text-muted-foreground hover:text-foreground'"
                                    >
                                        Tanpa Garis
                                    </vibe:button>
                                    <vibe:button 
                                        type="button" 
                                        variant="outline" 
                                        size="sm" 
                                        @click="selectHeaderBorderMode('high')" 
                                        class="text-xs justify-center transition-all"
                                        x-bind:class="headerBorderMode === 'high' ? 'border-primary bg-primary/10 text-primary font-semibold ring-1 ring-primary hover:bg-primary/15' : 'border-border/80 text-muted-foreground hover:text-foreground'"
                                    >
                                        Tegas
                                    </vibe:button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <vibe:separator />

                    {{-- 6. Semantic Status Colors (--success, --warning, --destructive, --info) --}}
                    <div class="space-y-6 flex flex-col xl:flex-row items-start w-full gap-x-20">
                        <div class="space-y-1 max-w-lg w-full">
                            <h3 class="font-semibold text-foreground text-base">Semantic status colors</h3>
                            <p class="text-muted-foreground text-xs">Palet warna status (<code class="font-mono text-[11px] text-emerald-500">--success</code>, <code class="font-mono text-[11px] text-amber-500">--warning</code>, <code class="font-mono text-[11px] text-rose-500">--destructive</code>, <code class="font-mono text-[11px] text-sky-500">--info</code>) untuk badge, alert, dan feedback.</p>
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
                                <vibe:badge variant="success" class="rounded-full shadow-2xs font-medium" x-bind:style="{ backgroundColor: currentSemanticColors.success, color: '#ffffff' }">Success</vibe:badge>
                                <vibe:badge variant="warning" class="rounded-full shadow-2xs font-medium" x-bind:style="{ backgroundColor: currentSemanticColors.warning, color: '#ffffff' }">Warning</vibe:badge>
                                <vibe:badge variant="destructive" class="rounded-full shadow-2xs font-medium" x-bind:style="{ backgroundColor: currentSemanticColors.destructive, color: '#ffffff' }">Destructive</vibe:badge>
                                <vibe:badge variant="info" class="rounded-full shadow-2xs font-medium" x-bind:style="{ backgroundColor: currentSemanticColors.info, color: '#ffffff' }">Info</vibe:badge>
                            </vibe:card>
                        </div>
                    </div>

                    <vibe:separator />

                    {{-- 7. Data Charts Palette (--chart-1 s/d --chart-5) --}}
                    <div class="space-y-6 flex flex-col xl:flex-row items-start w-full gap-x-20">
                        <div class="space-y-1 max-w-lg w-full">
                            <h3 class="font-semibold text-foreground text-base">Chart & data palette</h3>
                            <p class="text-muted-foreground text-xs">Palet warna grafik analitik (<code class="font-mono text-[11px] text-primary">--chart-1</code> s/d <code class="font-mono text-[11px] text-primary">--chart-5</code>) pada dashboard dan diagram data.</p>
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

                    {{-- 8. Border Radius (--radius, --radius-xs s/d --radius-3xl) --}}
                    <div class="space-y-6 flex flex-col xl:flex-row items-start w-full gap-x-20">
                        <div class="space-y-1 max-w-lg w-full">
                            <h3 class="font-semibold text-foreground text-base">Border radius</h3>
                            <p class="text-muted-foreground text-xs">Derajat kelengkungan sudut (<code class="font-mono text-[11px] text-primary">--radius</code>) pada kartu, tombol, badge, dan kontrol input.</p>
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
                                            <span class="text-xs font-semibold text-foreground block" x-text="r.label"></span>
                                            <span class="text-[10px] text-muted-foreground font-mono" x-text="r.value"></span>
                                        </div>
                                    </button>
                                </template>
                            </div>
                        </div>
                    </div>

                    <vibe:separator />

                    {{-- 9. Typography (--font-sans) --}}
                    <div class="space-y-6 flex flex-col xl:flex-row items-start w-full gap-x-20">
                        <div class="space-y-1 max-w-lg w-full">
                            <h3 class="font-semibold text-foreground text-base">Typography</h3>
                            <p class="text-muted-foreground text-xs">Pilih font antarmuka sistem utama (<code class="font-mono text-[11px] text-primary">--font-sans</code>).</p>
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
                                                <vibe:badge size="sm" variant="primary" class="rounded-full" x-show="f.name === 'Figtree'">Bawaan</vibe:badge>
                                            </div>
                                            <p class="text-[11px] text-muted-foreground" x-text="f.desc"></p>
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

                    {{-- 10. Tables View & Density --}}
                    <div class="space-y-6 flex flex-col xl:flex-row items-start w-full gap-x-20">
                        <div class="space-y-1 max-w-lg w-full">
                            <h3 class="font-semibold text-foreground text-base">Tables view</h3>
                            <p class="text-muted-foreground text-xs">Atur kepadatan baris tabel dan kenyamanan pembacaan data tabular.</p>
                        </div>

                        <div class="space-y-4 w-full">
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
                                        <div class="size-full rounded-lg overflow-hidden border border-border/60 flex flex-col bg-background p-2">
                                            <div class="flex items-center justify-between pb-1.5 border-b border-border/60 shrink-0">
                                                <span class="text-[7.5px] font-bold text-foreground">Customer</span>
                                                <span class="h-2 w-7 bg-muted rounded-full"></span>
                                            </div>
                                            <div class="flex-1 flex flex-col justify-around py-0.5 divide-y divide-border/30">
                                                <div class="flex items-center gap-1.5 py-0.5">
                                                    <span class="size-1.5 rounded-full bg-zinc-400/80 shrink-0"></span>
                                                    <span class="h-1 w-10 bg-muted-foreground/30 rounded-xs"></span>
                                                    <span class="h-1 w-14 bg-muted-foreground/20 rounded-xs"></span>
                                                    <span class="h-1 w-8 bg-muted-foreground/20 rounded-xs ml-auto"></span>
                                                </div>
                                                <div class="flex items-center gap-1.5 py-0.5">
                                                    <span class="size-1.5 rounded-full bg-zinc-400/80 shrink-0"></span>
                                                    <span class="h-1 w-12 bg-muted-foreground/30 rounded-xs"></span>
                                                    <span class="h-1 w-10 bg-muted-foreground/20 rounded-xs"></span>
                                                    <span class="h-1 w-6 bg-muted-foreground/20 rounded-xs ml-auto"></span>
                                                </div>
                                                <div class="flex items-center gap-1.5 py-0.5">
                                                    <span class="size-1.5 rounded-full bg-zinc-400/80 shrink-0"></span>
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
                                    <span class="text-xs font-semibold text-foreground block pt-2">Default</span>
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
                                        <div class="size-full rounded-lg overflow-hidden border border-border/60 flex flex-col bg-background p-2">
                                            <div class="flex items-center justify-between pb-1 border-b border-border/60 shrink-0">
                                                <span class="text-[7.5px] font-bold text-foreground">Customer</span>
                                                <span class="h-2 w-7 bg-muted rounded-full"></span>
                                            </div>
                                            <div class="flex-1 flex flex-col justify-around py-0 divide-y divide-border/20">
                                                <div class="flex items-center gap-1.5 py-0.25">
                                                    <span class="size-1 rounded-full bg-zinc-400/80 shrink-0"></span>
                                                    <span class="h-0.75 w-10 bg-muted-foreground/30 rounded-xs"></span>
                                                    <span class="h-0.75 w-14 bg-muted-foreground/20 rounded-xs"></span>
                                                </div>
                                                <div class="flex items-center gap-1.5 py-0.25">
                                                    <span class="size-1 rounded-full bg-zinc-400/80 shrink-0"></span>
                                                    <span class="h-0.75 w-12 bg-muted-foreground/30 rounded-xs"></span>
                                                    <span class="h-0.75 w-10 bg-muted-foreground/20 rounded-xs"></span>
                                                </div>
                                                <div class="flex items-center gap-1.5 py-0.25">
                                                    <span class="size-1 rounded-full bg-zinc-400/80 shrink-0"></span>
                                                    <span class="h-0.75 w-9 bg-muted-foreground/30 rounded-xs"></span>
                                                    <span class="h-0.75 w-12 bg-muted-foreground/20 rounded-xs"></span>
                                                </div>
                                                <div class="flex items-center gap-1.5 py-0.25">
                                                    <span class="size-1 rounded-full bg-zinc-400/80 shrink-0"></span>
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
                                    <span class="text-xs font-semibold text-foreground block pt-2">Compact</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <vibe:separator />

                    {{-- 11. Motion & Visual Effects --}}
                    <div class="space-y-6 flex flex-col xl:flex-row items-start w-full gap-x-20">
                        <div class="space-y-1 max-w-lg w-full">
                            <h3 class="font-semibold text-foreground text-base">Motion & effects</h3>
                            <p class="text-muted-foreground text-xs">Kontrol animasi transisi dan efek visual kaca transparan (*glassmorphism*).</p>
                        </div>

                        <div class="space-y-3 w-full max-w-xl">
                            <vibe:card class="p-3.5 border border-border/80 bg-card">
                                <vibe:switch 
                                    label="Animasi Transisi Halus" 
                                    description="Aktifkan transisi mikro pada hover dan perpindahan halaman." 
                                    labelPlacement="justify" 
                                    size="sm" 
                                    x-model="motionActive" 
                                    @change="toggleMotion(motionActive)" 
                                />
                            </vibe:card>

                            <vibe:card class="p-3.5 border border-border/80 bg-card">
                                <vibe:switch 
                                    label="Backdrop Blur Glassmorphism" 
                                    description="Efek blur modern pada header, bilah dialog, dan popover." 
                                    labelPlacement="justify" 
                                    size="sm" 
                                    x-model="glassEffect" 
                                    @change="toggleGlassEffect(glassEffect)" 
                                />
                            </vibe:card>
                        </div>
                    </div>

                </div>
            </vibe:tabs>
        </vibe:card>
    </div>

    @push('body')
        <script>
            function appearanceController() {
                const prefix = window.VIBE_PREFIX || '{{ config('vibe.prefix', 'vibe') }}';
                const themeKey = prefix + '-theme-tokens';
                const styleId = prefix + '-theme-override';

                return {
                    mode: window.VibeTheme?.getConfig()?.mode || (document.documentElement.classList.contains('dark') ? 'dark' : 'light'),
                    customHex: '#18181b',
                    customHexInput: '18181B',
                    highContrast: false,
                    selectedSurface: 'zinc',
                    
                    // Sidebar States
                    sidebarStyle: 'default',
                    sidebarCustomBg: '#ffffff',
                    sidebarCustomBgInput: 'FFFFFF',
                    sidebarCustomBorder: '#e5e6e5',
                    sidebarCustomBorderInput: 'E5E6E5',
                    sidebarBorderMode: 'default',
                    transparentSidebar: false,
                    sidebarFeature: 'Recent changes',

                    // Nav States
                    navStyle: 'harmony',
                    navDensity: 'default',
                    navIndicator: false,
                    navCustomActiveBg: '#f4f5f5',
                    navCustomActiveBgInput: 'F4F5F5',
                    navCustomActiveFg: '#0a0b0a',
                    navCustomActiveFgInput: '0A0B0A',
                    navCustomIndicator: '#18181b',
                    navCustomIndicatorInput: '18181B',

                    // Header States
                    headerStyle: 'default',
                    headerCustomBg: '#ffffff',
                    headerCustomBgInput: 'FFFFFF',
                    headerCustomBorder: '#e5e6e5',
                    headerCustomBorderInput: 'E5E6E5',
                    headerBorderMode: 'default',
                    headerGlassEffect: true,

                    selectedSemantic: 'vibrant',
                    selectedChartPreset: 'rainbow',
                    selectedRadius: '0.5rem',
                    selectedFontName: 'Figtree',
                    selectedFontValue: "'Figtree', ui-sans-serif, system-ui, sans-serif",
                    tablesView: 'default',
                    reduceMotion: false,
                    motionActive: true,
                    glassEffect: true,
                    copied: false,

                    primaryColors: [
                        { name: 'Dark Slate', hex: '#18181b' },
                        { name: 'Violet', hex: '#8b5cf6' },
                        { name: 'Indigo', hex: '#6366f1' },
                        { name: 'Blue', hex: '#2563eb' },
                        { name: 'Sky', hex: '#0ea5e9' },
                        { name: 'Teal', hex: '#0d9488' },
                        { name: 'Emerald', hex: '#16a34a' },
                        { name: 'Rose', hex: '#e11d48' },
                        { name: 'Amber', hex: '#d97706' },
                    ],

                    get brandColors() {
                        return this.primaryColors;
                    },

                    surfacePresets: [
                        {
                            id: 'zinc',
                            name: 'Vibe Zinc (Bawaan)',
                            desc: 'Karakter netral kontemporer standar Vibe UI.',
                            light: { bg: '#f9fafa', card: '#ffffff', border: '#e5e6e5', sidebar: '#ffffff', header: '#ffffff' },
                            dark: { bg: '#0a0b0a', card: '#181918', border: '#262726', sidebar: '#121312', header: '#121312' }
                        },
                        {
                            id: 'stone',
                            name: 'Warm Stone',
                            desc: 'Nuansa hangat lembut dan bersahabat ala Linear.',
                            light: { bg: '#fafaf9', card: '#ffffff', border: '#e7e5e4', sidebar: '#fafaf9', header: '#ffffff' },
                            dark: { bg: '#0c0a09', card: '#1c1917', border: '#292524', sidebar: '#141210', header: '#141210' }
                        },
                        {
                            id: 'slate',
                            name: 'Cool Slate',
                            desc: 'Sentuhan kebiruan dingin ala GitHub & Tailwind.',
                            light: { bg: '#f8fafc', card: '#ffffff', border: '#e2e8f0', sidebar: '#f8fafc', header: '#ffffff' },
                            dark: { bg: '#020617', card: '#0f172a', border: '#1e293b', sidebar: '#0b1120', header: '#0b1120' }
                        },
                        {
                            id: 'oled',
                            name: 'OLED Pure Black',
                            desc: 'Hitam pekat 100% pada dark mode untuk efisiensi daya.',
                            light: { bg: '#ffffff', card: '#f4f5f5', border: '#e5e6e5', sidebar: '#ffffff', header: '#ffffff' },
                            dark: { bg: '#000000', card: '#0a0a0a', border: '#27272a', sidebar: '#000000', header: '#000000' }
                        }
                    ],

                    sidebarStyles: [
                        { id: 'default', name: 'Standar' },
                        { id: 'card', name: 'Kartu' },
                        { id: 'contrast', name: 'Kontras' },
                        { id: 'muted', name: 'Lembut' },
                        { id: 'dark', name: 'Gelap' },
                        { id: 'custom', name: 'Kustom' },
                    ],

                    headerStyles: [
                        { id: 'default', name: 'Standar' },
                        { id: 'card', name: 'Kartu' },
                        { id: 'glass', name: 'Glass Blur' },
                        { id: 'contrast', name: 'Kontras' },
                        { id: 'muted', name: 'Lembut' },
                        { id: 'dark', name: 'Gelap' },
                        { id: 'custom', name: 'Kustom' },
                    ],

                    navStyles: [
                        { id: 'harmony', name: 'Sidebar Harmony' },
                        { id: 'primary', name: 'Primary Filled' },
                        { id: 'subtle', name: 'Subtle Neutral' },
                        { id: 'line', name: 'Indicator Line' },
                        { id: 'custom', name: 'Kustom' },
                    ],

                    sidebarFeatures: [
                        { name: 'Recent changes', color: 'bg-emerald-500' },
                        { name: 'Quick shortcuts', color: 'bg-blue-500' },
                        { name: 'Activity feed', color: 'bg-amber-500' },
                        { name: 'None', color: 'bg-zinc-400' },
                    ],

                    semanticPresets: [
                        {
                            id: 'vibrant',
                            name: 'Vibrant Modern',
                            colors: { success: '#10b981', warning: '#f59e0b', destructive: '#ef4444', info: '#0ea5e9' }
                        },
                        {
                            id: 'pastel',
                            name: 'Pastel Soft',
                            colors: { success: '#34d399', warning: '#fbbf24', destructive: '#f87171', info: '#38bdf8' }
                        },
                        {
                            id: 'high',
                            name: 'High Lumens',
                            colors: { success: '#059669', warning: '#d97706', destructive: '#dc2626', info: '#0284c7' }
                        }
                    ],

                    chartPresets: [
                        {
                            id: 'rainbow',
                            name: 'Modern Rainbow',
                            colors: ['#0ea5e9', '#10b981', '#f59e0b', '#8b5cf6', '#ef4444']
                        },
                        {
                            id: 'ocean',
                            name: 'Cool Oceanic',
                            colors: ['#06b6d4', '#0ea5e9', '#0d9488', '#6366f1', '#8b5cf6']
                        },
                        {
                            id: 'sunset',
                            name: 'Warm Sunset',
                            colors: ['#f97316', '#f59e0b', '#f43f5e', '#ec4899', '#a855f7']
                        },
                        {
                            id: 'mono',
                            name: 'Monochromatic',
                            colors: ['#2563eb', '#3b82f6', '#60a5fa', '#93c5fd', '#bfdbfe']
                        }
                    ],

                    radii: [
                        { label: 'Tajam', value: '0rem' },
                        { label: 'Kecil', value: '0.25rem' },
                        { label: 'Standar', value: '0.5rem' },
                        { label: 'Membulat', value: '0.75rem' },
                        { label: 'Penuh', value: '1rem' },
                    ],

                    fonts: [
                        { name: 'Figtree', desc: 'Font bawaan Vibe UI yang ramah dan seimbang', value: "'Figtree', ui-sans-serif, system-ui, sans-serif" },
                        { name: 'Inter', desc: 'Tipografi presisi tinggi standar industri modern', value: "'Inter', ui-sans-serif, system-ui, sans-serif" },
                        { name: 'Plus Jakarta', desc: 'Karakter geometris kontemporer yang elegan', value: "'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif" },
                        { name: 'Outfit', desc: 'Gaya headline display dinamis dan ekspresif', value: "'Outfit', ui-sans-serif, system-ui, sans-serif" }
                    ],

                    get currentSemanticColors() {
                        const p = this.semanticPresets.find(s => s.id === this.selectedSemantic);
                        return p ? p.colors : this.semanticPresets[0].colors;
                    },

                    init() {
                        try {
                            if (window.VibeTheme) {
                                const cfg = window.VibeTheme.getConfig();
                                if (cfg && cfg.customHex) {
                                    this.customHex = cfg.customHex;
                                    this.customHexInput = cfg.customHex.replace('#', '').toUpperCase();
                                }
                            }

                            const stored = localStorage.getItem(themeKey);
                            if (stored) {
                                const parsed = JSON.parse(stored);
                                if (parsed.mode) this.mode = parsed.mode;
                                if (parsed.customHex) {
                                    this.customHex = parsed.customHex;
                                    this.customHexInput = parsed.customHex.replace('#', '').toUpperCase();
                                }
                                if (typeof parsed.highContrast !== 'undefined') this.highContrast = !!parsed.highContrast;
                                if (parsed.selectedSurface) this.selectedSurface = parsed.selectedSurface;
                                
                                if (parsed.sidebarStyle) this.sidebarStyle = parsed.sidebarStyle;
                                if (parsed.sidebarCustomBg) {
                                    this.sidebarCustomBg = parsed.sidebarCustomBg;
                                    this.sidebarCustomBgInput = parsed.sidebarCustomBg.replace('#', '').toUpperCase();
                                }
                                if (parsed.sidebarCustomBorder) {
                                    this.sidebarCustomBorder = parsed.sidebarCustomBorder;
                                    this.sidebarCustomBorderInput = parsed.sidebarCustomBorder.replace('#', '').toUpperCase();
                                }
                                if (parsed.sidebarBorderMode) this.sidebarBorderMode = parsed.sidebarBorderMode;
                                if (typeof parsed.transparentSidebar !== 'undefined') this.transparentSidebar = !!parsed.transparentSidebar;
                                if (parsed.sidebarFeature) this.sidebarFeature = parsed.sidebarFeature;

                                if (parsed.headerStyle) this.headerStyle = parsed.headerStyle;
                                if (parsed.headerCustomBg) {
                                    this.headerCustomBg = parsed.headerCustomBg;
                                    this.headerCustomBgInput = parsed.headerCustomBg.replace('#', '').toUpperCase();
                                }
                                if (parsed.headerCustomBorder) {
                                    this.headerCustomBorder = parsed.headerCustomBorder;
                                    this.headerCustomBorderInput = parsed.headerCustomBorder.replace('#', '').toUpperCase();
                                }
                                if (parsed.headerBorderMode) this.headerBorderMode = parsed.headerBorderMode;
                                if (typeof parsed.headerGlassEffect !== 'undefined') this.headerGlassEffect = !!parsed.headerGlassEffect;

                                if (parsed.navStyle) this.navStyle = parsed.navStyle;
                                if (parsed.navDensity) this.navDensity = parsed.navDensity;
                                if (typeof parsed.navIndicator !== 'undefined') this.navIndicator = !!parsed.navIndicator;
                                if (parsed.navCustomActiveBg) {
                                    this.navCustomActiveBg = parsed.navCustomActiveBg;
                                    this.navCustomActiveBgInput = parsed.navCustomActiveBg.replace('#', '').toUpperCase();
                                }
                                if (parsed.navCustomActiveFg) {
                                    this.navCustomActiveFg = parsed.navCustomActiveFg;
                                    this.navCustomActiveFgInput = parsed.navCustomActiveFg.replace('#', '').toUpperCase();
                                }
                                if (parsed.navCustomIndicator) {
                                    this.navCustomIndicator = parsed.navCustomIndicator;
                                    this.navCustomIndicatorInput = parsed.navCustomIndicator.replace('#', '').toUpperCase();
                                }

                                if (parsed.selectedSemantic) this.selectedSemantic = parsed.selectedSemantic;
                                if (parsed.selectedChartPreset) this.selectedChartPreset = parsed.selectedChartPreset;
                                if (parsed.selectedRadius) this.selectedRadius = parsed.selectedRadius;
                                if (parsed.selectedFontName) this.selectedFontName = parsed.selectedFontName;
                                if (parsed.selectedFontValue) this.selectedFontValue = parsed.selectedFontValue;
                                if (parsed.tablesView) this.tablesView = parsed.tablesView;
                                if (typeof parsed.reduceMotion !== 'undefined') {
                                    this.reduceMotion = !!parsed.reduceMotion;
                                    this.motionActive = !this.reduceMotion;
                                }
                                if (typeof parsed.glassEffect !== 'undefined') this.glassEffect = !!parsed.glassEffect;
                            }
                        } catch (e) {}

                        this.applyTheme();
                    },

                    selectPrimaryColor(hex) {
                        this.customHex = hex;
                        this.customHexInput = hex.replace('#', '').toUpperCase();
                        this.updateMonoChart(hex);
                        this.applyTheme();
                        this.notify('Custom primary color diubah ke ' + hex);
                    },

                    selectBrandColor(hex) {
                        this.selectPrimaryColor(hex);
                    },

                    onHexInput(val) {
                        let clean = val.replace(/[^0-9A-Fa-f]/g, '').slice(0, 6);
                        this.customHexInput = clean.toUpperCase();
                        if (clean.length === 6) {
                            this.customHex = '#' + clean.toLowerCase();
                            this.updateMonoChart(this.customHex);
                            this.applyTheme();
                        } else if (clean.length === 3) {
                            const expanded = clean[0] + clean[0] + clean[1] + clean[1] + clean[2] + clean[2];
                            this.customHex = '#' + expanded.toLowerCase();
                            this.updateMonoChart(this.customHex);
                            this.applyTheme();
                        }
                    },

                    onColorPickerChange(val) {
                        this.customHex = val.toLowerCase();
                        this.customHexInput = val.replace('#', '').toUpperCase();
                        this.updateMonoChart(val);
                        this.applyTheme();
                    },

                    // Sidebar Methods
                    selectSidebarStyle(id) {
                        this.sidebarStyle = id;
                        this.applyTheme();
                        this.notify('Gaya bilah sisi (sidebar): ' + id);
                    },

                    selectSidebarBorderMode(mode) {
                        this.sidebarBorderMode = mode;
                        this.applyTheme();
                        this.notify('Batas border sidebar: ' + mode);
                    },

                    onSidebarCustomBgChange(val) {
                        this.sidebarCustomBg = val;
                        this.sidebarCustomBgInput = val.replace('#', '').toUpperCase();
                        this.applyTheme();
                    },

                    onSidebarCustomBgInput(val) {
                        let clean = val.replace(/[^0-9A-Fa-f]/g, '').slice(0, 6);
                        this.sidebarCustomBgInput = clean.toUpperCase();
                        if (clean.length === 6 || clean.length === 3) {
                            this.sidebarCustomBg = '#' + clean;
                            this.applyTheme();
                        }
                    },

                    onSidebarCustomBorderChange(val) {
                        this.sidebarCustomBorder = val;
                        this.sidebarCustomBorderInput = val.replace('#', '').toUpperCase();
                        this.applyTheme();
                    },

                    onSidebarCustomBorderInput(val) {
                        let clean = val.replace(/[^0-9A-Fa-f]/g, '').slice(0, 6);
                        this.sidebarCustomBorderInput = clean.toUpperCase();
                        if (clean.length === 6 || clean.length === 3) {
                            this.sidebarCustomBorder = '#' + clean;
                            this.applyTheme();
                        }
                    },

                    toggleTransparentSidebar() {
                        this.transparentSidebar = !this.transparentSidebar;
                        this.applyTheme();
                        this.notify(this.transparentSidebar ? 'Sidebar transparan aktif.' : 'Sidebar solid aktif.');
                    },

                    selectSidebarFeature(name) {
                        this.sidebarFeature = name;
                        this.saveState();
                        this.notify('Sidebar feature: ' + name);
                    },

                    sidebarFeatureBadgeColor(name) {
                        const item = this.sidebarFeatures.find(f => f.name === name);
                        return item ? item.color : 'bg-emerald-500';
                    },

                    // Header Methods
                    selectHeaderStyle(id) {
                        this.headerStyle = id;
                        this.applyTheme();
                        this.notify('Gaya bilah atas (header): ' + id);
                    },

                    selectHeaderBorderMode(mode) {
                        this.headerBorderMode = mode;
                        this.applyTheme();
                        this.notify('Batas border header: ' + mode);
                    },

                    toggleHeaderGlassEffect(val) {
                        this.headerGlassEffect = typeof val !== 'undefined' ? !!val : !this.headerGlassEffect;
                        this.applyTheme();
                        this.notify(this.headerGlassEffect ? 'Header backdrop blur aktif.' : 'Header backdrop blur nonaktif.');
                    },

                    onHeaderCustomBgChange(val) {
                        this.headerCustomBg = val;
                        this.headerCustomBgInput = val.replace('#', '').toUpperCase();
                        this.applyTheme();
                    },

                    onHeaderCustomBgInput(val) {
                        let clean = val.replace(/[^0-9A-Fa-f]/g, '').slice(0, 6);
                        this.headerCustomBgInput = clean.toUpperCase();
                        if (clean.length === 6 || clean.length === 3) {
                            this.headerCustomBg = '#' + clean;
                            this.applyTheme();
                        }
                    },

                    onHeaderCustomBorderChange(val) {
                        this.headerCustomBorder = val;
                        this.headerCustomBorderInput = val.replace('#', '').toUpperCase();
                        this.applyTheme();
                    },

                    onHeaderCustomBorderInput(val) {
                        let clean = val.replace(/[^0-9A-Fa-f]/g, '').slice(0, 6);
                        this.headerCustomBorderInput = clean.toUpperCase();
                        if (clean.length === 6 || clean.length === 3) {
                            this.headerCustomBorder = '#' + clean;
                            this.applyTheme();
                        }
                    },

                    // Nav Methods
                    selectNavStyle(id) {
                        this.navStyle = id;
                        this.applyTheme();
                        this.notify('Gaya item navigasi: ' + id);
                    },

                    selectNavDensity(density) {
                        this.navDensity = density;
                        this.applyTheme();
                        this.notify('Kerapatan navigasi: ' + density);
                    },

                    toggleNavIndicator(val) {
                        this.navIndicator = typeof val !== 'undefined' ? !!val : !this.navIndicator;
                        this.applyTheme();
                        this.notify(this.navIndicator ? 'Garis indikator aktif.' : 'Garis indikator nonaktif.');
                    },

                    onNavCustomActiveBgChange(val) {
                        this.navCustomActiveBg = val;
                        this.navCustomActiveBgInput = val.replace('#', '').toUpperCase();
                        this.applyTheme();
                    },

                    onNavCustomActiveBgInput(val) {
                        let clean = val.replace(/[^0-9A-Fa-f]/g, '').slice(0, 6);
                        this.navCustomActiveBgInput = clean.toUpperCase();
                        if (clean.length === 6 || clean.length === 3) {
                            this.navCustomActiveBg = '#' + clean;
                            this.applyTheme();
                        }
                    },

                    onNavCustomActiveFgChange(val) {
                        this.navCustomActiveFg = val;
                        this.navCustomActiveFgInput = val.replace('#', '').toUpperCase();
                        this.applyTheme();
                    },

                    onNavCustomActiveFgInput(val) {
                        let clean = val.replace(/[^0-9A-Fa-f]/g, '').slice(0, 6);
                        this.navCustomActiveFgInput = clean.toUpperCase();
                        if (clean.length === 6 || clean.length === 3) {
                            this.navCustomActiveFg = '#' + clean;
                            this.applyTheme();
                        }
                    },

                    onNavCustomIndicatorChange(val) {
                        this.navCustomIndicator = val;
                        this.navCustomIndicatorInput = val.replace('#', '').toUpperCase();
                        this.applyTheme();
                    },

                    onNavCustomIndicatorInput(val) {
                        let clean = val.replace(/[^0-9A-Fa-f]/g, '').slice(0, 6);
                        this.navCustomIndicatorInput = clean.toUpperCase();
                        if (clean.length === 6 || clean.length === 3) {
                            this.navCustomIndicator = '#' + clean;
                            this.applyTheme();
                        }
                    },

                    getPreviewNavActiveBg() {
                        const surface = this.surfacePresets.find(s => s.id === this.selectedSurface) || this.surfacePresets[0];
                        const sb = this.getResolvedSidebarColors(surface);
                        const isDark = this.mode === 'dark' || (this.mode === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches);
                        const nav = this.getResolvedNavColors(surface, sb);
                        return isDark ? nav.dark.activeBg : nav.light.activeBg;
                    },

                    getPreviewNavActiveFg() {
                        const surface = this.surfacePresets.find(s => s.id === this.selectedSurface) || this.surfacePresets[0];
                        const sb = this.getResolvedSidebarColors(surface);
                        const isDark = this.mode === 'dark' || (this.mode === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches);
                        const nav = this.getResolvedNavColors(surface, sb);
                        return isDark ? nav.dark.activeFg : nav.light.activeFg;
                    },

                    getPreviewNavIndicator() {
                        const surface = this.surfacePresets.find(s => s.id === this.selectedSurface) || this.surfacePresets[0];
                        const sb = this.getResolvedSidebarColors(surface);
                        const isDark = this.mode === 'dark' || (this.mode === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches);
                        const nav = this.getResolvedNavColors(surface, sb);
                        return isDark ? nav.dark.indicator : nav.light.indicator;
                    },

                    updateMonoChart(hex) {
                        const mono = this.chartPresets.find(c => c.id === 'mono');
                        if (mono) {
                            mono.colors = [hex, hex + 'dd', hex + 'aa', hex + '77', hex + '44'];
                        }
                    },

                    setMode(newMode, event = null) {
                        this.mode = newMode;
                        if (window.VibeTheme) {
                            window.VibeTheme.setMode(newMode, event);
                        } else {
                            if (newMode === 'system') {
                                const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                                document.documentElement.classList.toggle('dark', prefersDark);
                            } else if (newMode === 'dark') {
                                document.documentElement.classList.add('dark');
                            } else {
                                document.documentElement.classList.remove('dark');
                            }
                        }
                        this.applyTheme();
                        this.notify('Mode tema diubah ke ' + newMode);
                    },

                    toggleHighContrast(val) {
                        this.highContrast = typeof val !== 'undefined' ? !!val : !this.highContrast;
                        this.applyTheme();
                        this.notify(this.highContrast ? 'Kontras tinggi aktif.' : 'Kontras standar.');
                    },

                    selectSurfacePreset(id) {
                        this.selectedSurface = id;
                        this.applyTheme();
                        this.notify('Kanvas permukaan diperbarui.');
                    },

                    selectSemanticPreset(id) {
                        this.selectedSemantic = id;
                        this.applyTheme();
                        this.notify('Palet status diperbarui.');
                    },

                    selectChartPreset(id) {
                        this.selectedChartPreset = id;
                        this.applyTheme();
                        this.notify('Palet grafik diperbarui.');
                    },

                    selectRadius(val) {
                        this.selectedRadius = val;
                        this.applyTheme();
                        this.notify('Border radius: ' + val);
                    },

                    selectFont(name, val) {
                        this.selectedFontName = name;
                        this.selectedFontValue = val;
                        this.applyTheme();
                        this.notify('Font: ' + name);
                    },

                    setTablesView(view) {
                        this.tablesView = view;
                        this.applyTheme();
                        this.notify('Tampilan tabel: ' + view);
                    },

                    toggleMotion(val) {
                        if (typeof val !== 'undefined') {
                            this.motionActive = !!val;
                        } else {
                            this.motionActive = !this.motionActive;
                        }
                        this.reduceMotion = !this.motionActive;
                        this.applyTheme();
                        this.notify(this.reduceMotion ? 'Reduced motion aktif.' : 'Animasi halus aktif.');
                    },

                    toggleGlassEffect(val) {
                        this.glassEffect = typeof val !== 'undefined' ? !!val : !this.glassEffect;
                        this.applyTheme();
                        this.notify(this.glassEffect ? 'Glassmorphism aktif.' : 'Glassmorphism nonaktif.');
                    },

                    resetToDefault() {
                        this.mode = 'system';
                        this.customHex = '#18181b';
                        this.customHexInput = '18181B';
                        this.highContrast = false;
                        this.motionActive = true;
                        this.selectedSurface = 'zinc';
                        
                        this.sidebarStyle = 'default';
                        this.sidebarCustomBg = '#ffffff';
                        this.sidebarCustomBgInput = 'FFFFFF';
                        this.sidebarCustomBorder = '#e5e6e5';
                        this.sidebarCustomBorderInput = 'E5E6E5';
                        this.sidebarBorderMode = 'default';
                        this.transparentSidebar = false;
                        this.sidebarFeature = 'Recent changes';

                        this.headerStyle = 'default';
                        this.headerCustomBg = '#ffffff';
                        this.headerCustomBgInput = 'FFFFFF';
                        this.headerCustomBorder = '#e5e6e5';
                        this.headerCustomBorderInput = 'E5E6E5';
                        this.headerBorderMode = 'default';
                        this.headerGlassEffect = true;

                        this.navStyle = 'harmony';
                        this.navDensity = 'default';
                        this.navIndicator = false;
                        this.navCustomActiveBg = '#f4f5f5';
                        this.navCustomActiveBgInput = 'F4F5F5';
                        this.navCustomActiveFg = '#0a0b0a';
                        this.navCustomActiveFgInput = '0A0B0A';
                        this.navCustomIndicator = '#18181b';
                        this.navCustomIndicatorInput = '18181B';

                        this.selectedSemantic = 'vibrant';
                        this.selectedChartPreset = 'rainbow';
                        this.selectedRadius = '0.5rem';
                        this.selectedFontName = 'Figtree';
                        this.selectedFontValue = "'Figtree', ui-sans-serif, system-ui, sans-serif";
                        this.tablesView = 'default';
                        this.reduceMotion = false;
                        this.glassEffect = true;

                        const root = document.documentElement;
                        root.style.removeProperty('--primary');
                        root.style.removeProperty('--color-primary');
                        root.style.removeProperty('--ring');
                        root.style.removeProperty('--color-ring');
                        root.style.removeProperty('--primary-foreground');
                        root.style.removeProperty('--color-primary-foreground');
                        root.style.removeProperty('--nav-active-bg');
                        root.style.removeProperty('--nav-active-fg');
                        root.style.removeProperty('--nav-hover-bg');
                        root.style.removeProperty('--nav-hover-fg');
                        root.style.removeProperty('--nav-indicator');
                        root.style.removeProperty('--color-nav-active-bg');
                        root.style.removeProperty('--color-nav-active-fg');
                        root.style.removeProperty('--color-nav-hover-bg');
                        root.style.removeProperty('--color-nav-hover-fg');
                        root.style.removeProperty('--color-nav-indicator');

                        if (window.VibeTheme?.clearCssOverride) {
                            window.VibeTheme.clearCssOverride();
                        }
                        try {
                            localStorage.removeItem(themeKey);
                        } catch (e) {}

                        this.setMode('system');
                        this.applyTheme();
                        this.notify('Semua token tema di-reset ke nilai bawaan.');
                    },

                    isLight(hex) {
                        if (!hex) return true;
                        let c = hex.replace('#', '');
                        if (c.length === 3) c = c[0] + c[0] + c[1] + c[1] + c[2] + c[2];
                        if (c.length < 6) return true;
                        const r = parseInt(c.substring(0, 2), 16) || 0;
                        const g = parseInt(c.substring(2, 4), 16) || 0;
                        const b = parseInt(c.substring(4, 6), 16) || 0;
                        return ((r * 299) + (g * 587) + (b * 114)) / 1000 > 128;
                    },

                    getResolvedSidebarColors(surface) {
                        let lightBg = surface.light.sidebar;
                        let darkBg = surface.dark.sidebar;
                        let lightBorder = this.highContrast ? '#71717a' : surface.light.border;
                        let darkBorder = this.highContrast ? '#a1a1aa' : surface.dark.border;

                        if (this.sidebarStyle === 'card') {
                            lightBg = surface.light.card;
                            darkBg = surface.dark.card;
                        } else if (this.sidebarStyle === 'contrast') {
                            lightBg = '#ffffff';
                            darkBg = '#0a0b0a';
                        } else if (this.sidebarStyle === 'muted') {
                            lightBg = '#f4f5f5';
                            darkBg = '#181918';
                        } else if (this.sidebarStyle === 'dark') {
                            lightBg = '#121312';
                            darkBg = '#121312';
                            lightBorder = '#262726';
                            darkBorder = '#262726';
                        } else if (this.sidebarStyle === 'custom') {
                            lightBg = this.sidebarCustomBg;
                            darkBg = this.sidebarCustomBg;
                            lightBorder = this.sidebarCustomBorder;
                            darkBorder = this.sidebarCustomBorder;
                        }

                        if (this.sidebarBorderMode === 'none') {
                            lightBorder = 'transparent';
                            darkBorder = 'transparent';
                        } else if (this.sidebarBorderMode === 'high') {
                            lightBorder = '#71717a';
                            darkBorder = '#a1a1aa';
                        }

                        const lightFg = this.isLight(lightBg) ? '#0a0b0a' : '#f9fafa';
                        const darkFg = this.isLight(darkBg) ? '#0a0b0a' : '#f9fafa';

                        return {
                            light: { bg: lightBg, fg: lightFg, border: lightBorder },
                            dark: { bg: darkBg, fg: darkFg, border: darkBorder }
                        };
                    },

                    getResolvedHeaderColors(surface) {
                        let lightBg = surface.light.header;
                        let darkBg = surface.dark.header;
                        let lightBorder = this.highContrast ? '#71717a' : surface.light.border;
                        let darkBorder = this.highContrast ? '#a1a1aa' : surface.dark.border;

                        if (this.headerStyle === 'card') {
                            lightBg = surface.light.card;
                            darkBg = surface.dark.card;
                        } else if (this.headerStyle === 'glass') {
                            lightBg = 'rgba(255, 255, 255, 0.82)';
                            darkBg = 'rgba(18, 19, 18, 0.82)';
                        } else if (this.headerStyle === 'contrast') {
                            lightBg = '#ffffff';
                            darkBg = '#0a0b0a';
                        } else if (this.headerStyle === 'muted') {
                            lightBg = '#f4f5f5';
                            darkBg = '#181918';
                        } else if (this.headerStyle === 'dark') {
                            lightBg = '#121312';
                            darkBg = '#121312';
                            lightBorder = '#262726';
                            darkBorder = '#262726';
                        } else if (this.headerStyle === 'custom') {
                            lightBg = this.headerCustomBg;
                            darkBg = this.headerCustomBg;
                            lightBorder = this.headerCustomBorder;
                            darkBorder = this.headerCustomBorder;
                        }

                        if (this.headerBorderMode === 'none') {
                            lightBorder = 'transparent';
                            darkBorder = 'transparent';
                        } else if (this.headerBorderMode === 'high') {
                            lightBorder = '#71717a';
                            darkBorder = '#a1a1aa';
                        }

                        const lightFg = this.isLight(lightBg) ? '#0a0b0a' : '#f9fafa';
                        const darkFg = this.isLight(darkBg) ? '#0a0b0a' : '#f9fafa';

                        return {
                            light: { bg: lightBg, fg: lightFg, border: lightBorder },
                            dark: { bg: darkBg, fg: darkFg, border: darkBorder }
                        };
                    },

                    getResolvedNavColors(surface, sb) {
                        let lightActiveBg = '#f4f5f5';
                        let darkActiveBg = '#1e1f1e';
                        let lightActiveFg = '#0a0b0a';
                        let darkActiveFg = '#f9fafa';
                        let lightHoverBg = '#f4f5f5';
                        let darkHoverBg = '#1e1f1e';
                        let lightHoverFg = '#0a0b0a';
                        let darkHoverFg = '#f9fafa';
                        let lightIndicator = this.customHex;
                        let darkIndicator = this.customHex;

                        if (this.navStyle === 'primary') {
                            lightActiveBg = this.customHex;
                            darkActiveBg = this.customHex;
                            const pFg = this.isLight(this.customHex) ? '#0a0b0a' : '#ffffff';
                            lightActiveFg = pFg;
                            darkActiveFg = pFg;
                            lightIndicator = this.customHex;
                            darkIndicator = this.customHex;
                        } else if (this.navStyle === 'line') {
                            lightActiveBg = 'transparent';
                            darkActiveBg = 'transparent';
                            lightActiveFg = sb.light.fg;
                            darkActiveFg = sb.dark.fg;
                            lightIndicator = this.customHex;
                            darkIndicator = this.customHex;
                        } else if (this.navStyle === 'subtle') {
                            lightActiveBg = '#f4f5f5';
                            darkActiveBg = '#181918';
                            lightActiveFg = '#0a0b0a';
                            darkActiveFg = '#f9fafa';
                            lightIndicator = this.customHex;
                            darkIndicator = this.customHex;
                        } else if (this.navStyle === 'custom') {
                            lightActiveBg = this.navCustomActiveBg;
                            darkActiveBg = this.navCustomActiveBg;
                            lightActiveFg = this.navCustomActiveFg;
                            darkActiveFg = this.navCustomActiveFg;
                            lightHoverBg = this.navCustomActiveBg;
                            darkHoverBg = this.navCustomActiveBg;
                            lightHoverFg = this.navCustomActiveFg;
                            darkHoverFg = this.navCustomActiveFg;
                            lightIndicator = this.navCustomIndicator;
                            darkIndicator = this.navCustomIndicator;
                        } else {
                            // 'harmony' (default)
                            if (this.sidebarStyle === 'custom') {
                                const isSidebarLight = this.isLight(this.sidebarCustomBg);
                                lightActiveBg = isSidebarLight ? 'rgba(0, 0, 0, 0.06)' : 'rgba(255, 255, 255, 0.12)';
                                darkActiveBg = lightActiveBg;
                                lightActiveFg = isSidebarLight ? '#0a0b0a' : '#ffffff';
                                darkActiveFg = lightActiveFg;
                                lightHoverBg = isSidebarLight ? 'rgba(0, 0, 0, 0.04)' : 'rgba(255, 255, 255, 0.08)';
                                darkHoverBg = lightHoverBg;
                                lightHoverFg = lightActiveFg;
                                darkHoverFg = darkActiveFg;
                            } else {
                                lightActiveBg = '#f4f5f5';
                                darkActiveBg = '#1e1f1e';
                                lightActiveFg = '#0a0b0a';
                                darkActiveFg = '#f9fafa';
                                lightHoverBg = '#f4f5f5';
                                darkHoverBg = '#1e1f1e';
                                lightHoverFg = '#0a0b0a';
                                darkHoverFg = '#f9fafa';
                            }
                            lightIndicator = this.customHex;
                            darkIndicator = this.customHex;
                        }

                        return {
                            light: {
                                activeBg: lightActiveBg,
                                activeFg: lightActiveFg,
                                hoverBg: lightHoverBg,
                                hoverFg: lightHoverFg,
                                indicator: lightIndicator
                            },
                            dark: {
                                activeBg: darkActiveBg,
                                activeFg: darkActiveFg,
                                hoverBg: darkHoverBg,
                                hoverFg: darkHoverFg,
                                indicator: darkIndicator
                            }
                        };
                    },

                    applyTheme() {
                        const isDarkNow = this.mode === 'dark' || (this.mode === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches);
                        const isDefaultSlate = (this.customHex === '#18181b');
                        const activePrimary = (isDefaultSlate && isDarkNow) ? '#f9fafa' : this.customHex;
                        const fg = this.isLight(activePrimary) ? '#0a0b0a' : '#ffffff';
                        const r = this.selectedRadius;
                        const surface = this.surfacePresets.find(s => s.id === this.selectedSurface) || this.surfacePresets[0];
                        const semantic = this.semanticPresets.find(s => s.id === this.selectedSemantic) || this.semanticPresets[0];
                        const chart = this.chartPresets.find(c => c.id === this.selectedChartPreset) || this.chartPresets[0];

                        const sb = this.getResolvedSidebarColors(surface);
                        const hd = this.getResolvedHeaderColors(surface);
                        const nav = this.getResolvedNavColors(surface, sb);

                        // Terapkan inline style langsung ke root <html> untuk prioritas tertinggi
                        const root = document.documentElement;
                        root.style.setProperty('--primary', activePrimary, 'important');
                        root.style.setProperty('--color-primary', activePrimary, 'important');
                        root.style.setProperty('--ring', activePrimary, 'important');
                        root.style.setProperty('--color-ring', activePrimary, 'important');
                        root.style.setProperty('--primary-foreground', fg, 'important');
                        root.style.setProperty('--color-primary-foreground', fg, 'important');

                        root.style.setProperty('--nav-active-bg', isDarkNow ? nav.dark.activeBg : nav.light.activeBg, 'important');
                        root.style.setProperty('--nav-active-fg', isDarkNow ? nav.dark.activeFg : nav.light.activeFg, 'important');
                        root.style.setProperty('--nav-hover-bg', isDarkNow ? nav.dark.hoverBg : nav.light.hoverBg, 'important');
                        root.style.setProperty('--nav-hover-fg', isDarkNow ? nav.dark.hoverFg : nav.light.hoverFg, 'important');
                        root.style.setProperty('--nav-indicator', isDarkNow ? nav.dark.indicator : nav.light.indicator, 'important');
                        root.style.setProperty('--color-nav-active-bg', isDarkNow ? nav.dark.activeBg : nav.light.activeBg, 'important');
                        root.style.setProperty('--color-nav-active-fg', isDarkNow ? nav.dark.activeFg : nav.light.activeFg, 'important');
                        root.style.setProperty('--color-nav-hover-bg', isDarkNow ? nav.dark.hoverBg : nav.light.hoverBg, 'important');
                        root.style.setProperty('--color-nav-hover-fg', isDarkNow ? nav.dark.hoverFg : nav.light.hoverFg, 'important');
                        root.style.setProperty('--color-nav-indicator', isDarkNow ? nav.dark.indicator : nav.light.indicator, 'important');

                        const lightPrimary = this.customHex;
                        const lightFg = this.isLight(lightPrimary) ? '#0a0b0a' : '#ffffff';
                        const darkPrimary = isDefaultSlate ? '#f9fafa' : this.customHex;
                        const darkFg = this.isLight(darkPrimary) ? '#0a0b0a' : '#ffffff';

                        let css = `
                            :root:root, html:root, html.dark, html:not(.dark), body, [data-canvas-theme] {
                                --font-sans: ${this.selectedFontValue} !important;
                                font-family: ${this.selectedFontValue} !important;
                                --radius: ${r} !important;
                                --radius-xs: calc(${r} * 0.3) !important;
                                --radius-sm: calc(${r} * 0.5) !important;
                                --radius-md: calc(${r} * 0.75) !important;
                                --radius-lg: ${r} !important;
                                --radius-xl: calc(${r} * 1.25) !important;
                                --radius-2xl: calc(${r} * 1.5) !important;
                                --radius-3xl: calc(${r} * 2) !important;

                                --success: ${semantic.colors.success} !important;
                                --warning: ${semantic.colors.warning} !important;
                                --destructive: ${semantic.colors.destructive} !important;
                                --info: ${semantic.colors.info} !important;

                                --chart-1: ${chart.colors[0]} !important;
                                --chart-2: ${chart.colors[1]} !important;
                                --chart-3: ${chart.colors[2]} !important;
                                --chart-4: ${chart.colors[3]} !important;
                                --chart-5: ${chart.colors[4]} !important;
                            }

                            :root:root, html:root, html:not(.dark), .light, [data-canvas-theme="light"] {
                                --primary: ${lightPrimary} !important;
                                --primary-foreground: ${lightFg} !important;
                                --ring: ${lightPrimary} !important;
                                --color-primary: ${lightPrimary} !important;
                                --color-primary-foreground: ${lightFg} !important;
                                --color-ring: ${lightPrimary} !important;

                                --background: ${surface.light.bg} !important;
                                --card: ${surface.light.card} !important;
                                --popover: ${surface.light.card} !important;
                                --container: ${surface.light.card} !important;
                                --container-border: ${this.highContrast ? '#71717a' : surface.light.border} !important;
                                --border: ${this.highContrast ? '#71717a' : surface.light.border} !important;
                                --input: ${this.highContrast ? '#71717a' : surface.light.border} !important;

                                --sidebar: ${sb.light.bg} !important;
                                --sidebar-foreground: ${sb.light.fg} !important;
                                --sidebar-border: ${sb.light.border} !important;
                                --color-sidebar: ${sb.light.bg} !important;
                                --color-sidebar-foreground: ${sb.light.fg} !important;
                                --color-sidebar-border: ${sb.light.border} !important;

                                --header: ${hd.light.bg} !important;
                                --header-foreground: ${hd.light.fg} !important;
                                --header-border: ${hd.light.border} !important;
                                --color-header: ${hd.light.bg} !important;
                                --color-header-foreground: ${hd.light.fg} !important;
                                --color-header-border: ${hd.light.border} !important;

                                --nav-active-bg: ${nav.light.activeBg} !important;
                                --nav-active-fg: ${nav.light.activeFg} !important;
                                --nav-hover-bg: ${nav.light.hoverBg} !important;
                                --nav-hover-fg: ${nav.light.hoverFg} !important;
                                --nav-indicator: ${nav.light.indicator} !important;
                                --color-nav-active-bg: ${nav.light.activeBg} !important;
                                --color-nav-active-fg: ${nav.light.activeFg} !important;
                                --color-nav-hover-bg: ${nav.light.hoverBg} !important;
                                --color-nav-hover-fg: ${nav.light.hoverFg} !important;
                                --color-nav-indicator: ${nav.light.indicator} !important;
                            }

                            :root:root, html.dark, html.dark *, .dark, [data-canvas-theme="dark"], .light .dark {
                                --primary: ${darkPrimary} !important;
                                --primary-foreground: ${darkFg} !important;
                                --ring: ${darkPrimary} !important;
                                --color-primary: ${darkPrimary} !important;
                                --color-primary-foreground: ${darkFg} !important;
                                --color-ring: ${darkPrimary} !important;

                                --background: ${surface.dark.bg} !important;
                                --card: ${surface.dark.card} !important;
                                --popover: ${surface.dark.card} !important;
                                --container: ${surface.dark.card} !important;
                                --container-border: ${this.highContrast ? '#a1a1aa' : surface.dark.border} !important;
                                --border: ${this.highContrast ? '#a1a1aa' : surface.dark.border} !important;
                                --input: ${this.highContrast ? '#a1a1aa' : surface.dark.border} !important;

                                --sidebar: ${sb.dark.bg} !important;
                                --sidebar-foreground: ${sb.dark.fg} !important;
                                --sidebar-border: ${sb.dark.border} !important;
                                --color-sidebar: ${sb.dark.bg} !important;
                                --color-sidebar-foreground: ${sb.dark.fg} !important;
                                --color-sidebar-border: ${sb.dark.border} !important;

                                --header: ${hd.dark.bg} !important;
                                --header-foreground: ${hd.dark.fg} !important;
                                --header-border: ${hd.dark.border} !important;
                                --color-header: ${hd.dark.bg} !important;
                                --color-header-foreground: ${hd.dark.fg} !important;
                                --color-header-border: ${hd.dark.border} !important;

                                --nav-active-bg: ${nav.dark.activeBg} !important;
                                --nav-active-fg: ${nav.dark.activeFg} !important;
                                --nav-hover-bg: ${nav.dark.hoverBg} !important;
                                --nav-hover-fg: ${nav.dark.hoverFg} !important;
                                --nav-indicator: ${nav.dark.indicator} !important;
                                --color-nav-active-bg: ${nav.dark.activeBg} !important;
                                --color-nav-active-fg: ${nav.dark.activeFg} !important;
                                --color-nav-hover-bg: ${nav.dark.hoverBg} !important;
                                --color-nav-hover-fg: ${nav.dark.hoverFg} !important;
                                --color-nav-indicator: ${nav.dark.indicator} !important;
                            }

                            body {
                                font-family: ${this.selectedFontValue} !important;
                            }
                        `;

                        // Sidebar custom rules
                        if (this.transparentSidebar) {
                            css += `
                                aside, [data-vibe-sidebar], .vibe-sidebar, .sidebar {
                                    background-color: transparent !important;
                                    backdrop-filter: blur(10px) !important;
                                    -webkit-backdrop-filter: blur(10px) !important;
                                }
                            `;
                        }

                        // Header glassmorphism rules
                        if (this.headerStyle === 'glass' || this.headerGlassEffect) {
                            css += `
                                header, [data-vibe-header], .vibe-header {
                                    backdrop-filter: blur(12px) !important;
                                    -webkit-backdrop-filter: blur(12px) !important;
                                }
                            `;
                        } else if (!this.headerGlassEffect) {
                            css += `
                                header, [data-vibe-header], .vibe-header {
                                    backdrop-filter: none !important;
                                    -webkit-backdrop-filter: none !important;
                                }
                            `;
                        }

                        // Navigation density rules
                        if (this.navDensity === 'compact') {
                            css += `
                                nav [data-pin-type="item"], nav [data-pin-type="group"] [data-nav-group-trigger] {
                                    min-height: 2rem !important;
                                    padding-top: 0.35rem !important;
                                    padding-bottom: 0.35rem !important;
                                    font-size: 0.75rem !important;
                                }
                            `;
                        } else if (this.navDensity === 'relaxed') {
                            css += `
                                nav [data-pin-type="item"], nav [data-pin-type="group"] [data-nav-group-trigger] {
                                    min-height: 2.5rem !important;
                                    padding-top: 0.6rem !important;
                                    padding-bottom: 0.6rem !important;
                                    font-size: 0.875rem !important;
                                }
                            `;
                        }

                        // Navigation indicator line rule
                        if (this.navIndicator || this.navStyle === 'line') {
                            css += `
                                nav [data-pin-type="item"].nav-item-active,
                                nav [data-pin-type="group"] [data-nav-group-trigger].nav-item-active,
                                [data-pin-type="item"].nav-item-active {
                                    position: relative !important;
                                }
                                nav [data-pin-type="item"].nav-item-active::before,
                                nav [data-pin-type="group"] [data-nav-group-trigger].nav-item-active::before,
                                [data-pin-type="item"].nav-item-active::before {
                                    content: "" !important;
                                    position: absolute !important;
                                    left: 0 !important;
                                    top: 0.375rem !important;
                                    bottom: 0.375rem !important;
                                    width: 0.25rem !important;
                                    border-top-right-radius: 0.25rem !important;
                                    border-bottom-right-radius: 0.25rem !important;
                                    background-color: var(--nav-indicator) !important;
                                }
                            `;
                        }

                        // Table compact density
                        if (this.tablesView === 'compact') {
                            css += `
                                table td, table th {
                                    padding-top: 0.35rem !important;
                                    padding-bottom: 0.35rem !important;
                                }
                            `;
                        }

                        // Reduced motion
                        if (this.reduceMotion) {
                            css += `
                                *, *::before, *::after {
                                    animation-duration: 0.01ms !important;
                                    animation-iteration-count: 1 !important;
                                    transition-duration: 0.01ms !important;
                                }
                            `;
                        }

                        // Global Glassmorphism toggle
                        if (!this.glassEffect) {
                            css += `
                                [class*="backdrop-blur"] {
                                    backdrop-filter: none !important;
                                    -webkit-backdrop-filter: none !important;
                                }
                            `;
                        }

                        let styleEl = document.getElementById(styleId);
                        if (!styleEl) {
                            styleEl = document.createElement('style');
                            styleEl.id = styleId;
                            styleEl.setAttribute('data-navigate-once', 'true');
                            document.head.appendChild(styleEl);
                        }
                        styleEl.textContent = css;
                        document.head.appendChild(styleEl); // Pindahkan ke paling akhir head agar prioritas tertinggi

                        // Sinkronkan ke ThemeManager agar persisten lintas halaman dan tidak ditimpa oleh Livewire
                        if (window.VibeTheme && typeof window.VibeTheme.setCssOverride === 'function') {
                            window.VibeTheme.setCssOverride(css, {
                                customHex: this.customHex,
                                sidebarStyle: this.sidebarStyle,
                                headerStyle: this.headerStyle,
                                navStyle: this.navStyle,
                                navDensity: this.navDensity,
                                navIndicator: this.navIndicator,
                                navCustomActiveBg: this.navCustomActiveBg,
                                navCustomActiveFg: this.navCustomActiveFg,
                                navCustomIndicator: this.navCustomIndicator,
                            });
                        }

                        this.saveState();
                    },

                    generateCssText() {
                        const fg = this.isLight(this.customHex) ? '#0a0b0a' : '#ffffff';
                        const r = this.selectedRadius;
                        const surface = this.surfacePresets.find(s => s.id === this.selectedSurface) || this.surfacePresets[0];
                        const semantic = this.semanticPresets.find(s => s.id === this.selectedSemantic) || this.semanticPresets[0];
                        const chart = this.chartPresets.find(c => c.id === this.selectedChartPreset) || this.chartPresets[0];

                        const sb = this.getResolvedSidebarColors(surface);
                        const hd = this.getResolvedHeaderColors(surface);
                        const nav = this.getResolvedNavColors(surface, sb);

                        return `:root {
    --primary: ${this.customHex};
    --primary-foreground: ${fg};
    --ring: ${this.customHex};
    --color-primary: ${this.customHex};
    --color-primary-foreground: ${fg};
    --color-ring: ${this.customHex};
    --font-sans: ${this.selectedFontValue};
    --radius: ${r};
    --success: ${semantic.colors.success};
    --warning: ${semantic.colors.warning};
    --destructive: ${semantic.colors.destructive};
    --info: ${semantic.colors.info};
    --chart-1: ${chart.colors[0]};
    --chart-2: ${chart.colors[1]};
    --chart-3: ${chart.colors[2]};
    --chart-4: ${chart.colors[3]};
    --chart-5: ${chart.colors[4]};
}

.light {
    --background: ${surface.light.bg};
    --card: ${surface.light.card};
    --popover: ${surface.light.card};
    --container: ${surface.light.card};
    --border: ${surface.light.border};
    --input: ${surface.light.border};
    --primary: ${this.customHex};
    --primary-foreground: ${fg};
    --ring: ${this.customHex};
    --color-primary: ${this.customHex};
    --color-primary-foreground: ${fg};
    --color-ring: ${this.customHex};
    --sidebar: ${sb.light.bg};
    --sidebar-foreground: ${sb.light.fg};
    --sidebar-border: ${sb.light.border};
    --header: ${hd.light.bg};
    --header-foreground: ${hd.light.fg};
    --header-border: ${hd.light.border};
    --nav-active-bg: ${nav.light.activeBg};
    --nav-active-fg: ${nav.light.activeFg};
    --nav-hover-bg: ${nav.light.hoverBg};
    --nav-hover-fg: ${nav.light.hoverFg};
    --nav-indicator: ${nav.light.indicator};
}

.dark {
    --background: ${surface.dark.bg};
    --card: ${surface.dark.card};
    --popover: ${surface.dark.card};
    --container: ${surface.dark.card};
    --border: ${surface.dark.border};
    --input: ${surface.dark.border};
    --primary: ${this.customHex};
    --primary-foreground: ${fg};
    --ring: ${this.customHex};
    --color-primary: ${this.customHex};
    --color-primary-foreground: ${fg};
    --color-ring: ${this.customHex};
    --sidebar: ${sb.dark.bg};
    --sidebar-foreground: ${sb.dark.fg};
    --sidebar-border: ${sb.dark.border};
    --header: ${hd.dark.bg};
    --header-foreground: ${hd.dark.fg};
    --header-border: ${hd.dark.border};
    --nav-active-bg: ${nav.dark.activeBg};
    --nav-active-fg: ${nav.dark.activeFg};
    --nav-hover-bg: ${nav.dark.hoverBg};
    --nav-hover-fg: ${nav.dark.hoverFg};
    --nav-indicator: ${nav.dark.indicator};
}`;
                    },

                    copyCssVariables() {
                        const css = this.generateCssText();
                        navigator.clipboard?.writeText(css).then(() => {
                            this.copied = true;
                            this.notify('Design tokens CSS berhasil disalin ke clipboard!');
                            setTimeout(() => this.copied = false, 2500);
                        }).catch(() => {
                            this.notify('Gagal menyalin CSS tokens.');
                        });
                    },

                    saveState() {
                        try {
                            localStorage.setItem(themeKey, JSON.stringify({
                                mode: this.mode,
                                customHex: this.customHex,
                                highContrast: this.highContrast,
                                selectedSurface: this.selectedSurface,

                                sidebarStyle: this.sidebarStyle,
                                sidebarCustomBg: this.sidebarCustomBg,
                                sidebarCustomBorder: this.sidebarCustomBorder,
                                sidebarBorderMode: this.sidebarBorderMode,
                                transparentSidebar: this.transparentSidebar,
                                sidebarFeature: this.sidebarFeature,

                                headerStyle: this.headerStyle,
                                headerCustomBg: this.headerCustomBg,
                                headerCustomBorder: this.headerCustomBorder,
                                headerBorderMode: this.headerBorderMode,
                                headerGlassEffect: this.headerGlassEffect,

                                navStyle: this.navStyle,
                                navDensity: this.navDensity,
                                navIndicator: this.navIndicator,
                                navCustomActiveBg: this.navCustomActiveBg,
                                navCustomActiveFg: this.navCustomActiveFg,
                                navCustomIndicator: this.navCustomIndicator,

                                selectedSemantic: this.selectedSemantic,
                                selectedChartPreset: this.selectedChartPreset,
                                selectedRadius: this.selectedRadius,
                                selectedFontName: this.selectedFontName,
                                selectedFontValue: this.selectedFontValue,
                                tablesView: this.tablesView,
                                reduceMotion: this.reduceMotion,
                                glassEffect: this.glassEffect,
                            }));
                        } catch (e) {}
                    },

                    notify(message) {
                        if (window.vibeToast) {
                            window.vibeToast(message, { type: 'success', title: 'Appearance & Tokens' });
                        }
                    }
                };
            }

            if (typeof window !== 'undefined') {
                window.appearanceController = appearanceController;
                if (window.Alpine) {
                    window.Alpine.data('appearanceController', appearanceController);
                } else {
                    document.addEventListener('alpine:init', () => {
                        window.Alpine.data('appearanceController', appearanceController);
                    });
                }
            }
        </script>
    @endpush
</x-docs.layouts.sidebar>
