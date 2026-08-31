<?php

return [
    'title' => 'Directory Structure',
    'badge' => 'Documentation',
    'subtitle' => 'Vibe UI Architecture & File Organization',
    'description' => 'Learn how Vibe UI files and folders are structured within your Laravel project for seamless customization of Blade components, Tailwind CSS styling, JavaScript assets, and multi-language localization.',

    // Sections
    'overview_title' => 'Directory Overview',
    'overview_desc' => 'After running the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">php artisan vibe:install</code> command, Vibe UI files and assets will be placed in your Laravel application directories:',

    'views_title' => '1. Blade Components (resources/views/vibe/)',
    'views_desc' => 'Where all published Vibe UI Blade component view templates reside. You have full control to customize markup, Tailwind styling, and Alpine.js logic according to your design needs.',

    'css_title' => '2. Styling & Theme Tokens (resources/css/vibe/)',
    'css_desc' => 'Contains custom CSS variables for the Design System, Tailwind CSS v4 custom variants, Highlight.js theme styles, and semantic color tokens.',

    'js_title' => '3. JavaScript Assets (resources/js/vibe/)',
    'js_desc' => 'Supporting interactive scripts for components such as theme switchers, syntax highlighters, and frontend interaction helpers.',

    'lang_title' => '4. Languages & Translations (lang/{locale}/vibe/)',
    'lang_desc' => 'Component-level translation files for clean multi-language localization (Indonesian & English).',

    'config_title' => '5. Configuration (config/vibe.php)',
    'config_desc' => 'The main configuration file to customize component tag prefixes, default themes, asset loader options, and component behaviors.',
];
