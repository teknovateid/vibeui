<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <script>
        window.VIBE_PREFIX = '{{ config("vibe.prefix", "vibe") }}';
    </script>
    <script src="{{ asset('vibe/theme-init.js') }}" data-navigate-track="reload"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @stack('head')
</head>
<body class="font-medium font-inter antialiased bg-vibe-50 dark:bg-vibe-950 text-black dark:text-white">
    {{ $slot }}
    
        <vibe:alert position="top-right" />
        <vibe:toast position="bottom-right" />
    
    @livewireScripts
    @stack('body')
</body>
</html>
