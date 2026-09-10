<?php

return [
    'title' => 'Image',
    'badge' => 'Component',
    'group' => 'UI Components',
    'description' => 'A semantic figure and img component engineered for peak modern web performance. Features an animated shimmer skeleton loader eliminating Cumulative Layout Shift (CLS), native lazy loading, LCP hero image prioritization with automatic rel="preload", graceful 404 error fallback handling, and automated figcaption support.',

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
        'title' => 'Broken Image Fallbacks (fallback)',
        'desc' => 'If an image URL fails to load (404 or network outage), the error state is caught gracefully without breaking page layout. Provide a replacement image via <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">fallback</code>, or leave it empty to show an elegant dashed error placeholder with an icon and label.',
        'preview_title' => 'Broken Image Error State & Fallback Replacement',
        'broken_label' => 'Default Error UI (No Fallback)',
        'fallback_label' => 'Alternative Image (With Fallback Prop)',
        'broken_alt' => 'Product image not found',
    ],

    // Section 5: Caption
    'caption' => [
        'title' => 'Image Captions (caption / figcaption)',
        'desc' => 'Provide an explanatory caption using the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">caption="..."</code> prop or place rich HTML markup directly inside the component\'s <code class="font-mono text-xs text-foreground">$slot</code>. It renders semantically inside a <code class="font-mono text-xs text-foreground">&lt;figcaption&gt;</code> element.',
        'preview_title' => 'Image with Semantic Figcaption',
        'caption_text' => 'Official team celebration during the new Vibe UI design system launch.',
    ],

    // Section 6: Aspect Ratios
    'aspect_ratios' => [
        'title' => 'Aspect Ratios & Sizing',
        'desc' => 'Apply aspect ratios using the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">aspect="video"</code> (16:9), <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">aspect="square"</code> (1:1), or <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">aspect="4/3"</code> prop, or directly via Tailwind utility classes like <code class="font-mono text-xs text-foreground">class="aspect-video"</code> or <code class="font-mono text-xs text-foreground">class="aspect-square"</code>. The component guarantees exact aspect locking and crops cleanly with <code class="font-mono text-xs text-foreground">object-cover</code>.',
        'preview_title' => 'Aspect Ratio Variations (16:9, 1:1, 4:3)',
        'ratio_16_9' => '16:9 Ratio (aspect-video)',
        'ratio_1_1' => '1:1 Ratio (aspect-square)',
        'ratio_4_3' => '4:3 Ratio (aspect-4/3)',
    ],

    // Section 7: Props Reference
    'props' => [
        'title' => 'Props & Parameters Reference',
        'desc' => 'Complete specification of attributes and options supported by <code class="font-mono text-xs text-foreground">&lt;vibe:image&gt;</code>.',
        'columns' => [
            'prop' => 'Prop',
            'type' => 'Type',
            'default' => 'Default',
            'desc' => 'Description',
        ],
    ],

    'props_items' => [
        'src' => 'Source URL for the image file to render.',
        'alt' => 'Alternative text for screen reader accessibility and SEO fallback.',
        'aspect' => 'Image aspect ratio: `"square"` (1:1), `"video"` (16:9), `"4/3"`, `"3/2"`, `"21/9"`, or other custom ratios. Can also be set via utility classes like `class="aspect-square"`.',
        'lazy' => 'Enables native browser lazy loading (`loading="lazy"` and `fetchpriority="low"`).',
        'priority' => 'If `true`, disables lazy loading, sets `fetchpriority="high"`, and injects `<link rel="preload">` into `<head>`.',
        'fallback' => 'Fallback image URL if primary image fails to load (404 or connection drop).',
        'skeleton' => 'Displays shimmer pulse placeholder animation while image downloads to avoid Cumulative Layout Shift (CLS).',
        'caption' => 'Caption text rendered inside semantic `<figcaption>` element.',
        'imgClass' => 'Tailwind classes applied directly to the internal `<img>` element.',
    ],
];
