<x-docs.layouts.sidebar>
    <vibe:seo :title="__('docs/button.title')" :description="__('docs/button.description')" schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => 'Components', 'url' => '/docs'],
        ['name' => __('docs/button.title'), 'url' => '/docs/button']
    ]" />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">

        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            {{-- Hero Header --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-muted text-muted-foreground">{{ __('docs/button.badge') }}</span>
                    <span class="text-xs text-muted-foreground">{{ __('docs/button.group') }}</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">{{ __('docs/button.title') }}</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    {{ __('docs/button.description') }}
                </p>

                {{-- Quick props badge strip --}}
                <div class="flex flex-wrap items-center gap-1.5 pt-1">
                    @foreach (['default', 'primary', 'secondary', 'outline', 'ghost', 'surface', 'accent', 'destructive', 'success', 'warning', 'info', 'link'] as $v)
                        <span class="px-2 py-0.5 rounded-md bg-muted text-muted-foreground text-[11px] font-mono font-medium border border-border">{{ $v }}</span>
                    @endforeach
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    @foreach (['xs', 'sm', 'md', 'lg', 'xl', 'icon-xs', 'icon-sm', 'icon-md', 'icon-lg'] as $s)
                        <span class="px-2 py-0.5 rounded-md bg-muted text-muted-foreground text-[11px] font-mono font-medium border border-border">{{ $s }}</span>
                    @endforeach
                </div>
            </div>

            {{-- 1. Basic Usage --}}
            <section id="penggunaan-dasar" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/button.basic_usage_title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/button.basic_usage_desc') !!}
                    </p>
                </div>

                <vibe:preview title="Basic Button">
                    <vibe:preview.code>
                        @verbatim
                            {{-- Default Button --}}
                            <vibe:button>
                                Default Button
                            </vibe:button>

                            {{-- Primary Button --}}
                            <vibe:button variant="primary">
                                Primary Button
                            </vibe:button>
                        @endverbatim
                    </vibe:preview.code>
                    <div class="flex flex-wrap items-center gap-3">
                        <vibe:button>Default Button</vibe:button>
                        <vibe:button variant="primary">Primary Button</vibe:button>
                    </div>
                </vibe:preview>
            </section>

            {{-- 2. Variants --}}
            <section id="varian-tampilan" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/button.variants_title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/button.variants_desc') !!}
                    </p>
                </div>

                <vibe:preview title="Button Variants">
                    <vibe:preview.code>
                        @verbatim
                            {{-- Core Variants --}}
                            <vibe:button variant="default">Default</vibe:button>
                            <vibe:button variant="primary">Primary</vibe:button>
                            <vibe:button variant="secondary">Secondary</vibe:button>
                            <vibe:button variant="outline">Outline</vibe:button>
                            <vibe:button variant="ghost">Ghost</vibe:button>
                            <vibe:button variant="surface">Surface</vibe:button>
                            <vibe:button variant="accent">Accent</vibe:button>

                            {{-- Feedback / Status Variants --}}
                            <vibe:button variant="destructive">Destructive</vibe:button>
                            <vibe:button variant="success">Success</vibe:button>
                            <vibe:button variant="warning">Warning</vibe:button>
                            <vibe:button variant="info">Info</vibe:button>

                            {{-- Link Variant --}}
                            <vibe:button variant="link">Link</vibe:button>
                        @endverbatim
                    </vibe:preview.code>
                    <div class="flex flex-wrap items-center gap-3 justify-center">
                        <vibe:button variant="default">Default</vibe:button>
                        <vibe:button variant="primary">Primary</vibe:button>
                        <vibe:button variant="secondary">Secondary</vibe:button>
                        <vibe:button variant="outline">Outline</vibe:button>
                        <vibe:button variant="ghost">Ghost</vibe:button>
                        <vibe:button variant="surface">Surface</vibe:button>
                        <vibe:button variant="accent">Accent</vibe:button>
                        <vibe:button variant="destructive">Destructive</vibe:button>
                        <vibe:button variant="success">Success</vibe:button>
                        <vibe:button variant="warning">Warning</vibe:button>
                        <vibe:button variant="info">Info</vibe:button>
                        <vibe:button variant="link">Link</vibe:button>
                    </div>
                </vibe:preview>
            </section>

            {{-- 3. Sizes --}}
            <section id="ukuran" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/button.sizes_title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/button.sizes_desc') !!}
                    </p>
                </div>

                <vibe:preview title="Button Sizes">
                    <vibe:preview.code>
                        @verbatim
                            <vibe:button size="xs" variant="primary">Extra Small (xs)</vibe:button>
                            <vibe:button size="sm" variant="primary">Small (sm)</vibe:button>
                            <vibe:button size="md" variant="primary">Medium (md)</vibe:button>
                            <vibe:button size="lg" variant="primary">Large (lg)</vibe:button>
                            <vibe:button size="xl" variant="primary">Extra Large (xl)</vibe:button>
                        @endverbatim
                    </vibe:preview.code>
                    <div class="flex flex-wrap items-center gap-3 justify-center">
                        <vibe:button size="xs" variant="primary">Extra Small (xs)</vibe:button>
                        <vibe:button size="sm" variant="primary">Small (sm)</vibe:button>
                        <vibe:button size="md" variant="primary">Medium (md)</vibe:button>
                        <vibe:button size="lg" variant="primary">Large (lg)</vibe:button>
                        <vibe:button size="xl" variant="primary">Extra Large (xl)</vibe:button>
                    </div>
                </vibe:preview>
            </section>

            {{-- 4. Icons & Addons --}}
            <section id="tombol-ikon" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/button.icons_title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/button.icons_desc') !!}
                    </p>
                </div>

                <vibe:preview title="Buttons with Icons">
                    <vibe:preview.code>
                        @verbatim
                            {{-- Leading Icon --}}
                            <vibe:button variant="primary">
                                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 12h14" />
                                    <path d="M12 5v14" />
                                </svg>
                                Create Project
                            </vibe:button>

                            {{-- Trailing Icon --}}
                            <vibe:button variant="outline">
                                Export Data
                                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                    <polyline points="7 10 12 15 17 10" />
                                    <line x1="12" x2="12" y1="15" y2="3" />
                                </svg>
                            </vibe:button>

                            {{-- Icon-Only Buttons (xs, sm, md, lg) --}}
                            <vibe:button size="icon-xs" variant="outline" aria-label="Settings">
                                <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                            </vibe:button>

                            <vibe:button size="icon-sm" variant="outline" aria-label="Search">
                                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="11" cy="11" r="8" />
                                    <path d="m21 21-4.3-4.3" />
                                </svg>
                            </vibe:button>

                            <vibe:button size="icon-md" variant="primary" aria-label="Favorite">
                                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z" />
                                </svg>
                            </vibe:button>

                            <vibe:button size="icon-lg" variant="secondary" aria-label="Share">
                                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="18" cy="5" r="3" />
                                    <circle cx="6" cy="12" r="3" />
                                    <circle cx="18" cy="19" r="3" />
                                    <line x1="8.59" x2="15.42" y1="13.51" y2="17.49" />
                                    <line x1="15.41" x2="8.59" y1="6.51" y2="10.49" />
                                </svg>
                            </vibe:button>
                        @endverbatim
                    </vibe:preview.code>
                    <div class="flex flex-wrap items-center gap-3 justify-center">
                        <vibe:button variant="primary">
                            <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14" />
                                <path d="M12 5v14" />
                            </svg>
                            Create Project
                        </vibe:button>

                        <vibe:button variant="outline">
                            Export Data
                            <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                <polyline points="7 10 12 15 17 10" />
                                <line x1="12" x2="12" y1="15" y2="3" />
                            </svg>
                        </vibe:button>

                        <div class="h-6 w-px bg-border mx-1"></div>

                        <vibe:button size="icon-xs" variant="outline" aria-label="Settings">
                            <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z" />
                                <circle cx="12" cy="12" r="3" />
                            </svg>
                        </vibe:button>

                        <vibe:button size="icon-sm" variant="outline" aria-label="Search">
                            <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8" />
                                <path d="m21 21-4.3-4.3" />
                            </svg>
                        </vibe:button>

                        <vibe:button size="icon-md" variant="primary" aria-label="Favorite">
                            <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z" />
                            </svg>
                        </vibe:button>

                        <vibe:button size="icon-lg" variant="secondary" aria-label="Share">
                            <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="18" cy="5" r="3" />
                                <circle cx="6" cy="12" r="3" />
                                <circle cx="18" cy="19" r="3" />
                                <line x1="8.59" x2="15.42" y1="13.51" y2="17.49" />
                                <line x1="15.41" x2="8.59" y1="6.51" y2="10.49" />
                            </svg>
                        </vibe:button>
                    </div>
                </vibe:preview>
            </section>

            {{-- 5. Pill Style --}}
            <section id="pill-style" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/button.pill_title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/button.pill_desc') !!}
                    </p>
                </div>

                <vibe:preview title="Pill Buttons">
                    <vibe:preview.code>
                        @verbatim
                            <vibe:button class="rounded-full" variant="primary">Pill Primary</vibe:button>
                            <vibe:button class="rounded-full" variant="secondary">Pill Secondary</vibe:button>
                            <vibe:button class="rounded-full" variant="outline">Pill Outline</vibe:button>
                            <vibe:button class="rounded-full" variant="accent">Pill Accent</vibe:button>

                            {{-- Circular Icon Button --}}
                            <vibe:button class="rounded-full" size="icon-md" variant="primary" aria-label="Add Item">
                                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 12h14" />
                                    <path d="M12 5v14" />
                                </svg>
                            </vibe:button>
                        @endverbatim
                    </vibe:preview.code>
                    <div class="flex flex-wrap items-center gap-3 justify-center">
                        <vibe:button class="rounded-full" variant="primary">Pill Primary</vibe:button>
                        <vibe:button class="rounded-full" variant="secondary">Pill Secondary</vibe:button>
                        <vibe:button class="rounded-full" variant="outline">Pill Outline</vibe:button>
                        <vibe:button class="rounded-full" variant="accent">Pill Accent</vibe:button>
                        <vibe:button class="rounded-full" size="icon-md" variant="primary" aria-label="Add Item">
                            <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14" />
                                <path d="M12 5v14" />
                            </svg>
                        </vibe:button>
                    </div>
                </vibe:preview>
            </section>

            {{-- 6. Loading State --}}
            <section id="status-loading" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/button.loading_title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/button.loading_desc') !!}
                    </p>
                </div>

                <vibe:preview title="Loading State">
                    <vibe:preview.code>
                        @verbatim
                            <vibe:button loading variant="primary">
                                Saving Changes...
                            </vibe:button>

                            <vibe:button loading variant="outline">
                                Processing
                            </vibe:button>

                            <vibe:button loading variant="secondary" size="icon-md" aria-label="Loading action">
                            </vibe:button>
                        @endverbatim
                    </vibe:preview.code>
                    <div class="flex flex-wrap items-center gap-3 justify-center">
                        <vibe:button loading variant="primary">
                            Saving Changes...
                        </vibe:button>
                        <vibe:button loading variant="outline">
                            Processing
                        </vibe:button>
                        <vibe:button loading variant="secondary" size="icon-md" aria-label="Loading action">
                        </vibe:button>
                    </div>
                </vibe:preview>
            </section>

            {{-- 7. Disabled State & Type --}}
            <section id="status-disabled" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/button.status_title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/button.status_desc') !!}
                    </p>
                </div>

                <vibe:preview title="Disabled State & Types">
                    <vibe:preview.code>
                        @verbatim
                            {{-- Disabled Buttons --}}
                            <vibe:button disabled variant="primary">Disabled Primary</vibe:button>
                            <vibe:button disabled variant="outline">Disabled Outline</vibe:button>
                            <vibe:button disabled variant="destructive">Disabled Destructive</vibe:button>

                            {{-- HTML Form Button Types --}}
                            <vibe:button type="submit" variant="primary">Submit Form</vibe:button>
                            <vibe:button type="reset" variant="secondary">Reset</vibe:button>
                        @endverbatim
                    </vibe:preview.code>
                    <div class="flex flex-wrap items-center gap-3 justify-center">
                        <vibe:button disabled variant="primary">Disabled Primary</vibe:button>
                        <vibe:button disabled variant="outline">Disabled Outline</vibe:button>
                        <vibe:button disabled variant="destructive">Disabled Destructive</vibe:button>
                        <vibe:button type="submit" variant="primary">Submit Form</vibe:button>
                        <vibe:button type="reset" variant="secondary">Reset</vibe:button>
                    </div>
                </vibe:preview>
            </section>

            {{-- 8. Button as Link --}}
            <section id="tombol-link" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/button.link_title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/button.link_desc') !!}
                    </p>
                </div>

                <vibe:preview title="Button as Link (href)">
                    <vibe:preview.code>
                        @verbatim
                            {{-- Rendered as <a wire:navigate href="..."> --}}
                            <vibe:button href="/docs" variant="primary">
                                Back to Documentation
                            </vibe:button>

                            <vibe:button href="/docs/input" variant="outline">
                                Explore Input Component
                                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 12h14" />
                                    <path d="m12 5 7 7-7 7" />
                                </svg>
                            </vibe:button>
                        @endverbatim
                    </vibe:preview.code>
                    <div class="flex flex-wrap items-center gap-3 justify-center">
                        <vibe:button href="/docs" variant="primary">
                            Back to Documentation
                        </vibe:button>
                        <vibe:button href="/docs/input" variant="outline">
                            Explore Input Component
                            <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14" />
                                <path d="m12 5 7 7-7 7" />
                            </svg>
                        </vibe:button>
                    </div>
                </vibe:preview>
            </section>

            {{-- 9. Livewire Integration --}}
            <section id="integrasi-livewire" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/button.livewire_title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/button.livewire_desc') !!}
                    </p>
                </div>

                <vibe:preview title="Livewire Directives">
                    <vibe:preview.code>
                        @verbatim
                            {{-- In Blade template --}}
                            <vibe:button wire:click="save" wire:loading.attr="disabled" wire:target="save" variant="primary">
                                Save Data
                            </vibe:button>

                            {{-- Conditional Loading Spinner with Livewire --}}
                            <vibe:button wire:click="export" wire:target="export" wire:loading.class="opacity-75 cursor-wait" variant="outline">
                                Export Report
                            </vibe:button>
                        @endverbatim
                    </vibe:preview.code>
                    <div class="flex flex-wrap items-center gap-3 justify-center">
                        <vibe:button variant="primary">
                            Save Data
                        </vibe:button>
                        <vibe:button variant="outline">
                            Export Report
                        </vibe:button>
                    </div>
                </vibe:preview>
            </section>

            {{-- 10. Props Reference --}}
            <section id="referensi-props" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/button.props_title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/button.props_desc') !!}
                    </p>
                </div>

                <div class="overflow-x-auto rounded-xl border border-border bg-card text-card-foreground">
                    <table class="w-full text-left text-xs">
                        <thead class="border-b border-border bg-muted/60 text-foreground font-semibold">
                            <tr>
                                <th class="px-4 py-3 whitespace-nowrap">{{ __('docs/button.table_prop') }}</th>
                                <th class="px-4 py-3 whitespace-nowrap">{{ __('docs/button.table_type') }}</th>
                                <th class="px-4 py-3 whitespace-nowrap">{{ __('docs/button.table_default') }}</th>
                                <th class="px-4 py-3">{{ __('docs/button.table_desc') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border text-muted-foreground">
                            @php
                                $props = [['variant', "'default'|'primary'|'secondary'|'outline'|'ghost'|'surface'|'accent'|'destructive'|'success'|'warning'|'info'|'link'", "'default'", 'Skema warna dan gaya tombol visual.'], ['size', "'xs'|'sm'|'md'|'lg'|'xl'|'icon-xs'|'icon-sm'|'icon-md'|'icon-lg'", "'md'", 'Ukuran tinggi, padding, dan font tombol.'], ['type', "'button'|'submit'|'reset'", "'button'", 'Atribut tipe tombol HTML standar (jika bukan link).'], ['href', 'string|null', 'null', 'Jika diisi, tombol dirender sebagai link `<a wire:navigate>`.'], ['loading', 'bool', 'false', 'Menampilkan animasi spinner loading bawaan dan menonaktifkan klik.'], ['disabled', 'bool', 'false', 'Menonaktifkan tombol serta menerapkan pengurangan opasitas.'], ['class', 'string|null', 'null', 'Kelas Tailwind tambahan yang dimerge via `twMerge` (misal: `rounded-full` untuk gaya pill).']];
                            @endphp
                            @foreach ($props as [$prop, $type, $default, $desc])
                                <tr class="hover:bg-accent/40 transition-colors">
                                    <td class="px-4 py-3 font-mono font-bold text-foreground whitespace-nowrap">{{ $prop }}</td>
                                    <td class="px-4 py-3 font-mono text-muted-foreground whitespace-nowrap">{{ $type }}</td>
                                    <td class="px-4 py-3 font-mono text-muted-foreground/70 whitespace-nowrap">{{ $default }}</td>
                                    <td class="px-4 py-3 text-muted-foreground">{{ $desc }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Slots table --}}
                <p class="text-sm font-semibold text-foreground pt-2">{{ __('docs/button.slots_title') }}</p>
                <div class="overflow-x-auto rounded-xl border border-border bg-card text-card-foreground">
                    <table class="w-full text-left text-xs">
                        <thead class="border-b border-border bg-muted/60 text-foreground font-semibold">
                            <tr>
                                <th class="px-4 py-3">{{ __('docs/button.table_slot') }}</th>
                                <th class="px-4 py-3">{{ __('docs/button.table_desc') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border text-muted-foreground">
                            <tr class="hover:bg-accent/40 transition-colors">
                                <td class="px-4 py-3 font-mono font-bold text-foreground">default ($slot)</td>
                                <td class="px-4 py-3 text-muted-foreground">Label tombol, teks utama, atau kombinasi ikon SVG dan teks di dalam tombol.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

        </div>

        {{-- Table of Contents Sidebar --}}
        <aside class="col-span-12 order-1 md:order-2 md:col-span-3 w-full md:sticky md:top-6">
            <vibe:toc selector="#docs-content" />
        </aside>

    </div>
</x-docs.layouts.sidebar>
