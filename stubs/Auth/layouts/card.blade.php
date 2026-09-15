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

    {{-- Global Theme Toggle floating in top-right --}}
    <div class="fixed top-4 right-4 z-50 flex items-center gap-2" x-data="{
        isDark: document.documentElement.classList.contains('dark'),
        toggle(e) {
            window.VibeTheme ? window.VibeTheme.toggle(e) : document.documentElement.classList.toggle('dark');
        }
    }" @vibe-theme-changed.window="isDark = document.documentElement.classList.contains('dark')">
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

    {{-- Elevated Card Layout --}}
    <div class="min-h-screen flex flex-col justify-center items-center px-4 py-12 sm:px-6 lg:px-8">
        <div class="w-full max-w-md space-y-6">
            {{-- Brand Header --}}
            <div class="text-center">
                <a href="/" wire:navigate class="inline-flex items-center gap-2.5 focus:outline-none focus:ring-2 focus:ring-primary rounded-lg mb-3">
                    <div class="size-10 rounded-2xl bg-primary flex items-center justify-center shadow-sm">
                        <svg class="size-5 text-primary-foreground" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13 2L3 14H12L11 22L21 10H12L13 2Z" fill="currentColor" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <span class="font-bold text-xl tracking-tight text-foreground">{{ config('app.name', 'Vibe UI') }}</span>
                </a>
            </div>

            {{-- Elevated Card Container --}}
            <vibe:card variant="elevated" class="p-6 sm:p-8 rounded-2xl border border-border/80 shadow-sm bg-card space-y-6">
                @if ($title || $description)
                    <div class="space-y-1">
                        @if ($title)
                            <h1 class="text-xl font-bold tracking-tight text-card-foreground">{{ $title }}</h1>
                        @endif
                        @if ($description)
                            <p class="text-xs sm:text-sm text-muted-foreground">{{ $description }}</p>
                        @endif
                    </div>
                @endif

                @if ($status)
                    <vibe:card.alert variant="success" size="sm" :description="$status" />
                @endif

                <div>
                    {{ $slot }}
                </div>
            </vibe:card>

            {{-- Card Layout Footer Link --}}
            <div class="text-center text-xs text-muted-foreground">
                <span>&copy; {{ date('Y') }} {{ config('app.name', 'Teknovate') }}. All rights reserved.</span>
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
