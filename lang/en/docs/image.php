<?php

return [
    'title' => 'Image',
    'badge' => 'Component',
    'group' => 'Media & Display Components',
    'description' => 'A semantic figure and img component engineered for peak modern web performance. Features an animated shimmer skeleton loader eliminating Cumulative Layout Shift (CLS), native lazy loading, LCP hero image prioritization with automatic rel="preload", graceful error handling (initials fallback, built-in placeholder, and replacement URLs), automated figcaption support, flexible aspect ratios via Tailwind utility classes, as well as integrated detail zoom lightbox modals and gallery group navigation.',

    // Section 1: Basic Usage
    'basic_usage' => [
        'title' => 'Basic Usage',
        'desc' => 'Use the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:image&gt;</code> component specifying the required <code class="font-mono text-xs text-foreground">src</code> and <code class="font-mono text-xs text-foreground">alt</code> props. It wraps your image in a semantic <code class="font-mono text-xs text-foreground">&lt;figure&gt;</code> container and smoothly fades in once loaded.',
        'preview_title' => 'Standard Image Presentation',
        'alt_text' => 'Misty mountain scenic panorama',
    ],

    // Section 2: Shimmer Skeleton
    'skeleton' => [
        'title' => 'Shimmer Skeleton (CLS Prevention)',
        'desc' => 'Enabled by default (<code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">skeleton="true"</code>), an animated pulse placeholder fills the container while the image is downloading, preventing jarring Cumulative Layout Shifts. Disable it whenever needed via <code class="font-mono text-xs text-foreground">:skeleton="false"</code>.',
        'preview_title' => 'Image with Active Shimmer Skeleton',
        'alt_text' => 'Minimalist modern architecture',
    ],

    // Section 3: LCP & Priority
    'priority' => [
        'title' => 'LCP Optimization & High Priority (priority)',
        'desc' => 'For critical above-the-fold assets such as hero banners, set <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">priority="true"</code>. The component automatically injects a <code class="font-mono text-xs text-foreground">&lt;link rel="preload" as="image"&gt;</code> tag into the document <code class="font-mono text-xs text-foreground">&lt;head&gt;</code>, switches loading to eager, and applies <code class="font-mono text-xs text-foreground">fetchpriority="high"</code> for optimal Core Web Vitals.',
        'preview_title' => 'Hero Banner with Automated Preload',
        'alt_text' => 'High productivity creator workspace',
        'caption' => 'Hero Banner: Loaded immediately with fetchpriority="high" and automatic head preloading.',
    ],

    // Section 4: Fallback & Broken Image
    'fallback' => [
        'title' => 'Broken Image & Automatic Fallbacks',
        'desc' => 'If an image URL fails to load (404 or network outage), the error state is caught gracefully without breaking page layout. You can supply an automatic initials fallback with the <code class="font-mono text-xs text-foreground">initials</code> or <code class="font-mono text-xs text-foreground">name</code> attributes (just like <code class="font-mono text-xs text-foreground">&lt;vibe:avatar&gt;</code>) with background colors customized via Tailwind classes, a replacement image via <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">fallback</code>, or let it render the elegant built-in SVG placeholder.',
        'preview_title' => 'Broken Image Error State & Automatic Fallbacks',
        'broken_label' => 'Built-in SVG Placeholder (Automatic)',
        'initials_label' => 'Initials Fallback (Colors via Class)',
        'name_label' => 'Auto Initials from Name Prop',
        'fallback_label' => 'Alternative Image (URL)',
        'broken_alt' => 'Product image not found',
        'custom_url_alt' => 'Abstract artwork fallback illustration',
    ],

    // Section 5: Detail & Zoom Lightbox
    'lightbox' => [
        'title' => 'Image Detail & Zoom Modal (Lightbox)',
        'desc' => 'Simply pass the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">zoom</code> or <code class="font-mono text-xs text-foreground">preview</code> attribute to <code class="font-mono text-xs text-foreground">&lt;vibe:image&gt;</code> to transform the image into an interactive preview trigger. Users can zoom in/out (up to 300%), pan & drag, download the original image, and dismiss with <kbd class="px-1.5 py-0.5 rounded bg-muted text-[11px] font-mono border border-border">Esc</kbd>. You can also serve higher resolution images inside the modal via <code class="font-mono text-xs text-foreground">previewSrc="..."</code>.',
        'preview_title' => 'Interactive Image with Zoom & Modal Detail Preview',
        'single_label' => 'Click to Open Image Detail (Zoom)',
        'hd_label' => 'Fast Thumbnail + High-Res Modal Preview (previewSrc)',
        'standalone_label' => 'Standalone Preview (standalone)',
    ],

    // Section 6: Image Gallery & Groups
    'gallery' => [
        'title' => 'Image Gallery & Group Navigation (group & gallery)',
        'desc' => 'Link multiple images into a unified interactive lightbox gallery by adding <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">group="group-name"</code> directly to each <code class="font-mono text-xs text-foreground">&lt;vibe:image zoom&gt;</code>, or wrap a collection of images inside the helper container <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:image.gallery&gt;</code>. The lightbox automatically presents Previous/Next buttons, keyboard arrow navigation, and swipe gestures on touch devices.',
        'preview_title' => 'Linked Gallery with Navigation Controls & Counter',
        'room_1' => 'Modern Living Room Interior',
        'room_2' => 'Scandinavian Minimalist Bedroom',
        'room_3' => 'Spacious Kitchen & Dining Area',
        'room_4' => 'Cozy Balcony Garden Oasis',
    ],

    // Section 7: Aspect Ratios
    'aspect_ratios' => [
        'title' => 'Aspect Ratios via Utility Classes',
        'desc' => 'Apply aspect ratios directly using standard Tailwind utility classes in <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">class="..."</code> (such as <code class="font-mono text-xs text-foreground">class="aspect-video"</code>, <code class="font-mono text-xs text-foreground">class="aspect-square"</code>, <code class="font-mono text-xs text-foreground">class="aspect-4/3"</code>, <code class="font-mono text-xs text-foreground">class="aspect-[21/9]"</code>, and responsive variants like <code class="font-mono text-xs text-foreground">sm:aspect-video</code>). The component intelligently isolates the aspect ratio to the inner media frame so your <code class="font-mono text-xs text-foreground">&lt;figcaption&gt;</code> is never squished or distorted.',
        'preview_title' => 'Aspect Ratio Variations via Tailwind Utility Classes',
        'ratio_16_9' => '16:9 Ratio (class="aspect-video")',
        'ratio_1_1' => '1:1 Ratio (class="aspect-square")',
        'ratio_4_3' => '4:3 Ratio (class="aspect-4/3")',
        'ratio_21_9' => '21:9 Ultrawide Ratio (class="aspect-21/9")',
    ],

    // Section 8: Caption
    'caption' => [
        'title' => 'Image Captions (caption / figcaption)',
        'desc' => 'Provide an explanatory caption using the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">caption="..."</code> prop or place rich HTML markup directly inside the component\'s <code class="font-mono text-xs text-foreground">$slot</code>. It renders semantically inside a <code class="font-mono text-xs text-foreground">&lt;figcaption&gt;</code> element.',
        'preview_title' => 'Image with Semantic Figcaption',
        'caption_text' => 'Official team celebration during the new Vibe UI design system launch.',
        'slot_title' => 'Design Team Documentation',
        'slot_tag' => 'High Resolution',
        'slot_link' => 'Download Full Image &rarr;',
    ],

    // Section 9: Image Styling & Object Fit
    'styling' => [
        'title' => 'Custom Styling & Object Fit (imgClass)',
        'desc' => 'Use the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">imgClass="..."</code> prop to control internal <code class="font-mono text-xs text-foreground">&lt;img&gt;</code> properties such as <code class="font-mono text-xs text-foreground">object-contain</code>, smooth hover zoom scaling, or expressive visual filters.',
        'preview_title' => 'Object Fit & Interactive Image Effects',
        'cover_label' => 'Object Cover (Default)',
        'contain_label' => 'Object Contain with Background',
        'zoom_label' => 'Interactive Hover Zoom Effect',
        'filter_label' => 'Monochrome Filter (Grayscale Hover)',
    ],

    // Section 10: Compositions
    'compositions' => [
        'title' => 'Real-World Compositions & Integration',
        'desc' => 'The <code class="font-mono text-xs text-foreground">&lt;vibe:image&gt;</code> component pairs effortlessly with Card, Badge, and Button components to create captivating blog cards, product showcases, and user profile summaries.',
        'preview_title' => 'Blog Article Card & Profile Showcase Compositions',
        'blog_card_category' => 'Web Development',
        'blog_card_date' => 'Oct 26, 2026',
        'blog_card_title' => 'Crafting High-Performance Interfaces with Vibe UI',
        'blog_card_desc' => 'A comprehensive guide to optimizing Core Web Vitals, image rendering, and developer ergonomics with Laravel Blade.',
        'blog_card_btn' => 'Read Article',
        'profile_card_name' => 'Dr. Jessica Melinda',
        'profile_card_role' => 'Principal Product Designer',
        'profile_card_btn' => 'View Profile',
    ],

    // Section 11: Best Practices
    'best_practices' => [
        'title' => 'Web Vitals & Accessibility Guidelines',
        'desc' => 'Essential guidelines to maximize performance and accessibility for images in your web applications:',
        'lcp_title' => '1. When to use priority="true"?',
        'lcp_desc' => 'Use <code class="font-mono text-xs text-foreground">priority="true"</code> exclusively on the single largest visible above-the-fold image (Hero banner / LCP element). Avoid applying it indiscriminately, as preloading too many assets congests initial bandwidth.',
        'cls_title' => '2. Always Declare Aspect Ratios or Explicit Dimensions',
        'cls_desc' => 'Supply utility classes like <code class="font-mono text-xs text-foreground">aspect-video</code>, <code class="font-mono text-xs text-foreground">aspect-square</code>, or <code class="font-mono text-xs text-foreground">size-16</code> so the browser reserves layout space before bytes arrive.',
        'a11y_title' => '3. Provide Meaningful Alt Text',
        'a11y_desc' => 'Always provide descriptive <code class="font-mono text-xs text-foreground">alt</code> attributes to assist screen reader users and optimize search engine visibility.',
    ],

    // Section 12: Props & Slots Reference
    'props' => [
        'title' => 'Props & Parameters Reference',
        'desc' => 'Complete specification of attributes and options supported by <code class="font-mono text-xs text-foreground">&lt;vibe:image&gt;</code> and <code class="font-mono text-xs text-foreground">&lt;vibe:image.gallery&gt;</code>.',
        'gallery_title' => '<vibe:image.gallery> Props',
        'columns' => [
            'prop' => 'Prop',
            'type' => 'Type',
            'default' => 'Default',
            'desc' => 'Description',
        ],
    ],

    'slots' => [
        'title' => 'Slots Reference',
        'desc' => 'Content slots supported by <code class="font-mono text-xs text-foreground">&lt;vibe:image&gt;</code>.',
        'columns' => [
            'slot' => 'Slot',
            'desc' => 'Description & Purpose',
        ],
        'default_desc' => 'Primary content slot rendered as semantic text or rich HTML inside the <code class="font-mono text-xs text-foreground">&lt;figcaption&gt;</code> element beneath the image. Useful for custom markup like links, icons, or badges.',
    ],

    'props_items' => [
        'src' => 'Source URL for the image file to render. Optional when using initials or built-in placeholder.',
        'alt' => 'Alternative text for screen reader accessibility and SEO fallback.',
        'name' => 'Full name used to automatically derive initials when the `initials` attribute is omitted (mirrors `<vibe:avatar>`).',
        'initials' => 'Text initials (e.g. `"JD"`) automatically shown as fallback when image fails to load or when no `src` is provided.',
        'fallback' => 'Fallback image when primary image fails to load (default: `asset("vibe/images/not-found.png")`). Can be set to a custom URL, `"placeholder"` (SVG), `"initials"`, or `:fallback="false"`.',
        'lazy' => 'Enables native browser lazy loading (`loading="lazy"` and `fetchpriority="low"`).',
        'priority' => 'If `true`, disables lazy loading, sets `fetchpriority="high"`, and injects `&lt;link rel="preload"&gt;` into `&lt;head&gt;`.',
        'skeleton' => 'Displays shimmer pulse placeholder animation while image downloads to avoid Cumulative Layout Shift (CLS).',
        'caption' => 'Caption text rendered inside semantic `&lt;figcaption&gt;` element.',
        'zoom' => 'If `true`, enables interactive click-to-preview full image detail modal (lightbox).',
        'preview' => 'Alternative alias for the `zoom` prop.',
        'previewSrc' => 'Optional higher-resolution image URL opened in the lightbox modal (when thumbnail is a smaller compressed file).',
        'group' => 'Gallery group identifier linking Previous/Next navigation between multiple images.',
        'standalone' => 'If `true`, forces image to open standalone without group navigation even if it shares a group name or sits in a gallery.',
        'zoomIcon' => 'If `true`, displays a subtle glassmorphism zoom badge overlay on hover.',
        'initialsClass' => 'Tailwind classes specifically applied to the initials typography inside the fallback.',
        'imgClass' => 'Tailwind classes applied directly to the internal `&lt;img&gt;` element (e.g. `object-contain`, `scale-105`, `grayscale`).',
        'class' => 'General Tailwind classes applied to the root `<figure>` container (e.g. dimensions, margin, border, rounded, `aspect-*` ratios, and background `bg-*` / text `text-*` colors).',
        'gallery_group' => 'Default group identifier applied to all images contained within the gallery container.',
    ],
];
