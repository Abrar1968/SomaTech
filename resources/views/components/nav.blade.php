@props(['transparent' => false])

<nav
    x-data="{
        mobileOpen: false,
        scrolled: false,
        activeDropdown: null,
        init() {
            window.addEventListener('scroll', () => {
                this.scrolled = window.scrollY > 50;
            });
            // Close mobile menu on escape
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') this.mobileOpen = false;
            });
        }
    }"
    :class="{ 
        'bg-[rgba(13,13,13,0.98)] shadow-2xl shadow-black/50 backdrop-blur-xl': scrolled,
        'bg-transparent': !scrolled 
    }"
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-500"
    role="navigation"
    aria-label="Main navigation"
>
    {{-- Top accent line --}}
    <div class="absolute top-0 left-0 right-0 h-[2px] bg-gradient-to-r from-transparent via-accent to-transparent opacity-50"></div>

    <div class="container">
        <div class="flex items-center justify-between h-20 lg:h-24">
            {{-- Logo - SRS UI-002 --}}
            <a href="{{ route('home') }}" class="relative flex items-center gap-3 group z-10">
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-br from-accent to-accent-2 rounded-xl blur-lg opacity-50 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative w-11 h-11 bg-gradient-to-br from-accent to-accent-2 rounded-xl flex items-center justify-center transform group-hover:scale-105 group-hover:rotate-3 transition-all duration-500 shadow-lg">
                        <span class="text-white font-bold text-xl tracking-tight">S</span>
                    </div>
                </div>
                <div class="flex flex-col">
                    <span class="text-xl font-bold font-display tracking-tight">Somaticx</span>
                    <span class="text-[10px] text-text-muted uppercase tracking-[0.2em] font-medium -mt-1 hidden sm:block">Digital Agency</span>
                </div>
            </a>

            {{-- Desktop Navigation - SRS UI-002 --}}
            <div class="hidden lg:flex items-center">
                <div class="flex items-center gap-1 bg-[var(--color-bg-surface)]/50 backdrop-blur-sm rounded-full px-2 py-2 border border-white/5">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">Home</x-nav-link>
                    <x-nav-link :href="route('about')" :active="request()->routeIs('about')">About</x-nav-link>
                    <x-nav-link :href="route('services.index')" :active="request()->routeIs('services.*')">Services</x-nav-link>
                    <x-nav-link :href="route('portfolio.index')" :active="request()->routeIs('portfolio.*')">Portfolio</x-nav-link>
                    <x-nav-link :href="route('contact.index')" :active="request()->routeIs('contact.*')">Contact</x-nav-link>
                </div>

                {{-- Hire Us CTA - SRS UI-002 --}}
                <a
                    href="{{ route('contact.index') }}"
                    class="relative ml-6 px-7 py-3 overflow-hidden rounded-full text-white font-semibold group"
                >
                    <span class="absolute inset-0 bg-gradient-to-r from-accent to-accent-2 transition-transform duration-500 group-hover:scale-105"></span>
                    <span class="absolute inset-0 bg-gradient-to-r from-accent-2 to-accent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></span>
                    <span class="absolute inset-[2px] bg-[var(--color-bg-primary)] rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                    <span class="relative z-10 flex items-center gap-2 group-hover:text-transparent group-hover:bg-gradient-to-r group-hover:from-accent group-hover:to-accent-2 group-hover:bg-clip-text">
                        Let's Talk
                        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </span>
                </a>
            </div>

            {{-- Mobile Hamburger - SRS UI-003 --}}
            <button
                @click="mobileOpen = !mobileOpen"
                class="relative lg:hidden w-12 h-12 flex items-center justify-center rounded-xl bg-[var(--color-bg-surface)]/50 backdrop-blur-sm border border-white/5 z-10"
                :aria-expanded="mobileOpen"
                aria-controls="mobile-menu"
                aria-label="Toggle navigation menu"
            >
                <div class="w-5 h-4 flex flex-col justify-between">
                    <span :class="mobileOpen ? 'rotate-45 translate-y-[7px]' : ''" class="block h-[2px] w-full bg-white rounded-full transition-all duration-300 origin-center"></span>
                    <span :class="mobileOpen ? 'opacity-0 scale-0' : ''" class="block h-[2px] w-full bg-white rounded-full transition-all duration-300"></span>
                    <span :class="mobileOpen ? '-rotate-45 -translate-y-[7px]' : ''" class="block h-[2px] w-full bg-white rounded-full transition-all duration-300 origin-center"></span>
                </div>
            </button>
        </div>
    </div>

    {{-- Mobile Menu Overlay - SRS UI-003 --}}
    <div
        x-show="mobileOpen"
        x-transition:enter="transition ease-out duration-400"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="mobileOpen = false"
        class="lg:hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-40"
        x-cloak
    ></div>

    {{-- Mobile Menu Panel --}}
    <div
        x-show="mobileOpen"
        x-transition:enter="transition ease-out duration-400"
        x-transition:enter-start="opacity-0 translate-x-full"
        x-transition:enter-end="opacity-100 translate-x-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 translate-x-0"
        x-transition:leave-end="opacity-0 translate-x-full"
        class="lg:hidden fixed top-0 right-0 bottom-0 w-full max-w-sm bg-[var(--color-bg-primary)] border-l border-white/5 z-50 overflow-y-auto"
        id="mobile-menu"
        x-cloak
    >
        <div class="p-8 pt-28">
            {{-- Mobile Nav Links --}}
            <nav class="space-y-2">
                <x-mobile-nav-link :href="route('home')" :active="request()->routeIs('home')">Home</x-mobile-nav-link>
                <x-mobile-nav-link :href="route('about')" :active="request()->routeIs('about')">About</x-mobile-nav-link>
                <x-mobile-nav-link :href="route('services.index')" :active="request()->routeIs('services.*')">Services</x-mobile-nav-link>
                <x-mobile-nav-link :href="route('portfolio.index')" :active="request()->routeIs('portfolio.*')">Portfolio</x-mobile-nav-link>
                <x-mobile-nav-link :href="route('contact.index')" :active="request()->routeIs('contact.*')">Contact</x-mobile-nav-link>
            </nav>

            {{-- Mobile CTA --}}
            <div class="mt-8 pt-8 border-t border-white/10">
                <a
                    href="{{ route('contact.index') }}"
                    class="flex items-center justify-center gap-2 w-full py-4 bg-gradient-to-r from-accent to-accent-2 rounded-2xl text-white font-semibold hover:shadow-lg hover:shadow-accent/25 transition-all duration-300"
                    @click="mobileOpen = false"
                >
                    Start a Project
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>

            {{-- Mobile Social Links --}}
            <div class="mt-8">
                <p class="text-sm text-text-muted mb-4">Follow us</p>
                <div class="flex gap-4">
                    <a href="#" class="w-10 h-10 rounded-xl bg-[var(--color-bg-surface)] flex items-center justify-center text-text-muted hover:text-accent hover:bg-accent/10 transition-all" aria-label="LinkedIn">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-xl bg-[var(--color-bg-surface)] flex items-center justify-center text-text-muted hover:text-accent hover:bg-accent/10 transition-all" aria-label="GitHub">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-xl bg-[var(--color-bg-surface)] flex items-center justify-center text-text-muted hover:text-accent hover:bg-accent/10 transition-all" aria-label="Twitter">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>
