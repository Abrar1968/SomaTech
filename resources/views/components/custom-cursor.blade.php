{{-- Custom Cursor - Only on desktop with fine pointer --}}
<div
    x-data="customCursor()"
    x-init="init()"
    class="hidden lg:block"
    style="pointer-events: none;"
>
    {{-- Cursor Dot (Inner) --}}
    <div
        id="cursor-dot"
        class="fixed z-[9999] pointer-events-none mix-blend-difference"
        :style="`transform: translate(${dotX}px, ${dotY}px)`"
        x-show="visible"
        x-transition:enter="transition-opacity duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-cloak
    >
        <div 
            class="w-3 h-3 rounded-full bg-white transition-transform duration-150"
            :class="clicking ? 'scale-50' : 'scale-100'"
        ></div>
    </div>

    {{-- Cursor Ring (Outer) --}}
    <div
        id="cursor-ring"
        class="fixed z-[9998] pointer-events-none"
        :style="`transform: translate(${ringX}px, ${ringY}px)`"
        x-show="visible"
        x-transition:enter="transition-opacity duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-cloak
    >
        <div 
            class="relative flex items-center justify-center transition-all duration-300 ease-out"
            :class="{
                'w-20 h-20': hovering,
                'w-10 h-10': !hovering
            }"
        >
            {{-- Ring border --}}
            <div 
                class="absolute inset-0 rounded-full border transition-all duration-300"
                :class="{
                    'border-accent bg-accent/10 border-2': hovering,
                    'border-white/30': !hovering,
                    'scale-90': clicking
                }"
            ></div>
            
            {{-- Magnetic glow effect --}}
            <div 
                x-show="hovering"
                class="absolute inset-0 rounded-full bg-accent/20 blur-md"
                x-transition:enter="transition-opacity duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
            ></div>

            {{-- Hover text --}}
            <span
                x-show="hovering && hoverText"
                x-transition:enter="transition-all duration-200"
                x-transition:enter-start="opacity-0 scale-75"
                x-transition:enter-end="opacity-100 scale-100"
                x-text="hoverText"
                class="relative text-white text-xs font-bold uppercase tracking-wider"
            ></span>

            {{-- Arrow icon for links --}}
            <svg 
                x-show="hovering && !hoverText && isLink"
                x-transition:enter="transition-all duration-200"
                x-transition:enter-start="opacity-0 scale-50"
                x-transition:enter-end="opacity-100 scale-100"
                class="relative w-4 h-4 text-white"
                fill="none" 
                stroke="currentColor" 
                viewBox="0 0 24 24"
            >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
            </svg>
        </div>
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
        isLink: false,
        visible: false,

        init() {
            // Only enable on desktop with fine pointer
            if (!window.matchMedia('(pointer: fine)').matches) {
                return;
            }

            // Reduce motion preference check
            if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                return;
            }

            document.body.classList.add('cursor-enabled');

            let mouseX = 0;
            let mouseY = 0;

            // Track mouse movement
            document.addEventListener('mousemove', (e) => {
                this.visible = true;
                mouseX = e.clientX;
                mouseY = e.clientY;

                // Update dot position immediately
                this.dotX = mouseX - 6;
                this.dotY = mouseY - 6;
            });

            // Window visibility
            document.addEventListener('mouseleave', () => {
                this.visible = false;
            });

            document.addEventListener('mouseenter', () => {
                this.visible = true;
            });

            // Smooth ring following with easing
            const updateRing = () => {
                const ringSize = this.hovering ? 40 : 20;
                this.ringX += (mouseX - ringSize - this.ringX) * 0.12;
                this.ringY += (mouseY - ringSize - this.ringY) * 0.12;
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

            // Hover detection with element-specific behaviors
            document.addEventListener('mouseover', (e) => {
                const target = e.target;
                
                // Check for different interactive elements
                const link = target.closest('a[href]');
                const button = target.closest('button, [role="button"]');
                const input = target.closest('input, textarea, select');
                const card = target.closest('.project-card, .service-card, .team-card, .testimonial-card');
                const image = target.closest('img[data-lightbox], .gallery-image');

                if (link) {
                    this.hovering = true;
                    this.isLink = true;
                    this.hoverText = '';
                } else if (button) {
                    this.hovering = true;
                    this.isLink = false;
                    this.hoverText = '';
                } else if (input) {
                    this.hovering = true;
                    this.isLink = false;
                    this.hoverText = '';
                } else if (card) {
                    this.hovering = true;
                    this.isLink = false;
                    this.hoverText = 'View';
                } else if (image) {
                    this.hovering = true;
                    this.isLink = false;
                    this.hoverText = 'Zoom';
                } else {
                    this.hovering = false;
                    this.isLink = false;
                    this.hoverText = '';
                }
            });
        }
    };
}
</script>
</script>
