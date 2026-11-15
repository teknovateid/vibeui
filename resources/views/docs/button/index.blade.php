<x-docs.layouts.sidebar>
    <vibe:seo :title="__('docs/button.title')" :description="__('docs/button.description')" schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => 'Components', 'url' => '/docs'],
        ['name' => __('docs/button.title'), 'url' => '/docs/button']
    ]" />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">

        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            {{-- Component Header --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <vibe:badge variant="secondary" class="rounded-full">{{ __('docs/button.badge') }}</vibe:badge>
                    <span class="text-xs text-muted-foreground">{{ __('docs/button.group') }}</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">{{ __('docs/button.title') }}</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    {{ __('docs/button.description') }}
                </p>

                {{-- Quick Variants Strip --}}
                <div class="flex flex-wrap items-center gap-1.5 pt-1">
                    @foreach (['default', 'primary', 'secondary', 'outline', 'ghost', 'surface', 'destructive', 'success', 'warning', 'info', 'link'] as $v)
                        <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">{{ $v }}</vibe:badge>
                    @endforeach
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">&lt;vibe:button.group&gt;</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">&lt;vibe:button.show&gt;</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">&lt;vibe:button.edit&gt;</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">&lt;vibe:button.delete&gt;</vibe:badge>
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">pulse</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">shake</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">pop</vibe:badge>
                </div>
            </div>

            {{-- 1. Basic Usage --}}
            <section id="penggunaan-dasar" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/button.basic_usage.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/button.basic_usage.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/button.basic_usage.preview_title')">
                    <vibe:preview.code>
                        <vibe:button>
                            {{ __('docs/button.basic_usage.default_btn') }}
                        </vibe:button>

                        <vibe:button variant="primary">
                            {{ __('docs/button.basic_usage.primary_btn') }}
                        </vibe:button>
                    </vibe:preview.code>
                    <div class="flex flex-wrap items-center gap-3">
                        <vibe:button>{{ __('docs/button.basic_usage.default_btn') }}</vibe:button>
                        <vibe:button variant="primary">{{ __('docs/button.basic_usage.primary_btn') }}</vibe:button>
                    </div>
                </vibe:preview>
            </section>

            {{-- 2. Variants --}}
            <section id="varian-tampilan" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/button.variants.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/button.variants.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/button.variants.preview_title')">
                    <vibe:preview.code>
                        {{-- Core Variants --}}
                        <vibe:button variant="default">{{ __('docs/button.variants.items.default') }}</vibe:button>
                        <vibe:button variant="primary">{{ __('docs/button.variants.items.primary') }}</vibe:button>
                        <vibe:button variant="secondary">{{ __('docs/button.variants.items.secondary') }}</vibe:button>
                        <vibe:button variant="outline">{{ __('docs/button.variants.items.outline') }}</vibe:button>
                        <vibe:button variant="ghost">{{ __('docs/button.variants.items.ghost') }}</vibe:button>
                        <vibe:button variant="surface">{{ __('docs/button.variants.items.surface') }}</vibe:button>

                        {{-- Feedback / Status Variants --}}
                        <vibe:button variant="destructive">{{ __('docs/button.variants.items.destructive') }}</vibe:button>
                        <vibe:button variant="success">{{ __('docs/button.variants.items.success') }}</vibe:button>
                        <vibe:button variant="warning">{{ __('docs/button.variants.items.warning') }}</vibe:button>
                        <vibe:button variant="info">{{ __('docs/button.variants.items.info') }}</vibe:button>

                        {{-- Link Variant --}}
                        <vibe:button variant="link">{{ __('docs/button.variants.items.link') }}</vibe:button>
                    </vibe:preview.code>
                    <div class="flex flex-wrap items-center gap-3 justify-center">
                        @foreach (['default', 'primary', 'secondary', 'outline', 'ghost', 'surface', 'destructive', 'success', 'warning', 'info', 'link'] as $v)
                            <vibe:button :variant="$v">{{ __('docs/button.variants.items.' . $v) }}</vibe:button>
                        @endforeach
                    </div>
                </vibe:preview>
            </section>

            {{-- 3. Sizes --}}
            <section id="ukuran" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/button.sizes.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/button.sizes.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/button.sizes.preview_title')">
                    <vibe:preview.code>
                        <vibe:button size="xs" variant="primary">Extra Small (xs)</vibe:button>
                        <vibe:button size="sm" variant="primary">Small (sm)</vibe:button>
                        <vibe:button size="md" variant="primary">Medium (md)</vibe:button>
                        <vibe:button size="lg" variant="primary">Large (lg)</vibe:button>
                        <vibe:button size="xl" variant="primary">Extra Large (xl)</vibe:button>
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
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/button.icons.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/button.icons.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/button.icons.preview_title')">
                    <vibe:preview.code>
                        {{-- Leading Icon --}}
                        <vibe:button variant="primary">
                            <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14" />
                                <path d="M12 5v14" />
                            </svg>
                            {{ __('docs/button.icons.download') }}
                        </vibe:button>

                        {{-- Trailing Icon --}}
                        <vibe:button variant="outline">
                            {{ __('docs/button.icons.continue') }}
                            <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14" />
                                <path d="m12 5 7 7-7 7" />
                            </svg>
                        </vibe:button>

                        {{-- Icon-Only Buttons (xs, sm, md, lg) --}}
                        <vibe:button size="icon-xs" variant="secondary" aria-label="{{ __('docs/button.icons.filter') }}">
                            <svg class="size-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3" />
                            </svg>
                        </vibe:button>
                        <vibe:button size="icon-sm" variant="secondary" aria-label="{{ __('docs/button.icons.filter') }}">
                            <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3" />
                            </svg>
                        </vibe:button>
                        <vibe:button size="icon-md" variant="secondary" aria-label="{{ __('docs/button.icons.filter') }}">
                            <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3" />
                            </svg>
                        </vibe:button>
                        <vibe:button size="icon-lg" variant="secondary" aria-label="{{ __('docs/button.icons.filter') }}">
                            <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3" />
                            </svg>
                        </vibe:button>
                    </vibe:preview.code>
                    <div class="flex flex-wrap items-center gap-3 justify-center">
                        <vibe:button variant="primary">
                            <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14" />
                                <path d="M12 5v14" />
                            </svg>
                            {{ __('docs/button.icons.download') }}
                        </vibe:button>

                        <vibe:button variant="outline">
                            {{ __('docs/button.icons.continue') }}
                            <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14" />
                                <path d="m12 5 7 7-7 7" />
                            </svg>
                        </vibe:button>

                        <vibe:button size="icon-xs" variant="secondary" :aria-label="__('docs/button.icons.filter')">
                            <svg class="size-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3" />
                            </svg>
                        </vibe:button>
                        <vibe:button size="icon-sm" variant="secondary" :aria-label="__('docs/button.icons.filter')">
                            <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3" />
                            </svg>
                        </vibe:button>
                        <vibe:button size="icon-md" variant="secondary" :aria-label="__('docs/button.icons.filter')">
                            <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3" />
                            </svg>
                        </vibe:button>
                        <vibe:button size="icon-lg" variant="secondary" :aria-label="__('docs/button.icons.filter')">
                            <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3" />
                            </svg>
                        </vibe:button>
                    </div>
                </vibe:preview>

                {{-- Stacked & Custom Icon Sizing (e.g. size-10) --}}
                <div class="space-y-1 pt-4">
                    <h3 class="text-lg font-semibold text-foreground">{{ __('docs/button.icons.stacked_title') }}</h3>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/button.icons.stacked_desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/button.icons.stacked_title')">
                    <vibe:preview.code>
                        {{-- Tombol Vertikal dengan Solar Icon size-10 & teks --}}
                        <vibe:button variant="ghost" size="sm" class="flex flex-col" title="Order">
                            {{-- solar:bag-2-line-duotone --}}
                            <svg class="size-10" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="1.5">
                                    <path d="M3.74132 20.5545C3.74132 20.5545 3.74132 20.5545 3.74132 20.5545C4.94094 22 7.17365 22 11.6391 22H12.3602C16.8257 22 19.0584 22 20.258 20.5545M3.74132 20.5545C2.5417 19.1091 2.95316 16.9146 3.77608 12.5257C4.3613 9.40452 4.65392 7.84393 5.76481 6.92196M20.258 20.5545C20.258 20.5545 20.258 20.5545 20.258 20.5545C21.4576 19.1091 21.0461 16.9146 20.2232 12.5257C19.638 9.40452 19.3454 7.84393 18.2345 6.92196M18.2345 6.92196C18.2345 6.92196 18.2345 6.92196 18.2345 6.92196C17.1236 6 15.5358 6 12.3602 6H11.6391C8.4635 6 6.87571 6 5.76481 6.92196C5.76481 6.92196 5.76482 6.92196 5.76481 6.92196" />
                                    <path d="M15 11L16 17" opacity=".5" />
                                    <path d="M9 11L8 17" opacity=".5" />
                                    <path d="M9 6V5C9 3.34315 10.3431 2 12 2C13.6569 2 15 3.34315 15 5V6" opacity=".5" />
                                </g>
                            </svg>
                            <span class="text-[10px] uppercase font-bold tracking-wider">{{ __('docs/button.icons.order') }}</span>
                        </vibe:button>

                        <vibe:button variant="outline" size="sm" class="flex flex-col" title="Payment">
                            {{-- solar:card-2-line-duotone --}}
                            <svg class="size-10" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="1.5">
                                    <path d="M10 20H14C17.7712 20 19.6569 20 20.8284 18.8284C22 17.6569 22 15.7712 22 12C22 8.22876 22 6.34315 20.8284 5.17157C19.6569 4 17.7712 4 14 4H10C6.22876 4 4.34315 4 3.17157 5.17157C2 6.34315 2 8.22876 2 12C2 15.7712 2 17.6569 3.17157 18.8284C4.34315 20 6.22876 20 10 20Z" />
                                    <path d="M10 16.5H6" opacity=".5" />
                                    <path d="M8 13.5H6" opacity=".5" />
                                    <path d="M2 10L22 10" opacity=".5" />
                                    <path d="M16 17C15.0572 17 14.5858 17 14.2929 16.7071C14 16.4142 14 15.9428 14 15C14 14.0572 14 13.5858 14.2929 13.2929C14.5858 13 15.0572 13 16 13C16.9428 13 17.4142 13 17.7071 13.2929C18 13.5858 18 14.0572 18 15C18 15.9428 18 16.4142 17.7071 16.7071C17.4142 17 16.9428 17 16 17Z" opacity=".5" />
                                </g>
                            </svg>
                            <span class="text-[10px] uppercase font-bold tracking-wider">{{ __('docs/button.icons.payment') }}</span>
                        </vibe:button>

                        <vibe:button variant="surface" size="sm" class="flex flex-col" title="Table">
                            {{-- solar:armchair-2-line-duotone --}}
                            <svg class="size-8" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="1.5">
                                    <path d="M16.5332 18H6.88633C6.82438 18 6.7934 18 6.76531 17.9996C5.26517 17.9786 3.93869 17.1243 3.44197 15.8594C3.43267 15.8357 3.42288 15.8095 3.40329 15.757L2.10028 12.2643C1.68469 11.1504 2.61268 10 3.92689 10C4.7372 10 5.46079 10.4533 5.73699 11.1339L6.83511 13.84C6.93505 14.0863 6.98502 14.2094 7.05744 14.3101C7.22656 14.5452 7.49217 14.7116 7.79716 14.7735C7.92777 14.8 8.07437 14.8 8.36757 14.8H15.3467C15.9158 14.8 16.2004 14.8 16.4383 14.7019C16.5683 14.6484 16.6864 14.5744 16.787 14.4835C16.9713 14.317 17.0683 14.078 17.2623 13.6L18.263 11.1339C18.5392 10.4533 19.2628 10 20.0731 10C21.3873 10 22.3153 11.1504 21.8997 12.2643L20.7803 15.2649C20.5852 15.7879 20.4876 16.0494 20.3588 16.2717C19.8348 17.1756 18.8608 17.8028 17.7354 17.9611C17.4587 18 17.1502 18 16.5332 18Z" />
                                    <path d="M6 11.7896V8.45117C6 6.35287 6 5.30372 6.70294 4.65186C7.40589 4 8.53726 4 10.8 4H13.2C15.4627 4 16.5941 4 17.2971 4.65186C18 5.30372 18 6.35287 18 8.45117V11.7896" opacity=".5" />
                                    <path d="M18 20V18M6 20V18.6667" opacity=".5" />
                                </g>
                            </svg>
                            <span class="text-[10px] uppercase font-bold tracking-wider">{{ __('docs/button.icons.table') }}</span>
                        </vibe:button>

                        <vibe:button variant="secondary" size="sm" class="flex flex-col" title="History">
                            {{-- solar:history-line-duotone --}}
                            <svg class="size-8" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
                                    <path d="M12 8V12L14.5 14.5" opacity=".5" />
                                    <path d="M4.33776 6.87058L5.60414 5.6042C9.10115 2.10719 14.7996 2.13583 18.3319 5.66816C21.8642 9.2005 21.8929 14.8989 18.3959 18.3959C14.8988 21.8929 9.20044 21.8643 5.6681 18.332C3.57589 16.2397 2.71285 13.3876 3.08355 10.6831M4.32497 4.32503L4.33776 6.87058L6.88331 6.88337" />
                                </g>
                            </svg>
                            <span class="text-[10px] uppercase font-bold tracking-wider">{{ __('docs/button.icons.history') }}</span>
                        </vibe:button>
                    </vibe:preview.code>
                    <div class="flex flex-wrap items-center gap-4 justify-center">
                        <vibe:button variant="ghost" size="sm" class="flex flex-col" title="Order">
                            <svg class="size-10 text-primary" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="1.5">
                                    <path d="M3.74132 20.5545C3.74132 20.5545 3.74132 20.5545 3.74132 20.5545C4.94094 22 7.17365 22 11.6391 22H12.3602C16.8257 22 19.0584 22 20.258 20.5545M3.74132 20.5545C2.5417 19.1091 2.95316 16.9146 3.77608 12.5257C4.3613 9.40452 4.65392 7.84393 5.76481 6.92196M20.258 20.5545C20.258 20.5545 20.258 20.5545 20.258 20.5545C21.4576 19.1091 21.0461 16.9146 20.2232 12.5257C19.638 9.40452 19.3454 7.84393 18.2345 6.92196M18.2345 6.92196C18.2345 6.92196 18.2345 6.92196 18.2345 6.92196C17.1236 6 15.5358 6 12.3602 6H11.6391C8.4635 6 6.87571 6 5.76481 6.92196C5.76481 6.92196 5.76482 6.92196 5.76481 6.92196" />
                                    <path d="M15 11L16 17" opacity=".5" />
                                    <path d="M9 11L8 17" opacity=".5" />
                                    <path d="M9 6V5C9 3.34315 10.3431 2 12 2C13.6569 2 15 3.34315 15 5V6" opacity=".5" />
                                </g>
                            </svg>
                            <span class="text-[10px] uppercase font-bold tracking-wider">{{ __('docs/button.icons.order') }}</span>
                        </vibe:button>

                        <vibe:button variant="outline" size="sm" class="flex flex-col" title="Payment">
                            <svg class="size-10 text-success" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="1.5">
                                    <path d="M10 20H14C17.7712 20 19.6569 20 20.8284 18.8284C22 17.6569 22 15.7712 22 12C22 8.22876 22 6.34315 20.8284 5.17157C19.6569 4 17.7712 4 14 4H10C6.22876 4 4.34315 4 3.17157 5.17157C2 6.34315 2 8.22876 2 12C2 15.7712 2 17.6569 3.17157 18.8284C4.34315 20 6.22876 20 10 20Z" />
                                    <path d="M10 16.5H6" opacity=".5" />
                                    <path d="M8 13.5H6" opacity=".5" />
                                    <path d="M2 10L22 10" opacity=".5" />
                                    <path d="M16 17C15.0572 17 14.5858 17 14.2929 16.7071C14 16.4142 14 15.9428 14 15C14 14.0572 14 13.5858 14.2929 13.2929C14.5858 13 15.0572 13 16 13C16.9428 13 17.4142 13 17.7071 13.2929C18 13.5858 18 14.0572 18 15C18 15.9428 18 16.4142 17.7071 16.7071C17.4142 17 16.9428 17 16 17Z" opacity=".5" />
                                </g>
                            </svg>
                            <span class="text-[10px] uppercase font-bold tracking-wider">{{ __('docs/button.icons.payment') }}</span>
                        </vibe:button>

                        <vibe:button variant="surface" size="sm" class="flex flex-col" title="Table">
                            <svg class="size-8 text-info" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="1.5">
                                    <path d="M16.5332 18H6.88633C6.82438 18 6.7934 18 6.76531 17.9996C5.26517 17.9786 3.93869 17.1243 3.44197 15.8594C3.43267 15.8357 3.42288 15.8095 3.40329 15.757L2.10028 12.2643C1.68469 11.1504 2.61268 10 3.92689 10C4.7372 10 5.46079 10.4533 5.73699 11.1339L6.83511 13.84C6.93505 14.0863 6.98502 14.2094 7.05744 14.3101C7.22656 14.5452 7.49217 14.7116 7.79716 14.7735C7.92777 14.8 8.07437 14.8 8.36757 14.8H15.3467C15.9158 14.8 16.2004 14.8 16.4383 14.7019C16.5683 14.6484 16.6864 14.5744 16.787 14.4835C16.9713 14.317 17.0683 14.078 17.2623 13.6L18.263 11.1339C18.5392 10.4533 19.2628 10 20.0731 10C21.3873 10 22.3153 11.1504 21.8997 12.2643L20.7803 15.2649C20.5852 15.7879 20.4876 16.0494 20.3588 16.2717C19.8348 17.1756 18.8608 17.8028 17.7354 17.9611C17.4587 18 17.1502 18 16.5332 18Z" />
                                    <path d="M6 11.7896V8.45117C6 6.35287 6 5.30372 6.70294 4.65186C7.40589 4 8.53726 4 10.8 4H13.2C15.4627 4 16.5941 4 17.2971 4.65186C18 5.30372 18 6.35287 18 8.45117V11.7896" opacity=".5" />
                                    <path d="M18 20V18M6 20V18.6667" opacity=".5" />
                                </g>
                            </svg>
                            <span class="text-[10px] uppercase font-bold tracking-wider">{{ __('docs/button.icons.table') }}</span>
                        </vibe:button>

                        <vibe:button variant="secondary" size="sm" class="flex flex-col" title="History">
                            <svg class="size-8 text-muted-foreground" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
                                    <path d="M12 8V12L14.5 14.5" opacity=".5" />
                                    <path d="M4.33776 6.87058L5.60414 5.6042C9.10115 2.10719 14.7996 2.13583 18.3319 5.66816C21.8642 9.2005 21.8929 14.8989 18.3959 18.3959C14.8988 21.8929 9.20044 21.8643 5.6681 18.332C3.57589 16.2397 2.71285 13.3876 3.08355 10.6831M4.32497 4.32503L4.33776 6.87058L6.88331 6.88337" />
                                </g>
                            </svg>
                            <span class="text-[10px] uppercase font-bold tracking-wider">{{ __('docs/button.icons.history') }}</span>
                        </vibe:button>
                    </div>
                </vibe:preview>
            </section>

            {{-- 5. Pill Style --}}
            <section id="pill-style" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/button.pill.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/button.pill.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/button.pill.preview_title')">
                    <vibe:preview.code>
                        <vibe:button class="rounded-full" variant="primary">{{ __('docs/button.pill.popular') }}</vibe:button>
                        <vibe:button class="rounded-full" variant="secondary">{{ __('docs/button.pill.explore') }}</vibe:button>
                        <vibe:button class="rounded-full" variant="outline">{{ __('docs/button.variants.items.outline') }}</vibe:button>

                        {{-- Circular Icon Button --}}
                        <vibe:button class="rounded-full" size="icon-md" variant="primary" aria-label="Add Item">
                            <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14" />
                                <path d="M12 5v14" />
                            </svg>
                        </vibe:button>
                    </vibe:preview.code>
                    <div class="flex flex-wrap items-center gap-3 justify-center">
                        <vibe:button class="rounded-full" variant="primary">{{ __('docs/button.pill.popular') }}</vibe:button>
                        <vibe:button class="rounded-full" variant="secondary">{{ __('docs/button.pill.explore') }}</vibe:button>
                        <vibe:button class="rounded-full" variant="outline">{{ __('docs/button.variants.items.outline') }}</vibe:button>
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
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/button.loading.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/button.loading.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/button.loading.preview_title')">
                    <vibe:preview.code>
                        {{-- 1. Static Boolean Loading --}}
                        <vibe:button loading variant="primary">
                            {{ __('docs/button.loading.saving') }}
                        </vibe:button>

                        {{-- 2. Custom Loading Text (String) --}}
                        <vibe:button loading="{{ __('docs/button.loading.custom_text_loading') }}" variant="outline">
                            {{ __('docs/button.loading.custom_text_btn') }}
                        </vibe:button>

                        {{-- 3. Icon-only Loading --}}
                        <vibe:button loading variant="secondary" size="icon-md" aria-label="Loading action">
                        </vibe:button>

                        {{-- 4. Interactive Realtime with Alpine.js --}}
                        <div x-data="{ isProcessing: false }">
                            <vibe:button 
                                ::loading="isProcessing" 
                                loading="{{ __('docs/button.loading.alpine_demo_busy') }}"
                                @click="isProcessing = true; setTimeout(() => isProcessing = false, 2000)" 
                                variant="primary"
                            >
                                {{ __('docs/button.loading.alpine_demo_btn') }}
                            </vibe:button>
                        </div>
                    </vibe:preview.code>
                    <div class="flex flex-col sm:flex-row flex-wrap items-center gap-3 justify-center">
                        <vibe:button loading variant="primary">
                            {{ __('docs/button.loading.saving') }}
                        </vibe:button>
                        <vibe:button loading="{{ __('docs/button.loading.custom_text_loading') }}" variant="outline">
                            {{ __('docs/button.loading.custom_text_btn') }}
                        </vibe:button>
                        <vibe:button loading variant="secondary" size="icon-md" aria-label="Loading action">
                        </vibe:button>
                        <div x-data="{ isProcessing: false }">
                            <vibe:button 
                                ::loading="isProcessing" 
                                loading="{{ __('docs/button.loading.alpine_demo_busy') }}"
                                @click="isProcessing = true; setTimeout(() => isProcessing = false, 2000)" 
                                variant="primary"
                            >
                                {{ __('docs/button.loading.alpine_demo_btn') }}
                            </vibe:button>
                        </div>
                    </div>
                </vibe:preview>
            </section>

            {{-- 7. Animation & Attention --}}
            <section id="animasi-tombol" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/button.animation.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/button.animation.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/button.animation.preview_title')">
                    <vibe:preview.code>
<vibe:button pulse variant="primary">
    {{ __('docs/button.animation.cta') }}
</vibe:button>

<vibe:button animation="shake" variant="destructive">
    {{ __('docs/button.animation.danger') }}
</vibe:button>

<vibe:button animation="pop" variant="secondary">
    {{ __('docs/button.animation.pop') }}
</vibe:button>
                    </vibe:preview.code>
                    <div class="flex flex-wrap items-center gap-4 justify-center">
                        <vibe:button pulse variant="primary">
                            {{ __('docs/button.animation.cta') }}
                        </vibe:button>
                        <vibe:button animation="shake" variant="destructive">
                            {{ __('docs/button.animation.danger') }}
                        </vibe:button>
                        <vibe:button animation="pop" variant="secondary">
                            {{ __('docs/button.animation.pop') }}
                        </vibe:button>
                    </div>
                </vibe:preview>
            </section>

            {{-- 8. Disabled State & Type --}}
            <section id="status-disabled" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/button.status.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/button.status.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/button.status.preview_title')">
                    <vibe:preview.code>
                        {{-- Disabled Buttons --}}
                        <vibe:button disabled variant="primary">{{ __('docs/button.status.disabled') }}</vibe:button>
                        <vibe:button disabled variant="outline">{{ __('docs/button.variants.items.outline') }}</vibe:button>
                        <vibe:button disabled variant="destructive">{{ __('docs/button.variants.items.destructive') }}</vibe:button>

                        {{-- HTML Form Button Types --}}
                        <vibe:button type="submit" variant="primary">{{ __('docs/button.status.submit') }}</vibe:button>
                        <vibe:button type="reset" variant="secondary">{{ __('docs/button.status.reset') }}</vibe:button>
                    </vibe:preview.code>
                    <div class="flex flex-wrap items-center gap-3 justify-center">
                        <vibe:button disabled variant="primary">{{ __('docs/button.status.disabled') }}</vibe:button>
                        <vibe:button disabled variant="outline">{{ __('docs/button.variants.items.outline') }}</vibe:button>
                        <vibe:button disabled variant="destructive">{{ __('docs/button.variants.items.destructive') }}</vibe:button>
                        <vibe:button type="submit" variant="primary">{{ __('docs/button.status.submit') }}</vibe:button>
                        <vibe:button type="reset" variant="secondary">{{ __('docs/button.status.reset') }}</vibe:button>
                    </div>
                </vibe:preview>
            </section>

            {{-- 8. Button as Link --}}
            <section id="tombol-link" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/button.link.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/button.link.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/button.link.preview_title')">
                    <vibe:preview.code>
                        {{-- Rendered as <a wire:navigate href="..."> --}}
                        <vibe:button href="/docs" variant="primary">
                            {{ __('docs/button.link.docs') }}
                        </vibe:button>

                        <vibe:button href="/docs/input" variant="outline">
                            Explore Input
                            <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14" />
                                <path d="m12 5 7 7-7 7" />
                            </svg>
                        </vibe:button>
                    </vibe:preview.code>
                    <div class="flex flex-wrap items-center gap-3 justify-center">
                        <vibe:button href="/docs" variant="primary">
                            {{ __('docs/button.link.docs') }}
                        </vibe:button>
                        <vibe:button href="/docs/input" variant="outline">
                            Explore Input
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
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/button.livewire.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/button.livewire.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/button.livewire.preview_title')">
                    <vibe:preview.code>
                        {{-- 1. Auto-wired loading on click --}}
                        <vibe:button wire:click="save" loading variant="primary">
                            {{ __('docs/button.livewire.sync') }}
                        </vibe:button>

                        {{-- 2. With specific target & custom loading text --}}
                        <vibe:button type="submit" wire:target="updatePassword" loading="Memperbarui..." variant="secondary">
                            Perbarui Sandi
                        </vibe:button>
                    </vibe:preview.code>
                    <div class="flex flex-wrap items-center gap-3 justify-center">
                        <vibe:button variant="primary">
                            {{ __('docs/button.livewire.sync') }}
                        </vibe:button>
                        <vibe:button variant="secondary">
                            Perbarui Sandi
                        </vibe:button>
                    </div>
                </vibe:preview>
            </section>

            {{-- 10. Button Group --}}
            <section id="button-group" class="space-y-6">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/button.button_group.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/button.button_group.desc') !!}
                    </p>
                </div>

                {{-- Example 1: Attached / Segmented Filter --}}
                <vibe:preview :title="__('docs/button.button_group.preview_attached_title')">
                    <vibe:preview.code>
                        <vibe:button.group :attached="true">
                            <vibe:button variant="default">{{ __('docs/button.button_group.segmented.daily') }}</vibe:button>
                            <vibe:button variant="default">{{ __('docs/button.button_group.segmented.weekly') }}</vibe:button>
                            <vibe:button variant="primary">{{ __('docs/button.button_group.segmented.monthly') }}</vibe:button>
                            <vibe:button variant="default">{{ __('docs/button.button_group.segmented.yearly') }}</vibe:button>
                        </vibe:button.group>
                    </vibe:preview.code>
                    <div class="flex flex-wrap items-center justify-center p-4">
                        <vibe:button.group :attached="true">
                            <vibe:button variant="default">{{ __('docs/button.button_group.segmented.daily') }}</vibe:button>
                            <vibe:button variant="default">{{ __('docs/button.button_group.segmented.weekly') }}</vibe:button>
                            <vibe:button variant="primary">{{ __('docs/button.button_group.segmented.monthly') }}</vibe:button>
                            <vibe:button variant="default">{{ __('docs/button.button_group.segmented.yearly') }}</vibe:button>
                        </vibe:button.group>
                    </div>
                </vibe:preview>

                {{-- Example 2: Padded Container (Segmented Track & Framed Panel) --}}
                <vibe:preview :title="__('docs/button.button_group.preview_padded_title')">
                    <vibe:preview.code>
                        {{-- Segmented Track Style --}}
                        <vibe:button.group :attached="false" class="p-1 bg-muted rounded-xl gap-1 border border-border">
                            <vibe:button variant="ghost" size="sm" class="bg-card text-card-foreground shadow-2xs font-semibold">
                                {{ __('docs/button.button_group.padded_active') }}
                            </vibe:button>
                            <vibe:button variant="ghost" size="sm" class="text-muted-foreground hover:text-foreground">
                                {{ __('docs/button.button_group.padded_pending') }}
                            </vibe:button>
                            <vibe:button variant="ghost" size="sm" class="text-muted-foreground hover:text-foreground">
                                {{ __('docs/button.button_group.padded_completed') }}
                            </vibe:button>
                        </vibe:button.group>

                        {{-- Padded Pill Switcher --}}
                        <vibe:button.group :attached="false" class="p-1 bg-muted rounded-full gap-1 border border-border">
                            <vibe:button variant="primary" size="sm" class="rounded-full">
                                {{ __('docs/button.button_group.padded_active') }}
                            </vibe:button>
                            <vibe:button variant="ghost" size="sm" class="rounded-full text-muted-foreground hover:text-foreground">
                                {{ __('docs/button.button_group.padded_pending') }}
                            </vibe:button>
                            <vibe:button variant="ghost" size="sm" class="rounded-full text-muted-foreground hover:text-foreground">
                                {{ __('docs/button.button_group.padded_completed') }}
                            </vibe:button>
                        </vibe:button.group>

                        {{-- Padded Attached Toolbar Panel --}}
                        <vibe:button.group class="p-1.5 bg-muted/60 rounded-xl border border-border">
                            <vibe:button variant="default" size="sm">
                                {{ __('docs/button.button_group.segmented.daily') }}
                            </vibe:button>
                            <vibe:button variant="primary" size="sm">
                                {{ __('docs/button.button_group.segmented.weekly') }}
                            </vibe:button>
                            <vibe:button variant="default" size="sm">
                                {{ __('docs/button.button_group.segmented.monthly') }}
                            </vibe:button>
                        </vibe:button.group>
                    </vibe:preview.code>
                    <div class="flex flex-col sm:flex-row flex-wrap items-center justify-center gap-6 p-6">
                        {{-- Segmented Track Style --}}
                        <vibe:button.group :attached="false" class="p-1 bg-muted rounded-xl gap-1 border border-border">
                            <vibe:button variant="ghost" size="sm" class="bg-card text-card-foreground shadow-2xs font-semibold">
                                {{ __('docs/button.button_group.padded_active') }}
                            </vibe:button>
                            <vibe:button variant="ghost" size="sm" class="text-muted-foreground hover:text-foreground">
                                {{ __('docs/button.button_group.padded_pending') }}
                            </vibe:button>
                            <vibe:button variant="ghost" size="sm" class="text-muted-foreground hover:text-foreground">
                                {{ __('docs/button.button_group.padded_completed') }}
                            </vibe:button>
                        </vibe:button.group>

                        {{-- Padded Pill Switcher --}}
                        <vibe:button.group :attached="false" class="p-1 bg-muted rounded-full gap-1 border border-border">
                            <vibe:button variant="primary" size="sm" class="rounded-full">
                                {{ __('docs/button.button_group.padded_active') }}
                            </vibe:button>
                            <vibe:button variant="ghost" size="sm" class="rounded-full text-muted-foreground hover:text-foreground">
                                {{ __('docs/button.button_group.padded_pending') }}
                            </vibe:button>
                            <vibe:button variant="ghost" size="sm" class="rounded-full text-muted-foreground hover:text-foreground">
                                {{ __('docs/button.button_group.padded_completed') }}
                            </vibe:button>
                        </vibe:button.group>

                        {{-- Padded Attached Toolbar Panel --}}
                        <vibe:button.group class="p-1.5 bg-muted/60 rounded-xl border border-border">
                            <vibe:button variant="default" size="sm">
                                {{ __('docs/button.button_group.segmented.daily') }}
                            </vibe:button>
                            <vibe:button variant="primary" size="sm">
                                {{ __('docs/button.button_group.segmented.weekly') }}
                            </vibe:button>
                            <vibe:button variant="default" size="sm">
                                {{ __('docs/button.button_group.segmented.monthly') }}
                            </vibe:button>
                        </vibe:button.group>
                    </div>
                </vibe:preview>

                {{-- Example 3: Split Button with Dropdown Chevron --}}
                <vibe:preview :title="__('docs/button.button_group.preview_split_title')">
                    <vibe:preview.code>
                        <vibe:button.group :attached="true">
                            <vibe:button variant="primary">
                                <svg class="size-4 -ml-0.5 mr-1.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                                </svg>
                                {{ __('docs/button.button_group.split.save') }}
                            </vibe:button>
                            <vibe:button variant="primary" size="icon-md" aria-label="More options">
                                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </vibe:button>
                        </vibe:button.group>
                    </vibe:preview.code>
                    <div class="flex flex-wrap items-center justify-center p-4">
                        <vibe:button.group :attached="true">
                            <vibe:button variant="primary">
                                <svg class="size-4 -ml-0.5 mr-1.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                                </svg>
                                {{ __('docs/button.button_group.split.save') }}
                            </vibe:button>
                            <vibe:button variant="primary" size="icon-md" aria-label="More options">
                                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </vibe:button>
                        </vibe:button.group>
                    </div>
                </vibe:preview>

                {{-- Example 3: Pill Style Group (rounded-full) --}}
                <vibe:preview :title="__('docs/button.button_group.preview_pill_title')">
                    <vibe:preview.code>
                        <vibe:button.group :attached="true" class="rounded-full">
                            <vibe:button variant="outline">{{ __('docs/button.button_group.segmented.daily') }}</vibe:button>
                            <vibe:button variant="outline">{{ __('docs/button.button_group.segmented.weekly') }}</vibe:button>
                            <vibe:button variant="outline">{{ __('docs/button.button_group.segmented.monthly') }}</vibe:button>
                        </vibe:button.group>
                    </vibe:preview.code>
                    <div class="flex flex-wrap items-center justify-center p-4">
                        <vibe:button.group :attached="true" class="rounded-full">
                            <vibe:button variant="outline">{{ __('docs/button.button_group.segmented.daily') }}</vibe:button>
                            <vibe:button variant="outline">{{ __('docs/button.button_group.segmented.weekly') }}</vibe:button>
                            <vibe:button variant="outline">{{ __('docs/button.button_group.segmented.monthly') }}</vibe:button>
                        </vibe:button.group>
                    </div>
                </vibe:preview>

                {{-- Example 4: Vertical Button Group --}}
                <vibe:preview :title="__('docs/button.button_group.preview_vertical_title')">
                    <vibe:preview.code>
                        <vibe:button.group :attached="true" orientation="vertical" class="w-48">
                            <vibe:button variant="default" class="w-full justify-start">
                                {{ __('docs/button.button_group.vertical.overview') }}
                            </vibe:button>
                            <vibe:button variant="default" class="w-full justify-start">
                                {{ __('docs/button.button_group.vertical.analytics') }}
                            </vibe:button>
                            <vibe:button variant="default" class="w-full justify-start">
                                {{ __('docs/button.button_group.vertical.reports') }}
                            </vibe:button>
                        </vibe:button.group>
                    </vibe:preview.code>
                    <div class="flex flex-wrap items-center justify-center p-4">
                        <vibe:button.group :attached="true" orientation="vertical" class="w-48">
                            <vibe:button variant="default" class="w-full justify-start">
                                {{ __('docs/button.button_group.vertical.overview') }}
                            </vibe:button>
                            <vibe:button variant="default" class="w-full justify-start">
                                {{ __('docs/button.button_group.vertical.analytics') }}
                            </vibe:button>
                            <vibe:button variant="default" class="w-full justify-start">
                                {{ __('docs/button.button_group.vertical.reports') }}
                            </vibe:button>
                        </vibe:button.group>
                    </div>
                </vibe:preview>
            </section>

            {{-- 11. Button Show & Data Population --}}
            <section id="button-show" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/button.button_show.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/button.button_show.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/button.button_show.preview_title')">
                    <vibe:preview.code>
<\vibe:button.show
    :url="route('docs.button.show-demo')"
    target="user-detail-modal"
    variant="primary"
>
    {{ __('docs/button.button_show.trigger_btn') }}
</\vibe:button.show>

<\vibe:modal id="user-detail-modal" max-width="2xl">
    <div class="p-6 space-y-6">
        <div class="flex items-center gap-4">
            <\vibe:avatar vibe-show="avatar" size="xl" />
            <div>
                <div class="flex items-center gap-2">
                    <h3 class="text-lg font-bold text-foreground" vibe-show="name"></h3>
                    <\vibe:badge variant="success" size="sm" vibe-show="status"></\vibe:badge>
                </div>
                <p class="text-xs text-muted-foreground" vibe-show="email"></p>
            </div>
        </div>

        {{-- Komponen Form Vibe UI (Otomatis Terisi) --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <\vibe:input name="name" label="Nama Lengkap" />
            <\vibe:input name="email" label="Alamat Email" />
            <\vibe:textarea name="bio" label="Biografi Singkat" class="sm:col-span-2" rows="2" />
            <\vibe:select name="role" label="Peran Akun" :options="['admin' => 'Administrator', 'user' => 'Reguler User']" />
            <div class="flex items-center pt-6">
                <\vibe:switch name="is_active" label="Status Akun Aktif" />
            </div>
        </div>

        {{-- Data Looping: Daftar Produk pada Baris Tabel --}}
        <div class="space-y-2">
            <h4 class="text-xs font-semibold text-foreground uppercase tracking-wider">Daftar Produk yang Dimiliki:</h4>
            <\vibe:table dense>
                <\vibe:table.header>
                    <\vibe:table.column class="w-12 text-center">No</\vibe:table.column>
                    <\vibe:table.column>Nama Produk</\vibe:table.column>
                    <\vibe:table.column class="text-right">Harga</\vibe:table.column>
                </\vibe:table.header>
                <tbody vibe-show-each="products" class="divide-y divide-border/60">
                    <template>
                        <tr class="hover:bg-muted/30 transition-colors">
                            <td class="py-2.5 px-3 text-center text-xs text-muted-foreground" vibe-show="$iteration"></td>
                            <td class="py-2.5 px-3 font-medium text-foreground" vibe-show="name"></td>
                            <td class="py-2.5 px-3 text-right font-semibold text-primary" vibe-show="price"></td>
                        </tr>
                    </template>
                    <tr data-vibe-empty class="hidden">
                        <td colspan="3" class="py-4 text-center text-xs text-muted-foreground">
                            Tidak ada produk.
                        </td>
                    </tr>
                </tbody>
            </\vibe:table>
        </div>
    </div>
</\vibe:modal>
                    </vibe:preview.code>

                    <div class="flex flex-col items-center justify-center p-6 gap-4">
                        <vibe:button.show
                            :url="route('docs.button.show-demo')"
                            target="user-detail-modal"
                            variant="primary"
                        >
                            {{ __('docs/button.button_show.trigger_btn') }}
                        </vibe:button.show>

                        {{-- Modal Container --}}
                        <vibe:modal id="user-detail-modal" max-width="2xl">
                            <div class="p-6 space-y-6">
                                <div class="flex items-center gap-4">
                                    <vibe:avatar vibe-show="avatar" size="xl" />
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <h3 class="text-lg font-bold text-foreground" vibe-show="name"></h3>
                                            <vibe:badge variant="success" size="sm" vibe-show="status"></vibe:badge>
                                        </div>
                                        <p class="text-xs text-muted-foreground" vibe-show="email"></p>
                                    </div>
                                </div>

                                {{-- Komponen Form Vibe UI --}}
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <vibe:input name="name" label="Nama Lengkap" />
                                    <vibe:input name="email" label="Alamat Email" />
                                    <vibe:textarea name="bio" label="Biografi Singkat" class="sm:col-span-2" rows="2" />
                                    <vibe:select name="role" label="Peran Akun" :options="['admin' => 'Administrator', 'user' => 'Reguler User']" />
                                    <div class="flex items-center pt-6">
                                        <vibe:switch name="is_active" label="Status Akun Aktif" />
                                    </div>
                                </div>

                                {{-- Data Looping: Daftar Produk --}}
                                <div class="space-y-2">
                                    <h4 class="text-xs font-semibold text-foreground uppercase tracking-wider">Daftar Produk yang Dimiliki:</h4>
                                    <vibe:table dense>
                                        <vibe:table.header>
                                            <vibe:table.column class="w-12 text-center">No</vibe:table.column>
                                            <vibe:table.column>Nama Produk</vibe:table.column>
                                            <vibe:table.column class="text-right">Harga</vibe:table.column>
                                        </vibe:table.header>
                                        <tbody vibe-show-each="products" class="divide-y divide-border/60">
                                            <template>
                                                <tr class="hover:bg-muted/30 transition-colors">
                                                    <td class="py-2.5 px-3 text-center text-xs text-muted-foreground" vibe-show="$iteration"></td>
                                                    <td class="py-2.5 px-3 font-medium text-foreground" vibe-show="name"></td>
                                                    <td class="py-2.5 px-3 text-right font-semibold text-primary" vibe-show="price"></td>
                                                </tr>
                                            </template>
                                            <tr data-vibe-empty class="hidden">
                                                <td colspan="3" class="py-4 text-center text-xs text-muted-foreground">
                                                    Tidak ada produk.
                                                </td>
                                            </tr>
                                        </tbody>
                                    </vibe:table>
                                </div>
                            </div>
                        </vibe:modal>
                    </div>
                </vibe:preview>

                {{-- Preview 11B: Ukuran Ikon & Custom Slot --}}
                <vibe:preview :title="__('docs/button.button_show.preview_title') . ' - Mode Ikon & Slot'">
                    <vibe:preview.code>
{{-- 1. Mode Ikon Standar (icon-xs, icon-sm, icon-md) --}}
<div class="flex items-center gap-2">
    <\vibe:button.show :url="route('docs.button.show-demo')" target="user-detail-modal" size="icon-xs" variant="ghost" />
    <\vibe:button.show :url="route('docs.button.show-demo')" target="user-detail-modal" size="icon-sm" variant="ghost" />
    <\vibe:button.show :url="route('docs.button.show-demo')" target="user-detail-modal" size="icon-md" variant="outline" />
</div>

{{-- 2. Tombol dengan Teks Slot Kustom & Varian Beragam --}}
<div class="flex items-center gap-2">
    <\vibe:button.show :url="route('docs.button.show-demo')" target="user-detail-modal" variant="primary" size="sm">
        Lihat Profil
    </\vibe:button.show>
    <\vibe:button.show :url="route('docs.button.show-demo')" target="user-detail-modal" variant="outline" size="sm">
        Detail Pengguna
    </\vibe:button.show>
</div>
                    </vibe:preview.code>

                    <div class="flex flex-wrap items-center gap-3 p-4">
                        <div class="flex items-center gap-1.5 p-2 rounded-lg border border-border bg-background">
                            <span class="text-xs text-muted-foreground mr-1">Icon Sizes:</span>
                            <vibe:button.show :url="route('docs.button.show-demo')" target="user-detail-modal" size="icon-xs" variant="ghost" title="icon-xs" />
                            <vibe:button.show :url="route('docs.button.show-demo')" target="user-detail-modal" size="icon-sm" variant="ghost" title="icon-sm" />
                            <vibe:button.show :url="route('docs.button.show-demo')" target="user-detail-modal" size="icon-md" variant="outline" title="icon-md" />
                        </div>
                        <div class="flex items-center gap-2">
                            <vibe:button.show :url="route('docs.button.show-demo')" target="user-detail-modal" variant="primary" size="sm">
                                Lihat Profil
                            </vibe:button.show>
                            <vibe:button.show :url="route('docs.button.show-demo')" target="user-detail-modal" variant="outline" size="sm">
                                Detail Pengguna
                            </vibe:button.show>
                        </div>
                    </div>
                </vibe:preview>
            </section>

            {{-- 12. Button Delete & Confirmation --}}
            <section id="button-delete" class="space-y-6">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/button.button_delete.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/button.button_delete.desc') !!}
                    </p>
                </div>

                {{-- Preview 12A: Basic Delete with confirmation dialog --}}
                <vibe:preview :title="__('docs/button.button_delete.preview_title')">
                    <vibe:preview.code>
{{-- 1. Tombol Hapus Bawaan (Icon Sampah & Destructive Ghost) --}}
<\vibe:button.delete
    action="vibeAlert({ type: 'success', title: 'Data Dihapus', message: 'Item berhasil dihapus dari sistem.' })"
/>

{{-- 2. Tombol Hapus dengan Teks Slot Kustom --}}
<\vibe:button.delete
    action="vibeAlert({ type: 'success', title: 'Data Dihapus', message: 'Item berhasil dihapus dari sistem.' })"
>
    {{ __('docs/button.button_delete.trigger_btn') }}
</\vibe:button.delete>

{{-- 3. Varian Outline Destructive --}}
<\vibe:button.delete
    variant="outline"
    action="vibeAlert({ type: 'success', title: 'Data Dihapus', message: 'Item berhasil dihapus dari sistem.' })"
>
    {{ __('docs/button.button_delete.trigger_btn') }}
</\vibe:button.delete>

{{-- 4. Gaya Pill Membulat Penuh (class='rounded-full') --}}
<\vibe:button.delete
    class="rounded-full"
    action="vibeAlert({ type: 'success', title: 'Data Dihapus', message: 'Item berhasil dihapus dari sistem.' })"
>
    {{ __('docs/button.button_delete.trigger_btn') }}
</\vibe:button.delete>
                    </vibe:preview.code>

                    <div class="flex flex-wrap items-center gap-3 p-4">
                        <vibe:button.delete
                            action="vibeAlert({ type: 'success', title: 'Data Dihapus', message: 'Item berhasil dihapus dari sistem.' })"
                        />

                        <vibe:button.delete
                            action="vibeAlert({ type: 'success', title: 'Data Dihapus', message: 'Item berhasil dihapus dari sistem.' })"
                        >
                            {{ __('docs/button.button_delete.trigger_btn') }}
                        </vibe:button.delete>

                        <vibe:button.delete
                            variant="outline"
                            action="vibeAlert({ type: 'success', title: 'Data Dihapus', message: 'Item berhasil dihapus dari sistem.' })"
                        >
                            {{ __('docs/button.button_delete.trigger_btn') }}
                        </vibe:button.delete>

                        <vibe:button.delete
                            class="rounded-full"
                            action="vibeAlert({ type: 'success', title: 'Data Dihapus', message: 'Item berhasil dihapus dari sistem.' })"
                        >
                            {{ __('docs/button.button_delete.trigger_btn') }}
                        </vibe:button.delete>
                    </div>
                </vibe:preview>

                {{-- Preview 12B: Kolom Aksi Tabel (Tabel baris dengan button.show dan button.delete) --}}
                <vibe:preview :title="__('docs/button.button_delete.preview_table_title')">
                    <vibe:preview.code>
{{-- Contoh Integrasi Kolom Aksi Tabel (icon-xs / icon-sm) --}}
<table class="w-full text-sm text-left">
    <thead class="border-b text-xs text-muted-foreground">
        <tr>
            <th class="py-2.5 px-3">Pengguna</th>
            <th class="py-2.5 px-3">Email</th>
            <th class="py-2.5 px-3">Peran</th>
            <th class="py-2.5 px-3 text-right">Aksi</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-border">
        <tr>
            <td class="py-2.5 px-3 font-medium text-foreground">Masum Parvej</td>
            <td class="py-2.5 px-3 text-xs text-muted-foreground font-mono">masum@hugeicons.com</td>
            <td class="py-2.5 px-3">
                <\vibe:badge variant="primary" size="xs">Admin</\vibe:badge>
            </td>
            <td class="py-2.5 px-3 text-right">
                <div class="flex items-center justify-end gap-1">
                    {{-- Tombol Lihat Detail --}}
                    <\vibe:button.show
                        :url="route('docs.button.show-demo')"
                        target="user-detail-modal"
                        size="icon-xs"
                        variant="ghost"
                        title="Lihat Detail"
                    />
                    {{-- Tombol Hapus Data --}}
                    <\vibe:button.delete
                        size="icon-xs"
                        variant="ghost"
                        action="vibeAlert({ type: 'success', title: 'Data Dihapus', message: 'Pengguna Masum Parvej telah dihapus.' })"
                        title="Hapus Pengguna"
                    />
                </div>
            </td>
        </tr>
    </tbody>
</table>
                    </vibe:preview.code>

                    <div class="p-4 border rounded-xl bg-card">
                        <table class="w-full text-sm text-left">
                            <thead class="border-b text-xs text-muted-foreground">
                                <tr>
                                    <th class="py-2.5 px-3">Pengguna</th>
                                    <th class="py-2.5 px-3">Email</th>
                                    <th class="py-2.5 px-3">Peran</th>
                                    <th class="py-2.5 px-3 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-border">
                                <tr>
                                    <td class="py-2.5 px-3 font-medium text-foreground">Masum Parvej</td>
                                    <td class="py-2.5 px-3 text-xs text-muted-foreground font-mono">masum@hugeicons.com</td>
                                    <td class="py-2.5 px-3">
                                        <vibe:badge variant="primary" size="xs">Admin</vibe:badge>
                                    </td>
                                    <td class="py-2.5 px-3 text-right">
                                        <div class="flex items-center justify-end gap-1">
                                            <vibe:button.show
                                                :url="route('docs.button.show-demo')"
                                                target="user-detail-modal"
                                                size="icon-xs"
                                                variant="ghost"
                                                title="Lihat Detail"
                                            />
                                            <vibe:button.delete
                                                size="icon-xs"
                                                variant="ghost"
                                                action="vibeAlert({ type: 'success', title: 'Data Dihapus', message: 'Pengguna Masum Parvej telah dihapus.' })"
                                                title="Hapus Pengguna"
                                            />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2.5 px-3 font-medium text-foreground">Jane Doe</td>
                                    <td class="py-2.5 px-3 text-xs text-muted-foreground font-mono">jane@example.com</td>
                                    <td class="py-2.5 px-3">
                                        <vibe:badge variant="outline" size="xs">Member</vibe:badge>
                                    </td>
                                    <td class="py-2.5 px-3 text-right">
                                        <div class="flex items-center justify-end gap-1">
                                            <vibe:button.show
                                                :url="route('docs.button.show-demo')"
                                                target="user-detail-modal"
                                                size="icon-xs"
                                                variant="ghost"
                                                title="Lihat Detail"
                                            />
                                            <vibe:button.delete
                                                size="icon-xs"
                                                variant="ghost"
                                                action="vibeAlert({ type: 'success', title: 'Data Dihapus', message: 'Pengguna Jane Doe telah dihapus.' })"
                                                title="Hapus Pengguna"
                                            />
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </vibe:preview>

                {{-- Preview 12C: Kustomisasi Teks Dialog Konfirmasi --}}
                <vibe:preview :title="__('docs/button.button_delete.custom_dialog_title')">
                    <vibe:preview.code>
                        {{-- Kustomisasi Dialog: Title, Pesan, Teks Konfirmasi & Batal --}}
                        <vibe:button.delete
                            title="Hapus Akun Pengguna?"
                            message="Tindakan ini permanen. Seluruh data transaksi, riwayat pesanan, dan lisensi akan dihapus selamanya dari basis data."
                            confirm-text="Ya, Hapus Akun"
                            cancel-text="Batal & Simpan"
                            action="vibeAlert({ type: 'info', title: 'Dikonfirmasi', message: 'Permintaan hapus akun telah dikonfirmasi.' })"
                        >
                            {{ __('docs/button.button_delete.trigger_account') }}
                        </vibe:button.delete>
                    </vibe:preview.code>

                    <div class="p-4 flex flex-wrap items-center gap-3">
                        <vibe:button.delete
                            title="Hapus Akun Pengguna?"
                            message="Tindakan ini permanen. Seluruh data transaksi, riwayat pesanan, dan lisensi akan dihapus selamanya dari basis data."
                            confirm-text="Ya, Hapus Akun"
                            cancel-text="Batal & Simpan"
                            action="vibeAlert({ type: 'info', title: 'Dikonfirmasi', message: 'Permintaan hapus akun telah dikonfirmasi.' })"
                        >
                            {{ __('docs/button.button_delete.trigger_account') }}
                        </vibe:button.delete>
                    </div>
                </vibe:preview>

                {{-- Preview 12D: Berbagai Metode Eksekusi --}}
                <div class="p-5 rounded-2xl border border-border bg-card space-y-4">
                    <h3 class="text-base font-bold text-foreground">{{ __('docs/button.button_delete.preview_methods_title') }}</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-xs">
                        <div class="p-3.5 rounded-xl border border-border bg-background space-y-2">
                            <span class="font-bold text-foreground font-mono">1. Livewire (wire:click)</span>
                            <p class="text-muted-foreground">Dialog konfirmasi dicegat terlebih dahulu. Jika disetujui, aksi Livewire otomatis dijalankan:</p>
                            <pre class="p-2 rounded bg-muted font-mono text-[11px] overflow-x-auto text-foreground">&lt;vibe:button.delete wire:click="deleteRecord({{ '$item->id' }})" /&gt;</pre>
                        </div>
                        <div class="p-3.5 rounded-xl border border-border bg-background space-y-2">
                            <span class="font-bold text-foreground font-mono">2. Form URL (HTTP DELETE)</span>
                            <p class="text-muted-foreground">Otomatis men-submit form POST dengan method DELETE dan CSRF token ke controller Laravel standar:</p>
                            <pre class="p-2 rounded bg-muted font-mono text-[11px] overflow-x-auto text-foreground">&lt;vibe:button.delete :url="route('users.destroy', $user)" /&gt;</pre>
                        </div>
                        <div class="p-3.5 rounded-xl border border-border bg-background space-y-2">
                            <span class="font-bold text-foreground font-mono">3. Custom JavaScript (action)</span>
                            <p class="text-muted-foreground">Mengeksekusi kode JavaScript atau fungsi kustom setelah pengguna mengonfirmasi dialog:</p>
                            <pre class="p-2 rounded bg-muted font-mono text-[11px] overflow-x-auto text-foreground">&lt;vibe:button.delete action="handleDelete(item.id)" /&gt;</pre>
                        </div>
                    </div>
                </div>
            </section>

            {{-- 13. Button Edit & Polymorphic Sheet/Modal Trigger --}}
            <section id="button-edit" class="space-y-6">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/button.button_edit.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/button.button_edit.desc') !!}
                    </p>
                </div>

                {{-- Preview 13A: In-place Sheet Trigger with Instant Row Data --}}
                <vibe:preview :title="__('docs/button.button_edit.preview_instant_title')">
                    <vibe:preview.code>
{{-- 1. Injeksi Data Baris Instan ke Target Sheet (0ms Delay Tanpa Request Jaringan) --}}
@php
    $sampleUser = [
        'name' => 'Fahril Royanza',
        'email' => 'fahril@teknovate.co.id',
        'role' => 'Administrator',
    ];
@endphp

<div class="flex items-center gap-3">
    <\vibe:button.edit
        target="demo-edit-sheet"
        :data="$sampleUser"
        action="/dashboard/users/update/1"
        onSuccess="$vibe.toast.info('Formulir siap diedit!')"
    >
        Edit User (Instant Sheet)
    </\vibe:button.edit>

    {{-- Mode Ikon Saja untuk Kolom Aksi Tabel --}}
    <\vibe:button.edit
        target="demo-edit-modal"
        :data="$sampleUser"
        action="/dashboard/users/update/1"
        size="icon-sm"
        title="Edit Pengguna"
    />
</div>
                    </vibe:preview.code>

                    @php
                        $sampleUser = [
                            'name' => 'Fahril Royanza',
                            'email' => 'fahril@teknovate.co.id',
                            'role' => 'Administrator',
                        ];
                    @endphp

                    <div class="flex flex-wrap items-center gap-3 p-4">
                        <vibe:button.edit
                            target="demo-edit-sheet"
                            :data="$sampleUser"
                            action="/dashboard/users/update/1"
                            onSuccess="$vibe.toast.info('Formulir siap diedit!')"
                        >
                            Edit User (Instant Sheet)
                        </vibe:button.edit>

                        <vibe:button.edit
                            target="demo-edit-modal"
                            :data="$sampleUser"
                            action="/dashboard/users/update/1"
                            size="icon-sm"
                            title="Edit Pengguna"
                        />
                    </div>

                    {{-- Target Sheet Demo --}}
                    <vibe:sheet id="demo-edit-sheet" size="md">
                        <div class="p-6 space-y-5">
                            <div>
                                <h3 class="text-base font-bold text-foreground">Edit Pengguna (Sheet)</h3>
                                <p class="text-xs text-muted-foreground mt-0.5">Data disuntikkan secara instan ke dalam formulir.</p>
                            </div>
                            <form action="/dashboard/users/update/1" method="POST" class="space-y-4" @submit.prevent="$vibe.sheet('demo-edit-sheet').close(); $vibe.toast.success('Perubahan disimpan!');">
                                @csrf
                                <vibe:input name="name" label="Nama Lengkap" placeholder="Masukkan nama" />
                                <vibe:input name="email" label="Email" type="email" placeholder="Masukkan email" />
                                <vibe:input name="role" label="Peran / Role" placeholder="Role pengguna" />
                                <div class="flex justify-end gap-2 pt-2">
                                    <vibe:button type="button" variant="outline" size="sm" @click="$vibe.sheet('demo-edit-sheet').close()">Batal</vibe:button>
                                    <vibe:button type="submit" variant="primary" size="sm">Simpan</vibe:button>
                                </div>
                            </form>
                        </div>
                    </vibe:sheet>

                    {{-- Target Modal Demo --}}
                    <vibe:modal id="demo-edit-modal">
                        <div class="p-6 space-y-5">
                            <div>
                                <h3 class="text-base font-bold text-foreground">Edit Pengguna (Modal)</h3>
                                <p class="text-xs text-muted-foreground mt-0.5">Target polimorfik mendukung ID Modal yang sama.</p>
                            </div>
                            <form action="/dashboard/users/update/1" method="POST" class="space-y-4" @submit.prevent="$vibe.modal('demo-edit-modal').close(); $vibe.toast.success('Perubahan disimpan!');">
                                @csrf
                                <vibe:input name="name" label="Nama Lengkap" />
                                <vibe:input name="email" label="Email" type="email" />
                                <div class="flex justify-end gap-2 pt-2">
                                    <vibe:button type="button" variant="outline" size="sm" @click="$vibe.modal('demo-edit-modal').close()">Batal</vibe:button>
                                    <vibe:button type="submit" variant="primary" size="sm">Simpan</vibe:button>
                                </div>
                            </form>
                        </div>
                    </vibe:modal>
                </vibe:preview>

                {{-- Preview 13B: Berbagai Skenario Eksekusi --}}
                <div class="p-5 rounded-2xl border border-border bg-card space-y-4">
                    <h3 class="text-base font-bold text-foreground">{{ __('docs/button.button_edit.props_title') }} - Skenario Eksekusi</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 text-xs">
                        <div class="p-3.5 rounded-xl border border-border bg-background space-y-2">
                            <span class="font-bold text-foreground font-mono">1. Instant Data + Target</span>
                            <p class="text-muted-foreground">Mengisi form seketika dengan data baris tabel yang ada dan membuka sheet/modal tanpa request jaringan:</p>
                            <pre class="p-2 rounded bg-muted font-mono text-[11px] overflow-x-auto text-foreground">&lt;vibe:button.edit
    target="user-sheet"
    :data="$user"
    :action="route('users.update', $user)"
/&gt;</pre>
                        </div>
                        <div class="p-3.5 rounded-xl border border-border bg-background space-y-2">
                            <span class="font-bold text-foreground font-mono">2. API Fetch (url) + Target</span>
                            <p class="text-muted-foreground">Menampilkan loading spinner pada tombol, mengambil JSON via AJAX, mengisi form, lalu membuka container:</p>
                            <pre class="p-2 rounded bg-muted font-mono text-[11px] overflow-x-auto text-foreground">&lt;vibe:button.edit
    target="user-modal"
    url="/api/users/1"
    action="/users/update/1"
/&gt;</pre>
                        </div>
                        <div class="p-3.5 rounded-xl border border-border bg-background space-y-2">
                            <span class="font-bold text-foreground font-mono">3. Livewire (wire:click)</span>
                            <p class="text-muted-foreground">Mengeksekusi method Livewire di backend dengan event isolation (<code class="font-mono text-primary">.stop</code>) agar tidak memicu reload datatable:</p>
                            <pre class="p-2 rounded bg-muted font-mono text-[11px] overflow-x-auto text-foreground">&lt;vibe:button.edit
    wire:click="edit({{ '$user->id' }})"
    size="icon-sm"
/&gt;</pre>
                        </div>
                        <div class="p-3.5 rounded-xl border border-border bg-background space-y-2">
                            <span class="font-bold text-foreground font-mono">4. Page Redirect (href)</span>
                            <p class="text-muted-foreground">Navigasi langsung ke URL halaman edit lengkap dengan SPA navigation (<code class="font-mono text-primary">wire:navigate</code>):</p>
                            <pre class="p-2 rounded bg-muted font-mono text-[11px] overflow-x-auto text-foreground">&lt;vibe:button.edit
    :href="route('users.edit', $user)"
    variant="outline"
&gt;
    Edit
&lt;/vibe:button.edit&gt;</pre>
                        </div>
                    </div>
                </div>

                {{-- Preview 13C: Props Table for Button Edit --}}
                <div class="space-y-2 pt-2">
                    <p class="text-sm font-semibold text-foreground">{{ __('docs/button.button_edit.props_title') }}</p>
                    <p class="text-xs text-muted-foreground">{{ __('docs/button.button_edit.props_desc') }}</p>
                    <vibe:table>
                        <vibe:table.header>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/button.props.columns.prop') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/button.props.columns.type') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/button.props.columns.default') }}</vibe:table.column>
                            <vibe:table.column>{{ __('docs/button.props.columns.desc') }}</vibe:table.column>
                        </vibe:table.header>
                        <vibe:table.rows>
                            @php
                                $editProps = [
                                    ['target', 'string|null', 'null', 'ID komponen Sheet atau Modal yang akan dibuka (polimorfik).'],
                                    ['href', 'string|null', 'null', 'URL tujuan jika tombol digunakan untuk redirect ke halaman edit mandiri.'],
                                    ['url', 'string|null', 'null', 'URL endpoint API untuk mengambil data edit via AJAX GET sebelum membuka modal/sheet.'],
                                    ['action', 'string|null', 'null', 'URL yang akan disuntikkan ke atribut form.action pada form di dalam target (tanpa memaksakan method PUT).'],
                                    ['data', 'array|object|null', 'null', 'Data baris lokal untuk disuntikkan seketika (0ms) tanpa request jaringan.'],
                                    ['onSuccess', 'string|null', 'null', 'Ekspresi JavaScript yang dijalankan setelah target berhasil dibuka dan data terisi.'],
                                    ['onError', 'string|null', 'null', 'Ekspresi JavaScript yang dijalankan jika fetch API gagal.'],
                                    ['resetErrors', 'bool', 'true', 'Membersihkan pesan error validasi sisa submission sebelumnya pada form target.'],
                                    ['variant', 'string', "'ghost'", 'Skema visual tombol Vibe UI (default: ghost).'],
                                    ['size', 'string', "'md'", 'Ukuran tombol (xs, sm, md, lg, icon-xs, icon-sm, dll).'],
                                    ['title', 'string|null', 'null', 'Teks tooltip saat tombol di-hover (default: trans "vibe/button.edit_title").'],
                                ];
                            @endphp
                            @foreach ($editProps as [$prop, $type, $default, $desc])
                                <vibe:table.row>
                                    <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $prop }}</vibe:table.cell>
                                    <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">{{ $type }}</vibe:table.cell>
                                    <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">{{ $default }}</vibe:table.cell>
                                    <vibe:table.cell class="text-muted-foreground">{{ $desc }}</vibe:table.cell>
                                </vibe:table.row>
                            @endforeach
                        </vibe:table.rows>
                    </vibe:table>
                </div>
            </section>

            {{-- 14. Props Reference --}}
            <section id="referensi-props" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/button.props.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/button.props.desc') !!}
                    </p>
                </div>

                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/button.props.columns.prop') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/button.props.columns.type') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/button.props.columns.default') }}</vibe:table.column>
                        <vibe:table.column>{{ __('docs/button.props.columns.desc') }}</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        @php
                            $props = [
                                ['variant', "'default'|'primary'|'secondary'|'outline'|'ghost'|'surface'|'destructive'|'success'|'warning'|'info'|'link'", "'default'", 'Skema warna dan gaya tombol visual.'],
                                ['size', "'xs'|'sm'|'md'|'lg'|'xl'|'auto'|'none'|'icon-xs'|'icon-sm'|'icon-md'|'icon-lg'|'icon-xl'|'icon-2xl'|'icon-10'|'icon-12'", "'md'", 'Ukuran tinggi, padding, dan font tombol. Mendukung ukuran teks, icon-only, auto, none, serta adaptasi h-auto otomatis pada tombol bertumpuk vertical (flex-col).'],
                                ['type', "'button'|'submit'|'reset'", "'button'", 'Atribut tipe tombol HTML standar (jika bukan link).'],
                                ['href', 'string|null', 'null', 'Jika diisi, tombol dirender sebagai elemen `<a>`. Otomatis mengaktifkan SPA navigation via `wire:navigate` kecuali terdapat atribut `target` (seperti `target="_blank"`) atau `:navigate="false"`.'],
                                ['navigate', 'bool|null', 'null', 'Mengontrol penggunaan SPA navigation (`wire:navigate`). Default: auto (aktif jika tanpa atribut target selain `_self`, nonaktif jika target="_blank" atau link eksternal).'],
                                ['loading', 'bool|string', 'false', 'Menampilkan animasi spinner loading bawaan. Menerima boolean, teks string loading (misal: "Menyimpan..."), atau binding ekspresi Alpine (::loading="expr") & Livewire.'],
                                ['disabled', 'bool', 'false', 'Menonaktifkan tombol serta menerapkan pengurangan opasitas.'],
                                ['pulse', 'bool', 'false', 'Menambahkan efek denyut cincin bercahaya berkala (.animate-vibe-pulse) untuk tombol CTA.'],
                                ['animation', "'pulse'|'shake'|'pop'|'wobble'|false", 'false', 'Efek animasi visual pada tombol. Default: false.'],
                                ['class', 'string|null', 'null', 'Kelas Tailwind tambahan yang dimerge via `twMerge` (misal: `rounded-full` untuk gaya pill).'],
                            ];
                        @endphp
                        @foreach ($props as [$prop, $type, $default, $desc])
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $prop }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">{{ $type }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">{{ $default }}</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{{ $desc }}</vibe:table.cell>
                            </vibe:table.row>
                        @endforeach
                    </vibe:table.rows>
                </vibe:table>

                {{-- Button Group Props table --}}
                <p class="text-sm font-semibold text-foreground pt-4">{{ __('docs/button.button_group.props_title') }}</p>
                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/button.props.columns.prop') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/button.props.columns.type') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/button.props.columns.default') }}</vibe:table.column>
                        <vibe:table.column>{{ __('docs/button.props.columns.desc') }}</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        @php
                            $groupProps = [
                                ['orientation', "'horizontal'|'vertical'", "'horizontal'", 'Orientasi penataan tombol di dalam grup.'],
                                ['attached', 'bool', 'false', 'Jika true, border dan radius sudut tombol saling menempel tanpa celah.'],
                                ['variant', "'default'|'outline'|'surface'|'ghost'|'attached'", "'default'", 'Skema warna latar dan border track button group (default menyerupai track toolbar preview).'],
                                ['size', "'xs'|'sm'|'md'|'lg'|'xl'", "'sm'", 'Ukuran padding, gap, dan border radius track button group.'],
                                ['class', 'string|null', 'null', 'Kelas Tailwind tambahan (gunakan `rounded-full` untuk membuat grup membulat penuh).']
                            ];
                        @endphp
                        @foreach ($groupProps as [$prop, $type, $default, $desc])
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $prop }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">{{ $type }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">{{ $default }}</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{{ $desc }}</vibe:table.cell>
                            </vibe:table.row>
                        @endforeach
                    </vibe:table.rows>
                </vibe:table>

                {{-- Button Show Props table --}}
                <p class="text-sm font-semibold text-foreground pt-4">Props &lt;vibe:button.show&gt;</p>
                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/button.props.columns.prop') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/button.props.columns.type') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/button.props.columns.default') }}</vibe:table.column>
                        <vibe:table.column>{{ __('docs/button.props.columns.desc') }}</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        @php
                            $showProps = [
                                ['url', 'string', 'null', 'URL endpoint AJAX untuk mengambil data JSON (wajib).'],
                                ['target', 'string', 'null', 'ID kontainer target atau selector CSS yang akan diisi data dan ditampilkan (wajib). Otomatis membuka modal atau sheet jika ID sesuai.'],
                                ['method', "'GET'|'POST'", "'GET'", 'Metode HTTP request yang digunakan.'],
                                ['variant', 'string', "'ghost'", 'Varian visual tombol Vibe.'],
                                ['size', 'string', "'md'", 'Ukuran tombol Vibe.'],
                                ['title', 'string|null', 'null', 'Tooltip atau judul tombol (default: "Lihat detail" / "View details").'],
                            ];
                        @endphp
                        @foreach ($showProps as [$prop, $type, $default, $desc])
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $prop }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">{{ $type }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">{{ $default }}</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{{ $desc }}</vibe:table.cell>
                            </vibe:table.row>
                        @endforeach
                    </vibe:table.rows>
                </vibe:table>

                {{-- Button Delete Props table --}}
                <p class="text-sm font-semibold text-foreground pt-4">{{ __('docs/button.button_delete.props_title') }}</p>
                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/button.props.columns.prop') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/button.props.columns.type') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/button.props.columns.default') }}</vibe:table.column>
                        <vibe:table.column>{{ __('docs/button.props.columns.desc') }}</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        @php
                            $deleteProps = [
                                ['variant', "'ghost'|'outline'", "'ghost'", 'Skema gaya tampilan visual tombol (default ghost dengan warna teks merah destruktif).'],
                                ['size', "'xs'|'sm'|'md'|'lg'|'xl'|'icon-xs'|'icon-sm'|'icon-md'|'icon-lg'", "'md'", 'Ukuran tinggi tombol dan ikon tempat sampah SVG bawaan.'],
                                ['title', 'string|null', 'null', 'Judul dialog konfirmasi modal (default dari translasi: "Hapus Data?" / "Delete Data").'],
                                ['message', 'string|null', 'null', 'Pesan konfirmasi bahaya penghapusan data (default: "Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.").'],
                                ['confirmText', 'string|null', 'null', 'Label teks pada tombol konfirmasi persetujuan (default: "Ya, Hapus" / "Yes, Delete").'],
                                ['cancelText', 'string|null', 'null', 'Label teks pada tombol pembatalan konfirmasi (default: "Batal" / "Cancel").'],
                                ['url', 'string|null', 'null', 'URL endpoint aksi penghapusan. Otomatis membuat dan men-submit form POST dengan _method=DELETE dan token CSRF.'],
                                ['action', 'string|null', 'null', 'Ekspresi atau callback JavaScript yang dijalankan setelah pengguna mengonfirmasi persetujuan dialog.'],
                                ['wire:click', 'string|null', 'null', 'Nama aksi metode Livewire yang dipanggil secara otomatis setelah konfirmasi disetujui.'],
                                ['class', 'string|null', 'null', 'Kelas utility Tailwind tambahan yang digabungkan via twMerge (misal: rounded-full untuk gaya pill).'],
                            ];
                        @endphp
                        @foreach ($deleteProps as [$prop, $type, $default, $desc])
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $prop }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">{{ $type }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">{{ $default }}</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{{ $desc }}</vibe:table.cell>
                            </vibe:table.row>
                        @endforeach
                    </vibe:table.rows>
                </vibe:table>

                {{-- Slots table --}}
                <p class="text-sm font-semibold text-foreground pt-4">{{ __('docs/button.slots.title') }}</p>
                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column>{{ __('docs/button.slots.columns.slot') }}</vibe:table.column>
                        <vibe:table.column>{{ __('docs/button.slots.columns.desc') }}</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-foreground">default ($slot)</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">Label tombol, teks utama, atau kombinasi ikon SVG dan teks di dalam tombol. Jika kosong pada button.show akan merender ikon mata bawaan, dan pada button.delete akan merender ikon tempat sampah bawaan.</vibe:table.cell>
                        </vibe:table.row>
                    </vibe:table.rows>
                </vibe:table>
            </section>

        </div>

        {{-- Table of Contents Sidebar --}}
        <aside class="col-span-12 order-1 md:order-2 md:col-span-3 w-full md:sticky md:top-6 group-has-[header.sticky]/docs:md:top-20">
            <vibe:toc selector="#docs-content" />
        </aside>

    </div>
</x-docs.layouts.sidebar>
