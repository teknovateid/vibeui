/**
 * Vibe UI - Auth Simple Layout Assets (auth-simple)
 */
import { registerLayoutHook } from './core';

function initAuthSimpleLayout() {
    const shell = document.querySelector('[data-vibe-layout="auth-simple"]');
    if (!shell) return;
    shell.dataset.vibeReady = 'true';
}

registerLayoutHook('__vibeAuthSimpleHook', initAuthSimpleLayout);
