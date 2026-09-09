<?php

return [
    'title' => 'Dropdown',
    'badge' => 'Component',
    'group' => 'UI Components',
    'description' => 'An interactive dropdown menu component for presenting action lists, navigation links, contextual options, or nested submenus with smooth transitions, automatic viewport collision positioning, keyboard accessibility, and organized categorical sections.',

    // Section 1: Basic Usage
    'basic_usage' => [
        'title' => 'Basic Usage',
        'desc' => 'Use the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:dropdown&gt;</code> tag with an <code class="font-mono text-xs text-foreground">&lt;x-slot:trigger&gt;</code> slot for the triggering element, and <code class="font-mono text-xs text-foreground">&lt;vibe:dropdown.content&gt;</code> containing menu items.',
        'preview_title' => 'Standard Dropdown Menu',
        'trigger_btn' => 'Options Menu',
        'account' => 'Account Settings',
        'support' => 'Help & Support',
        'license' => 'License & Terms',
        'logout' => 'Log Out',
    ],

    // Section 2: Items, Icons & Shortcuts
    'items_icons' => [
        'title' => 'Labels, Icons & Keyboard Shortcuts',
        'desc' => 'Enhance menu items with SVG icons, dividers using <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:dropdown.divider&gt;</code>, category headers via <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:dropdown.label&gt;</code>, and keyboard shortcut indicators.',
        'preview_title' => 'Complete Menu with Icons & Shortcuts',
        'trigger_btn' => 'Quick Actions',
        'header_general' => 'General',
        'header_danger' => 'Danger Zone',
        'new_file' => 'Create New File',
        'copy_link' => 'Copy Page Link',
        'share' => 'Share Document',
        'archive' => 'Archive Item',
        'delete' => 'Delete File Permanently',
    ],

    // Section 3: Alignment & Width
    'align_width' => [
        'title' => 'Alignment & Width Options (align & width)',
        'desc' => 'The <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">align</code> prop positions the popup menu (<code class="font-mono text-xs text-foreground">right</code>, <code class="font-mono text-xs text-foreground">left</code>, <code class="font-mono text-xs text-foreground">top</code>, <code class="font-mono text-xs text-foreground">bottom-center</code>, etc.), while the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">width</code> prop configures the container size (<code class="font-mono text-xs text-foreground">48</code>, <code class="font-mono text-xs text-foreground">56</code>, <code class="font-mono text-xs text-foreground">64</code>, <code class="font-mono text-xs text-foreground">80</code>, or <code class="font-mono text-xs text-foreground">full</code>).',
        'preview_title' => 'Dropdown Placement Variations',
        'align_left' => 'Align Left',
        'align_right' => 'Align Right',
        'align_top' => 'Align Top',
    ],

    // Section 4: Nested Sub-menus
    'submenus' => [
        'title' => 'Nested Sub-menus (Sub)',
        'desc' => 'Compose hierarchical multi-level menus using <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:dropdown.sub&gt;</code>. Submenus intelligently detect viewport edges and flip horizontally if screen boundaries would be overflowed.',
        'preview_title' => 'Dropdown with Nested Submenus',
        'trigger_btn' => 'Hierarchical Menu',
        'dashboard' => 'Main Dashboard',
        'settings' => 'Preferences',
        'theme' => 'Appearance Theme',
        'theme_light' => 'Light Mode',
        'theme_dark' => 'Dark Mode',
        'theme_system' => 'System Default',
        'language' => 'Language',
        'lang_id' => 'Bahasa Indonesia',
        'lang_en' => 'English (US)',
        'notifications' => 'Notifications Center',
    ],

    // Section 5: Keyboard Navigation
    'keyboard_nav' => [
        'title' => 'Keyboard Accessibility (keyboard)',
        'desc' => 'Enable the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">keyboard</code> boolean prop on <code class="font-mono text-xs text-foreground">&lt;vibe:dropdown&gt;</code> to activate full keyboard navigation: Up/Down arrow keys to traverse items, <kbd class="px-1 py-0.5 rounded bg-muted text-xs font-mono text-foreground">Escape</kbd> to close, Right arrow to expand submenus, and Left arrow to collapse.',
        'preview_title' => 'Full Keyboard Navigation',
        'trigger_btn' => 'Open with Keyboard',
    ],

    // Section 6: Custom Triggers
    'custom_trigger' => [
        'title' => 'Custom Triggers (Avatar & 3-Dot Icons)',
        'desc' => 'The <code class="font-mono text-xs text-foreground">trigger</code> slot accommodates any element, such as <code class="font-mono text-xs text-foreground">&lt;vibe:avatar&gt;</code> for user account menus in navbars, or an icon-only button (<code class="font-mono text-xs text-foreground">size="icon"</code>) for table rows and card action menus.',
        'preview_title' => 'Avatar Profile & Row Actions',
        'profile_title' => 'Sarah Jenkins',
        'profile_role' => 'Administrator',
        'view_profile' => 'View Profile',
        'billing' => 'Billing & Plans',
    ],

    // Section 7: Props Reference
    'props' => [
        'title' => 'Props & Subcomponents Reference',
        'desc' => 'Complete specification of props and subcomponents available for the <code class="font-mono text-xs text-foreground">&lt;vibe:dropdown&gt;</code> component suite.',
        'columns' => [
            'prop' => 'Prop',
            'type' => 'Type',
            'default' => 'Default',
            'desc' => 'Description',
        ],
    ],

    'slots' => [
        'title' => 'Available Subcomponents',
        'columns' => [
            'slot' => 'Subcomponent',
            'desc' => 'Description & Purpose',
        ],
    ],
];
