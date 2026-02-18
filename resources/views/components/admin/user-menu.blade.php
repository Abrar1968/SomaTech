<div x-data="{ open: false }" class="relative">
    <button
        @click="open = !open"
        class="flex items-center gap-3 hover:bg-[var(--color-bg-elevated)] rounded-lg px-3 py-2 transition-colors"
    >
        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-[var(--color-accent)] to-[var(--color-accent-2)] flex items-center justify-center text-white font-semibold text-sm">
            {{ auth()->user() ? strtoupper(substr(auth()->user()->name, 0, 1)) : 'A' }}
        </div>
        <span class="text-sm font-medium">{{ auth()->user()->name ?? 'Admin' }}</span>
        <svg class="w-4 h-4 text-[var(--color-text-muted)]" fill="none" stroke="currentColor" viewBox="0 0 24 24" :class="open && 'rotate-180'" style="transition: transform 0.2s">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </button>

    <div
        x-show="open"
        @click.away="open = false"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="absolute right-0 mt-2 w-48 bg-[var(--color-bg-surface)] border border-[var(--color-border)] rounded-lg shadow-lg py-1 z-50"
    >
        <a href="#" class="block px-4 py-2 text-sm text-[var(--color-text-muted)] hover:bg-[var(--color-bg-elevated)] hover:text-white transition-colors">
            Profile Settings
        </a>
        <hr class="border-[var(--color-border)] my-1">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-[var(--color-error)] hover:bg-[var(--color-bg-elevated)] transition-colors">
                Sign Out
            </button>
        </form>
    </div>
</div>
