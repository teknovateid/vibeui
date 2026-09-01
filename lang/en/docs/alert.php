<?php

return [
    'title' => 'Alert',
    'badge' => 'Component',
    'group' => 'Feedback & Notifications',
    'description' => 'Modal dialog and important notification feedback component with smooth entrance animations, backdrop blur, Web Audio API sound effects, interactive confirmation dialogs, and flexible integration via JavaScript vibeAlert, Blade @vibeAlert directive, and Livewire event dispatching.',

    // Section 1: Basic Usage
    'basic_usage_title' => 'Basic Usage',
    'basic_usage_desc' => 'Ensure the container tag <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:alert /&gt;</code> is placed in your primary layout (e.g. <code class="font-mono text-xs text-foreground">base.blade.php</code>). Alerts can be triggered instantly via the JavaScript function <code class="font-mono text-xs text-foreground">vibeAlert(...)</code> or Alpine event <code class="font-mono text-xs text-foreground">$dispatch(\'alert\', ...)</code>.',

    // Section 2: Confirmation Dialog
    'confirm_title' => 'Confirmation Dialog (Confirm Modal)',
    'confirm_desc' => 'Use the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">confirm</code> type to request user verification before critical or destructive actions take place. This automatically displays a backdrop overlay (<code class="font-mono text-xs text-foreground">blocking: true</code>) and disables auto-dismiss (<code class="font-mono text-xs text-foreground">timeout: false</code>).',

    // Section 3: Positions
    'positions_title' => 'Available Positions',
    'positions_desc' => 'Alert supports 7 layout placement positions: <code class="font-mono text-xs text-foreground">center</code> (default screen center), <code class="font-mono text-xs text-foreground">top-right</code>, <code class="font-mono text-xs text-foreground">top-left</code>, <code class="font-mono text-xs text-foreground">bottom-right</code>, <code class="font-mono text-xs text-foreground">bottom-left</code>, <code class="font-mono text-xs text-foreground">top-center</code>, and <code class="font-mono text-xs text-foreground">bottom-center</code>.',

    // Section 4: Custom Buttons & Layout
    'buttons_title' => 'Custom Buttons & Layout',
    'buttons_desc' => 'Customize button text labels, Tailwind utility classes (<code class="font-mono text-xs text-foreground">class</code>), click action callbacks, and button orientation using <code class="font-mono text-xs text-foreground">buttonLayout: \'row\'|\'col\'</code>.',

    // Section 5: Sound & Timeout
    'sound_title' => 'Audio Sound Effects & Timeout',
    'sound_desc' => 'Add <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">sound: true</code> to play a clean synthesized tone via Web Audio API without requiring any external audio files, or provide a custom audio URL. Hovering your mouse over the alert temporarily pauses the auto-dismiss timer.',

    // Section 6: Background Blur
    'blur_title' => 'Background Blur Effects',
    'blur_desc' => 'Enhance visual focus on important alerts by applying a backdrop blur effect behind the modal card. Supports <code class="font-mono text-xs text-foreground">blur: true</code>, as well as intensity levels like <code class="font-mono text-xs text-foreground">\'xs\'</code>, <code class="font-mono text-xs text-foreground">\'sm\'</code>, <code class="font-mono text-xs text-foreground">\'md\'</code>, <code class="font-mono text-xs text-foreground">\'lg\'</code>, <code class="font-mono text-xs text-foreground">\'xl\'</code>, or <code class="font-mono text-xs text-foreground">false / \'none\'</code> to disable blur.',

    // Section 6: Methods
    'integration_title' => 'Alert Trigger Methods',
    'integration_desc' => 'Multiple trigger methods are supported: JavaScript function <code class="font-mono text-xs text-foreground">vibeAlert(...)</code>, Blade directive <code class="font-mono text-xs text-foreground">@vibeAlert(...)</code>, and Livewire component event dispatching.',

    // Section 7: Props Reference
    'props_title' => 'Props & Payload Reference',
    'props_desc' => 'Comprehensive reference of container attributes and payload object structure supported by the Alert component.',
    'table_prop' => 'Prop / Parameter',
    'table_type' => 'Type',
    'table_default' => 'Default',
    'table_desc' => 'Description',
];
