/**
 * Vibe UI - Table Component Vanilla JS
 * Handles client-side table sorting, direction indicator toggling, and row reordering.
 */

export function vibeSortTable(el) {
    var th = el.tagName === 'TH' ? el : el.closest('th');
    if (!th) return;
    var table = th.closest('table');
    if (!table) return;
    var tbody = table.querySelector('tbody');
    if (!tbody) return;

    var colIndex = th.cellIndex;
    var currentDir = th.getAttribute('data-sort-direction');
    var newDir = currentDir === 'asc' ? 'desc' : 'asc';

    // 1. Reset other sortable headers in this table
    var allThs = table.querySelectorAll('th[data-sortable]');
    allThs.forEach(function(otherTh) {
        if (otherTh !== th) {
            otherTh.removeAttribute('data-sort-direction');
            otherTh.removeAttribute('aria-sort');
            var ascIcon = otherTh.querySelector('[data-sort-icon="asc"]');
            var descIcon = otherTh.querySelector('[data-sort-icon="desc"]');
            var neutralIcon = otherTh.querySelector('[data-sort-icon="neutral"]');
            if (ascIcon) ascIcon.style.display = 'none';
            if (descIcon) descIcon.style.display = 'none';
            if (neutralIcon) neutralIcon.style.display = '';
        }
    });

    // 2. Set new sort direction on active th and update icons
    th.setAttribute('data-sort-direction', newDir);
    th.setAttribute('aria-sort', newDir === 'asc' ? 'ascending' : 'descending');
    var ascIcon = th.querySelector('[data-sort-icon="asc"]');
    var descIcon = th.querySelector('[data-sort-icon="desc"]');
    var neutralIcon = th.querySelector('[data-sort-icon="neutral"]');

    if (newDir === 'asc') {
        if (ascIcon) ascIcon.style.display = '';
        if (descIcon) descIcon.style.display = 'none';
        if (neutralIcon) neutralIcon.style.display = 'none';
    } else {
        if (ascIcon) ascIcon.style.display = 'none';
        if (descIcon) descIcon.style.display = '';
        if (neutralIcon) neutralIcon.style.display = 'none';
    }

    // 3. Collect rows from tbody
    var rows = Array.from(tbody.querySelectorAll('tr')).filter(function(r) {
        return !r.hasAttribute('data-empty') && !r.closest('tfoot');
    });
    if (rows.length <= 1) return;

    var getVal = function(row) {
        var cell = row.children[colIndex];
        return cell ? (cell.innerText || cell.textContent || '').trim() : '';
    };

    var cleanVal = function(v) {
        return v.replace(/[$€£¥%,\s]/g, '');
    };

    var isNumeric = function(v) {
        if (!v || v.trim() === '') return false;
        var cleaned = cleanVal(v);
        return !isNaN(cleaned) && !isNaN(parseFloat(cleaned));
    };

    var isColNumeric = rows.length > 0 && rows.every(function(r) {
        var v = getVal(r);
        return v === '' || isNumeric(v);
    });

    rows.sort(function(a, b) {
        var valA = getVal(a);
        var valB = getVal(b);
        if (isColNumeric) {
            var numA = isNumeric(valA) ? parseFloat(cleanVal(valA)) : 0;
            var numB = isNumeric(valB) ? parseFloat(cleanVal(valB)) : 0;
            return newDir === 'asc' ? numA - numB : numB - numA;
        }
        var cmp = valA.localeCompare(valB, undefined, { numeric: true, sensitivity: 'base' });
        return newDir === 'asc' ? cmp : -cmp;
    });

    // 4. Batch reorder rows cleanly (moveBefore preserves active state where supported)
    if ('moveBefore' in Element.prototype) {
        rows.forEach(function(row) {
            tbody.moveBefore(row, null);
        });
    } else {
        var fragment = document.createDocumentFragment();
        rows.forEach(function(row) {
            fragment.appendChild(row);
        });
        tbody.appendChild(fragment);
    }

    var region = table.closest('[role="region"]');
    var statusEl = region ? region.querySelector('[data-vibe-table-status]') : null;
    if (statusEl) {
        var headerText = (th.innerText || th.textContent || '').trim() || ('Column ' + (colIndex + 1));
        statusEl.textContent = headerText + ' sorted ' + (newDir === 'asc' ? 'ascending' : 'descending');
    }

    // 5. Dispatch custom event
    table.dispatchEvent(new CustomEvent('vibe-table-sorted', {
        bubbles: true,
        detail: { columnIndex: colIndex, direction: newDir }
    }));
}

// Bind to window for inline onclick handlers
if (typeof window !== 'undefined') {
    window.vibeSortTable = vibeSortTable;
}

export default vibeSortTable;
