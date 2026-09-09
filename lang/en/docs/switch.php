<?php

return [
    'title' => 'Switch',
    'badge' => 'Component',
    'group' => 'Form & Input',
    'description' => 'A modern toggle switch component with smooth sliding physics. Ideal for preferences, feature flags, and settings rows with customizable color variants, label placement, thumb icons, and sizes.',

    'basic_usage' => [
        'title' => 'Basic Usage',
        'desc' => 'Use the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:switch&gt;</code> tag to create an interactive toggle.',
        'preview_title' => 'Standard Switch',
        'airplane_label' => 'Airplane Mode',
        'airplane_desc' => 'Disable all wireless cellular and bluetooth connections.',
    ],

    'variants' => [
        'title' => 'Color Variants',
        'desc' => 'Available in multiple semantic color variants: <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">primary</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">secondary</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">success</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">warning</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">danger</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">info</code>, and <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">accent</code>.',
        'preview_title' => 'All Switch Color Variants',
        'primary_label' => 'Primary (Default High Contrast)',
        'secondary_label' => 'Secondary (Subtle Neutral)',
        'success_label' => 'Success (2FA Enabled)',
        'warning_label' => 'Warning (Data Limit Alert)',
        'danger_label' => 'Danger / Destructive (Auto Delete Account)',
        'info_label' => 'Info (Cloud Synchronization)',
        'accent_label' => 'Accent (Experimental Feature)',
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
        'title' => 'Label Placement (Right, Left & Justify)',
        'desc' => 'Position the label using the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">labelPlacement</code> prop with options: <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">right</code> (default), <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">left</code>, or <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">justify</code> (iOS/macOS settings row style).',
        'preview_title' => 'Label Placement & Settings Row',
        'right_label' => 'Right Label (Default)',
        'left_label' => 'Left Label',
        'notif_title' => 'Push Notifications',
        'notif_desc' => 'Receive instant alerts when new messages arrive.',
        'dark_title' => 'Automatic Dark Mode',
        'dark_desc' => 'Sync interface theme automatically with your device OS settings.',
    ],

    'icons' => [
        'title' => 'Thumb Icons (Slot)',
        'desc' => 'You can pass an SVG or icon into the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:switch&gt;</code> default slot to be rendered directly inside the sliding thumb.',
        'preview_title' => 'Switch with Thumb Icon',
        'theme_label' => 'Dark Theme',
        'theme_desc' => 'Toggle visual interface between light and dark modes.',
        'security_label' => 'Security Lock',
        'security_desc' => 'Require biometric verification upon opening application.',
    ],

    'states' => [
        'title' => 'Component States (Disabled & Error)',
        'desc' => 'Switch toggles support disabled states (<code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">disabled</code>) in both OFF and ON positions, as well as form validation error states (<code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">error</code>).',
        'preview_title' => 'Disabled & Error States',
        'disabled_off_label' => 'Feature Locked (Disabled OFF)',
        'disabled_off_desc' => 'Requires an active Pro subscription to unlock.',
        'disabled_on_label' => 'Enforced Policy (Disabled ON)',
        'disabled_on_desc' => 'This setting is managed by your organization.',
        'error_label' => 'Terms & Conditions Agreement',
        'error_desc' => 'Acknowledge privacy policy and community rules.',
        'error_message' => 'You must agree to the terms and conditions to proceed.',
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
            'variant' => 'Active track background color: <code>\'primary\'</code>, <code>\'secondary\'</code>, <code>\'success\'</code>, <code>\'warning\'</code>, <code>\'danger\'</code>/<code>\'destructive\'</code>, <code>\'info\'</code>, or <code>\'accent\'</code>.',
            'labelPlacement' => 'Label position relative to the toggle: <code>\'right\'</code>, <code>\'left\'</code>, or <code>\'justify\'</code>.',
            'error' => 'Custom error message string or boolean flag to trigger red destructive styling.',
            'errorName' => 'Laravel validation error key in <code>$errors</code> to track automatically.',
            'disabled' => 'Boolean prop or HTML attribute to disable interactions and dim component opacity.',
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
            'default' => 'Default slot rendered directly inside the circular sliding thumb (e.g. mini sun/moon icons, lock, checkmark).',
        ],
    ],
];
