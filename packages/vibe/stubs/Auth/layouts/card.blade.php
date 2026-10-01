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
    <div class="fixed top-4 right-4 z-50 flex items-center gap-2" x-data="{
        isDark: document.documentElement.classList.contains('dark'),
        toggle(e) {
            window.VibeTheme ? window.VibeTheme.toggle(e) : document.documentElement.classList.toggle('dark');
        }
    }" @vibe-theme-changed.window="isDark = document.documentElement.classList.contains('dark')">
        <div class="relative" x-data="{ open: false }" @click.outside="open = false">
            <button type="button" @click="open = !open" class="inline-flex items-center justify-center size-8 rounded-lg border border-border/80 bg-card/80 backdrop-blur-sm text-foreground/80 hover:text-foreground shadow-2xs transition-colors cursor-pointer focus:outline-none focus-visible:ring-2 focus-visible:ring-ring" :title="'{{ __('auth/language.switch') }}'" aria-label="{{ __('auth/language.switch') }}">
                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/>
                    <ellipse cx="12" cy="12" rx="4" ry="10"/>
                    <path d="M2 12h20"/>
                </svg>
            </button>
            <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute right-0 mt-1.5 w-36 rounded-xl border border-border bg-card shadow-md z-50 overflow-hidden">
                @php
                    $supportedLocales = [
                        'id' => ['flag' => '🇮🇩', 'label' => __('auth/language.id')],
                        'en' => ['flag' => '🇺🇸', 'label' => __('auth/language.en')],
                    ];
                    $activeLocale = app()->getLocale();
                @endphp
                @foreach ($supportedLocales as $code => $loc)
                    @php $isActive = ($activeLocale === $code); @endphp
                    <a href="{{ route('locale.switch', $code) }}" class="flex items-center gap-2.5 px-3 py-2 text-xs font-medium transition-colors {{ $isActive ? 'text-primary bg-primary/8 font-semibold' : 'text-foreground/80 hover:bg-muted/50 hover:text-foreground' }}">
                        <span class="text-base leading-none">{{ $loc['flag'] }}</span>
                        {{ $loc['label'] }}
                        @if($isActive)
                            <svg class="size-3 ml-auto text-primary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 13l4 4L19 7"/></svg>
                        @endif
                    </a>
                @endforeach
            </div>
        </div>
        {{-- Theme Toggle --}}
        <button type="button" @click="toggle($event)" class="inline-flex items-center justify-center size-8 rounded-lg border border-border/80 bg-card/80 backdrop-blur-sm text-foreground/80 hover:text-foreground shadow-2xs transition-colors cursor-pointer focus:outline-none focus-visible:ring-2 focus-visible:ring-ring" title="Toggle theme" aria-label="Toggle theme">
            <svg x-show="!isDark" class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 22C17.523 22 22 17.523 22 12c0-.463-.693-.539-.933-.143C19.929 13.74 17.862 15 15.5 15 11.91 15 9 12.09 9 8.5c0-2.362 1.26-4.429 3.143-5.567.396-.24.32-.933-.143-.933C6.477 2 2 6.477 2 12c0 5.523 4.477 10 10 10Z"/>
            </svg>
            <svg x-show="isDark" x-cloak class="size-4 text-amber-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="5"/>
                <path d="M12 2v2M12 20v2M4 12H2M22 12h-2M19.78 4.22l-2.22 2.03M4.22 4.22l2.22 2.03M6.44 17.56l-2.22 2.22M19.78 19.78l-2.22-2.22"/>
            </svg>
        </button>
    </div>

    <div class="min-h-screen flex flex-col justify-center items-center px-4 py-12 sm:px-6 lg:px-8 selection:bg-primary selection:text-primary-foreground">
        <div class="w-full max-w-md space-y-6">
            {{-- Brand Header --}}
            <div class="text-center">
                <a href="/" wire:navigate class="inline-flex items-center gap-2.5 focus:outline-none focus:ring-2 focus:ring-primary rounded-lg mb-3">
                    <div class="size-10 rounded-xl bg-primary flex items-center justify-center shadow-sm p-2.5">
                        <img class="size-full" src="{{ asset('vibe/logo/logo.svg') }}" alt="Vibe Logo">
                    </div>
                    <span class="font-bold text-xl tracking-tight text-foreground">{{ config('app.name') }}</span>
                </a>
            </div>

            {{-- Elevated Card Container --}}
            <vibe:card variant="elevated" class="p-6 sm:p-8 rounded-2xl border border-border/80 shadow-sm bg-card space-y-6">
                @if (!($hideHeader ?? false) && ($title || $description))
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
                    <vibe:card.alert variant="success" size="sm" :description="$status" animation="pop" />
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
