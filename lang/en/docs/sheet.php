<?php

return [
    'title' => 'Sheet / Drawer',
    'badge' => 'Component',
    'group' => 'Overlay & Navigation',
    'description' => 'A flexible side-panel component (sheet/drawer) that slides out from any of the 4 screen edges, featuring interactive drag resizing, collapsible and minify behaviors, built-in toggle controls, and LocalStorage state persistence.',

    // Section 1: Basic Usage
    'basic_usage' => [
        'title' => 'Basic Usage',
        'desc' => 'The <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:sheet&gt;</code> component comes with semantic subcomponents: <code class="font-mono text-xs text-foreground">&lt;vibe:sheet.header&gt;</code>, <code class="font-mono text-xs text-foreground">&lt;vibe:sheet.content&gt;</code>, <code class="font-mono text-xs text-foreground">&lt;vibe:sheet.footer&gt;</code>, and <code class="font-mono text-xs text-foreground">&lt;vibe:sheet.close&gt;</code>. Control it effortlessly using Alpine events: <code class="font-mono text-xs text-foreground">$dispatch(\'toggle-sheet\', \'sheet-id\')</code>.',
        'preview_title' => 'Right Side Sheet (Drawer)',
        'btn_toggle' => 'Toggle Sheet Panel',
        'btn_open' => 'Open Sheet',
        'header_title' => 'Information Details',
        'body_text' => 'This is the content within the <code class="font-mono text-xs text-foreground">&lt;vibe:sheet.content&gt;</code> subcomponent. This section automatically provides vertical scrolling (<code class="font-mono text-xs text-foreground">overflow-y-auto</code>) and stretches to fill the available space.',
        'footer_cancel' => 'Close',
        'footer_save' => 'Save Changes',
    ],

    // Section 2: Positions
    'positions' => [
        'title' => 'Position Options (4 Edges)',
        'desc' => 'Use the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">position</code> prop to specify which side the panel emerges from: <code class="font-mono text-xs text-foreground">left</code>, <code class="font-mono text-xs text-foreground">right</code>, <code class="font-mono text-xs text-foreground">top</code>, or <code class="font-mono text-xs text-foreground">bottom</code>.',
        'preview_title' => '4 Sheet Position Variations',
        'btn_right' => 'Right',
        'btn_left' => 'Left',
        'btn_top' => 'Top',
        'btn_bottom' => 'Bottom',
        'sheet_title' => 'Position: :pos',
        'sheet_desc' => 'This sheet is rendered with prop <code class="font-mono text-xs">position=":pos"</code>.',
    ],

    // Section 3: Resizable
    'resizable' => [
        'title' => 'Interactive Resizing (Drag Handle)',
        'desc' => 'Add <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:resizable="true"</code> to display a draggable resize handle on the sheet edge. Constrain the size range using <code class="font-mono text-xs text-foreground">:minSize="200"</code> and <code class="font-mono text-xs text-foreground">:maxSize="500"</code>.',
        'preview_title' => 'Resizable Sheet Panel',
        'hint' => 'Hover over the panel border edge to start dragging and resizing.',
        'sheet_title' => 'Resizable Panel',
        'sheet_desc' => 'Drag the edge of this panel left or right to resize its width dynamically.',
    ],

    // Section: Mobile Bottom Sheet (Resizable & Rounded Top)
    'bottom_sheet' => [
        'title' => 'Mobile Bottom Sheet (Resizable & Rounded-T)',
        'desc' => 'For mobile interfaces and responsive web applications, a bottom sheet (<code class="font-mono text-xs text-foreground">position="bottom"</code>) featuring rounded top corners (<code class="font-mono text-xs text-foreground">class="rounded-t-2xl"</code> or <code class="font-mono text-xs text-foreground">rounded-t-3xl</code>) and <code class="font-mono text-xs text-foreground">:resizable="true"</code> delivers an authentic, flexible mobile action sheet experience. Users can smoothly drag the pill handle up or down to expand or collapse the sheet height.',
        'preview_title' => 'Mobile Bottom Sheet Simulation',
        'btn_toggle' => 'Open / Close Bottom Sheet',
        'sheet_title' => 'Options & Actions',
        'sheet_desc' => 'Drag the top handle bar up or down to adjust the sheet height (resizable).',
        'item_share' => 'Share Document Link',
        'item_download' => 'Download Attachment',
        'item_bookmark' => 'Add to Bookmarks',
        'item_delete' => 'Delete Item Permanently',
        'btn_cancel' => 'Dismiss',
    ],

    // Section 4: Behaviors
    'behaviors' => [
        'title' => 'Behaviors: Collapsible & Minify',
        'desc' => 'The <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">behavior</code> prop determines how the panel closes: <code class="font-mono text-xs text-foreground">collapsible</code> collapses the panel completely to 0px, while <code class="font-mono text-xs text-foreground">minify</code> shrinks it into a slim icon bar (<code class="font-mono text-xs text-foreground">:minifiedSize="70"</code>), ideal for admin sidebar navigation.',
        'preview_title' => 'Minify & Collapsible Modes',
        'btn_minify' => 'Toggle Minify Sheet',
        'sheet_title' => 'Minify Sidebar',
        'nav_dashboard' => 'Dashboard',
        'nav_users' => 'Users',
        'nav_settings' => 'Settings',
    ],

    // Section 5: Built-in Toggle Button
    'toggle' => [
        'title' => 'Built-in Toggle Button (showToggle)',
        'desc' => 'Set <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:showToggle="true"</code> to render an integrated circular arrow button that rotates automatically with the expanded/collapsed state.',
        'preview_title' => 'Sheet with Automatic Toggle Button',
        'sheet_title' => 'Panel with Toggle Button',
        'sheet_desc' => 'Click the circular arrow button on the edge of this panel to collapse or expand the content.',
    ],

    // Section 6: Layout Overlay vs Relative
    'layouts' => [
        'title' => 'Layout Modes: Overlay vs Inline Relative',
        'desc' => 'By default, sheets use <code class="font-mono text-xs text-foreground">layout="relative"</code> (pushing adjacent content in flex flow). If you want an overlay drawer that floats above the page content, use <code class="font-mono text-xs text-foreground">layout="absolute"</code> or <code class="font-mono text-xs text-foreground">layout="fixed"</code> along with <code class="font-mono text-xs text-foreground">:closeOnOutsideClick="true"</code>.',
        'preview_title' => 'Floating Overlay Drawer',
        'btn_open' => 'Open Overlay Drawer',
        'drawer_title' => 'Floating Overlay Drawer',
        'drawer_desc' => 'This drawer slides in above content without moving elements underneath. Click anywhere outside the drawer to close it.',
    ],

    // Section 7: Close on Outside Click & Backdrop
    'outside_click' => [
        'title' => 'Close on Outside Click & Backdrop Overlay (closeOnOutsideClick)',
        'desc' => 'Use the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:closeOnOutsideClick="true"</code> prop to automatically dismiss the sheet whenever the user clicks anywhere outside the panel boundaries. This is ideal for filter sidebars, quick detail drawers, or full modal overlay sheets.<br><br>💡 <strong>Pro Tip:</strong> On trigger buttons, always use the Alpine modifier <code class="font-mono text-xs text-foreground">@click.stop="$dispatch(\'open-sheet\', \'...\')"</code> to prevent the opening click from immediately bubbling and triggering an outside click event simultaneously.',
        'preview_title' => 'Outside Click & Backdrop Demo',
        'btn_open_clean' => 'Open Panel (Outside Click Without Backdrop)',
        'btn_open_backdrop' => 'Open Drawer (With Backdrop Blur)',
        'panel_title' => 'Auto-Close Sheet Panel',
        'panel_desc' => 'Configured with prop <code class="font-mono text-xs">:closeOnOutsideClick="true"</code>.',
        'outside_instruction' => '👉 Click anywhere in this area (outside the panel) to dismiss the sheet.',
        'backdrop_instruction' => '👉 Click on the blurred backdrop overlay outside this drawer to close it.',
        'drawer_title' => 'Drawer with Backdrop',
        'drawer_desc' => 'Overlay drawer layout paired with an ambient backdrop.',
        'btn_close' => 'Close Panel',
    ],

    // Section 7: LocalStorage Persistence
    'persist' => [
        'title' => 'State & Size Persistence (persist)',
        'desc' => 'Adding <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:persist="true"</code> automatically saves the panel width/height and open/closed state to the browser\'s <code class="font-mono text-xs text-foreground">LocalStorage</code>. Includes an anti-FOUC inline script so panels render with zero layout shift on page reloads.',
        'preview_title' => 'Persistent Sheet State',
        'btn_toggle' => 'Toggle Persist Sheet',
        'reset_btn' => 'Clear LocalStorage State',
        'reset_toast' => 'Sheet local storage state cleared!',
        'sheet_title' => 'Persistent Size & State',
        'sheet_desc' => 'Resize this panel or collapse it, then refresh your browser page. The size and position remain exactly as you left them!',
    ],

    // Section 8: API Reference
    'api' => [
        'title' => 'Properties & API Reference',
        'desc' => 'List of configurable attributes and properties for the <code class="font-mono text-xs text-foreground">&lt;vibe:sheet&gt;</code> component.',
        'th_prop' => 'Property',
        'th_type' => 'Type',
        'th_default' => 'Default',
        'th_desc' => 'Description',
        'props' => [
            [
                'name' => 'id',
                'type' => 'string',
                'default' => 'uniqid(\'sheet-\')',
                'desc' => 'Unique sheet identifier for open, close, and toggle window events.',
            ],
            [
                'name' => 'position',
                'type' => 'string',
                'default' => '\'left\'',
                'desc' => 'Panel edge placement: \'left\', \'right\', \'top\', or \'bottom\'.',
            ],
            [
                'name' => 'layout',
                'type' => 'string',
                'default' => '\'relative\'',
                'desc' => 'Layout flow model: \'relative\' (inline flex), \'fixed\' (viewport fixed), \'absolute\' (container overlay), or \'sticky\'.',
            ],
            [
                'name' => 'variant',
                'type' => 'string',
                'default' => '\'default\'',
                'desc' => 'Color theme: \'default\' (card), \'accent\', or \'muted\'.',
            ],
            [
                'name' => 'behavior',
                'type' => 'string',
                'default' => '\'static\'',
                'desc' => 'Collapse behavior: \'static\' (fixed), \'collapsible\' (collapses to 0px), or \'minify\' (shrinks to icon bar).',
            ],
            [
                'name' => 'defaultState',
                'type' => 'string',
                'default' => '\'expanded\'',
                'desc' => 'Initial render state: \'expanded\', \'collapsed\', or \'minified\'.',
            ],
            [
                'name' => 'resizable',
                'type' => 'bool',
                'default' => 'false',
                'desc' => 'Enables the interactive drag handle to resize the panel freely.',
            ],
            [
                'name' => 'defaultSize',
                'type' => 'int',
                'default' => '350',
                'desc' => 'Initial panel width or height in pixels (px).',
            ],
            [
                'name' => 'minSize',
                'type' => 'int',
                'default' => '0',
                'desc' => 'Minimum size constraint during resize operations.',
            ],
            [
                'name' => 'maxSize',
                'type' => 'int',
                'default' => '600',
                'desc' => 'Maximum size constraint during resize operations.',
            ],
            [
                'name' => 'minifiedSize',
                'type' => 'int',
                'default' => '80',
                'desc' => 'Width/height of the panel when in \'minified\' mode (px).',
            ],
            [
                'name' => 'showToggle',
                'type' => 'bool',
                'default' => 'false',
                'desc' => 'Displays the integrated circular arrow toggle button on the sheet edge.',
            ],
            [
                'name' => 'closeOnOutsideClick',
                'type' => 'bool',
                'default' => 'false',
                'desc' => 'Automatically closes the sheet when clicking outside its bounds.',
            ],
            [
                'name' => 'persist',
                'type' => 'bool',
                'default' => 'false',
                'desc' => 'Saves panel size and state to browser LocalStorage.',
            ],
        ],

        'events_title' => 'Window Events Reference',
        'events_desc' => 'Global browser events used to control sheets from Alpine.js or Livewire.',
        'th_event' => 'Event Name',
        'th_payload' => 'Payload',
        'th_event_desc' => 'Description',
        'events' => [
            [
                'name' => "open-sheet / \$vibe.sheet('id').show()",
                'payload' => 'string (sheetId)',
                'desc' => 'Opens the sheet matching the specified ID to \'expanded\' state.',
            ],
            [
                'name' => "close-sheet / \$vibe.sheet('id').close()",
                'payload' => 'string (sheetId)',
                'desc' => 'Closes the sheet matching the specified ID to \'collapsed\' state.',
            ],
            [
                'name' => "toggle-sheet / \$vibe.sheet('id').toggle()",
                'payload' => 'string (sheetId)',
                'desc' => 'Toggles the sheet state between open and collapsed/minified.',
            ],
            [
                'name' => "\$vibe.sheets.close()",
                'payload' => "'*'",
                'desc' => 'Closes all currently open sheets on the page.',
            ],
        ],

        'subcomponents_title' => 'Subcomponents Anatomy',
        'subcomponents_desc' => 'Complementary subcomponents to structure the inner sheet layout.',
        'th_sub' => 'Component Tag',
        'th_sub_desc' => 'Role & Description',
        'subcomponents' => [
            [
                'name' => '<vibe:sheet>',
                'desc' => 'Main container wrapping the entire sheet structure.',
            ],
            [
                'name' => '<vibe:sheet.header>',
                'desc' => 'Top area for headings, descriptions, and action icons.',
            ],
            [
                'name' => '<vibe:sheet.content>',
                'desc' => 'Scrollable body container (overflow-y-auto) for primary content.',
            ],
            [
                'name' => '<vibe:sheet.footer>',
                'desc' => 'Bottom anchored bar for save, cancel, and auxiliary buttons.',
            ],
            [
                'name' => '<vibe:sheet.close>',
                'desc' => 'Ready-to-use cross (x) button to close the sheet.',
            ],
        ],
    ],

    // Section 10: Programmatic Control
    'programmatic' => [
        'title' => 'Programmatic Control ($vibe.sheet & $vibe.sheets)',
        'desc' => 'Sheets can be opened, closed, or toggled from anywhere using the helper <code class="font-mono text-xs bg-muted px-1.5 py-0.5 rounded text-foreground">$vibe.sheet(\'id\')</code> declaratively in Alpine.js templates or via <code class="font-mono text-xs bg-muted px-1.5 py-0.5 rounded text-foreground">window.$vibe.sheet(\'id\')</code> in vanilla JavaScript. To close all currently active sheets on screen, use <code class="font-mono text-xs bg-muted px-1.5 py-0.5 rounded text-foreground">$vibe.sheets.close()</code>.',
        'preview_title' => 'Sheet Programmatic Control Demo',
        'toggle_btn' => 'Toggle Sheet ($vibe.sheet.toggle)',
        'show_btn' => 'Open Sheet ($vibe.sheet.show)',
        'close_all_btn' => 'Close All Sheets ($vibe.sheets.close)',
        'toggle_btn_short' => 'Toggle Sheet',
        'show_btn_short' => 'Open Sheet',
        'close_all_btn_short' => 'Close All',
        'panel_title' => 'Programmatic Control Panel',
        'panel_desc' => 'This sheet panel is controlled via the $vibe helper API:',
        'main_content' => 'Main Page Content',
        'hint' => 'Click the buttons above to open or toggle the sheet panel.',
    ],

    'interactive' => [
        'main_content_flexible' => 'This main content area flexibly adjusts its width when the side sheet panel is opened or closed.',
        'form_placeholder' => 'You can place forms, navigation lists, data filter details, or settings menus here...',
        'click_position_hint' => 'Click any position button above to observe the transition direction of the sheet.',
        'left_panel_flexible' => 'This content area flexibly adapts to the width of the panel on the left.',
        'toggle_minify_hint' => 'Click the toggle button above to switch between full sidebar view and icon-only (minify) mode.',
        'edge_button_hint' => 'Notice the circular arrow button at the panel edge divider. Click it to instantly collapse or expand the panel.',
        'click_outside_tip' => '✨ Click outside this panel area to automatically close it.',
        'btn_close_drawer' => 'Close Drawer',
        'click_outside_fold' => 'Click outside this panel area to immediately collapse it again.',
        'click_backdrop_tip' => '🌑 Click on the dark backdrop layer to the left of this drawer to close it.',
    ],
];
