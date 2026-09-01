<x-docs.layouts.sidebar>
    <vibe:seo :title="__('docs/input.title')" :description="__('docs/input.description')" schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => 'Components', 'url' => '/docs'],
        ['name' => __('docs/input.title'), 'url' => '/docs/input']
    ]" />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">

        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-muted text-muted-foreground">{{ __('docs/input.badge') }}</span>
                    <span class="text-xs text-muted-foreground">{{ __('docs/input.group') }}</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">{{ __('docs/input.title') }}</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    {{ __('docs/input.description') }}
                </p>

                {{-- Quick props badge strip --}}
                <div class="flex flex-wrap items-center gap-1.5 pt-1">
                    @foreach (['outline', 'filled', 'flush', 'ghost', 'accent'] as $v)
                        <span class="px-2 py-0.5 rounded-md bg-muted text-muted-foreground text-[11px] font-mono font-medium border border-border">{{ $v }}</span>
                    @endforeach
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    @foreach (['sm', 'md', 'lg', 'xl'] as $s)
                        <span class="px-2 py-0.5 rounded-md bg-muted text-muted-foreground text-[11px] font-mono font-medium border border-border">{{ $s }}</span>
                    @endforeach
                </div>
            </div>

            {{-- 1. Basic Usage --}}
            <section id="penggunaan-dasar" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/input.basic_usage_title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/input.basic_usage_desc') !!}
                    </p>
                </div>

                <vibe:preview title="Basic Input">
                    <vibe:preview.code>
                        @verbatim
                            <vibe:input name="full_name" label="Full Name" placeholder="Enter your full name..." />
                        @endverbatim
                    </vibe:preview.code>
                    <div class="w-full max-w-sm">
                        <vibe:input name="full_name" :label="__('docs/input.basic_input_label')" :placeholder="__('docs/input.basic_input_placeholder')" />
                    </div>
                </vibe:preview>
            </section>

            {{-- 2. Variants --}}
            <section id="varian-tampilan" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/input.variants_title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/input.variants_desc') !!}
                    </p>
                </div>

                <vibe:preview title="Input Variants">
                    <vibe:preview.code>
                        @verbatim
                            {{-- outline (default) --}}
                            <vibe:input variant="outline" label="Outline" placeholder="Default variant..." />

                            {{-- filled --}}
                            <vibe:input variant="filled" label="Filled" placeholder="Solid look..." />

                            {{-- flush --}}
                            <vibe:input variant="flush" label="Flush" placeholder="Bottom line only..." />

                            {{-- ghost --}}
                            <vibe:input variant="ghost" label="Ghost" placeholder="Transparent..." />

                            {{-- accent --}}
                            <vibe:input variant="accent" label="Accent" placeholder="Accent color..." />
                        @endverbatim
                    </vibe:preview.code>
                    <div class="w-full max-w-sm space-y-4">
                        <vibe:input variant="outline" :label="__('docs/input.variant_outline')" placeholder="Default variant..." />
                        <vibe:input variant="filled" :label="__('docs/input.variant_filled')" placeholder="Solid look..." />
                        <vibe:input variant="flush" :label="__('docs/input.variant_flush')" placeholder="Bottom line only..." />
                        <vibe:input variant="ghost" :label="__('docs/input.variant_ghost')" placeholder="Transparent..." />
                        <vibe:input variant="accent" :label="__('docs/input.variant_accent')" placeholder="Accent color..." />
                    </div>
                </vibe:preview>
            </section>

            {{-- 3. Sizes --}}
            <section id="ukuran" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/input.sizes_title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/input.sizes_desc') !!}
                    </p>
                </div>

                <vibe:preview title="Input Sizes">
                    <vibe:preview.code>
                        @verbatim
                            <vibe:input size="sm" label="Small (sm)" placeholder="Height 32px, text-xs..." />
                            <vibe:input size="md" label="Medium (md)" placeholder="Height 36px, text-sm..." />
                            <vibe:input size="lg" label="Large (lg)" placeholder="Height 40px, text-sm..." />
                            <vibe:input size="xl" label="X-Large (xl)" placeholder="Height 44px, text-base..." />
                        @endverbatim
                    </vibe:preview.code>
                    <div class="w-full max-w-sm space-y-4">
                        <vibe:input size="sm" label="Small (sm)" placeholder="Height 32px, text-xs..." />
                        <vibe:input size="md" label="Medium (md)" placeholder="Height 36px, text-sm..." />
                        <vibe:input size="lg" label="Large (lg)" placeholder="Height 40px, text-sm..." />
                        <vibe:input size="xl" label="X-Large (xl)" placeholder="Height 44px, text-base..." />
                    </div>
                </vibe:preview>
            </section>

            {{-- 4. Icons & Addons --}}
            <section id="ikon-dan-addon" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/input.icons_addons_title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/input.icons_addons_desc') !!}
                    </p>
                </div>

                <vibe:preview title="Input with Icons & Addons">
                    <vibe:preview.code>
                        @verbatim
                            {{-- Leading icon (slot) --}}
                            <vibe:input label="Search" placeholder="Type to search...">
                                <x-slot:icon>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="11" cy="11" r="8" />
                                        <path d="m21 21-4.3-4.3" />
                                    </svg>
                                </x-slot:icon>
                            </vibe:input>

                            {{-- Trailing icon (slot) --}}
                            <vibe:input type="email" label="Email" placeholder="name@email.com">
                                <x-slot:trailingIcon>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect width="20" height="16" x="2" y="4" rx="2" />
                                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                                    </svg>
                                </x-slot:trailingIcon>
                            </vibe:input>

                            {{-- Prefix text --}}
                            <vibe:input label="Website" placeholder="domainname" prefix="https://" suffix=".com" />

                            {{-- Suffix text --}}
                            <vibe:input label="Price" type="number" placeholder="0" prefix="$" suffix="/month" />
                        @endverbatim
                    </vibe:preview.code>
                    <div class="w-full max-w-sm space-y-4">
                        <vibe:input label="Search" placeholder="Type to search...">
                            <x-slot:icon>
                                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="11" cy="11" r="8" />
                                    <path d="m21 21-4.3-4.3" />
                                </svg>
                            </x-slot:icon>
                        </vibe:input>
                        <vibe:input type="email" label="Email" placeholder="name@email.com">
                            <x-slot:trailingIcon>
                                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="20" height="16" x="2" y="4" rx="2" />
                                    <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                                </svg>
                            </x-slot:trailingIcon>
                        </vibe:input>
                        <vibe:input label="Website" placeholder="domainname" prefix="https://" suffix=".com" />
                        <vibe:input label="Price" type="number" placeholder="0" prefix="$" suffix="/month" />
                    </div>
                </vibe:preview>
            </section>

            {{-- 5. Pill Style --}}
            <section id="pill-style" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/input.pill_title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/input.pill_desc') !!}
                    </p>
                </div>

                <vibe:preview title="Pill Style">
                    <vibe:preview.code>
                        @verbatim
                            <vibe:input class="rounded-full" label="Search" placeholder="Search anything...">
                                <x-slot:icon>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="11" cy="11" r="8" />
                                        <path d="m21 21-4.3-4.3" />
                                    </svg>
                                </x-slot:icon>
                            </vibe:input>

                            <vibe:input class="rounded-full" variant="filled" label="Filled Pill" placeholder="Rounded filled..." />
                            <vibe:input class="rounded-full" variant="accent" label="Accent Pill" placeholder="Rounded accent..." />
                        @endverbatim
                    </vibe:preview.code>
                    <div class="w-full max-w-sm space-y-4">
                        <vibe:input class="rounded-full" label="Search" placeholder="Search anything...">
                            <x-slot:icon>
                                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="11" cy="11" r="8" />
                                    <path d="m21 21-4.3-4.3" />
                                </svg>
                            </x-slot:icon>
                        </vibe:input>
                        <vibe:input class="rounded-full" variant="filled" label="Filled Pill" placeholder="Rounded filled..." />
                        <vibe:input class="rounded-full" variant="accent" label="Accent Pill" placeholder="Rounded accent..." />
                    </div>
                </vibe:preview>
            </section>

            {{-- 6. Helper & Description --}}
            <section id="deskripsi-dan-bantuan" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/input.helper_title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/input.helper_desc') !!}
                    </p>
                </div>

                <vibe:preview title="Input with Helper Text">
                    <vibe:preview.code>
                        @verbatim
                            <vibe:input name="email" type="email" label="Email Address" description="Use an active email address." info="We'll never share your email with anyone." placeholder="name@company.com" />
                        @endverbatim
                    </vibe:preview.code>
                    <div class="w-full max-w-sm">
                        <vibe:input name="email" type="email" label="Email Address" description="Use an active email address." info="We'll never share your email with anyone." placeholder="name@company.com" />
                    </div>
                </vibe:preview>
            </section>

            {{-- 7. Error & Validation --}}
            <section id="error-dan-validasi" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/input.error_title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/input.error_desc') !!}
                    </p>
                </div>

                <vibe:preview title="Input Error State">
                    <vibe:preview.code>
                        @verbatim
                            {{-- Error from prop directly --}}
                            <vibe:input name="password" type="password" label="Password" value="12345" error="Password must be at least 8 characters long." />

                            {{-- Automatic Laravel $errors --}}
                            <vibe:input name="username" label="Username" wire:model="username" />

                            {{-- Custom error key (errorName) --}}
                            <vibe:input name="user[phone]" errorName="user.phone" label="Phone Number" error="Invalid phone number format." />
                        @endverbatim
                    </vibe:preview.code>
                    <div class="w-full max-w-sm space-y-4">
                        <vibe:input name="password" type="password" label="Password" value="12345" error="Password must be at least 8 characters long." />
                        <vibe:input name="user_phone" label="Phone Number" error="Invalid phone number format." placeholder="+1 (555) 000-0000" />
                    </div>
                </vibe:preview>
            </section>

            {{-- 8. Status: Disabled & Readonly --}}
            <section id="status-input" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/input.status_title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/input.status_desc') !!}
                    </p>
                </div>

                <vibe:preview title="Disabled & Readonly">
                    <vibe:preview.code>
                        @verbatim
                            {{-- Disabled --}}
                            <vibe:input label="User ID (Disabled)" value="USR-994821" disabled />

                            {{-- Readonly --}}
                            <vibe:input label="Referral Code (Readonly)" value="VIBE-REF-2025" readonly />
                        @endverbatim
                    </vibe:preview.code>
                    <div class="w-full max-w-sm space-y-4">
                        <vibe:input label="User ID (Disabled)" value="USR-994821" disabled />
                        <vibe:input label="Referral Code (Readonly)" value="VIBE-REF-2025" readonly />
                    </div>
                </vibe:preview>
            </section>

            {{-- 9. Livewire Integration --}}
            <section id="integrasi-livewire" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/input.livewire_title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/input.livewire_desc') !!}
                    </p>
                </div>

                <vibe:preview title="Livewire wire:model">
                    <vibe:preview.code>
                        @verbatim
                            {{-- In Livewire Component (PHP) --}}
                            class ProfileForm extends Component
                            {
                            #[Validate('required|min:3|max:50')]
                            public string $name = '';

                            #[Validate('required|email')]
                            public string $email = '';

                            public function save()
                            {
                            $this->validate();
                            // save logic...
                            }
                            }

                            {{-- In Blade template --}}
                            <form wire:submit="save">
                                <vibe:input wire:model.live="name" label="Full Name" placeholder="Enter name..." />

                                <vibe:input wire:model="email" type="email" label="Email" placeholder="name@email.com" info="Used for login." />

                                <vibe:button type="submit" variant="primary">
                                    Save Changes
                                </vibe:button>
                            </form>
                        @endverbatim
                    </vibe:preview.code>
                    <div class="w-full max-w-sm space-y-4">
                        <vibe:input label="Full Name (wire:model.live)" placeholder="Enter name..." />
                        <vibe:input type="email" label="Email (wire:model)" placeholder="name@email.com" info="Used for login." />
                        <vibe:button variant="primary" class="w-full">Save Changes</vibe:button>
                    </div>
                </vibe:preview>
            </section>

            {{-- 10. Props Reference --}}
            <section id="referensi-props" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/input.props_title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/input.props_desc') !!}
                    </p>
                </div>

                <div class="overflow-x-auto rounded-xl border border-border bg-card text-card-foreground">
                    <table class="w-full text-left text-xs">
                        <thead class="border-b border-border bg-muted/60 text-foreground font-semibold">
                            <tr>
                                <th class="px-4 py-3 whitespace-nowrap">{{ __('docs/input.table_prop') }}</th>
                                <th class="px-4 py-3 whitespace-nowrap">{{ __('docs/input.table_type') }}</th>
                                <th class="px-4 py-3 whitespace-nowrap">{{ __('docs/input.table_default') }}</th>
                                <th class="px-4 py-3">{{ __('docs/input.table_desc') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border text-muted-foreground">
                            @php
                                $props = [['label', 'string', 'null', 'Label text above the input.'], ['id', 'string', 'auto', 'HTML input id attribute. Default: name or uniqid().'], ['name', 'string', 'null', 'HTML name attribute. Automatically extracted from wire:model if omitted.'], ['type', 'string', "'text'", 'HTML input type: text, email, password, number, url, tel, etc.'], ['size', "'sm'|'md'|'lg'|'xl'", "'md'", 'Input height and text size.'], ['variant', "'outline'|'filled'|'flush'|'ghost'|'accent'", "'outline'", 'Visual style variant.'], ['description', 'string', 'null', 'Small helper text below the label, before the input.'], ['info', 'string', 'null', 'Helper note below the input. Hidden when error exists.'], ['error', 'string|bool', 'null', 'Custom error message or boolean to trigger error state.'], ['errorName', 'string', 'null', 'Laravel validation error key if different from name (e.g. user.phone).'], ['prefix', 'string', 'null', 'Text on the left side of the input (e.g. "https://", "$").'], ['suffix', 'string', 'null', 'Text on the right side of the input (e.g. ".com", "/month").'], ['class', 'string', 'null', 'Extra classes for input merged via twMerge (e.g. "rounded-full" for pill style).'], ['wrapperClass', 'string', 'null', 'Extra class for the outer wrapper div.']];
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
                <p class="text-sm font-semibold text-foreground pt-2">{{ __('docs/input.slots_title') }}</p>
                <div class="overflow-x-auto rounded-xl border border-border bg-card text-card-foreground">
                    <table class="w-full text-left text-xs">
                        <thead class="border-b border-border bg-muted/60 text-foreground font-semibold">
                            <tr>
                                <th class="px-4 py-3">{{ __('docs/input.table_slot') }}</th>
                                <th class="px-4 py-3">{{ __('docs/input.table_desc') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border text-muted-foreground">
                            <tr class="hover:bg-accent/40 transition-colors">
                                <td class="px-4 py-3 font-mono font-bold text-foreground">icon</td>
                                <td class="px-4 py-3 text-muted-foreground">SVG icon on the left side (leading icon). Use <code class="font-mono text-foreground">&lt;x-slot:icon&gt;</code>.</td>
                            </tr>
                            <tr class="hover:bg-accent/40 transition-colors">
                                <td class="px-4 py-3 font-mono font-bold text-foreground">trailingIcon</td>
                                <td class="px-4 py-3 text-muted-foreground">SVG icon on the right side (trailing icon). Use <code class="font-mono text-foreground">&lt;x-slot:trailingIcon&gt;</code>.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

        </div>

        <aside class="col-span-12 order-1 md:order-2 md:col-span-3 w-full md:sticky md:top-6">
            <vibe:toc selector="#docs-content" />
        </aside>

    </div>
</x-docs.layouts.sidebar>
