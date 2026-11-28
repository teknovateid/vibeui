/**
 * Vibe UI - Classic Sidebar Layout Assets (sidebar-classic)
 * Handles structured classic sidebar state syncing & shortcut integration.
 */
import { registerLayoutHook } from './core';

function initClassicSidebarLayout() {
    const shell = document.querySelector('[data-vibe-layout="sidebar-classic"]');
    if (!shell) return;

    const sidebarId = shell.dataset.vibeSidebarId || 'sidebar-menu';
    const sidebarEl = document.getElementById(sidebarId);
    if (sidebarEl) {
        const state = sidebarEl.getAttribute('data-state') || 'expanded';
        shell.setAttribute('data-vibe-sidebar-state', state);
        document.documentElement.setAttribute('data-vibe-sidebar-state', state);
    }
}

registerLayoutHook('__vibeSidebarClassicHook', initClassicSidebarLayout);
