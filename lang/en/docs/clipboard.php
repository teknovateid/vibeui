<?php

return [
    'title' => 'Clipboard',
    'badge' => 'Component',
    'group' => 'UI Components',
    'description' => 'An accessible copy-to-clipboard component supporting standalone icon/text triggers, Invoker Commands DOM element targeting, read-only field & code boxes with optional masking, live-region confirmation bubbles, and optional Vibe Toast feedback.',

    'basic_usage' => [
        'title' => 'Basic Usage',
        'desc' => 'Use <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:clipboard&gt;</code> with <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">value</code> for standalone icon-only or labeled copy buttons.',
        'preview_title' => 'Standalone Copy Buttons',
        'copy_token' => 'Copy Token',
        'copy_url' => 'Copy URL',
    ],

    'target' => [
        'title' => 'Copying from Target Elements (Invoker Commands)',
        'desc' => 'Point <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">target</code> to any DOM element ID. Under the hood, Vibe Clipboard uses native Invoker Commands (<code class="font-mono text-xs text-foreground">command="--copy"</code> + <code class="font-mono text-xs text-foreground">commandfor</code>) with automatic click fallback for older browsers.',
        'preview_title' => 'Copy Text & Input Values by ID',
        'target_label' => 'Copy Webhook Endpoint',
        'command_note' => 'Install command:',
    ],

    'field_code' => [
        'title' => 'Field & Code Box Variants',
        'desc' => 'Use <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">variant="field"</code> for share URLs or API keys (add <code class="font-mono text-xs text-foreground">masked</code> for secrets) and <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">variant="code"</code> for inline terminal commands.',
        'preview_title' => 'Read-only Field, Masked Secret & Code Snippet',
        'api_label' => 'Production Secret Key',
        'api_desc' => 'Keep this token private. Copying works even while masked.',
        'share_label' => 'Public Share Link',
    ],

    'sizes_bubbles' => [
        'title' => 'Sizes, Bubbles & Toast',
        'desc' => 'Matches the proportional Vibe UI control grid (<code class="font-mono text-xs text-foreground">xs</code> 28px through <code class="font-mono text-xs text-foreground">xl</code> 44px), with configurable bubble placement (<code class="font-mono text-xs text-foreground">top</code>, <code class="font-mono text-xs text-foreground">bottom</code>, <code class="font-mono text-xs text-foreground">left</code>, <code class="font-mono text-xs text-foreground">right</code>, or <code class="font-mono text-xs text-foreground">false</code>) and opt-in <code class="font-mono text-xs text-foreground">toast</code>.',
        'preview_title' => 'Proportional Sizes & Notification Options',
        'with_toast' => 'Copy with Toast',
        'bubble_right' => 'Bubble Right',
    ],

    'hover_block' => [
        'title' => 'Repeated Copyable Blocks (.vibe-copyable)',
        'desc' => 'Wrap repeated code blocks or token cards in <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">.vibe-copyable</code> to reveal the copy trigger cleanly on hover and keyboard focus while keeping it visible on touch screens.',
        'preview_title' => 'Hover & Keyboard-Accessible Copy Block',
    ],

    'props' => [
        'title' => 'Props & JS API Reference',
        'desc' => 'You can also trigger copies programmatically from JavaScript using <code class="font-mono text-xs text-foreground">window.VibeClipboard.copy(text, opts)</code> or <code class="font-mono text-xs text-foreground">$vibe.copy(text)</code>.',
        'columns' => [
            'prop' => 'Prop',
            'type' => 'Type',
            'default' => 'Default',
            'desc' => 'Description',
        ],
    ],

    'props_items' => [
        'value' => 'Static string value to copy (or reactive Alpine attribute).',
        'target' => 'Target DOM element ID mapped via native commandfor.',
        'variant' => 'Button style or read-only display box mode (field / code).',
        'size' => 'Proportional size matching inputs and buttons (xs to xl).',
        'label' => 'Field label above box modes, or visible button text.',
        'description' => 'Helper text displayed above box modes.',
        'copyLabel' => 'Custom idle button label or tooltip title.',
        'copiedLabel' => 'Custom text announced and shown after successful copy.',
        'failedLabel' => 'Custom text announced and shown when clipboard fails.',
        'bubble' => 'Confirmation tooltip bubble placement or false for screen-reader-only status.',
        'duration' => 'Feedback reset delay in milliseconds.',
        'toast' => 'Shows a Vibe Toast notification alongside inline feedback.',
        'masked' => 'Masks box values with a reveal toggle while preserving plain-text copy.',
        'prefix' => 'Leading text prefix (e.g. $) for field/code boxes.',
        'ariaLabel' => 'Accessible button name for icon-only triggers.',
        'disabled' => 'Disables copying and interactions.',
    ],
];
