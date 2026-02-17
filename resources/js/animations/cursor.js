/**
 * Custom Cursor Animations
 *
 * Handles the dual-layer custom cursor with:
 * - Smooth following animation
 * - Hover state transitions
 * - Text cursor modes
 * - Click feedback
 */

import { gsap } from 'gsap';

class CustomCursor {
    constructor() {
        this.cursor = document.getElementById('cursor');
        this.cursorDot = document.getElementById('cursor-dot');

        if (!this.cursor || !this.cursorDot) return;

        this.pos = { x: window.innerWidth / 2, y: window.innerHeight / 2 };
        this.mouse = { x: this.pos.x, y: this.pos.y };
        this.speed = 0.15;
        this.isHovering = false;
        this.isHidden = false;

        this.init();
    }

    init() {
        // Track mouse position
        document.addEventListener('mousemove', (e) => {
            this.mouse.x = e.clientX;
            this.mouse.y = e.clientY;

            if (this.isHidden) {
                this.show();
            }
        });

        // Hide on mouse leave window
        document.addEventListener('mouseleave', () => this.hide());
        document.addEventListener('mouseenter', () => this.show());

        // Click feedback
        document.addEventListener('mousedown', () => this.onClick());
        document.addEventListener('mouseup', () => this.onRelease());

        // Setup hover targets
        this.setupHoverTargets();

        // Start animation loop
        this.render();
    }

    setupHoverTargets() {
        // Links and buttons
        const hoverTargets = document.querySelectorAll('a, button, [role="button"], input[type="submit"], [data-cursor="pointer"]');

        hoverTargets.forEach((target) => {
            target.addEventListener('mouseenter', () => this.onHoverEnter());
            target.addEventListener('mouseleave', () => this.onHoverLeave());
        });

        // Text cursor for inputs
        const textInputs = document.querySelectorAll('input[type="text"], input[type="email"], input[type="tel"], textarea, [contenteditable="true"]');

        textInputs.forEach((input) => {
            input.addEventListener('mouseenter', () => this.onTextMode());
            input.addEventListener('mouseleave', () => this.onHoverLeave());
        });

        // Special cursor states
        document.querySelectorAll('[data-cursor="expand"]').forEach((target) => {
            target.addEventListener('mouseenter', () => this.onExpand());
            target.addEventListener('mouseleave', () => this.onHoverLeave());
        });

        document.querySelectorAll('[data-cursor="view"]').forEach((target) => {
            target.addEventListener('mouseenter', () => this.onViewMode(target.dataset.label || 'View'));
            target.addEventListener('mouseleave', () => this.onHoverLeave());
        });
    }

    onHoverEnter() {
        this.isHovering = true;
        gsap.to(this.cursor, {
            scale: 1.5,
            borderColor: 'rgb(108, 99, 255)', // --color-accent
            backgroundColor: 'rgba(108, 99, 255, 0.1)',
            duration: 0.3,
            ease: 'power2.out',
        });
        gsap.to(this.cursorDot, {
            scale: 0,
            duration: 0.3,
            ease: 'power2.out',
        });
    }

    onHoverLeave() {
        this.isHovering = false;
        gsap.to(this.cursor, {
            scale: 1,
            borderColor: 'rgba(255, 255, 255, 0.5)',
            backgroundColor: 'transparent',
            duration: 0.3,
            ease: 'power2.out',
        });
        gsap.to(this.cursorDot, {
            scale: 1,
            duration: 0.3,
            ease: 'power2.out',
        });

        // Remove any text content
        const textEl = this.cursor.querySelector('.cursor-text');
        if (textEl) {
            gsap.to(textEl, {
                opacity: 0,
                scale: 0.5,
                duration: 0.2,
                onComplete: () => textEl.remove(),
            });
        }
    }

    onTextMode() {
        this.isHovering = true;
        gsap.to(this.cursor, {
            scale: 0.5,
            opacity: 0.5,
            duration: 0.3,
            ease: 'power2.out',
        });
        gsap.to(this.cursorDot, {
            scaleY: 2,
            duration: 0.3,
            ease: 'power2.out',
        });
    }

    onExpand() {
        this.isHovering = true;
        gsap.to(this.cursor, {
            scale: 3,
            borderColor: 'rgba(108, 99, 255, 0.5)',
            backgroundColor: 'rgba(108, 99, 255, 0.05)',
            duration: 0.5,
            ease: 'power2.out',
        });
        gsap.to(this.cursorDot, {
            scale: 0,
            duration: 0.3,
            ease: 'power2.out',
        });
    }

    onViewMode(label) {
        this.isHovering = true;

        // Add text to cursor
        let textEl = this.cursor.querySelector('.cursor-text');
        if (!textEl) {
            textEl = document.createElement('span');
            textEl.className = 'cursor-text absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-xs font-semibold text-white whitespace-nowrap';
            this.cursor.appendChild(textEl);
        }
        textEl.textContent = label;

        gsap.to(this.cursor, {
            scale: 4,
            borderColor: 'rgb(108, 99, 255)',
            backgroundColor: 'rgba(108, 99, 255, 0.9)',
            duration: 0.4,
            ease: 'power2.out',
        });
        gsap.to(this.cursorDot, {
            scale: 0,
            duration: 0.3,
            ease: 'power2.out',
        });
        gsap.fromTo(textEl,
            { opacity: 0, scale: 0.5 },
            { opacity: 1, scale: 1, duration: 0.3, delay: 0.1, ease: 'back.out' }
        );
    }

    onClick() {
        gsap.to(this.cursor, {
            scale: this.isHovering ? 1.2 : 0.8,
            duration: 0.15,
            ease: 'power2.out',
        });
    }

    onRelease() {
        gsap.to(this.cursor, {
            scale: this.isHovering ? 1.5 : 1,
            duration: 0.3,
            ease: 'elastic.out(1, 0.5)',
        });
    }

    hide() {
        this.isHidden = true;
        gsap.to([this.cursor, this.cursorDot], {
            opacity: 0,
            duration: 0.2,
        });
    }

    show() {
        this.isHidden = false;
        gsap.to([this.cursor, this.cursorDot], {
            opacity: 1,
            duration: 0.2,
        });
    }

    render() {
        // Smooth cursor follow with different speeds
        this.pos.x += (this.mouse.x - this.pos.x) * this.speed;
        this.pos.y += (this.mouse.y - this.pos.y) * this.speed;

        // Apply positions
        if (this.cursor) {
            this.cursor.style.transform = `translate(${this.pos.x}px, ${this.pos.y}px) translate(-50%, -50%)`;
        }

        if (this.cursorDot) {
            // Dot follows faster
            const dotX = this.mouse.x;
            const dotY = this.mouse.y;
            this.cursorDot.style.transform = `translate(${dotX}px, ${dotY}px) translate(-50%, -50%)`;
        }

        requestAnimationFrame(() => this.render());
    }
}

// Initialize cursor
let cursorInstance = null;

export function initCustomCursor() {
    // Only init on non-touch devices
    if (window.matchMedia('(hover: hover) and (pointer: fine)').matches) {
        cursorInstance = new CustomCursor();
        document.body.classList.add('custom-cursor-active');

        // Hide default cursor
        document.body.style.cursor = 'none';
        document.querySelectorAll('a, button, [role="button"]').forEach((el) => {
            el.style.cursor = 'none';
        });
    }

    return cursorInstance;
}

// Auto-init
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initCustomCursor);
} else {
    initCustomCursor();
}

export { CustomCursor };
export default initCustomCursor;
