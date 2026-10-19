@blaze

@props([
    'group' => 'default',
])

@pushOnce('head', 'vibe-display-image-js')
    @vite(['resources/js/vibe/display-image.js'])
@endPushOnce

@pushOnce('body', 'vibe-display-lightbox')
    <vibe:display.lightbox />
@endPushOnce

<div
    {{ $attributes->twMerge(['class' => 'vibe-image-gallery']) }}
    data-vibe-gallery="{{ $group }}"
    x-data="{
        group: @js($group),
        init() {
            this.scanImages();
        },
        scanImages() {
            const images = this.$el.querySelectorAll('img:not([data-vibe-ignore])');
            images.forEach((img, index) => {
                img.style.cursor = 'pointer';
                img.classList.add('transition-opacity', 'duration-200', 'hover:opacity-90');
                const src = img.getAttribute('src');
                const alt = img.getAttribute('alt') || '';
                const caption = img.getAttribute('title') || alt;
                const id = 'img-gal-' + Math.random().toString(36).substring(2, 9);
                
                const reg = () => {
                    if (window.Alpine && window.Alpine.store && window.Alpine.store('vibeImageLightbox')) {
                        window.Alpine.store('vibeImageLightbox').register(this.group, {
                            id, src, alt, caption
                        });
                    }
                };
                reg();
                window.addEventListener('alpine:init', reg, { once: true });

                img.onclick = (e) => {
                    e.preventDefault();
                    if (window.Alpine && window.Alpine.store && window.Alpine.store('vibeImageLightbox')) {
                        window.Alpine.store('vibeImageLightbox').open(this.group, src, {
                            alt, caption
                        });
                    }
                };
            });
        }
    }"
>
    {{ $slot }}
</div>
