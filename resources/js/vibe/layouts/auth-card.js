/**
 * Vibe UI - Auth Card Layout Assets (auth-card)
 */
import { registerLayoutHook } from './core';

function initAuthCardLayout() {
    const shell = document.querySelector('[data-vibe-layout="auth-card"]');
    if (!shell) return;
    shell.dataset.vibeReady = 'true';
}

registerLayoutHook('__vibeAuthCardHook', initAuthCardLayout);
