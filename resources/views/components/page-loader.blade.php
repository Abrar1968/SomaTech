<div
    data-page-loader
    class="page-loader"
    x-data="{ show: true }"
    x-show="show"
    x-init="setTimeout(() => show = false, 800)"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
>
    <div class="flex flex-col items-center">
        {{-- Logo Animation --}}
        <div class="w-16 h-16 bg-gradient-to-br from-[var(--color-accent)] to-[var(--color-accent-2)] rounded-xl flex items-center justify-center mb-4 animate-pulse">
            <span class="text-white font-bold text-3xl">S</span>
        </div>

        {{-- Loading Bar --}}
        <div class="w-48 h-1 bg-[var(--color-bg-elevated)] rounded-full overflow-hidden">
            <div class="h-full bg-gradient-to-r from-[var(--color-accent)] to-[var(--color-accent-2)] rounded-full animate-loading-bar"></div>
        </div>

        <p class="mt-4 text-[var(--color-text-muted)] text-sm">Loading...</p>
    </div>
</div>

<style>
@keyframes loading-bar {
    0% {
        width: 0%;
    }
    50% {
        width: 70%;
    }
    100% {
        width: 100%;
    }
}

.animate-loading-bar {
    animation: loading-bar 0.8s ease-out forwards;
}
</style>
