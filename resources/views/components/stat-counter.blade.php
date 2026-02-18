@props(['stat', 'index' => 0])

<div
    class="stat-counter group relative text-center p-8 rounded-3xl bg-gradient-to-b from-white/5 to-transparent border border-white/5 hover:border-accent/20 transition-all duration-500"
    x-data="{
        count: 0,
        target: {{ $stat->value }},
        animated: false,
        visible: false,
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
    x-intersect.once="setTimeout(() => { visible = true; animate(); }, {{ $index * 150 }})"
    :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
    style="transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);"
>
    {{-- Glow effect behind icon --}}
    <div class="absolute top-8 left-1/2 -translate-x-1/2 w-20 h-20 bg-gradient-to-br from-accent/20 to-accent-2/20 rounded-full blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

    {{-- Icon --}}
    <div class="relative w-14 h-14 mx-auto mb-6">
        @if($stat->icon)
            <div class="absolute inset-0 bg-gradient-to-br from-accent/20 to-accent-2/20 rounded-2xl rotate-3 group-hover:rotate-6 transition-transform duration-500"></div>
            <div class="absolute inset-0 bg-[var(--color-bg-surface)] rounded-2xl flex items-center justify-center text-accent">
                <div class="w-6 h-6">{!! $stat->icon !!}</div>
            </div>
        @else
            <div class="absolute inset-0 bg-gradient-to-br from-accent/20 to-accent-2/20 rounded-2xl rotate-3 group-hover:rotate-6 transition-transform duration-500"></div>
            <div class="absolute inset-0 bg-[var(--color-bg-surface)] rounded-2xl flex items-center justify-center">
                <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                </svg>
            </div>
        @endif
    </div>

    {{-- Counter --}}
    <div class="text-4xl md:text-5xl lg:text-6xl font-bold font-display mb-3">
        @if($stat->prefix)
            <span class="gradient-text">{{ $stat->prefix }}</span>
        @endif
        <span class="gradient-text" x-text="count">0</span>
        @if($stat->suffix)
            <span class="gradient-text">{{ $stat->suffix }}</span>
        @endif
    </div>

    {{-- Label --}}
    <p class="text-text-muted font-medium">{{ $stat->label }}</p>

    {{-- Decorative line at bottom --}}
    <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-0 group-hover:w-1/2 h-px bg-gradient-to-r from-transparent via-accent to-transparent transition-all duration-500"></div>
</div>
