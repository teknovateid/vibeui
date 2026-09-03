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
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-muted text-muted-foreground">{{ __('docs/select.badge') }}</span>
                    <span class="text-xs text-muted-foreground">{{ __('docs/select.group') }}</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">{{ __('docs/select.title') }}</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    {{ __('docs/select.description') }}
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
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    @foreach (['searchable', 'multiple', 'min', 'max', 'keyboard'] as $f)
                        <span class="px-2 py-0.5 rounded-md bg-muted text-muted-foreground text-[11px] font-mono font-medium border border-border">{{ $f }}</span>
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
                            <div class="space-y-2 p-4 rounded-xl border border-border bg-card/50">
                                <div class="flex items-center justify-between gap-2">
                                    <span class="text-xs font-bold text-foreground">{{ __('docs/select.selected_methods.method1_title') }}</span>
                                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono bg-primary/10 text-primary">value="active"</span>
                                </div>
                                <vibe:select name="demo_status" :label="__('docs/select.selected_methods.method1_label')" :placeholder="__('docs/select.selected_methods.method1_placeholder')" value="active">
                                    <vibe:select.option value="draft">Draft (Konsep)</vibe:select.option>
                                    <vibe:select.option value="active">Active (Dipublikasikan)</vibe:select.option>
                                    <vibe:select.option value="archived">Archived (Diarsipkan)</vibe:select.option>
                                </vibe:select>
                                <p class="text-[11px] text-muted-foreground">Opsi "Active" otomatis terpilih melalui prop <code>value="active"</code>.</p>
                            </div>

                            {{-- Card Metode 2 Single --}}
                            <div class="space-y-2 p-4 rounded-xl border border-border bg-card/50">
                                <div class="flex items-center justify-between gap-2">
                                    <span class="text-xs font-bold text-foreground">{{ __('docs/select.selected_methods.method2_title') }}</span>
                                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono bg-emerald-500/10 text-emerald-600 dark:text-emerald-400">&lt;option selected&gt;</span>
                                </div>
                                <vibe:select name="demo_department" :label="__('docs/select.selected_methods.method2_label')" :placeholder="__('docs/select.selected_methods.method2_placeholder')">
                                    <vibe:select.option value="engineering">Engineering</vibe:select.option>
                                    <vibe:select.option value="design" selected>Product Design</vibe:select.option>
                                    <vibe:select.option value="marketing">Marketing</vibe:select.option>
                                </vibe:select>
                                <p class="text-[11px] text-muted-foreground">Opsi "Product Design" otomatis terpilih melalui atribut <code>selected</code> pada option.</p>
                            </div>
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
                            <div class="space-y-2 p-4 rounded-xl border border-border bg-card/50">
                                <div class="flex items-center justify-between gap-2">
                                    <span class="text-xs font-bold text-foreground">{{ __('docs/select.selected_methods.multi_method1_title') }}</span>
                                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono bg-primary/10 text-primary">:value="['react', 'vue']"</span>
                                </div>
                                <vibe:select name="demo_frontend" :label="__('docs/select.selected_methods.multi_method1_label')" :placeholder="__('docs/select.selected_methods.multi_method1_placeholder')" multiple :value="['react', 'vue']">
                                    <vibe:select.option value="react">React</vibe:select.option>
                                    <vibe:select.option value="vue">Vue.js</vibe:select.option>
                                    <vibe:select.option value="svelte">Svelte</vibe:select.option>
                                    <vibe:select.option value="angular">Angular</vibe:select.option>
                                </vibe:select>
                                <p class="text-[11px] text-muted-foreground">Opsi "React" dan "Vue.js" terpilih melalui array binding <code>:value="['react', 'vue']"</code>.</p>
                            </div>

                            {{-- Card Metode 2 Multiple --}}
                            <div class="space-y-2 p-4 rounded-xl border border-border bg-card/50">
                                <div class="flex items-center justify-between gap-2">
                                    <span class="text-xs font-bold text-foreground">{{ __('docs/select.selected_methods.multi_method2_title') }}</span>
                                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono bg-emerald-500/10 text-emerald-600 dark:text-emerald-400">multiple &lt;option selected&gt;</span>
                                </div>
                                <vibe:select name="demo_backend" :label="__('docs/select.selected_methods.multi_method2_label')" :placeholder="__('docs/select.selected_methods.multi_method2_placeholder')" multiple>
                                    <vibe:select.option value="php" selected>PHP</vibe:select.option>
                                    <vibe:select.option value="laravel" selected>Laravel</vibe:select.option>
                                    <vibe:select.option value="nodejs">Node.js</vibe:select.option>
                                    <vibe:select.option value="python">Python</vibe:select.option>
                                </vibe:select>
                                <p class="text-[11px] text-muted-foreground">Opsi "PHP" dan "Laravel" otomatis terpilih berkat atribut <code>selected</code> pada masing-masing opsi.</p>
                            </div>
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
                        {{-- outline (default) --}}
                        <vibe:select variant="outline" label="Outline" placeholder="Varian outline (default)...">
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

                        {{-- accent --}}
                        <vibe:select variant="accent" label="Accent" placeholder="Varian accent...">
                            <vibe:select.option value="1">Opsi Satu</vibe:select.option>
                            <vibe:select.option value="2">Opsi Dua</vibe:select.option>
                        </vibe:select>
                    </vibe:preview.code>
                    <div class="w-full max-w-sm space-y-4">
                        <vibe:select variant="outline" label="Outline" placeholder="Varian outline (default)...">
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

                        <vibe:select variant="accent" label="Accent" placeholder="Varian accent...">
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
                            <vibe:select.option value="sm1">Pilihan Kecil</vibe:select.option>
                        </vibe:select>

                        <vibe:select size="md" label="Sedang (md - h-9)" placeholder="Ukuran md (default)...">
                            <vibe:select.option value="md1">Pilihan Sedang</vibe:select.option>
                        </vibe:select>

                        <vibe:select size="lg" label="Besar (lg - h-10)" placeholder="Ukuran lg...">
                            <vibe:select.option value="lg1">Pilihan Besar</vibe:select.option>
                        </vibe:select>

                        <vibe:select size="xl" label="Ekstra (xl - h-11)" placeholder="Ukuran xl...">
                            <vibe:select.option value="xl1">Pilihan Ekstra</vibe:select.option>
                        </vibe:select>
                    </vibe:preview.code>
                    <div class="w-full max-w-sm space-y-4">
                        <vibe:select size="sm" label="Kecil (sm - h-8)" placeholder="Ukuran sm...">
                            <vibe:select.option value="sm1">Pilihan Kecil</vibe:select.option>
                        </vibe:select>

                        <vibe:select size="md" label="Sedang (md - h-9)" placeholder="Ukuran md (default)...">
                            <vibe:select.option value="md1">Pilihan Sedang</vibe:select.option>
                        </vibe:select>

                        <vibe:select size="lg" label="Besar (lg - h-10)" placeholder="Ukuran lg...">
                            <vibe:select.option value="lg1">Pilihan Besar</vibe:select.option>
                        </vibe:select>

                        <vibe:select size="xl" label="Ekstra (xl - h-11)" placeholder="Ukuran xl...">
                            <vibe:select.option value="xl1">Pilihan Ekstra</vibe:select.option>
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
                        <vibe:select name="server_slot" label="Alokasi Server" placeholder="Pilih server...">
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

                        <vibe:select name="server_slot" label="Alokasi Server" placeholder="Pilih server...">
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
                        <span class="px-2 py-0.5 rounded text-[10px] font-mono font-medium bg-muted text-muted-foreground border border-border">Tanpa Batasan (Bebas Pilih/Kosongkan)</span>
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
                            <vibe:select name="tech_stack" label="{{ __('docs/select.multiple.searchable_label') }}" placeholder="{{ __('docs/select.multiple.searchable_placeholder') }}" multiple  keyboard searchable searchPlaceholder="Ketik untuk mencari teknologi...">
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
                        <span class="px-2 py-0.5 rounded text-[10px] font-mono font-medium bg-amber-500/10 text-amber-600 dark:text-amber-400 border border-amber-500/20">:min="2" & :max="4" (Terkunci Otomatis)</span>
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

            {{-- 10. Component Properties Table --}}
            <section id="properti-komponen" class="space-y-6">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/select.props.title') }}</h2>
                </div>

                {{-- vibe:select props --}}
                <div class="space-y-2">
                    <h3 class="text-sm font-semibold text-foreground">{{ __('docs/select.props.select_title') }}</h3>
                    <vibe:table>
                        <vibe:table.header>
                            <vibe:table.column>{{ __('docs/select.props.col_prop') }}</vibe:table.column>
                            <vibe:table.column>{{ __('docs/select.props.col_type') }}</vibe:table.column>
                            <vibe:table.column>{{ __('docs/select.props.col_default') }}</vibe:table.column>
                            <vibe:table.column>{{ __('docs/select.props.col_desc') }}</vibe:table.column>
                        </vibe:table.header>
                        <vibe:table.rows>
                            @php
                                $selectProps = [['label', 'string', 'null', 'Label teks di atas komponen select.'], ['name', 'string', 'null', 'Nama atribut form (otomatis fallback ke wire:model).'], ['id', 'string', 'null', 'ID elemen unik untuk aksesibilitas.'], ['placeholder', 'string', '"Pilih opsi..."', 'Teks placeholder saat belum ada item terpilih.'], ['placement', 'string', '"auto"', 'Arah dropdown popover: "auto" (dinamis cerdas), "bottom", atau "top".'], ['keyboard', 'bool', 'false', 'Mengaktifkan navigasi penuh tombol keyboard (Up, Down, Enter, Space, Escape) seperti pada komponen dropdown.'], ['size', 'string', '"md"', 'Ukuran: "sm" (32px), "md" (36px), "lg" (40px), "xl" (44px).'], ['variant', 'string', '"outline"', 'Gaya: "outline", "filled", "flush", "ghost", "accent".'], ['searchable', 'bool', 'false', 'Menampilkan kolom filter pencarian real-time.'], ['searchPlaceholder', 'string', '"Cari opsi..."', 'Placeholder pada kotak pencarian.'], ['disabled', 'bool', 'false', 'Menonaktifkan seluruh komponen select.'], ['error', 'string', 'null', 'Pesan error validasi manual.'], ['errorName', 'string', 'null', 'Kunci error bag spesifik di $errors.'], ['description', 'string', 'null', 'Teks keterangan bantuan di bawah label.'], ['info', 'string', 'null', 'Teks bantuan informasi di bawah select.'], ['wrapperClass', 'string', 'null', 'Class kustom untuk pembungkus kontainer terluar.'], ['multiple', 'bool', 'false', 'Mengizinkan pemilihan lebih dari satu opsi (array value). Ditampilkan dalam bentuk chips yang dapat dihapus.'], ['min', 'int', 'null', 'Jumlah minimum opsi yang wajib dipilih pada mode multiple.'], ['max', 'int', 'null', 'Jumlah maksimum opsi yang dapat dipilih pada mode multiple. Opsi lain otomatis terkunci saat batas tercapai.']];
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
                                $optionProps = [['value', 'mixed', '—', 'Nilai data opsi yang akan disimpan ke model.'], ['label', 'string', 'null', 'Label teks tampilan (fallback ke teks slot).'], ['description', 'string', 'null', 'Keterangan subteks di bawah label opsi.'], ['avatar', 'string', 'null', 'URL gambar thumbnail avatar opsi.'], ['icon', 'string', 'null', 'String markup SVG atau ikon kustom.'], ['disabled', 'bool', 'false', 'Menonaktifkan opsi individual ini.']];
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
            </section>

        </div>

        {{-- Aside Table of Contents --}}
        <aside class="col-span-12 order-1 md:order-2 md:col-span-3 w-full md:sticky md:top-6">
            <vibe:toc selector="#docs-content" />
        </aside>

    </div>
</x-docs.layouts.sidebar>
