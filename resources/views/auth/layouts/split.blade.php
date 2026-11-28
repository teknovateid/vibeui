@props([
    'title' => null,
    'description' => null,
    'status' => null,
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" translate="no">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google" content="notranslate">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ ($title ? $title . ' — ' : '') . config('app.name', 'Vibe UI') }}</title>

    @vibeStyles
    @stack('seo')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>window.VibeCommonI18n = @js(__('vibe/common'));</script>
    @if (config('passkeys.enabled', true))
        @vite(['resources/js/vibe/passkeys.js'])
    @endif
    @if (config('vibe.auth.qr_login.enabled', true))
        @vite(['resources/js/vibe/qr-login.js'])
    @endif
    @livewireStyles
    @stack('head')
</head>

<body class="font-medium font-sans antialiased bg-background text-foreground selection:bg-primary selection:text-primary-foreground vibe-scrollbar">

    {{-- Split Screen Layout Variant --}}
    <div class="min-h-screen w-full grid lg:grid-cols-2">
        {{-- Left Column: Visual Branding --}}
        <div class="relative hidden lg:flex flex-col justify-between p-12 xl:p-16 bg-background text-foreground border-r border-border/80 overflow-hidden select-none">
            <div class="pointer-events-none absolute -top-32 -left-32 size-96 rounded-full bg-primary/25 blur-[120px]"></div>
            <div class="pointer-events-none absolute -bottom-32 -right-32 size-96 rounded-full bg-primary/15 blur-[120px]"></div>
            <div class="relative z-10 flex items-center gap-3">
                <a href="/" wire:navigate class="flex items-center gap-2.5 focus:outline-none focus:ring-2 focus:ring-primary rounded-lg">
                    <div class="size-10 rounded-xl bg-primary flex items-center justify-center shadow-sm p-2.5">
                        <img class="size-full" src="{{ asset('vibe/logo/logo.svg') }}" alt="Vibe Logo">
                    </div>
                    <span class="font-bold text-lg tracking-tight">{{ config('app.name') }}</span>
                </a>
            </div>

            {{-- Center Quote / Value Proposition --}}
            <div class="relative z-10 max-w-md my-auto py-12">
                <vibe:badge class="rounded-full">
                    <span class="size-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                    {{ __('auth/layout.badge') }}
                </vibe:badge>
                <h2 class="text-3xl xl:text-4xl font-extrabold tracking-tight leading-snug">
                    {{ __('auth/layout.headline') }}
                </h2>
                <p class="mt-4 text-sm text-muted-foreground leading-relaxed">
                    {{ __('auth/layout.subheadline') }}
                </p>
            </div>

            {{-- Footer Info --}}
            <div class="relative z-10 flex items-center justify-between text-xs text-muted-foreground">
                <span>&copy; {{ date('Y') }} {{ config('app.name', 'Teknovate') }}. {{ __('auth/layout.rights_reserved') }}</span>
                <div class="flex items-center gap-4">
                    <a href="https://vibeui.teknovate.co.id" wire:navigate class="hover:text-muted-foreground/60 transition-colors">{{ __('auth/layout.documentation') }}</a>
                    <span class="text-muted-foreground">&bull;</span>
                    <a href="https://github.com/teknovateid/vibeui" target="_blank" rel="noopener noreferrer" class="hover:text-muted-foreground/60 transition-colors">{{ __('auth/layout.github') }}</a>
                </div>
            </div>
        </div>

        {{-- Right Column: Form Container --}}
        <div class="flex flex-col justify-center items-center px-4 py-12 sm:px-8 lg:px-12 xl:px-16 min-h-screen">
            <div class="w-full max-w-sm space-y-6">
                {{-- Mobile Brand Logo --}}
                <div class="lg:hidden flex items-center justify-center mb-6">
                    <a href="/" wire:navigate class="flex items-center gap-2">
                        <div class="size-8 rounded-xl bg-primary flex items-center justify-center shadow-xs">
                            <svg class="size-4 text-primary-foreground" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13 2L3 14H12L11 22L21 10H12L13 2Z" fill="currentColor" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <span class="font-bold text-base tracking-tight text-foreground">{{ config('app.name', 'Vibe UI') }}</span>
                    </a>
                </div>

                @if (!($hideHeader ?? false) && ($title || $description))
                    <div class="text-left space-y-1">
                        @if ($title)
                            <h1 class="text-2xl font-bold tracking-tight text-foreground">{{ $title }}</h1>
                        @endif
                        @if ($description)
                            <p class="text-xs sm:text-sm text-muted-foreground">{{ $description }}</p>
                        @endif
                    </div>
                @endif

                @if ($status)
                    <vibe:card.alert variant="success" size="sm" :description="$status" animation="pop" />
                @endif

                {{ $slot }}
            </div>
        </div>
    </div>

    {{-- System Alerts & Toasts --}}
    <vibe:alert position="top-right" />
    <vibe:toast position="top-right" />

    @livewireScripts
    @stack('body')
</body>
</html>
