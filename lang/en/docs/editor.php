<?php

return [
    'title' => 'Editor (WYSIWYG)',
    'badge' => 'Component',
    'group' => 'Form & Input',
    'description' => 'Modern rich-text WYSIWYG editor powered by TinyMCE 7 featuring {{ model.column }} variable autocompletion, dark/light Vibe UI theme synchronization, flexible toolbar presets, image upload integration, and full Livewire v3 support.',

    'basic_usage' => [
        'title' => 'Basic Usage',
        'desc' => 'Use the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:editor&gt;</code> tag to provide a rich-text editing experience directly in your forms. The editor HTML value is automatically synced to the native <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;textarea&gt;</code> element, ensuring seamless compatibility with standard HTML form submissions.',
        'preview_title' => 'Standard Editor',
        'label' => 'Article Content',
        'placeholder' => 'Start writing your article or announcement content here...',
    ],

    'variables' => [
        'title' => 'Variable Autocomplete & Dropdown {{ model.column }}',
        'desc' => 'Insert dynamic variable tokens such as <code class="px-1.5 py-0.5 rounded bg-secondary text-secondary-foreground text-xs font-mono font-semibold">{{ user.name }}</code>. Type <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">{{</code> directly inside the editor to open an instant autocomplete popup, or pick them from the <strong>Variables</strong> toolbar menu. Variables are rendered as protected atomic badges that cannot be accidentally broken.',
        'preview_title' => 'Editor with Variable Autocomplete',
        'label' => 'Notification Template',
        'placeholder' => 'Type {{ to see available variables for user and order data...',
        'structure_title' => 'Variable Data Structure Format',
        'structure_desc' => 'The <code class="font-mono text-xs text-foreground">:variables</code> prop supports hierarchical (grouped) array structures as well as flat dot-notation formats.',
    ],

    'parsing' => [
        'title' => 'Variable Parsing & Interpolation in Backend (Laravel)',
        'badge' => 'Backend Integration',
        'desc' => 'When templates are saved to the database, they contain dynamic tokens like <code class="font-mono text-xs text-foreground">{{ user.name }}</code> or badge wrapper tags <code class="font-mono text-xs text-foreground">&lt;span class="vibe-editor-variable"&gt;</code>. Vibe UI provides the <code class="font-mono text-xs text-foreground">Vibe::parseTemplate()</code> method and <code class="font-mono text-xs text-foreground">vibe_parse_template()</code> helper to effortlessly interpolate templates with Eloquent Models or Arrays.',
        'method_title' => 'Using Vibe UI Built-in Helper',
        'method_desc' => 'This method automatically resolves variable keys against Eloquent models or nested arrays (dot-notation), strips badge HTML wrappers to produce clean semantic output suitable for email/PDF, and applies XSS protection by default.',
        'mailable_title' => 'Mailable / Email Blast Integration Example',
        'mailable_desc' => 'Pass the parsed template directly as your Laravel Mailable HTML body:',
        'manual_title' => 'Manual Regex Parsing (Optional)',
        'manual_desc' => 'If you require custom parsing logic outside the built-in helper, you can use the following manual PHP regex function:',
    ],

    'presets' => [
        'title' => 'Toolbar Presets (Minimal, Basic, Standard, Full)',
        'desc' => 'Choose between 4 ready-to-use toolbar presets via the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">preset="..."</code> prop to suit your application interface requirements:',
        'items' => [
            'minimal' => '<strong>Minimal</strong>: Basic text formatting only (Undo, Redo, Bold, Italic, Link, Clear format). Ideal for comment fields and quick notes.',
            'basic' => '<strong>Basic</strong>: Adds Heading/Paragraph selector, Blockquote, and Bulleted & Numbered Lists.',
            'standard' => '<strong>Standard (Default)</strong>: Complete toolbar with Alignment, Text & Highlight Color, Tables, Images, and Code View.',
            'full' => '<strong>Full</strong>: Includes top TinyMCE Menubar, advanced table toolset, Search & Replace, Word Count, Media, and Fullscreen.',
        ],
        'preview_title' => 'Minimal & Full Presets',
        'minimal_label' => 'Short Comment (preset="minimal")',
        'full_label' => 'Complete Document Editor (preset="full" :menubar="true")',
    ],

    'custom_toolbar' => [
        'title' => 'Custom Toolbar & Plugins',
        'desc' => 'You can define your own toolbar button layout using the <code class="font-mono text-xs text-foreground">toolbar="..."</code> prop and enable specific TinyMCE plugins with the <code class="font-mono text-xs text-foreground">:plugins="[...]"</code> prop.',
        'preview_title' => 'Custom Toolbar & Plugins',
        'label' => 'Custom Editor (Text Formatting, Lists, & Code View Only)',
    ],

    'autoresize' => [
        'title' => 'Autoresize Mode (Dynamic Height)',
        'desc' => 'Enable the <code class="font-mono text-xs text-foreground">:autoresize="true"</code> prop to have the editor expand smoothly with the user content without rigid double scrollbars. You can also cap its growth using <code class="font-mono text-xs text-foreground">:max-height="500"</code>.',
        'preview_title' => 'Editor with Autoresize',
        'label' => 'Write Long Notes (Editor Grows Automatically)',
    ],

    'image_upload' => [
        'title' => 'Image Upload Integration (Drag & Drop / Paste)',
        'desc' => 'The editor supports drag-and-drop and clipboard image pasting out of the box. Simply supply a backend endpoint via the <code class="font-mono text-xs text-foreground">upload-url="..."</code> prop. Vibe UI automatically passes the Laravel CSRF token header and handles the JSON response.',
        'controller_title' => 'Example Laravel Controller for Image Uploads',
        'controller_desc' => 'The backend endpoint must validate the file and return a JSON payload with a <code class="font-mono text-xs text-foreground">{ "location": "https://..." }</code> key.',
    ],

    'livewire' => [
        'title' => 'Livewire v3 Integration (Two-Way Data Binding)',
        'desc' => 'The <code class="font-mono text-xs text-foreground">&lt;vibe:editor&gt;</code> component natively integrates with Livewire 3 using <code class="font-mono text-xs text-foreground">wire:model</code> and <code class="font-mono text-xs text-foreground">wire:model.live</code>. Data synchronization is designed using an Alpine event architecture that prevents cursor jumping and recursive update loops.',
    ],

    'states' => [
        'title' => 'Interaction States: Readonly, Disabled & Error Validation',
        'desc' => 'The editor features complete interaction states directly tied into the Laravel form lifecycle:',
        'preview_title' => 'Readonly & Validation Error State',
        'readonly_label' => 'Published Article (Read-only)',
        'disabled_label' => 'Disabled Editor',
        'error_label' => 'Content with Validation Error Message',
    ],

    'props' => [
        'title' => 'Props & Attributes Reference',
        'desc' => 'Comprehensive list of props and attributes available for the <code class="font-mono text-xs text-foreground">&lt;vibe:editor&gt;</code> component.',
        'columns' => [
            'prop' => 'Prop',
            'type' => 'Type',
            'default' => 'Default',
            'desc' => 'Description',
        ],
        'items' => [
            'name' => 'Form input attribute name. Automatically inferred from <code>wire:model</code> if omitted.',
            'id' => 'Unique HTML ID for editor and textarea elements.',
            'label' => 'Main label text displayed above the editor.',
            'description' => 'Helper explanation text below the label.',
            'placeholder' => 'Placeholder text shown when editor is empty.',
            'preset' => 'Toolbar & plugins preset: <code>\'minimal\'</code>, <code>\'basic\'</code>, <code>\'standard\'</code>, or <code>\'full\'</code>.',
            'variables' => 'Array of model and column variables for autocompletion and toolbar menu. Supports hierarchical and dot-notation formats.',
            'variableStyle' => 'Variable visual style: <code>\'badge\'</code> (protected atomic pill) or <code>\'raw\'</code> (plain text).',
            'variablePrefix' => 'Variable opening prefix (default: <code>\'{{ \'</code>).',
            'variableSuffix' => 'Variable closing suffix (default: <code>\' }}\'</code>).',
            'variableButtonLabel' => 'Text label for the variables menu button in toolbar (default: <code>\'Variables\'</code>).',
            'height' => 'Editor height in pixels (default: <code>350</code>).',
            'minHeight' => 'Minimum editor height in pixels (default: <code>200</code>).',
            'maxHeight' => 'Maximum editor height in pixels when using autoresize mode.',
            'autoresize' => 'Automatically adjust editor height to match content length.',
            'menubar' => 'Display or hide top TinyMCE menubar (default: <code>false</code>).',
            'toolbar' => 'Custom toolbar configuration string overriding preset defaults.',
            'toolbarMode' => 'Toolbar overflow drawer display mode: <code>\'sliding\'</code> (default: slides inside header), <code>\'floating\'</code>, <code>\'wrap\'</code>, or <code>\'scrolling\'</code>.',
            'toolbarSticky' => 'Enable TinyMCE JS toolbar docking when scrolling long pages; CSS sticky inside the editor is active by default (default: <code>false</code>).',
            'toolbarStickyOffset' => 'Offset distance in pixels from the top of the viewport when toolbar sticky is active (default: <code>0</code>).',
            'plugins' => 'String or array of TinyMCE plugins to enable.',
            'uploadUrl' => 'Backend URL endpoint for processing automatic image uploads with CSRF token.',
            'uploadParam' => 'Form-data parameter name for the image file when uploading (default: <code>\'file\'</code>).',
            'statusbar' => 'Show bottom TinyMCE status bar (word count & resize handle). Default: <code>true</code>.',
            'readonly' => 'Make editor read-only.',
            'disabled' => 'Disable editor interaction and apply muted appearance.',
            'required' => 'Mark editor as required field (appends red asterisk).',
            'error' => 'Custom error message or boolean flag triggering destructive red styling.',
            'errorName' => 'Laravel validation error key in <code>$errors</code> for automatic error detection.',
            'info' => 'Small help text displayed below the editor.',
            'wrapperClass' => 'Additional CSS classes for outer container wrapper.',
        ],
    ],

    'slots' => [
        'title' => 'Slots Reference',
        'desc' => 'Content slots supported by the <code class="font-mono text-xs text-foreground">&lt;vibe:editor&gt;</code> component.',
        'columns' => [
            'name' => 'Slot Name',
            'desc' => 'Description',
        ],
        'items' => [
            'default' => 'Initial HTML content inserted into the editor on first load. Alternative to using the <code>value="..."</code> prop.',
        ],
    ],

    'events' => [
        'title' => 'Events & JavaScript Integration',
        'desc' => 'DOM events and JavaScript APIs available for custom programmatic control.',
        'columns' => [
            'event' => 'Event / Method',
            'target' => 'Target',
            'desc' => 'Description',
        ],
        'items' => [
            'change' => '<code class="font-mono text-xs">textarea</code> element',
            'change_desc' => 'Fires whenever the content inside TinyMCE changes or when focus moves away (blur).',
            'input' => '<code class="font-mono text-xs">textarea</code> element',
            'input_desc' => 'Fires in real-time as the user types inside the editor.',
            'ready' => '<code class="font-mono text-xs">window</code>',
            'ready_desc' => 'Custom event <code class="font-mono text-xs">vibe-editor-ready</code> dispatched when the editor JS module is initialized.',
            'tinymce_get' => '<code class="font-mono text-xs">window.tinymce.get(id)</code>',
            'tinymce_get_desc' => 'Returns active TinyMCE instance for advanced programmatic methods such as <code>getContent()</code> or <code>setContent()</code>.',
        ],
    ],
];
