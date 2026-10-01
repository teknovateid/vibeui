@blaze(fold: true)

@props([
    'variant' => 'ghost',
    'size' => 'md',
    'href' => null,
    'url' => null,
    'target' => null,
    'action' => null,
    'data' => null,
    'onSuccess' => null,
    'onError' => null,
    'resetErrors' => true,
    'title' => null,
])

@php
    $title = $title ?? __('vibe/button.edit_title');
    $isIcon = str_starts_with($size, 'icon-');
    $wireClick = $attributes->wire('click')->value();
    $buttonAttributes = $attributes->whereDoesntStartWith(['wire:click', 'x-on:click', '@click']);

    $hasTarget = !empty($target);
    $hasUrl = !empty($url);
    $hasData = !empty($data);
    $hasHref = !empty($href);
    $hasWireClick = !empty($wireClick);

    // Build trigger JS expression
    $wirePart = $hasWireClick ? (str_contains($wireClick, '(') ? "\$wire.{$wireClick}; " : "\$wire.{$wireClick}(); ") : '';

    if ($hasTarget || $hasUrl || $hasData) {
        $clickJs = $wirePart . "window.vibeTriggerEdit(\$el)";
    } elseif ($hasWireClick) {
        $clickJs = $wirePart;
    } else {
        $clickJs = '';
    }

    $mergedAttributes = $buttonAttributes->merge([
        'title' => $title,
        'data-url' => $url,
        'data-target' => $target,
        'data-action' => $action,
        'data-href' => $href,
        'data-reset-errors' => $resetErrors ? 'true' : 'false',
        'data-on-success' => $onSuccess,
        'data-on-error' => $onError,
    ]);

    if ($hasData) {
        $mergedAttributes = $mergedAttributes->merge([
            ':data-row-data' => \Illuminate\Support\Js::from($data),
        ]);
    }

    // Always stop event propagation on click to protect Datatable from row selection / reloads
    if (!empty($clickJs)) {
        $mergedAttributes = $mergedAttributes->merge([
            'x-on:click.stop' => $clickJs,
        ]);
    } else {
        $mergedAttributes = $mergedAttributes->merge([
            'x-on:click.stop' => '',
        ]);
    }

    // Only pass href when there is NO target (i.e. pure page redirect mode)
    $buttonHref = (!$hasTarget && $hasHref) ? $href : null;
@endphp

@pushOnce('body', 'vibe-show')
    @vite('resources/js/vibe/show.js')
@endPushOnce

