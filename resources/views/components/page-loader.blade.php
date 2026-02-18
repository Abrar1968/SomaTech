<div
    x-data="{
        show: true,
        progress: 0,
        init() {
            const interval = setInterval(() => {
                this.progress += Math.random() * 15;
                if (this.progress >= 100) {
                    this.progress = 100;
                    clearInterval(interval);
                    setTimeout(() => this.show = false, 200);
                }
            }, 100);
        }
    }"
    x-show="show"
    x-transition:leave="transition-all duration-700 ease-in-out"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0 scale-105"
    class="fixed inset-0 z-[9999] bg-[var(--color-bg-primary)] flex items-center justify-center"
    x-cloak
>
    {{-- Background Pattern --}}
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-gradient-to-r from-accent/20 to-accent-2/20 rounded-full blur-3xl animate-pulse"></div>
    </div>

    <div class="relative flex flex-col items-center">
        {{-- Animated Logo --}}
        <div class="relative mb-8">
            {{-- Outer spinning ring --}}
            <div class="absolute inset-0 w-24 h-24 border-2 border-transparent border-t-accent border-r-accent-2 rounded-full animate-spin"></div>

            {{-- Inner spinning ring (reverse) --}}
            <div class="absolute inset-2 w-20 h-20 border-2 border-transparent border-b-accent border-l-accent-2 rounded-full animate-spin" style="animation-direction: reverse; animation-duration: 1.5s;"></div>

            {{-- Logo container --}}
            <div class="relative w-24 h-24 flex items-center justify-center">
                <div class="w-16 h-16 bg-gradient-to-br from-accent to-accent-2 rounded-2xl flex items-center justify-center shadow-2xl shadow-accent/30">
                    <span class="text-white font-bold text-3xl">S</span>
                </div>
            </div>
        </div>

        {{-- Brand name with reveal effect --}}
        <div class="mb-8 overflow-hidden">
            <h2 class="text-2xl font-bold font-display tracking-wide gradient-text animate-fade-in">
                SOMATICX
            </h2>
        </div>

        {{-- Progress bar --}}
        <div class="w-48 h-1 bg-white/10 rounded-full overflow-hidden mb-4">
            <div
                class="h-full bg-gradient-to-r from-accent to-accent-2 rounded-full transition-all duration-300 ease-out"
                :style="`width: ${progress}%`"
            ></div>
        </div>

        {{-- Loading text --}}
        <p class="text-text-muted text-sm tracking-wider">
            <span x-text="Math.round(progress)">0</span>%
        </p>
    </div>
</div>
