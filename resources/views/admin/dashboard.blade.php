<x-layouts.admin title="Dashboard">
    <div class="space-y-8" x-data="{ loaded: false }" x-init="setTimeout(() => loaded = true, 100)">
        {{-- Page Header --}}
        <div
            class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4"
            :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'"
            style="transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);"
        >
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold font-display">
                    @php
                        $hour = now()->hour;
                        $greeting = match(true) {
                            $hour < 12 => 'Good Morning',
                            $hour < 17 => 'Good Afternoon',
                            default => 'Good Evening'
                        };
                    @endphp
                    {{ $greeting }}, {{ Auth::user()->name ?? 'Admin' }}! 👋
                </h1>
                <p class="text-text-muted mt-1">Here's what's happening with your site today.</p>
            </div>
            <div class="flex items-center gap-3">
                <span class="px-3 py-1.5 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-sm flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    All Systems Operational
                </span>
            </div>
        </div>

        {{-- Stats Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6">
            @foreach([
                ['label' => 'Total Projects', 'value' => $stats['projects'] ?? 0, 'icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10', 'gradient' => 'from-blue-500 to-indigo-600', 'bg' => 'bg-blue-500/10', 'text' => 'text-blue-400'],
                ['label' => 'Active Services', 'value' => $stats['services'] ?? 0, 'icon' => 'M13 10V3L4 14h7v7l9-11h-7z', 'gradient' => 'from-emerald-500 to-teal-600', 'bg' => 'bg-emerald-500/10', 'text' => 'text-emerald-400'],
                ['label' => 'New Inquiries', 'value' => $stats['inquiries'] ?? 0, 'icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'gradient' => 'from-amber-500 to-orange-600', 'bg' => 'bg-amber-500/10', 'text' => 'text-amber-400'],
                ['label' => 'Testimonials', 'value' => $stats['testimonials'] ?? 0, 'icon' => 'M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z', 'gradient' => 'from-purple-500 to-pink-600', 'bg' => 'bg-purple-500/10', 'text' => 'text-purple-400'],
            ] as $index => $stat)
                <div
                    class="group relative bg-[var(--color-bg-surface)] rounded-2xl p-6 border border-white/5 hover:border-white/10 transition-all duration-500 overflow-hidden"
                    :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                    style="transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1) {{ ($index + 1) * 100 }}ms;"
                >
                    {{-- Background glow --}}
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br {{ $stat['gradient'] }} opacity-0 group-hover:opacity-10 rounded-full blur-2xl -translate-y-1/2 translate-x-1/2 transition-opacity duration-500"></div>

                    <div class="relative flex items-start justify-between">
                        <div>
                            <p class="text-text-muted text-sm font-medium">{{ $stat['label'] }}</p>
                            <p class="text-3xl lg:text-4xl font-bold mt-2 font-display">{{ $stat['value'] }}</p>
                        </div>
                        <div class="w-12 h-12 rounded-xl {{ $stat['bg'] }} flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 {{ $stat['text'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $stat['icon'] }}"></path>
                            </svg>
                        </div>
                    </div>

                    {{-- Decorative line --}}
                    <div class="absolute bottom-0 left-0 right-0 h-0.5 bg-gradient-to-r {{ $stat['gradient'] }} opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>
            @endforeach
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8">
            {{-- Recent Inquiries --}}
            <div
                class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 overflow-hidden"
                :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                style="transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1) 0.5s;"
            >
                <div class="p-6 border-b border-white/5 flex justify-between items-center">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-amber-500/10 flex items-center justify-center">
                            <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h2 class="text-lg font-semibold">Recent Inquiries</h2>
                    </div>
                    <a href="{{ route('admin.inquiries.index') }}" class="text-sm text-accent hover:text-accent-2 transition-colors flex items-center gap-1 group">
                        View All
                        <svg class="w-4 h-4 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
                <div class="divide-y divide-white/5">
                    @forelse($recentInquiries ?? [] as $inquiry)
                        <a href="{{ route('admin.inquiries.show', $inquiry) }}" class="block p-4 hover:bg-white/5 transition-colors group">
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-accent/20 to-accent-2/20 flex items-center justify-center flex-shrink-0 font-semibold text-accent">
                                    {{ strtoupper(substr($inquiry->name, 0, 1)) }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between mb-1">
                                        <p class="font-semibold group-hover:text-accent transition-colors">{{ $inquiry->name }}</p>
                                        <span class="text-xs text-text-muted">{{ $inquiry->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-sm text-text-muted line-clamp-1">{{ $inquiry->message }}</p>
                                    @if(!$inquiry->is_read)
                                        <span class="inline-flex items-center gap-1 mt-2 px-2 py-0.5 text-xs bg-accent/20 text-accent rounded-full">
                                            <span class="w-1.5 h-1.5 rounded-full bg-accent"></span>
                                            New
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="p-8 text-center">
                            <div class="w-16 h-16 rounded-2xl bg-white/5 flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <p class="text-text-muted">No inquiries yet</p>
                            <p class="text-sm text-text-muted/60 mt-1">New messages will appear here</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Recent Projects --}}
            <div
                class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 overflow-hidden"
                :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                style="transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1) 0.6s;"
            >
                <div class="p-6 border-b border-white/5 flex justify-between items-center">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-blue-500/10 flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                        </div>
                        <h2 class="text-lg font-semibold">Recent Projects</h2>
                    </div>
                    <a href="{{ route('admin.projects.index') }}" class="text-sm text-accent hover:text-accent-2 transition-colors flex items-center gap-1 group">
                        View All
                        <svg class="w-4 h-4 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
                <div class="divide-y divide-white/5">
                    @forelse($recentProjects ?? [] as $project)
                        <a href="{{ route('admin.projects.edit', $project) }}" class="block p-4 hover:bg-white/5 transition-colors group">
                            <div class="flex items-center gap-4">
                                @if($project->featured_image)
                                    <img src="{{ Storage::url($project->featured_image) }}" alt="{{ $project->title }}" class="w-14 h-14 rounded-xl object-cover ring-2 ring-white/5 group-hover:ring-accent/30 transition-all">
                                @else
                                    <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-accent/20 to-accent-2/20 flex items-center justify-center ring-2 ring-white/5 group-hover:ring-accent/30 transition-all">
                                        <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif
                                <div class="flex-1 min-w-0">
                                    <p class="font-semibold truncate group-hover:text-accent transition-colors">{{ $project->title }}</p>
                                    <p class="text-sm text-text-muted">{{ $project->service->title ?? 'No Service' }}</p>
                                </div>
                                @if($project->is_featured)
                                    <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                                        Featured
                                    </span>
                                @endif
                            </div>
                        </a>
                    @empty
                        <div class="p-8 text-center">
                            <div class="w-16 h-16 rounded-2xl bg-white/5 flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                            </div>
                            <p class="text-text-muted">No projects yet</p>
                            <a href="{{ route('admin.projects.create') }}" class="inline-flex items-center gap-1 text-sm text-accent hover:text-accent-2 transition-colors mt-2">
                                Create your first project
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Quick Actions --}}
        <div
            class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-6"
            :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
            style="transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1) 0.7s;"
        >
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-xl bg-accent/10 flex items-center justify-center">
                    <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h2 class="text-lg font-semibold">Quick Actions</h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach([
                    ['route' => 'admin.projects.create', 'label' => 'New Project', 'icon' => 'M12 4v16m8-8H4', 'primary' => true],
                    ['route' => 'admin.services.create', 'label' => 'New Service', 'icon' => 'M12 4v16m8-8H4', 'primary' => false],
                    ['route' => 'admin.team.create', 'label' => 'Add Team Member', 'icon' => 'M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z', 'primary' => false],
                    ['route' => 'admin.testimonials.create', 'label' => 'Add Testimonial', 'icon' => 'M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z', 'primary' => false],
                ] as $action)
                    <a
                        href="{{ route($action['route']) }}"
                        class="group relative flex items-center gap-3 p-4 rounded-xl {{ $action['primary'] ? 'bg-gradient-to-r from-accent to-accent-2 text-white' : 'bg-white/5 hover:bg-white/10 border border-white/5 hover:border-white/10' }} transition-all duration-300 overflow-hidden"
                    >
                        @if($action['primary'])
                            <div class="absolute inset-0 bg-gradient-to-r from-accent-2 to-accent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        @endif
                        <div class="relative w-10 h-10 rounded-lg {{ $action['primary'] ? 'bg-white/20' : 'bg-accent/10' }} flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-5 h-5 {{ $action['primary'] ? 'text-white' : 'text-accent' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $action['icon'] }}"></path>
                            </svg>
                        </div>
                        <span class="relative font-medium">{{ $action['label'] }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</x-layouts.admin>
