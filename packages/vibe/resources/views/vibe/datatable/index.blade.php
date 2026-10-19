@blaze

@props([
    'component' => null,
    'bordered' => false,
    'lazy' => false,
])

@pushOnce('head', 'vibe-datatable-styles')
    @rappasoftTableStyles
    @rappasoftTableThirdPartyStyles
@endPushOnce

@pushOnce('head', 'vibe-datatable-scripts')
    @rappasoftTableScripts
    @rappasoftTableThirdPartyScripts
    @vite('resources/js/vibe/datatable.js')

    <script>
        (function () {
            'use strict';

            function resolveViteDatatableUrl() {
                var links = document.querySelectorAll('link[rel="modulepreload"]');
                for (var i = 0; i < links.length; i++) {
                    if (links[i].href && links[i].href.indexOf('datatable') !== -1) {
                        return links[i].href;
                    }
                }
                var scripts = document.querySelectorAll('script[type="module"]');
                for (var j = 0; j < scripts.length; j++) {
                    if (scripts[j].src && scripts[j].src.indexOf('datatable') !== -1) {
                        return scripts[j].src;
                    }
                }
                return null;
            }

            var datatableModulePromise = null;

            function loadDatatableModule() {
                if (datatableModulePromise) return datatableModulePromise;
                var url = resolveViteDatatableUrl();
                if (!url) {
                    datatableModulePromise = Promise.reject(new Error('[Vibe DataTable] Could not resolve datatable.js URL'));
                } else {
                    datatableModulePromise = import(url);
                }
                return datatableModulePromise;
            }

            function reinitDatatableElements(mod) {
                if (!window.Alpine) return;
                var roots = document.querySelectorAll('.vibe-datatable-root, [x-data*="laravellivewiretable"]');
                roots.forEach(function (root) {
                    var tableEls = root.matches && root.matches('[x-data*="laravellivewiretable"]')
                        ? [root]
                        : root.querySelectorAll('[x-data*="laravellivewiretable"]');

                    tableEls.forEach(function (el) {
                        var stack = el._x_dataStack;
                        var data = stack && stack[0];
                        var isProperlyInit = data && typeof data.setTableId === 'function';

                        if (!isProperlyInit) {
                            try {
                                if (typeof window.Alpine.destroyTree === 'function') {
                                    window.Alpine.destroyTree(el);
                                } else {
                                    ['_x_dataStack', '_x_effects', '_x_cleanups', '_x_attributeCleanups',
                                     '_x_bindings', '_x_runEffects', '_x_ignore', '_x_refs'
                                    ].forEach(function (k) { try { delete el[k]; } catch(e){} });
                                }
                                if (typeof window.Alpine.initTree === 'function') {
                                    window.Alpine.initTree(el);
                                }
                            } catch (e) {
                                console.warn('[Vibe DataTable] Re-init error:', e);
                            }
                        }
                        if (el.hasAttribute('x-cloak')) el.removeAttribute('x-cloak');
                    });
                    root.querySelectorAll('[x-cloak]').forEach(function (el) {
                        el.removeAttribute('x-cloak');
                    });
                });
            }
            document.addEventListener('alpine:init', function () {
                loadDatatableModule()
                    .then(function (mod) {
                        if (mod && typeof mod.registerLivewireTableComponents === 'function') {
                            mod.registerLivewireTableComponents(window.Alpine);
                        }
                        setTimeout(function () { reinitDatatableElements(mod); }, 0);
                    })
                    .catch(function (e) {
                        console.warn('[Vibe DataTable] Module load error during alpine:init:', e);
                    });
            });

            document.addEventListener('livewire:init', function () {
                loadDatatableModule()
                    .then(function (mod) {
                        if (mod && typeof mod.ensureDatatablesReady === 'function') {
                            mod.ensureDatatablesReady();
                        } else {
                            reinitDatatableElements(mod);
                        }
                    })
                    .catch(function () {});
            });
            document.addEventListener('livewire:navigated', function () {
                loadDatatableModule()
                    .then(function (mod) {
                        if (mod && typeof mod.ensureDatatablesReady === 'function') {
                            mod.ensureDatatablesReady();
                            [50, 150, 300].forEach(function (d) {
                                setTimeout(function () { mod.ensureDatatablesReady(); }, d);
                            });
                        }
                    })
                    .catch(function () {});
            });

            var observer = new MutationObserver(function (mutations) {
                var hasNewDatatable = false;
                for (var i = 0; i < mutations.length; i++) {
                    var added = mutations[i].addedNodes;
                    for (var j = 0; j < added.length; j++) {
                        var node = added[j];
                        if (node.nodeType === 1) {
                            if (
                                (node.classList && node.classList.contains('vibe-datatable-root')) ||
                                (node.getAttribute && node.getAttribute('x-data') && node.getAttribute('x-data').indexOf('laravellivewiretable') !== -1) ||
                                (node.querySelector && node.querySelector('.vibe-datatable-root, [x-data*="laravellivewiretable"]'))
                            ) {
                                hasNewDatatable = true;
                                break;
                            }
                        }
                    }
                    if (hasNewDatatable) break;
                }

                if (hasNewDatatable) {
                    loadDatatableModule()
                        .then(function (mod) {
                            if (mod && typeof mod.ensureDatatablesReady === 'function') {
                                setTimeout(function () { mod.ensureDatatablesReady(); }, 50);
                            }
                        })
                        .catch(function () {});
                }
            });

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', function () {
                    observer.observe(document.body, { childList: true, subtree: true });
                });
            } else {
                observer.observe(document.body, { childList: true, subtree: true });
            }
        })();
    </script>
@endPushOnce

@php
    $classAttr = (string) $attributes->get('class', '');
    $classesList = preg_split('/\s+/', trim($classAttr));
    $hasBorderClass = in_array('border', $classesList, true) || in_array('bordered', $classesList, true);

    $isBordered = $bordered || $hasBorderClass;
    $borderedCellStyles = $isBordered ? '[&_th]:border [&_th]:border-table-border [&_td]:border [&_td]:border-table-border border-collapse' : '';
@endphp

@if ($component)
    <div {{ $attributes->twMerge(['class' => "w-full {$borderedCellStyles}"]) }}>
        @if ($lazy)
            <livewire:is :$component lazy />
        @else
            <livewire:is :$component />
        @endif
    </div>
@else
    <div {{ $attributes->twMerge(['class' => "w-full space-y-4 {$borderedCellStyles}"]) }}>
        {{ $slot }}
    </div>
@endif
