<?php

return [
    'badge' => 'Layout Architecture',
    'subtitle' => 'Per-Layout Assets & Complete Customization',
    'title' => 'Layouts & Scoped Assets',
    'description' => 'Every panel and auth layout in Vibe UI owns its own scoped CSS & JS bundle via [data-vibe-layout], customizable Props, Named Slots, and CSS variables without global configuration bloat.',

    'sections' => [
        'architecture' => [
            'title' => '1. Built-In Panel & Auth Layouts',
            'desc' => 'Each built-in layout ships distinct visual framing and isolated styling so switching layouts or building new ones stays conflict-free across Livewire wire:navigate.',
            'preview_demo' => 'Open Live Demo',
            'cards' => [
                'sidebar' => [
                    'title' => 'Modern Sidebar (sidebar)',
                    'tag' => 'Inset / Floating',
                    'desc' => 'Elevated inset canvas on md+, frosted sticky header, rounded pill active items, and icon-rail tooltips.',
                ],
                'sidebar_classic' => [
                    'title' => 'Classic Sidebar (sidebar-classic)',
                    'tag' => 'Flush Admin',
                    'desc' => 'Edge-to-edge traditional flat admin grid, sharp borders, compact nav density, and left accent bar indicator.',
                ],
                'topbar' => [
                    'title' => 'Horizontal Topbar (topbar)',
                    'tag' => 'Responsive Navbar',
                    'desc' => 'Single-DOM responsive header that measures overflow automatically and degrades to a native popover menu.',
                ],
            ],
        ],
        'props_slots' => [
            'title' => '2. Props, CSS Variables & Named Slots',
            'desc' => 'Override layout shell, header stickiness, sidebar dimensions, navigation variants, extra stylesheets/scripts, or inject bespoke slots on any page.',
        ],
        'custom_panel' => [
            'title' => '3. Generating Isolated Panel Layouts & Assets',
            'desc' => 'Use Artisan CLI flags to scaffold a panel layout group or publish dedicated per-panel CSS/JS overrides, and add new custom layouts dynamically.',
        ],
    ],

    'demo' => [
        'title' => 'Live Layout Switcher Demo',
        'subtitle' => 'Previewing layout style: :style',
        'back_to_docs' => 'Back to Layout Docs',
        'switch_hint' => 'Switch active layout below to inspect its dedicated CSS, JS, and structural shell in real time:',
        'sample_card_title' => 'Scoped Shell Inspection',
        'sample_card_desc' => 'Notice how root spacing, border radius, header behavior, and navigation structure transform independently without leaking styles across wire:navigate.',
    ],
];
