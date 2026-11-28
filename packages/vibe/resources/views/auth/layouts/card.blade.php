@props([
    'title' => null,
    'description' => null,
    'status' => null,
    'hideHeader' => false,
    'maxWidth' => '28rem',
    'surface' => 'elevated',
    'backdropPattern' => 'radial',
    'styles' => [],
    'scripts' => [],
    'cssVars' => [],
    'includeDefaultAssets' => true,
])

@php
    $resolvedCssVars = array_merge(
        array_filter(['--vibe-auth-max-width' => $maxWidth], static fn ($v) => $v !== null && $v !== ''),
        is_array($cssVars) ? $cssVars : []
    );
    $cssVarsStyle = \Teknovate\VibeUi\Vibe::cssVarsStyle($resolvedCssVars);
    $resolvedAssetTags = \Teknovate\VibeUi\Vibe::renderAssetTags($styles, $scripts);
@endphp

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
    @if ($includeDefaultAssets)
        @vite(['resources/css/vibe/layouts/auth-card.css', 'resources/js/vibe/layouts/auth-card.js'])
    @endif
    @if ($resolvedAssetTags !== '')
        {!! $resolvedAssetTags !!}
    @endif
    <script>window.VibeCommonI18n = @js(__('vibe/common'));</script>
    @if (config('passkeys.enabled', true))
        @vite(['resources/js/vibe/passkeys.js'])
    @endif
    @if (config('vibe.auth.qr_login.enabled', true))
        @vite(['resources/js/vibe/qr-login.js'])
    @endif
    @livewireStyles
    @stack('head')
    @isset($head)
        {{ $head }}
    @endisset
</head>

<body class="font-medium font-sans antialiased bg-background text-foreground selection:bg-primary selection:text-primary-foreground vibe-scrollbar">
    <div
        data-vibe-layout="auth-card"
        data-vibe-layout-group="auth"
        data-surface="{{ $surface }}"
        data-backdrop-pattern="{{ $backdropPattern }}"
        @if ($cssVarsStyle !== '') style="{{ $cssVarsStyle }}" @endif
        class="min-h-dvh flex flex-col justify-center items-center px-4 py-12 sm:px-6 lg:px-8 selection:bg-primary selection:text-primary-foreground"
    >
        <div data-vibe-auth-container class="w-full space-y-6">
            {{-- Brand Header --}}
            <div class="text-center">
                @isset($brand)
                    {{ $brand }}
                @else
                    <a href="/" wire:navigate class="inline-flex items-center gap-2.5 focus:outline-none focus:ring-2 focus:ring-primary rounded-lg mb-3">
                        <div class="size-10 rounded-xl bg-primary flex items-center justify-center shadow-sm p-2.5">
                            <img class="size-full" src="{{ asset('vibe/logo/logo.svg') }}" alt="Vibe Logo">
                        </div>
                        <span class="font-bold text-xl tracking-tight text-foreground">{{ config('app.name') }}</span>
                    </a>
                @endisset
            </div>

            {{-- Elevated Card Container --}}
            <vibe:card data-vibe-auth-card :variant="$surface" class="p-6 sm:p-8 rounded-2xl border border-border/80 shadow-sm bg-card space-y-6">
                @isset($header)
                    {{ $header }}
                @elseif (!($hideHeader ?? false) && ($title || $description))
                    <div class="space-y-1">
                        @if ($title)
                            <h1 class="text-xl font-bold tracking-tight text-card-foreground">{{ $title }}</h1>
                        @endif
                        @if ($description)
                            <p class="text-xs sm:text-sm text-muted-foreground">{{ $description }}</p>
                        @endif
                    </div>
                @endisset

                @if ($status)
                    <vibe:card.alert variant="success" size="sm" :description="$status" animation="pop" />
                @endif

                <main id="vibe-main-content">
                    {{ $slot }}
                </main>
            </vibe:card>

            {{-- Card Layout Footer Link --}}
            <div class="text-center text-xs text-muted-foreground">
                @isset($footer)
                    {{ $footer }}
                @else
                    <span>&copy; {{ date('Y') }} {{ config('app.name', 'Teknovate') }}. All rights reserved.</span>
                @endisset
            </div>
        </div>
    </div>

    {{-- System Alerts & Toasts --}}
    <vibe:alert position="top-right" />
    <vibe:toast position="top-right" />

    @livewireScripts
    @stack('body')
    @isset($body)
        {{ $body }}
    @endisset
</body>
</html>
