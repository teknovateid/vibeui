<?php

return [
    'title' => 'Textarea',
    'badge' => 'Component',
    'group' => 'Form & Input',
    'description' => 'A multi-line text input component featuring smart auto-resize, live character counters, 5 visual variants, and seamless Livewire wire:model binding.',

    'basic_usage' => [
        'title' => 'Basic Usage',
        'desc' => 'Use the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:textarea&gt;</code> tag to accept multi-line text input.',
        'preview_title' => 'Basic Textarea',
        'bio_label' => 'Short Biography',
        'bio_placeholder' => 'Tell us a bit about your background and interests...',
    ],

    'autoresize' => [
        'title' => 'Auto-Resize Feature',
        'desc' => 'Use the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:autoResize="true"</code> prop so the textarea height expands automatically as the user types without awkward scrollbars.',
        'preview_title' => 'Auto-Resize Textarea',
        'feedback_label' => 'Additional Notes',
        'feedback_placeholder' => 'Type your message here, the box height will expand automatically...',
    ],

    'counter' => [
        'title' => 'Character Counter',
        'desc' => 'Combine <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:showCount="true"</code> with <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:maxlength="200"</code> to display a live character count badge.',
        'preview_title' => 'Textarea with Character Counter',
        'tweet_label' => 'Short Message',
        'tweet_placeholder' => 'Write a short description (up to 150 characters)...',
    ],

    'props' => [
        'title' => 'Props & Attributes Reference',
        'desc' => 'Complete list of properties and attributes available on the <code class="font-mono text-xs text-foreground">&lt;vibe:textarea&gt;</code> component.',
        'columns' => [
            'prop' => 'Prop',
            'type' => 'Type',
            'default' => 'Default',
            'desc' => 'Description',
        ],
        'items' => [
            'name' => 'Form input name attribute. Automatically extracted from <code>wire:model</code> if omitted.',
            'id' => 'Unique HTML <code>id</code> for the textarea and <code>label</code> binding.',
            'label' => 'Primary label text displayed above the textarea.',
            'description' => 'Guidance text displayed beneath the label.',
            'placeholder' => 'Placeholder text displayed when the textarea is empty.',
            'rows' => 'Initial visible height specified in number of text rows.',
            'size' => 'Text and padding sizing: <code>\'sm\'</code>, <code>\'md\'</code>, <code>\'lg\'</code>, or <code>\'xl\'</code>.',
            'variant' => 'Visual style variant: <code>\'primary\'</code>, <code>\'outline\'</code>, <code>\'filled\'</code>, <code>\'flush\'</code>, or <code>\'ghost\'</code>.',
            'autoResize' => 'Automatically recalculates and expands textarea height based on user typing.',
            'showCount' => 'Displays live character length badge at the top right corner.',
            'maxlength' => 'Maximum allowed characters, rendered in the counter (e.g. 0/150).',
            'info' => 'Supplementary guidance note displayed beneath the textarea.',
            'error' => 'Custom error message string or boolean flag to toggle red destructive styling.',
            'errorName' => 'Laravel validation error key in <code>$errors</code> to track automatically.',
            'disabled' => 'Native HTML attribute to disable input interaction and dim opacity.',
            'readonly' => 'Native HTML attribute to make textarea non-editable with read-only styling.',
            'wrapperClass' => 'Additional CSS classes for the outer container element.',
        ],
    ],
];
