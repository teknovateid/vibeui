@props([
    'enabled' => config('vibe.seo.enabled', true),
    'title' => null,
    'titleTemplate' => config('vibe.seo.title_template', '%s — ' . config('app.name', 'Laravel')),
    'siteName' => config('vibe.seo.site_name', config('app.name', 'Vibe UI')),
    'description' => config('vibe.seo.description', 'Modern Blade & Tailwind CSS UI Components for Laravel.'),
    'keywords' => config('vibe.seo.keywords'),
    'image' => config('vibe.seo.image', '/vibe/favicon/og-image.png'),
    'imageAlt' => config('vibe.seo.image_alt', 'Vibe UI Component Library'),
    'url' => null,
    'canonical' => null,
    'robots' => config('vibe.seo.robots', 'index, follow'),
    'type' => config('vibe.seo.type', 'website'),
    'locale' => str_replace('_', '-', app()->getLocale()),
    'twitterCard' => config('vibe.seo.twitter_card', 'summary_large_image'),
    'twitterSite' => config('vibe.seo.twitter_site'),
    'twitterCreator' => config('vibe.seo.twitter_creator'),
    'favicon' => config('vibe.seo.favicon.enabled', true),
    'schema' => config('vibe.seo.schema', 'website'),
    'schemaData' => null,
    'breadcrumbs' => [],
    'author' => config('vibe.seo.author', 'Teknovate'),
    'publisher' => config('vibe.seo.publisher', 'Teknovate'),
    'datePublished' => null,
    'dateModified' => null,
    'price' => config('vibe.seo.price', '0'),
    'currency' => config('vibe.seo.currency', 'USD'),
    'rating' => null,
    'reviewCount' => null,
    'brand' => null,
    'sku' => null,
    'availability' => 'https://schema.org/InStock',
    'faq' => [],
    'socials' => config('vibe.seo.socials', []),
    'logo' => config('vibe.seo.logo'),
])

@php
    if ($enabled) {
        $pageTitle = $title ? sprintf($titleTemplate, $title) : $siteName;
        $pageUrl = $url ?? url()->current();
        $canonicalUrl = $canonical ?? $pageUrl;

        // Generate JSON-LD Schemas
        $schemas = [];

        if ($schemaData) {
            $schemas[] = $schemaData;
        } elseif ($schema !== false) {
            $mainSchema = match (strtolower((string) $schema)) {
                'software', 'softwareapplication', 'app' => [
                    '@context' => 'https://schema.org',
                    '@type' => 'SoftwareApplication',
                    'name' => $title ?? $siteName,
                    'headline' => $title ?? $siteName,
                    'description' => $description,
                    'url' => $pageUrl,
                    'applicationCategory' => 'DeveloperApplication',
                    'operatingSystem' => 'All',
                    'offers' => [
                        '@type' => 'Offer',
                        'price' => $price,
                        'priceCurrency' => $currency,
                    ],
                ],
                'article', 'techarticle', 'blogposting', 'blog' => array_filter([
                    '@context' => 'https://schema.org',
                    '@type' => strtolower((string) $schema) === 'techarticle' ? 'TechArticle' : 'BlogPosting',
                    'headline' => $title ?? $siteName,
                    'description' => $description,
                    'image' => asset($image),
                    'url' => $pageUrl,
                    'datePublished' => $datePublished ?? date('c'),
                    'dateModified' => $dateModified ?? $datePublished ?? date('c'),
                    'author' => is_array($author) ? $author : [
                        '@type' => 'Person',
                        'name' => $author,
                    ],
                    'publisher' => [
                        '@type' => 'Organization',
                        'name' => $publisher,
                        'logo' => $logo ? ['@type' => 'ImageObject', 'url' => asset($logo)] : null,
                    ],
                ]),
                'organization', 'company' => array_filter([
                    '@context' => 'https://schema.org',
                    '@type' => 'Organization',
                    'name' => $siteName,
                    'url' => $pageUrl,
                    'logo' => $logo ? asset($logo) : asset($image),
                    'description' => $description,
                    'sameAs' => !empty($socials) ? $socials : null,
                ]),
                'product' => array_filter([
                    '@context' => 'https://schema.org',
                    '@type' => 'Product',
                    'name' => $title ?? $siteName,
                    'image' => asset($image),
                    'description' => $description,
                    'sku' => $sku,
                    'brand' => $brand ? ['@type' => 'Brand', 'name' => $brand] : ['@type' => 'Brand', 'name' => $siteName],
                    'offers' => [
                        '@type' => 'Offer',
                        'url' => $pageUrl,
                        'priceCurrency' => $currency,
                        'price' => $price,
                        'availability' => $availability,
                    ],
                    'aggregateRating' => $rating ? [
                        '@type' => 'AggregateRating',
                        'ratingValue' => $rating,
                        'reviewCount' => $reviewCount ?? 1,
                    ] : null,
                ]),
                'person', 'profile' => array_filter([
                    '@context' => 'https://schema.org',
                    '@type' => 'Person',
                    'name' => $title ?? (is_string($author) ? $author : $siteName),
                    'url' => $pageUrl,
                    'image' => asset($image),
                    'description' => $description,
                    'sameAs' => !empty($socials) ? $socials : null,
                ]),
                'faq', 'faqpage' => [
                    '@context' => 'https://schema.org',
                    '@type' => 'FAQPage',
                    'mainEntity' => array_map(function ($item) {
                        return [
                            '@type' => 'Question',
                            'name' => $item['question'] ?? $item['q'] ?? '',
                            'acceptedAnswer' => [
                                '@type' => 'Answer',
                                'text' => $item['answer'] ?? $item['a'] ?? '',
                            ],
                        ];
                    }, $faq),
                ],
                default => [
                    '@context' => 'https://schema.org',
                    '@type' => 'WebSite',
                    'name' => $siteName,
                    'headline' => $pageTitle,
                    'description' => $description,
                    'url' => $pageUrl,
                ],
            };

            $schemas[] = $mainSchema;
        }

        // Append Breadcrumbs Schema if provided
        if (!empty($breadcrumbs)) {
            $itemListElement = [];
            $pos = 1;
            foreach ($breadcrumbs as $crumb) {
                $itemListElement[] = [
                    '@type' => 'ListItem',
                    'position' => $pos++,
                    'name' => is_array($crumb) ? ($crumb['name'] ?? $crumb['title'] ?? '') : (string) $crumb,
                    'item' => is_array($crumb) && isset($crumb['url']) ? url($crumb['url']) : null,
                ];
            }
            $schemas[] = [
                '@context' => 'https://schema.org',
                '@type' => 'BreadcrumbList',
                'itemListElement' => $itemListElement,
            ];
        }

        // Combine into single @graph schema if multiple entities exist
        if (!empty($schemas)) {
            if (count($schemas) === 1) {
                $finalJsonLd = $schemas[0];
            } else {
                $graphItems = array_map(function ($item) {
                    unset($item['@context']);
                    return $item;
                }, $schemas);

                $finalJsonLd = [
                    '@context' => 'https://schema.org',
                    '@graph' => $graphItems,
                ];
            }
        } else {
            $finalJsonLd = null;
        }
    }
