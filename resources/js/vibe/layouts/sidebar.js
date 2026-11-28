/**
 * Vibe UI - Modern Sidebar Layout Assets (sidebar)
 * Handles sidebar shell root state syncing & shortcut integration.
 */
import { registerLayoutHook } from './core';

function initModernSidebarLayout() {
    const shell = document.querySelector('[data-vibe-layout="sidebar"]');
    if (!shell) return;

    const sidebarId = shell.dataset.vibeSidebarId || 'sidebar-menu';
    const sidebarEl = document.getElementById(sidebarId);
    if (sidebarEl) {
        const state = sidebarEl.getAttribute('data-state') || 'expanded';
        shell.setAttribute('data-vibe-sidebar-state', state);
        document.documentElement.setAttribute('data-vibe-sidebar-state', state);
    }
}

registerLayoutHook('__vibeSidebarModernHook', initModernSidebarLayout);
