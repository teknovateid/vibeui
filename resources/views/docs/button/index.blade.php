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

            {{-- 13. Props Reference --}}
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
                                ['size', "'xs'|'sm'|'md'|'lg'|'xl'|'icon-xs'|'icon-sm'|'icon-md'|'icon-lg'", "'md'", 'Ukuran tinggi, padding, dan font tombol.'],
                                ['type', "'button'|'submit'|'reset'", "'button'", 'Atribut tipe tombol HTML standar (jika bukan link).'],
                                ['href', 'string|null', 'null', 'Jika diisi, tombol dirender sebagai link `<a wire:navigate>`.'],
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
