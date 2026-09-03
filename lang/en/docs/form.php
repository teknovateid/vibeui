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
    ],

    // Section 6: Modal & Sheet Awareness
    'modal_sheet' => [
        'title' => 'Modal & Sheet Integration',
        'desc' => 'The <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:form&gt;</code> component automatically listens to <code class="font-mono text-xs text-foreground">open-modal</code> and <code class="font-mono text-xs text-foreground">open-sheet</code> events, ensuring drafts are restored whenever a dialog or slide-out drawer is opened without interference from Livewire/Alpine resets.',
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
];
