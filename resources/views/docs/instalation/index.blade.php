<x-docs.layouts.sidebar>
    <vibe:seo :title="__('docs/instalation.title')" :description="__('docs/instalation.description')" schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => __('docs/instalation.title'), 'url' => '/docs/instalation']
    ]" />

    <div class="mx-auto max-w-6xl space-y-10">
        <!-- Page Header -->
        <div class="space-y-2">
            <div class="flex items-center gap-2">
                <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-muted text-muted-foreground">
                    {{ __('docs/instalation.badge') }}
                </span>
                <span class="text-xs text-muted-foreground">{{ __('docs/instalation.subtitle') }}</span>
            </div>
            <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">
                {{ __('docs/instalation.title') }}
            </h1>
            <p class="text-base text-muted-foreground leading-relaxed">
                {{ __('docs/instalation.description') }}
            </p>
        </div>

        <!-- Step 1: Install Package -->
        <section class="space-y-4">
            <div class="flex items-center gap-3">
                <div class="flex size-7 items-center justify-center rounded-lg bg-primary text-primary-foreground text-xs font-bold shrink-0">
                    1
                </div>
                <h2 class="text-xl font-bold text-foreground">
                    {{ __('docs/instalation.step_1_title') }}
                </h2>
            </div>
            <p class="text-sm text-muted-foreground">
                {{ __('docs/instalation.step_1_desc') }}
            </p>
            <vibe:highlightjs language="bash" title="Terminal" code="composer require teknovate/vibe-ui" />
        </section>

        <!-- Step 2: Publish Assets & Config -->
        <section class="space-y-4">
            <div class="flex items-center gap-3">
                <div class="flex size-7 items-center justify-center rounded-lg bg-primary text-primary-foreground text-xs font-bold shrink-0">
                    2
                </div>
                <h2 class="text-xl font-bold text-foreground">
                    {{ __('docs/instalation.step_2_title') }}
                </h2>
            </div>
            <p class="text-sm text-muted-foreground">
                {{ __('docs/instalation.step_2_desc') }}
            </p>
            <vibe:highlightjs>
                php artisan vibe:install
            </vibe:highlightjs>
        </section>

        <!-- Step 3: Configure Tailwind CSS -->
        <section class="space-y-4">
            <div class="flex items-center gap-3">
                <div class="flex size-7 items-center justify-center rounded-lg bg-primary text-primary-foreground text-xs font-bold shrink-0">
                    3
                </div>
                <h2 class="text-xl font-bold text-foreground">
                    {{ __('docs/instalation.step_3_title') }}
                </h2>
            </div>
            <p class="text-sm text-muted-foreground">
                {{ __('docs/instalation.step_3_desc') }}
            </p>
            <vibe:highlightjs language="css" title="resources/css/app.css" :lineNumbers="true">
                @import "tailwindcss";
                @import "./vibe/custom-variant.css";
            </vibe:highlightjs>
        </section>

        <!-- Step 4: Setup Base Layout -->
        <section class="space-y-4">
            <div class="flex items-center gap-3">
                <div class="flex size-7 items-center justify-center rounded-lg bg-primary text-primary-foreground text-xs font-bold shrink-0">
                    4
                </div>
                <h2 class="text-xl font-bold text-foreground">
                    {{ __('docs/instalation.step_4_title') }}
                </h2>
            </div>
            <p class="text-sm text-muted-foreground">
                {!! __('docs/instalation.step_4_desc') !!}
            </p>
            @php
                $baseLayoutCode = <<<'HTML'
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @stack('seo')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @vibeStyles
    @livewireStyles
    @stack('head')
</head>

<body class="bg-background text-foreground vibe-scrollbar font-medium font-sans antialiased">
    {{ $slot }}

    <vibe:alert position="top-right" />
    <vibe:toast position="top-right" />
    @livewireScripts
    @stack('body')
</body>

</html>
HTML;
            @endphp
            <vibe:highlightjs language="html" title="resources/views/components/layouts/base.blade.php" :lineNumbers="true" :code="$baseLayoutCode" />
        </section>

        <!-- Step 5: Ready to Use Components -->
        <section class="space-y-4">
            <div class="flex items-center gap-3">
                <div class="flex size-7 items-center justify-center rounded-lg bg-primary text-primary-foreground text-xs font-bold shrink-0">
                    5
                </div>
                <h2 class="text-xl font-bold text-foreground">
                    {{ __('docs/instalation.step_5_title') }}
                </h2>
            </div>
            <p class="text-sm text-muted-foreground">
                {!! __('docs/instalation.step_5_desc') !!}
            </p>
            @php
                $componentsExampleCode = <<<'HTML'
<div class="p-6 space-y-4">
    <!-- Primary Button -->
    <vibe:button variant="primary">
        Save Changes
    </vibe:button>

    <!-- Outline Button -->
    <vibe:button variant="outline">
        Cancel
    </vibe:button>

    <!-- Syntax Highlighter -->
    <vibe:highlightjs language="php" title="Controller.php">
        public function index()
        {
            return view('dashboard');
        }
    </vibe:highlightjs>
</div>
HTML;
            @endphp
            <vibe:highlightjs language="html" title="resources/views/example.blade.php" :lineNumbers="true" :code="$componentsExampleCode" />
        </section>
    </div>
</x-docs.layouts.sidebar>
