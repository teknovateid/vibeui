<?php

return [
    'seo_title' => 'Display Image Lightbox Component — Vibe UI',
    'seo_description' => 'Interactive image preview component with fullscreen lightbox modal, grouped previous/next navigation, responsive zoom controls, touch gestures, and keyboard shortcuts in Vibe UI.',
    'badge_component' => 'Display Component',
    'badge_tag' => 'vibe:display.image',
    'header_features' => 'Fullscreen Lightbox • Grouped Navigation • Touch & Zoom',
    'title' => 'Display Image Lightbox',
    'description' => 'Modern image preview component featuring interactive thumbnails. When clicked, an elegant <em>fullscreen lightbox</em> modal opens with support for next/previous arrow navigation (based on group), stepped zoom controls, pan/drag when zoomed, swipe gestures on mobile devices, and comprehensive keyboard shortcuts.',

    'breadcrumbs' => [
        'home' => 'Home',
        'docs' => 'Docs',
        'display' => 'Display',
        'image' => 'Image (Lightbox)',
    ],

    // Section 1: Linked Gallery
    'grouped' => [
        'title' => '1. Linked Image Gallery (Next / Prev)',
        'desc' => 'Use the <code class="text-primary font-mono font-semibold">group="group-name"</code> attribute to connect multiple images together. Once opened, users can navigate between images using on-screen arrow buttons or keyboard keys <kbd class="px-1.5 py-0.5 rounded bg-muted border border-border text-[11px] font-mono">←</kbd> and <kbd class="px-1.5 py-0.5 rounded bg-muted border border-border text-[11px] font-mono">→</kbd>.',
        'preview_title' => 'Nature Landscape Gallery',
        'yosemite' => [
            'alt' => 'Yosemite Valley',
            'caption' => 'Sunrise Panorama over Yosemite Valley',
        ],
        'meadow' => [
            'alt' => 'Green Meadows',
            'caption' => 'Rolling Green Meadows in the Hills',
        ],
        'lake' => [
            'alt' => 'Pristine Blue Lake',
            'caption' => 'Pristine Blue Lake Surrounded by Mountains',
        ],
    ],

    // Section 2: Standalone Image
    'standalone' => [
        'title' => '2. Standalone Image',
        'desc' => 'If you want an individual image to open in fullscreen mode without previous/next arrow navigation buttons, use the <code class="text-primary font-mono font-semibold">standalone</code> prop.',
        'preview_title' => 'Single Image Preview',
        'alt' => 'Starry Night Over Alpine Mountains',
        'caption' => 'Milky Way Galaxy over Alpine Peaks (Click to Zoom)',
    ],

    // Section 3: Sizing & Aspect Ratio
    'sizing' => [
        'title' => '3. Size & Aspect Ratio Flexibility via Class',
        'desc' => 'Width, height, and aspect ratio are determined freely using Tailwind utility classes (<code class="text-primary font-mono">aspect-square</code>, <code class="text-primary font-mono">aspect-[21/9]</code>, <code class="text-primary font-mono">size-36</code>, etc.) without being constrained by fixed defaults.',
        'preview_title' => 'Shape & Ratio Variations',
        'square' => [
            'alt' => 'Square Photo',
            'caption' => '1:1 Square Ratio',
        ],
        'portrait' => [
            'alt' => 'Cute Cat',
            'caption' => '3:4 Portrait Format',
        ],
        'avatar' => [
            'alt' => 'Profile Photo',
            'caption' => 'User Avatar — Expandable',
        ],
    ],

    // Section 4: Automatic Gallery Container
    'container' => [
        'title' => '4. Automatic Gallery Container (vibe:display.image-gallery)',
        'desc' => 'Perfect for blog articles or rich text content rendering standard HTML <code class="text-primary font-mono">&lt;img&gt;</code> tags. Wrap them inside <code class="text-primary font-mono">&lt;vibe:display.image-gallery&gt;</code>, and all contained images automatically become clickable and linked within a single lightbox navigation.',
        'preview_title' => 'Automatic Image Wrapper',
        'bedroom' => [
            'alt' => 'Master Bedroom',
        ],
        'bathroom' => [
            'alt' => 'Minimalist Bathroom',
        ],
    ],

    // Section 5: Keyboard Shortcuts & Gestures
    'shortcuts' => [
        'title' => '5. Keyboard Shortcuts & Touch Gesture Interactions',
        'desc' => 'The lightbox modal features accessible navigation crafted for both desktop and mobile users:',
        'desktop_title' => 'Keyboard Shortcuts (Desktop)',
        'desktop_prev' => 'Navigate to previous image',
        'desktop_next' => 'Navigate to next image',
        'desktop_close' => 'Close lightbox modal',
        'desktop_zoom' => 'Zoom in & Zoom out',
        'desktop_double_click' => 'Quick Zoom Toggle',
        'desktop_double_click_key' => 'Double Click',
        'mobile_title' => 'Touch Gestures (Mobile)',
        'mobile_swipe_left_label' => 'Swipe Left',
        'mobile_swipe_left_val' => 'Next Image',
        'mobile_swipe_right_label' => 'Swipe Right',
        'mobile_swipe_right_val' => 'Previous Image',
        'mobile_swipe_down_label' => 'Swipe Down',
        'mobile_swipe_down_val' => 'Close Lightbox',
        'mobile_drag_label' => 'Drag when zoomed',
        'mobile_drag_val' => 'Pan image detail position',
    ],

    // Section 6: Props Table
    'props' => [
        'title' => '6. Props & Attributes Reference',
        'desc' => 'Attribute parameters available on the <code>&lt;vibe:display.image&gt;</code> component:',
        'gallery_title' => 'Parameters for <code>&lt;vibe:display.image-gallery&gt;</code> container:',
        'columns' => [
            'prop' => 'Prop',
            'type' => 'Type',
            'default' => 'Default',
            'desc' => 'Description',
        ],
        'items' => [
            'src' => 'Image source URL or file path to be displayed.',
            'alt' => 'Alternative text for screen reader accessibility and default lightbox caption.',
            'group' => 'Gallery group identifier to link images into previous/next navigation.',
            'caption' => 'Description caption displayed at the bottom of the lightbox modal.',
            'standalone' => 'If <code>true</code>, image opens isolated without previous/next navigation buttons.',
            'class' => 'Tailwind classes to configure size (<code>w-*</code>, <code>h-*</code>), aspect ratio (<code>aspect-*</code>), border radius, and shadow.',
            'imgClass' => 'Specific Tailwind classes applied directly to the internal <code>&lt;img&gt;</code> element.',
            'loading' => 'Native browser image loading strategy (<code>\'lazy\'</code> or <code>\'eager\'</code>).',
            'showCaption' => 'If <code>true</code>, caption is also rendered below the thumbnail in page layout.',
            'gallery_group' => 'Gallery group identifier applied to all wrapped <code>&lt;img&gt;</code> tags within the container.',
        ],
    ],
];
