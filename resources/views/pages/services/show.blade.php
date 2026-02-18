<x-layouts.app>
    @php
        $seoTitle = $service->title ?? 'Service';
        $seoDescription = $service->short_description ?? 'Learn more about our professional service offerings.';
    @endphp

    {{-- Page Hero --}}
    <section class="relative pt-40 pb-24 overflow-hidden">
        {{-- Background elements --}}
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-20 left-0 w-[600px] h-[600px] bg-accent/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-accent-2/10 rounded-full blur-3xl"></div>
            <div class="absolute inset-0 opacity-30" style="background-image: radial-gradient(circle at 1px 1px, rgba(255,255,255,0.03) 1px, transparent 0); background-size: 40px 40px;"></div>
        </div>

        <div class="container relative">
            {{-- Breadcrumb --}}
            <x-breadcrumb :items="[
                ['label' => 'Home', 'url' => route('home')],
                ['label' => 'Services', 'url' => route('services.index')],
                ['label' => $service->title ?? 'Service'],
            ]" />

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center mt-12">
                {{-- Content --}}
                <div
                    x-data="{ visible: false }"
                    x-intersect.once="visible = true"
                    :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                    style="transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);"
                >
                    {{-- Service Icon --}}
                    <div class="relative w-20 h-20 mb-8">
                        <div class="absolute inset-0 bg-gradient-to-br from-accent to-accent-2 rounded-2xl rotate-6 opacity-50"></div>
                        <div class="relative w-full h-full bg-[var(--color-bg-elevated)] rounded-2xl border border-white/10 flex items-center justify-center">
                            @if(isset($service->icon_svg))
                                <div class="w-10 h-10 text-accent">{!! $service->icon_svg !!}</div>
                            @else
                                <svg class="w-10 h-10 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            @endif
                        </div>
                    </div>

                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold font-display mb-4 leading-tight">
                        {{ $service->title ?? 'Service Title' }}
                    </h1>
                    <p class="text-xl gradient-text font-medium mb-6">{{ $service->tagline ?? 'Expert digital solutions' }}</p>
                    <p class="text-lg text-text-muted mb-10 leading-relaxed">
                        {{ $service->short_description ?? 'We provide professional services to help your business succeed in the digital world.' }}
                    </p>

                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('contact.index') }}?service={{ $service->slug ?? '' }}" class="group relative inline-flex items-center gap-2 px-8 py-4 overflow-hidden rounded-full font-semibold text-white transition-all duration-300">
                            <span class="absolute inset-0 bg-gradient-to-r from-accent to-accent-2"></span>
                            <span class="absolute inset-0 bg-gradient-to-r from-accent-2 to-accent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></span>
                            <span class="relative">Request This Service</span>
                            <svg class="relative w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                        <a href="#features" class="inline-flex items-center gap-2 px-8 py-4 rounded-full font-semibold text-white border-2 border-white/20 hover:border-white/40 transition-colors">
                            Learn More
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                {{-- Featured Image --}}
                <div
                    class="relative"
                    x-data="{ visible: false }"
                    x-intersect.once="setTimeout(() => visible = true, 200)"
                    :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                    style="transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);"
                >
                    <div class="relative rounded-3xl overflow-hidden border border-white/10">
                        @if(isset($service->featured_image) && $service->featured_image)
                            <img
                                src="{{ Storage::url($service->featured_image) }}"
                                alt="{{ $service->title ?? 'Service' }}"
                                class="w-full aspect-[4/3] object-cover"
                            >
                        @else
                            <div class="aspect-[4/3] bg-gradient-to-br from-accent/20 to-accent-2/20 flex items-center justify-center">
                                <div class="absolute inset-0 opacity-30" style="background-image: radial-gradient(circle at 1px 1px, rgba(255,255,255,0.05) 1px, transparent 0); background-size: 24px 24px;"></div>
                                <svg class="w-24 h-24 text-accent/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif

                        {{-- Decorative corner --}}
                        <div class="absolute -bottom-px -right-px w-24 h-24">
                            <div class="absolute inset-0 bg-gradient-to-tl from-accent/20 to-transparent"></div>
                        </div>
                    </div>

                    {{-- Floating stat badges --}}
                    <div class="absolute -bottom-6 -left-6 bg-[var(--color-bg-elevated)] rounded-2xl border border-white/10 p-4 shadow-xl">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-xl bg-accent/20 flex items-center justify-center">
                                <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-text-muted">Timeline</p>
                                <p class="font-semibold">{{ $service->timeline ?? '2-4 weeks' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Service Content --}}
    <section id="features" class="py-24 bg-gradient-to-b from-[var(--color-bg-surface)] to-[var(--color-bg-primary)]">
        <div class="container">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-16">
                {{-- Main Content --}}
                <div class="lg:col-span-2">
                    <div
                        x-data="{ visible: false }"
                        x-intersect.once="visible = true"
                        :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                        style="transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);"
                    >
                        <h2 class="text-3xl font-bold font-display mb-8">About This Service</h2>
                        <div class="prose prose-invert prose-lg max-w-none prose-p:text-text-muted prose-headings:font-display">
                            {!! $service->full_description ?? '<p>Our comprehensive service offering includes everything you need to succeed in the digital landscape. We work closely with you to understand your unique requirements and deliver solutions that exceed expectations.</p>' !!}
                        </div>
                    </div>

                    {{-- Features List --}}
                    @if(isset($service->features) && is_array($service->features))
                        <div class="mt-16">
                            <h2 class="text-2xl font-bold font-display mb-8">What's Included</h2>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                @foreach($service->features as $index => $feature)
                                    <div
                                        class="group flex items-start gap-4 p-5 rounded-2xl bg-[var(--color-bg-elevated)] border border-white/5 hover:border-accent/20 transition-colors"
                                        x-data="{ visible: false }"
                                        x-intersect.once="setTimeout(() => visible = true, {{ $index * 50 }})"
                                        :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'"
                                        style="transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);"
                                    >
                                        <div class="w-10 h-10 rounded-xl bg-accent/20 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                                            <svg class="w-5 h-5 text-accent" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <span class="text-white/90 leading-relaxed">{{ $feature }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        {{-- Default features when none provided --}}
                        <div class="mt-16">
                            <h2 class="text-2xl font-bold font-display mb-8">What's Included</h2>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                @foreach([
                                    'Custom design & development',
                                    'Mobile-responsive layouts',
                                    'SEO optimization',
                                    'Performance tuning',
                                    'Security best practices',
                                    'Post-launch support',
                                ] as $index => $feature)
                                    <div
                                        class="group flex items-start gap-4 p-5 rounded-2xl bg-[var(--color-bg-elevated)] border border-white/5 hover:border-accent/20 transition-colors"
                                        x-data="{ visible: false }"
                                        x-intersect.once="setTimeout(() => visible = true, {{ $index * 50 }})"
                                        :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'"
                                        style="transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);"
                                    >
                                        <div class="w-10 h-10 rounded-xl bg-accent/20 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                                            <svg class="w-5 h-5 text-accent" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <span class="text-white/90 leading-relaxed">{{ $feature }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Sidebar --}}
                <div class="space-y-8">
                    {{-- Quick Info Box --}}
                    <div
                        class="sticky top-32 space-y-8"
                        x-data="{ visible: false }"
                        x-intersect.once="visible = true"
                        :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                        style="transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1) 0.2s;"
                    >
                        <div class="relative rounded-3xl overflow-hidden bg-[var(--color-bg-elevated)] border border-white/5">
                            {{-- Decorative header --}}
                            <div class="h-2 bg-gradient-to-r from-accent to-accent-2"></div>

                            <div class="p-8">
                                <h3 class="text-xl font-bold font-display mb-6">Service Details</h3>
                                <dl class="space-y-6">
                                    <div class="flex items-start gap-4">
                                        <div class="w-10 h-10 rounded-xl bg-accent/10 flex items-center justify-center flex-shrink-0">
                                            <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <dt class="text-text-muted text-sm">Timeline</dt>
                                            <dd class="font-semibold text-lg">{{ $service->timeline ?? '2-4 weeks' }}</dd>
                                        </div>
                                    </div>
                                    <div class="flex items-start gap-4">
                                        <div class="w-10 h-10 rounded-xl bg-accent/10 flex items-center justify-center flex-shrink-0">
                                            <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <dt class="text-text-muted text-sm">Starting From</dt>
                                            <dd class="font-bold text-lg gradient-text">{{ $service->price_range ?? 'Contact for Quote' }}</dd>
                                        </div>
                                    </div>
                                    <div class="flex items-start gap-4">
                                        <div class="w-10 h-10 rounded-xl bg-accent/10 flex items-center justify-center flex-shrink-0">
                                            <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <dt class="text-text-muted text-sm">Support</dt>
                                            <dd class="font-semibold text-lg">{{ $service->support ?? 'Ongoing Maintenance' }}</dd>
                                        </div>
                                    </div>
                                </dl>
                            </div>
                        </div>

                        {{-- CTA Box --}}
                        <div class="relative rounded-3xl overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-br from-accent/20 to-accent-2/20"></div>
                            <div class="absolute inset-0" style="background-image: radial-gradient(circle at 1px 1px, rgba(255,255,255,0.05) 1px, transparent 0); background-size: 20px 20px;"></div>

                            <div class="relative p-8">
                                <h3 class="text-xl font-bold font-display mb-3">Ready to Start?</h3>
                                <p class="text-text-muted mb-6">Let's discuss how this service can transform your business.</p>
                                <a href="{{ route('contact.index') }}?service={{ $service->slug ?? '' }}" class="group block w-full relative overflow-hidden rounded-xl font-semibold text-center py-4">
                                    <span class="absolute inset-0 bg-gradient-to-r from-accent to-accent-2"></span>
                                    <span class="absolute inset-0 bg-gradient-to-r from-accent-2 to-accent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></span>
                                    <span class="relative text-white">Get a Free Quote</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Related Projects --}}
    @if(isset($relatedProjects) && $relatedProjects->count() > 0)
        <section class="py-24">
            <div class="container">
                <x-section-heading
                    badge="Our Work"
                    title="Related <span class='gradient-text'>Projects</span>"
                    subtitle="See how we've helped other clients with similar services"
                />

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($relatedProjects as $index => $project)
                        <x-project-card :project="$project" :index="$index" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Other Services --}}
    <section class="py-24 bg-gradient-to-b from-[var(--color-bg-primary)] to-[var(--color-bg-surface)]">
        <div class="container">
            <x-section-heading
                badge="Explore More"
                title="Other <span class='gradient-text'>Services</span>"
                subtitle="Discover our full range of digital solutions"
            />

            <div class="flex flex-wrap justify-center gap-4">
                @foreach([
                    ['title' => 'Website Development', 'icon' => 'M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4'],
                    ['title' => 'Mobile App Development', 'icon' => 'M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z'],
                    ['title' => 'E-Commerce Solutions', 'icon' => 'M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z'],
                    ['title' => 'Website Maintenance', 'icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z'],
                ] as $index => $otherService)
                    <a
                        href="{{ route('services.index') }}"
                        class="group flex items-center gap-3 px-6 py-4 rounded-2xl bg-[var(--color-bg-elevated)] border border-white/5 hover:border-accent/30 transition-all duration-300"
                        x-data="{ visible: false }"
                        x-intersect.once="setTimeout(() => visible = true, {{ $index * 100 }})"
                        :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'"
                        style="transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);"
                    >
                        <div class="w-10 h-10 rounded-xl bg-accent/10 flex items-center justify-center group-hover:bg-accent/20 transition-colors">
                            <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $otherService['icon'] }}"></path>
                            </svg>
                        </div>
                        <span class="font-medium group-hover:text-accent transition-colors">{{ $otherService['title'] }}</span>
                    </a>
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
                        Contact us today for a free consultation and let's bring your project to life.
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
                            View Our Work
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
