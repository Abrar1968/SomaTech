<x-layouts.app>
    @php
        $seoTitle = 'Our Portfolio';
        $seoDescription = 'Explore Somaticx\'s portfolio of web and mobile applications. See our best work and the results we\'ve achieved for our clients.';
    @endphp

    {{-- Page Hero with Breadcrumb --}}
    <section class="relative pt-40 pb-24 overflow-hidden">
        {{-- Background elements --}}
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-20 right-0 w-[500px] h-[500px] bg-accent/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-accent-2/10 rounded-full blur-3xl"></div>
            <div class="absolute inset-0 opacity-30" style="background-image: radial-gradient(circle at 1px 1px, rgba(255,255,255,0.03) 1px, transparent 0); background-size: 40px 40px;"></div>
        </div>

        <div class="container relative">
            {{-- Breadcrumb --}}
            <x-breadcrumb :items="[
                ['label' => 'Home', 'url' => route('home')],
                ['label' => 'Portfolio'],
            ]" />

            <div class="max-w-4xl mt-8"
                x-data="{ visible: false }"
                x-intersect.once="visible = true"
                :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                style="transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);">
                
                {{-- Badge --}}
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/5 border border-white/10 mb-8">
                    <span class="w-2 h-2 rounded-full bg-accent animate-pulse"></span>
                    <span class="text-sm font-medium text-text-muted">Our Work</span>
                </div>

                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold font-display mb-6 leading-tight">
                    Our <span class="gradient-text">Portfolio</span>
                </h1>
                <p class="text-xl text-text-muted leading-relaxed max-w-2xl">
                    Explore our latest projects and see how we've helped businesses achieve their digital goals through innovative solutions.
                </p>
            </div>

            {{-- Stats Row --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-16 max-w-4xl">
                @foreach([
                    ['value' => '50+', 'label' => 'Projects Delivered'],
                    ['value' => '40+', 'label' => 'Happy Clients'],
                    ['value' => '5+', 'label' => 'Years Experience'],
                    ['value' => '99%', 'label' => 'Client Satisfaction'],
                ] as $index => $stat)
                    <div 
                        class="text-center p-6 rounded-2xl bg-white/5 border border-white/5"
                        x-data="{ visible: false }"
                        x-intersect.once="setTimeout(() => visible = true, {{ $index * 100 }})"
                        :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'"
                        style="transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);"
                    >
                        <div class="text-3xl font-bold gradient-text mb-1">{{ $stat['value'] }}</div>
                        <div class="text-sm text-text-muted">{{ $stat['label'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Filter Tabs - SRS FR-005 --}}
    <section class="pb-8 sticky top-20 z-40 bg-[var(--color-bg-primary)]/80 backdrop-blur-xl border-b border-white/5" x-data="{ activeFilter: 'all' }">
        <div class="container py-6">
            <div class="flex flex-wrap gap-3 justify-center">
                <button
                    @click="activeFilter = 'all'"
                    :class="activeFilter === 'all' 
                        ? 'bg-gradient-to-r from-accent to-accent-2 text-white shadow-lg shadow-accent/25' 
                        : 'bg-white/5 text-text-muted hover:text-white hover:bg-white/10 border border-white/10'"
                    class="px-6 py-3 rounded-full font-semibold transition-all duration-300"
                >
                    All Projects
                </button>
                @foreach($categories ?? [] as $category)
                    <button
                        @click="activeFilter = '{{ $category->slug }}'"
                        :class="activeFilter === '{{ $category->slug }}' 
                            ? 'bg-gradient-to-r from-accent to-accent-2 text-white shadow-lg shadow-accent/25' 
                            : 'bg-white/5 text-text-muted hover:text-white hover:bg-white/10 border border-white/10'"
                        class="px-6 py-3 rounded-full font-semibold transition-all duration-300"
                    >
                        {{ $category->name }}
                    </button>
                @endforeach
                @if(!isset($categories) || count($categories) === 0)
                    @foreach(['Web Apps', 'Mobile Apps', 'E-Commerce', 'Corporate'] as $cat)
                        <button
                            @click="activeFilter = '{{ Str::slug($cat) }}'"
                            :class="activeFilter === '{{ Str::slug($cat) }}' 
                                ? 'bg-gradient-to-r from-accent to-accent-2 text-white shadow-lg shadow-accent/25' 
                                : 'bg-white/5 text-text-muted hover:text-white hover:bg-white/10 border border-white/10'"
                            class="px-6 py-3 rounded-full font-semibold transition-all duration-300"
                        >
                            {{ $cat }}
                        </button>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    {{-- Projects Grid --}}
    <section class="py-16">
        <div class="container">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($projects ?? [] as $index => $project)
                    <x-project-card :project="$project" :index="$index" />
                @empty
                    {{-- Placeholder projects --}}
                    @for($i = 0; $i < 9; $i++)
                        <article 
                            class="group relative overflow-hidden rounded-3xl bg-[var(--color-bg-elevated)] border border-white/5 hover:border-accent/30 transition-all duration-500"
                            x-data="{ visible: false, hover: false }"
                            x-intersect.once="setTimeout(() => visible = true, {{ $i * 80 }})"
                            :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                            @mouseenter="hover = true"
                            @mouseleave="hover = false"
                            style="transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);"
                        >
                            {{-- Project Image --}}
                            <div class="relative aspect-[4/3] overflow-hidden">
                                <div class="w-full h-full bg-gradient-to-br from-accent/20 to-accent-2/20 flex items-center justify-center">
                                    <div class="absolute inset-0 opacity-30" style="background-image: radial-gradient(circle at 1px 1px, rgba(255,255,255,0.05) 1px, transparent 0); background-size: 24px 24px;"></div>
                                    <span class="text-7xl font-bold text-white/10 font-display">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                </div>
                                
                                {{-- Gradient overlay --}}
                                <div class="absolute inset-0 bg-gradient-to-t from-[var(--color-bg-primary)] via-transparent to-transparent opacity-80"></div>
                                
                                {{-- Hover overlay --}}
                                <div 
                                    class="absolute inset-0 bg-accent/20 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-500"
                                >
                                    <div class="flex gap-3">
                                        <span class="w-12 h-12 rounded-full bg-white/10 backdrop-blur-sm flex items-center justify-center border border-white/20 transform scale-0 group-hover:scale-100 transition-transform duration-500">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </span>
                                    </div>
                                </div>

                                {{-- Category tag --}}
                                <div class="absolute top-4 left-4">
                                    <span class="px-3 py-1 rounded-full text-xs font-medium bg-white/10 backdrop-blur-sm text-white border border-white/20">
                                        {{ ['Web App', 'Mobile App', 'E-Commerce'][$i % 3] }}
                                    </span>
                                </div>
                            </div>

                            {{-- Project Content --}}
                            <div class="p-6">
                                <h3 class="text-xl font-bold font-display mb-2 group-hover:text-accent transition-colors">
                                    <a href="#">Project {{ $i + 1 }}</a>
                                </h3>
                                <p class="text-text-muted text-sm mb-4 line-clamp-2 leading-relaxed">
                                    A showcase of our development capabilities, attention to detail, and commitment to quality.
                                </p>
                                
                                {{-- Tech Stack --}}
                                <div class="flex flex-wrap gap-2">
                                    @foreach(['Laravel', 'Vue.js', 'Tailwind'] as $tech)
                                        <span class="text-xs px-3 py-1.5 rounded-lg bg-white/5 text-text-muted border border-white/5">{{ $tech }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </article>
                    @endfor
                @endforelse
            </div>

            {{-- Pagination --}}
            @if(isset($projects) && $projects instanceof \Illuminate\Pagination\LengthAwarePaginator && $projects->hasPages())
                <div class="mt-16 flex justify-center">
                    {{ $projects->links() }}
                </div>
            @endif
        </div>
    </section>

    {{-- Featured Case Study Preview --}}
    <section class="py-24 bg-gradient-to-b from-[var(--color-bg-surface)] to-[var(--color-bg-primary)]">
        <div class="container">
            <x-section-heading
                badge="Case Study"
                title="Featured <span class='gradient-text'>Project</span>"
                subtitle="A deep dive into one of our most successful projects"
            />

            <div 
                class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center"
                x-data="{ visible: false }"
                x-intersect.once="visible = true"
            >
                {{-- Image --}}
                <div 
                    class="relative"
                    :class="visible ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-8'"
                    style="transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);"
                >
                    <div class="relative rounded-3xl overflow-hidden border border-white/10">
                        <div class="aspect-[4/3] bg-gradient-to-br from-accent/20 to-accent-2/20 flex items-center justify-center">
                            <div class="absolute inset-0 opacity-30" style="background-image: radial-gradient(circle at 1px 1px, rgba(255,255,255,0.05) 1px, transparent 0); background-size: 24px 24px;"></div>
                            <svg class="w-32 h-32 text-accent/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                    
                    {{-- Stats badge --}}
                    <div class="absolute -bottom-6 -right-6 bg-[var(--color-bg-elevated)] rounded-2xl border border-white/10 p-5 shadow-xl">
                        <div class="text-3xl font-bold gradient-text">+150%</div>
                        <div class="text-sm text-text-muted">Traffic Increase</div>
                    </div>
                </div>

                {{-- Content --}}
                <div
                    :class="visible ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-8'"
                    style="transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1) 0.2s;"
                >
                    <span class="text-accent text-sm font-semibold tracking-wider uppercase">E-Commerce Platform</span>
                    <h3 class="text-3xl md:text-4xl font-bold font-display mt-3 mb-6">Online Marketplace Redesign</h3>
                    <p class="text-text-muted text-lg leading-relaxed mb-8">
                        We transformed a struggling e-commerce platform into a thriving marketplace with modern design, 
                        improved UX, and optimized performance. The result was a 150% increase in traffic and 3x conversion rate improvement.
                    </p>

                    {{-- Results --}}
                    <div class="grid grid-cols-3 gap-6 mb-10">
                        @foreach([
                            ['value' => '150%', 'label' => 'More Traffic'],
                            ['value' => '3x', 'label' => 'Conversions'],
                            ['value' => '40%', 'label' => 'Faster Load'],
                        ] as $result)
                            <div class="text-center p-4 rounded-xl bg-white/5 border border-white/5">
                                <div class="text-2xl font-bold gradient-text">{{ $result['value'] }}</div>
                                <div class="text-xs text-text-muted mt-1">{{ $result['label'] }}</div>
                            </div>
                        @endforeach
                    </div>

                    <a href="#" class="group inline-flex items-center gap-2 text-white font-semibold">
                        <span class="relative">
                            View Case Study
                            <span class="absolute bottom-0 left-0 w-0 h-px bg-accent group-hover:w-full transition-all duration-300"></span>
                        </span>
                        <span class="flex items-center justify-center w-10 h-10 rounded-full bg-white/5 group-hover:bg-accent/20 transition-colors duration-300">
                            <svg class="w-5 h-5 text-accent transform group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </span>
                    </a>
                </div>
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
                        Have a Project in <span class="gradient-text">Mind</span>?
                    </h2>
                    <p class="text-text-muted text-lg md:text-xl mb-10 max-w-2xl mx-auto">
                        Let's discuss how we can help bring your vision to life. We'd love to add your project to our portfolio.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('contact.index') }}" class="group relative inline-flex items-center justify-center gap-2 px-8 py-4 overflow-hidden rounded-full font-semibold text-white transition-all duration-300">
                            <span class="absolute inset-0 bg-gradient-to-r from-accent to-accent-2"></span>
                            <span class="absolute inset-0 bg-gradient-to-r from-accent-2 to-accent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></span>
                            <span class="relative">Start Your Project</span>
                            <svg class="relative w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                        <a href="{{ route('services.index') }}" class="group inline-flex items-center justify-center gap-2 px-8 py-4 rounded-full font-semibold text-white border-2 border-white/20 hover:border-white/40 transition-colors">
                            View Our Services
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
