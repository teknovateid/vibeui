@props([
    'title' => null,
    'description' => null,
    'status' => null,
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ ($title ? $title . ' — ' : '') . config('app.name', 'Vibe UI') }}</title>

    @vibeStyles
    @stack('seo')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @if (config('passkeys.enabled', true))
        @vite(['resources/js/vibe/passkeys.js'])
    @endif
    @livewireStyles
    @stack('head')
</head>

<body class="font-medium font-sans antialiased bg-background text-foreground selection:bg-primary selection:text-primary-foreground vibe-scrollbar">

    {{-- Global Theme Toggle + Language Switcher --}}
    <div class="fixed top-4 right-4 z-50 flex items-center gap-2" x-data="{
        isDark: document.documentElement.classList.contains('dark'),
        toggle(e) {
            window.VibeTheme ? window.VibeTheme.toggle(e) : document.documentElement.classList.toggle('dark');
        }
    }" @vibe-theme-changed.window="isDark = document.documentElement.classList.contains('dark')">
        {{-- Language Switcher --}}
        <div class="relative" x-data="{ open: false }" @click.outside="open = false">
            <button type="button" @click="open = !open" class="inline-flex items-center justify-center size-8 rounded-lg border border-border/80 bg-card/80 backdrop-blur-sm text-foreground/80 hover:text-foreground shadow-2xs transition-colors cursor-pointer focus:outline-none focus-visible:ring-2 focus-visible:ring-ring" :title="'{{ __('auth/language.switch') }}'" aria-label="{{ __('auth/language.switch') }}">
                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10" />
                    <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z" />
                    <path d="M2 12h20" />
                </svg>
            </button>
            <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute right-0 mt-1.5 w-36 rounded-xl border border-border bg-card shadow-md z-50 overflow-hidden">
                <a href="{{ route('locale.switch', 'id') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs font-medium transition-colors {{ app()->getLocale() === 'id' ? 'text-primary bg-primary/8 font-semibold' : 'text-foreground/80 hover:bg-muted/50 hover:text-foreground' }}">
                    <span class="text-base leading-none">🇮🇩</span>
                    {{ __('auth/language.id') }}
                    @if(app()->getLocale() === 'id')
                        <svg class="size-3 ml-auto text-primary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                    @endif
                </a>
                <a href="{{ route('locale.switch', 'en') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs font-medium transition-colors {{ app()->getLocale() === 'en' ? 'text-primary bg-primary/8 font-semibold' : 'text-foreground/80 hover:bg-muted/50 hover:text-foreground' }}">
                    <span class="text-base leading-none">🇺🇸</span>
                    {{ __('auth/language.en') }}
                    @if(app()->getLocale() === 'en')
                        <svg class="size-3 ml-auto text-primary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                    @endif
                </a>
            </div>
        </div>
        {{-- Theme Toggle --}}
        <button type="button" @click="toggle($event)" class="inline-flex items-center justify-center size-8 rounded-lg border border-border/80 bg-card/80 backdrop-blur-sm text-foreground/80 hover:text-foreground shadow-2xs transition-colors cursor-pointer focus:outline-none focus-visible:ring-2 focus-visible:ring-ring" title="Toggle theme" aria-label="Toggle theme">
            <svg x-show="!isDark" class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z" />
            </svg>
            <svg x-show="isDark" x-cloak class="size-4 text-amber-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="4" />
                <path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41" />
            </svg>
        </button>
    </div>

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
