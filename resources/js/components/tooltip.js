/**
 * Tooltip initialization using Tippy.js
 * This module sets up a directive for elements to show tooltips when sidebar is collapsed
 */

import tippy from 'tippy.js';
import 'tippy.js/dist/tippy.css';

function initCollapsedTooltips(root = document) {
    const elements = root.querySelectorAll('[data-tooltip]');

    elements.forEach((el) => {
        if (el._tippy) {
            el._tippy.destroy();
        }

        const content = el.getAttribute('data-tooltip') || '';
        const placement = el.getAttribute('data-tooltip-placement') || 'top';
        tippy(el, {
            content,
            placement,
            theme: 'light',
            delay: [200, 0],
            arrow: true,
            interactive: false,
            hideOnClick: true,
        });
    });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => initCollapsedTooltips());
} else {
    initCollapsedTooltips();
}

function updateTooltipTriggers(collapsed) {
    const elements = document.querySelectorAll('[data-tooltip]');
    elements.forEach((el) => {
        if (!el._tippy) return;
        if (collapsed) {
            el._tippy.enable();
            el._tippy.setProps({ trigger: 'mouseenter focus' });
        } else {
            el._tippy.setProps({ trigger: 'manual' });
            el._tippy.disable();
        }
    });
}

// window.addEventListener('alpine:init', () => {
//     const collapsed = Alpine.store('sidebar')?.collapsed ?? false;
//     updateTooltipTriggers(collapsed);
// });

// document.addEventListener('sidebar-toggled', (event) => {
//     updateTooltipTriggers(!!event.detail?.collapsed);
// });

export function refreshTooltips(root = document) {
    initCollapsedTooltips(root);
}