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
                            <div class="flex items-center gap-2">
                                <h3 class="font-semibold text-foreground text-base">Custom primary color</h3>
                                <span class="text-[10px] font-medium px-2 py-0.5 rounded-full bg-primary/10 text-primary border border-primary/20">Light & Dark</span>
                            </div>
                            <p class="text-muted-foreground text-xs">Mengatur token warna primer utama (<code class="font-mono text-[11px] font-semibold text-primary px-1.5 py-0.5 rounded bg-primary/10">--primary</code>, <code class="font-mono text-[11px] font-semibold text-primary px-1.5 py-0.5 rounded bg-primary/10">--ring</code>) untuk tombol, badge, fokus kontrol, dan elemen interaktif di kedua mode.</p>
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
                            <vibe:card class="max-w-2xl p-3.5 border border-border/80 bg-card hover:border-border transition-all shadow-2xs">
                                <div class="flex items-center gap-3">
                                    <div class="size-8 rounded-lg bg-primary/10 text-primary flex items-center justify-center shrink-0 ring-1 ring-primary/20">
                                        <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="10" />
                                            <path d="M12 18a6 6 0 0 0 0-12v12z" fill="currentColor" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <vibe:switch 
                                            label="Mode Kontras Tinggi" 
                                            description="Pertegas garis pembatas dan kontur elemen antarmuka untuk keterbacaan lebih optimal." 
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
                                <h3 class="font-semibold text-foreground text-base">Canvas & surface palette</h3>
                                <span class="text-[10px] font-medium px-2 py-0.5 rounded-full border transition-colors" :class="isDarkNow ? 'bg-zinc-900 text-zinc-200 border-zinc-700' : 'bg-amber-100/70 text-amber-900 border-amber-300'" x-text="isDarkNow ? 'Mode Gelap' : 'Mode Terang'"></span>
                            </div>
                            <p class="text-muted-foreground text-xs">Pilih nuansa warna dasar kanvas (<code class="font-mono text-[11px] font-semibold text-foreground px-1.5 py-0.5 rounded bg-muted">--background</code>, <code class="font-mono text-[11px] font-semibold text-foreground px-1.5 py-0.5 rounded bg-muted">--card</code>, <code class="font-mono text-[11px] font-semibold text-foreground px-1.5 py-0.5 rounded bg-muted">--popover</code>) khusus untuk mode aktif saat ini.</p>
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
                                        <div class="size-9 rounded-lg border border-border/80 p-1 flex items-center justify-center shrink-0 shadow-2xs" :style="{ backgroundColor: isDarkNow ? surface.dark.bg : surface.light.bg }">
                                            <div class="size-4 rounded-sm border border-border/60 shadow-2xs" :style="{ backgroundColor: isDarkNow ? surface.dark.card : surface.light.card }"></div>
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
                            <div class="flex items-center gap-2">
                                <h3 class="font-semibold text-foreground text-base">Desktop sidebar</h3>
                                <span class="text-[10px] font-medium px-2 py-0.5 rounded-full border transition-colors" :class="isDarkNow ? 'bg-zinc-900 text-zinc-200 border-zinc-700' : 'bg-amber-100/70 text-amber-900 border-amber-300'" x-text="isDarkNow ? 'Mode Gelap' : 'Mode Terang'"></span>
                            </div>
                            <p class="text-muted-foreground text-xs">Kustomisasi token bilah sisi (<code class="font-mono text-[11px] font-semibold text-foreground px-1.5 py-0.5 rounded bg-muted">--sidebar</code>, <code class="font-mono text-[11px] font-semibold text-foreground px-1.5 py-0.5 rounded bg-muted">--sidebar-border</code>), palet permukaan, garis batas, dan transparansi untuk mode aktif saat ini.</p>
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
                            <div class="flex items-center gap-2">
                                <h3 class="font-semibold text-foreground text-base">Navigation items (Nav)</h3>
                                <span class="text-[10px] font-medium px-2 py-0.5 rounded-full border transition-colors" :class="isDarkNow ? 'bg-zinc-900 text-zinc-200 border-zinc-700' : 'bg-amber-100/70 text-amber-900 border-amber-300'" x-text="isDarkNow ? 'Mode Gelap' : 'Mode Terang'"></span>
                            </div>
                            <p class="text-muted-foreground text-xs">Kustomisasi token item navigasi (<code class="font-mono text-[11px] font-semibold text-foreground px-1.5 py-0.5 rounded bg-muted">--nav-active-bg</code>, <code class="font-mono text-[11px] font-semibold text-foreground px-1.5 py-0.5 rounded bg-muted">--nav-active-fg</code>, <code class="font-mono text-[11px] font-semibold text-foreground px-1.5 py-0.5 rounded bg-muted">--nav-indicator</code>), gaya aktif, garis indikator, dan kerapatan baris untuk mode aktif saat ini.</p>
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
                                <h3 class="font-semibold text-foreground text-base">Application header</h3>
                                <span class="text-[10px] font-medium px-2 py-0.5 rounded-full border transition-colors" :class="isDarkNow ? 'bg-zinc-900 text-zinc-200 border-zinc-700' : 'bg-amber-100/70 text-amber-900 border-amber-300'" x-text="isDarkNow ? 'Mode Gelap' : 'Mode Terang'"></span>
                            </div>
                            <p class="text-muted-foreground text-xs">Kustomisasi token bilah atas (<code class="font-mono text-[11px] font-semibold text-foreground px-1.5 py-0.5 rounded bg-muted">--header</code>, <code class="font-mono text-[11px] font-semibold text-foreground px-1.5 py-0.5 rounded bg-muted">--header-border</code>), gaya permukaan, garis batas, dan transparansi blur untuk mode aktif saat ini.</p>
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
                                    @change="toggleHeaderGlassEffect($el.checked)" 
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
                            <p class="text-muted-foreground text-xs">Palet warna grafik analitik (<code class="font-mono text-[11px] font-semibold text-foreground px-1.5 py-0.5 rounded bg-muted">--chart-1</code> s/d <code class="font-mono text-[11px] font-semibold text-foreground px-1.5 py-0.5 rounded bg-muted">--chart-5</code>) pada dashboard dan diagram data.</p>
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
                            <p class="text-muted-foreground text-xs">Derajat kelengkungan sudut (<code class="font-mono text-[11px] font-semibold text-foreground px-1.5 py-0.5 rounded bg-muted">--radius</code>) pada kartu, tombol, badge, dan kontrol input.</p>
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
                            <p class="text-muted-foreground text-xs">Pilih font antarmuka sistem utama (<code class="font-mono text-[11px] font-semibold text-foreground px-1.5 py-0.5 rounded bg-muted">--font-sans</code>).</p>
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
                                    @change="toggleMotion($el.checked)" 
                                />
                            </vibe:card>

                            <vibe:card class="p-3.5 border border-border/80 bg-card">
                                <vibe:switch 
                                    label="Backdrop Blur Glassmorphism" 
                                    description="Efek blur modern pada header, bilah dialog, dan popover." 
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

    @push('body')
        <script>
            function appearanceController() {
                const prefix = window.VIBE_PREFIX || '{{ config('vibe.prefix', 'vibe') }}';
                const themeKey = prefix + '-theme-tokens';
                const styleId = prefix + '-theme-override';

                return {
                    isDarkNow: false,

                    mode: window.VibeTheme?.getConfig()?.mode || (document.documentElement.classList.contains('dark') ? 'dark' : 'light'),
                    customHex: '#18181b',
                    customHexInput: '18181B',
                    highContrast: false,
                    motionActive: true,

                    // Surface
                    selectedSurface: 'zinc',
                    selectedSurfaceLight: 'zinc',
                    selectedSurfaceDark: 'zinc',
                    
                    // Sidebar States
                    sidebarStyle: 'default',
                    sidebarStyleLight: 'default',
                    sidebarStyleDark: 'default',
                    sidebarCustomBg: '#ffffff',
                    sidebarCustomBgLight: '#ffffff',
                    sidebarCustomBgDark: '#121312',
                    sidebarCustomBgInput: 'FFFFFF',
                    sidebarCustomBorder: '#e5e6e5',
                    sidebarCustomBorderLight: '#e5e6e5',
                    sidebarCustomBorderDark: '#262726',
                    sidebarCustomBorderInput: 'E5E6E5',
                    sidebarBorderMode: 'default',
                    sidebarBorderModeLight: 'default',
                    sidebarBorderModeDark: 'default',
                    transparentSidebar: false,
                    transparentSidebarLight: false,
                    transparentSidebarDark: false,
                    sidebarFeature: 'Recent changes',

                    // Nav States
                    navStyle: 'harmony',
                    navStyleLight: 'harmony',
                    navStyleDark: 'harmony',
                    navDensity: 'default',
                    navDensityLight: 'default',
                    navDensityDark: 'default',
                    navIndicator: false,
                    navIndicatorLight: false,
                    navIndicatorDark: false,
                    navCustomActiveBg: '#f4f5f5',
                    navCustomActiveBgLight: '#f4f5f5',
                    navCustomActiveBgDark: '#1e1f1e',
                    navCustomActiveBgInput: 'F4F5F5',
                    navCustomActiveFg: '#0a0b0a',
                    navCustomActiveFgLight: '#0a0b0a',
                    navCustomActiveFgDark: '#f9fafa',
                    navCustomActiveFgInput: '0A0B0A',
                    navCustomIndicator: '#18181b',
                    navCustomIndicatorLight: '#18181b',
                    navCustomIndicatorDark: '#f9fafa',
                    navCustomIndicatorInput: '18181B',

                    // Header States
                    headerStyle: 'default',
                    headerStyleLight: 'default',
                    headerStyleDark: 'default',
                    headerCustomBg: '#ffffff',
                    headerCustomBgLight: '#ffffff',
                    headerCustomBgDark: '#121312',
                    headerCustomBgInput: 'FFFFFF',
                    headerCustomBorder: '#e5e6e5',
                    headerCustomBorderLight: '#e5e6e5',
                    headerCustomBorderDark: '#262726',
                    headerCustomBorderInput: 'E5E6E5',
                    headerBorderMode: 'default',
                    headerBorderModeLight: 'default',
                    headerBorderModeDark: 'default',
                    headerGlassEffect: true,
                    headerGlassEffectLight: true,
                    headerGlassEffectDark: true,

                    selectedSemantic: 'vibrant',
                    selectedChartPreset: 'rainbow',
                    selectedRadius: '0.5rem',
                    selectedFontName: 'Figtree',
                    selectedFontValue: "'Figtree', ui-sans-serif, system-ui, sans-serif",
                    tablesView: 'default',
                    reduceMotion: false,
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

                    updateIsDarkNow() {
                        if (this.mode === 'dark') {
                            this.isDarkNow = true;
                        } else if (this.mode === 'light') {
                            this.isDarkNow = false;
                        } else {
                            this.isDarkNow = window.matchMedia('(prefers-color-scheme: dark)').matches;
                        }
                    },

                    syncActiveModeValues() {
                        if (this.isDarkNow) {
                            this.selectedSurface = this.selectedSurfaceDark;

                            this.sidebarStyle = this.sidebarStyleDark;
                            this.sidebarCustomBg = this.sidebarCustomBgDark;
                            this.sidebarCustomBgInput = (this.sidebarCustomBgDark || '').replace('#', '').toUpperCase();
                            this.sidebarCustomBorder = this.sidebarCustomBorderDark;
                            this.sidebarCustomBorderInput = (this.sidebarCustomBorderDark || '').replace('#', '').toUpperCase();
                            this.sidebarBorderMode = this.sidebarBorderModeDark;
                            this.transparentSidebar = this.transparentSidebarDark;

                            this.headerStyle = this.headerStyleDark;
                            this.headerCustomBg = this.headerCustomBgDark;
                            this.headerCustomBgInput = (this.headerCustomBgDark || '').replace('#', '').toUpperCase();
                            this.headerCustomBorder = this.headerCustomBorderDark;
                            this.headerCustomBorderInput = (this.headerCustomBorderDark || '').replace('#', '').toUpperCase();
                            this.headerBorderMode = this.headerBorderModeDark;
                            this.headerGlassEffect = this.headerGlassEffectDark;

                            this.navStyle = this.navStyleDark;
                            this.navDensity = this.navDensityDark;
                            this.navIndicator = this.navIndicatorDark;
                            this.navCustomActiveBg = this.navCustomActiveBgDark;
                            this.navCustomActiveBgInput = (this.navCustomActiveBgDark || '').replace('#', '').toUpperCase();
                            this.navCustomActiveFg = this.navCustomActiveFgDark;
                            this.navCustomActiveFgInput = (this.navCustomActiveFgDark || '').replace('#', '').toUpperCase();
                            this.navCustomIndicator = this.navCustomIndicatorDark;
                            this.navCustomIndicatorInput = (this.navCustomIndicatorDark || '').replace('#', '').toUpperCase();
                        } else {
                            this.selectedSurface = this.selectedSurfaceLight;

                            this.sidebarStyle = this.sidebarStyleLight;
                            this.sidebarCustomBg = this.sidebarCustomBgLight;
                            this.sidebarCustomBgInput = (this.sidebarCustomBgLight || '').replace('#', '').toUpperCase();
                            this.sidebarCustomBorder = this.sidebarCustomBorderLight;
                            this.sidebarCustomBorderInput = (this.sidebarCustomBorderLight || '').replace('#', '').toUpperCase();
                            this.sidebarBorderMode = this.sidebarBorderModeLight;
                            this.transparentSidebar = this.transparentSidebarLight;

                            this.headerStyle = this.headerStyleLight;
                            this.headerCustomBg = this.headerCustomBgLight;
                            this.headerCustomBgInput = (this.headerCustomBgLight || '').replace('#', '').toUpperCase();
                            this.headerCustomBorder = this.headerCustomBorderLight;
                            this.headerCustomBorderInput = (this.headerCustomBorderLight || '').replace('#', '').toUpperCase();
                            this.headerBorderMode = this.headerBorderModeLight;
                            this.headerGlassEffect = this.headerGlassEffectLight;

                            this.navStyle = this.navStyleLight;
                            this.navDensity = this.navDensityLight;
                            this.navIndicator = this.navIndicatorLight;
                            this.navCustomActiveBg = this.navCustomActiveBgLight;
                            this.navCustomActiveBgInput = (this.navCustomActiveBgLight || '').replace('#', '').toUpperCase();
                            this.navCustomActiveFg = this.navCustomActiveFgLight;
                            this.navCustomActiveFgInput = (this.navCustomActiveFgLight || '').replace('#', '').toUpperCase();
                            this.navCustomIndicator = this.navCustomIndicatorLight;
                            this.navCustomIndicatorInput = (this.navCustomIndicatorLight || '').replace('#', '').toUpperCase();
                        }
                    },

                    init() {
                        this.updateIsDarkNow();
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
                                this.updateIsDarkNow();

                                if (parsed.customHex) {
                                    this.customHex = parsed.customHex;
                                    this.customHexInput = parsed.customHex.replace('#', '').toUpperCase();
                                }
                                if (typeof parsed.highContrast !== 'undefined') this.highContrast = !!parsed.highContrast;

                                // Surface
                                if (parsed.selectedSurfaceLight) this.selectedSurfaceLight = parsed.selectedSurfaceLight;
                                if (parsed.selectedSurfaceDark) this.selectedSurfaceDark = parsed.selectedSurfaceDark;
                                if (parsed.selectedSurface && !parsed.selectedSurfaceLight && !parsed.selectedSurfaceDark) {
                                    this.selectedSurfaceLight = parsed.selectedSurface;
                                    this.selectedSurfaceDark = parsed.selectedSurface;
                                }

                                // Sidebar
                                if (parsed.sidebarStyleLight) this.sidebarStyleLight = parsed.sidebarStyleLight;
                                if (parsed.sidebarStyleDark) this.sidebarStyleDark = parsed.sidebarStyleDark;
                                if (parsed.sidebarStyle && !parsed.sidebarStyleLight) {
                                    this.sidebarStyleLight = parsed.sidebarStyle;
                                    this.sidebarStyleDark = parsed.sidebarStyle;
                                }

                                if (parsed.sidebarCustomBgLight) this.sidebarCustomBgLight = parsed.sidebarCustomBgLight;
                                if (parsed.sidebarCustomBgDark) this.sidebarCustomBgDark = parsed.sidebarCustomBgDark;
                                if (parsed.sidebarCustomBg && !parsed.sidebarCustomBgLight) {
                                    this.sidebarCustomBgLight = parsed.sidebarCustomBg;
                                    this.sidebarCustomBgDark = parsed.sidebarCustomBg;
                                }

                                if (parsed.sidebarCustomBorderLight) this.sidebarCustomBorderLight = parsed.sidebarCustomBorderLight;
                                if (parsed.sidebarCustomBorderDark) this.sidebarCustomBorderDark = parsed.sidebarCustomBorderDark;
                                if (parsed.sidebarCustomBorder && !parsed.sidebarCustomBorderLight) {
                                    this.sidebarCustomBorderLight = parsed.sidebarCustomBorder;
                                    this.sidebarCustomBorderDark = parsed.sidebarCustomBorder;
                                }

                                if (parsed.sidebarBorderModeLight) this.sidebarBorderModeLight = parsed.sidebarBorderModeLight;
                                if (parsed.sidebarBorderModeDark) this.sidebarBorderModeDark = parsed.sidebarBorderModeDark;
                                if (parsed.sidebarBorderMode && !parsed.sidebarBorderModeLight) {
                                    this.sidebarBorderModeLight = parsed.sidebarBorderMode;
                                    this.sidebarBorderModeDark = parsed.sidebarBorderMode;
                                }

                                if (typeof parsed.transparentSidebarLight !== 'undefined') this.transparentSidebarLight = !!parsed.transparentSidebarLight;
                                if (typeof parsed.transparentSidebarDark !== 'undefined') this.transparentSidebarDark = !!parsed.transparentSidebarDark;
                                if (typeof parsed.transparentSidebar !== 'undefined' && typeof parsed.transparentSidebarLight === 'undefined') {
                                    this.transparentSidebarLight = !!parsed.transparentSidebar;
                                    this.transparentSidebarDark = !!parsed.transparentSidebar;
                                }
                                if (parsed.sidebarFeature) this.sidebarFeature = parsed.sidebarFeature;

                                // Header
                                if (parsed.headerStyleLight) this.headerStyleLight = parsed.headerStyleLight;
                                if (parsed.headerStyleDark) this.headerStyleDark = parsed.headerStyleDark;
                                if (parsed.headerStyle && !parsed.headerStyleLight) {
                                    this.headerStyleLight = parsed.headerStyle;
                                    this.headerStyleDark = parsed.headerStyle;
                                }

                                if (parsed.headerCustomBgLight) this.headerCustomBgLight = parsed.headerCustomBgLight;
                                if (parsed.headerCustomBgDark) this.headerCustomBgDark = parsed.headerCustomBgDark;
                                if (parsed.headerCustomBg && !parsed.headerCustomBgLight) {
                                    this.headerCustomBgLight = parsed.headerCustomBg;
                                    this.headerCustomBgDark = parsed.headerCustomBg;
                                }

                                if (parsed.headerCustomBorderLight) this.headerCustomBorderLight = parsed.headerCustomBorderLight;
                                if (parsed.headerCustomBorderDark) this.headerCustomBorderDark = parsed.headerCustomBorderDark;
                                if (parsed.headerCustomBorder && !parsed.headerCustomBorderLight) {
                                    this.headerCustomBorderLight = parsed.headerCustomBorder;
                                    this.headerCustomBorderDark = parsed.headerCustomBorder;
                                }

                                if (parsed.headerBorderModeLight) this.headerBorderModeLight = parsed.headerBorderModeLight;
                                if (parsed.headerBorderModeDark) this.headerBorderModeDark = parsed.headerBorderModeDark;
                                if (parsed.headerBorderMode && !parsed.headerBorderModeLight) {
                                    this.headerBorderModeLight = parsed.headerBorderMode;
                                    this.headerBorderModeDark = parsed.headerBorderMode;
                                }

                                if (typeof parsed.headerGlassEffectLight !== 'undefined') this.headerGlassEffectLight = !!parsed.headerGlassEffectLight;
                                if (typeof parsed.headerGlassEffectDark !== 'undefined') this.headerGlassEffectDark = !!parsed.headerGlassEffectDark;
                                if (typeof parsed.headerGlassEffect !== 'undefined' && typeof parsed.headerGlassEffectLight === 'undefined') {
                                    this.headerGlassEffectLight = !!parsed.headerGlassEffect;
                                    this.headerGlassEffectDark = !!parsed.headerGlassEffect;
                                }

                                // Nav
                                if (parsed.navStyleLight) this.navStyleLight = parsed.navStyleLight;
                                if (parsed.navStyleDark) this.navStyleDark = parsed.navStyleDark;
                                if (parsed.navStyle && !parsed.navStyleLight) {
                                    this.navStyleLight = parsed.navStyle;
                                    this.navStyleDark = parsed.navStyle;
                                }

                                if (parsed.navDensityLight) this.navDensityLight = parsed.navDensityLight;
                                if (parsed.navDensityDark) this.navDensityDark = parsed.navDensityDark;
                                if (parsed.navDensity && !parsed.navDensityLight) {
                                    this.navDensityLight = parsed.navDensity;
                                    this.navDensityDark = parsed.navDensity;
                                }

                                if (typeof parsed.navIndicatorLight !== 'undefined') this.navIndicatorLight = !!parsed.navIndicatorLight;
                                if (typeof parsed.navIndicatorDark !== 'undefined') this.navIndicatorDark = !!parsed.navIndicatorDark;
                                if (typeof parsed.navIndicator !== 'undefined' && typeof parsed.navIndicatorLight === 'undefined') {
                                    this.navIndicatorLight = !!parsed.navIndicator;
                                    this.navIndicatorDark = !!parsed.navIndicator;
                                }

                                if (parsed.navCustomActiveBgLight) this.navCustomActiveBgLight = parsed.navCustomActiveBgLight;
                                if (parsed.navCustomActiveBgDark) this.navCustomActiveBgDark = parsed.navCustomActiveBgDark;
                                if (parsed.navCustomActiveBg && !parsed.navCustomActiveBgLight) {
                                    this.navCustomActiveBgLight = parsed.navCustomActiveBg;
                                    this.navCustomActiveBgDark = parsed.navCustomActiveBg;
                                }

                                if (parsed.navCustomActiveFgLight) this.navCustomActiveFgLight = parsed.navCustomActiveFgLight;
                                if (parsed.navCustomActiveFgDark) this.navCustomActiveFgDark = parsed.navCustomActiveFgDark;
                                if (parsed.navCustomActiveFg && !parsed.navCustomActiveFgLight) {
                                    this.navCustomActiveFgLight = parsed.navCustomActiveFg;
                                    this.navCustomActiveFgDark = parsed.navCustomActiveFg;
                                }

                                if (parsed.navCustomIndicatorLight) this.navCustomIndicatorLight = parsed.navCustomIndicatorLight;
                                if (parsed.navCustomIndicatorDark) this.navCustomIndicatorDark = parsed.navCustomIndicatorDark;
                                if (parsed.navCustomIndicator && !parsed.navCustomIndicatorLight) {
                                    this.navCustomIndicatorLight = parsed.navCustomIndicator;
                                    this.navCustomIndicatorDark = parsed.navCustomIndicator;
                                }

                                // Global
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

                        this.syncActiveModeValues();

                        const shouldBeDark = this.mode === 'dark' || (this.mode === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches);
                        if (document.documentElement.classList.contains('dark') !== shouldBeDark) {
                            if (window.VibeTheme?.applyTheme) {
                                window.VibeTheme.applyTheme(this.mode);
                            } else {
                                document.documentElement.classList.toggle('dark', shouldBeDark);
                            }
                        }

                        // Listen for system theme changes
                        const mediaDark = window.matchMedia('(prefers-color-scheme: dark)');
                        if (mediaDark.addEventListener) {
                            mediaDark.addEventListener('change', () => {
                                if (this.mode === 'system') {
                                    this.updateIsDarkNow();
                                    this.syncActiveModeValues();
                                    this.applyTheme();
                                }
                            });
                        }

                        window.addEventListener('vibe-theme-changed', (e) => {
                            if (e.detail && e.detail.mode && e.detail.mode !== this.mode) {
                                this.mode = e.detail.mode;
                                this.updateIsDarkNow();
                                this.syncActiveModeValues();
                                this.applyTheme();
                            }
                        });

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

                    // Surface Selection
                    selectSurfacePreset(id) {
                        if (this.isDarkNow) {
                            this.selectedSurfaceDark = id;
                        } else {
                            this.selectedSurfaceLight = id;
                        }
                        this.selectedSurface = id;
                        this.applyTheme();
                        this.notify(`Kanvas permukaan (${this.isDarkNow ? 'Mode Gelap' : 'Mode Terang'}) diperbarui.`);
                    },

                    // Sidebar Methods
                    selectSidebarStyle(id) {
                        if (this.isDarkNow) {
                            this.sidebarStyleDark = id;
                        } else {
                            this.sidebarStyleLight = id;
                        }
                        this.sidebarStyle = id;
                        this.applyTheme();
                        this.notify(`Gaya bilah sisi (${this.isDarkNow ? 'Mode Gelap' : 'Mode Terang'}): ${id}`);
                    },

                    selectSidebarBorderMode(mode) {
                        if (this.isDarkNow) {
                            this.sidebarBorderModeDark = mode;
                        } else {
                            this.sidebarBorderModeLight = mode;
                        }
                        this.sidebarBorderMode = mode;
                        this.applyTheme();
                        this.notify(`Batas border sidebar (${this.isDarkNow ? 'Mode Gelap' : 'Mode Terang'}): ${mode}`);
                    },

                    onSidebarCustomBgChange(val) {
                        if (this.isDarkNow) {
                            this.sidebarCustomBgDark = val;
                        } else {
                            this.sidebarCustomBgLight = val;
                        }
                        this.sidebarCustomBg = val;
                        this.sidebarCustomBgInput = val.replace('#', '').toUpperCase();
                        this.applyTheme();
                    },

                    onSidebarCustomBgInput(val) {
                        let clean = val.replace(/[^0-9A-Fa-f]/g, '').slice(0, 6);
                        this.sidebarCustomBgInput = clean.toUpperCase();
                        if (clean.length === 6 || clean.length === 3) {
                            const hex = '#' + clean;
                            if (this.isDarkNow) {
                                this.sidebarCustomBgDark = hex;
                            } else {
                                this.sidebarCustomBgLight = hex;
                            }
                            this.sidebarCustomBg = hex;
                            this.applyTheme();
                        }
                    },

                    onSidebarCustomBorderChange(val) {
                        if (this.isDarkNow) {
                            this.sidebarCustomBorderDark = val;
                        } else {
                            this.sidebarCustomBorderLight = val;
                        }
                        this.sidebarCustomBorder = val;
                        this.sidebarCustomBorderInput = val.replace('#', '').toUpperCase();
                        this.applyTheme();
                    },

                    onSidebarCustomBorderInput(val) {
                        let clean = val.replace(/[^0-9A-Fa-f]/g, '').slice(0, 6);
                        this.sidebarCustomBorderInput = clean.toUpperCase();
                        if (clean.length === 6 || clean.length === 3) {
                            const hex = '#' + clean;
                            if (this.isDarkNow) {
                                this.sidebarCustomBorderDark = hex;
                            } else {
                                this.sidebarCustomBorderLight = hex;
                            }
                            this.sidebarCustomBorder = hex;
                            this.applyTheme();
                        }
                    },

                    toggleTransparentSidebar() {
                        const next = !this.transparentSidebar;
                        if (this.isDarkNow) {
                            this.transparentSidebarDark = next;
                        } else {
                            this.transparentSidebarLight = next;
                        }
                        this.transparentSidebar = next;
                        this.applyTheme();
                        this.notify(this.transparentSidebar ? `Sidebar transparan (${this.isDarkNow ? 'Mode Gelap' : 'Mode Terang'}) aktif.` : `Sidebar solid (${this.isDarkNow ? 'Mode Gelap' : 'Mode Terang'}) aktif.`);
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
                        if (this.isDarkNow) {
                            this.headerStyleDark = id;
                        } else {
                            this.headerStyleLight = id;
                        }
                        this.headerStyle = id;
                        this.applyTheme();
                        this.notify(`Gaya bilah atas (${this.isDarkNow ? 'Mode Gelap' : 'Mode Terang'}): ${id}`);
                    },

                    selectHeaderBorderMode(mode) {
                        if (this.isDarkNow) {
                            this.headerBorderModeDark = mode;
                        } else {
                            this.headerBorderModeLight = mode;
                        }
                        this.headerBorderMode = mode;
                        this.applyTheme();
                        this.notify(`Batas border header (${this.isDarkNow ? 'Mode Gelap' : 'Mode Terang'}): ${mode}`);
                    },

                    toggleHeaderGlassEffect(val) {
                        const next = typeof val !== 'undefined' ? !!val : !this.headerGlassEffect;
                        if (this.isDarkNow) {
                            this.headerGlassEffectDark = next;
                        } else {
                            this.headerGlassEffectLight = next;
                        }
                        this.headerGlassEffect = next;
                        this.applyTheme();
                        this.notify(this.headerGlassEffect ? `Header glassmorphism (${this.isDarkNow ? 'Mode Gelap' : 'Mode Terang'}) aktif.` : `Header glassmorphism (${this.isDarkNow ? 'Mode Gelap' : 'Mode Terang'}) nonaktif.`);
                    },

                    onHeaderCustomBgChange(val) {
                        if (this.isDarkNow) {
                            this.headerCustomBgDark = val;
                        } else {
                            this.headerCustomBgLight = val;
                        }
                        this.headerCustomBg = val;
                        this.headerCustomBgInput = val.replace('#', '').toUpperCase();
                        this.applyTheme();
                    },

                    onHeaderCustomBgInput(val) {
                        let clean = val.replace(/[^0-9A-Fa-f]/g, '').slice(0, 6);
                        this.headerCustomBgInput = clean.toUpperCase();
                        if (clean.length === 6 || clean.length === 3) {
                            const hex = '#' + clean;
                            if (this.isDarkNow) {
                                this.headerCustomBgDark = hex;
                            } else {
                                this.headerCustomBgLight = hex;
                            }
                            this.headerCustomBg = hex;
                            this.applyTheme();
                        }
                    },

                    onHeaderCustomBorderChange(val) {
                        if (this.isDarkNow) {
                            this.headerCustomBorderDark = val;
                        } else {
                            this.headerCustomBorderLight = val;
                        }
                        this.headerCustomBorder = val;
                        this.headerCustomBorderInput = val.replace('#', '').toUpperCase();
                        this.applyTheme();
                    },

                    onHeaderCustomBorderInput(val) {
                        let clean = val.replace(/[^0-9A-Fa-f]/g, '').slice(0, 6);
                        this.headerCustomBorderInput = clean.toUpperCase();
                        if (clean.length === 6 || clean.length === 3) {
                            const hex = '#' + clean;
                            if (this.isDarkNow) {
                                this.headerCustomBorderDark = hex;
                            } else {
                                this.headerCustomBorderLight = hex;
                            }
                            this.headerCustomBorder = hex;
                            this.applyTheme();
                        }
                    },

                    // Nav Methods
                    selectNavStyle(id) {
                        if (this.isDarkNow) {
                            this.navStyleDark = id;
                        } else {
                            this.navStyleLight = id;
                        }
                        this.navStyle = id;
                        this.applyTheme();
                        this.notify(`Gaya item navigasi (${this.isDarkNow ? 'Mode Gelap' : 'Mode Terang'}): ${id}`);
                    },

                    selectNavDensity(density) {
                        if (this.isDarkNow) {
                            this.navDensityDark = density;
                        } else {
                            this.navDensityLight = density;
                        }
                        this.navDensity = density;
                        this.applyTheme();
                        this.notify(`Kerapatan navigasi (${this.isDarkNow ? 'Mode Gelap' : 'Mode Terang'}): ${density}`);
                    },

                    toggleNavIndicator(val) {
                        const next = typeof val !== 'undefined' ? !!val : !this.navIndicator;
                        if (this.isDarkNow) {
                            this.navIndicatorDark = next;
                        } else {
                            this.navIndicatorLight = next;
                        }
                        this.navIndicator = next;
                        this.applyTheme();
                        this.notify(this.navIndicator ? `Garis indikator (${this.isDarkNow ? 'Mode Gelap' : 'Mode Terang'}) aktif.` : `Garis indikator (${this.isDarkNow ? 'Mode Gelap' : 'Mode Terang'}) nonaktif.`);
                    },

                    onNavCustomActiveBgChange(val) {
                        if (this.isDarkNow) {
                            this.navCustomActiveBgDark = val;
                        } else {
                            this.navCustomActiveBgLight = val;
                        }
                        this.navCustomActiveBg = val;
                        this.navCustomActiveBgInput = val.replace('#', '').toUpperCase();
                        this.applyTheme();
                    },

                    onNavCustomActiveBgInput(val) {
                        let clean = val.replace(/[^0-9A-Fa-f]/g, '').slice(0, 6);
                        this.navCustomActiveBgInput = clean.toUpperCase();
                        if (clean.length === 6 || clean.length === 3) {
                            const hex = '#' + clean;
                            if (this.isDarkNow) {
                                this.navCustomActiveBgDark = hex;
                            } else {
                                this.navCustomActiveBgLight = hex;
                            }
                            this.navCustomActiveBg = hex;
                            this.applyTheme();
                        }
                    },

                    onNavCustomActiveFgChange(val) {
                        if (this.isDarkNow) {
                            this.navCustomActiveFgDark = val;
                        } else {
                            this.navCustomActiveFgLight = val;
                        }
                        this.navCustomActiveFg = val;
                        this.navCustomActiveFgInput = val.replace('#', '').toUpperCase();
                        this.applyTheme();
                    },

                    onNavCustomActiveFgInput(val) {
                        let clean = val.replace(/[^0-9A-Fa-f]/g, '').slice(0, 6);
                        this.navCustomActiveFgInput = clean.toUpperCase();
                        if (clean.length === 6 || clean.length === 3) {
                            const hex = '#' + clean;
                            if (this.isDarkNow) {
                                this.navCustomActiveFgDark = hex;
                            } else {
                                this.navCustomActiveFgLight = hex;
                            }
                            this.navCustomActiveFg = hex;
                            this.applyTheme();
                        }
                    },

                    onNavCustomIndicatorChange(val) {
                        if (this.isDarkNow) {
                            this.navCustomIndicatorDark = val;
                        } else {
                            this.navCustomIndicatorLight = val;
                        }
                        this.navCustomIndicator = val;
                        this.navCustomIndicatorInput = val.replace('#', '').toUpperCase();
                        this.applyTheme();
                    },

                    onNavCustomIndicatorInput(val) {
                        let clean = val.replace(/[^0-9A-Fa-f]/g, '').slice(0, 6);
                        this.navCustomIndicatorInput = clean.toUpperCase();
                        if (clean.length === 6 || clean.length === 3) {
                            const hex = '#' + clean;
                            if (this.isDarkNow) {
                                this.navCustomIndicatorDark = hex;
                            } else {
                                this.navCustomIndicatorLight = hex;
                            }
                            this.navCustomIndicator = hex;
                            this.applyTheme();
                        }
                    },

                    getPreviewNavActiveBg() {
                        const surfaceLight = this.surfacePresets.find(s => s.id === this.selectedSurfaceLight) || this.surfacePresets[0];
                        const surfaceDark = this.surfacePresets.find(s => s.id === this.selectedSurfaceDark) || this.surfacePresets[0];
                        const sb = this.getResolvedSidebarColors(surfaceLight, surfaceDark);
                        const nav = this.getResolvedNavColors(surfaceLight, surfaceDark, sb);
                        return this.isDarkNow ? nav.dark.activeBg : nav.light.activeBg;
                    },

                    getPreviewNavActiveFg() {
                        const surfaceLight = this.surfacePresets.find(s => s.id === this.selectedSurfaceLight) || this.surfacePresets[0];
                        const surfaceDark = this.surfacePresets.find(s => s.id === this.selectedSurfaceDark) || this.surfacePresets[0];
                        const sb = this.getResolvedSidebarColors(surfaceLight, surfaceDark);
                        const nav = this.getResolvedNavColors(surfaceLight, surfaceDark, sb);
                        return this.isDarkNow ? nav.dark.activeFg : nav.light.activeFg;
                    },

                    getPreviewNavIndicator() {
                        const surfaceLight = this.surfacePresets.find(s => s.id === this.selectedSurfaceLight) || this.surfacePresets[0];
                        const surfaceDark = this.surfacePresets.find(s => s.id === this.selectedSurfaceDark) || this.surfacePresets[0];
                        const sb = this.getResolvedSidebarColors(surfaceLight, surfaceDark);
                        const nav = this.getResolvedNavColors(surfaceLight, surfaceDark, sb);
                        return this.isDarkNow ? nav.dark.indicator : nav.light.indicator;
                    },

                    updateMonoChart(hex) {
                        const mono = this.chartPresets.find(c => c.id === 'mono');
                        if (mono) {
                            mono.colors = [hex, hex + 'dd', hex + 'aa', hex + '77', hex + '44'];
                        }
                    },

                    setMode(newMode, event = null) {
                        this.mode = newMode;
                        this.updateIsDarkNow();
                        this.syncActiveModeValues();
                        if (window.VibeTheme) {
                            window.VibeTheme.setMode(newMode, event);
                        } else {
                            const isDark = newMode === 'dark' || (newMode === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches);
                            document.documentElement.classList.toggle('dark', isDark);
                        }
                        this.applyTheme();
                        this.notify('Mode tema diubah ke ' + newMode);
                    },

                    toggleHighContrast(val) {
                        this.highContrast = typeof val !== 'undefined' ? !!val : !this.highContrast;
                        this.applyTheme();
                        this.notify(this.highContrast ? 'Kontras tinggi aktif.' : 'Kontras standar.');
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
                        this.updateIsDarkNow();
                        this.customHex = '#18181b';
                        this.customHexInput = '18181B';
                        this.highContrast = false;
                        this.motionActive = true;

                        // Reset Surface
                        this.selectedSurfaceLight = 'zinc';
                        this.selectedSurfaceDark = 'zinc';

                        // Reset Sidebar
                        this.sidebarStyleLight = 'default';
                        this.sidebarStyleDark = 'default';
                        this.sidebarCustomBgLight = '#ffffff';
                        this.sidebarCustomBgDark = '#121312';
                        this.sidebarCustomBorderLight = '#e5e6e5';
                        this.sidebarCustomBorderDark = '#262726';
                        this.sidebarBorderModeLight = 'default';
                        this.sidebarBorderModeDark = 'default';
                        this.transparentSidebarLight = false;
                        this.transparentSidebarDark = false;
                        this.sidebarFeature = 'Recent changes';

                        // Reset Header
                        this.headerStyleLight = 'default';
                        this.headerStyleDark = 'default';
                        this.headerCustomBgLight = '#ffffff';
                        this.headerCustomBgDark = '#121312';
                        this.headerCustomBorderLight = '#e5e6e5';
                        this.headerCustomBorderDark = '#262726';
                        this.headerBorderModeLight = 'default';
                        this.headerBorderModeDark = 'default';
                        this.headerGlassEffectLight = true;
                        this.headerGlassEffectDark = true;

                        // Reset Nav
                        this.navStyleLight = 'harmony';
                        this.navStyleDark = 'harmony';
                        this.navDensityLight = 'default';
                        this.navDensityDark = 'default';
                        this.navIndicatorLight = false;
                        this.navIndicatorDark = false;
                        this.navCustomActiveBgLight = '#f4f5f5';
                        this.navCustomActiveBgDark = '#1e1f1e';
                        this.navCustomActiveFgLight = '#0a0b0a';
                        this.navCustomActiveFgDark = '#f9fafa';
                        this.navCustomIndicatorLight = '#18181b';
                        this.navCustomIndicatorDark = '#f9fafa';

                        this.selectedSemantic = 'vibrant';
                        this.selectedChartPreset = 'rainbow';
                        this.selectedRadius = '0.5rem';
                        this.selectedFontName = 'Figtree';
                        this.selectedFontValue = "'Figtree', ui-sans-serif, system-ui, sans-serif";
                        this.tablesView = 'default';
                        this.reduceMotion = false;
                        this.glassEffect = true;

                        this.syncActiveModeValues();

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
                        root.style.removeProperty('--background');
                        root.style.removeProperty('--card');
                        root.style.removeProperty('--popover');
                        root.style.removeProperty('--container');
                        root.style.removeProperty('--sidebar');
                        root.style.removeProperty('--header');

                        if (window.VibeTheme?.clearCssOverride) {
                            window.VibeTheme.clearCssOverride();
                        }
                        const overrideEl = document.getElementById(styleId);
                        if (overrideEl) {
                            overrideEl.textContent = '';
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

                    getResolvedSidebarColors(surfaceLight, surfaceDark) {
                        let lightBg = surfaceLight.light.sidebar;
                        let darkBg = surfaceDark.dark.sidebar;
                        let lightBorder = this.highContrast ? '#a1a1aa' : surfaceLight.light.border;
                        let darkBorder = this.highContrast ? '#3f3f46' : surfaceDark.dark.border;

                        if (this.sidebarStyleLight === 'card') {
                            lightBg = surfaceLight.light.card;
                        } else if (this.sidebarStyleLight === 'contrast') {
                            lightBg = '#ffffff';
                        } else if (this.sidebarStyleLight === 'muted') {
                            lightBg = '#f4f5f5';
                        } else if (this.sidebarStyleLight === 'dark') {
                            lightBg = '#121312';
                            lightBorder = '#262726';
                        } else if (this.sidebarStyleLight === 'custom') {
                            lightBg = this.sidebarCustomBgLight;
                            lightBorder = this.sidebarCustomBorderLight;
                        }

                        if (this.sidebarBorderModeLight === 'none') {
                            lightBorder = 'transparent';
                        } else if (this.sidebarBorderModeLight === 'high') {
                            lightBorder = '#a1a1aa';
                        }

                        if (this.sidebarStyleDark === 'card') {
                            darkBg = surfaceDark.dark.card;
                        } else if (this.sidebarStyleDark === 'contrast') {
                            darkBg = '#0a0b0a';
                        } else if (this.sidebarStyleDark === 'muted') {
                            darkBg = '#181918';
                        } else if (this.sidebarStyleDark === 'dark') {
                            darkBg = '#121312';
                            darkBorder = '#262726';
                        } else if (this.sidebarStyleDark === 'custom') {
                            darkBg = this.sidebarCustomBgDark;
                            darkBorder = this.sidebarCustomBorderDark;
                        }

                        if (this.sidebarBorderModeDark === 'none') {
                            darkBorder = 'transparent';
                        } else if (this.sidebarBorderModeDark === 'high') {
                            darkBorder = '#3f3f46';
                        }

                        const lightFg = this.isLight(lightBg) ? '#0a0b0a' : '#f9fafa';
                        const darkFg = this.isLight(darkBg) ? '#0a0b0a' : '#f9fafa';

                        return {
                            light: { bg: lightBg, fg: lightFg, border: lightBorder },
                            dark: { bg: darkBg, fg: darkFg, border: darkBorder }
                        };
                    },

                    getResolvedHeaderColors(surfaceLight, surfaceDark) {
                        let lightBg = surfaceLight.light.header;
                        let darkBg = surfaceDark.dark.header;
                        let lightBorder = this.highContrast ? '#a1a1aa' : surfaceLight.light.border;
                        let darkBorder = this.highContrast ? '#3f3f46' : surfaceDark.dark.border;

                        if (this.headerStyleLight === 'card') {
                            lightBg = surfaceLight.light.card;
                        } else if (this.headerStyleLight === 'glass') {
                            lightBg = 'rgba(255, 255, 255, 0.82)';
                        } else if (this.headerStyleLight === 'contrast') {
                            lightBg = '#ffffff';
                        } else if (this.headerStyleLight === 'muted') {
                            lightBg = '#f4f5f5';
                        } else if (this.headerStyleLight === 'dark') {
                            lightBg = '#121312';
                            lightBorder = '#262726';
                        } else if (this.headerStyleLight === 'custom') {
                            lightBg = this.headerCustomBgLight;
                            lightBorder = this.headerCustomBorderLight;
                        }

                        if (this.headerBorderModeLight === 'none') {
                            lightBorder = 'transparent';
                        } else if (this.headerBorderModeLight === 'high') {
                            lightBorder = '#71717a';
                        }

                        if (this.headerStyleDark === 'card') {
                            darkBg = surfaceDark.dark.card;
                        } else if (this.headerStyleDark === 'glass') {
                            darkBg = 'rgba(18, 19, 18, 0.82)';
                        } else if (this.headerStyleDark === 'contrast') {
                            darkBg = '#0a0b0a';
                        } else if (this.headerStyleDark === 'muted') {
                            darkBg = '#181918';
                        } else if (this.headerStyleDark === 'dark') {
                            darkBg = '#121312';
                            darkBorder = '#262726';
                        } else if (this.headerStyleDark === 'custom') {
                            darkBg = this.headerCustomBgDark;
                            darkBorder = this.headerCustomBorderDark;
                        }

                        if (this.headerBorderModeDark === 'none') {
                            darkBorder = 'transparent';
                        } else if (this.headerBorderModeDark === 'high') {
                            darkBorder = '#a1a1aa';
                        }

                        const lightFg = this.isLight(lightBg) ? '#0a0b0a' : '#f9fafa';
                        const darkFg = this.isLight(darkBg) ? '#0a0b0a' : '#f9fafa';

                        return {
                            light: { bg: lightBg, fg: lightFg, border: lightBorder },
                            dark: { bg: darkBg, fg: darkFg, border: darkBorder }
                        };
                    },

                    getResolvedNavColors(surfaceLight, surfaceDark, sb) {
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

                        if (this.navStyleLight === 'primary') {
                            lightActiveBg = this.customHex;
                            lightActiveFg = this.isLight(this.customHex) ? '#0a0b0a' : '#ffffff';
                            lightIndicator = this.customHex;
                        } else if (this.navStyleLight === 'line') {
                            lightActiveBg = 'transparent';
                            lightActiveFg = sb.light.fg;
                            lightIndicator = this.customHex;
                        } else if (this.navStyleLight === 'subtle') {
                            lightActiveBg = '#f4f5f5';
                            lightActiveFg = '#0a0b0a';
                            lightIndicator = this.customHex;
                        } else if (this.navStyleLight === 'custom') {
                            lightActiveBg = this.navCustomActiveBgLight;
                            lightActiveFg = this.navCustomActiveFgLight;
                            lightHoverBg = this.navCustomActiveBgLight;
                            lightHoverFg = this.navCustomActiveFgLight;
                            lightIndicator = this.navCustomIndicatorLight;
                        } else {
                            if (this.sidebarStyleLight === 'custom') {
                                const isSidebarLight = this.isLight(this.sidebarCustomBgLight);
                                lightActiveBg = isSidebarLight ? 'rgba(0, 0, 0, 0.06)' : 'rgba(255, 255, 255, 0.12)';
                                lightActiveFg = isSidebarLight ? '#0a0b0a' : '#ffffff';
                                lightHoverBg = isSidebarLight ? 'rgba(0, 0, 0, 0.04)' : 'rgba(255, 255, 255, 0.08)';
                                lightHoverFg = lightActiveFg;
                            } else {
                                lightActiveBg = '#f4f5f5';
                                lightActiveFg = '#0a0b0a';
                                lightHoverBg = '#f4f5f5';
                                lightHoverFg = '#0a0b0a';
                            }
                            lightIndicator = this.customHex;
                        }

                        if (this.navStyleDark === 'primary') {
                            darkActiveBg = this.customHex;
                            darkActiveFg = this.isLight(this.customHex) ? '#0a0b0a' : '#ffffff';
                            darkIndicator = this.customHex;
                        } else if (this.navStyleDark === 'line') {
                            darkActiveBg = 'transparent';
                            darkActiveFg = sb.dark.fg;
                            darkIndicator = this.customHex;
                        } else if (this.navStyleDark === 'subtle') {
                            darkActiveBg = '#181918';
                            darkActiveFg = '#f9fafa';
                            darkIndicator = this.customHex;
                        } else if (this.navStyleDark === 'custom') {
                            darkActiveBg = this.navCustomActiveBgDark;
                            darkActiveFg = this.navCustomActiveFgDark;
                            darkHoverBg = this.navCustomActiveBgDark;
                            darkHoverFg = this.navCustomActiveFgDark;
                            darkIndicator = this.navCustomIndicatorDark;
                        } else {
                            if (this.sidebarStyleDark === 'custom') {
                                const isSidebarLight = this.isLight(this.sidebarCustomBgDark);
                                darkActiveBg = isSidebarLight ? 'rgba(0, 0, 0, 0.06)' : 'rgba(255, 255, 255, 0.12)';
                                darkActiveFg = isSidebarLight ? '#0a0b0a' : '#ffffff';
                                darkHoverBg = isSidebarLight ? 'rgba(0, 0, 0, 0.04)' : 'rgba(255, 255, 255, 0.08)';
                                darkHoverFg = darkActiveFg;
                            } else {
                                darkActiveBg = '#1e1f1e';
                                darkActiveFg = '#f9fafa';
                                darkHoverBg = '#1e1f1e';
                                darkHoverFg = '#f9fafa';
                            }
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
                        const isDefaultSlate = (this.customHex.toLowerCase() === '#18181b' || this.customHex.toLowerCase() === '#0a0b0a');
                        const lightPrimary = isDefaultSlate ? '#0a0b0a' : this.customHex;
                        const lightFg = this.isLight(lightPrimary) ? '#0a0b0a' : '#ffffff';
                        const darkPrimary = isDefaultSlate ? '#f9fafa' : this.customHex;
                        const darkFg = this.isLight(darkPrimary) ? '#0a0b0a' : '#ffffff';

                        const r = this.selectedRadius;
                        const surfaceLight = this.surfacePresets.find(s => s.id === this.selectedSurfaceLight) || this.surfacePresets[0];
                        const surfaceDark = this.surfacePresets.find(s => s.id === this.selectedSurfaceDark) || this.surfacePresets[0];

                        const semantic = this.semanticPresets.find(s => s.id === this.selectedSemantic) || this.semanticPresets[0];
                        const chart = this.chartPresets.find(c => c.id === this.selectedChartPreset) || this.chartPresets[0];

                        const sb = this.getResolvedSidebarColors(surfaceLight, surfaceDark);
                        const hd = this.getResolvedHeaderColors(surfaceLight, surfaceDark);
                        const nav = this.getResolvedNavColors(surfaceLight, surfaceDark, sb);

                        // Hapus inline style dari documentElement agar stylesheet berperan sebagai single source of truth
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
                        root.style.removeProperty('--background');
                        root.style.removeProperty('--card');
                        root.style.removeProperty('--popover');
                        root.style.removeProperty('--container');
                        root.style.removeProperty('--sidebar');
                        root.style.removeProperty('--header');

                        let css = `
                            :root, html, body, [data-canvas-theme] {
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

                            :root:root, html:root:root, html:not(.dark), html.light, .light, [data-canvas-theme="light"] {
                                --primary: ${lightPrimary} !important;
                                --primary-foreground: ${lightFg} !important;
                                --ring: ${lightPrimary} !important;
                                --color-primary: ${lightPrimary} !important;
                                --color-primary-foreground: ${lightFg} !important;
                                --color-ring: ${lightPrimary} !important;

                                --background: ${surfaceLight.light.bg} !important;
                                --foreground: #0a0b0a !important;
                                --card: ${surfaceLight.light.card} !important;
                                --card-foreground: #0a0b0a !important;
                                --popover: ${surfaceLight.light.card} !important;
                                --popover-foreground: #0a0b0a !important;
                                --container: ${surfaceLight.light.card} !important;
                                --container-foreground: #0a0b0a !important;
                                --container-border: ${this.highContrast ? '#a1a1aa' : surfaceLight.light.border} !important;
                                --border: ${this.highContrast ? '#a1a1aa' : surfaceLight.light.border} !important;
                                --input: ${this.highContrast ? '#a1a1aa' : surfaceLight.light.border} !important;

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

                            html.dark:root:root, html.dark, .dark, [data-canvas-theme="dark"] {
                                --primary: ${darkPrimary} !important;
                                --primary-foreground: ${darkFg} !important;
                                --ring: ${darkPrimary} !important;
                                --color-primary: ${darkPrimary} !important;
                                --color-primary-foreground: ${darkFg} !important;
                                --color-ring: ${darkPrimary} !important;

                                --background: ${surfaceDark.dark.bg} !important;
                                --foreground: #f9fafa !important;
                                --card: ${surfaceDark.dark.card} !important;
                                --card-foreground: #f9fafa !important;
                                --popover: ${surfaceDark.dark.card} !important;
                                --popover-foreground: #f9fafa !important;
                                --container: ${surfaceDark.dark.card} !important;
                                --container-foreground: #f9fafa !important;
                                --container-border: ${this.highContrast ? '#3f3f46' : surfaceDark.dark.border} !important;
                                --border: ${this.highContrast ? '#3f3f46' : surfaceDark.dark.border} !important;
                                --input: ${this.highContrast ? '#3f3f46' : surfaceDark.dark.border} !important;

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
                        if (this.transparentSidebarLight) {
                            css += `
                                html:not(.dark) aside, html:not(.dark) [data-vibe-sidebar], html:not(.dark) .vibe-sidebar, html:not(.dark) .sidebar {
                                    background-color: transparent !important;
                                    backdrop-filter: blur(10px) !important;
                                    -webkit-backdrop-filter: blur(10px) !important;
                                }
                            `;
                        }
                        if (this.transparentSidebarDark) {
                            css += `
                                html.dark aside, html.dark [data-vibe-sidebar], html.dark .vibe-sidebar, html.dark .sidebar {
                                    background-color: transparent !important;
                                    backdrop-filter: blur(10px) !important;
                                    -webkit-backdrop-filter: blur(10px) !important;
                                }
                            `;
                        }

                        // Header glassmorphism rules
                        if (this.headerGlassEffectLight) {
                            css += `
                                html:not(.dark) header, html:not(.dark) [data-vibe-header], html:not(.dark) .vibe-header {
                                    backdrop-filter: blur(12px) !important;
                                    -webkit-backdrop-filter: blur(12px) !important;
                                }
                            `;
                        } else {
                            css += `
                                html:not(.dark) header, html:not(.dark) [data-vibe-header], html:not(.dark) .vibe-header {
                                    backdrop-filter: none !important;
                                    -webkit-backdrop-filter: none !important;
                                }
                            `;
                        }

                        if (this.headerGlassEffectDark) {
                            css += `
                                html.dark header, html.dark [data-vibe-header], html.dark .vibe-header {
                                    backdrop-filter: blur(12px) !important;
                                    -webkit-backdrop-filter: blur(12px) !important;
                                }
                            `;
                        } else {
                            css += `
                                html.dark header, html.dark [data-vibe-header], html.dark .vibe-header {
                                    backdrop-filter: none !important;
                                    -webkit-backdrop-filter: none !important;
                                }
                            `;
                        }

                        // Navigation density rules
                        const activeNavDensity = this.isDarkNow ? this.navDensityDark : this.navDensityLight;
                        if (activeNavDensity === 'compact') {
                            css += `
                                nav [data-pin-type="item"], nav [data-pin-type="group"] [data-nav-group-trigger] {
                                    min-height: 2rem !important;
                                    padding-top: 0.35rem !important;
                                    padding-bottom: 0.35rem !important;
                                    font-size: 0.75rem !important;
                                }
                            `;
                        } else if (activeNavDensity === 'relaxed') {
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
                        if (this.navIndicatorLight || this.navStyleLight === 'line') {
                            css += `
                                html:not(.dark) nav [data-pin-type="item"].nav-item-active,
                                html:not(.dark) nav [data-pin-type="group"] [data-nav-group-trigger].nav-item-active,
                                html:not(.dark) [data-pin-type="item"].nav-item-active {
                                    position: relative !important;
                                }
                                html:not(.dark) nav [data-pin-type="item"].nav-item-active::before,
                                html:not(.dark) nav [data-pin-type="group"] [data-nav-group-trigger].nav-item-active::before,
                                html:not(.dark) [data-pin-type="item"].nav-item-active::before {
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

                        if (this.navIndicatorDark || this.navStyleDark === 'line') {
                            css += `
                                html.dark nav [data-pin-type="item"].nav-item-active,
                                html.dark nav [data-pin-type="group"] [data-nav-group-trigger].nav-item-active,
                                html.dark [data-pin-type="item"].nav-item-active {
                                    position: relative !important;
                                }
                                html.dark nav [data-pin-type="item"].nav-item-active::before,
                                html.dark nav [data-pin-type="group"] [data-nav-group-trigger].nav-item-active::before,
                                html.dark [data-pin-type="item"].nav-item-active::before {
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
                        document.head.appendChild(styleEl);

                        // Sinkronkan ke ThemeManager agar persisten lintas navigasi
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
                        const isDefaultSlate = (this.customHex.toLowerCase() === '#18181b' || this.customHex.toLowerCase() === '#0a0b0a');
                        const lightPrimary = isDefaultSlate ? '#0a0b0a' : this.customHex;
                        const lightFg = this.isLight(lightPrimary) ? '#0a0b0a' : '#ffffff';
                        const darkPrimary = isDefaultSlate ? '#f9fafa' : this.customHex;
                        const darkFg = this.isLight(darkPrimary) ? '#0a0b0a' : '#ffffff';

                        const r = this.selectedRadius;
                        const surfaceLight = this.surfacePresets.find(s => s.id === this.selectedSurfaceLight) || this.surfacePresets[0];
                        const surfaceDark = this.surfacePresets.find(s => s.id === this.selectedSurfaceDark) || this.surfacePresets[0];
                        const semantic = this.semanticPresets.find(s => s.id === this.selectedSemantic) || this.semanticPresets[0];
                        const chart = this.chartPresets.find(c => c.id === this.selectedChartPreset) || this.chartPresets[0];

                        const sb = this.getResolvedSidebarColors(surfaceLight, surfaceDark);
                        const hd = this.getResolvedHeaderColors(surfaceLight, surfaceDark);
                        const nav = this.getResolvedNavColors(surfaceLight, surfaceDark, sb);

                        return `:root {
    --primary: ${lightPrimary};
    --primary-foreground: ${lightFg};
    --ring: ${lightPrimary};
    --color-primary: ${lightPrimary};
    --color-primary-foreground: ${lightFg};
    --color-ring: ${lightPrimary};
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

:root, html:not(.dark), .light {
    --background: ${surfaceLight.light.bg};
    --foreground: #0a0b0a;
    --card: ${surfaceLight.light.card};
    --card-foreground: #0a0b0a;
    --popover: ${surfaceLight.light.card};
    --popover-foreground: #0a0b0a;
    --container: ${surfaceLight.light.card};
    --container-foreground: #0a0b0a;
    --border: ${this.highContrast ? '#a1a1aa' : surfaceLight.light.border};
    --input: ${this.highContrast ? '#a1a1aa' : surfaceLight.light.border};
    --primary: ${lightPrimary};
    --primary-foreground: ${lightFg};
    --ring: ${lightPrimary};
    --color-primary: ${lightPrimary};
    --color-primary-foreground: ${lightFg};
    --color-ring: ${lightPrimary};
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

html.dark, .dark {
    --background: ${surfaceDark.dark.bg};
    --foreground: #f9fafa;
    --card: ${surfaceDark.dark.card};
    --card-foreground: #f9fafa;
    --popover: ${surfaceDark.dark.card};
    --popover-foreground: #f9fafa;
    --container: ${surfaceDark.dark.card};
    --container-foreground: #f9fafa;
    --border: ${this.highContrast ? '#3f3f46' : surfaceDark.dark.border};
    --input: ${this.highContrast ? '#3f3f46' : surfaceDark.dark.border};
    --primary: ${darkPrimary};
    --primary-foreground: ${darkFg};
    --ring: ${darkPrimary};
    --color-primary: ${darkPrimary};
    --color-primary-foreground: ${darkFg};
    --color-ring: ${darkPrimary};
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
                                selectedSurfaceLight: this.selectedSurfaceLight,
                                selectedSurfaceDark: this.selectedSurfaceDark,

                                sidebarStyle: this.sidebarStyle,
                                sidebarStyleLight: this.sidebarStyleLight,
                                sidebarStyleDark: this.sidebarStyleDark,
                                sidebarCustomBg: this.sidebarCustomBg,
                                sidebarCustomBgLight: this.sidebarCustomBgLight,
                                sidebarCustomBgDark: this.sidebarCustomBgDark,
                                sidebarCustomBorder: this.sidebarCustomBorder,
                                sidebarCustomBorderLight: this.sidebarCustomBorderLight,
                                sidebarCustomBorderDark: this.sidebarCustomBorderDark,
                                sidebarBorderMode: this.sidebarBorderMode,
                                sidebarBorderModeLight: this.sidebarBorderModeLight,
                                sidebarBorderModeDark: this.sidebarBorderModeDark,
                                transparentSidebar: this.transparentSidebar,
                                transparentSidebarLight: this.transparentSidebarLight,
                                transparentSidebarDark: this.transparentSidebarDark,
                                sidebarFeature: this.sidebarFeature,

                                headerStyle: this.headerStyle,
                                headerStyleLight: this.headerStyleLight,
                                headerStyleDark: this.headerStyleDark,
                                headerCustomBg: this.headerCustomBg,
                                headerCustomBgLight: this.headerCustomBgLight,
                                headerCustomBgDark: this.headerCustomBgDark,
                                headerCustomBorder: this.headerCustomBorder,
                                headerCustomBorderLight: this.headerCustomBorderLight,
                                headerCustomBorderDark: this.headerCustomBorderDark,
                                headerBorderMode: this.headerBorderMode,
                                headerBorderModeLight: this.headerBorderModeLight,
                                headerBorderModeDark: this.headerBorderModeDark,
                                headerGlassEffect: this.headerGlassEffect,
                                headerGlassEffectLight: this.headerGlassEffectLight,
                                headerGlassEffectDark: this.headerGlassEffectDark,

                                navStyle: this.navStyle,
                                navStyleLight: this.navStyleLight,
                                navStyleDark: this.navStyleDark,
                                navDensity: this.navDensity,
                                navDensityLight: this.navDensityLight,
                                navDensityDark: this.navDensityDark,
                                navIndicator: this.navIndicator,
                                navIndicatorLight: this.navIndicatorLight,
                                navIndicatorDark: this.navIndicatorDark,
                                navCustomActiveBg: this.navCustomActiveBg,
                                navCustomActiveBgLight: this.navCustomActiveBgLight,
                                navCustomActiveBgDark: this.navCustomActiveBgDark,
                                navCustomActiveFg: this.navCustomActiveFg,
                                navCustomActiveFgLight: this.navCustomActiveFgLight,
                                navCustomActiveFgDark: this.navCustomActiveFgDark,
                                navCustomIndicator: this.navCustomIndicator,
                                navCustomIndicatorLight: this.navCustomIndicatorLight,
                                navCustomIndicatorDark: this.navCustomIndicatorDark,

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