@endphp

@if($enabled)
    {{-- Render Favicon Suite if not explicitly disabled --}}
    @if($favicon !== false)
        <vibe:seo.favicon :enabled="is_array($favicon) ? ($favicon['enabled'] ?? true) : ($favicon ?? true)" />
    @endif

    @push('seo')
        <!-- Primary SEO Meta -->
        <title>{{ $pageTitle }}</title>
        <meta name="title" content="{{ $pageTitle }}">
        <meta name="description" content="{{ $description }}">
        @if($keywords)
            <meta name="keywords" content="{{ is_array($keywords) ? implode(', ', $keywords) : $keywords }}">
        @endif
        <meta name="robots" content="{{ $robots }}">
        <link rel="canonical" href="{{ $canonicalUrl }}">

        <!-- Open Graph (Facebook, LinkedIn, Discord, WhatsApp) -->
        <meta property="og:type" content="{{ $type }}">
        <meta property="og:url" content="{{ $pageUrl }}">
        <meta property="og:title" content="{{ $pageTitle }}">
        <meta property="og:description" content="{{ $description }}">
        <meta property="og:image" content="{{ asset($image) }}">
        @if($imageAlt)
            <meta property="og:image:alt" content="{{ $imageAlt }}">
        @endif
        <meta property="og:site_name" content="{{ $siteName }}">
        <meta property="og:locale" content="{{ $locale }}">

        <!-- Twitter Cards (X) -->
        <meta name="twitter:card" content="{{ $twitterCard }}">
        <meta name="twitter:url" content="{{ $pageUrl }}">
        <meta name="twitter:title" content="{{ $pageTitle }}">
        <meta name="twitter:description" content="{{ $description }}">
        <meta name="twitter:image" content="{{ asset($image) }}">
        @if($twitterSite)
            <meta name="twitter:site" content="{{ $twitterSite }}">
        @endif
        @if($twitterCreator)
            <meta name="twitter:creator" content="{{ $twitterCreator }}">
        @endif

        <!-- Structured Data (JSON-LD Schema) -->
        @if($finalJsonLd)
            <script type="application/ld+json">
{!! json_encode($finalJsonLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
            </script>
        @endif
    @endpush
@endif
