<x-docs.layouts.sidebar>
    <vibe:seo :title="__('docs/select.title')" :description="__('docs/select.description')" schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => 'Components', 'url' => '/docs'],
        ['name' => __('docs/select.title'), 'url' => '/docs/select']
    ]" />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">

        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            {{-- Header --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <vibe:badge variant="secondary" class="rounded-full">{{ __('docs/select.badge') }}</vibe:badge>
                    <span class="text-xs text-muted-foreground">{{ __('docs/select.group') }}</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">{{ __('docs/select.title') }}</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    {{ __('docs/select.description') }}
                </p>

                {{-- Quick props badge strip --}}
                <div class="flex flex-wrap items-center gap-1.5 pt-1">
                    @foreach (['primary', 'outline', 'filled', 'flush', 'ghost'] as $v)
                        <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">{{ $v }}</vibe:badge>
                    @endforeach
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    @foreach (['sm', 'md', 'lg', 'xl'] as $s)
                        <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">{{ $s }}</vibe:badge>
                    @endforeach
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    @foreach (['searchable', 'multiple', 'min', 'max', 'keyboard'] as $f)
                        <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">{{ $f }}</vibe:badge>
                    @endforeach
                </div>
            </div>

            {{-- 1. Basic Usage --}}
            <section id="penggunaan-dasar" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/select.basic_usage.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/select.basic_usage.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/select.basic_usage.preview_title')" minHeight="300px">
                    <vibe:preview.code>
                        <vibe:select name="role" label="{{ __('docs/select.basic_usage.label') }}" placeholder="{{ __('docs/select.basic_usage.placeholder') }}">
                            <vibe:select.option value="admin">Administrator</vibe:select.option>
                            <vibe:select.option value="editor">Editor</vibe:select.option>
                            <vibe:select.option value="author">Author</vibe:select.option>
                            <vibe:select.option value="subscriber">Subscriber</vibe:select.option>
                        </vibe:select>
                    </vibe:preview.code>
                    <div class="w-full max-w-sm">
                        <vibe:select name="role" :label="__('docs/select.basic_usage.label')" :placeholder="__('docs/select.basic_usage.placeholder')">
                            <vibe:select.option value="admin">Administrator</vibe:select.option>
                            <vibe:select.option value="editor">Editor</vibe:select.option>
                            <vibe:select.option value="author">Author</vibe:select.option>
                            <vibe:select.option value="subscriber">Subscriber</vibe:select.option>
                        </vibe:select>
                    </div>
                </vibe:preview>
            </section>

            {{-- 2. Selected Values (2 Methods: value & selected) --}}
            <section id="opsi-terpilih" class="space-y-6">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/select.selected_methods.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/select.selected_methods.desc') !!}
                    </p>
                </div>

                {{-- A. Single Select --}}
                <div class="space-y-3">
                    <h3 class="text-sm font-semibold text-foreground">{{ __('docs/select.selected_methods.single_tab') }}</h3>
                    <vibe:preview :title="__('docs/select.selected_methods.single_tab')" minHeight="300px">
                        <vibe:preview.code>
                            {{-- Metode 1: Prop value pada <vibe:select> (Single) --}}
                            <vibe:select name="status" label="{{ __('docs/select.selected_methods.method1_label') }}" value="active">
                                <vibe:select.option value="draft">Draft</vibe:select.option>
                                <vibe:select.option value="active">Active</vibe:select.option>
                                <vibe:select.option value="archived">Archived</vibe:select.option>
                            </vibe:select>

                            {{-- Metode 2: Atribut selected pada <vibe:select.option> (Single) --}}
                            <vibe:select name="department" label="{{ __('docs/select.selected_methods.method2_label') }}">
                                <vibe:select.option value="engineering">Engineering</vibe:select.option>
                                <vibe:select.option value="design" selected>Product Design</vibe:select.option>
                                <vibe:select.option value="marketing">Marketing</vibe:select.option>
                            </vibe:select>
                        </vibe:preview.code>

                        <div class="w-full grid grid-cols-1 sm:grid-cols-2 gap-6 items-start">
                            {{-- Card Metode 1 Single --}}
                            <vibe:card class="space-y-2">
                                <div class="flex items-center justify-between gap-2">
                                    <span class="text-xs font-bold text-foreground">{{ __('docs/select.selected_methods.method1_title') }}</span>
                                    <vibe:badge variant="primary" size="sm" class="font-mono text-[10px]">value="active"</vibe:badge>
                                </div>
                                <vibe:select name="demo_status" :label="__('docs/select.selected_methods.method1_label')" :placeholder="__('docs/select.selected_methods.method1_placeholder')" value="active">
                                    <vibe:select.option value="draft">Draft (Konsep)</vibe:select.option>
                                    <vibe:select.option value="active">Active (Dipublikasikan)</vibe:select.option>
                                    <vibe:select.option value="archived">Archived (Diarsipkan)</vibe:select.option>
                                </vibe:select>
                                <p class="text-[11px] text-muted-foreground">Opsi "Active" otomatis terpilih melalui prop <code>value="active"</code>.</p>
                            </vibe:card>

                            {{-- Card Metode 2 Single --}}
                            <vibe:card class="space-y-2">
                                <div class="flex items-center justify-between gap-2">
                                    <span class="text-xs font-bold text-foreground">{{ __('docs/select.selected_methods.method2_title') }}</span>
                                    <vibe:badge variant="success" size="sm" class="font-mono text-[10px]">&lt;option selected&gt;</vibe:badge>
                                </div>
                                <vibe:select name="demo_department" :label="__('docs/select.selected_methods.method2_label')" :placeholder="__('docs/select.selected_methods.method2_placeholder')">
                                    <vibe:select.option value="engineering">Engineering</vibe:select.option>
                                    <vibe:select.option value="design" selected>Product Design</vibe:select.option>
                                    <vibe:select.option value="marketing">Marketing</vibe:select.option>
                                </vibe:select>
                                <p class="text-[11px] text-muted-foreground">Opsi "Product Design" otomatis terpilih melalui atribut <code>selected</code> pada option.</p>
                            </vibe:card>
                        </div>
                    </vibe:preview>
                </div>

                {{-- B. Multiple Select --}}
                <div class="space-y-3 pt-2">
                    <h3 class="text-sm font-semibold text-foreground">{{ __('docs/select.selected_methods.multi_tab') }}</h3>
                    <vibe:preview :title="__('docs/select.selected_methods.multi_tab')" minHeight="320px">
                        <vibe:preview.code>
                            {{-- Metode 1: Prop :value array pada <vibe:select multiple> --}}
                            <vibe:select name="frontend" label="{{ __('docs/select.selected_methods.multi_method1_label') }}" multiple :value="['react', 'vue']">
                                <vibe:select.option value="react">React</vibe:select.option>
                                <vibe:select.option value="vue">Vue.js</vibe:select.option>
                                <vibe:select.option value="svelte">Svelte</vibe:select.option>
                                <vibe:select.option value="angular">Angular</vibe:select.option>
                            </vibe:select>

                            {{-- Metode 2: Atribut selected pada beberapa <vibe:select.option> (Multiple) --}}
                            <vibe:select name="backend" label="{{ __('docs/select.selected_methods.multi_method2_label') }}" multiple>
                                <vibe:select.option value="php" selected>PHP</vibe:select.option>
                                <vibe:select.option value="laravel" selected>Laravel</vibe:select.option>
                                <vibe:select.option value="nodejs">Node.js</vibe:select.option>
                                <vibe:select.option value="python">Python</vibe:select.option>
                            </vibe:select>
                        </vibe:preview.code>

                        <div class="w-full grid grid-cols-1 sm:grid-cols-2 gap-6 items-start">
                            {{-- Card Metode 1 Multiple --}}
                            <vibe:card class="space-y-2">
                                <div class="flex items-center justify-between gap-2">
                                    <span class="text-xs font-bold text-foreground">{{ __('docs/select.selected_methods.multi_method1_title') }}</span>
                                    <vibe:badge variant="primary" size="sm" class="font-mono text-[10px]">:value="['react', 'vue']"</vibe:badge>
                                </div>
                                <vibe:select name="demo_frontend" :label="__('docs/select.selected_methods.multi_method1_label')" :placeholder="__('docs/select.selected_methods.multi_method1_placeholder')" multiple :value="['react', 'vue']">
                                    <vibe:select.option value="react">React</vibe:select.option>
                                    <vibe:select.option value="vue">Vue.js</vibe:select.option>
                                    <vibe:select.option value="svelte">Svelte</vibe:select.option>
                                    <vibe:select.option value="angular">Angular</vibe:select.option>
                                </vibe:select>
                                <p class="text-[11px] text-muted-foreground">Opsi "React" dan "Vue.js" terpilih melalui array binding <code>:value="['react', 'vue']"</code>.</p>
                            </vibe:card>

                            {{-- Card Metode 2 Multiple --}}
                            <vibe:card class="space-y-2">
                                <div class="flex items-center justify-between gap-2">
                                    <span class="text-xs font-bold text-foreground">{{ __('docs/select.selected_methods.multi_method2_title') }}</span>
                                    <vibe:badge variant="success" size="sm" class="font-mono text-[10px]">multiple &lt;option selected&gt;</vibe:badge>
                                </div>
                                <vibe:select name="demo_backend" :label="__('docs/select.selected_methods.multi_method2_label')" :placeholder="__('docs/select.selected_methods.multi_method2_placeholder')" multiple>
                                    <vibe:select.option value="php" selected>PHP</vibe:select.option>
                                    <vibe:select.option value="laravel" selected>Laravel</vibe:select.option>
                                    <vibe:select.option value="nodejs">Node.js</vibe:select.option>
                                    <vibe:select.option value="python">Python</vibe:select.option>
                                </vibe:select>
                                <p class="text-[11px] text-muted-foreground">Opsi "PHP" dan "Laravel" otomatis terpilih berkat atribut <code>selected</code> pada masing-masing opsi.</p>
                            </vibe:card>
                        </div>
                    </vibe:preview>
                </div>
            </section>

            {{-- 3. Searchable --}}
            <section id="pencarian" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/select.searchable.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/select.searchable.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/select.searchable.preview_title')" minHeight="300px">
                    <vibe:preview.code>
                        <vibe:select name="country" label="{{ __('docs/select.searchable.label') }}" placeholder="{{ __('docs/select.searchable.placeholder') }}" searchable searchPlaceholder="{{ __('docs/select.searchable.search_placeholder') }}">
                            <vibe:select.option value="id">Indonesia</vibe:select.option>
                            <vibe:select.option value="my">Malaysia</vibe:select.option>
                            <vibe:select.option value="sg">Singapura</vibe:select.option>
                            <vibe:select.option value="th">Thailand</vibe:select.option>
                            <vibe:select.option value="ph">Filipina</vibe:select.option>
                            <vibe:select.option value="vn">Vietnam</vibe:select.option>
                            <vibe:select.option value="jp">Jepang</vibe:select.option>
                        </vibe:select>
                    </vibe:preview.code>
                    <div class="w-full max-w-sm">
                        <vibe:select name="country" :label="__('docs/select.searchable.label')" :placeholder="__('docs/select.searchable.placeholder')" searchable :searchPlaceholder="__('docs/select.searchable.search_placeholder')">
                            <vibe:select.option value="id">Indonesia</vibe:select.option>
                            <vibe:select.option value="my">Malaysia</vibe:select.option>
                            <vibe:select.option value="sg">Singapura</vibe:select.option>
                            <vibe:select.option value="th">Thailand</vibe:select.option>
                            <vibe:select.option value="ph">Filipina</vibe:select.option>
                            <vibe:select.option value="vn">Vietnam</vibe:select.option>
                            <vibe:select.option value="jp">Jepang</vibe:select.option>
                        </vibe:select>
                    </div>
                </vibe:preview>
            </section>

            {{-- 3. Option Groups --}}
            <section id="pengelompokan-opsi" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/select.groups.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/select.groups.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/select.groups.preview_title')" minHeight="300px">
                    <vibe:preview.code>
                        <vibe:select name="skill" label="{{ __('docs/select.groups.label') }}" placeholder="{{ __('docs/select.groups.placeholder') }}" searchable>
                            <vibe:select.group label="Frontend">
                                <vibe:select.option value="vue" description="Progressive Framework">Vue.js</vibe:select.option>
                                <vibe:select.option value="react" description="Declarative UI Library">React</vibe:select.option>
                                <vibe:select.option value="svelte" description="Cybernetically Enhanced Web Apps">Svelte</vibe:select.option>
                            </vibe:select.group>

                            <vibe:select.group label="Backend">
                                <vibe:select.option value="laravel" description="The PHP Framework for Web Artisans">Laravel</vibe:select.option>
                                <vibe:select.option value="django" description="The Python Web Framework">Django</vibe:select.option>
                                <vibe:select.option value="go" description="High Performance Cloud & Systems">Golang</vibe:select.option>
                            </vibe:select.group>
                        </vibe:select>
                    </vibe:preview.code>
                    <div class="w-full max-w-sm">
                        <vibe:select name="skill" :label="__('docs/select.groups.label')" :placeholder="__('docs/select.groups.placeholder')" searchable>
                            <vibe:select.group label="Frontend">
                                <vibe:select.option value="vue" description="Progressive Framework">Vue.js</vibe:select.option>
                                <vibe:select.option value="react" description="Declarative UI Library">React</vibe:select.option>
                                <vibe:select.option value="svelte" description="Cybernetically Enhanced Web Apps">Svelte</vibe:select.option>
                            </vibe:select.group>

                            <vibe:select.group label="Backend">
                                <vibe:select.option value="laravel" description="The PHP Framework for Web Artisans">Laravel</vibe:select.option>
                                <vibe:select.option value="django" description="The Python Web Framework">Django</vibe:select.option>
                                <vibe:select.option value="go" description="High Performance Cloud & Systems">Golang</vibe:select.option>
                            </vibe:select.group>
                        </vibe:select>
                    </div>
                </vibe:preview>
            </section>

            {{-- 4. Avatars & Icons --}}
            <section id="avatar-dan-ikon" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/select.avatars_icons.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/select.avatars_icons.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/select.avatars_icons.preview_title')" minHeight="300px">
                    <vibe:preview.code>
                        <vibe:select name="assignee" label="{{ __('docs/select.avatars_icons.label') }}" placeholder="{{ __('docs/select.avatars_icons.placeholder') }}" searchable>
                            <vibe:select.option value="sarah" avatar="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=64&h=64&fit=crop&crop=face" description="Lead Product Designer">
                                Sarah Jenkins
                            </vibe:select.option>

                            <vibe:select.option value="michael" avatar="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=64&h=64&fit=crop&crop=face" description="Senior Backend Engineer">
                                Michael Chen
                            </vibe:select.option>

                            <vibe:select.option value="alex" avatar="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=64&h=64&fit=crop&crop=face" description="Full Stack Developer">
                                Alex Johnson
                            </vibe:select.option>
                        </vibe:select>
                    </vibe:preview.code>
                    <div class="w-full max-w-sm">
                        <vibe:select name="assignee" :label="__('docs/select.avatars_icons.label')" :placeholder="__('docs/select.avatars_icons.placeholder')" searchable>
                            <vibe:select.option value="sarah" avatar="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=64&h=64&fit=crop&crop=face" description="Lead Product Designer">
                                Sarah Jenkins
                            </vibe:select.option>

                            <vibe:select.option value="michael" avatar="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=64&h=64&fit=crop&crop=face" description="Senior Backend Engineer">
                                Michael Chen
                            </vibe:select.option>

                            <vibe:select.option value="alex" avatar="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=64&h=64&fit=crop&crop=face" description="Full Stack Developer">
                                Alex Johnson
                            </vibe:select.option>
                        </vibe:select>
                    </div>
                </vibe:preview>
            </section>

            {{-- 5. Variants --}}
            <section id="varian-tampilan" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/select.variants.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/select.variants.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/select.variants.preview_title')" minHeight="320px">
                    <vibe:preview.code>
                        {{-- primary (default) --}}
                        <vibe:select label="Primary" placeholder="Varian primary (default)...">
                            <vibe:select.option value="1">Opsi Satu</vibe:select.option>
                            <vibe:select.option value="2">Opsi Dua</vibe:select.option>
                        </vibe:select>

                        {{-- outline --}}
                        <vibe:select variant="outline" label="Outline" placeholder="Varian outline...">
                            <vibe:select.option value="1">Opsi Satu</vibe:select.option>
                            <vibe:select.option value="2">Opsi Dua</vibe:select.option>
                        </vibe:select>

                        {{-- filled --}}
                        <vibe:select variant="filled" label="Filled" placeholder="Varian filled...">
                            <vibe:select.option value="1">Opsi Satu</vibe:select.option>
                            <vibe:select.option value="2">Opsi Dua</vibe:select.option>
                        </vibe:select>

                        {{-- flush --}}
                        <vibe:select variant="flush" label="Flush" placeholder="Varian flush (underline)...">
                            <vibe:select.option value="1">Opsi Satu</vibe:select.option>
                            <vibe:select.option value="2">Opsi Dua</vibe:select.option>
                        </vibe:select>

                        {{-- ghost --}}
                        <vibe:select variant="ghost" label="Ghost" placeholder="Varian ghost...">
                            <vibe:select.option value="1">Opsi Satu</vibe:select.option>
                            <vibe:select.option value="2">Opsi Dua</vibe:select.option>
                        </vibe:select>
                    </vibe:preview.code>
                    <div class="w-full max-w-sm space-y-4">
                        <vibe:select label="Primary" placeholder="Varian primary (default)...">
                            <vibe:select.option value="1">Opsi Satu</vibe:select.option>
                            <vibe:select.option value="2">Opsi Dua</vibe:select.option>
                        </vibe:select>

                        <vibe:select variant="outline" label="Outline" placeholder="Varian outline...">
                            <vibe:select.option value="1">Opsi Satu</vibe:select.option>
                            <vibe:select.option value="2">Opsi Dua</vibe:select.option>
                        </vibe:select>

                        <vibe:select variant="filled" label="Filled" placeholder="Varian filled...">
                            <vibe:select.option value="1">Opsi Satu</vibe:select.option>
                            <vibe:select.option value="2">Opsi Dua</vibe:select.option>
                        </vibe:select>

                        <vibe:select variant="flush" label="Flush" placeholder="Varian flush (underline)...">
                            <vibe:select.option value="1">Opsi Satu</vibe:select.option>
                            <vibe:select.option value="2">Opsi Dua</vibe:select.option>
                        </vibe:select>

                        <vibe:select variant="ghost" label="Ghost" placeholder="Varian ghost...">
                            <vibe:select.option value="1">Opsi Satu</vibe:select.option>
                            <vibe:select.option value="2">Opsi Dua</vibe:select.option>
                        </vibe:select>
                    </div>
                </vibe:preview>
            </section>

            {{-- 6. Sizes --}}
            <section id="skala-ukuran" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/select.sizes.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/select.sizes.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/select.sizes.preview_title')" minHeight="320px">
                    <vibe:preview.code>
                        <vibe:select size="sm" label="Kecil (sm - h-8)" placeholder="Ukuran sm...">
                            <vibe:select.option value="sm1">{{ __('docs/select.demo_options.sm') }}</vibe:select.option>
                        </vibe:select>

                        <vibe:select size="md" label="Sedang (md - h-9)" placeholder="Ukuran md (default)...">
                            <vibe:select.option value="md1">{{ __('docs/select.demo_options.md') }}</vibe:select.option>
                        </vibe:select>

                        <vibe:select size="lg" label="Besar (lg - h-10)" placeholder="Ukuran lg...">
                            <vibe:select.option value="lg1">{{ __('docs/select.demo_options.lg') }}</vibe:select.option>
                        </vibe:select>

                        <vibe:select size="xl" label="Ekstra (xl - h-11)" placeholder="Ukuran xl...">
                            <vibe:select.option value="xl1">{{ __('docs/select.demo_options.xl') }}</vibe:select.option>
                        </vibe:select>
                    </vibe:preview.code>
                    <div class="w-full max-w-sm space-y-4">
                        <vibe:select size="sm" label="Kecil (sm - h-8)" placeholder="Ukuran sm...">
                            <vibe:select.option value="sm1">{{ __('docs/select.demo_options.sm') }}</vibe:select.option>
                        </vibe:select>

                        <vibe:select size="md" label="Sedang (md - h-9)" placeholder="Ukuran md (default)...">
                            <vibe:select.option value="md1">{{ __('docs/select.demo_options.md') }}</vibe:select.option>
                        </vibe:select>

                        <vibe:select size="lg" label="Besar (lg - h-10)" placeholder="Ukuran lg...">
                            <vibe:select.option value="lg1">{{ __('docs/select.demo_options.lg') }}</vibe:select.option>
                        </vibe:select>

                        <vibe:select size="xl" label="Ekstra (xl - h-11)" placeholder="Ukuran xl...">
                            <vibe:select.option value="xl1">{{ __('docs/select.demo_options.xl') }}</vibe:select.option>
                        </vibe:select>
                    </div>
                </vibe:preview>
            </section>

            {{-- 7. States --}}
            <section id="status-dan-validasi" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/select.states.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/select.states.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/select.states.preview_title')" minHeight="320px">
                    <vibe:preview.code>
                        {{-- Disabled select --}}
                        <vibe:select name="locked_region" label="{{ __('docs/select.states.disabled_label') }}" placeholder="{{ __('docs/select.states.disabled_placeholder') }}" disabled />

                        {{-- Error & Required --}}
                        <vibe:select name="service_category" label="{{ __('docs/select.states.error_label') }}" required error="{{ __('docs/select.states.error_msg') }}" placeholder="Pilih kategori...">
                            <vibe:select.option value="1">Konsultasi Bisnis</vibe:select.option>
                            <vibe:select.option value="2">Pengembangan Perangkat Lunak</vibe:select.option>
                        </vibe:select>

                        {{-- Individual Disabled Option --}}
                        <vibe:select name="server_slot" :label="__('docs/select.demo_options.server_label')" :placeholder="__('docs/select.demo_options.server_placeholder')">
                            <vibe:select.option value="sg1" description="Latensi rendah, siap pakai">Singapore Node 1</vibe:select.option>
                            <vibe:select.option value="us1" description="Kapasitas penuh (Maintenance)" disabled>US East Node 1 (Disabled)</vibe:select.option>
                        </vibe:select>
                    </vibe:preview.code>
                    <div class="w-full max-w-sm space-y-4">
                        <vibe:select name="locked_region" :label="__('docs/select.states.disabled_label')" :placeholder="__('docs/select.states.disabled_placeholder')" disabled />

                        <vibe:select name="service_category" :label="__('docs/select.states.error_label')" required :error="__('docs/select.states.error_msg')" placeholder="Pilih kategori...">
                            <vibe:select.option value="1">Konsultasi Bisnis</vibe:select.option>
                            <vibe:select.option value="2">Pengembangan Perangkat Lunak</vibe:select.option>
                        </vibe:select>

                        <vibe:select name="server_slot" :label="__('docs/select.demo_options.server_label')" :placeholder="__('docs/select.demo_options.server_placeholder')">
                            <vibe:select.option value="sg1" description="Latensi rendah, siap pakai">Singapore Node 1</vibe:select.option>
                            <vibe:select.option value="us1" description="Kapasitas penuh (Maintenance)" disabled>US East Node 1 (Disabled)</vibe:select.option>
                        </vibe:select>
                    </div>
                </vibe:preview>
            </section>

            {{-- 8. Keyboard Navigation --}}
            <section id="navigasi-keyboard" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/select.keyboard.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/select.keyboard.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/select.keyboard.preview_title')" minHeight="300px">
                    <vibe:preview.code>
                        <vibe:select name="os" label="{{ __('docs/select.keyboard.label') }}" placeholder="{{ __('docs/select.keyboard.placeholder') }}" keyboard searchable>
                            <vibe:select.option value="mac">macOS Sonoma</vibe:select.option>
                            <vibe:select.option value="linux">Ubuntu Linux</vibe:select.option>
                            <vibe:select.option value="windows">Windows 11 Pro</vibe:select.option>
                            <vibe:select.option value="fedora">Fedora Workstation</vibe:select.option>
                            <vibe:select.option value="arch">Arch Linux</vibe:select.option>
                        </vibe:select>
                    </vibe:preview.code>
                    <div class="w-full max-w-sm">
                        <vibe:select name="os" :label="__('docs/select.keyboard.label')" :placeholder="__('docs/select.keyboard.placeholder')" keyboard searchable>
                            <vibe:select.option value="mac">macOS Sonoma</vibe:select.option>
                            <vibe:select.option value="linux">Ubuntu Linux</vibe:select.option>
                            <vibe:select.option value="windows">Windows 11 Pro</vibe:select.option>
                            <vibe:select.option value="fedora">Fedora Workstation</vibe:select.option>
                            <vibe:select.option value="arch">Arch Linux</vibe:select.option>
                        </vibe:select>
                    </div>
                </vibe:preview>
            </section>

            {{-- 9. Multiple Selection & Limits --}}
            <section id="pilihan-ganda" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/select.multiple.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/select.multiple.desc') !!}
                    </p>
                </div>

                {{-- Demo 1: Basic Multiple Select --}}
                <div class="space-y-2">
                    <div class="flex items-center justify-between gap-2">
                        <h3 class="text-sm font-semibold text-foreground">{{ __('docs/select.multiple.basic_title') }}</h3>
                        <vibe:badge variant="outline" size="sm" class="font-mono text-[10px]">Tanpa Batasan (Bebas Pilih/Kosongkan)</vibe:badge>
                    </div>
                    <vibe:preview :title="__('docs/select.multiple.basic_title')" minHeight="320px">
                        <vibe:preview.code>
                            <vibe:select name="skills" label="{{ __('docs/select.multiple.basic_label') }}" placeholder="{{ __('docs/select.multiple.basic_placeholder') }}" multiple keyboard :value="['php', 'laravel']">
                                <vibe:select.option value="php">PHP</vibe:select.option>
                                <vibe:select.option value="laravel">Laravel</vibe:select.option>
                                <vibe:select.option value="livewire">Livewire</vibe:select.option>
                                <vibe:select.option value="tailwind">Tailwind CSS</vibe:select.option>
                                <vibe:select.option value="alpine">Alpine.js</vibe:select.option>
                                <vibe:select.option value="vue">Vue.js</vibe:select.option>
                                <vibe:select.option value="react">React</vibe:select.option>
                            </vibe:select>
                        </vibe:preview.code>
                        <div class="w-full max-w-md">
                            <vibe:select name="skills" :label="__('docs/select.multiple.basic_label')" :placeholder="__('docs/select.multiple.basic_placeholder')" multiple keyboard :value="['php', 'laravel']">
                                <vibe:select.option value="php">PHP</vibe:select.option>
                                <vibe:select.option value="laravel">Laravel</vibe:select.option>
                                <vibe:select.option value="livewire">Livewire</vibe:select.option>
                                <vibe:select.option value="tailwind">Tailwind CSS</vibe:select.option>
                                <vibe:select.option value="alpine">Alpine.js</vibe:select.option>
                                <vibe:select.option value="vue">Vue.js</vibe:select.option>
                                <vibe:select.option value="react">React</vibe:select.option>
                            </vibe:select>
                        </div>
                    </vibe:preview>
                </div>

                {{-- Demo 2: Multiple with Searchable --}}
                <div class="space-y-2 pt-2">
                    <h3 class="text-sm font-semibold text-foreground">{{ __('docs/select.multiple.searchable_title') }}</h3>
                    <vibe:preview :title="__('docs/select.multiple.searchable_title')" minHeight="340px">
                        <vibe:preview.code>
                            <vibe:select name="tech_stack" label="{{ __('docs/select.multiple.searchable_label') }}" placeholder="{{ __('docs/select.multiple.searchable_placeholder') }}" multiple keyboard searchable searchPlaceholder="Ketik untuk mencari teknologi...">
                                <vibe:select.option value="docker">Docker</vibe:select.option>
                                <vibe:select.option value="k8s">Kubernetes</vibe:select.option>
                                <vibe:select.option value="redis">Redis Cache</vibe:select.option>
                                <vibe:select.option value="postgres">PostgreSQL</vibe:select.option>
                                <vibe:select.option value="mysql">MySQL Server</vibe:select.option>
                                <vibe:select.option value="aws">Amazon Web Services</vibe:select.option>
                                <vibe:select.option value="gcp">Google Cloud Platform</vibe:select.option>
                            </vibe:select>
                        </vibe:preview.code>
                        <div class="w-full max-w-md">
                            <vibe:select name="tech_stack" :label="__('docs/select.multiple.searchable_label')" :placeholder="__('docs/select.multiple.searchable_placeholder')" multiple keyboard searchable searchPlaceholder="Ketik untuk mencari teknologi...">
                                <vibe:select.option value="docker">Docker</vibe:select.option>
                                <vibe:select.option value="k8s">Kubernetes</vibe:select.option>
                                <vibe:select.option value="redis">Redis Cache</vibe:select.option>
                                <vibe:select.option value="postgres">PostgreSQL</vibe:select.option>
                                <vibe:select.option value="mysql">MySQL Server</vibe:select.option>
                                <vibe:select.option value="aws">Amazon Web Services</vibe:select.option>
                                <vibe:select.option value="gcp">Google Cloud Platform</vibe:select.option>
                            </vibe:select>
                        </div>
                    </vibe:preview>
                </div>

                {{-- Demo 3: Min and Max Constraints --}}
                <div class="space-y-2 pt-2">
                    <div class="flex items-center justify-between gap-2">
                        <h3 class="text-sm font-semibold text-foreground">{{ __('docs/select.multiple.limits_title') }}</h3>
                        <vibe:badge variant="warning" size="sm" class="font-mono text-[10px]">:min="2" & :max="4" (Terkunci Otomatis)</vibe:badge>
                    </div>
                    <vibe:preview :title="__('docs/select.multiple.limits_title')" minHeight="340px">
                        <vibe:preview.code>
                            <vibe:select name="interests" label="{{ __('docs/select.multiple.limits_label') }}" placeholder="{{ __('docs/select.multiple.limits_placeholder') }}" info="{{ __('docs/select.multiple.limits_info') }}" multiple keyboard :min="2" :max="4" :value="['ai', 'cloud']">
                                <vibe:select.option value="ai">Artificial Intelligence</vibe:select.option>
                                <vibe:select.option value="cloud">Cloud Computing</vibe:select.option>
                                <vibe:select.option value="cyber">Cyber Security</vibe:select.option>
                                <vibe:select.option value="data">Data Science</vibe:select.option>
                                <vibe:select.option value="mobile">Mobile Development</vibe:select.option>
                                <vibe:select.option value="devops">DevOps & CI/CD</vibe:select.option>
                                <vibe:select.option value="blockchain">Blockchain</vibe:select.option>
                            </vibe:select>
                        </vibe:preview.code>
                        <div class="w-full max-w-md">
                            <vibe:select name="interests" :label="__('docs/select.multiple.limits_label')" :placeholder="__('docs/select.multiple.limits_placeholder')" :info="__('docs/select.multiple.limits_info')" multiple keyboard :min="2" :max="4" :value="['ai', 'cloud']">
                                <vibe:select.option value="ai">Artificial Intelligence</vibe:select.option>
                                <vibe:select.option value="cloud">Cloud Computing</vibe:select.option>
                                <vibe:select.option value="cyber">Cyber Security</vibe:select.option>
                                <vibe:select.option value="data">Data Science</vibe:select.option>
                                <vibe:select.option value="mobile">Mobile Development</vibe:select.option>
                                <vibe:select.option value="devops">DevOps & CI/CD</vibe:select.option>
                                <vibe:select.option value="blockchain">Blockchain</vibe:select.option>
                            </vibe:select>
                        </div>
                    </vibe:preview>
                </div>
            </section>

            {{-- 10. Select Berbasis API (vibe:select.remote) --}}
            <section id="select-remote" class="space-y-4">
                <div class="space-y-1">
                    <div class="flex items-center gap-2">
                        <h2 class="text-xl font-bold text-foreground">{{ __('docs/select.remote.title') }}</h2>
                        <vibe:badge variant="primary" size="sm">Baru</vibe:badge>
                    </div>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/select.remote.desc') !!}
                    </p>
                </div>

                {{-- Demo 1: Basic Remote API Search --}}
                <div class="space-y-2">
                    <h3 class="text-sm font-semibold text-foreground">{{ __('docs/select.remote.basic_title') }}</h3>
                    <vibe:preview :title="__('docs/select.remote.basic_title')" minHeight="320px">
                        <vibe:preview.code>
                            <vibe:select.remote
                                name="user_id"
                                label="{{ __('docs/select.remote.basic_label') }}"
                                placeholder="{{ __('docs/select.remote.basic_placeholder') }}"
                                :api="route('docs.select.api')"
                                keyboard
                                clearable
                            />
                        </vibe:preview.code>
                        <div class="w-full max-w-sm">
                            <vibe:select.remote
                                name="demo_user_id"
                                :label="__('docs/select.remote.basic_label')"
                                :placeholder="__('docs/select.remote.basic_placeholder')"
                                :api="route('docs.select.api')"
                                keyboard
                                clearable
                            />
                        </div>
                    </vibe:preview>
                </div>

                {{-- Demo 2: Edit Mode with Pre-filled Value & Initial Label --}}
                <div class="space-y-2">
                    <h3 class="text-sm font-semibold text-foreground">{{ __('docs/select.remote.edit_title') }}</h3>
                    <vibe:preview :title="__('docs/select.remote.edit_title')" minHeight="320px">
                        <vibe:preview.code>
                            <vibe:select.remote
                                name="lead_id"
                                label="{{ __('docs/select.remote.edit_label') }}"
                                :api="route('docs.select.api')"
                                value="13"
                                initial-label="Alanna Schimmel"
                                keyboard
                                clearable
                            />
                        </vibe:preview.code>
                        <div class="w-full max-w-sm">
                            <vibe:select.remote
                                name="demo_lead_id"
                                :label="__('docs/select.remote.edit_label')"
                                :api="route('docs.select.api')"
                                value="13"
                                initial-label="Alanna Schimmel"
                                keyboard
                                clearable
                            />
                        </div>
                    </vibe:preview>
                </div>

                {{-- Demo 3: Multi-Select API --}}
                <div class="space-y-2">
                    <h3 class="text-sm font-semibold text-foreground">{{ __('docs/select.remote.multiple_title') }}</h3>
                    <vibe:preview :title="__('docs/select.remote.multiple_title')" minHeight="340px">
                        <vibe:preview.code>
                            <vibe:select.remote
                                name="assigned_members[]"
                                label="{{ __('docs/select.remote.multiple_label') }}"
                                placeholder="{{ __('docs/select.remote.multiple_placeholder') }}"
                                :api="route('docs.select.api')"
                                multiple
                                :max="4"
                                keyboard
                                clearable
                            />
                        </vibe:preview.code>
                        <div class="w-full max-w-md">
                            <vibe:select.remote
                                name="demo_assigned_members[]"
                                :label="__('docs/select.remote.multiple_label')"
                                :placeholder="__('docs/select.remote.multiple_placeholder')"
                                :api="route('docs.select.api')"
                                multiple
                                :max="4"
                                keyboard
                                clearable
                            />
                        </div>
                    </vibe:preview>
                </div>

                {{-- Demo 4: Multi-Select Remote Edit Mode (Pre-filled Values & Options) --}}
                <div class="space-y-2">
                    <h3 class="text-sm font-semibold text-foreground">{{ __('docs/select.remote.edit_multiple_title') }}</h3>
                    <p class="text-xs text-muted-foreground">{!! __('docs/select.remote.edit_multiple_desc') !!}</p>
                    <vibe:preview :title="__('docs/select.remote.edit_multiple_title')" minHeight="340px">
                        <vibe:preview.code>
                            @php
                                $collaborators = [
                                    [
                                        'value' => '13',
                                        'label' => 'Alanna Schimmel',
                                        'description' => 'patsy07@example.org • @qmaggio',
                                        'icon' => 'https://ui-avatars.com/api/?name=Alanna+Schimmel&background=random&color=fff&size=64'
                                    ],
                                    [
                                        'value' => '24',
                                        'label' => 'Corene Smith',
                                        'description' => 'lind.misael@example.com • @amelia01',
                                        'icon' => 'https://ui-avatars.com/api/?name=Corene+Smith&background=random&color=fff&size=64'
                                    ]
                                ];
                            @endphp

                            <vibe:select.remote
                                name="project_collaborators[]"
                                label="{{ __('docs/select.remote.edit_multiple_label') }}"
                                placeholder="{{ __('docs/select.remote.multiple_placeholder') }}"
                                :api="route('docs.select.api')"
                                multiple
                                :value="$collaborators"
                                keyboard
                                clearable
                            />
                        </vibe:preview.code>
                        <div class="w-full max-w-md">
                            @php
                                $demoCollaborators = [
                                    [
                                        'value' => '13',
                                        'label' => 'Alanna Schimmel',
                                        'description' => 'patsy07@example.org • @qmaggio',
                                        'icon' => 'https://ui-avatars.com/api/?name=Alanna+Schimmel&background=random&color=fff&size=64'
                                    ],
                                    [
                                        'value' => '24',
                                        'label' => 'Corene Smith',
                                        'description' => 'lind.misael@example.com • @amelia01',
                                        'icon' => 'https://ui-avatars.com/api/?name=Corene+Smith&background=random&color=fff&size=64'
                                    ]
                                ];
                            @endphp
                            <vibe:select.remote
                                name="demo_project_collaborators[]"
                                :label="__('docs/select.remote.edit_multiple_label')"
                                :placeholder="__('docs/select.remote.multiple_placeholder')"
                                :api="route('docs.select.api')"
                                multiple
                                :value="$demoCollaborators"
                                keyboard
                                clearable
                            />
                        </div>
                    </vibe:preview>
                </div>

                {{-- Panduan Backend Controller & Skema JSON --}}
                <div class="space-y-4 pt-4 border-t border-border/60">
                    <div class="space-y-1">
                        <h3 class="text-base font-semibold text-foreground">{{ __('docs/select.remote.backend_title') }}</h3>
                        <p class="text-sm text-muted-foreground">
                            {!! __('docs/select.remote.backend_desc') !!}
                        </p>
                    </div>

                    @php
                        $routeCode = <<<'PHP'
use App\Http\Controllers\SelectController;

// routes/web.php atau routes/api.php
Route::get('/docs/select/api', [SelectController::class, 'api'])->name('docs.select.api');
PHP;

                        $controllerCode = <<<'PHP'
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SelectController extends Controller
{
    public function api(Request $request): JsonResponse
    {
        // 1. Ambil keyword pencarian dari query string (default param: 'q')
        $query = trim((string) $request->input('q', ''));
        $like = config('database.default') === 'pgsql' ? 'ilike' : 'like';

        // 2. Query data model dari database (contoh tabel users)
        $users = User::query()
            ->when($query !== '', function ($q) use ($query, $like) {
                $q->where(function ($sub) use ($query, $like) {
                    $sub->where('name', $like, "%{$query}%")
                        ->orWhere('email', $like, "%{$query}%")
                        ->orWhere('username', $like, "%{$query}%")
                        ->orWhere('position', $like, "%{$query}%");
                });
            })
            ->limit(12)
            ->get();

        // 3. Petakan (map) koleksi data ke dalam format standar <vibe:select.remote>
        $data = $users->map(function ($user) {
            $descParts = array_filter([
                $user->email,
                $user->position ?: ($user->username ? '@' . $user->username : null),
            ]);

            return [
                'value' => (string) $user->id,
                'label' => $user->name,
                'description' => implode(' • ', $descParts),
                'icon' => 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=random&color=fff&size=64',
            ];
        });

        // 4. Kembalikan response berupa JSON Array murni
        return response()->json($data);
    }
}
PHP;

                        $schemaCode = <<<'JSON'
[
  {
    "value": "13",
    "label": "Alanna Schimmel",
    "description": "patsy07@example.org • @qmaggio",
    "icon": "https://ui-avatars.com/api/?name=Alanna+Schimmel&background=random&color=fff&size=64"
  },
  {
    "value": "24",
    "label": "Corene Smith",
    "description": "lind.misael@example.com • @amelia01",
    "icon": "https://ui-avatars.com/api/?name=Corene+Smith&background=random&color=fff&size=64"
  },
  {
    "value": "99",
    "label": "Akun Terkunci",
    "description": "Pengguna nonaktif / tidak dapat dipilih",
    "disabled": true
  }
]
JSON;

                        $advancedBladeCode = <<<'BLADE'
<vibe:select.remote
    name="customer_id"
    label="Pilih Pelanggan"
    placeholder="Ketik minimal 2 karakter..."
    :api="route('api.customers.search')"
    searchParam="query"
    :minChars="2"
    :debounce="400"
    :headers="['X-Custom-Auth' => 'Bearer token_secret']"
    keyboard
    clearable
/>
BLADE;
                    @endphp

                    {{-- 1. Route Definition --}}
                    <div class="space-y-2">
                        <h4 class="text-xs font-semibold uppercase tracking-wider text-muted-foreground">{{ __('docs/select.remote.route_title') }}</h4>
                        <vibe:highlightjs language="php" title="routes/web.php" :code="$routeCode" />
                    </div>

                    {{-- 2. Controller Function Implementation --}}
                    <div class="space-y-2">
                        <h4 class="text-xs font-semibold uppercase tracking-wider text-muted-foreground">{{ __('docs/select.remote.controller_title') }}</h4>
                        <p class="text-xs text-muted-foreground">{{ __('docs/select.remote.controller_desc') }}</p>
                        <vibe:highlightjs language="php" title="app/Http/Controllers/SelectController.php" :code="$controllerCode" />
                    </div>

                    {{-- 3. JSON Response Schema Structure --}}
                    <div class="space-y-2">
                        <h4 class="text-xs font-semibold uppercase tracking-wider text-muted-foreground">{{ __('docs/select.remote.schema_title') }}</h4>
                        <p class="text-xs text-muted-foreground">{{ __('docs/select.remote.schema_desc') }}</p>
                        <vibe:highlightjs language="json" title="Response JSON Schema" :code="$schemaCode" />

                        <div class="pt-2">
                            <vibe:table>
                                <vibe:table.header>
                                    <vibe:table.column class="whitespace-nowrap">Kunci JSON</vibe:table.column>
                                    <vibe:table.column class="whitespace-nowrap">Tipe Data</vibe:table.column>
                                    <vibe:table.column class="whitespace-nowrap">Status</vibe:table.column>
                                    <vibe:table.column>Deskripsi</vibe:table.column>
                                </vibe:table.header>
                                <vibe:table.rows>
                                    <vibe:table.row>
                                        <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">value</vibe:table.cell>
                                        <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">string|int</vibe:table.cell>
                                        <vibe:table.cell class="font-mono text-primary font-semibold whitespace-nowrap">Wajib</vibe:table.cell>
                                        <vibe:table.cell class="text-muted-foreground">{{ __('docs/select.remote.schema_value') }}</vibe:table.cell>
                                    </vibe:table.row>
                                    <vibe:table.row>
                                        <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">label</vibe:table.cell>
                                        <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">string</vibe:table.cell>
                                        <vibe:table.cell class="font-mono text-primary font-semibold whitespace-nowrap">Wajib</vibe:table.cell>
                                        <vibe:table.cell class="text-muted-foreground">{{ __('docs/select.remote.schema_label') }}</vibe:table.cell>
                                    </vibe:table.row>
                                    <vibe:table.row>
                                        <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">description</vibe:table.cell>
                                        <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">string|null</vibe:table.cell>
                                        <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">Opsional</vibe:table.cell>
                                        <vibe:table.cell class="text-muted-foreground">{{ __('docs/select.remote.schema_description') }}</vibe:table.cell>
                                    </vibe:table.row>
                                    <vibe:table.row>
                                        <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">icon</vibe:table.cell>
                                        <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">string|null</vibe:table.cell>
                                        <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">Opsional</vibe:table.cell>
                                        <vibe:table.cell class="text-muted-foreground">{{ __('docs/select.remote.schema_icon') }}</vibe:table.cell>
                                    </vibe:table.row>
                                    <vibe:table.row>
                                        <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">disabled</vibe:table.cell>
                                        <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">bool</vibe:table.cell>
                                        <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">Opsional</vibe:table.cell>
                                        <vibe:table.cell class="text-muted-foreground">{{ __('docs/select.remote.schema_disabled') }}</vibe:table.cell>
                                    </vibe:table.row>
                                </vibe:table.rows>
                            </vibe:table>
                        </div>
                    </div>

                    {{-- 4. Advanced Props --}}
                    <div class="space-y-2 pt-2">
                        <h4 class="text-xs font-semibold uppercase tracking-wider text-muted-foreground">{{ __('docs/select.remote.advanced_title') }}</h4>
                        <p class="text-xs text-muted-foreground">{{ __('docs/select.remote.advanced_desc') }}</p>
                        <vibe:highlightjs language="blade" title="Contoh Penggunaan Props Lanjutan" :code="$advancedBladeCode" />
                    </div>
                </div>
            </section>

            {{-- 11. Form Submission Test --}}
            <section id="pengujian-form" class="space-y-4">
                <div class="space-y-1">
                    <div class="flex items-center gap-2">
                        <h2 class="text-xl font-bold text-foreground">{{ __('docs/select.test.title') }}</h2>
                        <vibe:badge variant="primary" size="sm">Live Controller Test</vibe:badge>
                    </div>
                    <p class="text-sm text-muted-foreground">{!! __('docs/select.test.desc') !!}</p>
                </div>

                <vibe:preview :title="__('docs/select.test.preview_title')">
                    <vibe:preview.code>
                        <vibe:form action="{{ route('docs.form.store') }}" method="POST" class="w-full max-w-lg mx-auto">
                            @csrf
                            <vibe:card>
                                <vibe:card.header>
                                    <h3 class="text-sm sm:text-base font-semibold text-foreground">{{ __('docs/select.test.card_title') }}</h3>
                                    <p class="text-xs text-muted-foreground mt-0.5">{{ __('docs/select.test.card_desc') }}</p>
                                </vibe:card.header>

                                <vibe:card.content class="space-y-4">
                                    <vibe:select name="role" :label="__('docs/select.test.role_label')" :placeholder="__('docs/select.test.role_placeholder')">
                                        <vibe:select.option value="superadmin">{{ __('docs/select.test.role_superadmin') }}</vibe:select.option>
                                        <vibe:select.option value="editor" selected>{{ __('docs/select.test.role_editor') }}</vibe:select.option>
                                        <vibe:select.option value="developer">{{ __('docs/select.test.role_developer') }}</vibe:select.option>
                                    </vibe:select>

                                    <vibe:select.remote name="lead_developer_id" label="Lead Developer (API Remote)" placeholder="Cari dari database pengguna..." :api="route('docs.select.api')" clearable />

                                    <vibe:select name="department" :label="__('docs/select.test.dept_label')" searchable :placeholder="__('docs/select.test.dept_placeholder')">
                                        <vibe:select.option value="engineering" selected>{{ __('docs/select.test.dept_engineering') }}</vibe:select.option>
                                        <vibe:select.option value="design">{{ __('docs/select.test.dept_design') }}</vibe:select.option>
                                        <vibe:select.option value="marketing">{{ __('docs/select.test.dept_marketing') }}</vibe:select.option>
                                        <vibe:select.option value="finance">{{ __('docs/select.test.dept_finance') }}</vibe:select.option>
                                    </vibe:select>

                                    <vibe:select name="frameworks" :label="__('docs/select.test.frameworks_label')" multiple searchable :placeholder="__('docs/select.test.frameworks_placeholder')">
                                        <vibe:select.option value="laravel" selected>Laravel Framework</vibe:select.option>
                                        <vibe:select.option value="vue" selected>Vue.js 3</vibe:select.option>
                                        <vibe:select.option value="react">React.js</vibe:select.option>
                                        <vibe:select.option value="tailwind" selected>Tailwind CSS</vibe:select.option>
                                        <vibe:select.option value="flutter">Flutter SDK</vibe:select.option>
                                    </vibe:select>
                                </vibe:card.content>

                                <vibe:card.footer>
                                    <vibe:button class="w-full" type="submit" variant="primary">
                                        {{ __('docs/select.test.submit_btn') }}
                                    </vibe:button>
                                </vibe:card.footer>
                            </vibe:card>
                        </vibe:form>
                    </vibe:preview.code>

                    <vibe:form action="{{ route('docs.form.store') }}" method="POST" class="w-full max-w-lg mx-auto">
                        @csrf
                        <vibe:card>
                            <vibe:card.header>
                                <h3 class="text-sm sm:text-base font-semibold text-foreground">{{ __('docs/select.test.card_title') }}</h3>
                                <p class="text-xs text-muted-foreground mt-0.5">{{ __('docs/select.test.card_desc') }}</p>
                            </vibe:card.header>

                            <vibe:card.content class="space-y-4">
                                <vibe:select name="role" :label="__('docs/select.test.role_label')" :placeholder="__('docs/select.test.role_placeholder')">
                                    <vibe:select.option value="superadmin">{{ __('docs/select.test.role_superadmin') }}</vibe:select.option>
                                    <vibe:select.option value="editor" selected>{{ __('docs/select.test.role_editor') }}</vibe:select.option>
                                    <vibe:select.option value="developer">{{ __('docs/select.test.role_developer') }}</vibe:select.option>
                                </vibe:select>

                                <vibe:select.remote name="lead_developer_id" label="Lead Developer (API Remote)" placeholder="Cari dari database pengguna..." :api="route('docs.select.api')" clearable />

                                <vibe:select name="department" :label="__('docs/select.test.dept_label')" searchable :placeholder="__('docs/select.test.dept_placeholder')">
                                    <vibe:select.option value="engineering" selected>{{ __('docs/select.test.dept_engineering') }}</vibe:select.option>
                                    <vibe:select.option value="design">{{ __('docs/select.test.dept_design') }}</vibe:select.option>
                                    <vibe:select.option value="marketing">{{ __('docs/select.test.dept_marketing') }}</vibe:select.option>
                                    <vibe:select.option value="finance">{{ __('docs/select.test.dept_finance') }}</vibe:select.option>
                                </vibe:select>

                                <vibe:select name="frameworks" :label="__('docs/select.test.frameworks_label')" multiple searchable :placeholder="__('docs/select.test.frameworks_placeholder')">
                                    <vibe:select.option value="laravel" selected>Laravel Framework</vibe:select.option>
                                    <vibe:select.option value="vue" selected>Vue.js 3</vibe:select.option>
                                    <vibe:select.option value="react">React.js</vibe:select.option>
                                    <vibe:select.option value="tailwind" selected>Tailwind CSS</vibe:select.option>
                                    <vibe:select.option value="flutter">Flutter SDK</vibe:select.option>
                                </vibe:select>
                            </vibe:card.content>

                            <vibe:card.footer>
                                <vibe:button class="w-full" type="submit" variant="primary">
                                    {{ __('docs/select.test.submit_btn') }}
                                </vibe:button>
                            </vibe:card.footer>
                        </vibe:card>
                    </vibe:form>
                </vibe:preview>
            </section>

            {{-- 12. Component Properties Table --}}
            <section id="properti-komponen" class="space-y-6">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/select.props.title') }}</h2>
                </div>

                {{-- vibe:select props --}}
                <div class="space-y-2">
                    <h3 class="text-sm font-semibold text-foreground">{{ __('docs/select.props.main_title') }}</h3>
                    <vibe:table>
                        <vibe:table.header>
                            <vibe:table.column>{{ __('docs/select.props.col_prop') }}</vibe:table.column>
                            <vibe:table.column>{{ __('docs/select.props.col_type') }}</vibe:table.column>
                            <vibe:table.column>{{ __('docs/select.props.col_default') }}</vibe:table.column>
                            <vibe:table.column>{{ __('docs/select.props.col_desc') }}</vibe:table.column>
                        </vibe:table.header>
                        <vibe:table.rows>
                            @php
                                $selectProps = [
        ['name', 'string', 'null', __('docs/select.props_items.name')],
        ['id', 'string', 'auto', __('docs/select.props_items.id')],
        ['label', 'string', 'null', __('docs/select.props_items.label')],
        ['placeholder', 'string', 'Pilih opsi...', __('docs/select.props_items.placeholder')],
        ['value', 'string|array', 'null', __('docs/select.props_items.value')],
        ['size', "'sm'|'md'|'lg'|'xl'", "'md'", __('docs/select.props_items.size')],
        ['variant', "'primary'|'outline'|'filled'|'ghost'", "'primary'", __('docs/select.props_items.variant')],
        ['searchable', 'bool', 'false', __('docs/select.props_items.searchable')],
        ['keyboard', 'bool', 'false', __('docs/select.props_items.keyboard')],
        ['multiple', 'bool', 'false', __('docs/select.props_items.multiple')],
        ['disabled', 'bool', 'false', __('docs/select.props_items.disabled')],
        ['clearable', 'bool', 'false', __('docs/select.props_items.clearable')],
        ['max', 'int|null', 'null', __('docs/select.props_items.max')],
        ['min', 'int|null', 'null', __('docs/select.props_items.min')],
        ['indicator', 'bool', 'true', __('docs/select.props_items.indicator')],
        ['description', 'string', 'null', __('docs/select.props_items.description')],
        ['info', 'string', 'null', __('docs/select.props_items.info')],
        ['error', 'string|bool', 'null', __('docs/select.props_items.error')],
        ['errorName', 'string', 'null', __('docs/select.props_items.errorName')],
        ['wrapperClass', 'string', 'null', __('docs/select.props_items.wrapperClass')],
        ['badgeVariant', 'string', "'secondary'", __('docs/select.props_items.badgeVariant')],
        ['required', 'bool', 'false', __('docs/select.props_items.required')],
    ];
                            @endphp
                            @foreach ($selectProps as [$prop, $type, $default, $desc])
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

                {{-- vibe:select.group props --}}
                <div class="space-y-2">
                    <h3 class="text-sm font-semibold text-foreground">{{ __('docs/select.props.group_title') }}</h3>
                    <vibe:table>
                        <vibe:table.header>
                            <vibe:table.column>{{ __('docs/select.props.col_prop') }}</vibe:table.column>
                            <vibe:table.column>{{ __('docs/select.props.col_type') }}</vibe:table.column>
                            <vibe:table.column>{{ __('docs/select.props.col_default') }}</vibe:table.column>
                            <vibe:table.column>{{ __('docs/select.props.col_desc') }}</vibe:table.column>
                        </vibe:table.header>
                        <vibe:table.rows>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">label</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">string</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">—</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">Nama judul grup kategori.</vibe:table.cell>
                            </vibe:table.row>
                        </vibe:table.rows>
                    </vibe:table>
                </div>

                {{-- vibe:select.option props --}}
                <div class="space-y-2">
                    <h3 class="text-sm font-semibold text-foreground">{{ __('docs/select.props.option_title') }}</h3>
                    <vibe:table>
                        <vibe:table.header>
                            <vibe:table.column>{{ __('docs/select.props.col_prop') }}</vibe:table.column>
                            <vibe:table.column>{{ __('docs/select.props.col_type') }}</vibe:table.column>
                            <vibe:table.column>{{ __('docs/select.props.col_default') }}</vibe:table.column>
                            <vibe:table.column>{{ __('docs/select.props.col_desc') }}</vibe:table.column>
                        </vibe:table.header>
                        <vibe:table.rows>
                            @php
                                $optionProps = [
        ['value', 'string', '— (Wajib)', __('docs/select.props_items.option_value')],
        ['disabled', 'bool', 'false', __('docs/select.props_items.option_disabled')],
        ['selected', 'bool', 'false', __('docs/select.props_items.option_selected')],
    ];
                            @endphp
                            @foreach ($optionProps as [$prop, $type, $default, $desc])
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

                {{-- vibe:select.remote props --}}
                <div class="space-y-2">
                    <h3 class="text-sm font-semibold text-foreground">{{ __('docs/select.remote.props_title') }}</h3>
                    <vibe:table>
                        <vibe:table.header>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/select.props.col_prop') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/select.props.col_type') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/select.props.col_default') }}</vibe:table.column>
                            <vibe:table.column>{{ __('docs/select.props.col_desc') }}</vibe:table.column>
                        </vibe:table.header>
                        <vibe:table.rows>
                            @php
                                $remoteProps = [
                                    ['api', 'string', 'null', 'URL endpoint API target yang mengembalikan array data JSON.'],
                                    ['name', 'string', 'null', 'Nama atribut form input.'],
                                    ['id', 'string', 'null', 'Atribut ID unik elemen select (otomatis dibuat jika kosong).'],
                                    ['value', 'string|int|array|Collection', 'null', 'Nilai ID atau array opsi yang terpilih. Mendukung ID tunggal, array ID (misal: [13, 24]), maupun array/koleksi objek opsi untuk mode edit.'],
                                    ['label', 'string', 'null', 'Teks label yang ditampilkan di atas komponen input.'],
                                    ['description', 'string', 'null', 'Teks deskripsi penjelasan singkat di bawah label.'],
                                    ['placeholder', 'string', 'Pilih opsi...', 'Teks placeholder pada tombol pemicu dropdown.'],
                                    ['searchPlaceholder', 'string', 'Cari opsi...', 'Teks placeholder pada input pencarian.'],
                                    ['size', "'sm'|'md'|'lg'|'xl'", "'md'", 'Ukuran tinggi dan teks komponen select.'],
                                    ['variant', "'primary'|'outline'|'filled'|'flush'|'ghost'", "'primary'", 'Varian gaya visual batas dan latar belakang.'],
                                    ['keyboard', 'bool', 'false', 'Mengaktifkan kontrol navigasi keyboard penuh (panah atas/bawah, Enter, Escape).'],
                                    ['multiple', 'bool', 'false', 'Mengaktifkan mode pemilihan banyak item dengan badge/chip.'],
                                    ['clearable', 'bool', 'false', 'Menampilkan tombol hapus/reset pilihan terpilih.'],
                                    ['disabled', 'bool', 'false', 'Menonaktifkan select input.'],
                                    ['min', 'int|null', 'null', 'Jumlah minimum opsi yang wajib dipertahankan (mode multiple).'],
                                    ['max', 'int|null', 'null', 'Jumlah maksimal opsi yang dapat dipilih (mode multiple).'],
                                    ['placement', "'auto'|'top'|'bottom'", "'auto'", 'Penempatan posisi popover dropdown.'],
                                    ['info', 'string', 'null', 'Teks bantuan informasi di bawah komponen select.'],
                                    ['error', 'string|bool', 'null', 'Pesan error validasi atau flag error.'],
                                    ['errorName', 'string', 'null', 'Kunci nama error session bag Laravel untuk menampilkan pesan error validasi otomatis.'],
                                    ['wrapperClass', 'string', 'null', 'Kelas utility Tailwind tambahan pada elemen pembungkus terluar.'],
                                    ['initialLabel', 'string|array', 'null', 'Teks label yang langsung ditampilkan sebelum API pertama kali dipanggil (string untuk single, array untuk multiple).'],
                                    ['initialAvatar', 'string|array', 'null', 'URL gambar avatar awal yang ditampilkan sebelum opsi dimuat dari endpoint.'],
                                    ['initialIcon', 'string|array', 'null', 'Markup SVG atau teks inisial ikon awal.'],
                                    ['searchParam', 'string', "'q'", 'Nama query parameter yang dikirimkan ke endpoint saat pencarian.'],
                                    ['minChars', 'int', '0', 'Jumlah karakter minimal sebelum request pencarian dikirimkan (0 = langsung fetch saat dropdown dibuka).'],
                                    ['debounce', 'int', '300', 'Waktu tunda debounce dalam milidetik saat mengetik kata kunci.'],
                                    ['headers', 'array', '[]', 'Kustom HTTP Headers tambahan saat memanggil API.'],
                                ];
                            @endphp
                            @foreach ($remoteProps as [$prop, $type, $default, $desc])
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

        </div>

        {{-- Aside Table of Contents --}}
        <aside class="col-span-12 order-1 md:order-2 md:col-span-3 w-full md:sticky md:top-6 group-has-[header.sticky]/docs:md:top-20">
            <vibe:toc selector="#docs-content" />
        </aside>

    </div>

    {{-- Reusable Modal Pengujian $request->all() --}}
    @include('docs.partials.form-test-modal')


</x-docs.layouts.sidebar>
