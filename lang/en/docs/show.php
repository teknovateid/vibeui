<?php

return [
    'title' => 'Show (Data Binding)',
    'badge' => 'Component',
    'group' => 'UI Components',
    'description' => 'Automated data binding and population system that effortlessly fetches JSON data from AJAX endpoints and binds it to HTML elements, array loops (tables, grids, lists), and all Vibe UI form components without manual JavaScript coding.',

    'basic_usage' => [
        'title' => 'Basic Usage & Key Binding',
        'desc' => 'Use the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:show key="..."&gt;</code> tag or <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">vibe-show="..."</code> attribute on any HTML element to bind data based on server response keys. Supports nested dot-notation (e.g. <code class="font-mono text-xs">user.profile.name</code>) and array brackets (<code class="font-mono text-xs">items[0].title</code>).',
        'preview_title' => 'Single Data Binding',
    ],

    'advanced_binding' => [
        'title' => 'Attribute & HTML Binding',
        'desc' => 'Bind values to element attributes using <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:show attr="attrName"&gt;</code> or <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">vibe-show-attr="attrName"</code> (e.g. <code class="font-mono text-xs">src</code>, <code class="font-mono text-xs">href</code>, <code class="font-mono text-xs">alt</code>). Render raw HTML safely with <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">html</code> or <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">vibe-show-html</code>.',
        'preview_title' => 'Dynamic Attributes & HTML Content',
    ],

    'button_show' => [
        'title' => 'Fetch Trigger (<vibe:button.show>)',
        'desc' => 'The <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:button.show&gt;</code> component acts as an action trigger that executes an AJAX request to <code class="font-mono text-xs">url</code>, manages loading state indicators, and populates data into the <code class="font-mono text-xs">target</code> element. If the target is a Modal or Sheet, it automatically opens after data is loaded.',
        'preview_title' => 'AJAX Trigger Button with Modal',
        'sheet_preview_title' => 'AJAX Trigger with Side Sheet (Drawer)',
        'inline_preview_title' => 'Inline Container Data Fetching',
        'trigger_btn' => 'Show User Data',
        'trigger_sheet_btn' => 'Open Sheet Details',
        'trigger_inline_btn' => 'Load into Card',
    ],

    'looping' => [
        'title' => 'Array / List Looping (<vibe:show.each>)',
        'desc' => 'For array/list collections like <code class="font-mono text-xs">user.products</code>, use <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:show.each&gt;</code> or <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">vibe-show-each="..."</code>. Works seamlessly with tables (<code class="font-mono text-xs">as="tbody"</code>) or card grids (<code class="font-mono text-xs">as="div"</code>). Use <code class="font-mono text-xs">$iteration</code> (1-based) or <code class="font-mono text-xs">$index</code> (0-based) for counters, and <code class="font-mono text-xs">vibe-show="."</code> for primitive arrays.',
        'preview_title' => 'Table Row Looping',
        'grid_preview_title' => 'Grid & Card Looping with Badges',
    ],

    'components_support' => [
        'title' => 'Vibe UI Form Components Synchronization',
        'desc' => 'The VibeShow engine automatically populates all Vibe UI form components: <code class="font-mono text-xs">&lt;vibe:input&gt;</code>, <code class="font-mono text-xs">&lt;vibe:textarea&gt;</code>, <code class="font-mono text-xs">&lt;vibe:select&gt;</code> (single & multiple), <code class="font-mono text-xs">&lt;vibe:checkbox&gt;</code>, <code class="font-mono text-xs">&lt;vibe:radio&gt;</code>, <code class="font-mono text-xs">&lt;vibe:switch&gt;</code>, <code class="font-mono text-xs">&lt;vibe:range&gt;</code>, <code class="font-mono text-xs">&lt;vibe:avatar&gt;</code>, and <code class="font-mono text-xs">&lt;vibe:badge&gt;</code>. Form controls with a <code class="font-mono text-xs">name</code> attribute automatically match server response keys.',
        'preview_title' => 'Form Components Auto-Populate',
    ],

    'javascript_api' => [
        'title' => 'JavaScript Programmatic API & Events',
        'desc' => 'You can also populate data programmatically in your own JavaScript scripts or Alpine components using <code class="font-mono text-xs">VibeShow.populate()</code> or trigger AJAX fetching via <code class="font-mono text-xs">VibeShow.fetchAndShow()</code>. The engine dispatches custom DOM events <code class="font-mono text-xs">vibe:show:updated</code> and <code class="font-mono text-xs">vibe:show:success</code>.',
        'preview_title' => 'Programmatic Population & Event Listening',
    ],

    'props' => [
        'title' => 'Props & Attributes Reference',
        'desc' => 'Comprehensive reference of component props, HTML attributes, and template variables supported by the VibeShow ecosystem.',
        'columns' => [
            'prop' => 'Prop / Attribute',
            'type' => 'Type',
            'default' => 'Default',
            'desc' => 'Description',
        ],
    ],
];
