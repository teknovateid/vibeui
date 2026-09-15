<?php

return [
    'title' => 'Card',
    'badge' => 'Component',
    'group' => 'Layout & Container',
    'description' => 'A versatile card component for grouping related content, analytics metrics, forms, or actions with a consistent aesthetic, visual variants support (default, outline, flat, elevated, ghost), flexible padding options, and modular subcomponents (header, title, description, content, footer).',

    // Section 1: Basic Usage
    'basic_usage' => [
        'title' => 'Basic Usage',
        'desc' => 'Use the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:card&gt;</code> tag as the main container wrapper. By default, cards feature rounded corners (<code class="font-mono text-xs text-foreground">rounded-xl</code>), subtle borders, 2xs shadows, and standard interior padding.',
        'preview_title' => 'Basic Card',
        'sample_title' => 'Account Summary',
        'sample_desc' => 'General overview regarding your current membership status and account preferences.',
        'sample_body' => 'Your current subscription is the Pro Plan active until December 2026. All premium features are enabled.',
    ],

    // Section 2: Structured Card (Header, Content, Footer)
    'structured' => [
        'title' => 'Modular Structure (Header, Content & Footer)',
        'desc' => 'For clean, semantic layouts, utilize the modular subcomponents: <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:card.header&gt;</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:card.title&gt;</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:card.description&gt;</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:card.content&gt;</code>, and <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:card.footer&gt;</code>.',
        'preview_title' => 'Card with Full Subcomponents',
        'title_text' => 'Security Notifications',
        'desc_text' => 'Manage two-factor authentication preferences and login activity alerts.',
        'content_text' => 'Two-factor authentication (2FA) is currently enabled via your authenticator app. Any new sign-in sessions from unrecognized devices will require a 6-digit OTP verification code.',
        'footer_action' => 'Configure 2FA',
        'footer_cancel' => 'Learn More',
    ],

    // Section 3: Variants
    'variants' => [
        'title' => 'Visual Variants',
        'desc' => 'The <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">variant</code> prop controls the visual presentation: <code class="font-mono text-xs text-foreground">default</code>, <code class="font-mono text-xs text-foreground">outline</code>, <code class="font-mono text-xs text-foreground">flat</code>, <code class="font-mono text-xs text-foreground">elevated</code>, and <code class="font-mono text-xs text-foreground">ghost</code>.',
        'preview_title' => 'Card Variant Options',
        'default' => 'Default (Border & Subtle 2xs Shadow)',
        'outline' => 'Outline (Clean Border & Transparent)',
        'flat' => 'Flat (Muted Background Without Border)',
        'elevated' => 'Elevated (Prominent Medium Shadow)',
        'ghost' => 'Ghost (Fully Transparent)',
    ],

    // Section 4: Padding
    'padding' => [
        'title' => 'Padding Options (padding)',
        'desc' => 'By default, the card has <code class="font-mono text-xs text-foreground">p-6</code> padding. Use <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">padding="none"</code> (or <code class="font-mono text-xs text-foreground">"sm"</code>, <code class="font-mono text-xs text-foreground">"lg"</code>, <code class="font-mono text-xs text-foreground">"xl"</code>) when designing full edge-to-edge tables or banner imagery without outer gutters.',
        'preview_title' => 'Card Without Padding (Edge-to-Edge)',
        'banner_title' => 'System Update v2.4 Released',
        'banner_desc' => 'Real-time analytics dashboard and query performance improvements are now live.',
        'read_more' => 'Read Release Notes',
    ],

    // Section 5: Stat & Metric Cards
    'metrics' => [
        'title' => 'Metrics & KPI Cards',
        'desc' => 'Combine <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:card&gt;</code> with <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:badge&gt;</code> to compose informative, modern analytical dashboards.',
        'preview_title' => 'Dashboard & KPI Cards',
        'total_revenue' => 'Total Revenue',
        'revenue_val' => '$148,520.00',
        'active_users' => 'Active Users',
        'users_val' => '24,890',
        'conversion_rate' => 'Conversion Rate',
        'conversion_val' => '4.85%',
        'growth_revenue' => '+18.2% this mo',
        'growth_users' => '+8.4% this mo',
        'growth_conversion' => '+1.2% this mo',
    ],

    // Section 6: Card Alert (<vibe:card.alert>)
    'alert' => [
        'title' => 'Card Alert (<vibe:card.alert>)',
        'desc' => 'Integrated notification card within the Card family designed to present status messages, system warnings, or confirmations with rich color variants, visual appearances (<code class="font-mono text-xs text-foreground">subtle</code>, <code class="font-mono text-xs text-foreground">outline</code>, <code class="font-mono text-xs text-foreground">solid</code>, <code class="font-mono text-xs text-foreground">accent-left</code>), action buttons, and interactive dismissibility.',
        'preview_title' => 'Card Alert Variants',
        'info_title' => 'Update Available',
        'info_desc' => 'A new version of the application has been released. Please refresh your browser to update.',
        'success_title' => 'Changes Saved Successfully',
        'success_desc' => 'Your profile and integration settings have been synchronized and stored to the cloud.',
        'warning_title' => 'API Latency Detected',
        'warning_desc' => 'Webhooks service is currently experiencing elevated latency. Sync operations may be delayed.',
        'danger_title' => 'Payment Failed',
        'danger_desc' => 'Your default payment method was declined by the card issuer. Please update your billing details.',
        'accent_preview_title' => 'Accent-Left & Solid Styles',
        'dismissible_preview_title' => 'Interactive Dismissible & Actions',
        'dismissible_title' => 'Account Security Tip',
        'dismissible_desc' => 'Activate biometric passkeys for a faster, passwordless, and significantly safer authentication experience.',
        'dismissible_action' => 'Enable Now',
    ],

    // Section 7: Props & Slots
    'props' => [
        'title' => 'Props & Subcomponents Reference',
        'desc' => 'Comprehensive list of props and subcomponents available for the <code class="font-mono text-xs text-foreground">&lt;vibe:card&gt;</code> and <code class="font-mono text-xs text-foreground">&lt;vibe:card.alert&gt;</code> component family.',
        'columns' => [
            'prop' => 'Prop',
            'type' => 'Type',
            'default' => 'Default',
            'desc' => 'Description',
        ],
    ],

    'slots' => [
        'title' => 'Available Slots',
        'columns' => [
            'slot' => 'Slot / Component',
            'desc' => 'Description & Usage',
        ],
    ],

    'variants_items' => [
        'flat_desc' => 'Soft subtle background without borders.',
        'elevated_desc' => 'Medium elevation shadow for focused cards.',
        'ghost_desc' => 'Fully transparent without borders.',
    ],

    'props_items' => [
        'variant' => "Card visual style: `'default'`, `'outline'`, `'flat'`, `'elevated'`, or `'ghost'`.",
        'padding' => "Internal padding sizing: `'none'` (p-0), `'sm'` (p-4), `'lg'` (p-8), `'xl'` (p-10), or custom string. Default: `p-6`.",
    ],

    'slots_items' => [
        'header' => 'Card header container with vertical flex layout and default bottom spacing.',
        'title' => 'Semantic title element (<code class="font-mono text-xs text-foreground">&lt;h3&gt;</code>) with bold, snug typography.',
        'description' => 'Supporting description element beneath card title in muted text.',
        'content' => 'Main card body content wrapper.',
        'footer' => 'Card footer section with top divider and action button placement.',
    ],

    'alert_props' => [
        'title' => 'Props <vibe:card.alert>',
        'items' => [
            'variant' => "Status color variant: `'info'`, `'success'`, `'warning'`, `'destructive'` (or `'danger'`), `'primary'`, or `'default'`. Default: `'info'`.",
            'appearance' => "Visual appearance style: `'subtle'`, `'outline'`, `'solid'`, or `'accent-left'`. Default: `'subtle'`.",
            'size' => "Font and padding scale: `'sm'`, `'md'`, or `'lg'`. Default: `'md'`.",
            'title' => 'Primary title text for the alert.',
            'description' => 'Detailed body or descriptive text for the alert.',
            'icon' => 'Displayed icon SVG or HTML markup. Automatically assigned based on variant if empty. Set `:icon="false"` to hide.',
            'dismissible' => 'Boolean indicating whether to render an interactive close button with Alpine.js transition.',
            'rounded' => "Tailwind border radius class: e.g. `'rounded-xl'`, `'rounded-lg'`. Default: `'rounded-xl'`.",
        ],
    ],
];
