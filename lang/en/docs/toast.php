<?php

return [
    'title' => 'Toast',
    'badge' => 'Component',
    'group' => 'Feedback & Notifications',
    'description' => 'Modern, feature-rich floating toast notification component. Supports dynamic card stacking with hover expansion, audio chimes, 6 viewport positions, Laravel flash session integration, and global JavaScript dispatching.',

    // Section 1: Basic Usage
    'basic_usage' => [
        'title' => 'Basic Usage & Types',
        'desc' => 'Call the global JavaScript function <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">vibeToast()</code> from anywhere to trigger instant notifications. 4 semantic types are available: <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">info</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">success</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">warning</code>, and <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">error</code>.',
        'preview_title' => 'Basic Toast Triggers',
        'types' => [
            'info' => [
                'btn' => 'Info Toast',
                'title' => 'System Notice',
                'msg' => 'Cloud data synchronization is running in the background.',
            ],
            'success' => [
                'btn' => 'Success Toast',
                'title' => 'Successfully Saved',
                'msg' => 'User profile and preferences have been updated successfully.',
            ],
            'warning' => [
                'btn' => 'Warning Toast',
                'title' => 'Storage Warning',
                'msg' => 'Your cloud storage server has reached 85% capacity.',
            ],
            'error' => [
                'btn' => 'Error Toast',
                'title' => 'Processing Failed',
                'msg' => 'An error occurred while uploading file to server.',
            ],
        ],
    ],

    // Section 2: Stacked Toasts
    'stacked' => [
        'title' => 'Stacked Cards & Depth',
        'desc' => 'When multiple toasts are triggered concurrently at the same position, cards stack smoothly with visual depth (scale & translateY). Hover over the stack to expand them with dynamic element spacing.',
        'preview_title' => 'Toast Stacking Demonstration',
        'trigger_btn' => 'Trigger 3 Stacked Toasts',
        'toast_1' => [
            'title' => 'New Order Received',
            'msg' => 'Invoice #INV-2025-001 amounting to $750.00 has been received.',
        ],
        'toast_2' => [
            'title' => 'Support Message',
            'msg' => 'Help ticket #TK-4821 has been answered by the support team.',
        ],
        'toast_3' => [
            'title' => 'Update Ready to Install',
            'msg' => 'Version 2.4.0 is ready for deployment on production.',
        ],
    ],

    // Section 3: Positions
    'positions' => [
        'title' => 'Screen Positions',
        'desc' => 'Toasts can be anchored to 6 screen anchor points via the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">position</code> option: <code class="font-mono text-xs text-foreground">top-right</code> (default), <code class="font-mono text-xs text-foreground">top-left</code>, <code class="font-mono text-xs text-foreground">top-center</code>, <code class="font-mono text-xs text-foreground">bottom-right</code>, <code class="font-mono text-xs text-foreground">bottom-left</code>, and <code class="font-mono text-xs text-foreground">bottom-center</code>.',
        'preview_title' => '6 Screen Positions',
        'demo_title' => 'Positioned Toast',
        'demo_msg' => 'This is a sample toast anchored at :position.',
        'items' => [
            'top_right' => 'Top Right (Default)',
            'top_left' => 'Top Left',
            'top_center' => 'Top Center',
            'bottom_right' => 'Bottom Right',
            'bottom_left' => 'Bottom Left',
            'bottom_center' => 'Bottom Center',
        ],
    ],

    // Section 4: Sound & Timeout
    'sound_timeout' => [
        'title' => 'Timeout & Audio Effects',
        'desc' => 'Control display duration via the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">timeout</code> property (in milliseconds). Use <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">0</code> to keep the toast sticky until dismissed. Play custom sounds via <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">sound: "chime" | "pop" | false</code>.',
        'timeout_preview' => 'Display Duration',
        'sound_preview' => 'Audio Chimes',
        'fast_btn' => 'Fast (2s)',
        'sticky_btn' => 'Sticky (Persistent)',
        'chime_btn' => 'Chime Sound',
        'pop_btn' => 'Pop Sound',
        'silent_btn' => 'Mute (Silent)',
    ],

    // Section 5: Integration
    'integration' => [
        'title' => 'Laravel Flash Session & Livewire',
        'desc' => 'The Toast container automatically listens for Laravel controller flash sessions and browser events <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">window.dispatchEvent(new CustomEvent("vibe-toast", ...))</code>.',
        'preview_title' => 'Laravel Flash Session Simulation',
        'success_btn' => 'Flash Session Success',
        'error_btn' => 'Flash Session Error',
    ],

    // Section 6: Props Reference
    'props' => [
        'title' => 'Options Reference (API Payload)',
        'desc' => 'Listing of configuration options accepted by the <code class="font-mono text-xs text-foreground">vibeToast(options)</code> helper.',
        'columns' => [
            'prop' => 'Option',
            'type' => 'Type',
            'default' => 'Default',
            'desc' => 'Description',
        ],
    ],

    'props_items' => [
        'container' => [
            'position' => 'Default stacking container position on screen.',
            'timeout' => 'Auto-dismiss delay duration in milliseconds (or false for persistent toasts).',
            'sound' => 'Play synthesized Web Audio API chime (true) or external audio file (string URL).',
        ],
        'payload' => [
            'type' => 'Toast status type determining color palette, badge, and default icon.',
            'title' => 'Toast title (optional).',
            'message' => 'Full toast message description.',
            'icon' => 'Custom SVG icon element to replace default status icon.',
            'timeout' => 'Override auto-dismiss duration (false to keep open until manually closed).',
            'sound' => 'Override sound effect preference when toast appears (true or audio URL string).',
        ],
    ],
];
