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
<body class="font-medium font-inter antialiased bg-vibe-50 dark:bg-vibe-950 text-vibe-950 dark:text-vibe-50">
    {{ $slot }}
    <vibe:alert position="top-right" />
    <vibe:toast position="top-right" />
    @livewireScripts
    @stack('body')
</body>
</html>
