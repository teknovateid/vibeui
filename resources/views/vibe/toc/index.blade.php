@blaze(fold: true)

@props([
    'title' => __('vibe/toc.title'),
    'selector' => '',       // e.g. '#docs-content' or 'main'
    'levels' => 'h2, h3',     // Headings to scan in auto-mode
    'offset' => 40,           // Scroll offset in pixels for header clearance
    'collapsible' => false,   // Show mobile quick-jump bar
    'bordered' => true,       // Left border rail
    'id' => null,
])

@php
    $tocId = $id ?? 'vibe-toc-' . Str::random(6);
    $hasSlot = $slot->isNotEmpty();
@endphp

<div 
    id="{{ $tocId }}"
    data-vibe-toc="{{ $tocId }}"
    data-toc-selector="{{ $selector }}"
    data-toc-levels="{{ $levels }}"
    data-toc-offset="{{ $offset }}"
    x-data="(function() {
        let activeEl = document.querySelector('#{{ $tocId }} [data-toc-href].font-semibold');
        let initialId = activeEl ? activeEl.dataset.tocHref : '';
        let isTicking = false;

        return {
            activeId: initialId,
            selector: '{{ $selector }}',
            levels: '{{ $levels }}',
            offset: {{ (int) $offset }},
            isOpenMobile: false,
            isClickScrolling: false,
            clickScrollTimeout: null,
            init() {
                let onScroll = () => {
                    if (this.isClickScrolling) return;
                    if (!isTicking) {
                        window.requestAnimationFrame(() => {
                            if (!this.isClickScrolling) {
                                this.updateActive();
                            }
                            isTicking = false;
                        });
                        isTicking = true;
                    }
                };

                let scrollContainer = this.getScrollContainer();
                if (scrollContainer && scrollContainer !== window) {
                    scrollContainer.addEventListener('scroll', onScroll, { passive: true });
                }
                window.addEventListener('scroll', onScroll, { passive: true });
                window.addEventListener('resize', onScroll, { passive: true });

                this.$nextTick(() => {
                    this.updateActive();
                });
            },
            getScrollContainer() {
                let scrollEl = document.getElementById('docs-main-scroll');
                if (scrollEl) return scrollEl;

                let parent = this.$el.parentElement;
                while (parent && parent !== document.body) {
                    let style = window.getComputedStyle(parent);
                    if (style.overflowY === 'auto' || style.overflowY === 'scroll') {
                        return parent;
                    }
                    parent = parent.parentElement;
                }
                return window;
            },
            updateActive() {
                if (this.isClickScrolling) return;

                let scrollContainer = this.getScrollContainer();
                let links = this.$el.querySelectorAll('[data-toc-href]');
                if (!links.length) return;

                // Collect tracked heading/section elements in unique order
                let seen = new Set();
                let items = [];
                links.forEach(link => {
                    let id = link.dataset.tocHref;
                    if (id && !seen.has(id)) {
                        seen.add(id);
                        let el = document.getElementById(id);
                        if (el) {
                            items.push({ id, el });
                        }
                    }
                });

                if (!items.length) return;

                let scrollTop = (scrollContainer === window) ? window.scrollY : scrollContainer.scrollTop;
                let scrollHeight = (scrollContainer === window) ? document.documentElement.scrollHeight : scrollContainer.scrollHeight;
                let clientHeight = (scrollContainer === window) ? window.innerHeight : scrollContainer.clientHeight;

                // 1. Near the very top: highlight first item
                if (scrollTop < 50) {
                    this.setActive(items[0].id);
                    return;
                }

                // 2. Near the very bottom: highlight last item
                if (scrollTop + clientHeight >= scrollHeight - 30) {
                    this.setActive(items[items.length - 1].id);
                    return;
                }

                // 3. High-Precision Range & Boundary Evaluation
                let containerRect = (scrollContainer === window) 
                    ? { top: 0, bottom: window.innerHeight } 
                    : scrollContainer.getBoundingClientRect();
                
                let threshold = this.offset + 60;
                let activeId = null;

                for (let i = 0; i < items.length; i++) {
                    let item = items[i];
                    let rect = item.el.getBoundingClientRect();
                    let top = rect.top - containerRect.top;
                    
                    // The section boundary extends from its top to the top of the next section
                    let bottom;
                    if (i < items.length - 1) {
                        let nextRect = items[i + 1].el.getBoundingClientRect();
                        bottom = nextRect.top - containerRect.top;
                    } else {
                        bottom = rect.bottom - containerRect.top;
                    }

                    if (top <= threshold && bottom > threshold) {
                        activeId = item.id;
                        break;
                    }
                }

                // Fallback: if not caught by boundary, find last heading above threshold
                if (!activeId) {
                    for (let i = 0; i < items.length; i++) {
                        let rect = items[i].el.getBoundingClientRect();
                        if (rect.top - containerRect.top <= threshold) {
                            activeId = items[i].id;
                        } else {
                            break;
                        }
                    }
                }

                if (activeId) {
                    this.setActive(activeId);
                }
            },
            setActive(id) {
                if (!id) return;
                this.activeId = id;

                let links = this.$el.querySelectorAll('[data-toc-href]');
                links.forEach(link => {
                    let isCurrent = link.dataset.tocHref === id;
                    if (isCurrent) {
                        link.classList.add('text-card-foreground', 'font-semibold', 'border-primary', 'bg-accent/40');
                        link.classList.remove('text-muted-foreground', 'border-transparent');
                    } else {
                        link.classList.remove('text-card-foreground', 'font-semibold', 'border-primary', 'bg-accent/40');
                        link.classList.add('text-muted-foreground', 'border-transparent');
                    }
                });
            },
            scrollTo(id, e) {
                if (e) {
                    e.preventDefault();
                }
                let el = document.getElementById(id);
                if (!el) return;

                // Immediately lock active state to target id
                this.setActive(id);
                this.isOpenMobile = false;

                // Lock scrollspy for 800ms during smooth scroll animation
                this.isClickScrolling = true;
                if (this.clickScrollTimeout) {
                    clearTimeout(this.clickScrollTimeout);
                }

                let scrollContainer = this.getScrollContainer();

                if (scrollContainer === window || scrollContainer === document.documentElement || scrollContainer === document.body) {
                    let top = el.getBoundingClientRect().top + window.scrollY - this.offset;
                    window.scrollTo({ top: top, behavior: 'smooth' });
                } else {
                    let containerRect = scrollContainer.getBoundingClientRect();
                    let elRect = el.getBoundingClientRect();
                    let currentScrollTop = scrollContainer.scrollTop;
                    let targetScrollTop = currentScrollTop + (elRect.top - containerRect.top) - this.offset;

                    scrollContainer.scrollTo({
                        top: targetScrollTop,
                        behavior: 'smooth'
                    });
                }

                // Release lock after smooth scroll animation settles
                this.clickScrollTimeout = setTimeout(() => {
                    this.isClickScrolling = false;
                }, 800);
            }
        };
    })()"
    {{ $attributes->twMerge(['class' => 'w-full text-xs bg-card text-card-foreground border border-border rounded-xl p-4 shadow-2xs']) }}
