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

    {{-- Simple Minimalist Layout Variant --}}
    <div class="min-h-screen flex flex-col justify-center items-center px-4 py-12 sm:px-6 lg:px-8 selection:bg-primary selection:text-primary-foreground">
        <div class="w-full max-w-sm space-y-6">
            {{-- Logo Header --}}
            <div class="text-center">
                <a href="/" wire:navigate class="inline-flex items-center gap-2.5 focus:outline-none focus:ring-2 focus:ring-primary rounded-lg mb-4">
                    <div class="size-10 rounded-xl p-2.5 bg-primary flex items-center justify-center shadow-sm">
                        <img class="size-full" src="{{ asset('vibe/logo/logo.svg') }}" alt="Vibe Logo">
                    </div>
                    <span class="font-bold text-lg tracking-tight text-foreground">{{ config('app.name') }}</span>
                </a>

                @if (!($hideHeader ?? false) && $title)
                    <h1 class="text-2xl font-bold tracking-tight text-foreground">{{ $title }}</h1>
                @endif
                @if (!($hideHeader ?? false) && $description)
                    <p class="mt-1 text-xs sm:text-sm text-muted-foreground">{{ $description }}</p>
                @endif
            </div>

            @if ($status)
                <vibe:card.alert variant="success" size="sm" :description="$status" animation="pop" />
            @endif

            <div class="mt-4">
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