@pushOnce('head', 'vibe-edit-handler')
    <script>
        if (typeof window.vibeTriggerEdit === 'undefined') {
            window.vibeTriggerEdit = function(triggerEl, customOpts) {
                if (!triggerEl) return;

                var options = customOpts || {};
                var target = options.target || triggerEl.getAttribute('data-target');
                var url = options.url || triggerEl.getAttribute('data-url');
                var action = options.action || triggerEl.getAttribute('data-action');
                var href = options.href || triggerEl.getAttribute('data-href');
                var resetErrors = options.resetErrors !== undefined ? options.resetErrors : triggerEl.getAttribute('data-reset-errors') !== 'false';
                var onSuccessStr = options.onSuccess || triggerEl.getAttribute('data-on-success');
                var onErrorStr = options.onError || triggerEl.getAttribute('data-on-error');

                var rowData = options.data || null;
                if (!rowData) {
                    var rawDataAttr = triggerEl.getAttribute('data-row-data') || triggerEl.getAttribute(':data-row-data');
                    if (rawDataAttr) {
                        try { rowData = JSON.parse(rawDataAttr); } catch (e) {}
                    }
                }

                // 1. Locate target element (polymorphic: sheet or modal)
                var targetEl = null;
                var cleanTargetId = '';
                if (target) {
                    cleanTargetId = String(target).trim().replace(/^#/, '');
                    targetEl = document.getElementById(cleanTargetId);
                    if (!targetEl) {
                        try { targetEl = document.querySelector(target); } catch (e) {}
                    }
                }

                // Helper to open sheet or modal container
                function openContainer() {
                    if (!cleanTargetId) return;

                    if (window.$vibe) {
                        if (window.$vibe.sheet && typeof window.$vibe.sheet === 'function') {
                            try { window.$vibe.sheet(cleanTargetId).open(); } catch (e) {}
                        }
                        if (window.$vibe.modal && typeof window.$vibe.modal === 'function') {
                            try { window.$vibe.modal(cleanTargetId).open(); } catch (e) {}
                        }
                    }

                    window.dispatchEvent(new CustomEvent('open-sheet', { detail: cleanTargetId }));
                    window.dispatchEvent(new CustomEvent('open-modal', { detail: cleanTargetId }));
                }

                // Helper to update form action URL
                function updateFormAction() {
                    if (!action || !targetEl) return;
                    var formEl = targetEl.tagName === 'FORM' ? targetEl : targetEl.querySelector('form');
                    if (formEl) {
                        formEl.setAttribute('action', action);
                        if ('action' in formEl) {
                            formEl.action = action;
                        }
                    }
                }

                // Helper to reset error states
                function clearValidationErrors() {
                    if (!resetErrors || !targetEl) return;
                    targetEl.querySelectorAll('.border-destructive, [aria-invalid="true"]').forEach(function(el) {
                        el.classList.remove('border-destructive');
                        el.removeAttribute('aria-invalid');
                    });
                    targetEl.querySelectorAll('[data-field-error], [data-error]').forEach(function(el) {
                        el.innerHTML = '';
                    });
                }

                // Helper to populate data into target
                function populateData(dataObj) {
                    if (!dataObj || !targetEl) return;
                    if (window.VibeShow && typeof window.VibeShow.populate === 'function') {
                        window.VibeShow.populate(dataObj, targetEl);
                    } else if (window.vibeShow && typeof window.vibeShow.populate === 'function') {
                        window.vibeShow.populate(dataObj, targetEl);
                    } else {
                        // Fallback simple property mapping
                        Object.keys(dataObj).forEach(function(key) {
                            var val = dataObj[key];
                            var input = targetEl.querySelector('[name="' + key + '"]');
                            if (input) {
                                input.value = val !== null && val !== undefined ? val : '';
                                input.dispatchEvent(new Event('input', { bubbles: true }));
                                input.dispatchEvent(new Event('change', { bubbles: true }));
                            }
                        });
                    }
                }

                // Helper to trigger onSuccess
                function handleSuccess(payload) {
                    if (!onSuccessStr) return;
                    try {
                        if (typeof onSuccessStr === 'function') {
                            onSuccessStr(payload, targetEl, triggerEl);
                        } else {
                            var fn = new Function('$data', '$target', '$el', onSuccessStr);
                            fn(payload, targetEl, triggerEl);
                        }
                    } catch (e) {
                        console.error('[VibeButtonEdit] onSuccess error:', e);
                    }
                }

                // Helper to trigger onError
                function handleError(err) {
                    console.error('[VibeButtonEdit] Error:', err);
                    if (window.$vibe && window.$vibe.toast) {
                        window.$vibe.toast.error(err.message || '{{ __('vibe/button.edit_error') }}');
                    }
                    if (onErrorStr) {
                        try {
                            if (typeof onErrorStr === 'function') {
                                onErrorStr(err, triggerEl);
                            } else {
                                var fn = new Function('$error', '$el', onErrorStr);
                                fn(err, triggerEl);
                            }
                        } catch (e) {
                            console.error('[VibeButtonEdit] onError error:', e);
                        }
                    }
                }

                // A. Instant Mode (data provided locally)
                if (rowData && typeof rowData === 'object') {
                    clearValidationErrors();
                    updateFormAction();
                    populateData(rowData);
                    openContainer();
                    handleSuccess(rowData);
                    return;
                }

                // B. AJAX Mode (url provided)
                if (url) {
                    if (triggerEl instanceof Element) {
                        triggerEl.disabled = true;
                        triggerEl.setAttribute('data-loading', 'true');
                        triggerEl.classList.add('is-loading');
                    }

                    fetch(url, {
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(function(res) {
                        if (!res.ok) throw new Error('HTTP ' + res.status + ': ' + res.statusText);
                        return res.json();
                    })
                    .then(function(json) {
                        var payload = json;
                        if (json && typeof json === 'object' && 'data' in json && typeof json.data === 'object' && json.data !== null && Object.keys(json).length <= 2) {
                            payload = json.data;
                        }
                        clearValidationErrors();
                        updateFormAction();
                        populateData(payload);
                        openContainer();
                        handleSuccess(payload);
                    })
                    .catch(function(err) {
                        handleError(err);
                    })
                    .finally(function() {
                        if (triggerEl instanceof Element) {
                            triggerEl.disabled = false;
                            triggerEl.removeAttribute('data-loading');
                            triggerEl.classList.remove('is-loading');
                        }
                    });
                    return;
                }

                // C. Target Only (no local data, no url)
                if (target) {
                    clearValidationErrors();
                    updateFormAction();
                    openContainer();
                    handleSuccess(null);
                    return;
                }

                // D. Page Redirect Mode
                if (href) {
                    if (window.Livewire && typeof window.Livewire.navigate === 'function') {
                        window.Livewire.navigate(href);
                    } else {
                        window.location.href = href;
                    }
                }
            };
        }
    </script>
@endPushOnce

<vibe:button :href="$buttonHref" :variant="$variant" :size="$size" :attributes="$mergedAttributes">
    @if ($slot->isNotEmpty())
        {{ $slot }}
    @else
        <svg class="{{ $isIcon ? 'size-3.5' : 'size-4 mr-1.5' }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z" />
            <path d="m15 5 4 4" />
        </svg>
    @endif
</vibe:button>
