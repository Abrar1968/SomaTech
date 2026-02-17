<x-layouts.app>
    @php
        $seoTitle = 'Our Portfolio';
        $seoDescription = 'Explore Somaticx\'s portfolio of web and mobile applications. See our best work and the results we\'ve achieved for our clients.';
    @endphp

    {{-- Breadcrumb --}}
    <div class="pt-32 pb-8">
        <div class="container">
            <x-breadcrumb :items="[
                ['label' => 'Home', 'url' => route('home')],
                ['label' => 'Portfolio'],
            ]" />
        </div>
    </div>

    {{-- Page Hero --}}
    <section class="pb-16">
        <div class="container">
            <div class="max-w-3xl">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold font-display mb-6">
                    Our <span class="gradient-text">Portfolio</span>
                </h1>
                <p class="text-xl text-[var(--color-text-muted)]">
                    Explore our latest projects and see how we've helped businesses achieve their digital goals.
                </p>
            </div>
        </div>
    </section>

    {{-- Filter Tabs - SRS FR-005 --}}
    <section class="pb-8" x-data="{ activeFilter: 'all' }">
        <div class="container">
            <div class="flex flex-wrap gap-4">
                <button
                    @click="activeFilter = 'all'"
                    :class="activeFilter === 'all' ? 'bg-[var(--color-accent)] text-white' : 'bg-[var(--color-bg-surface)] text-[var(--color-text-muted)] hover:text-white'"
                    class="px-6 py-3 rounded-full font-semibold transition-colors"
                >
                    All Projects
                </button>
                @foreach($categories ?? [] as $category)
                    <button
                        @click="activeFilter = '{{ $category->slug }}'"
                        :class="activeFilter === '{{ $category->slug }}' ? 'bg-[var(--color-accent)] text-white' : 'bg-[var(--color-bg-surface)] text-[var(--color-text-muted)] hover:text-white'"
                        class="px-6 py-3 rounded-full font-semibold transition-colors"
                    >
                        {{ $category->name }}
                    </button>
                @endforeach
                @if(!isset($categories) || count($categories) === 0)
                    @foreach(['Web Apps', 'Mobile Apps', 'E-Commerce', 'Corporate'] as $cat)
                        <button
                            @click="activeFilter = '{{ Str::slug($cat) }}'"
                            :class="activeFilter === '{{ Str::slug($cat) }}' ? 'bg-[var(--color-accent)] text-white' : 'bg-[var(--color-bg-surface)] text-[var(--color-text-muted)] hover:text-white'"
                            class="px-6 py-3 rounded-full font-semibold transition-colors"
                        >
                            {{ $cat }}
                        </button>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    {{-- Projects Grid --}}
    <section class="pb-24">
        <div class="container">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($projects ?? [] as $project)
                    <x-project-card :project="$project" />
                @empty
                    {{-- Placeholder projects --}}
                    @for($i = 1; $i <= 9; $i++)
                        <div class="group relative overflow-hidden rounded-xl border border-[var(--color-border)] bg-[var(--color-bg-surface)] hover:border-[var(--color-accent)] transition-all duration-300" data-gsap="fade-up">
                            <div class="aspect-video bg-gradient-to-br from-[var(--color-accent)] to-[var(--color-accent-2)] flex items-center justify-center">
                                <span class="text-4xl font-bold text-white/50">0{{ $i }}</span>
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-semibold mb-2">Project {{ $i }}</h3>
                                <p class="text-[var(--color-text-muted)] text-sm mb-4 line-clamp-2">
                                    A showcase of our development capabilities and attention to detail.
                                </p>
                                <div class="flex flex-wrap gap-2">
                                    @foreach(['Laravel', 'Vue.js', 'Tailwind'] as $tech)
                                        <span class="text-xs px-2 py-1 rounded bg-[var(--color-bg-elevated)] text-[var(--color-text-muted)]">{{ $tech }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endfor
                @endforelse
            </div>

            {{-- Pagination --}}
            @if(isset($projects) && $projects instanceof \Illuminate\Pagination\LengthAwarePaginator && $projects->hasPages())
                <div class="mt-12 flex justify-center">
                    {{ $projects->links() }}
                </div>
            @endif
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-24 bg-[var(--color-bg-surface)]">
        <div class="container">
            <div class="relative glass rounded-3xl p-12 md:p-16 text-center overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-r from-[var(--color-accent)]/20 to-[var(--color-accent-2)]/20"></div>
                <div class="relative z-10">
                    <h2 class="text-3xl md:text-4xl font-bold font-display mb-6">
                        Have a Project in <span class="gradient-text">Mind</span>?
                    </h2>
                    <p class="text-[var(--color-text-muted)] text-lg mb-8 max-w-2xl mx-auto">
                        Let's discuss how we can help bring your vision to life. We'd love to add your project to our portfolio.
                    </p>
                    <a href="{{ route('contact.index') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-[var(--color-accent)] to-[var(--color-accent-2)] text-white rounded-full font-semibold hover:scale-105 transition-transform">
                        Start Your Project
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
