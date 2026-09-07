<?php

return [
    'title' => 'Modal Dialog',
    'badge' => 'Component',
    'group' => 'Overlay & Dialog',
    'description' => 'A versatile, modern modal dialog component featuring smooth entry/exit animations, blurred backdrops, automatic form auto-focus, responsive maxWidth sizing, vertical positioning, non-dismissible mode, and seamless Alpine.js & Livewire 3 event integration.',

    // Section 1: Basic Usage
    'basic_usage' => [
        'title' => 'Basic Usage',
        'desc' => 'Use the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:modal&gt;</code> component with a unique <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">id</code>. Open it from any button or script by dispatching the Alpine window event <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">$dispatch(\'open-modal\', \'modal-id\')</code>.',
        'preview_title' => 'Simple Modal',
        'btn' => 'Open Simple Modal',
        'modal_title' => 'Welcome to Vibe UI',
        'modal_desc' => 'This is a standard modal dialog featuring smooth entry transitions, an elegant blurred backdrop, and a top-right dismiss button.',
        'btn_cancel' => 'Close',
        'btn_confirm' => 'Got It',
    ],

    // Section 2: Sizes
    'sizes' => [
        'title' => 'Size Options (maxWidth)',
        'desc' => 'Control the maximum width of the dialog using the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">maxWidth</code> prop. Supported values: <code class="font-mono text-xs text-foreground">sm</code>, <code class="font-mono text-xs text-foreground">md</code>, <code class="font-mono text-xs text-foreground">lg</code>, <code class="font-mono text-xs text-foreground">xl</code>, <code class="font-mono text-xs text-foreground">2xl</code> (default), <code class="font-mono text-xs text-foreground">3xl</code>, <code class="font-mono text-xs text-foreground">4xl</code>, <code class="font-mono text-xs text-foreground">5xl</code>, <code class="font-mono text-xs text-foreground">6xl</code>, <code class="font-mono text-xs text-foreground">7xl</code>, and <code class="font-mono text-xs text-foreground">full</code>.',
        'preview_title' => 'Modal Size Variations',
        'sm_btn' => 'Small (sm)',
        'md_btn' => 'Medium (md)',
        'lg_btn' => 'Large (lg)',
        'xl2_btn' => 'Standard (2xl - Default)',
        'xl4_btn' => 'Extra Large (4xl)',
        'full_btn' => 'Full Width (full)',
        'modal_title' => 'Modal Size: :size',
        'modal_desc' => 'This modal is rendered with prop <code class="font-mono text-xs">maxWidth=":size"</code>. Choose the right size according to your content density.',
        'btn_close' => 'Close Modal',
    ],

    // Section 3: Positions
    'positions' => [
        'title' => 'Vertical Screen Position',
        'desc' => 'Use the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">position</code> prop to adjust the dialog vertical alignment: <code class="font-mono text-xs text-foreground">center</code> (default middle), <code class="font-mono text-xs text-foreground">top</code> (top of viewport, great for search bars or command palettes), and <code class="font-mono text-xs text-foreground">bottom</code> (bottom sheets).',
        'preview_title' => 'Modal Position Variations',
        'top_btn' => 'Top Position (top)',
        'center_btn' => 'Center Position (center)',
        'bottom_btn' => 'Bottom Position (bottom)',
        'modal_title' => 'Position: :position',
        'modal_desc' => 'This modal is configured with prop <code class="font-mono text-xs">position=":position"</code>.',
        'btn_close' => 'Close Modal',
    ],

    // Section 4: Non-Dismissible / Static Modal
    'non_dismissible' => [
        'title' => 'Static Modal (Non-Dismissible)',
        'desc' => 'Pass <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">dismissible="false"</code> (or <code class="font-mono text-xs text-foreground">:dismissible="false"</code>) to prevent the modal from closing when clicking outside on the backdrop or showing the cross button. The user must explicitly choose an action button inside the dialog.',
        'preview_title' => 'Mandatory Action Dialog',
        'btn' => 'Open Static Modal',
        'modal_title' => 'Confirm Critical Action',
        'modal_desc' => 'This action is permanent and cannot be undone. Clicking the backdrop or pressing Escape will not dismiss this dialog.',
        'btn_cancel' => 'Cancel',
        'btn_confirm' => 'Yes, Proceed Now',
    ],

    // Section 5: Form with Auto-focus
    'form_modal' => [
        'title' => 'Forms & Automatic Auto-focus',
        'desc' => 'The Vibe UI modal component automatically detects and focuses the first available form element (<code class="font-mono text-xs text-foreground">input</code>, <code class="font-mono text-xs text-foreground">select</code>, or <code class="font-mono text-xs text-foreground">textarea</code>) as soon as the opening animation finishes.',
        'preview_title' => 'Interactive Form Modal',
        'btn' => 'Open Form Modal',
        'modal_title' => 'Add New User Account',
        'modal_desc' => 'The text cursor is automatically focused on the Full Name input field when this modal opens.',
        'name_label' => 'Full Name',
        'name_placeholder' => 'e.g. John Doe',
        'email_label' => 'Email Address',
        'email_placeholder' => 'john@example.com',
        'role_label' => 'Account Role',
        'role_placeholder' => 'Select role...',
        'role_admin' => 'Administrator',
        'role_editor' => 'Editor',
        'role_user' => 'Standard User',
        'btn_cancel' => 'Cancel',
        'btn_submit' => 'Save User',
    ],

    // Section 6: Persist / Modal Persistence
    'persist' => [
        'title' => 'Modal State Persistence (persist)',
        'desc' => 'Add the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:persist="true"</code> prop to store the modal\'s state in <code class="font-mono text-xs text-foreground">localStorage</code>. When the modal is opened and the page is refreshed without closing it, the modal will <strong>automatically stay visible</strong> upon page reload. The state only resets to closed when the user clicks close, clicks the backdrop, or presses ESC.',
        'preview_title' => 'Modal State Persistence Demo',
        'btn' => 'Open Persistent Modal',
        'reset_btn' => 'Reset LocalStorage State',
        'reset_toast' => 'Modal persistence state reset! You can test it again.',
        'modal_title' => 'Modal with State Persistence',
        'modal_desc' => 'This modal uses :persist="true". Try refreshing your browser now (F5 / Ctrl+R / Cmd+R) without closing this modal—the modal will automatically reopen after page reload!',
        'reload_tip' => '💡 <strong>Try it out:</strong> Do not close this modal, try refreshing the browser (F5 / Ctrl+R / Cmd+R). You will see this modal remain visible upon reload!',
        'btn_understand' => 'Close Modal & Save State',
        'announcement_note' => 'Announcement Popups Note: To create an announcement modal that appears immediately on first page load and never appears again once closed, combine props <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:show="true" :persist="true"</code>.',
    ],

    // Section 7: Livewire Integration
    'livewire' => [
        'title' => 'Livewire 3 Integration',
        'desc' => 'Open and close modals programmatically from your Livewire component backend using event dispatch <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">$this-&gt;dispatch()</code>.',
        'preview_title' => 'Livewire Integration Code',
        'backend_title' => 'Backend Component (PHP)',
        'frontend_title' => 'Blade View (Frontend)',
    ],

    // Section 8: Props Table
    'props' => [
        'title' => 'Properties & API Reference',
        'desc' => 'List of configurable attributes and properties available for the <code class="font-mono text-xs text-foreground">&lt;vibe:modal&gt;</code> component.',
        'th_prop' => 'Property',
        'th_type' => 'Type',
        'th_default' => 'Default',
        'th_desc' => 'Description',
        'items' => [
            [
                'name' => 'id',
                'type' => 'string',
                'default' => 'uniqid()',
                'desc' => 'Unique modal ID used for open-modal and close-modal window events.',
            ],
            [
                'name' => 'show',
                'type' => 'bool',
                'default' => 'false',
                'desc' => 'Whether the modal should be open immediately when the page renders.',
            ],
            [
                'name' => 'maxWidth',
                'type' => 'string',
                'default' => '\'2xl\'',
                'desc' => 'Maximum dialog container width: sm, md, lg, xl, 2xl, 3xl, 4xl, 5xl, 6xl, 7xl, or full.',
            ],
            [
                'name' => 'position',
                'type' => 'string',
                'default' => '\'center\'',
                'desc' => 'Vertical position of the modal: \'top\', \'center\', or \'bottom\'.',
            ],
            [
                'name' => 'dismissible',
                'type' => 'bool',
                'default' => 'true',
                'desc' => 'Allows closing via the top-right cross icon and backdrop outside clicks.',
            ],
            [
                'name' => 'persist',
                'type' => 'bool',
                'default' => 'false',
                'desc' => 'Stores modal open/close state in browser LocalStorage so the modal automatically stays open upon page refresh if not yet closed.',
            ],
        ],
        'events_title' => 'Window Events Reference (Alpine.js & Livewire)',
        'events_desc' => 'Global events listened to by the modal component on the browser window object.',
        'th_event' => 'Event Name',
        'th_payload' => 'Payload',
        'th_event_desc' => 'Description',
        'events' => [
            [
                'name' => 'open-modal',
                'payload' => 'string (modalId)',
                'desc' => 'Opens the modal matching the specified modal ID.',
            ],
            [
                'name' => 'close-modal',
                'payload' => 'string (modalId)',
                'desc' => 'Closes the modal matching the specified modal ID.',
            ],
        ],
    ],
];
