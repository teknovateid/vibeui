<?php

return [
    'title' => 'Highlight.js',
    'badge' => 'Component',
    'group' => 'UI Components',
    'description' => 'A high-performance code syntax highlighting component built upon Highlight.js. Features intelligent language detection (Bash terminal commands and Blade template syntax), unselectable line numbering, interactive clipboard copy with instant feedback, file headers, scrollable height constraints, and automated indentation trimming.',

    // Section 1: Basic Usage
    'basic_usage' => [
        'title' => 'Basic Usage',
        'desc' => 'Use the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:highlightjs&gt;</code> component specifying the <code class="font-mono text-xs text-foreground">language</code> prop (e.g. <code class="font-mono text-xs text-foreground">php</code>, <code class="font-mono text-xs text-foreground">javascript</code>, <code class="font-mono text-xs text-foreground">blade</code>, <code class="font-mono text-xs text-foreground">css</code>). Code can be passed directly inside the slot or via the <code class="font-mono text-xs text-foreground">code</code> attribute.',
        'preview_title' => 'PHP & JavaScript Syntax Highlighting',
    ],

    // Section 2: Titles & Terminal Commands
    'titles_terminal' => [
        'title' => 'File Titles & Terminal Auto-Detection',
        'desc' => 'Provide a <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">title</code> or <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">filename</code> to display the filepath in the header. If code begins with common CLI tools like <code class="font-mono text-xs text-foreground">php artisan</code>, <code class="font-mono text-xs text-foreground">npm</code>, <code class="font-mono text-xs text-foreground">composer</code>, or <code class="font-mono text-xs text-foreground">git</code>, the component automatically resolves the language to <strong>Bash</strong>, equips a terminal icon, and assigns the title <strong>Terminal</strong>.',
        'preview_title' => 'Code Files & Automated Terminal Command Blocks',
    ],

    // Section 3: Line Numbers
    'line_numbers' => [
        'title' => 'Line Numbering (line-numbers)',
        'desc' => 'Include the boolean prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">line-numbers</code> (or <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">lines</code>) to display line numbers along the left margin. The gutter is unselectable so it is never accidentally copied when selecting text manually.',
        'preview_title' => 'Code Block with Line Numbers',
    ],

    // Section 4: Copy Button & Badges
    'copy_and_badges' => [
        'title' => 'Copy Button & Custom Badges',
        'desc' => 'The copy-to-clipboard button is active by default (<code class="font-mono text-xs text-foreground">:copyable="true"</code>) with an animated checkmark confirmation. When the header is disabled (<code class="font-mono text-xs text-foreground">:header="false"</code>), a floating copy button appears in the top-right corner. You can also customize the language badge text using the <code class="font-mono text-xs text-foreground">badge</code> prop.',
        'preview_title' => 'Floating Copy Button & Custom Badge Text',
    ],

    // Section 5: Height & Wrapping
    'height_wrap' => [
        'title' => 'Height Limits (max-height) & Word Wrap',
        'desc' => 'For long logs or extensive files, restrict vertical space using <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">max-height="220"</code> to produce an internal scroll container. Enable <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">wrap</code> to force long lines to soft-wrap instead of displaying a horizontal scrollbar.',
        'preview_title' => 'Scrollable Code Container with Max Height',
    ],

    // Section 6: Props Reference
    'props' => [
        'title' => 'Props & Parameters Reference',
        'desc' => 'Complete specification of attributes and configuration options for <code class="font-mono text-xs text-foreground">&lt;vibe:highlightjs&gt;</code>.',
        'columns' => [
            'prop' => 'Prop',
            'type' => 'Type',
            'default' => 'Default',
            'desc' => 'Description',
        ],
    ],

    'features' => [
        'title' => 'Smart Automation Features',
        'columns' => [
            'feature' => 'Feature',
            'desc' => 'Behavior & Mechanism',
        ],
    ],

    'props_items' => [
        'code' => 'Code string to syntax-highlight. If empty, the component uses the `$slot` content.',
        'language' => 'Programming language (e.g. `php`, `javascript`, `blade`, `bash`, `html`, `css`, `json`, `sql`).',
        'title' => 'Title or filename rendered on the top header bar.',
        'copyable' => 'Displays interactive copy button to clipboard with visual checkmark feedback.',
        'lineNumbers' => 'Displays unselectable line numbers on the left edge of code blocks.',
        'badge' => 'Displays language badge in header. Can be a custom string for custom label.',
        'header' => 'Displays top header bar. If `false`, copy button floats on the top right.',
        'maxHeight' => 'Vertical height constraint (e.g. `220` or `"300px"`).',
        'wrap' => 'If `true`, wraps long lines of code instead of horizontal scrollbar.',
        'theme' => 'Highlight.js color theme scheme (default: `vibe`).',
    ],
];
