/**
 * Vibe UI - Auth Split Layout Assets (auth-split)
 * Ambient pointer spotlight on the branding pane when hover and motion are permitted.
 */
import { registerLayoutHook } from './core';

function initAuthSplitLayout() {
    const showcase = document.querySelector('[data-vibe-layout="auth-split"] [data-vibe-split-showcase]');
    if (!showcase || showcase.dataset.spotlightBound === 'true') return;

    const prefersReduced = window.matchMedia?.('(prefers-reduced-motion: reduce)').matches;
    const canHover = window.matchMedia?.('(hover: hover)').matches;
    if (prefersReduced || !canHover) return;

    showcase.dataset.spotlightBound = 'true';
    const onPointerMove = (e) => {
        const rect = showcase.getBoundingClientRect();
        if (!rect.width || !rect.height) return;
        const x = ((e.clientX - rect.left) / rect.width) * 100;
        const y = ((e.clientY - rect.top) / rect.height) * 100;
        showcase.style.setProperty('--vibe-split-spotlight-x', `${x.toFixed(1)}%`);
        showcase.style.setProperty('--vibe-split-spotlight-y', `${y.toFixed(1)}%`);
    };

    showcase.addEventListener('pointermove', onPointerMove, { passive: true });
    showcase._vibeSplitCleanup = () => {
        showcase.removeEventListener('pointermove', onPointerMove);
        delete showcase.dataset.spotlightBound;
    };
}

registerLayoutHook('__vibeAuthSplitHook', initAuthSplitLayout);

if (typeof document !== 'undefined' && !window.__vibeAuthSplitCleanup) {
    window.__vibeAuthSplitCleanup = true;
    document.addEventListener('livewire:navigating', () => {
        document.querySelectorAll('[data-vibe-split-showcase]').forEach((el) => el._vibeSplitCleanup?.());
    });
}
