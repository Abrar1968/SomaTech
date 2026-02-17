@props(['stat'])

<div
    class="text-center p-6"
    x-data="{
        count: 0,
        target: {{ $stat->value }},
        animated: false,
        animate() {
            if (this.animated) return;
            this.animated = true;
            const duration = 2000;
            const startTime = performance.now();
            const updateCount = (currentTime) => {
                const elapsed = currentTime - startTime;
                const progress = Math.min(elapsed / duration, 1);
                const easeOut = 1 - Math.pow(1 - progress, 3);
                this.count = Math.floor(easeOut * this.target);
                if (progress < 1) {
                    requestAnimationFrame(updateCount);
                } else {
                    this.count = this.target;
                }
            };
            requestAnimationFrame(updateCount);
        }
    }"
    x-intersect.once="animate()"
    data-gsap="counter"
    data-target="{{ $stat->value }}"
>
    @if($stat->icon)
        <div class="w-12 h-12 mx-auto mb-4 text-[var(--color-accent)]">
            {!! $stat->icon !!}
        </div>
    @else
        <div class="w-12 h-12 mx-auto mb-4 bg-gradient-to-br from-[var(--color-accent)] to-[var(--color-accent-2)] rounded-lg flex items-center justify-center">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
            </svg>
        </div>
    @endif

    <div class="text-4xl md:text-5xl font-bold font-display gradient-text mb-2">
        <span>{{ $stat->prefix }}<span x-text="count">0</span>{{ $stat->suffix }}</span>
    </div>

    <p class="text-[var(--color-text-muted)]">{{ $stat->label }}</p>
</div>
