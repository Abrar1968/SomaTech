<footer class="relative bg-[var(--color-bg-surface)] overflow-hidden">
    {{-- Decorative Elements --}}
    <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-accent/50 to-transparent"></div>
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-accent/5 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-accent-2/5 rounded-full blur-3xl pointer-events-none"></div>

    {{-- Newsletter Section --}}
    <div class="container py-16 border-b border-white/5">
        <div class="max-w-4xl mx-auto text-center">
            <h3 class="text-2xl md:text-3xl font-bold font-display mb-4">Stay Updated</h3>
            <p class="text-text-muted mb-8">Get the latest insights on web development, design trends, and exclusive offers.</p>
            <form class="flex flex-col sm:flex-row gap-4 max-w-xl mx-auto">
                <div class="relative flex-1">
                    <input 
                        type="email" 
                        placeholder="Enter your email" 
                        class="w-full px-6 py-4 bg-[var(--color-bg-primary)] border border-white/10 rounded-2xl text-white placeholder-text-muted focus:outline-none focus:border-accent focus:ring-2 focus:ring-accent/20 transition-all"
                    >
                </div>
                <button type="submit" class="px-8 py-4 bg-gradient-to-r from-accent to-accent-2 rounded-2xl text-white font-semibold hover:shadow-lg hover:shadow-accent/25 hover:scale-[1.02] transition-all duration-300 whitespace-nowrap">
                    Subscribe
                </button>
            </form>
        </div>
    </div>

    <div class="container py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-12 lg:gap-8">
            {{-- Brand Column --}}
            <div class="lg:col-span-4">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-3 mb-6 group">
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-accent to-accent-2 rounded-xl blur-md opacity-50 group-hover:opacity-100 transition-opacity"></div>
                        <div class="relative w-12 h-12 bg-gradient-to-br from-accent to-accent-2 rounded-xl flex items-center justify-center">
                            <span class="text-white font-bold text-2xl">S</span>
                        </div>
                    </div>
                    <div>
                        <span class="text-xl font-bold font-display block">Somaticx</span>
                        <span class="text-xs text-text-muted uppercase tracking-widest">Digital Agency</span>
                    </div>
                </a>
                <p class="text-text-muted leading-relaxed mb-8 max-w-sm">
                    Transforming ideas into digital excellence. We craft beautiful, high-performance web and mobile applications that drive business growth.
                </p>

                {{-- Social Links --}}
                <div class="flex gap-3">
                    @foreach([
                        ['name' => 'LinkedIn', 'icon' => 'M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z'],
                        ['name' => 'GitHub', 'icon' => 'M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z'],
                        ['name' => 'Twitter', 'icon' => 'M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z'],
                        ['name' => 'Instagram', 'icon' => 'M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z']
                    ] as $social)
                        <a href="#" class="group w-11 h-11 rounded-xl bg-white/5 hover:bg-gradient-to-br hover:from-accent hover:to-accent-2 flex items-center justify-center transition-all duration-300" aria-label="{{ $social['name'] }}">
                            <svg class="w-5 h-5 text-text-muted group-hover:text-white transition-colors" fill="currentColor" viewBox="0 0 24 24">
                                <path d="{{ $social['icon'] }}"/>
                            </svg>
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Navigation Links --}}
            <div class="lg:col-span-2">
                <h4 class="font-semibold text-white mb-6 flex items-center gap-2">
                    <span class="w-8 h-px bg-gradient-to-r from-accent to-transparent"></span>
                    Navigation
                </h4>
                <ul class="space-y-4">
                    @foreach([
                        ['Home', route('home')],
                        ['About Us', route('about')],
                        ['Services', route('services.index')],
                        ['Portfolio', route('portfolio.index')],
                        ['Contact', route('contact.index')]
                    ] as [$label, $url])
                        <li>
                            <a href="{{ $url }}" class="text-text-muted hover:text-white hover:translate-x-1 inline-flex items-center gap-2 transition-all duration-300 group">
                                <span class="w-0 h-px bg-accent group-hover:w-2 transition-all duration-300"></span>
                                {{ $label }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Services --}}
            <div class="lg:col-span-3">
                <h4 class="font-semibold text-white mb-6 flex items-center gap-2">
                    <span class="w-8 h-px bg-gradient-to-r from-accent to-transparent"></span>
                    Services
                </h4>
                <ul class="space-y-4">
                    @foreach([
                        'Website Development',
                        'App Development',
                        'Website Maintenance',
                        'UI/UX Design',
                        'E-commerce Solutions'
                    ] as $service)
                        <li>
                            <a href="{{ route('services.index') }}" class="text-text-muted hover:text-white hover:translate-x-1 inline-flex items-center gap-2 transition-all duration-300 group">
                                <span class="w-0 h-px bg-accent group-hover:w-2 transition-all duration-300"></span>
                                {{ $service }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Contact Info --}}
            <div class="lg:col-span-3">
                <h4 class="font-semibold text-white mb-6 flex items-center gap-2">
                    <span class="w-8 h-px bg-gradient-to-r from-accent to-transparent"></span>
                    Get in Touch
                </h4>
                <ul class="space-y-5">
                    <li>
                        <a href="mailto:hello@somaticx.com" class="group flex items-start gap-4 text-text-muted hover:text-white transition-colors">
                            <span class="w-10 h-10 rounded-xl bg-white/5 group-hover:bg-accent/20 flex items-center justify-center flex-shrink-0 transition-colors">
                                <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </span>
                            <span>
                                <span class="block text-xs text-text-muted uppercase tracking-wider mb-1">Email Us</span>
                                <span class="block">hello@somaticx.com</span>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="tel:+15555555555" class="group flex items-start gap-4 text-text-muted hover:text-white transition-colors">
                            <span class="w-10 h-10 rounded-xl bg-white/5 group-hover:bg-accent/20 flex items-center justify-center flex-shrink-0 transition-colors">
                                <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </span>
                            <span>
                                <span class="block text-xs text-text-muted uppercase tracking-wider mb-1">Call Us</span>
                                <span class="block">+1 (555) SOMATICX</span>
                            </span>
                        </a>
                    </li>
                    <li>
                        <div class="flex items-start gap-4 text-text-muted">
                            <span class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </span>
                            <span>
                                <span class="block text-xs text-text-muted uppercase tracking-wider mb-1">Location</span>
                                <span class="block">Remote-first, Worldwide</span>
                            </span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    {{-- Copyright --}}
    <div class="border-t border-white/5">
        <div class="container py-8">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-text-muted text-sm">
                    &copy; {{ date('Y') }} Somaticx. All rights reserved. Crafted with 
                    <span class="text-red-500 animate-pulse inline-block">♥</span> 
                    for the web.
                </p>
                <div class="flex items-center gap-8 text-sm">
                    <a href="#" class="text-text-muted hover:text-white transition-colors">Privacy Policy</a>
                    <a href="#" class="text-text-muted hover:text-white transition-colors">Terms of Service</a>
                    <a href="{{ route('sitemap') }}" class="text-text-muted hover:text-white transition-colors">Sitemap</a>
                </div>
            </div>
        </div>
    </div>
</footer>
