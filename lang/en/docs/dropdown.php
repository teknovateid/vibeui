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

    // Section 7: Programmatic Control
    'programmatic' => [
        'title' => 'Programmatic Control ($vibe.dropdown & $vibe.dropdowns)',
        'desc' => 'Dropdowns can be opened, closed, or toggled remotely using the helper <code class="font-mono text-xs bg-muted px-1.5 py-0.5 rounded text-foreground">$vibe.dropdown(\'id\')</code> or closed in batch via <code class="font-mono text-xs bg-muted px-1.5 py-0.5 rounded text-foreground">$vibe.dropdowns.close()</code>.',
        'preview_title' => 'Dropdown External Control',
        'toggle_btn' => 'Toggle Dropdown',
        'open_btn' => 'Open Dropdown',
        'open_btn_short' => 'Open',
        'close_all_btn' => 'Close All Dropdowns',
        'close_all_btn_short' => 'Close All',
        'target_dropdown' => 'Target Dropdown',
        'quick_actions' => 'Quick Actions',
        'edit_profile' => 'Edit Profile',
        'account_settings' => 'Account Settings',
        'close_dropdown' => 'Close Dropdown',
    ],

    // Section 8: Props Reference
    'props' => [
        'title' => 'Props & Subcomponents Reference',
        'desc' => 'Complete specification of props and subcomponents available for the <code class="font-mono text-xs text-foreground">&lt;vibe:dropdown&gt;</code> component suite.',
        'columns' => [
            'prop' => 'Prop',
            'type' => 'Type',
            'default' => 'Default',
            'desc' => 'Description',
        ],
        'events_title' => 'Window Events & $vibe Helper Reference',
        'events_desc' => 'The dropdown component responds to the following window events and $vibe Alpine.js helpers:',
        'th_event' => 'Helper / Window Event',
        'th_payload' => 'Payload',
        'th_event_desc' => 'Description',
        'events' => [
            [
                'name' => "\$vibe.dropdown('id').show() / @open-dropdown",
                'payload' => "'id'",
                'desc' => 'Opens the target dropdown matching the given ID.',
            ],
            [
                'name' => "\$vibe.dropdown('id').close() / @close-dropdown",
                'payload' => "'id'",
                'desc' => 'Closes the target dropdown matching the given ID.',
            ],
            [
                'name' => "\$vibe.dropdown('id').toggle() / @toggle-dropdown",
                'payload' => "'id'",
                'desc' => 'Toggles the open/closed state of the target dropdown.',
            ],
            [
                'name' => "\$vibe.dropdowns.close() / @close-dropdown",
                'payload' => "'*'",
                'desc' => 'Closes all active dropdowns currently open on the page.',
            ],
        ],
    ],

    'slots' => [
        'title' => 'Available Subcomponents',
        'columns' => [
            'slot' => 'Subcomponent',
            'desc' => 'Description & Purpose',
        ],
    ],

    'props_items' => [
        'dropdown' => [
            'id' => 'Unique dropdown ID for programmatic control via $vibe.dropdown("id").show(), .close(), .toggle(), or window events.',
            'keyboard' => 'Enable keyboard accessibility navigation (Escape to close, up/down arrows to navigate items, right/left arrows for submenus).',
        ],
        'body' => [
            'align' => "Popover alignment position: `'right'`, `'left'`, `'top'`, `'top-left'`, `'top-right'`, `'top-center'`, `'bottom'`, `'bottom-left'`, `'bottom-center'`, `'bottom-right'`.",
            'width' => "Dropdown container width: `'48'` (12rem), `'56'` (14rem), `'64'` (16rem), `'72'`, `'80'`, `'96'`, `'xl'`, `'2xl'`, `'min'`, or `'full'`.",
        ],
        'item' => [
            'destructive' => 'Apply destructive styling with subtle red text that transitions to solid destructive on hover (`hover:bg-destructive/10`).',
            'variant' => "Item variant choice: `'default'` or `'destructive'`.",
            'href' => 'If provided, renders item as an `<a>` navigation link supporting `wire:navigate`.',
            'type' => 'Button type when item does not have an `href` attribute.',
        ],
        'sub' => [
            'label' => 'Trigger title text for nested submenus.',
            'isOpen' => 'Initial open state of the submenu.',
            'position' => "Submenu positioning mode: `'absolute'` (horizontal flyout) or `'relative'` (collapsible accordion).",
        ],
    ],
];
