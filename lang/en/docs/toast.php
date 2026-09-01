<?php

return [
    'title' => 'Toast',
    'badge' => 'Component',
    'group' => 'Feedback & Notification',
    'description' => 'A lightweight, modern, and interactive floating toast notification component. Features layered card stacking, auto-expansion and timer pause on hover, Web Audio API synthesis sound effects, and seamless integration via JavaScript vibeToast, Alpine events, Laravel session flash, and Livewire.',

    // Section 1: Basic Usage
    'basic_usage_title' => 'Basic Usage',
    'basic_usage_desc' => 'Ensure the container tag <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:toast /&gt;</code> is placed in your base layout (such as <code class="font-mono text-xs text-foreground">base.blade.php</code>). Trigger toast notifications instantly using the JavaScript helper <code class="font-mono text-xs text-foreground">vibeToast(...)</code> or Alpine event <code class="font-mono text-xs text-foreground">$dispatch(\'toast\', ...)</code>.',

    // Section 2: Stacked & Hover
    'stacked_title' => 'Layered Stacking & Hover Interaction',
    'stacked_desc' => 'Multiple toasts appearing simultaneously are neatly stacked with depth scaling. When the user hovers over the stack, toasts automatically expand into full view and the auto-dismiss timer is paused.',

    // Section 3: Positions
    'positions_title' => 'Placement Positions',
    'positions_desc' => 'Toast supports 6 placement positions configurable via the <code class="font-mono text-xs text-foreground">position</code> prop: <code class="font-mono text-xs text-foreground">bottom-right</code> (default), <code class="font-mono text-xs text-foreground">bottom-left</code>, <code class="font-mono text-xs text-foreground">top-right</code>, <code class="font-mono text-xs text-foreground">top-left</code>, <code class="font-mono text-xs text-foreground">top-center</code>, and <code class="font-mono text-xs text-foreground">bottom-center</code>.',

    // Section 4: Sound & Timeout
    'sound_title' => 'Audio Sound & Duration',
    'sound_desc' => 'Enable built-in audio feedback with <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">sound: true</code> (powered by the browser Web Audio API without external files) or provide a custom audio URL string. Control the display duration in milliseconds via <code class="font-mono text-xs text-foreground">timeout</code> (default: 3000ms), or set <code class="font-mono text-xs text-foreground">timeout: false</code> for persistent toasts.',

    // Section 5: Trigger Methods
    'integration_title' => 'Trigger Methods',
    'integration_desc' => 'Vibe UI provides multiple methods to dispatch toasts across the Laravel ecosystem: JavaScript helper, Alpine.js event dispatch, Laravel controller flash session, and Livewire components.',

    // Section 6: Props Reference
    'props_title' => 'Props & Payload Reference',
    'props_desc' => 'Comprehensive list of <code class="font-mono text-xs text-foreground">&lt;vibe:toast&gt;</code> container props and supported payload parameters.',
    'table_prop' => 'Prop / Parameter',
    'table_type' => 'Type',
    'table_default' => 'Default',
    'table_desc' => 'Description',
];
