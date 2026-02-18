<x-layouts.app>
    @php
        $seoTitle = 'Our Services';
        $seoDescription = 'Explore Somaticx\'s professional web development, app development, and website maintenance services designed to help your business succeed.';
    @endphp

    {{-- Page Hero with Breadcrumb --}}
    <section class="relative pt-40 pb-24 overflow-hidden">
        {{-- Background elements --}}
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-20 left-0 w-[500px] h-[500px] bg-accent/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-0 w-[400px] h-[400px] bg-accent-2/10 rounded-full blur-3xl"></div>
            <div class="absolute inset-0 opacity-30" style="background-image: radial-gradient(circle at 1px 1px, rgba(255,255,255,0.03) 1px, transparent 0); background-size: 40px 40px;"></div>
        </div>

        <div class="container relative">
            {{-- Breadcrumb --}}
            <x-breadcrumb :items="[
                ['label' => 'Home', 'url' => route('home')],
                ['label' => 'Services'],
            ]" />

            <div class="max-w-4xl mt-8"
                x-data="{ visible: false }"
                x-intersect.once="visible = true"
                :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                style="transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);">

                {{-- Badge --}}
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/5 border border-white/10 mb-8">
                    <span class="w-2 h-2 rounded-full bg-accent animate-pulse"></span>
                    <span class="text-sm font-medium text-text-muted">What We Offer</span>
                </div>

                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold font-display mb-6 leading-tight">
                    Our <span class="gradient-text">Services</span>
                </h1>
                <p class="text-xl text-text-muted leading-relaxed max-w-2xl">
                    We offer a comprehensive range of digital services to help businesses establish a strong online presence and achieve their goals.
                </p>
            </div>
        </div>
    </section>

    {{-- Services Grid - SRS FR-004 --}}
    <section class="pb-32">
        <div class="container">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                @forelse($services ?? [] as $index => $service)
                    <article
                        class="service-feature group relative rounded-3xl overflow-hidden bg-[var(--color-bg-elevated)] border border-white/5 hover:border-accent/30 transition-all duration-500"
                        x-data="{ visible: false }"
                        x-intersect.once="setTimeout(() => visible = true, {{ $index * 100 }})"
                        :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                        style="transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);"
                    >
                        {{-- Service Image --}}
                        <div class="relative aspect-[16/9] overflow-hidden">
                            @if($service->featured_image)
                                <img
                                    src="{{ Storage::url($service->featured_image) }}"
                                    alt="{{ $service->title }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                    loading="lazy"
                                >
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-accent/20 to-accent-2/20 flex items-center justify-center">
                                    <div class="absolute inset-0 opacity-30" style="background-image: radial-gradient(circle at 1px 1px, rgba(255,255,255,0.05) 1px, transparent 0); background-size: 24px 24px;"></div>
                                    <svg class="w-20 h-20 text-accent/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                            @endif

                            {{-- Gradient overlay --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-[var(--color-bg-primary)] via-transparent to-transparent"></div>

                            {{-- Service number --}}
                            <div class="absolute top-6 right-6">
                                <span class="text-6xl font-bold text-white/10 font-display">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                            </div>
                        </div>

                        {{-- Service Content --}}
                        <div class="p-8">
                            <h2 class="text-2xl md:text-3xl font-bold font-display mb-2 group-hover:text-accent transition-colors">
                                <a href="{{ route('services.show', $service) }}">{{ $service->title }}</a>
                            </h2>
                            <p class="text-accent/70 text-sm font-medium mb-4">{{ $service->tagline }}</p>
                            <p class="text-text-muted mb-6 leading-relaxed line-clamp-3">{{ $service->short_description }}</p>

                            <a href="{{ route('services.show', $service) }}" class="inline-flex items-center gap-2 text-white font-semibold group/link">
                                <span class="relative">
                                    Learn More
                                    <span class="absolute bottom-0 left-0 w-0 h-px bg-accent group-hover/link:w-full transition-all duration-300"></span>
                                </span>
                                <span class="flex items-center justify-center w-8 h-8 rounded-full bg-white/5 group-hover/link:bg-accent/20 transition-colors duration-300">
                                    <svg class="w-4 h-4 text-accent transform group-hover/link:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </span>
                            </a>
                        </div>
                    </article>
                @empty
                    {{-- Placeholder services when no data --}}
                    @foreach([
                        ['title' => 'Website Development', 'tagline' => 'Custom web solutions tailored to your needs', 'description' => 'From simple landing pages to complex web applications, we build responsive, performant websites using modern technologies like Laravel, Vue.js, and React.', 'icon' => 'code'],
                        ['title' => 'Mobile App Development', 'tagline' => 'Native and cross-platform mobile apps', 'description' => 'We create beautiful, high-performance mobile applications for iOS and Android using Flutter, Swift, and Kotlin.', 'icon' => 'mobile'],
                        ['title' => 'E-Commerce Solutions', 'tagline' => 'Online stores that convert', 'description' => 'Build your online store with our e-commerce solutions. We specialize in custom shopping experiences, payment integrations, and inventory management.', 'icon' => 'cart'],
                        ['title' => 'Website Maintenance', 'tagline' => 'Keep your site running smoothly', 'description' => 'Our maintenance plans include regular updates, security patches, performance optimization, and 24/7 monitoring to ensure your website runs smoothly.', 'icon' => 'settings'],
                    ] as $index => $placeholder)
                        <article
                            class="service-feature group relative rounded-3xl overflow-hidden bg-[var(--color-bg-elevated)] border border-white/5 hover:border-accent/30 transition-all duration-500"
                            x-data="{ visible: false }"
                            x-intersect.once="setTimeout(() => visible = true, {{ $index * 100 }})"
                            :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                            style="transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);"
                        >
                            {{-- Service Image Placeholder --}}
                            <div class="relative aspect-[16/9] overflow-hidden">
                                <div class="w-full h-full bg-gradient-to-br from-accent/20 to-accent-2/20 flex items-center justify-center">
                                    <div class="absolute inset-0 opacity-30" style="background-image: radial-gradient(circle at 1px 1px, rgba(255,255,255,0.05) 1px, transparent 0); background-size: 24px 24px;"></div>
                                    @if($placeholder['icon'] === 'code')
                                        <svg class="w-20 h-20 text-accent/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                                        </svg>
                                    @elseif($placeholder['icon'] === 'mobile')
                                        <svg class="w-20 h-20 text-accent/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                        </svg>
                                    @elseif($placeholder['icon'] === 'cart')
                                        <svg class="w-20 h-20 text-accent/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                    @else
                                        <svg class="w-20 h-20 text-accent/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    @endif
                                </div>

                                {{-- Gradient overlay --}}
                                <div class="absolute inset-0 bg-gradient-to-t from-[var(--color-bg-primary)] via-transparent to-transparent"></div>

                                {{-- Service number --}}
                                <div class="absolute top-6 right-6">
                                    <span class="text-6xl font-bold text-white/10 font-display">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                </div>
                            </div>

                            <div class="p-8">
                                <h2 class="text-2xl md:text-3xl font-bold font-display mb-2 group-hover:text-accent transition-colors">
                                    {{ $placeholder['title'] }}
                                </h2>
                                <p class="text-accent/70 text-sm font-medium mb-4">{{ $placeholder['tagline'] }}</p>
                                <p class="text-text-muted mb-6 leading-relaxed">{{ $placeholder['description'] }}</p>
                                <a href="#" class="inline-flex items-center gap-2 text-white font-semibold group/link">
                                    <span class="relative">
                                        Learn More
                                        <span class="absolute bottom-0 left-0 w-0 h-px bg-accent group-hover/link:w-full transition-all duration-300"></span>
                                    </span>
                                    <span class="flex items-center justify-center w-8 h-8 rounded-full bg-white/5 group-hover/link:bg-accent/20 transition-colors duration-300">
                                        <svg class="w-4 h-4 text-accent transform group-hover/link:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        </article>
                    @endforeach
                @endforelse
            </div>
        </div>
    </section>

    {{-- Why Choose Us Section --}}
    <section class="py-24 bg-gradient-to-b from-[var(--color-bg-surface)] to-[var(--color-bg-primary)]">
        <div class="container">
            <x-section-heading
                badge="Why Choose Us"
                title="The Somaticx <span class='gradient-text'>Advantage</span>"
                subtitle="What sets us apart from the competition"
            />

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach([
                    ['icon' => 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z', 'title' => 'Quality Assured', 'description' => 'Every project goes through rigorous testing and quality checks before delivery.'],
                    ['icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z', 'title' => 'On-Time Delivery', 'description' => 'We respect deadlines and deliver projects on schedule, every time.'],
                    ['icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z', 'title' => 'Expert Team', 'description' => 'Our team consists of seasoned professionals with years of industry experience.'],
                    ['icon' => 'M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z', 'title' => 'Cloud-First Approach', 'description' => 'We leverage modern cloud technologies for scalability and reliability.'],
                    ['icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z', 'title' => 'Data-Driven', 'description' => 'We make decisions based on analytics and measurable outcomes.'],
                    ['icon' => 'M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z', 'title' => '24/7 Support', 'description' => 'Round-the-clock support to ensure your systems are always running smoothly.'],
                ] as $index => $feature)
                    <div
                        class="group relative p-8 rounded-3xl bg-[var(--color-bg-primary)] border border-white/5 hover:border-accent/20 transition-all duration-500"
                        x-data="{ visible: false }"
                        x-intersect.once="setTimeout(() => visible = true, {{ $index * 100 }})"
                        :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                        style="transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);"
                    >
                        <div class="w-14 h-14 mb-6 rounded-2xl bg-gradient-to-br from-accent/20 to-accent-2/20 flex items-center justify-center group-hover:scale-110 transition-transform duration-500">
                            <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $feature['icon'] }}"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold font-display mb-3 group-hover:text-accent transition-colors">{{ $feature['title'] }}</h3>
                        <p class="text-text-muted leading-relaxed">{{ $feature['description'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Process Section --}}
    <section class="py-24">
        <div class="container">
            <x-section-heading
                badge="Our Process"
                title="How We <span class='gradient-text'>Work</span>"
                subtitle="A proven methodology that delivers exceptional results"
            />

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach([
                    ['step' => '01', 'title' => 'Discovery', 'description' => 'We start by understanding your goals, target audience, and requirements through in-depth consultations.'],
                    ['step' => '02', 'title' => 'Strategy & Design', 'description' => 'Our designers create stunning visuals and intuitive user experiences tailored to your brand.'],
                    ['step' => '03', 'title' => 'Development', 'description' => 'Our developers bring the designs to life using modern technologies and best practices.'],
                    ['step' => '04', 'title' => 'Launch & Support', 'description' => 'We deploy your project and provide ongoing support to ensure continued success.'],
                ] as $index => $process)
                    <div
                        class="relative"
                        x-data="{ visible: false }"
                        x-intersect.once="setTimeout(() => visible = true, {{ $index * 150 }})"
                        :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                        style="transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);"
                    >
                        {{-- Connector line (not on last item) --}}
                        @if($index < 3)
                            <div class="hidden lg:block absolute top-10 left-1/2 w-full h-px bg-gradient-to-r from-accent/50 to-transparent"></div>
                        @endif

                        <div class="relative text-center p-6">
                            <div class="group w-20 h-20 mx-auto mb-6 rounded-2xl bg-gradient-to-br from-accent/20 to-accent-2/20 flex items-center justify-center border border-white/10 hover:border-accent/30 transition-colors cursor-default">
                                <span class="text-3xl font-bold gradient-text">{{ $process['step'] }}</span>
                            </div>
                            <h3 class="text-xl font-bold font-display mb-3">{{ $process['title'] }}</h3>
                            <p class="text-text-muted">{{ $process['description'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-24">
        <div class="container">
            <div
                class="relative rounded-[2.5rem] overflow-hidden"
                x-data="{ visible: false }"
                x-intersect.once="visible = true"
                :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                style="transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);"
            >
                {{-- Background --}}
                <div class="absolute inset-0 bg-gradient-to-r from-accent/20 to-accent-2/20"></div>
                <div class="absolute inset-0" style="background-image: radial-gradient(circle at 1px 1px, rgba(255,255,255,0.05) 1px, transparent 0); background-size: 32px 32px;"></div>
                <div class="absolute -top-24 -left-24 w-64 h-64 bg-accent/30 rounded-full blur-3xl animate-pulse"></div>
                <div class="absolute -bottom-24 -right-24 w-64 h-64 bg-accent-2/30 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>

                {{-- Content --}}
                <div class="relative z-10 p-12 md:p-20 text-center">
                    <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold font-display mb-6">
                        Ready to Get <span class="gradient-text">Started</span>?
                    </h2>
                    <p class="text-text-muted text-lg md:text-xl mb-10 max-w-2xl mx-auto">
                        Let's discuss your project and see how we can help you achieve your business goals.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('contact.index') }}" class="group relative inline-flex items-center justify-center gap-2 px-8 py-4 overflow-hidden rounded-full font-semibold text-white transition-all duration-300">
                            <span class="absolute inset-0 bg-gradient-to-r from-accent to-accent-2"></span>
                            <span class="absolute inset-0 bg-gradient-to-r from-accent-2 to-accent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></span>
                            <span class="relative">Contact Us</span>
                            <svg class="relative w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                        <a href="{{ route('portfolio.index') }}" class="group inline-flex items-center justify-center gap-2 px-8 py-4 rounded-full font-semibold text-white border-2 border-white/20 hover:border-white/40 transition-colors">
                            View Portfolio
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
