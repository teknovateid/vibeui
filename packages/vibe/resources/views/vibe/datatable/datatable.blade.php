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
                    if (root.hasAttribute('x-cloak')) root.removeAttribute('x-cloak');
                    root.querySelectorAll('[x-cloak]').forEach(function (el) {
                        el.removeAttribute('x-cloak');
                    });
                });
            }

            function triggerDatatableInit() {
                loadDatatableModule()
                    .then(function (mod) {
                        if (mod && typeof mod.registerLivewireTableComponents === 'function') {
                            mod.registerLivewireTableComponents(window.Alpine);
                        }
                        if (mod && typeof mod.ensureDatatablesReady === 'function') {
                            mod.ensureDatatablesReady();
                        } else {
                            reinitDatatableElements(mod);
                        }
                        [50, 150, 300, 600].forEach(function (d) {
                            setTimeout(function () {
                                if (mod && typeof mod.ensureDatatablesReady === 'function') {
                                    mod.ensureDatatablesReady();
                                } else {
                                    reinitDatatableElements(mod);
                                }
                            }, d);
                        });
                    })
                    .catch(function () {
                        reinitDatatableElements(null);
                    });
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', triggerDatatableInit);
            } else {
                triggerDatatableInit();
            }

            document.addEventListener('alpine:init', function () {
                triggerDatatableInit();
            });

            document.addEventListener('livewire:init', function () {
                triggerDatatableInit();
            });

            document.addEventListener('livewire:navigated', function () {
                triggerDatatableInit();
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
                    triggerDatatableInit();
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

@php($tableName = $this->getTableName)
@php($tableId = $this->getTableId)
@php($primaryKey = $this->getPrimaryKey)
@php($isTailwind = $this->isTailwind)
@php($isBootstrap = $this->isBootstrap)
@php($isBootstrap4 = $this->isBootstrap4)
@php($isBootstrap5 = $this->isBootstrap5)
@php($localisationPath = $this->getLocalisationPath)

<div class="vibe-datatable-root">
    <div x-data="Object.assign({ shouldBeDisplayed: true }, {{ $this->getAlpineFallbackScope }})">
        <div {{ $this->getTopLevelAttributes() }}>

            @includeWhen(
                $this->hasConfigurableAreaFor('before-wrapper'),
                $this->getConfigurableAreaFor('before-wrapper'),
                $this->getParametersForConfigurableArea('before-wrapper')
            )

            <x-livewire-tables::wrapper :tableName="$tableName" :$primaryKey :$isTailwind :$isBootstrap :$isBootstrap4 :$isBootstrap5 :$localisationPath>
                @if($this->hasActions && !$this->showActionsInToolbar)
                    <x-livewire-tables::includes.actions/>
                @endif

                @includeWhen(
                    $this->hasConfigurableAreaFor('before-tools'),
                    $this->getConfigurableAreaFor('before-tools'),
                    $this->getParametersForConfigurableArea('before-tools')
                )

                @if($this->shouldShowTools)
                    <x-livewire-tables::tools>
                        @if ($this->showSortPillsSection)
                            <x-livewire-tables::tools.sorting-pills />
                        @endif
                        @if($this->showFilterPillsSection)
                            <x-livewire-tables::tools.filter-pills />
                        @endif

                        @if($this->hasConfigurableAreaFor('before-toolbar'))
                            <div class="relative z-20">
                                @include(
                                    $this->getConfigurableAreaFor('before-toolbar'),
                                    $this->getParametersForConfigurableArea('before-toolbar')
                                )
                            </div>
                        @endif

                        @if($this->shouldShowToolBar)
                            <x-livewire-tables::tools.toolbar />
                        @endif
                        @if (
                            $this->filtersAreEnabled() &&
                            $this->filtersVisibilityIsEnabled() &&
                            $this->hasVisibleFilters() &&
                            $this->isFilterLayoutSlideDown()
                        )
                            <x-livewire-tables::tools.toolbar.items.filter-slidedown />
                        @endif
                        @includeWhen(
                            $this->hasConfigurableAreaFor('after-toolbar'),
                            $this->getConfigurableAreaFor('after-toolbar'),
                            $this->getParametersForConfigurableArea('after-toolbar')
                        )
                    </x-livewire-tables::tools>
                @endif

                @includeWhen(
                    $this->hasConfigurableAreaFor('after-tools'),
                    $this->getConfigurableAreaFor('after-tools'),
                    $this->getParametersForConfigurableArea('after-tools')
                )

                <x-livewire-tables::table>
                    <x-slot name="thead">
                        @if($this->getCurrentlyReorderingStatus)
                            <x-livewire-tables::table.th.reorder x-cloak x-show="currentlyReorderingStatus" />
                        @endif
                        @if($this->showBulkActionsSections)
                            <x-livewire-tables::table.th.bulk-actions :displayMinimisedOnReorder="true" />
                        @endif
                        @if ($this->showCollapsingColumnSections)
                            <x-livewire-tables::table.th.collapsed-columns />
                        @endif

                        @tableloop($this->selectedVisibleColumns as $index => $column)
                            <x-livewire-tables::table.th wire:key="{{ $tableName.'-table-head-'.$index }}" :$column :$index />
                        @endtableloop
                    </x-slot>

                    @if($this->secondaryHeaderIsEnabled() && $this->hasColumnsWithSecondaryHeader())
                        <x-livewire-tables::table.tr.secondary-header />
                    @endif
                    @if($this->hasDisplayLoadingPlaceholder())
                        @include('livewire-tables::loading')
                        {{-- <x-livewire-tables::includes.loading colCount="{{ $this->columns->count()+1 }}" /> --}}
                    @endif

                    @if($this->showBulkActionsSections)
                        <x-livewire-tables::table.tr.bulk-actions :displayMinimisedOnReorder="true" />
                    @endif

                    @if(count($currentRows = $this->getRows) > 0)
                        @php($getCurrentlyReorderingStatus = $this->getCurrentlyReorderingStatus)
                        @php($showBulkActionsSections = $this->showBulkActionsSections)
                        @php($showCollapsingColumnSections = $this->showCollapsingColumnSections)
                        @php($selectedVisibleColumns = $this->selectedVisibleColumns)

                        @tableloop ($currentRows as $rowIndex => $row)
                            <x-livewire-tables::table.tr wire:key="{{ $tableName }}-row-wrap-{{ $row->{$primaryKey} }}" :$row :$rowIndex>
                                @if($getCurrentlyReorderingStatus)
                                    <x-livewire-tables::table.td.reorder x-cloak x-show="currentlyReorderingStatus" wire:key="{{ $tableName }}-row-reorder-{{ $row->{$primaryKey} }}" :rowID="$tableName.'-'.$row->{$this->getPrimaryKey()}" :$rowIndex />
                                @endif
                                @if($showBulkActionsSections)
                                    <x-livewire-tables::table.td.bulk-actions wire:key="{{ $tableName }}-row-bulk-act-{{ $row->{$primaryKey} }}" :$row :$rowIndex />
                                @endif
                                @if ($showCollapsingColumnSections)
                                    <x-livewire-tables::table.td.collapsed-columns wire:key="{{ $tableName }}-row-collapsed-{{ $row->{$primaryKey} }}" :$rowIndex />
                                @endif

                                @tableloop($selectedVisibleColumns as $colIndex => $column)
                                    <x-livewire-tables::table.td wire:key="{{ $tableName . '-' . $row->{$primaryKey} . '-datatable-td-' . $column->getSlug() }}" :$column :$colIndex>
                                        @if($column->isHtml())
                                            {!! $column->setIndexes($rowIndex, $colIndex)->renderContents($row) !!}
                                        @else
                                            {{ $column->setIndexes($rowIndex, $colIndex)->renderContents($row) }}
                                        @endif
                                    </x-livewire-tables::table.td>
                                @endtableloop
                            </x-livewire-tables::table.tr>

                            @if ($showCollapsingColumnSections)
                                <x-livewire-tables::table.collapsed-columns :$row :$rowIndex />
                            @endif
                        @endtableloop
                    @else
                        <x-livewire-tables::table.empty />
                    @endif

                    @if ($this->footerIsEnabled() && ($this->hasColumnsWithFooter() || $this->useHeaderAsFooterIsEnabled()))
                        <x-slot name="tfoot">
                            @if ($this->hasColumnsWithFooter())
                                <x-livewire-tables::table.tr.footer />
                            @endif
                            @if ($this->useHeaderAsFooterIsEnabled())
                                <tr>
                                    @if($this->showBulkActionsSections)
                                        <x-livewire-tables::table.th.bulk-actions :displayMinimisedOnReorder="true" />
                                    @endif
                                    @if ($this->showCollapsingColumnSections)
                                        <x-livewire-tables::table.th.collapsed-columns />
                                    @endif

                                    @tableloop($this->selectedVisibleColumns as $index => $column)
                                        <x-livewire-tables::table.th wire:key="{{ $tableName.'-table-foot-'.$index }}" :$column :$index />
                                    @endtableloop
                                </tr>
                            @endif
                        </x-slot>
                    @endif
                </x-livewire-tables::table>

                <x-livewire-tables::pagination :$currentRows />

                @includeIf($customView)
            </x-livewire-tables::wrapper>

            @includeWhen(
                $this->hasConfigurableAreaFor('after-wrapper'),
                $this->getConfigurableAreaFor('after-wrapper'),
                $this->getParametersForConfigurableArea('after-wrapper')
            )

            @if(method_exists($this, 'hasContextMenu') && $this->hasContextMenu())
                <vibe:context.menu id="{{ $tableName }}-context-menu" :width="$contextMenuWidth" :close-on-click="$contextMenuCloseOnClick">
                    {!! \Illuminate\Support\Facades\Blade::render($this->contextMenu(), ['table' => $this]) !!}
                </vibe:context.menu>
            @endif

        </div>
    </div>
</div>