>
    {{-- ─── Mobile Accordion / Quick Jump (Zero CLS on mobile) ─── --}}
    <div class="md:hidden">
        <button 
            type="button" 
            @click="isOpenMobile = !isOpenMobile"
            class="flex w-full items-center justify-between font-medium text-card-foreground text-xs select-none"
        >
            <div class="flex items-center gap-2">
                <svg class="size-4 text-muted-foreground" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="21" x2="3" y1="6" y2="6"/>
                    <line x1="15" x2="3" y1="12" y2="12"/>
                    <line x1="17" x2="3" y1="18" y2="18"/>
                </svg>
                <span>{{ $title }}</span>
            </div>
            <svg 
                class="size-4 text-muted-foreground transition-transform duration-200"
                :class="isOpenMobile ? 'rotate-180' : ''"
                xmlns="http://www.w3.org/2000/svg" 
                viewBox="0 0 24 24" 
                fill="none" 
                stroke="currentColor" 
                stroke-width="2" 
                stroke-linecap="round" 
                stroke-linejoin="round"
            >
                <polyline points="6 9 12 15 18 9"/>
            </svg>
        </button>

        <div 
            x-show="isOpenMobile" 
            x-collapse 
            style="display: none;" 
            class="mt-3 pt-3 border-t border-border space-y-1"
            data-toc-mobile-items
        >
            @if ($hasSlot)
                <ul class="space-y-1">
                    {{ $slot }}
                </ul>
            @endif
        </div>
    </div>

    {{-- ─── Desktop Sticky TOC ─── --}}
    <nav class="hidden md:flex flex-col gap-3">
        @if ($title)
            <div class="flex items-center gap-2 text-[11px] font-bold uppercase tracking-wider text-card-foreground">
                <svg class="size-3.5 text-muted-foreground" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="21" x2="3" y1="6" y2="6"/>
                    <line x1="15" x2="3" y1="12" y2="12"/>
                    <line x1="17" x2="3" y1="18" y2="18"/>
                </svg>
                <span>{{ $title }}</span>
            </div>
        @endif

        <div class="relative {{ $bordered ? 'border-l border-border' : '' }}">
            @if ($hasSlot)
                <ul class="space-y-0.5" data-toc-items>
                    {{ $slot }}
                </ul>
            @else
                <ul class="space-y-0.5" data-toc-items>
                    <!-- Pre-rendered via synchronous anti-FOUC script below -->
                </ul>
            @endif
        </div>
    </nav>

    @if (!$hasSlot)
        <script>
            (function() {
                try {
                    let scriptEl = document.currentScript;
                    let root = scriptEl ? scriptEl.closest('[data-vibe-toc]') : document.getElementById('{{ $tocId }}');
                    if (!root) return;

                    let selector = root.dataset.tocSelector || '{{ $selector }}';
                    let levels = root.dataset.tocLevels || '{{ $levels }}';
                    let offset = parseInt(root.dataset.tocOffset || '{{ $offset }}', 10);

                    let populate = function() {
                        let container = selector ? document.querySelector(selector) : document.querySelector('main');
                        if (!container) return;

                        let selectors = levels.split(',').map(s => s.trim()).filter(Boolean);
                        let headingElements = container.querySelectorAll(selectors.join(', '));
                        if (!headingElements.length) return;

                        let ul = root.querySelector('[data-toc-items]');
                        if (ul) ul.innerHTML = '';

                        let mobileContainer = root.querySelector('[data-toc-mobile-items]');
                        let mobileUl = null;
                        if (mobileContainer) {
                            mobileUl = mobileContainer.querySelector('ul');
                            if (!mobileUl) {
                                mobileUl = document.createElement('ul');
                                mobileUl.className = 'space-y-1';
                                mobileContainer.appendChild(mobileUl);
                            }
                            mobileUl.innerHTML = '';
                        }

                        // Calculate which heading is truly in view RIGHT NOW strictly based on scroll position
                        let scrollContainer = document.getElementById('docs-main-scroll') || window;
                        let scrollTop = (scrollContainer === window) ? window.scrollY : (scrollContainer.scrollTop || 0);

                        let initialActiveId = '';
                        if (scrollTop < 50 && headingElements.length > 0) {
                            let firstH = headingElements[0];
                            initialActiveId = firstH.id || (firstH.closest('section[id]')?.id);
                        } else {
                            let containerRect = (scrollContainer === window) ? { top: 0 } : scrollContainer.getBoundingClientRect();
                            let threshold = offset + 60;

                            for (let i = 0; i < headingElements.length; i++) {
                                let hEl = headingElements[i].closest('section[id]') || headingElements[i];
                                let rect = hEl.getBoundingClientRect();
                                let top = rect.top - containerRect.top;
                                
                                let bottom;
                                if (i < headingElements.length - 1) {
                                    let nextEl = headingElements[i + 1].closest('section[id]') || headingElements[i + 1];
                                    bottom = nextEl.getBoundingClientRect().top - containerRect.top;
                                } else {
                                    bottom = rect.bottom - containerRect.top;
                                }

                                if (top <= threshold && bottom > threshold) {
                                    initialActiveId = hEl.id || headingElements[i].id;
                                    break;
                                }
                            }
                        }

                        headingElements.forEach((el, index) => {
                            let section = el.closest('section[id]');
                            let targetId = el.id || (section ? section.id : '');
                            if (!targetId) {
                                let slug = el.textContent.trim().toLowerCase()
                                    .replace(/[^\w\s-]/g, '')
                                    .replace(/[\s_-]+/g, '-')
                                    .replace(/^-+|-+$/g, '');
                                targetId = slug || ('section-' + (index + 1));
                                el.id = targetId;
                            }

                            if (!initialActiveId && index === 0) {
                                initialActiveId = targetId;
                            }

                            let isCurrent = (targetId === initialActiveId);
                            let text = el.textContent.trim();
                            let isH3 = el.tagName.toLowerCase() === 'h3';
                            let isH4 = el.tagName.toLowerCase() === 'h4';
                            let depthPadding = isH3 ? 'padding-left: 1.25rem; font-size: 0.725rem;' : (isH4 ? 'padding-left: 2rem; font-size: 0.7rem;' : 'padding-left: 0.75rem;');

                            let activeClasses = 'text-card-foreground font-semibold border-primary bg-accent/40';
                            let inactiveClasses = 'text-muted-foreground hover:text-card-foreground hover:border-border border-transparent';

                            // 1. Desktop item
                            if (ul) {
                                let li = document.createElement('li');
                                li.className = 'relative';
                                
                                let a = document.createElement('a');
                                a.href = '#' + targetId;
                                a.dataset.tocHref = targetId;
                                a.className = 'group flex items-center py-1 text-xs transition-all duration-150 border-l-2 -ml-px cursor-pointer select-none rounded-r-md ' + (isCurrent ? activeClasses : inactiveClasses);
                                a.style.cssText = depthPadding;
                                
                                let span = document.createElement('span');
                                span.className = 'truncate leading-relaxed';
                                span.textContent = text;
                                a.appendChild(span);

                                a.addEventListener('click', function(e) {
                                    e.preventDefault();
                                    if (root._x_dataStack && root._x_dataStack[0]) {
                                        root._x_dataStack[0].scrollTo(targetId, e);
                                    } else {
                                        let target = document.getElementById(targetId);
                                        if (target) {
                                            let scrollEl = document.getElementById('docs-main-scroll') || window;
                                            if (scrollEl === window) {
                                                let top = target.getBoundingClientRect().top + window.scrollY - offset;
                                                window.scrollTo({ top: top, behavior: 'smooth' });
                                            } else {
                                                let cRect = scrollEl.getBoundingClientRect();
                                                let tRect = target.getBoundingClientRect();
                                                scrollEl.scrollTo({ top: scrollEl.scrollTop + (tRect.top - cRect.top) - offset, behavior: 'smooth' });
                                            }
                                        }
                                    }
                                });

                                li.appendChild(a);
                                ul.appendChild(li);
                            }

                            // 2. Mobile item (if applicable)
                            if (mobileUl) {
                                let mLi = document.createElement('li');
                                let mA = document.createElement('a');
                                mA.href = '#' + targetId;
                                mA.dataset.tocHref = targetId;
                                mA.className = 'block py-1.5 px-2 rounded-md transition-colors text-xs cursor-pointer ' + (isCurrent ? 'bg-accent text-accent-foreground font-semibold' : 'text-muted-foreground hover:text-card-foreground hover:bg-accent/40');
                                if (isH3) mA.style.paddingLeft = '1.5rem';
                                if (isH4) mA.style.paddingLeft = '2.25rem';
                                mA.textContent = text;

                                mA.addEventListener('click', function(e) {
                                    e.preventDefault();
                                    if (root._x_dataStack && root._x_dataStack[0]) {
                                        root._x_dataStack[0].scrollTo(targetId, e);
                                    }
                                });
                                mLi.appendChild(mA);
                                mobileUl.appendChild(mLi);
                            }
                        });
                    };

                    // Run synchronously immediately during document parsing
                    populate();

                    // Also support Livewire SPA navigation
                    document.addEventListener('livewire:navigated', populate);
                } catch (e) {}
            })();
        </script>
    @endif
</div>
