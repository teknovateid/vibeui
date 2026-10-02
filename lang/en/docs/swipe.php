<?php

return [
    'title'       => 'Swipe Button',
    'badge'       => 'New',
    'group'       => 'Actions & Buttons',
    'description' => 'Interactive Slide-to-Action / Swipe Button component that fires complete button events like button click, form submit, Livewire actions, and custom Alpine.js events.',

    // Section 1: Basic Usage
    'basic_usage' => [
        'title'         => 'Basic Usage',
        'desc'          => 'Drag the handle from left to right. Once the handle reaches the threshold (default 88%), the action is triggered automatically with haptic feedback and locks at the success position.',
        'preview_title' => 'Basic Swipe Button',
        'card_title'    => 'Confirm Order',
        'card_desc'     => 'Swipe the button below to process',
        'card_badge'    => 'Ready',
        'label'         => 'Slide to confirm',
        'confirmed'     => 'Successfully Confirmed!',
        'alert'         => 'Swipe action executed successfully!',
    ],

    // Section 2: Click Event Interoperability
    'event_click' => [
        'title'         => 'Click Event Interoperability',
        'desc'          => 'The component has a hidden button that automatically fires the <code class="font-mono text-xs">@click</code> or <code class="font-mono text-xs">onclick</code> native event when the swipe completes. Your backend code can treat it exactly like a regular button.',
        'preview_title' => 'Simulate Button Click',
        'card_title'    => 'Native Click Handler Counter',
        'card_desc'     => 'Automatically fires native @click event',
        'label'         => 'Slide to increment counter',
        'confirmed'     => '@click Event Fired!',
        'counter'       => 'Total Clicks:',
    ],

    // Section 3: Form Submission
    'form_submit' => [
        'title'         => 'Form Submission (type="submit")',
        'desc'          => 'Use <code class="font-mono text-xs">type="submit"</code> and provide a <code class="font-mono text-xs">name</code> attribute. The component will automatically include a hidden input and call <code class="font-mono text-xs">form.requestSubmit()</code> to check HTML5 validation before the form is submitted.',
        'preview_title' => 'Slide to Submit Form',
        'card_title'    => 'Checkout Payment',
        'card_desc'     => 'Automatic validation & form.requestSubmit()',
        'card_amount'   => 'Rp 250,000',
        'input_label'   => 'Destination Account Number',
        'input_ph'      => 'e.g. 8219-3910-2910',
        'label'         => 'Slide to Pay',
        'confirmed'     => 'Payment Sent!',
        'alert'         => 'Form submitted successfully with swipe data!',
    ],

    // Section 4: Sizes
    'sizes' => [
        'title'         => 'Size Scale (5-Tier Ergonomic Scale)',
        'desc'          => 'Available in 5 ergonomic scales designed for touch comfort and swipe gestures: <code class="font-mono text-xs">xs (32px)</code>, <code class="font-mono text-xs">sm (36px)</code>, <code class="font-mono text-xs">md (44px - default)</code>, <code class="font-mono text-xs">lg (48px)</code>, and <code class="font-mono text-xs">xl (56px)</code>.',
        'preview_title' => 'Height Size Variations',
        'xs_use'        => 'Modal / Compact Action',
        'sm_use'        => 'Dense Form / Toolbar',
        'md_use'        => 'Standard Mobile Ergonomics',
        'lg_use'        => 'Prominent Checkout Button',
        'xl_use'        => 'Hero / High-Impact Slider',
        'label'         => 'Slide to confirm',
    ],

    // Section 5: Corner Shape
    'corner_shape' => [
        'title'         => 'Corner Shape (Standard vs Pill)',
        'desc'          => 'By default, the Swipe Button follows the Vibe UI button design system with standard rounded corners (<code class="font-mono text-xs">rounded-lg</code> for md/lg, <code class="font-mono text-xs">rounded-md</code> for sm/xs, <code class="font-mono text-xs">rounded-xl</code> for xl). For a full capsule/pill style, add the Tailwind utility class <code class="font-mono text-xs">class="rounded-full"</code>.',
        'preview_title' => 'Standard Rounded vs Pill (rounded-full)',
        'standard_label'   => 'Standard Rounded (Default — Aligned with Button & Input)',
        'pill_label'       => 'Pill Style',
        'label_standard'   => 'Slide to confirm (Standard)',
        'label_pill'       => 'Slide to confirm (Pill)',
    ],

    // Section 6: Color Variants
    'variants' => [
        'title'         => 'Semantic Color Variants',
        'desc'          => 'Contextual color theme options for various scenarios such as payment transactions (<code class="font-mono text-xs">success</code>), data deletion confirmation (<code class="font-mono text-xs">destructive</code>), or general status.',
        'preview_title' => 'Color Variant Options',
        'primary_label'     => 'Primary (Default)',
        'success_label'     => 'Success (Payment / Safe Confirmation)',
        'destructive_label' => 'Destructive (Delete Account / Critical Action)',
        'warning_label'     => 'Warning (Important Warning)',
        'info_label'        => 'Info (Sync / Download File)',
        'secondary_label'   => 'Secondary (Archive / Save Draft)',
        'slide_continue'    => 'Slide to Continue',
        'slide_pay'         => 'Slide to Pay',
        'slide_delete'      => 'Slide to Delete Data',
        'slide_cancel'      => 'Slide to Cancel Order',
        'slide_sync'        => 'Slide to Sync Cloud',
        'slide_archive'     => 'Slide to Archive',
        'done_payment'      => 'Payment Successful!',
        'done_delete'       => 'Data Successfully Deleted!',
        'done_delete_acct'  => 'Account Deleted',
    ],

    // Section 7: Livewire & Loading
    'livewire' => [
        'title'         => 'Livewire Integration & Loading State',
        'desc'          => 'Can be connected directly to a Livewire method using <code class="font-mono text-xs">wire:click</code>. The handle automatically shows an animated spinner during network requests.',
        'preview_title' => 'Async Loading & Livewire',
        'card_title'    => 'Async Worker Simulation',
        'card_desc'     => 'Spinner active while processing request',
        'idle'          => 'Idle',
        'processing'    => 'Processing...',
        'label_checkout'    => 'Slide to Checkout',
        'label_loading'     => 'Processing transaction...',
        'label_confirmed'   => 'Transaction Successful!',
        'label_send'        => 'Slide to Send Order',
        'label_done'        => 'Order Complete!',
        'status_waiting'    => 'Waiting for swipe confirmation...',
        'status_processing' => 'Processing order to server...',
        'status_label'      => 'Server Status:',
    ],

    // Section 8: Reset
    'reset' => [
        'title'         => 'Auto-Reset & External Control',
        'desc'          => 'Use <code class="font-mono text-xs">:autoReset="true"</code> (2000ms) or specify a duration in milliseconds (e.g. <code class="font-mono text-xs">:autoReset="1500"</code>). You can also reset the swipe button from an external component using the <code class="font-mono text-xs">$dispatch(\'reset-swipe\', id)</code> event.',
        'preview_title' => 'External Reset via Alpine Event',
        'card_title'    => 'External Reset',
        'card_desc'     => 'Trigger position reset from an external button',
        'btn_reset'     => 'Reset Handle Position',
        'label'         => 'Slide this handle',
        'confirmed'     => 'Confirmed!',
    ],

    // Section 9: Disabled
    'disabled' => [
        'title'         => 'Disabled Status',
        'desc'          => 'Prevents the user from swiping the handle when the form condition is not valid or authorization is not fulfilled.',
        'preview_title' => 'Disabled Swipe Button',
        'label'         => 'Slide to confirm (Disabled)',
    ],

    // Section 10: Props Reference
    'props_ref' => [
        'title'     => 'Props & Attribute Reference',
        'desc'      => 'Complete list of <code class="font-mono text-xs">&lt;vibe:swipe&gt;</code> component prop configuration.',
        'col_prop'  => 'Prop',
        'col_type'  => 'Data Type',
        'col_default' => 'Default',
        'col_desc'  => 'Description',
        'prop_type_desc'           => "Button action type. When 'submit', automatically calls <code>form.requestSubmit()</code>",
        'prop_size_desc'           => 'Height scale and handle size (32px, 36px, 44px, 48px, 56px)',
        'prop_variant_desc'        => 'Visual color theme for track, fill, and handle',
        'prop_name_desc'           => 'Hidden input field name when swipe is confirmed in a form',
        'prop_value_desc'          => 'Value submitted when swipe is confirmed',
        'prop_label_desc'          => 'Guide text on the track lane',
        'prop_confirmed_label_desc'=> 'Text displayed after the handle reaches 100%',
        'prop_threshold_desc'      => 'Swipe threshold percentage to trigger success action (default 88%)',
        'prop_auto_reset_desc'     => 'Auto-reset handle to start (true = 2000ms, or specify milliseconds)',
        'prop_loading_desc'        => 'Shows loading spinner on the handle',
        'prop_haptic_desc'         => 'Provides haptic vibration feedback on modern smartphones',
        'prop_disabled_desc'       => 'Disables swipe and click interactions',

        'events_title'   => 'DOM & Alpine.js Events:',
        'event_click'    => 'Fired natively when handle reaches 100%.',
        'event_confirmed'=> 'Emitted with detail <code class="font-mono">{ id, value }</code>.',
        'event_start'    => 'Emitted when the user starts touching/swiping the handle.',
        'event_swiping'  => 'Continuously emitted while swiping with <code class="font-mono">{ progress, currentX, maxX }</code>.',
        'event_reset'    => 'Emitted when the handle returns to the start position.',
        'event_dispatch' => 'Global window event to externally reset the swipe.',
    ],
];
