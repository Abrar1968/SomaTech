@props(['transparent' => false])

<nav
    x-data="{
        mobileOpen: false,
        scrolled: false,
        init() {
            window.addEventListener('scroll', () => {
                this.scrolled = window.scrollY > 80;
            });
        }
    }"
    :class="scrolled ? 'bg-[rgba(13,13,13,0.95)]' : 'bg-[rgba(13,13,13,0.7)]'"
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 glass"
    role="navigation"
    aria-label="Main navigation"
>
    <div class="container">
        <div class="flex items-center justify-between h-20">
            {{-- Logo - SRS UI-002 --}}
            <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                <div class="w-10 h-10 bg-linear-to-br from-accent to-accent-2 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                    <span class="text-white font-bold text-xl">S</span>
                </div>
                <span class="text-xl font-bold font-display">Somaticx</span>
            </a>

            {{-- Desktop Navigation - SRS UI-002 --}}
            <div class="hidden lg:flex items-center gap-8">
                <x-nav-link :href="route('home')" :active="request()->routeIs('home')">Home</x-nav-link>
                <x-nav-link :href="route('about')" :active="request()->routeIs('about')">About</x-nav-link>
                <x-nav-link :href="route('services.index')" :active="request()->routeIs('services.*')">Services</x-nav-link>
                <x-nav-link :href="route('portfolio.index')" :active="request()->routeIs('portfolio.*')">Portfolio</x-nav-link>
                <x-nav-link :href="route('contact.index')" :active="request()->routeIs('contact.*')">Contact</x-nav-link>

                {{-- Hire Us CTA - SRS UI-002 --}}
                <a
                    href="{{ route('contact.index') }}"
                    class="ml-4 px-6 py-2.5 bg-linear-to-r from-accent to-accent-2 rounded-full text-white font-semibold hover:scale-105 hover:shadow-lg hover:shadow-accent/30 transition-all duration-300"
                >
                    Hire Us
                </a>
            </div>

            {{-- Mobile Hamburger - SRS UI-003 --}}
            <button
                @click="mobileOpen = !mobileOpen"
                class="lg:hidden p-2"
                :aria-expanded="mobileOpen"
                aria-controls="mobile-menu"
                aria-label="Toggle navigation menu"
            >
                <div class="w-6 h-5 flex flex-col justify-between">
                    <span :class="mobileOpen && 'rotate-45 translate-y-2'" class="block h-0.5 w-full bg-white transition-all"></span>
                    <span :class="mobileOpen && 'opacity-0'" class="block h-0.5 w-full bg-white transition-all"></span>
                    <span :class="mobileOpen && '-rotate-45 -translate-y-2'" class="block h-0.5 w-full bg-white transition-all"></span>
                </div>
            </button>
        </div>
    </div>

    {{-- Mobile Menu Overlay - SRS UI-003 --}}
    <div
        x-show="mobileOpen"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="lg:hidden fixed inset-0 top-20 bg-bg-primary z-40"
        id="mobile-menu"
    >
        <div class="flex flex-col space-y-4 p-6">
            <x-mobile-nav-link :href="route('home')">Home</x-mobile-nav-link>
            <x-mobile-nav-link :href="route('about')">About</x-mobile-nav-link>
            <x-mobile-nav-link :href="route('services.index')">Services</x-mobile-nav-link>
            <x-mobile-nav-link :href="route('portfolio.index')">Portfolio</x-mobile-nav-link>
            <x-mobile-nav-link :href="route('contact.index')">Contact</x-mobile-nav-link>

            <a
                href="{{ route('contact.index') }}"
                class="mt-4 px-6 py-3 bg-linear-to-r from-accent to-accent-2 rounded-full text-white font-medium text-center"
            >
                Hire Us
            </a>
        </div>
    </div>
</nav>
