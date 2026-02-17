<div
    x-data="customCursor()"
    x-init="init()"
    class="hidden lg:block"
    style="pointer-events: none;"
>
    {{-- Inner Dot --}}
    <div
        id="cursor-dot"
        class="fixed w-2.5 h-2.5 rounded-full bg-[var(--color-accent)] z-[9999] pointer-events-none"
        :style="`transform: translate(${dotX}px, ${dotY}px)`"
        x-show="visible"
    ></div>

    {{-- Outer Ring --}}
    <div
        id="cursor-ring"
        class="fixed w-10 h-10 rounded-full border-2 border-[var(--color-accent)] z-[9999] transition-all duration-300 pointer-events-none flex items-center justify-center"
        :style="`transform: translate(${ringX}px, ${ringY}px)`"
        :class="{
            'w-16 h-16 bg-[var(--color-accent)]/20 border-[var(--color-accent)]': hovering,
            'scale-75': clicking
        }"
        x-show="visible"
    >
        <span
            x-show="hovering && hoverText"
            x-text="hoverText"
            class="text-white text-xs font-semibold"
        ></span>
    </div>
</div>

<script>
function customCursor() {
    return {
        dotX: 0,
        dotY: 0,
        ringX: 0,
        ringY: 0,
        hovering: false,
        clicking: false,
        hoverText: '',
        visible: false,

        init() {
            // Only enable on desktop with fine pointer
            if (!window.matchMedia('(pointer: fine)').matches) {
                return;
            }

            document.body.classList.add('cursor-enabled');

            let mouseX = 0;
            let mouseY = 0;

            document.addEventListener('mousemove', (e) => {
                this.visible = true;
                mouseX = e.clientX;
                mouseY = e.clientY;

                // Dot follows immediately
                this.dotX = mouseX - 5;
                this.dotY = mouseY - 5;
            });

            document.addEventListener('mouseleave', () => {
                this.visible = false;
            });

            document.addEventListener('mouseenter', () => {
                this.visible = true;
            });

            // Ring follows with lag
            const updateRing = () => {
                this.ringX += (mouseX - 20 - this.ringX) * 0.1;
                this.ringY += (mouseY - 20 - this.ringY) * 0.1;
                requestAnimationFrame(updateRing);
            };
            updateRing();

            // Click effects
            document.addEventListener('mousedown', () => {
                this.clicking = true;
            });

            document.addEventListener('mouseup', () => {
                this.clicking = false;
            });

            // Hover detection
            document.addEventListener('mouseover', (e) => {
                const target = e.target;
                if (target.closest('a, button, [role="button"], input, textarea, select, label')) {
                    this.hovering = true;
                    this.hoverText = '';
                } else if (target.closest('img, .project-card, .service-card')) {
                    this.hovering = true;
                    if (target.closest('.project-card')) {
                        this.hoverText = 'View';
                    }
                } else {
                    this.hovering = false;
                    this.hoverText = '';
                }
            });
        }
    };
}
</script>
