<?php

return [
    'title' => 'Accordion',
    'description' => 'Interactive disclosure component to display collapsible sections of content cleanly and structured. Perfect for FAQ sections, navigation drawers, feature highlights, and grouped forms.',
    'badge' => 'Disclosure & Collapse',
    'group' => 'Components / Interactive',

    'basic_usage' => [
        'title' => 'Basic Usage',
        'desc' => 'Use the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:accordion&gt;</code> container with <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:accordion.item&gt;</code> wrappers. You can use the concise <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">title="..."</code> prop for rapid development, or construct granular layouts with <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:accordion.heading&gt;</code> and <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:accordion.content&gt;</code>.',
        'preview_title' => 'Basic Accordion (FAQ)',
        'q1_title' => 'What is Vibe UI?',
        'q1_desc' => 'Vibe UI is a modern UI library for the Laravel ecosystem and Tailwind CSS v4, inspired by Flux UI and Shadcn UI. It delivers an elegant, developer-friendly, and reactive interface suite.',
        'q2_title' => 'Does it support Dark Mode?',
        'q2_desc' => 'Absolutely! All Vibe UI components feature first-class dark mode support, reacting seamlessly to user themes and system color schemes.',
        'q3_title' => 'How is it installed and what are the dependencies?',
        'q3_desc' => 'Vibe UI is built on Tailwind CSS v4 and Alpine.js for smooth collapse animations (x-collapse), without heavy JavaScript runtime overhead.',
    ],

    'types' => [
        'title' => 'Expansion Mode: Single vs Multiple',
        'desc' => 'By default, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">type="single"</code> allows only one item to be expanded at a time (other open items collapse automatically). Set <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">type="multiple"</code> to allow users to expand multiple panels concurrently.',
        'preview_title' => 'Multiple Panels Expansion',
        'multi_q1' => 'Account Security & Access',
        'multi_q1_desc' => 'Manage two-factor authentication (2FA), active browser sessions, and emergency backup recovery keys.',
        'multi_q2' => 'Notification & Email Preferences',
        'multi_q2_desc' => 'Customize the types of alerts you receive via daily email roundups, browser push notifications, or weekly recaps.',
        'multi_q3' => 'API Integrations & Webhooks',
        'multi_q3_desc' => 'Connect your application to custom webhook endpoints and third-party SaaS platforms like Slack and GitHub.',
    ],

    'variants' => [
        'title' => 'Visual Variants',
        'desc' => 'Choose a visual style tailored to your design language: <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">default</code> (standard bordered list), <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">separated</code> or <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">card</code> (individual cards with subtle shadow and border), <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">flush</code> (borderless list with clean dividers), and <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">filled</code> / <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">muted</code> (soft tinted background).',
        'preview_title' => 'Separated Cards Variant',
        'card_q1' => '24/7 Priority Customer Support',
        'card_q1_desc' => 'Get direct, dedicated access to our senior engineering team via live chat and priority phone lines anytime.',
        'card_q2' => '99.9% Uptime Service Level Agreement',
        'card_q2_desc' => 'Enterprise-grade cloud infrastructure backed by multi-region redundancy to ensure your services remain online.',
        'card_q3' => 'Automated Real-time Backups',
        'card_q3_desc' => 'All application state and persistent assets are snapshotted every hour with up to 90 days retention window.',
    ],

    'flush' => [
        'title' => 'Flush Variant (Minimalist)',
        'desc' => 'The <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">variant="flush"</code> style removes outer borders and shadows, keeping only thin dividers between items. Excellent when nested inside cards, modals, or clean documentation pages.',
        'preview_title' => 'Borderless Flush Variant',
    ],

    'sizes' => [
        'title' => 'Size Options (Sizes)',
        'desc' => 'Available in <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">sm</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">md</code> (default), and <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">lg</code> sizes to scale button padding, typography, and chevron proportions accordingly.',
        'preview_title' => 'Size Comparison',
        'size_sm' => 'Small Size (sm)',
        'size_md' => 'Medium Size (md - default)',
        'size_lg' => 'Large Size (lg)',
        'sample_content' => 'Short sample disclosure description text formatted with proportional typographic rhythm.',
    ],

    'icons_badges' => [
        'title' => 'Icons, Badges & Subtitles',
        'desc' => 'Enhance accordion headings with leading icons, status badges, and descriptive subtitles to provide richer visual context.',
        'preview_title' => 'Accordion with Icons & Badges',
        'billing_title' => 'Payment Methods & Billing',
        'billing_sub' => 'Manage credit cards and historical tax invoices',
        'billing_desc' => 'Update credit card details, download PDF invoices, and set legal company billing information.',
        'team_title' => 'Team Members & Roles',
        'team_sub' => 'Collaborator access control and permissions',
        'team_desc' => 'Invite coworkers to your workspace and assign granular roles such as Administrator, Editor, or Viewer.',
        'api_title' => 'Production API Keys',
        'api_sub' => 'Webhook & integration authorization tokens',
        'api_desc' => 'Use this secret key to authenticate outbound HTTP requests against Vibe UI REST API endpoints.',
    ],

    'chevron' => [
        'title' => 'Chevron Customization',
        'desc' => 'Switch the chevron indicator to the left side using <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">chevronPosition="left"</code> or hide it entirely with <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:chevron="false"</code>.',
        'preview_title' => 'Left-aligned Chevron',
        'q1' => 'Left-aligned indicator arrow',
        'q1_desc' => 'Positioning the arrow on the left provides an organized, tree-style directory navigation appearance.',
    ],

    'collapsible' => [
        'title' => 'Always Open Constraint (collapsible="false")',
        'desc' => 'In single mode, clicking an already active item closes it by default. If you set <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:collapsible="false"</code>, at least one item remains expanded at all times.',
        'preview_title' => 'Always Keep One Panel Active',
    ],

    'disabled' => [
        'title' => 'Disabled State',
        'desc' => 'Disable interaction on a specific item using <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:disabled="true"</code> on the item, or lock the entire accordion globally with <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:accordion :disabled="true"&gt;</code>.',
        'preview_title' => 'Disabled Accordion Item',
        'active_item' => 'Active Selectable Item',
        'active_desc' => 'This item functions normally and can be freely opened or collapsed.',
        'disabled_item' => 'Locked Item (Enterprise Tier)',
        'disabled_desc' => 'This panel cannot be opened because it requires elevated plan permissions.',
    ],

    'props' => [
        'title' => 'Complete Props Reference',
        'desc' => 'Comprehensive specification of props and configuration options supported by <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:accordion&gt;</code> and its sub-components.',
        'columns' => [
            'prop' => 'Prop / Attribute',
            'type' => 'Data Type',
            'default' => 'Default',
            'desc' => 'Description',
        ],
        'items' => [
            'type' => 'Expansion mode: `"single"` (one panel open) or `"multiple"` (multiple panels can be open simultaneously).',
            'collapsible' => 'In single mode, whether the active item can be toggled closed (default `true`).',
            'selected' => 'The `value` of the item(s) initially expanded (string for single, array for multiple).',
            'value' => 'Alias for `selected`.',
            'default' => 'Alias for `selected`.',
            'variant' => 'Visual style: `"default"`, `"separated"` / `"card"`, `"flush"`, `"filled"` / `"muted"`.',
            'size' => 'Component size: `"sm"`, `"md"` (default), or `"lg"`.',
            'chevron' => 'Whether to show the animated rotating chevron arrow (default `true`).',
            'chevronPosition' => 'Chevron indicator placement: `"right"` (default) or `"left"`.',
            'disabled' => 'Disables interaction globally on the entire accordion or per item.',
            'item_value' => 'Unique identifier for the accordion item (auto-generated if omitted).',
            'item_title' => 'Shorthand title label for the item heading.',
            'item_subtitle' => 'Small optional secondary explanation beneath the title.',
            'item_icon' => 'Leading icon element or SVG string on the left of the heading.',
            'item_badge' => 'Badge text label next to the item title.',
            'item_open' => 'Forces this item to be open on initial mount (boolean).',
        ],
    ],
];
