<?php

return [
    'title' => 'Form',
    'badge' => 'Component',
    'group' => 'UI Components',
    'description' => 'A smart form wrapper component engineered for seamless form layout management, debounced draft auto-saving to sessionStorage or localStorage, automatic state restoration on page reloads or modal/sheet openings, and automatic draft cleanup upon submission.',

    // Section 1: Basic Usage
    'basic_usage' => [
        'title' => 'Basic Usage',
        'desc' => 'Use the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:form&gt;</code> component to encapsulate input fields and actions. It accepts standard HTML form attributes such as <code class="font-mono text-xs text-foreground">action</code>, <code class="font-mono text-xs text-foreground">method</code>, and Alpine/Livewire directives.',
        'preview_title' => 'Simple Contact Form',
        'name_label' => 'Full Name',
        'name_placeholder' => 'Enter your full name...',
        'email_label' => 'Email Address',
        'email_placeholder' => 'name@example.com',
        'message_label' => 'Message / Inquiry',
        'message_placeholder' => 'Write your message here...',
        'submit_btn' => 'Send Message',
    ],

    // Section 2: Session Storage (storageType="session")
    'session_storage' => [
        'title' => 'Draft Persistence in Session Storage (storageType="session")',
        'desc' => 'For temporary or sensitive forms, specify <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">storage-type="session"</code> along with <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:save-to-storage="true"</code>. Data will be held in the browser\'s <code class="font-mono text-xs text-foreground">window.sessionStorage</code>. Form draft values remain safe on page refreshes, but are automatically and securely discarded the moment the user closes the browser tab.',
        'preview_title' => 'Session Storage Form (Tab-Scoped)',
        'checkout_title' => 'Temporary Checkout & Transaction Data',
        'card_holder' => 'Account / Card Holder Name',
        'card_number' => 'Transaction ID / Reference',
        'notes' => 'Transaction Special Instructions',
        'notes_placeholder' => 'Enter special notes...',
        'submit_btn' => 'Process Transaction',
        'clear_btn' => 'Clear Session Draft',
        'badge' => 'Session Storage Active',
        'hint' => 'Data is saved into this tab\'s sessionStorage. Try refreshing the page to see your values preserved, or close the tab to verify automatic cleanup.',
    ],

    // Section 3: Local Storage (storageType="local")
    'local_storage' => [
        'title' => 'Long-Term Drafts in Local Storage (storageType="local")',
        'desc' => 'Use <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">storage-type="local"</code> for extensive inputs such as blog posts, multi-step registrations, or lengthy documents. Data is committed to <code class="font-mono text-xs text-foreground">window.localStorage</code> and persists across tab closures and browser restarts, with an expiration threshold controlled by <code class="font-mono text-xs text-foreground">expire-hours</code>.',
        'preview_title' => 'Article Draft Form (Local Storage)',
        'article_title' => 'Article Title / Long Document',
        'article_placeholder' => 'Type article draft title...',
        'content_label' => 'Full Content',
        'content_placeholder' => 'Type extensive draft content to be persisted across browser sessions...',
        'submit_btn' => 'Publish Draft',
        'reset_btn' => 'Reset Form',
        'hint' => 'Data is cached in localStorage. Your draft stays safe even if you quit and restart your browser!',
        'security_title' => 'Security Notice: Avoid Storing Confidential / Sensitive Data in Local Storage',
        'security_desc' => '<code>window.localStorage</code> persists unencrypted plain-text and can be read by any JavaScript executing on the same origin domain (posing a serious risk if Cross-Site Scripting / XSS is introduced).',
        'security_points' => [
            'sensitive' => '<strong>Avoid Sensitive Credentials:</strong> Never cache passwords, credit card numbers, CVV codes, PINs, secret authentication tokens, or sensitive Personally Identifiable Information (PII).',
            'shared_device' => '<strong>Shared Devices:</strong> Data in localStorage is not cleared when browser windows are closed, potentially exposing uncommitted drafts to subsequent users on shared computers.',
            'alternative' => '<strong>Prefer Session Storage:</strong> For sensitive checkout or temporary payment forms, always prefer <code class="font-mono text-xs text-foreground">storage-type="session"</code> so values are discarded immediately upon closing the tab.',
        ],
    ],

    // Section 4: Multi-Column Grid Layout
    'grid_layout' => [
        'title' => 'Multi-Column Grid Layouts',
        'desc' => 'Organize input fields responsively using Tailwind grid systems directly on <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:form class="grid grid-cols-1 md:grid-cols-2 gap-4"&gt;</code>.',
        'preview_title' => 'Multi-Column Registration Form',
        'first_name' => 'First Name',
        'last_name' => 'Last Name',
        'phone' => 'Phone / WhatsApp Number',
        'role' => 'Job Title',
        'address' => 'Full Street Address',
        'address_placeholder' => 'Street address, building number, suite...',
        'save_btn' => 'Register Account',
        'cancel_btn' => 'Cancel',
    ],

    // Section 5: Card Form Layout
    'card_form' => [
        'title' => 'Form inside Card Component',
        'desc' => 'Pair <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:card&gt;</code> with <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:form&gt;</code> for organized, professional settings panels or registration views.',
        'preview_title' => 'Account Profile Settings',
        'card_title' => 'Profile Information',
        'card_desc' => 'Update your personal information and preferences used across the platform.',
        'username' => 'Username',
        'bio' => 'Short Bio',
        'bio_placeholder' => 'Tell us briefly about your role and expertise...',
        'save_changes' => 'Save Changes',
        'cancel_btn' => 'Cancel',
    ],

    // Section 6: Modal & Sheet Awareness
    'modal_sheet' => [
        'title' => 'Modal & Sheet Integration',
        'desc' => 'The <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:form&gt;</code> component automatically listens to <code class="font-mono text-xs text-foreground">open-modal</code> and <code class="font-mono text-xs text-foreground">open-sheet</code> events, ensuring drafts are restored whenever a dialog or slide-out drawer is opened without interference from Livewire/Alpine resets.',
        'card_title' => 'Automatic Window Events Support',
        'card_subtitle' => 'Compatible with Livewire resets and dynamic modal dialogs.',
        'card_desc' => 'When <code class="px-1 py-0.5 rounded bg-muted text-[11px] font-mono text-foreground">&lt;vibe:form&gt;</code> is nested inside <code class="px-1 py-0.5 rounded bg-muted text-[11px] font-mono text-foreground">&lt;vibe:modal&gt;</code> or <code class="px-1 py-0.5 rounded bg-muted text-[11px] font-mono text-foreground">&lt;vibe:sheet&gt;</code>, the script automatically listens for browser <code class="font-mono text-foreground">open-modal</code> and <code class="font-mono text-foreground">open-sheet</code> events to restore draft inputs even after Livewire component re-initializations.',
    ],

    // Section 7: Props Reference
    'props' => [
        'title' => 'Props & Features Reference',
        'desc' => 'Detailed specification of attributes and options supported by <code class="font-mono text-xs text-foreground">&lt;vibe:form&gt;</code>.',
        'columns' => [
            'prop' => 'Prop',
            'type' => 'Type',
            'default' => 'Default',
            'desc' => 'Description',
        ],
    ],

    'features' => [
        'title' => 'Automated Mechanisms & Events',
        'columns' => [
            'feature' => 'Feature / Event',
            'desc' => 'Behavior & Usage',
        ],
    ],

    'ajax_alert' => [
        'success_title' => 'Form Testing (AJAX / Fetch) Successfully Posted to FormController!',
        'time_prefix' => 'Time:',
        'fields_suffix' => 'fields received via JSON (no refresh)',
        'view_payload_btn' => 'View JSON Payload',
    ],

    'props_items' => [
        'id' => 'Unique form ID. Required if `saveToStorage` is enabled as draft storage key.',
        'ajax' => 'Enable AJAX/fetch submission. If <code>false</code>, the form performs a standard browser submit (full page reload).',
        'saveToStorage' => 'If `true`, automatically persists form input drafts to browser storage on every keystroke.',
        'storageType' => "Browser storage mechanism: `'session'` (sessionStorage, secure & cleared when tab closes) or `'local'` (localStorage, persistent).",
        'expireHours' => 'Draft expiration duration in hours before automatically cleaned up.',
        'status' => 'Automatic notification after submission. <code>true</code> or <code>\'toast\'</code> = display <strong>Toast</strong> (default). <code>\'alert\'</code> = display pop-up <strong>Alert</strong>.',
        'delay' => 'Delay duration (milliseconds) before executing <code>onSuccess</code> or <code>redirect-to</code>. Auto-defaults to <code>1000ms</code> if status is active with follow-up action.',
        'redirectTo' => 'Destination redirect URL after successful submit. Also supports auto-resolving <code>data.redirect</code> from server JSON response.',
        'onSuccess' => 'JavaScript expression executed after <code>delay</code> upon success. Example: <code>$vibe.sheet(\'id\').close()</code> or <code>$vibe.modal(\'id\').close()</code>.',
        'onError' => 'JavaScript expression executed when the request fails/errors.',
        'confirmPassword' => 'Automatically displays an in-place password confirmation modal when the server responds with HTTP 423 (Password Confirmation Required), then auto-replays the pending form submission upon verification without page reload.',
        'confirmPasswordUrl' => 'Password verification endpoint URL (POST). Defaults to <code>/confirm-password</code> or route <code>password.confirm.post</code>.',
    ],

    'storage_comparison' => [
        'title' => 'sessionStorage vs localStorage Comparison',
        'columns' => [
            'mechanism' => 'Mechanism',
            'location' => 'Location',
            'lifetime' => 'Data Lifetime',
            'best_for' => 'Best Use Cases',
        ],
        'session_location' => 'Browser (sessionStorage)',
        'session_lifetime' => 'While tab is active (cleared on tab close)',
        'session_best_for' => 'Checkout forms, payment transactions, multi-step wizards, sensitive data.',
        'local_location' => 'Browser (localStorage)',
        'local_lifetime' => 'Persists across browser sessions (up to expireHours)',
        'local_best_for' => 'Long-form article drafts, large profile forms, recurring document drafts.',
        'local_warning' => '⚠️ Avoid storing passwords, tokens, or financial data.',
    ],

    'features_items' => [
        'debounce' => 'Debounces input changes by 500 milliseconds before writing to storage to avoid degrading browser performance.',
        'clear' => 'Automatically deletes form drafts from storage when the form is submitted successfully.',
        'modal_sheet' => 'Automatically restores form drafts when modal dialogs or slide-out drawers open.',
        'sanitize' => 'Automatically sanitizes and excludes binary files, CSRF tokens (<code class="font-mono text-xs text-foreground">_token</code>), and Livewire internal state.',
    ],

    'notifications' => [
        'title' => 'Automatic Error Notifications (:status="true")',
        'desc' => 'Enable the <code class="px-1 py-0.5 rounded bg-muted text-[11px] font-mono text-foreground">:status="true"</code> attribute so the form automatically displays <strong>error</strong> notifications when requests fail (validation, expired CSRF, server error, etc.). Defaults to <strong>Toast</strong>. Use <code class="px-1 py-0.5 rounded bg-muted text-[11px] font-mono text-foreground">status="alert"</code> to display an Alert pop-up. <strong>Success</strong> notifications are not displayed automatically — use <code class="font-mono text-[11px] px-1 py-0.5 rounded bg-muted">onSuccess</code> to configure them.',
        'toast_preview' => 'status="toast" — Error Toast (default)',
        'alert_preview' => 'status="alert" — Error Alert Pop-up',
        'error_parsing_title' => 'Automatic Error Parsing',
        'error_parsing_desc' => 'When a request fails, the system automatically parses server responses and presents clear user-facing messages.',
        'columns' => [
            'status' => 'HTTP Status',
            'title' => 'Notification Title',
            'message' => 'Message',
        ],
        'rows' => [
            ['422 Unprocessable Entity', 'Validation Failed', 'Displays clean Laravel validation error summaries per field.'],
            ['405 Method Not Allowed', '405 Method Not Allowed', 'HTTP method not supported. Check form method or route definition.'],
            ['419 Page Expired', '419 Page Expired', 'CSRF token expired or invalid. Please refresh the page.'],
            ['401 Unauthorized', '401 Unauthenticated', 'Your login session has ended. Please log in again.'],
            ['403 Forbidden', '403 Forbidden', 'You do not have permission to perform this action.'],
            ['404 Not Found', '404 Endpoint Not Found', 'The requested endpoint or record was not found on the server.'],
            ['423 Locked', '423 Password Confirmation Required', 'Password confirmation is required to proceed with this action.'],
            ['429 Too Many Requests', '429 Too Many Requests', 'Too many requests. Please wait a moment and try again.'],
            ['500 Server Error', '500 Internal Server Error', 'Server error message or generic failure fallback.'],
            ['Network Failure', 'Network Error', 'Unable to reach the server. Please check your internet connection.'],
        ],
    ],

    'post_submit' => [
        'title' => 'Post-Submit Actions (onSuccess, delay, redirect-to)',
        'desc' => 'Use the <code class="font-mono text-xs bg-muted px-1 py-0.5 rounded">onSuccess</code> attribute to execute JavaScript expressions after successful submission. The <code class="font-mono text-xs bg-muted px-1 py-0.5 rounded">status</code> prop only triggers on <strong>errors</strong> automatically — success alerts, closing modals/sheets, and redirects are managed via <code class="font-mono text-xs bg-muted px-1 py-0.5 rounded">onSuccess</code>.',
        'preview_sheet' => 'onSuccess: Toast + Close Sheet after submit',
        'sheet_btn' => 'Open Form Sheet',
        'sheet_title' => 'Form inside Sheet Drawer',
        'sheet_save' => 'Save Changes',
        'columns' => [
            'prop' => 'Attribute',
            'example' => 'Example Value',
            'desc' => 'Description',
        ],
        'rows' => [
            ['onSuccess / on-success', '\$vibe.sheet(\'demo-form-sheet\').close(); \$vibe.toast.success(\'Successfully saved!\')', 'Closes sheet + displays success toast after submission.'],
            ['onSuccess / on-success', '\$vibe.modal(\'demo-form-modal\').close(); \$vibe.toast.success(\'Successfully saved!\')', 'Closes modal + displays success toast after submission.'],
            ['delay', '500', 'Delay (ms) before onSuccess is executed. Default 0.'],
            ['redirect-to', '/users', 'Destination URL after successful submit (or resolved from server data.redirect).'],
        ],
    ],

    'confirm_submit' => [
        'title' => 'Submit Confirmation (submit())',
        'desc' => 'To require user confirmation before submitting a form, use <code class="font-mono text-xs bg-muted px-1 py-0.5 rounded">$vibe.alert.confirm(message, callback, title?)</code> alongside the built-in <code class="font-mono text-xs bg-muted px-1 py-0.5 rounded">submit()</code> method available in the form scope. Call <code class="font-mono text-xs bg-muted px-1 py-0.5 rounded">() => submit()</code> <strong>without</strong> <code class="font-mono text-xs bg-muted px-1 py-0.5 rounded">this</code>.',
        'preview_confirm' => 'Confirmation via $vibe.alert.confirm + submit()',
        'preview_custom' => 'Confirmation with Custom Title',
        'btn_confirm' => 'Save with Confirmation',
        'btn_delete' => 'Delete Data',
        'confirm_message' => 'Are you sure you want to save this data?',
        'delete_confirm_message' => 'This action cannot be undone. Are you sure you want to delete?',
        'delete_confirm_title' => 'Confirm Deletion',
        'columns' => [
            'api' => 'API',
            'signature' => 'Signature',
            'desc' => 'Description',
        ],
        'rows' => [
            ['submit()', 'submit()', 'Built-in form method. Call from @click without this: () => submit(). Sends form via AJAX without browser submission events.'],
            ['$vibe.alert.confirm()', 'confirm(message, onConfirm, title?)', 'Triggers an Alert confirmation dialog. If confirmed, the onConfirm callback executes.'],
            ['$vibe.alert.confirm()', 'confirm({ message, title, confirmButton, ... })', 'Object configuration — supports comprehensive custom Alert settings.'],
        ],
    ],

    'password_confirm' => [
        'title' => 'In-Place Password Confirmation (Sudo Mode / HTTP 423)',
        'desc' => 'When a form dispatches a request (POST/PUT/DELETE) to routes protected by password confirmation middleware (such as <code class="font-mono text-xs bg-muted px-1 py-0.5 rounded">confirm</code> or <code class="font-mono text-xs bg-muted px-1 py-0.5 rounded">confirm:100</code>) and the confirmation session has expired, the server responds with <strong>HTTP 423</strong> (Locked). The <code class="font-mono text-xs bg-muted px-1 py-0.5 rounded">&lt;vibe:form&gt;</code> component automatically intercepts this response, opens an in-place password verification modal without reloading the page, and automatically replays the pending form submission once verified!',
        'preview_title' => 'Auto-Replay Submit with In-Place Password Confirmation',
        'btn_submit' => 'Submit Protected Data',
        'card_title' => 'High-Risk / Protected Area',
        'card_desc' => 'This form is protected by security middleware. If the session expires, a password confirmation modal appears in-place.',
        'features_title' => 'Benefits of In-Place Confirmation',
        'features' => [
            [
                'title' => 'Zero Input Loss',
                'desc' => 'Users are never redirected to another page, preserving all form inputs and file uploads.',
            ],
            [
                'title' => 'Seamless Auto-Replay',
                'desc' => 'Once confirmed, the form immediately retries the POST/PUT without needing to click submit again.',
            ],
            [
                'title' => 'Zero Configuration',
                'desc' => 'Enabled out of the box on all AJAX forms, and can be toggled off via :confirm-password="false".',
            ],
        ],
    ],
];
