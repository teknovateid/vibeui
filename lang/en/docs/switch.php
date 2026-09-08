<?php

return [
    'title' => 'Switch',
    'badge' => 'Component',
    'group' => 'Form & Input',
    'description' => 'A modern toggle switch component with smooth sliding physics. Ideal for preferences, feature flags, and settings rows with customizable label placement and sizes.',

    'basic_usage' => [
        'title' => 'Basic Usage',
        'desc' => 'Use the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:switch&gt;</code> tag to create an interactive toggle.',
        'preview_title' => 'Standard Switch',
        'airplane_label' => 'Airplane Mode',
        'airplane_desc' => 'Disable all wireless cellular and bluetooth connections.',
    ],

    'sizes' => [
        'title' => 'Sizes',
        'desc' => 'Available in 3 sizes: <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">sm</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">md</code>, and <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">lg</code>.',
        'preview_title' => 'Switch Sizes',
        'sm' => 'Small Size (sm)',
        'md' => 'Medium Size (md - Default)',
        'lg' => 'Large Size (lg)',
    ],

    'placement' => [
        'title' => 'Label Placement (Justify & Left)',
        'desc' => 'Use the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">labelPlacement="justify"</code> prop to create an iOS/macOS settings row where the switch is pinned to the far right.',
        'preview_title' => 'Settings Row Switch Style',
        'notif_title' => 'Push Notifications',
        'notif_desc' => 'Receive instant alerts when new messages arrive.',
        'dark_title' => 'Automatic Dark Mode',
        'dark_desc' => 'Sync interface theme automatically with your device OS settings.',
    ],

    'props' => [
        'title' => 'Props & Attributes Reference',
        'desc' => 'Complete list of properties and attributes available on the <code class="font-mono text-xs text-foreground">&lt;vibe:switch&gt;</code> component.',
        'columns' => [
            'prop' => 'Prop',
            'type' => 'Type',
            'default' => 'Default',
            'desc' => 'Description',
        ],
        'items' => [
            'name' => 'Form input name attribute. Automatically bound with <code>wire:model</code> if specified.',
            'id' => 'Unique HTML <code>id</code> for the switch checkbox input and <code>label</code> binding.',
            'value' => 'Form submission value when the switch is in the active (ON) state.',
            'label' => 'Primary label text displayed alongside the switch toggle.',
            'description' => 'Optional guidance text displayed beneath the primary label.',
            'checked' => 'Initial active (ON) or inactive (OFF) state.',
            'size' => 'Track dimensions and sliding thumb size: <code>\'sm\'</code>, <code>\'md\'</code>, or <code>\'lg\'</code>.',
            'variant' => 'Active track background color: <code>\'primary\'</code>, <code>\'success\'</code>, or <code>\'accent\'</code>.',
            'labelPlacement' => 'Label position relative to the toggle: <code>\'right\'</code>, <code>\'left\'</code>, or <code>\'justify\'</code>.',
            'error' => 'Custom error message string or boolean flag to trigger red destructive styling.',
            'errorName' => 'Laravel validation error key in <code>$errors</code> to track automatically.',
            'disabled' => 'Native HTML attribute to disable interactions and dim component opacity.',
            'wrapperClass' => 'Additional custom CSS classes for the outer wrapper element.',
        ],
    ],

    'slots' => [
        'title' => 'Slots',
        'desc' => 'Custom template slots available for the switch toggle.',
        'columns' => [
            'slot' => 'Slot',
            'desc' => 'Description',
        ],
        'items' => [
            'default' => 'Default slot rendered directly inside the circular sliding thumb (e.g. mini sun/moon icons).',
        ],
    ],
];
