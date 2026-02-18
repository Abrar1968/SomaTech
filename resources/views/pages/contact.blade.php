<x-layouts.app>
    @php
        $seoTitle = 'Contact Us';
        $seoDescription = 'Get in touch with Somaticx for your web and app development needs. We\'d love to hear about your project.';
    @endphp

    {{-- Page Hero --}}
    <section class="relative pt-40 pb-24 overflow-hidden">
        {{-- Background elements --}}
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-20 left-0 w-[500px] h-[500px] bg-accent/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-0 w-[400px] h-[400px] bg-accent-2/10 rounded-full blur-3xl"></div>
            <div class="absolute inset-0 opacity-30" style="background-image: radial-gradient(circle at 1px 1px, rgba(255,255,255,0.03) 1px, transparent 0); background-size: 40px 40px;"></div>
        </div>

        <div class="container relative">
            <div class="max-w-4xl mx-auto text-center"
                x-data="{ visible: false }"
                x-intersect.once="visible = true"
                :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                style="transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);">

                {{-- Badge --}}
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/5 border border-white/10 mb-8">
                    <span class="w-2 h-2 rounded-full bg-accent animate-pulse"></span>
                    <span class="text-sm font-medium text-text-muted">Get In Touch</span>
                </div>

                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold font-display mb-6 leading-tight">
                    Let's <span class="gradient-text">Connect</span>
                </h1>
                <p class="text-xl text-text-muted leading-relaxed max-w-2xl mx-auto">
                    Have a project in mind? We'd love to hear about it. Fill out the form below and we'll get back to you within 24 hours.
                </p>
            </div>
        </div>
    </section>

    {{-- Contact Section - SRS FR-021 --}}
    <section class="pb-24">
        <div class="container">
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-16">
                {{-- Contact Info --}}
                <div
                    class="lg:col-span-2"
                    x-data="{ visible: false }"
                    x-intersect.once="visible = true"
                    :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                    style="transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);"
                >
                    <h2 class="text-2xl font-bold font-display mb-8">Get in Touch</h2>

                    <div class="space-y-6 mb-12">
                        @foreach([
                            ['icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'title' => 'Email Us', 'content' => 'hello@somaticx.com', 'link' => 'mailto:hello@somaticx.com'],
                            ['icon' => 'M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z', 'title' => 'Call Us', 'content' => '+1-555-SOMATICX', 'link' => null],
                            ['icon' => 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z', 'title' => 'Location', 'content' => 'Remote-first, Serving Clients Worldwide', 'link' => null],
                        ] as $index => $contact)
                            <div
                                class="group flex items-start gap-4 p-5 rounded-2xl bg-[var(--color-bg-elevated)] border border-white/5 hover:border-accent/20 transition-all duration-300"
                                x-data="{ show: false }"
                                x-intersect.once="setTimeout(() => show = true, {{ $index * 100 }})"
                                :class="show ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-4'"
                                style="transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);"
                            >
                                <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-accent/20 to-accent-2/20 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $contact['icon'] }}"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-lg mb-1">{{ $contact['title'] }}</h3>
                                    @if($contact['link'])
                                        <a href="{{ $contact['link'] }}" class="text-text-muted hover:text-accent transition-colors">
                                            {{ $contact['content'] }}
                                        </a>
                                    @else
                                        <p class="text-text-muted">{{ $contact['content'] }}</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Social Links --}}
                    <div>
                        <h3 class="font-semibold mb-4">Follow Us</h3>
                        <div class="flex gap-3">
                            @foreach([
                                ['name' => 'LinkedIn', 'icon' => 'M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z'],
                                ['name' => 'GitHub', 'icon' => 'M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z'],
                                ['name' => 'X', 'icon' => 'M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z'],
                                ['name' => 'Instagram', 'icon' => 'M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z'],
                            ] as $index => $social)
                                <a
                                    href="#"
                                    class="group w-12 h-12 rounded-xl bg-[var(--color-bg-elevated)] border border-white/10 flex items-center justify-center text-text-muted hover:text-accent hover:border-accent/30 hover:bg-accent/10 transition-all duration-300"
                                    aria-label="{{ $social['name'] }}"
                                >
                                    <svg class="w-5 h-5 transform group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="{{ $social['icon'] }}"/>
                                    </svg>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    {{-- Response Time Box --}}
                    <div class="mt-12 p-6 rounded-2xl bg-gradient-to-br from-accent/10 to-accent-2/10 border border-white/5">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center">
                                <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold">Average Response Time</p>
                                <p class="text-sm text-text-muted">Less than 24 hours</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Contact Form --}}
                <div
                    class="lg:col-span-3"
                    x-data="{ visible: false }"
                    x-intersect.once="setTimeout(() => visible = true, 200)"
                    :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                    style="transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);"
                >
                    <div class="relative rounded-3xl overflow-hidden bg-[var(--color-bg-elevated)] border border-white/5">
                        {{-- Decorative header --}}
                        <div class="h-2 bg-gradient-to-r from-accent to-accent-2"></div>

                        <div class="p-8 md:p-12">
                            <h2 class="text-2xl font-bold font-display mb-2">Send Us a Message</h2>
                            <p class="text-text-muted mb-8">Fill out the form and we'll get back to you shortly.</p>

                            <x-contact-form :services="$services ?? collect()" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- FAQ Section --}}
    <section class="py-24 bg-gradient-to-b from-[var(--color-bg-surface)] to-[var(--color-bg-primary)]">
        <div class="container">
            <x-section-heading
                badge="FAQ"
                title="Frequently Asked <span class='gradient-text'>Questions</span>"
                subtitle="Common questions about working with us"
            />

            <div class="max-w-3xl mx-auto space-y-4">
                @foreach([
                    ['question' => 'How long does a typical project take?', 'answer' => 'Project timelines vary based on complexity. A simple website takes 2-4 weeks, while complex web applications can take 2-6 months. We\'ll provide a detailed timeline during our initial consultation.'],
                    ['question' => 'What technologies do you specialize in?', 'answer' => 'We specialize in modern web technologies including Laravel, Vue.js, React, Tailwind CSS, and mobile development with Flutter. We choose the best tech stack based on your project requirements.'],
                    ['question' => 'Do you provide ongoing support after launch?', 'answer' => 'Yes! We offer various maintenance and support packages to keep your application running smoothly. This includes security updates, performance optimization, and feature enhancements.'],
                    ['question' => 'What is your pricing model?', 'answer' => 'We offer both fixed-price quotes for well-defined projects and hourly rates for ongoing work. After understanding your requirements, we\'ll recommend the best approach for your budget.'],
                    ['question' => 'Can you work with our existing team?', 'answer' => 'Absolutely! We often collaborate with in-house teams, providing additional expertise and resources. We integrate seamlessly with your existing workflows and communication tools.'],
                ] as $index => $faq)
                    <div
                        class="group"
                        x-data="{ open: false, visible: false }"
                        x-intersect.once="setTimeout(() => visible = true, {{ $index * 100 }})"
                        :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'"
                        style="transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);"
                    >
                        <button
                            @click="open = !open"
                            class="w-full flex items-center justify-between gap-4 p-6 rounded-2xl bg-[var(--color-bg-elevated)] border border-white/5 hover:border-accent/20 transition-colors text-left"
                            :class="open ? 'border-accent/30' : ''"
                        >
                            <span class="font-semibold text-lg">{{ $faq['question'] }}</span>
                            <span class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center flex-shrink-0 transition-transform duration-300" :class="open ? 'rotate-180' : ''">
                                <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </span>
                        </button>
                        <div
                            x-show="open"
                            x-collapse
                            class="px-6 pb-6"
                        >
                            <p class="text-text-muted leading-relaxed pt-4">{{ $faq['answer'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Map or Availability Section --}}
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
                <div class="relative z-10 p-12 md:p-20">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                        @foreach([
                            ['emoji' => '🌍', 'title' => 'Global Reach', 'description' => 'Serving clients across 6 continents'],
                            ['emoji' => '⏰', 'title' => 'Flexible Hours', 'description' => 'Available across multiple time zones'],
                            ['emoji' => '💬', 'title' => 'Quick Response', 'description' => 'Reply within 24 business hours'],
                        ] as $feature)
                            <div>
                                <div class="text-5xl mb-4">{{ $feature['emoji'] }}</div>
                                <h3 class="text-xl font-bold font-display mb-2">{{ $feature['title'] }}</h3>
                                <p class="text-text-muted">{{ $feature['description'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
