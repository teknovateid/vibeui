<?php

return [
    'title' => 'Input',
    'badge' => 'Component',
    'group' => 'Form & Input',
    'description' => 'Modern and flexible text input component. Supports 5 visual variants, 4 sizes, leading/trailing icons, prefix/suffix text, error & disabled states, and full Livewire wire:model integration.',

    // Section 1: Basic Usage
    'basic_usage' => [
        'title' => 'Basic Usage',
        'desc' => 'Use the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:input&gt;</code> tag to create an input with an integrated label. The <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">name</code> prop automatically syncs with <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">id</code> and Laravel validation.',
        'preview_title' => 'Basic Input',
        'label' => 'Full Name',
        'placeholder' => 'Enter your full name...',
    ],

    // Section 2: Variants
    'variants' => [
        'title' => 'Visual Variants',
        'desc' => 'The <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">variant</code> prop controls the visual style of the input. 5 choices are available for various design contexts.',
        'preview_title' => 'Input Visual Variants',
        'primary' => [
            'label' => 'Primary (Default)',
            'placeholder' => 'Default variant with primary focus ring...',
        ],
        'outline' => [
            'label' => 'Outline',
            'placeholder' => 'Neutral border variant...',
        ],
        'filled' => [
            'label' => 'Filled',
            'placeholder' => 'Solid background look...',
        ],
        'flush' => [
            'label' => 'Flush',
            'placeholder' => 'Bottom border line only...',
        ],
        'ghost' => [
            'label' => 'Ghost',
            'placeholder' => 'Transparent background...',
        ],
    ],

    // Section 3: Sizes
    'sizes' => [
        'title' => 'Sizes',
        'desc' => '4 size choices available: <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">sm</code> (32px), <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">md</code> (36px, default), <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">lg</code> (40px), and <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">xl</code> (44px).',
        'preview_title' => 'Input Sizes',
        'sm' => [
            'label' => 'Small (sm)',
            'placeholder' => 'Height 32px, text-xs...',
        ],
        'md' => [
            'label' => 'Medium (md)',
            'placeholder' => 'Height 36px, text-sm...',
        ],
        'lg' => [
            'label' => 'Large (lg)',
            'placeholder' => 'Height 40px, text-sm...',
        ],
        'xl' => [
            'label' => 'Extra Large (xl)',
            'placeholder' => 'Height 44px, text-base...',
        ],
    ],

    // Section 4: Icons & Addons
    'icons_addons' => [
        'title' => 'Icons & Addons',
        'desc' => 'Use the slot <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;x-slot:icon&gt;</code> for the left side and <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;x-slot:trailingIcon&gt;</code> for the right side. Use the props <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">prefix</code> / <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">suffix</code> for static text.',
        'preview_title' => 'Icons & Addons',
        'search' => [
            'label' => 'Quick Search',
            'placeholder' => 'Search products, articles, or users...',
        ],
        'price' => [
            'label' => 'Unit Price',
            'placeholder' => '0.00',
        ],
        'website' => [
            'label' => 'Store Subdomain',
            'placeholder' => 'store-name',
        ],
    ],

    // Section 5: Pill
    'pill' => [
        'title' => 'Pill Style',
        'desc' => 'Use the Tailwind class <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">rounded-full</code> to create an input with fully rounded corners, perfect for search inputs.',
        'preview_title' => 'Pill Style Input',
        'placeholder' => 'Type search keywords...',
    ],

    // Section 6: Helper & Description
    'helper' => [
        'title' => 'Description & Help Text',
        'desc' => 'Use <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">description</code> for explanation text below the label, and <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">info</code> for helper notes below the input field.',
        'preview_title' => 'Label Description & Helper Text',
        'label' => 'Official Email Address',
        'placeholder' => 'name@company.com',
        'description' => 'This email will be used for transaction confirmations and account activation.',
        'info' => 'Ensure your email domain is active and can receive messages.',
    ],

    // Section 7: Error & Validation
    'error' => [
        'title' => 'Error & Validation',
        'desc' => 'Automatically displays errors from Laravel <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">$errors</code> matching the input <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">name</code>, or pass custom string messages via the prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">error</code>.',
        'preview_title' => 'Validation Error State',
        'label' => 'User Email',
        'placeholder' => 'invalid-email@',
        'message' => 'The email address format you entered is invalid.',
    ],

    // Section 8: Status
    'status' => [
        'title' => 'Status: Disabled & Readonly',
        'desc' => 'Supports native HTML attributes like <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">disabled</code> and <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">readonly</code> with automatic visual styling.',
        'preview_title' => 'Disabled & Readonly Status',
        'disabled_label' => 'License Key (Disabled)',
        'readonly_label' => 'Tracking Number (Readonly)',
    ],

    // Section 9: Livewire
    'livewire' => [
        'title' => 'Livewire Integration',
        'desc' => 'Supports Livewire directives like <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">wire:model</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">wire:model.live</code>, and <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">wire:model.blur</code> seamlessly.',
        'preview_title' => 'Livewire Model Binding Integration',
        'label' => 'Live Filter Input',
        'placeholder' => 'Type to instantly filter...',
    ],

    // Section 10: Props Reference
    'props' => [
        'title' => 'Props Reference',
        'desc' => 'Comprehensive list of props supported by the <code class="font-mono text-xs text-foreground">&lt;vibe:input&gt;</code> component.',
        'columns' => [
            'prop' => 'Prop',
            'type' => 'Type',
            'default' => 'Default',
            'desc' => 'Description',
        ],
    ],

    // Section 11: Slots
    'slots' => [
        'title' => 'Slots',
        'desc' => 'Available custom slots for the component.',
        'columns' => [
            'slot' => 'Slot',
            'desc' => 'Description',
        ],
    ],
];
