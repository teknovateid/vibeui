<?php

return [
    'title' => 'Alert Dialog',
    'badge' => 'Component',
    'group' => 'Feedback & Notifications',
    'description' => 'Modern modal/popup alert dialog component with smooth transitions, flexible layouts, interactive confirmation workflows, glassmorphism backdrop blur, audio feedback, and state persistence.',

    // Section 1: Basic Usage
    'basic_usage' => [
        'title' => 'Basic Usage & Types',
        'desc' => 'Use the global JavaScript function <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">vibeAlert()</code> to trigger alert modals. 4 semantic types are available: <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">info</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">success</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">warning</code>, and <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">error</code>.',
        'preview_title' => 'Alert Dialog Types',
        'types' => [
            'info' => [
                'btn' => 'Info Alert',
                'title' => 'System Update',
                'msg' => 'Version 2.4 updates have been successfully deployed to your instance.',
            ],
            'success' => [
                'btn' => 'Success Alert',
                'title' => 'Transaction Completed',
                'msg' => 'Your order payment has been successfully verified by the partner bank.',
            ],
            'warning' => [
                'btn' => 'Warning Alert',
                'title' => 'Subscription Warning',
                'msg' => 'Your current subscription plan will expire in 3 days.',
            ],
            'error' => [
                'btn' => 'Error Alert',
                'title' => 'Authentication Failed',
                'msg' => 'The email and password combination provided does not match our records.',
            ],
        ],
    ],

    // Section 2: Confirm Dialog
    'confirm' => [
        'title' => 'Interactive Confirmation Dialog',
        'desc' => 'The <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">buttons</code> option enables you to specify custom action buttons with event callbacks.',
        'preview_title' => 'Action Confirmation Dialog',
        'open_btn' => 'Delete File (Confirm)',
        'dialog_title' => 'Delete Confirmation',
        'dialog_msg' => 'Are you sure you want to permanently delete this document?',
        'yes_btn' => 'Yes, Delete Now',
        'cancel_btn' => 'Cancel',
        'confirmed_title' => 'Deleted',
        'confirmed_msg' => 'Document was successfully removed from the system.',
        'cancelled_title' => 'Cancelled',
        'cancelled_msg' => 'Deletion action was aborted.',
    ],

    // Section 3: Positions
    'positions' => [
        'title' => 'Screen Anchor Positions',
        'desc' => 'Supports 7 anchor positions via the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">position</code> option: <code class="font-mono text-xs text-foreground">center</code> (default), <code class="font-mono text-xs text-foreground">top-center</code>, <code class="font-mono text-xs text-foreground">bottom-center</code>, <code class="font-mono text-xs text-foreground">top-right</code>, <code class="font-mono text-xs text-foreground">top-left</code>, <code class="font-mono text-xs text-foreground">bottom-right</code>, and <code class="font-mono text-xs text-foreground">bottom-left</code>.',
        'preview_title' => 'Alert Placement Positions',
        'demo_title' => 'Position Dialog',
        'demo_msg' => 'Alert dialog positioned at :position.',
        'items' => [
            'center' => 'Center (Default)',
            'top_center' => 'Top Center',
            'bottom_center' => 'Bottom Center',
            'top_right' => 'Top Right',
            'top_left' => 'Top Left',
            'bottom_right' => 'Bottom Right',
            'bottom_left' => 'Bottom Left',
        ],
    ],

    // Section 4: Buttons Layout
    'buttons' => [
        'title' => 'Button Orientation (Row vs Col)',
        'desc' => 'Use the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">buttonLayout: "row" | "col"</code> option to arrange action buttons horizontally or stacked vertically.',
        'preview_title' => 'Action Buttons Orientation',
        'row_btn' => 'Horizontal Row',
        'col_btn' => 'Vertical Column',
        'row_title' => 'Save Changes?',
        'row_msg' => 'Buttons are placed side-by-side horizontally.',
        'col_title' => 'Advanced Action Choices',
        'col_msg' => 'Buttons are stacked vertically on top of each other.',
    ],

    // Section 5: Sound & Timeout
    'sound_timeout' => [
        'title' => 'Audio Chimes & Auto-Dismiss Duration',
        'desc' => 'Use <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">sound: "chime" | "pop"</code> for browser Web Audio chimes, and <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">timeout</code> for auto-dismiss timers.',
        'preview_title' => 'Audio & Duration Controls',
        'sound_btn' => 'Alert with Audio Chime',
        'timeout_fast_btn' => 'Auto-Close 3 Seconds',
        'timeout_sticky_btn' => 'Sticky Alert (Persistent)',
    ],

    // Section 6: Backdrop Blur
    'blur' => [
        'title' => 'Custom Backdrop Blur',
        'desc' => 'Use the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">blur: "sm" | "md" | "lg" | "none"</code> option for frosted glass backdrop blur intensity.',
        'preview_title' => 'Glassmorphism Backdrop Blur',
        'open_btn' => 'Open Alert with Intense Blur (lg)',
        'dialog_title' => 'Exclusive Focus',
        'dialog_msg' => 'The background is intensely blurred to keep focus entirely on this modal.',
    ],

    // Section 7: Persist State
    'persist' => [
        'title' => 'Dialog Persistence (LocalStorage)',
        'desc' => 'Enable <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">persist: true</code> to store dismissal state in LocalStorage so the dialog only shows once.',
        'preview_title' => 'Show-Once Persist Alert',
        'open_btn' => 'Open Persistent Alert',
        'reset_btn' => 'Reset LocalStorage State',
        'dialog_title' => 'Cookie & Privacy Policy',
        'dialog_msg' => 'This alert dialog is shown only once. Once acknowledged, it will not appear again.',
    ],

    // Section 8: Integration Methods
    'integration' => [
        'title' => 'Invocation Methods',
        'desc' => 'Alert modals can be triggered across various touchpoints: global JavaScript helper, Blade directive, or Livewire browser events.',
    ],

    // Section 9: Programmatic Control
    'programmatic' => [
        'title' => 'Programmatic Control ($vibe.alert & $vibe.alerts)',
        'desc' => 'Alert dialogs can be triggered declaratively from Alpine.js templates using the magic helper <code class="font-mono text-xs bg-muted px-1.5 py-0.5 rounded text-foreground">$vibe.alert</code> or from vanilla JavaScript via <code class="font-mono text-xs bg-muted px-1.5 py-0.5 rounded text-foreground">window.$vibe.alert</code>. To close all active alert dialogs, use <code class="font-mono text-xs bg-muted px-1.5 py-0.5 rounded text-foreground">$vibe.alerts.close()</code>.',
        'preview_title' => 'Alert Programmatic Control Demo',
        'success_btn' => 'Success Alert',
        'error_btn' => 'Error Alert',
        'warning_btn' => 'Warning Alert',
        'info_btn' => 'Info Alert',
        'confirm_btn' => 'Confirmation Dialog',
        'close_all_btn' => 'Close All Alerts ($vibe.alerts.close)',
        'success_title' => 'Operation Succeeded',
        'success_msg' => 'Your data has been safely saved to the cloud.',
        'error_title' => 'An Error Occurred',
        'error_msg' => 'Failed to process transaction. Please try again.',
        'warning_title' => 'Security Warning',
        'warning_msg' => 'Your session is about to expire in a few minutes.',
        'info_title' => 'Important Notice',
        'info_msg' => 'Server maintenance is scheduled for tonight at 00:00.',
        'confirm_title' => 'Confirm Proceed Action',
        'confirm_msg' => 'Are you sure you want to proceed with this action?',
        'confirm_yes' => 'Yes, Proceed',
        'confirm_toast' => 'Action successfully confirmed!',
    ],

    // Section 10: Props Reference
    'props' => [
        'title' => 'Options Reference (API Payload)',
        'desc' => 'Comprehensive listing of parameters accepted by <code class="font-mono text-xs text-foreground">vibeAlert(options)</code> or the <code class="font-mono text-xs text-foreground">$vibe.alert</code> helper.',
        'columns' => [
            'prop' => 'Option',
            'type' => 'Type',
            'default' => 'Default',
            'desc' => 'Description',
        ],
        'events_title' => 'Window Events & $vibe Helper Reference',
        'events_desc' => 'Global browser events and $vibe Alpine.js helpers to trigger or dismiss alert dialogs.',
        'th_event' => 'Event Name / Helper',
        'th_payload' => 'Payload',
        'th_event_desc' => 'Description',
        'events' => [
            [
                'name' => "alert / \$vibe.alert(payload)",
                'payload' => 'object|string',
                'desc' => 'Triggers a new alert dialog with specified message and configuration options.',
            ],
            [
                'name' => "\$vibe.alert.success(message, title?)",
                'payload' => 'string, string?',
                'desc' => 'Shorthand to display a success alert notification dialog.',
            ],
            [
                'name' => "\$vibe.alert.error(message, title?)",
                'payload' => 'string, string?',
                'desc' => 'Shorthand to display an error alert notification dialog.',
            ],
            [
                'name' => "\$vibe.alert.warning(message, title?)",
                'payload' => 'string, string?',
                'desc' => 'Shorthand to display a warning alert notification dialog.',
            ],
            [
                'name' => "\$vibe.alert.info(message, title?)",
                'payload' => 'string, string?',
                'desc' => 'Shorthand to display an info alert notification dialog.',
            ],
            [
                'name' => "\$vibe.alert.confirm(options)",
                'payload' => 'object',
                'desc' => 'Triggers an interactive confirmation action dialog with primary and secondary action buttons.',
            ],
            [
                'name' => "close-alert / \$vibe.alert.close(id)",
                'payload' => 'string (alertId)',
                'desc' => 'Closes a specific alert dialog matching the given ID.',
            ],
            [
                'name' => "\$vibe.alerts.close()",
                'payload' => "'*'",
                'desc' => 'Closes and dismisses all active alert dialogs on screen.',
            ],
        ],
    ],

    'props_items' => [
        'container' => [
            'position' => 'Default placement position of the alert notification container on screen.',
            'align' => 'Content alignment of text and icons inside the alert body.',
            'timeout' => 'Auto-dismiss delay duration in milliseconds (or false for persistent alerts).',
            'sound' => 'Play synthesized Web Audio API chime (true) or external audio URL string.',
            'blur' => 'Container backdrop blur intensity (e.g., "md", "lg", or true).',
            'closeOnOutside' => 'Close alert when clicking outside (default: true for standard alerts, false for confirm).',
        ],
        'payload' => [
            'type' => 'Alert status type determining background color palette, accent border, and default icon.',
            'title' => 'Main alert title.',
            'message' => 'Full description message communicated to the user.',
            'icon' => 'Custom SVG icon element to replace default status icon.',
            'position' => 'Override placement position specifically for this alert.',
            'align' => 'Override horizontal alignment of text and icons specifically for this alert.',
            'timeout' => 'Override auto-dismiss duration (false to keep open until user dismisses).',
            'blocking' => 'Display dark modal overlay backdrop with blur behind alert.',
            'blur' => 'Display backdrop with specific blur intensity ("sm", "md", "lg", "xl", true, false).',
            'sound' => 'Override sound effect preference on alert appearance.',
            'confirmButton' => 'Confirm button config: string text or object { text, action, class }.',
            'closeButton' => 'Close/cancel button config: string text or object { text, action, class }.',
            'buttonLayout' => 'Button layout direction: "col" for vertical stack or "row" for horizontal.',
            'closeOnOutside' => 'Whether alert can be closed by clicking outside.',
            'id' => 'Unique alert ID. Required if using persist: true.',
            'persist' => 'Persist dismissed state so alert does not re-appear: true, string key, or "session".',
        ],
    ],
];
