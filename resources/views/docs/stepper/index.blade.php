<x-docs.layouts.sidebar>
    <vibe:seo :title="__('docs/stepper.title')" :description="__('docs/stepper.description')" schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => 'Components', 'url' => '/docs'],
        ['name' => __('docs/stepper.title'), 'url' => '/docs/stepper']
    ]" />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">

        {{-- Main Documentation Content --}}
        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            {{-- Component Header --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <vibe:badge variant="secondary" class="rounded-full">{{ __('docs/stepper.badge') }}</vibe:badge>
                    <span class="text-xs text-muted-foreground">{{ __('docs/stepper.group') }}</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">{{ __('docs/stepper.title') }}</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    {{ __('docs/stepper.description') }}
                </p>

                {{-- Quick Props Strip --}}
                <div class="flex flex-wrap items-center gap-1.5 pt-1">
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">default / value</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">:linear="true"</vibe:badge>
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">orientation="horizontal / vertical"</vibe:badge>
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">variant="default / cards / dots / progress / pill"</vibe:badge>
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">size="sm / md / lg"</vibe:badge>
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">wire:model</vibe:badge>
                </div>
            </div>

            {{-- 1. Basic Usage: Multi-step Account Registration --}}
            <section id="penggunaan-dasar" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/stepper.basic.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/stepper.basic.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/stepper.basic.preview_title')">
                    <vibe:preview.code>
                        <vibe:stepper :default="1">
                            <vibe:stepper.header>
                                <vibe:stepper.step step="1" title="Account Details" description="Setup your credentials" />
                                <vibe:stepper.step step="2" title="Workspace Setup" description="Configure organization" />
                                <vibe:stepper.step step="3" title="Review & Confirm" description="Verify your details" />
                            </vibe:stepper.header>

                            <vibe:stepper.panels>
                                <vibe:stepper.panel step="1">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 p-4 rounded-xl border border-border bg-card/50">
                                        <vibe:input label="Full Name" placeholder="e.g. Budi Santoso" />
                                        <vibe:input type="email" label="Email Address" placeholder="budi@teknovate.id" />
                                    </div>
                                </vibe:stepper.panel>

                                <vibe:stepper.panel step="2">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 p-4 rounded-xl border border-border bg-card/50">
                                        <vibe:input label="Cafe / Workspace Name" placeholder="Teknovate Roastery" />
                                        <vibe:input label="Branch Location" placeholder="Jakarta Selatan" />
                                    </div>
                                </vibe:stepper.panel>

                                <vibe:stepper.panel step="3">
                                    <div class="p-4 rounded-xl border border-border bg-card/50 space-y-2">
                                        <p class="text-sm font-medium text-foreground">Ready to launch your workspace!</p>
                                        <p class="text-xs text-muted-foreground">All configurations are valid. Click Finish below to complete onboarding.</p>
                                    </div>
                                </vibe:stepper.panel>
                            </vibe:stepper.panels>

                            <vibe:stepper.actions>
                                <vibe:stepper.previous />
                                <div class="flex items-center gap-2">
                                    <vibe:stepper.next :hide-on-last="true" />
                                    <vibe:stepper.finish />
                                </div>
                            </vibe:stepper.actions>
                        </vibe:stepper>
                    </vibe:preview.code>

                    <div class="w-full p-2 sm:p-4">
                        <vibe:stepper :default="1">
                            <vibe:stepper.header>
                                <vibe:stepper.step step="1" title="Account Details" description="Setup your credentials" />
                                <vibe:stepper.step step="2" title="Workspace Setup" description="Configure organization" />
                                <vibe:stepper.step step="3" title="Review & Confirm" description="Verify your details" />
                            </vibe:stepper.header>

                            <vibe:stepper.panels>
                                <vibe:stepper.panel step="1">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 p-4 rounded-xl border border-border bg-card/50">
                                        <vibe:input label="Full Name" placeholder="e.g. Budi Santoso" />
                                        <vibe:input type="email" label="Email Address" placeholder="budi@teknovate.id" />
                                    </div>
                                </vibe:stepper.panel>

                                <vibe:stepper.panel step="2">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 p-4 rounded-xl border border-border bg-card/50">
                                        <vibe:input label="Cafe / Workspace Name" placeholder="Teknovate Roastery" />
                                        <vibe:input label="Branch Location" placeholder="Jakarta Selatan" />
                                    </div>
                                </vibe:stepper.panel>

                                <vibe:stepper.panel step="3">
                                    <div class="p-4 rounded-xl border border-border bg-card/50 space-y-2">
                                        <p class="text-sm font-medium text-foreground">Ready to launch your workspace!</p>
                                        <p class="text-xs text-muted-foreground">All configurations are valid. Click Finish below to complete onboarding.</p>
                                    </div>
                                </vibe:stepper.panel>
                            </vibe:stepper.panels>

                            <vibe:stepper.actions>
                                <vibe:stepper.previous />
                                <div class="flex items-center gap-2">
                                    <vibe:stepper.next :hide-on-last="true" />
                                    <vibe:stepper.finish />
                                </div>
                            </vibe:stepper.actions>
                        </vibe:stepper>
                    </div>
                </vibe:preview>
            </section>

            {{-- 2. Interactive Form Wizard: E-Commerce Checkout --}}
            <section id="form-wizard" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/stepper.wizard.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/stepper.wizard.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/stepper.wizard.preview_title')">
                    <vibe:preview.code>
                        <vibe:stepper :default="1">
                            <vibe:stepper.header>
                                <vibe:stepper.step step="1" title="{{ __('docs/stepper.wizard.step1_title') }}" description="{{ __('docs/stepper.wizard.step1_desc') }}" />
                                <vibe:stepper.step step="2" title="{{ __('docs/stepper.wizard.step2_title') }}" description="{{ __('docs/stepper.wizard.step2_desc') }}" />
                                <vibe:stepper.step step="3" title="{{ __('docs/stepper.wizard.step3_title') }}" description="{{ __('docs/stepper.wizard.step3_desc') }}" />
                                <vibe:stepper.step step="4" title="{{ __('docs/stepper.wizard.step4_title') }}" description="{{ __('docs/stepper.wizard.step4_desc') }}" />
                            </vibe:stepper.header>

                            <vibe:stepper.panels>
                                {{-- Step 1: Cart Items --}}
                                <vibe:stepper.panel step="1">
                                    <div class="p-6 rounded-2xl border border-border/80 bg-card space-y-4">
                                        <div class="flex items-center justify-between p-4 rounded-xl border border-border/60 bg-muted/20">
                                            <div class="flex items-center gap-3">
                                                <div class="size-12 rounded-lg bg-primary/10 border border-primary/20 flex items-center justify-center font-bold text-primary">
                                                    💻
                                                </div>
                                                <div>
                                                    <h4 class="text-sm font-semibold text-foreground">{{ __('docs/stepper.wizard.product_name') }}</h4>
                                                    <span class="text-xs text-muted-foreground">Qty: 1 Unit &bull; Garansi Resmi iBox 1 Tahun</span>
                                                </div>
                                            </div>
                                            <span class="text-base font-bold text-primary">{{ __('docs/stepper.wizard.product_price') }}</span>
                                        </div>
                                    </div>
                                </vibe:stepper.panel>

                                {{-- Step 2: Shipping Address --}}
                                <vibe:stepper.panel step="2">
                                    <div class="p-6 rounded-2xl border border-border/80 bg-card space-y-4">
                                        <vibe:input label="{{ __('docs/stepper.wizard.shipping_name_label') }}" placeholder="{{ __('docs/stepper.wizard.shipping_name_placeholder') }}" />
                                        <vibe:textarea label="{{ __('docs/stepper.wizard.shipping_address_label') }}" placeholder="{{ __('docs/stepper.wizard.shipping_address_placeholder') }}" rows="3" />
                                    </div>
                                </vibe:stepper.panel>

                                {{-- Step 3: Payment --}}
                                <vibe:stepper.panel step="3">
                                    <div class="p-6 rounded-2xl border border-border/80 bg-card space-y-3">
                                        <span class="text-sm font-semibold text-foreground">Pilih Metode Pembayaran:</span>
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                            <div class="p-4 rounded-xl border border-primary bg-primary/5 flex items-start gap-3 cursor-pointer">
                                                <div class="size-4 rounded-full border-2 border-primary mt-0.5 flex items-center justify-center">
                                                    <div class="size-2 rounded-full bg-primary"></div>
                                                </div>
                                                <div>
                                                    <div class="text-sm font-semibold text-foreground">{{ __('docs/stepper.wizard.payment_va_title') }}</div>
                                                    <div class="text-xs text-muted-foreground">{{ __('docs/stepper.wizard.payment_va_desc') }}</div>
                                                </div>
                                            </div>
                                            <div class="p-4 rounded-xl border border-border bg-card hover:bg-muted/30 flex items-start gap-3 cursor-pointer">
                                                <div class="size-4 rounded-full border border-muted-foreground mt-0.5"></div>
                                                <div>
                                                    <div class="text-sm font-semibold text-foreground">{{ __('docs/stepper.wizard.payment_qris_title') }}</div>
                                                    <div class="text-xs text-muted-foreground">{{ __('docs/stepper.wizard.payment_qris_desc') }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </vibe:stepper.panel>

                                {{-- Step 4: Success Receipt --}}
                                <vibe:stepper.panel step="4">
                                    <div class="p-6 rounded-2xl border border-emerald-500/30 bg-emerald-500/5 text-emerald-900 dark:text-emerald-300 space-y-2">
                                        <div class="size-10 rounded-full bg-emerald-500/20 text-emerald-600 dark:text-emerald-400 flex items-center justify-center font-bold">✓</div>
                                        <h4 class="font-semibold text-base">{{ __('docs/stepper.wizard.order_success_title') }}</h4>
                                        <p class="text-xs opacity-90 leading-relaxed">{{ __('docs/stepper.wizard.order_success_desc') }}</p>
                                    </div>
                                </vibe:stepper.panel>
                            </vibe:stepper.panels>

                            <vibe:stepper.actions>
                                <vibe:stepper.previous />
                                <div class="flex items-center gap-2">
                                    <vibe:stepper.next :hide-on-last="true" />
                                    <vibe:stepper.finish variant="primary" />
                                </div>
                            </vibe:stepper.actions>
                        </vibe:stepper>
                    </vibe:preview.code>

                    <div class="w-full p-2 sm:p-4">
                        <vibe:stepper :default="1">
                            <vibe:stepper.header>
                                <vibe:stepper.step step="1" title="{{ __('docs/stepper.wizard.step1_title') }}" description="{{ __('docs/stepper.wizard.step1_desc') }}" />
                                <vibe:stepper.step step="2" title="{{ __('docs/stepper.wizard.step2_title') }}" description="{{ __('docs/stepper.wizard.step2_desc') }}" />
                                <vibe:stepper.step step="3" title="{{ __('docs/stepper.wizard.step3_title') }}" description="{{ __('docs/stepper.wizard.step3_desc') }}" />
                                <vibe:stepper.step step="4" title="{{ __('docs/stepper.wizard.step4_title') }}" description="{{ __('docs/stepper.wizard.step4_desc') }}" />
                            </vibe:stepper.header>

                            <vibe:stepper.panels>
                                <vibe:stepper.panel step="1">
                                    <div class="p-6 rounded-2xl border border-border/80 bg-card space-y-4">
                                        <div class="flex items-center justify-between p-4 rounded-xl border border-border/60 bg-muted/20">
                                            <div class="flex items-center gap-3">
                                                <div class="size-12 rounded-lg bg-primary/10 border border-primary/20 flex items-center justify-center font-bold text-primary">
                                                    💻
                                                </div>
                                                <div>
                                                    <h4 class="text-sm font-semibold text-foreground">{{ __('docs/stepper.wizard.product_name') }}</h4>
                                                    <span class="text-xs text-muted-foreground">Qty: 1 Unit &bull; Garansi Resmi iBox 1 Tahun</span>
                                                </div>
                                            </div>
                                            <span class="text-base font-bold text-primary">{{ __('docs/stepper.wizard.product_price') }}</span>
                                        </div>
                                    </div>
                                </vibe:stepper.panel>

                                <vibe:stepper.panel step="2">
                                    <div class="p-6 rounded-2xl border border-border/80 bg-card space-y-4">
                                        <vibe:input label="{{ __('docs/stepper.wizard.shipping_name_label') }}" placeholder="{{ __('docs/stepper.wizard.shipping_name_placeholder') }}" />
                                        <vibe:textarea label="{{ __('docs/stepper.wizard.shipping_address_label') }}" placeholder="{{ __('docs/stepper.wizard.shipping_address_placeholder') }}" rows="3" />
                                    </div>
                                </vibe:stepper.panel>

                                <vibe:stepper.panel step="3">
                                    <div class="p-6 rounded-2xl border border-border/80 bg-card space-y-3">
                                        <span class="text-sm font-semibold text-foreground">Pilih Metode Pembayaran:</span>
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                            <div class="p-4 rounded-xl border border-primary bg-primary/5 flex items-start gap-3 cursor-pointer">
                                                <div class="size-4 rounded-full border-2 border-primary mt-0.5 flex items-center justify-center">
                                                    <div class="size-2 rounded-full bg-primary"></div>
                                                </div>
                                                <div>
                                                    <div class="text-sm font-semibold text-foreground">{{ __('docs/stepper.wizard.payment_va_title') }}</div>
                                                    <div class="text-xs text-muted-foreground">{{ __('docs/stepper.wizard.payment_va_desc') }}</div>
                                                </div>
                                            </div>
                                            <div class="p-4 rounded-xl border border-border bg-card hover:bg-muted/30 flex items-start gap-3 cursor-pointer">
                                                <div class="size-4 rounded-full border border-muted-foreground mt-0.5"></div>
                                                <div>
                                                    <div class="text-sm font-semibold text-foreground">{{ __('docs/stepper.wizard.payment_qris_title') }}</div>
                                                    <div class="text-xs text-muted-foreground">{{ __('docs/stepper.wizard.payment_qris_desc') }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </vibe:stepper.panel>

                                <vibe:stepper.panel step="4">
                                    <div class="p-6 rounded-2xl border border-emerald-500/30 bg-emerald-500/5 text-emerald-900 dark:text-emerald-300 space-y-2">
                                        <div class="size-10 rounded-full bg-emerald-500/20 text-emerald-600 dark:text-emerald-400 flex items-center justify-center font-bold">✓</div>
                                        <h4 class="font-semibold text-base">{{ __('docs/stepper.wizard.order_success_title') }}</h4>
                                        <p class="text-xs opacity-90 leading-relaxed">{{ __('docs/stepper.wizard.order_success_desc') }}</p>
                                    </div>
                                </vibe:stepper.panel>
                            </vibe:stepper.panels>

                            <vibe:stepper.actions>
                                <vibe:stepper.previous />
                                <div class="flex items-center gap-2">
                                    <vibe:stepper.next :hide-on-last="true" />
                                    <vibe:stepper.finish variant="primary" />
                                </div>
                            </vibe:stepper.actions>
                        </vibe:stepper>
                    </div>
                </vibe:preview>
            </section>

            {{-- 3. Vertical Orientation: Live Package Delivery Tracking --}}
            <section id="orientasi-vertikal" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/stepper.vertical.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/stepper.vertical.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/stepper.vertical.preview_title')">
                    <vibe:preview.code>
                        <div class="max-w-xl mx-auto w-full">
                            <vibe:stepper orientation="vertical" :default="3">
                                <vibe:stepper.header>
                                    <vibe:stepper.step
                                        step="1"
                                        title="Order Confirmed & Paid"
                                        description="10:15 WIB — Invoice #INV-2026-0891 has been verified automatically."
                                    />
                                    <vibe:stepper.step
                                        step="2"
                                        title="Prepared at Roastery Warehouse"
                                        description="11:30 WIB — Arabica House Blend (5kg) packed and quality-checked."
                                    />
                                    <vibe:stepper.step
                                        step="3"
                                        title="In Transit with Instant Courier"
                                        description="13:05 WIB — Driver (Ahmad) is heading to your cafe location."
                                    />
                                    <vibe:stepper.step
                                        step="4"
                                        title="Arrived at Destination"
                                        description="Estimated arrival at 14:00 WIB — Waiting for store manager receipt."
                                    />
                                </vibe:stepper.header>

                                <vibe:stepper.actions>
                                    <vibe:stepper.previous size="sm">Previous Status</vibe:stepper.previous>
                                    <vibe:stepper.next size="sm" :hide-on-last="true">Advance Status</vibe:stepper.next>
                                    <vibe:stepper.finish size="sm">Mark Delivered</vibe:stepper.finish>
                                </vibe:stepper.actions>
                            </vibe:stepper>
                        </div>
                    </vibe:preview.code>

                    <div class="w-full max-w-xl mx-auto p-2 sm:p-4">
                        <vibe:stepper orientation="vertical" :default="3">
                            <vibe:stepper.header>
                                <vibe:stepper.step
                                    step="1"
                                    title="Order Confirmed & Paid"
                                    description="10:15 WIB — Invoice #INV-2026-0891 has been verified automatically."
                                />
                                <vibe:stepper.step
                                    step="2"
                                    title="Prepared at Roastery Warehouse"
                                    description="11:30 WIB — Arabica House Blend (5kg) packed and quality-checked."
                                />
                                <vibe:stepper.step
                                    step="3"
                                    title="In Transit with Instant Courier"
                                    description="13:05 WIB — Driver (Ahmad) is heading to your cafe location."
                                />
                                <vibe:stepper.step
                                    step="4"
                                    title="Arrived at Destination"
                                    description="Estimated arrival at 14:00 WIB — Waiting for store manager receipt."
                                />
                            </vibe:stepper.header>

                            <vibe:stepper.actions>
                                <vibe:stepper.previous size="sm">Previous Status</vibe:stepper.previous>
                                <vibe:stepper.next size="sm" :hide-on-last="true">Advance Status</vibe:stepper.next>
                                <vibe:stepper.finish size="sm">Mark Delivered</vibe:stepper.finish>
                            </vibe:stepper.actions>
                        </vibe:stepper>
                    </div>
                </vibe:preview>
            </section>

            {{-- 4. Visual Variants (Dots, Progress, Cards, Pill) --}}
            <section id="varian-visual" class="space-y-8">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/stepper.variants.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/stepper.variants.desc') !!}
                    </p>
                </div>

                {{-- A. Cards Variant: Cloud Server Hosting --}}
                <div class="space-y-3">
                    <div class="space-y-1">
                        <h3 class="text-base font-semibold text-foreground">{{ __('docs/stepper.variants.cards_title') }}</h3>
                        <p class="text-xs text-muted-foreground">{{ __('docs/stepper.variants.cards_desc') }}</p>
                    </div>
                    <vibe:preview>
                        <vibe:preview.code>
                            <vibe:stepper variant="cards" :default="2">
                                <vibe:stepper.header>
                                    <vibe:stepper.step step="1" title="Starter Tier" description="1 vCPU, 2 GB RAM, 40 GB NVMe — $0 / Free" />
                                    <vibe:stepper.step step="2" title="Business Pro" description="4 vCPU, 8 GB RAM, 120 GB NVMe — $29 / mo" />
                                    <vibe:stepper.step step="3" title="Enterprise Cloud" description="8 vCPU, 16 GB RAM, 300 GB NVMe — $79 / mo" />
                                </vibe:stepper.header>

                                <vibe:stepper.panels>
                                    <vibe:stepper.panel step="1">
                                        <div class="p-4 rounded-xl border border-border/80 bg-card/60 text-xs text-muted-foreground">
                                            Starter Tier configuration: Shared CPU, best for lightweight testing, staging, and static sites.
                                        </div>
                                    </vibe:stepper.panel>
                                    <vibe:stepper.panel step="2">
                                        <div class="p-4 rounded-xl border border-primary/20 bg-primary/5 text-xs text-foreground">
                                            Business Pro configuration: Dedicated vCPU, automated daily snapshot, 99.99% uptime SLA.
                                        </div>
                                    </vibe:stepper.panel>
                                    <vibe:stepper.panel step="3">
                                        <div class="p-4 rounded-xl border border-border/80 bg-card/60 text-xs text-muted-foreground">
                                            Enterprise Cloud: AMD EPYC 9004 dedicated hardware, priority 24/7 SRE engineering support.
                                        </div>
                                    </vibe:stepper.panel>
                                </vibe:stepper.panels>

                                <vibe:stepper.actions>
                                    <vibe:stepper.previous size="sm" />
                                    <vibe:stepper.next size="sm" :hide-on-last="true" />
                                    <vibe:stepper.finish size="sm" />
                                </vibe:stepper.actions>
                            </vibe:stepper>
                        </vibe:preview.code>

                        <div class="w-full p-2 sm:p-4">
                            <vibe:stepper variant="cards" :default="2">
                                <vibe:stepper.header>
                                    <vibe:stepper.step step="1" title="Starter Tier" description="1 vCPU, 2 GB RAM, 40 GB NVMe — $0 / Free" />
                                    <vibe:stepper.step step="2" title="Business Pro" description="4 vCPU, 8 GB RAM, 120 GB NVMe — $29 / mo" />
                                    <vibe:stepper.step step="3" title="Enterprise Cloud" description="8 vCPU, 16 GB RAM, 300 GB NVMe — $79 / mo" />
                                </vibe:stepper.header>

                                <vibe:stepper.panels>
                                    <vibe:stepper.panel step="1">
                                        <div class="p-4 rounded-xl border border-border/80 bg-card/60 text-xs text-muted-foreground">
                                            Starter Tier configuration: Shared CPU, best for lightweight testing, staging, and static sites.
                                        </div>
                                    </vibe:stepper.panel>
                                    <vibe:stepper.panel step="2">
                                        <div class="p-4 rounded-xl border border-primary/20 bg-primary/5 text-xs text-foreground">
                                            Business Pro configuration: Dedicated vCPU, automated daily snapshot, 99.99% uptime SLA.
                                        </div>
                                    </vibe:stepper.panel>
                                    <vibe:stepper.panel step="3">
                                        <div class="p-4 rounded-xl border border-border/80 bg-card/60 text-xs text-muted-foreground">
                                            Enterprise Cloud: AMD EPYC 9004 dedicated hardware, priority 24/7 SRE engineering support.
                                        </div>
                                    </vibe:stepper.panel>
                                </vibe:stepper.panels>

                                <vibe:stepper.actions>
                                    <vibe:stepper.previous size="sm" />
                                    <vibe:stepper.next size="sm" :hide-on-last="true" />
                                    <vibe:stepper.finish size="sm" />
                                </vibe:stepper.actions>
                            </vibe:stepper>
                        </div>
                    </vibe:preview>
                </div>

                {{-- B. Dots Variant: Web Server Setup Wizard --}}
                <div class="space-y-3">
                    <div class="space-y-1">
                        <h3 class="text-base font-semibold text-foreground">{{ __('docs/stepper.variants.dots_title') }}</h3>
                        <p class="text-xs text-muted-foreground">{{ __('docs/stepper.variants.dots_desc') }}</p>
                    </div>
                    <vibe:preview>
                        <vibe:preview.code>
                            <vibe:stepper variant="dots" :default="2">
                                <vibe:stepper.header>
                                    <vibe:stepper.step step="1" title="Cek Sistem" description="PHP 8.3 & Modul" />
                                    <vibe:stepper.step step="2" title="Basis Data" description="MySQL / PostgreSQL" />
                                    <vibe:stepper.step step="3" title="Akun Admin" description="Superuser Email" />
                                    <vibe:stepper.step step="4" title="Selesai" description="Dashboard Siap" />
                                </vibe:stepper.header>

                                <vibe:stepper.panels>
                                    <vibe:stepper.panel step="1">
                                        <div class="p-4 rounded-xl border border-border/80 bg-card text-xs text-muted-foreground">
                                            Semua ekstensi PHP wajib (PDO, cURL, OpenSSL, Mbstring) telah terpenuhi dan siap digunakan.
                                        </div>
                                    </vibe:stepper.panel>
                                    <vibe:stepper.panel step="2">
                                        <div class="p-4 rounded-xl border border-border/80 bg-card space-y-3">
                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                                <vibe:input label="Host Database" value="127.0.0.1" />
                                                <vibe:input label="Nama Database" value="vibe_production" />
                                            </div>
                                        </div>
                                    </vibe:stepper.panel>
                                    <vibe:stepper.panel step="3">
                                        <div class="p-4 rounded-xl border border-border/80 bg-card space-y-3">
                                            <vibe:input label="Email Superadministrator" placeholder="admin@domain.com" />
                                        </div>
                                    </vibe:stepper.panel>
                                    <vibe:stepper.panel step="4">
                                        <div class="p-4 rounded-xl border border-emerald-500/20 bg-emerald-500/5 text-xs text-emerald-800 dark:text-emerald-300 font-medium">
                                            Sistem berhasil diinstal! Anda dapat langsung masuk ke panel administrasi.
                                        </div>
                                    </vibe:stepper.panel>
                                </vibe:stepper.panels>

                                <vibe:stepper.actions>
                                    <vibe:stepper.previous size="sm" />
                                    <vibe:stepper.next size="sm" :hide-on-last="true" />
                                    <vibe:stepper.finish size="sm" />
                                </vibe:stepper.actions>
                            </vibe:stepper>
                        </vibe:preview.code>

                        <div class="w-full p-2 sm:p-4">
                            <vibe:stepper variant="dots" :default="2">
                                <vibe:stepper.header>
                                    <vibe:stepper.step step="1" title="Cek Sistem" description="PHP 8.3 & Modul" />
                                    <vibe:stepper.step step="2" title="Basis Data" description="MySQL / PostgreSQL" />
                                    <vibe:stepper.step step="3" title="Akun Admin" description="Superuser Email" />
                                    <vibe:stepper.step step="4" title="Selesai" description="Dashboard Siap" />
                                </vibe:stepper.header>

                                <vibe:stepper.panels>
                                    <vibe:stepper.panel step="1">
                                        <div class="p-4 rounded-xl border border-border/80 bg-card text-xs text-muted-foreground">
                                            Semua ekstensi PHP wajib (PDO, cURL, OpenSSL, Mbstring) telah terpenuhi dan siap digunakan.
                                        </div>
                                    </vibe:stepper.panel>
                                    <vibe:stepper.panel step="2">
                                        <div class="p-4 rounded-xl border border-border/80 bg-card space-y-3">
                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                                <vibe:input label="Host Database" value="127.0.0.1" />
                                                <vibe:input label="Nama Database" value="vibe_production" />
                                            </div>
                                        </div>
                                    </vibe:stepper.panel>
                                    <vibe:stepper.panel step="3">
                                        <div class="p-4 rounded-xl border border-border/80 bg-card space-y-3">
                                            <vibe:input label="Email Superadministrator" placeholder="admin@domain.com" />
                                        </div>
                                    </vibe:stepper.panel>
                                    <vibe:stepper.panel step="4">
                                        <div class="p-4 rounded-xl border border-emerald-500/20 bg-emerald-500/5 text-xs text-emerald-800 dark:text-emerald-300 font-medium">
                                            Sistem berhasil diinstal! Anda dapat langsung masuk ke panel administrasi.
                                        </div>
                                    </vibe:stepper.panel>
                                </vibe:stepper.panels>

                                <vibe:stepper.actions>
                                    <vibe:stepper.previous size="sm" />
                                    <vibe:stepper.next size="sm" :hide-on-last="true" />
                                    <vibe:stepper.finish size="sm" />
                                </vibe:stepper.actions>
                            </vibe:stepper>
                        </div>
                    </vibe:preview>
                </div>

                {{-- C. Progress Bar: Customer Survey --}}
                <div class="space-y-3">
                    <div class="space-y-1">
                        <h3 class="text-base font-semibold text-foreground">{{ __('docs/stepper.variants.progress_title') }}</h3>
                        <p class="text-xs text-muted-foreground">{{ __('docs/stepper.variants.progress_desc') }}</p>
                    </div>
                    <vibe:preview>
                        <vibe:preview.code>
                            <vibe:stepper variant="progress" :default="2">
                                <vibe:stepper.header>
                                    <vibe:stepper.step step="1" title="1. Kemudahan Layanan" description="Navigasi pesanan" />
                                    <vibe:stepper.step step="2" title="2. Kecepatan Solusi" description="Waktu respon tim" />
                                    <vibe:stepper.step step="3" title="3. Ulasan & Masukan" description="Rekomendasi NPS" />
                                </vibe:stepper.header>

                                <vibe:stepper.panels>
                                    <vibe:stepper.panel step="1">
                                        <div class="p-5 rounded-2xl border border-border/80 bg-card space-y-3">
                                            <p class="text-sm font-medium text-foreground">Bagaimana kemudahan memesan layanan di platform kami?</p>
                                            <div class="flex flex-wrap gap-2">
                                                <vibe:button size="sm" variant="outline">Sangat Sulit</vibe:button>
                                                <vibe:button size="sm" variant="outline">Cukup</vibe:button>
                                                <vibe:button size="sm" variant="primary">Sangat Mudah</vibe:button>
                                            </div>
                                        </div>
                                    </vibe:stepper.panel>
                                    <vibe:stepper.panel step="2">
                                        <div class="p-5 rounded-2xl border border-border/80 bg-card space-y-3">
                                            <p class="text-sm font-medium text-foreground">Berapa skor kepuasan Anda terhadap kecepatan tanggapan staf kami?</p>
                                            <div class="flex flex-wrap gap-2">
                                                <vibe:button size="sm" variant="outline">Kurang</vibe:button>
                                                <vibe:button size="sm" variant="outline">Baik</vibe:button>
                                                <vibe:button size="sm" variant="primary">Sangat Memuaskan</vibe:button>
                                            </div>
                                        </div>
                                    </vibe:stepper.panel>
                                    <vibe:stepper.panel step="3">
                                        <div class="p-5 rounded-2xl border border-border/80 bg-card space-y-3">
                                            <p class="text-sm font-medium text-foreground">Tuliskan saran tambahan untuk peningkatan fitur kami:</p>
                                            <vibe:textarea placeholder="Ketik saran atau masukan Anda di sini..." rows="3" />
                                        </div>
                                    </vibe:stepper.panel>
                                </vibe:stepper.panels>

                                <vibe:stepper.actions>
                                    <vibe:stepper.previous size="sm" />
                                    <vibe:stepper.next size="sm" :hide-on-last="true" />
                                    <vibe:stepper.finish size="sm" variant="primary" />
                                </vibe:stepper.actions>
                            </vibe:stepper>
                        </vibe:preview.code>

                        <div class="w-full p-2 sm:p-4">
                            <vibe:stepper variant="progress" :default="2">
                                <vibe:stepper.header>
                                    <vibe:stepper.step step="1" title="1. Kemudahan Layanan" description="Navigasi pesanan" />
                                    <vibe:stepper.step step="2" title="2. Kecepatan Solusi" description="Waktu respon tim" />
                                    <vibe:stepper.step step="3" title="3. Ulasan & Masukan" description="Rekomendasi NPS" />
                                </vibe:stepper.header>

                                <vibe:stepper.panels>
                                    <vibe:stepper.panel step="1">
                                        <div class="p-5 rounded-2xl border border-border/80 bg-card space-y-3">
                                            <p class="text-sm font-medium text-foreground">Bagaimana kemudahan memesan layanan di platform kami?</p>
                                            <div class="flex flex-wrap gap-2">
                                                <vibe:button size="sm" variant="outline">Sangat Sulit</vibe:button>
                                                <vibe:button size="sm" variant="outline">Cukup</vibe:button>
                                                <vibe:button size="sm" variant="primary">Sangat Mudah</vibe:button>
                                            </div>
                                        </div>
                                    </vibe:stepper.panel>
                                    <vibe:stepper.panel step="2">
                                        <div class="p-5 rounded-2xl border border-border/80 bg-card space-y-3">
                                            <p class="text-sm font-medium text-foreground">Berapa skor kepuasan Anda terhadap kecepatan tanggapan staf kami?</p>
                                            <div class="flex flex-wrap gap-2">
                                                <vibe:button size="sm" variant="outline">Kurang</vibe:button>
                                                <vibe:button size="sm" variant="outline">Baik</vibe:button>
                                                <vibe:button size="sm" variant="primary">Sangat Memuaskan</vibe:button>
                                            </div>
                                        </div>
                                    </vibe:stepper.panel>
                                    <vibe:stepper.panel step="3">
                                        <div class="p-5 rounded-2xl border border-border/80 bg-card space-y-3">
                                            <p class="text-sm font-medium text-foreground">Tuliskan saran tambahan untuk peningkatan fitur kami:</p>
                                            <vibe:textarea placeholder="Ketik saran atau masukan Anda di sini..." rows="3" />
                                        </div>
                                    </vibe:stepper.panel>
                                </vibe:stepper.panels>

                                <vibe:stepper.actions>
                                    <vibe:stepper.previous size="sm" />
                                    <vibe:stepper.next size="sm" :hide-on-last="true" />
                                    <vibe:stepper.finish size="sm" variant="primary" />
                                </vibe:stepper.actions>
                            </vibe:stepper>
                        </div>
                    </vibe:preview>
                </div>

                {{-- D. Pill Variant: Editorial Workflow --}}
                <div class="space-y-3">
                    <div class="space-y-1">
                        <h3 class="text-base font-semibold text-foreground">{{ __('docs/stepper.variants.pill_title') }}</h3>
                        <p class="text-xs text-muted-foreground">{{ __('docs/stepper.variants.pill_desc') }}</p>
                    </div>
                    <vibe:preview>
                        <vibe:preview.code>
                            <vibe:stepper variant="pill" :default="2">
                                <vibe:stepper.header>
                                    <vibe:stepper.step step="1" title="Setup" />
                                    <vibe:stepper.step step="2" title="Database" />
                                    <vibe:stepper.step step="3" title="Admin" />
                                    <vibe:stepper.step step="4" title="Launch" />
                                </vibe:stepper.header>

                                <vibe:stepper.panels>
                                    <vibe:stepper.panel step="1">
                                        <div class="p-4 rounded-xl border border-border/80 bg-card text-xs text-muted-foreground">
                                            Initial workspace parameters and directory permissions verified.
                                        </div>
                                    </vibe:stepper.panel>
                                    <vibe:stepper.panel step="2">
                                        <div class="p-4 rounded-xl border border-primary/20 bg-primary/5 text-xs text-foreground space-y-1.5">
                                            <p class="font-semibold">Database Connection: In Progress</p>
                                            <p class="text-muted-foreground">Executing database migrations and seeding initial system configurations.</p>
                                        </div>
                                    </vibe:stepper.panel>
                                    <vibe:stepper.panel step="3">
                                        <div class="p-4 rounded-xl border border-border/80 bg-card text-xs text-muted-foreground">
                                            Setup primary administrator credentials and two-factor authentication.
                                        </div>
                                    </vibe:stepper.panel>
                                    <vibe:stepper.panel step="4">
                                        <div class="p-4 rounded-xl border border-border/80 bg-card text-xs text-muted-foreground">
                                            Production deployment checklist and live status check.
                                        </div>
                                    </vibe:stepper.panel>
                                </vibe:stepper.panels>

                                <vibe:stepper.actions>
                                    <vibe:stepper.previous size="sm" />
                                    <vibe:stepper.next size="sm" :hide-on-last="true" />
                                    <vibe:stepper.finish size="sm" variant="primary" />
                                </vibe:stepper.actions>
                            </vibe:stepper>
                        </vibe:preview.code>

                        <div class="w-full p-2 sm:p-4">
                            <vibe:stepper variant="pill" :default="2">
                                <vibe:stepper.header>
                                    <vibe:stepper.step step="1" title="Setup" />
                                    <vibe:stepper.step step="2" title="Database" />
                                    <vibe:stepper.step step="3" title="Admin" />
                                    <vibe:stepper.step step="4" title="Launch" />
                                </vibe:stepper.header>

                                <vibe:stepper.panels>
                                    <vibe:stepper.panel step="1">
                                        <div class="p-4 rounded-xl border border-border/80 bg-card text-xs text-muted-foreground">
                                            Initial workspace parameters and directory permissions verified.
                                        </div>
                                    </vibe:stepper.panel>
                                    <vibe:stepper.panel step="2">
                                        <div class="p-4 rounded-xl border border-primary/20 bg-primary/5 text-xs text-foreground space-y-1.5">
                                            <p class="font-semibold">Database Connection: In Progress</p>
                                            <p class="text-muted-foreground">Executing database migrations and seeding initial system configurations.</p>
                                        </div>
                                    </vibe:stepper.panel>
                                    <vibe:stepper.panel step="3">
                                        <div class="p-4 rounded-xl border border-border/80 bg-card text-xs text-muted-foreground">
                                            Setup primary administrator credentials and two-factor authentication.
                                        </div>
                                    </vibe:stepper.panel>
                                    <vibe:stepper.panel step="4">
                                        <div class="p-4 rounded-xl border border-border/80 bg-card text-xs text-muted-foreground">
                                            Production deployment checklist and live status check.
                                        </div>
                                    </vibe:stepper.panel>
                                </vibe:stepper.panels>

                                <vibe:stepper.actions>
                                    <vibe:stepper.previous size="sm" />
                                    <vibe:stepper.next size="sm" :hide-on-last="true" />
                                    <vibe:stepper.finish size="sm" variant="primary" />
                                </vibe:stepper.actions>
                            </vibe:stepper>
                        </div>
                    </vibe:preview>
                </div>
            </section>

            {{-- 5. Status & Validation Error Handling (KYC Identity Verification) --}}
            <section id="status-error" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/stepper.status.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/stepper.status.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/stepper.status.preview_title')">
                    <vibe:preview.code>
                        <vibe:stepper :default="2" :linear="true">
                            <vibe:stepper.header>
                                <vibe:stepper.step step="1" title="Personal Info" description="Verified identity" />
                                <vibe:stepper.step step="2" title="Document Upload" description="ID card blurry / expired" :error="true" />
                                <vibe:stepper.step step="3" title="Bank Settlement" description="Payout account" />
                            </vibe:stepper.header>

                            <vibe:stepper.panels>
                                <vibe:stepper.panel step="2">
                                    <div class="p-5 rounded-2xl border border-destructive/30 bg-destructive/5 space-y-3">
                                        <div class="flex items-start gap-3">
                                            <div class="size-8 rounded-full bg-destructive/20 text-destructive flex items-center justify-center shrink-0 font-bold">!</div>
                                            <div class="space-y-1">
                                                <h4 class="text-sm font-semibold text-destructive">Identity Verification Failed</h4>
                                                <p class="text-xs text-destructive/90 leading-relaxed">The uploaded KTP/NPWP image could not be verified due to low resolution. Please re-upload a clear photo under 5MB.</p>
                                            </div>
                                        </div>
                                        <div class="pt-1">
                                            <vibe:button variant="destructive" size="sm">Re-Upload Document</vibe:button>
                                        </div>
                                    </div>
                                </vibe:stepper.panel>
                            </vibe:stepper.panels>
                        </vibe:stepper>
                    </vibe:preview.code>

                    <div class="w-full p-2 sm:p-4">
                        <vibe:stepper :default="2" :linear="true">
                            <vibe:stepper.header>
                                <vibe:stepper.step step="1" title="Personal Info" description="Verified identity" />
                                <vibe:stepper.step step="2" title="Document Upload" description="ID card blurry / expired" :error="true" />
                                <vibe:stepper.step step="3" title="Bank Settlement" description="Payout account" />
                            </vibe:stepper.header>

                            <vibe:stepper.panels>
                                <vibe:stepper.panel step="2">
                                    <div class="p-5 rounded-2xl border border-destructive/30 bg-destructive/5 space-y-3">
                                        <div class="flex items-start gap-3">
                                            <div class="size-8 rounded-full bg-destructive/20 text-destructive flex items-center justify-center shrink-0 font-bold">!</div>
                                            <div class="space-y-1">
                                                <h4 class="text-sm font-semibold text-destructive">Identity Verification Failed</h4>
                                                <p class="text-xs text-destructive/90 leading-relaxed">The uploaded KTP/NPWP image could not be verified due to low resolution. Please re-upload a clear photo under 5MB.</p>
                                            </div>
                                        </div>
                                        <div class="pt-1">
                                            <vibe:button variant="destructive" size="sm">Re-Upload Document</vibe:button>
                                        </div>
                                    </div>
                                </vibe:stepper.panel>
                            </vibe:stepper.panels>
                        </vibe:stepper>
                    </div>
                </vibe:preview>
            </section>

            {{-- 6. Props & API Reference --}}
            <section id="referensi-props" class="space-y-6">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/stepper.api.title') }}</h2>
                </div>

                {{-- Root Stepper Props --}}
                <div class="space-y-3">
                    <h3 class="text-base font-semibold text-foreground">&lt;vibe:stepper&gt; Props</h3>
                    <vibe:table>
                        <vibe:table.header>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/stepper.api.col_prop') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/stepper.api.col_type') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/stepper.api.col_default') }}</vibe:table.column>
                            <vibe:table.column>{{ __('docs/stepper.api.col_desc') }}</vibe:table.column>
                        </vibe:table.header>
                        <vibe:table.rows>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">wire:model / step / default</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">int | string</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-primary whitespace-nowrap">1</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">Menentukan langkah aktif awal atau two-way binding dengan property Livewire.</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">linear</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">bool</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-primary whitespace-nowrap">false</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">Mewajibkan pengguna menyelesaikan langkah secara berurutan dan memblokir lompatan jika ada step error.</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">orientation</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">'horizontal' | 'vertical'</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-primary whitespace-nowrap">'horizontal'</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">Mengatur arah tata letak header dan garis konektor stepper.</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">variant</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">'default' | 'dots' | 'progress' | 'cards' | 'pill'</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-primary whitespace-nowrap">'default'</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">Mengatur gaya visual indikator langkah.</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">size</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">'sm' | 'md' | 'lg'</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-primary whitespace-nowrap">'md'</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">Mengatur ukuran indikator lingkaran dan tipografi teks.</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">clickable</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">bool</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-primary whitespace-nowrap">true</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">Mengizinkan pengguna berpindah langkah dengan mengklik indikator header.</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">persist</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">bool</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-primary whitespace-nowrap">false</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">Menyimpan langkah aktif terakhir ke dalam sessionStorage browser.</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">syncUrl</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">bool | string</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-primary whitespace-nowrap">false</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">Menyinkronkan langkah aktif ke query parameter URL (misal: ?step=2).</vibe:table.cell>
                            </vibe:table.row>
                        </vibe:table.rows>
                    </vibe:table>
                </div>

                {{-- Step Props --}}
                <div class="space-y-3 pt-4">
                    <h3 class="text-base font-semibold text-foreground">&lt;vibe:stepper.step&gt; Props</h3>
                    <vibe:table>
                        <vibe:table.header>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/stepper.api.col_prop') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/stepper.api.col_type') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/stepper.api.col_default') }}</vibe:table.column>
                            <vibe:table.column>{{ __('docs/stepper.api.col_desc') }}</vibe:table.column>
                        </vibe:table.header>
                        <vibe:table.rows>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">step / value</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">int | string</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-primary whitespace-nowrap">1</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">Identifier unik untuk langkah tersebut (harus cocok dengan prop step pada &lt;vibe:stepper.panel&gt;).</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">title</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">string</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-primary whitespace-nowrap">null</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">Judul utama langkah.</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">description</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">string</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-primary whitespace-nowrap">null</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">Teks deskripsi pendukung di bawah judul langkah.</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">icon</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">string (HTML/SVG)</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-primary whitespace-nowrap">null</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">Ikon kustom untuk menggantikan angka default pada langkah aktif/upcoming.</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">completedIcon</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">string (HTML/SVG)</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-primary whitespace-nowrap">null</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">Ikon kustom saat langkah telah selesai (completed).</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">error</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">bool</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-primary whitespace-nowrap">false</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">Menandai langkah dengan status validasi gagal (warna destructive & ikon tanda seru).</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">disabled</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">bool</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-primary whitespace-nowrap">false</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">Menonaktifkan langkah agar tidak dapat diakses/diklik.</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">clickable</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">bool | null</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-primary whitespace-nowrap">null</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">Meng-override pengaturan clickable global khusus pada langkah ini.</vibe:table.cell>
                            </vibe:table.row>
                        </vibe:table.rows>
                    </vibe:table>
                </div>

                {{-- Events --}}
                <div class="space-y-3 pt-4">
                    <h3 class="text-base font-semibold text-foreground">Alpine / Browser Events</h3>
                    <vibe:table>
                        <vibe:table.header>
                            <vibe:table.column class="whitespace-nowrap">Event Name</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">Payload ($event.detail)</vibe:table.column>
                            <vibe:table.column>Description</vibe:table.column>
                        </vibe:table.header>
                        <vibe:table.rows>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">vibe-stepper:change</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">{ current, previous, index, total }</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">Dipicu satu kali setiap terjadi perpindahan langkah aktif.</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">vibe-stepper:finish</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">{ current, total }</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">Dipicu saat pengguna menekan &lt;vibe:stepper.finish&gt; atau memanggil next() di langkah terakhir.</vibe:table.cell>
                            </vibe:table.row>
                        </vibe:table.rows>
                    </vibe:table>
                </div>
            </section>

        </div>

        {{-- Table of Contents Sidebar --}}
        <aside class="col-span-12 order-1 md:order-2 md:col-span-3 w-full md:sticky md:top-6 group-has-[header.sticky]/docs:md:top-20">
            <vibe:toc selector="#docs-content" />
        </aside>
    </div>
</x-docs.layouts.sidebar>
