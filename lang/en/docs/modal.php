<?php

return [
    'title' => 'Modal Dialog',
    'badge' => 'Component',
    'group' => 'Overlay & Dialog',
    'description' => 'A versatile, modern modal dialog component featuring smooth entry/exit animations, blurred backdrops, automatic form auto-focus, responsive maxWidth sizing, vertical positioning, non-dismissible mode, and seamless Alpine.js & Livewire 3 event integration.',

    // Section 1: Basic Usage
    'basic_usage' => [
        'title' => 'Basic Usage',
        'desc' => 'Use the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:modal&gt;</code> component paired with semantic subcomponents: <code class="font-mono text-xs text-foreground">&lt;vibe:modal.header&gt;</code>, <code class="font-mono text-xs text-foreground">&lt;vibe:modal.content&gt;</code>, <code class="font-mono text-xs text-foreground">&lt;vibe:modal.footer&gt;</code>, and <code class="font-mono text-xs text-foreground">&lt;vibe:modal.close&gt;</code>. Open it from any trigger by dispatching the Alpine window event <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">$dispatch(\'open-modal\', \'modal-id\')</code>.',
        'preview_title' => 'Simple Modal',
        'btn' => 'Open Simple Modal',
        'modal_title' => 'Welcome to Vibe UI',
        'modal_desc' => 'This is a clean, structured modal dialog built with compound subcomponents, smooth animations, and an elegant blurred backdrop.',
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
        'field_name' => 'Full Name',
        'field_name_placeholder' => 'e.g. John Doe',
        'field_email' => 'Email Address',
        'field_email_placeholder' => 'john@example.com',
        'field_role' => 'Account Role',
        'field_role_placeholder' => 'Select role...',
        'role_admin' => 'Administrator',
        'role_editor' => 'Editor',
        'role_viewer' => 'Viewer (Read-only)',
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
                'feature_title' => 'What\'s New?',
        'feature_1' => 'Vite sync plugin performance boost up to 40%.',
        'feature_2' => 'Added soft and glassmorphism button variants.',
        'feature_3' => 'Adaptive OS-based dark mode support.',
        'btn_dismiss' => 'Got It (Close Permanently)',
        'btn_understand' => 'Close Modal & Save State',
        'announcement_note' => 'Announcement Popups Note: To create an announcement modal that appears immediately on first page load and never appears again once closed, combine props <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:show="true" :persist="true"</code>.',
    ],

    // Section 7: Livewire Integration
    'livewire' => [
        'title' => 'Livewire 3 Integration',
        'desc' => 'Open and close modals programmatically from your Livewire component backend using event dispatch <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">$this->dispatch()</code>.',
        'preview_title' => 'Livewire Integration Code',
        'backend_title' => 'Backend Component (PHP)',
        'frontend_title' => 'Blade View (Frontend)',
    ],

    // Section 8: Programmatic Control
    'programmatic' => [
        'title' => 'Programmatic Control ($vibe.modal & $vibe.modals)',
        'desc' => 'Modals can be controlled declaratively from Alpine.js templates using the magic helper <code class="font-mono text-xs bg-muted px-1.5 py-0.5 rounded text-foreground">$vibe.modal(\'id\')</code> or from vanilla JavaScript via <code class="font-mono text-xs bg-muted px-1.5 py-0.5 rounded text-foreground">window.$vibe.modal(\'id\')</code>. To close all active modals at once, use <code class="font-mono text-xs bg-muted px-1.5 py-0.5 rounded text-foreground">$vibe.modals.close()</code>.',
        'preview_title' => 'Modal Programmatic Control Demo',
        'open_btn' => 'Open Modal ($vibe.modal.show)',
        'toggle_btn' => 'Toggle Modal',
        'close_all_btn' => 'Close All Modals ($vibe.modals.close)',
        'modal_title' => 'Programmatic Control Modal',
        'modal_desc' => 'This modal is controlled via the $vibe helper API:',
        'close_btn' => 'Close via $vibe.modal().close()',
        'close_btn_short' => 'Close ($vibe.modal.close)',
        'close_all_modal_btn' => 'Close via $vibe.modals.close()',
        'close_all_modal_btn_short' => 'Close All ($vibe.modals.close)',
    ],

    // Section 9: Props Table
    'props' => [
        'title' => 'Properties & API Reference',
        'desc' => 'List of configurable attributes and properties available for the <code class="font-mono text-xs text-foreground">&lt;vibe:modal&gt;</code> component.',
        'subcomponents_title' => 'Modal Subcomponents Anatomy',
        'subcomponents_desc' => 'Semantic subcomponents available to build structured, accessible modal dialogs.',
        'th_sub' => 'Subcomponent',
        'th_sub_desc' => 'Role & Description',
        'subcomponents' => [
            [
                'name' => '<vibe:modal.header>',
                'desc' => 'Top header bar with default vertical layout (flex-col), text-lg font-semibold, and border divider (border-b).',
            ],
            [
                'name' => '<vibe:modal.content>',
                'desc' => 'Main scrollable body container (overflow-y-auto) with default padding (p-6).',
            ],
            [
                'name' => '<vibe:modal.footer>',
                'desc' => 'Bottom action bar with right-aligned flex layout, top border (border-t), and subtle muted background.',
            ],
            [
                'name' => '<vibe:modal.close>',
                'desc' => 'Dismiss cross button with pre-configured Alpine close() click handler. Automatically rendered at the top-right corner when dismissibleButton is true.',
            ],
        ],
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
                'name' => 'variant',
                'type' => 'string',
                'default' => '\'default\'',
                'desc' => 'Card visual style variant (\'default\', \'elevated\', \'outline\', \'flat\', \'container\').',
            ],
            [
                'name' => 'dismissible',
                'type' => 'bool',
                'default' => 'true',
                'desc' => 'Allows closing via outside backdrop clicks and the Escape key.',
            ],
            [
                'name' => 'dismissibleButton',
                'type' => 'bool',
                'default' => 'true',
                'desc' => 'Whether the top-right corner close cross button (X) is rendered.',
            ],
            [
                'name' => 'show',
                'type' => 'bool',
                'default' => 'false',
                'desc' => 'Whether the modal should be open immediately when the page renders.',
            ],
            [
                'name' => 'persist',
                'type' => 'bool',
                'default' => 'false',
                'desc' => 'Stores modal open/close state in browser LocalStorage so the modal automatically stays open upon page refresh if not yet closed.',
            ],
            [
                'name' => 'teleport',
                'type' => 'bool',
                'default' => 'true',
                'desc' => 'Teleports modal markup to document <body> to escape container overflow clipping.',
            ],
            [
                'name' => 'containerClass',
                'type' => 'string',
                'default' => 'null',
                'desc' => 'Additional CSS classes for the outermost fixed container.',
            ],
            [
                'name' => 'backdropClass',
                'type' => 'string',
                'default' => 'null',
                'desc' => 'Additional CSS classes for the backdrop overlay.',
            ],
        ],
        'events_title' => 'Window Events Reference (Alpine.js & Livewire)',
        'events_desc' => 'Global events listened to by the modal component on the browser window object.',
        'th_event' => 'Event Name',
        'th_payload' => 'Payload',
        'th_event_desc' => 'Description',
        'events' => [
            [
                'name' => "open-modal / \$vibe.modal('id').show()",
                'payload' => 'string (modalId)',
                'desc' => 'Opens the modal matching the specified modal ID.',
            ],
            [
                'name' => "close-modal / \$vibe.modal('id').close()",
                'payload' => 'string (modalId)',
                'desc' => 'Closes the modal matching the specified modal ID.',
            ],
            [
                'name' => "toggle-modal / \$vibe.modal('id').toggle()",
                'payload' => 'string (modalId)',
                'desc' => 'Toggles the open/close state of the matching modal ID.',
            ],
            [
                'name' => "\$vibe.modals.close()",
                'payload' => "'*'",
                'desc' => 'Closes all currently open modals on the page.',
            ],
        ],
    ],

    'common' => [
        'btn_close' => 'Close',
        'btn_cancel' => 'Cancel',
        'btn_save' => 'Save',
        'compound_desc_code' => 'Vibe UI modal structure now supports clean, modular compound subcomponents: <vibe:modal.header>, <vibe:modal.content>, and <vibe:modal.footer>.',
        'compound_desc' => 'This modal dialog built on compound subcomponents features neatly isolated header, content, and footer sections. You can also apply custom styles via the class="..." attribute.',
        'sm_desc' => 'Small modal size (sm) for compact notices.',
        'sm_content' => 'Modal content in sm size (max-w-sm).',
        'default_desc' => 'Standard default 2xl size suitable for most dialogs.',
        'default_content' => 'Modal content in standard 2xl size (max-w-2xl).',
        'lg_desc' => 'Large 5xl modal size for wide data presentations.',
        'lg_content' => 'Modal content in 5xl size (max-w-5xl).',
        'full_desc' => 'Fullscreen modal size for immersive workflows.',
        'full_content' => 'Modal content filling the entire screen (w-screen h-screen).',
        'pos_desc' => 'This modal is configured with prop position="{position}". The dialog slides in and transitions from that direction.',
    ],
];
