@props([
    'title' => null,
    'description' => null,
    'status' => null,
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ ($title ? $title . ' — ' : '') . config('app.name', 'Vibe UI') }}</title>

    @vibeStyles
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/vibe/passkeys.js'])
    @livewireStyles
    @stack('head')
</head>

<body class="min-h-full flex flex-col font-sans antialiased bg-background text-foreground selection:bg-primary selection:text-primary-foreground vibe-scrollbar">

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
                    Next-Gen Blade UI Kit
                </vibe:badge>
                <h2 class="text-3xl xl:text-4xl font-extrabold tracking-tight leading-snug">
                    Modern, accessible, & reactive components for Laravel.
                </h2>
                <p class="mt-4 text-sm text-muted-foreground leading-relaxed">
                    Inspired by the clean minimalism of Flux UI, supercharged with Livewire, Tailwind CSS v4, and first-class developer experience.
                </p>
            </div>

            {{-- Footer Info --}}
            <div class="relative z-10 flex items-center justify-between text-xs text-muted-foreground">
                <span>&copy; {{ date('Y') }} {{ config('app.name', 'Teknovate') }}. All rights reserved.</span>
                <div class="flex items-center gap-4">
                    <a href="https://vibeui.teknovate.co.id" wire:navigate class="hover:text-muted-foreground/60 transition-colors">Documentation</a>
                    <span class="text-muted-foreground">&bull;</span>
                    <a href="https://github.com/teknovateid/vibeui" target="_blank" rel="noopener noreferrer" class="hover:text-muted-foreground/60 transition-colors">GitHub</a>
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
                    <vibe:card.alert variant="success" size="sm" :description="$status" />
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
