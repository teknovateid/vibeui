<?php

return [
    'title' => 'Vibe UI Installation',
    'badge' => 'Documentation',
    'subtitle' => 'Laravel 11+ / 12+ / 13+ & Tailwind CSS v4',
    'description' => 'Learn how to install and integrate Vibe UI into your Laravel application to accelerate building modern and elegant user interfaces.',

    'steps' => [
        'step_1' => [
            'title' => 'Install Package via Composer',
            'desc' => 'Run the Composer command in your terminal to add the Vibe UI library to your project dependencies:',
        ],
        'step_2' => [
            'title' => 'Publish Assets & Configuration',
            'desc' => 'Use the built-in Vibe UI Artisan command to publish configuration files, CSS custom variants, and helper scripts:',
        ],
        'step_3' => [
            'title' => 'Configure Tailwind CSS v4',
            'desc' => 'Ensure your primary CSS file imports Tailwind CSS and the Vibe UI custom variants:',
        ],
        'step_4' => [
            'title' => 'Setup Base Layout Template',
            'desc' => 'Include the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">@vibeStyles</code> directive in your <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;head&gt;</code> section for anti-FOUC dark mode initialization:',
        ],
        'step_5' => [
            'title' => 'Start Using Components',
            'desc' => 'Invoke Vibe UI components using the concise custom tag syntax <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:...&gt;</code> directly inside your Blade templates:',
            'btn_save' => 'Save Changes',
            'btn_cancel' => 'Cancel',
        ],
    ],
];
