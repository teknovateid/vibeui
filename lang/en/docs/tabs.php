<?php

return [
    'title' => 'Tabs',
    'badge' => 'Component',
    'group' => 'Navigation & Layout',
    'description' => 'A modern and modular tab component suite for grouping multi-pane content with 2 core layouts (2-Row horizontal & 2-Column vertical), built on top of the <vibe:button> component, supporting pure SVG icon slots, notification counter badges, visual variants (pill, underline, button), flicker-free localStorage persistence (anti-FOUC), and WAI-ARIA keyboard navigation.',

    // Section 1: 2-Row Design (Horizontal)
    'rows' => [
        'title' => '2-Row Design (Horizontal Tabs)',
        'desc' => 'By default (<code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">layout="rows"</code>), the tab list is placed on the top row horizontally, with the content panels rendered in the row below. This layout is ideal for dense content sections or step-by-step forms.',
        'preview_title' => '2-Row Tabs (Default)',
        'tab_profile' => 'User Profile',
        'tab_account' => 'Account & Security',
        'tab_billing' => 'Subscription',
        'profile_title' => 'Profile Information',
        'profile_desc' => 'Update your personal details, avatar image, and email address here.',
        'account_title' => 'Account Security',
        'account_desc' => 'Manage your password, two-factor authentication (2FA), and login session history.',
        'billing_title' => 'Subscription Plan',
        'billing_desc' => 'Manage your active subscription plan, payment methods, and billing invoice history.',
    ],

    // Section 2: 2-Column Design (Vertical Side-by-Side)
    'cols' => [
        'title' => '2-Column Design (Vertical Side-by-Side Tabs)',
        'desc' => 'Use the prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">layout="cols"</code> (or <code class="font-mono text-xs text-foreground">orientation="vertical"</code>) to place the tab list on the left column and the content panel on the right column. This 2-column layout is perfect for System Settings, Account Profile Dashboards, or multi-category documentation.',
        'preview_title' => '2-Column Tabs (Sidebar Layout)',
        'tab_general' => 'General Settings',
        'tab_security' => 'Security & Access',
        'tab_notifications' => 'Notification Preferences',
        'tab_integrations' => 'API Integrations',
        'general_title' => 'General Application Preferences',
        'general_desc' => 'Configure organization name, standard time zone, and default interface language.',
        'security_title' => 'Advanced Security Settings',
        'security_desc' => 'Define automatic session timeouts, IP address restrictions, and data encryption.',
        'notif_title' => 'Notification Channels',
        'notif_desc' => 'Select notification types dispatched via email, SMS, or outgoing webhooks.',
        'integrations_title' => 'Third-Party Service Connections',
        'integrations_desc' => 'Manage API token keys and external webhooks for automated data synchronization.',
    ],

    // Section 3: Visual Variants
    'variants' => [
        'title' => 'Visual Variants (Pill, Underline, Button)',
        'desc' => 'Choose a visual style matching your app design with the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">variant</code> prop: <code class="font-mono text-xs text-foreground">pill</code> (subtle card in macOS/Shadcn style), <code class="font-mono text-xs text-foreground">underline</code> (GitHub/Flux UI style border indicator), or <code class="font-mono text-xs text-foreground">button</code> (discrete outlined buttons).',
        'preview_title' => 'Visual Variants Comparison',
        'pill_label' => 'Pill Variant (Default)',
        'underline_label' => 'Underline Variant',
        'button_label' => 'Button / Outlined Variant',
    ],

    // Section 4: Icons & Badges
    'icons' => [
        'title' => 'Tabs with SVG Icons & Notification Badges',
        'desc' => 'Add pure SVG icons via <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;x-slot:icon&gt;&lt;svg...&gt;&lt;/x-slot:icon&gt;</code> and include the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">badge="..."</code> prop to display counter numbers or status pills.',
        'preview_title' => 'Tabs with SVG Icons and Badges',
        'tab_inbox' => 'Inbox',
        'tab_sent' => 'Sent',
        'tab_archive' => 'Archive',
        'tab_spam' => 'Spam',
        'inbox_content' => 'You have 12 unread messages in your primary inbox.',
        'sent_content' => 'All outbound message history is securely logged.',
        'archive_content' => 'Older messages are stored in an encrypted archive.',
        'spam_content' => 'The spam folder is automatically cleared every 30 days.',
    ],

    // Section 5: Fitted / Full-Width
    'fitted' => [
        'title' => 'Full-Width Tabs (Fitted / Equal Width)',
        'desc' => 'Add the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">fitted="true"</code> prop to <code class="font-mono text-xs text-foreground">&lt;vibe:tabs.list&gt;</code> to divide tabs equally across 100% container width.',
        'preview_title' => '100% Fitted Tabs',
        'tab_daily' => 'Daily',
        'tab_weekly' => 'Weekly',
        'tab_monthly' => 'Monthly',
        'tab_yearly' => 'Yearly',
    ],

    // Section 6: Persistence
    'persist' => [
        'title' => 'LocalStorage Persistence (persist)',
        'desc' => 'Use the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:persist="true"</code> prop to remember the active tab in <code class="font-mono text-xs text-foreground">localStorage</code>. When the user refreshes the browser, the previously selected tab restores immediately without flicker.',
        'preview_title' => 'Persistent Tabs Demo',
        'tab_step1' => 'Step 1: Identity',
        'tab_step2' => 'Step 2: Verification',
        'tab_step3' => 'Step 3: Confirmation',
        'reset_btn' => 'Reset Tab Storage',
        'reset_toast' => 'Tab persistence history reset to initial tab!',
        'reload_tip' => '💡 <strong>Try it out:</strong> Select Step 2 or Step 3, then <strong>refresh your browser (F5 / Ctrl+R)</strong>. The active tab is automatically preserved!',
    ],

    // Section 7: Livewire Integration
    'livewire' => [
        'title' => 'Livewire Integration & URL Sync',
        'desc' => 'The tabs component can be controlled from a Livewire backend component or synced with browser URL query parameters via <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">sync-url="tab"</code>.',
        'preview_title' => 'Livewire Integration & URL Synchronization',
    ],

    // Section 8: Custom Designs & Styling
    'custom' => [
        'title' => 'Custom Design Inspirations (Custom Class)',
        'desc' => 'The Tabs component is crafted for complete styling freedom. Without modifying the component core source code, you can leverage Tailwind CSS utilities directly via <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">class="..."</code> to assemble diverse, state-of-the-art UI designs.',
        
        // 1. Floating Glassmorphism Pill
        'floating_title' => '1. Floating Glassmorphism Pill',
        'floating_desc' => 'A floating capsule design with frosted glass blur effect (<code class="font-mono text-xs text-foreground">backdrop-blur-xl</code>), subtle shadows, and full pill corners (<code class="font-mono text-xs text-foreground">rounded-full</code>). Excellent for hero navigation bars, portfolio showcases, or category filters.',
        'floating_preview_title' => 'Floating Glassmorphism Tabs',
        'floating_tab_overview' => 'Overview',
        'floating_tab_analytics' => 'Analytics',
        'floating_tab_reports' => 'Reports & Exports',
        'floating_overview_title' => 'Sales & Conversion Performance',
        'floating_overview_desc' => 'Gross revenue increased +24.8% this quarter with a customer retention rate reaching 94.2%.',
        'floating_analytics_title' => 'Real-Time Traffic Metrics',
        'floating_analytics_desc' => '82,450 daily active visitors with an average session duration of 4 minutes 12 seconds.',
        'floating_reports_title' => 'Recent Financial Reports',
        'floating_reports_desc' => 'Download audited quarterly statements (Q3) and transaction tax logs in PDF or CSV formats.',

        // 2. Card Header Segmented
        'card_header_title' => '2. Card Header Segmented (GitHub / Linear Style)',
        'card_header_desc' => 'Seamlessly embeds tabs directly into a <code class="font-mono text-xs text-foreground">&lt;vibe:card&gt;</code> header with unified underline borders. Perfect for project configuration, repository administration, or SaaS dashboards.',
        'card_header_preview_title' => 'Card Header Segmented Tabs',
        'card_header_tab_general' => 'General Settings',
        'card_header_tab_collaborators' => 'Team Collaborators',
        'card_header_tab_webhooks' => 'Webhooks',
        'card_header_general_title' => 'Primary Project Configuration',
        'card_header_general_desc' => 'Update project name, repository visibility, and default primary branch.',
        'card_header_collab_title' => 'Team Access & Permissions',
        'card_header_collab_desc' => 'Manage permissions for contributors, developers, and release managers.',
        'card_header_webhooks_title' => 'External Webhooks Endpoints',
        'card_header_webhooks_desc' => 'Dispatch automated event payloads to your CI/CD pipelines or Discord/Slack bots.',

        // 3. Sidebar Settings Navigation (2 Columns)
        'sidebar_title' => '3. Dashboard Settings Sidebar Navigation (2 Columns)',
        'sidebar_desc' => 'Combines vertical <code class="font-mono text-xs text-foreground">layout="cols"</code> with a dedicated sidebar container, purposeful SVG icons, status badges, and an expansive card content canvas.',
        'sidebar_preview_title' => 'Dashboard Sidebar Tabs (2 Columns)',
        'sidebar_tab_profile' => 'User Profile',
        'sidebar_tab_billing' => 'Plans & Billing',
        'sidebar_tab_api' => 'API Tokens',
        'sidebar_tab_security' => 'Security & Auth',
        'sidebar_profile_title' => 'Personal Account Information',
        'sidebar_profile_desc' => 'Update your identity details, short bio, and public avatar image.',
        'sidebar_billing_title' => 'Enterprise Subscription Plan',
        'sidebar_billing_desc' => 'Your plan is active through December 31, 2026 with unlimited API request quotas.',
        'sidebar_api_title' => 'Developer API Key Management',
        'sidebar_api_desc' => 'API keys allow programmatic access to Vibe UI GraphQL and REST endpoints.',
        'sidebar_security_title' => 'Security & Two-Factor Authentication (2FA)',
        'sidebar_security_desc' => 'Protect your logins with an authenticator app or hardware FIDO2 security keys.',

        // 4. Dark Dev Console / Terminal Code Tabs
        'terminal_title' => '4. Dark Dev Terminal / Code Snippet Switcher',
        'terminal_desc' => 'A dark developer console aesthetic featuring monospaced typography, macOS window dots, and compact tabs for switching between programming languages (cURL, PHP SDK, Node.js, Python).',
        'terminal_preview_title' => 'Developer Terminal Console Tabs',
        'terminal_tab_curl' => 'cURL',
        'terminal_tab_php' => 'PHP (SDK)',
        'terminal_tab_node' => 'Node.js',
        'terminal_tab_python' => 'Python',

        // 5. Segmented Filter Bar
        'filter_title' => '5. Segmented Filter Bar with Counter Badges',
        'filter_desc' => 'A compact filter toolbar utilizing <code class="font-mono text-xs text-foreground">fitted="true"</code>, fully rounded corners, and numeric counter badges to filter tasks by status (All, Active, Completed).',
        'filter_preview_title' => 'Filter Bar Tabs with Counter Badges',
        'filter_tab_all' => 'All Tasks',
        'filter_tab_active' => 'In Progress',
        'filter_tab_completed' => 'Completed',
        'filter_all_content' => 'Displaying all 38 tasks registered across this project.',
        'filter_active_content' => '14 tasks are currently being worked on by the engineering team.',
        'filter_completed_content' => '24 tasks have been verified and marked as complete.',
    ],

    // Props Table
    'props' => [
        'title' => 'Properties & API Reference',
        'desc' => 'Comprehensive list of attributes and options available for the tabs component suite.',
        'tabs_title' => '<vibe:tabs> Properties',
        'list_title' => '<vibe:tabs.list> Properties',
        'tab_title' => '<vibe:tabs.tab> Properties',
        'panel_title' => '<vibe:tabs.panel> Properties',
        'th_prop' => 'Property',
        'th_type' => 'Type',
        'th_default' => 'Default',
        'th_desc' => 'Description',
        'tabs_items' => [
            [
                'name' => 'layout',
                'type' => 'string',
                'default' => '\'rows\'',
                'desc' => 'Tab layout: \'rows\' (2 rows: list top, panel bottom) or \'cols\' (2 columns: list left, panel right).',
            ],
            [
                'name' => 'variant',
                'type' => 'string',
                'default' => '\'pill\'',
                'desc' => 'Visual style: \'pill\', \'underline\', or \'button\'.',
            ],
            [
                'name' => 'size',
                'type' => 'string',
                'default' => '\'md\'',
                'desc' => 'Tab sizing: \'sm\', \'md\', or \'lg\'.',
            ],
            [
                'name' => 'default / selected',
                'type' => 'string|null',
                'default' => 'null',
                'desc' => 'The tab name that should be active upon initial load.',
            ],
            [
                'name' => 'persist',
                'type' => 'bool',
                'default' => 'false',
                'desc' => 'Persists the active tab selection to browser LocalStorage.',
            ],
            [
                'name' => 'id',
                'type' => 'string|null',
                'default' => 'uniqid()',
                'desc' => 'Unique container ID for persistence mapping and ARIA accessibility.',
            ],
            [
                'name' => 'syncUrl',
                'type' => 'bool|string',
                'default' => 'false',
                'desc' => 'Synchronizes active tab to URL query parameters (e.g., ?tab=security).',
            ],
        ],
        'tab_items' => [
            [
                'name' => 'name',
                'type' => 'string',
                'default' => '— (Required)',
                'desc' => 'Unique tab identifier matching its corresponding content panel.',
            ],
            [
                'name' => 'icon',
                'type' => 'slot (SVG)',
                'default' => 'null',
                'desc' => 'Pure SVG icon slot displayed to the left of the tab label.',
            ],
            [
                'name' => 'badge',
                'type' => 'string|int|null',
                'default' => 'null',
                'desc' => 'Counter number or notification pill label to the right of the tab text.',
            ],
            [
                'name' => 'badgeVariant',
                'type' => 'string',
                'default' => '\'secondary\'',
                'desc' => 'Badge visual variant: secondary, primary, outline, success, destructive, etc.',
            ],
            [
                'name' => 'disabled',
                'type' => 'bool',
                'default' => 'false',
                'desc' => 'Disables click interaction and keyboard focus for this tab.',
            ],
            [
                'name' => 'href',
                'type' => 'string|null',
                'default' => 'null',
                'desc' => 'Converts the tab into a full navigation link with wire:navigate support.',
            ],
        ],
        'list_items' => [
            [
                'name' => 'fitted',
                'type' => 'bool',
                'default' => 'false',
                'desc' => 'Stretches each tab equally to span 100% width of the container.',
            ],
        ],
        'panel_items' => [
            [
                'name' => 'name',
                'type' => 'string',
                'default' => '— (Required)',
                'desc' => 'Identifier matching the trigger tab name.',
            ],
            [
                'name' => 'lazy',
                'type' => 'bool',
                'default' => 'false',
                'desc' => 'Defers rendering the panel HTML content until the tab becomes active.',
            ],
        ],
    ],
];
