<x-layouts.admin>
    @php
        $pageTitle = 'Dashboard';
    @endphp

    <div class="space-y-8">
        {{-- Page Header --}}
        <div>
            <h1 class="text-3xl font-bold font-display">Dashboard</h1>
            <p class="text-[var(--color-text-muted)] mt-1">Welcome back! Here's what's happening with your site.</p>
        </div>

        {{-- Stats Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach([
                ['label' => 'Total Projects', 'value' => $stats['projects'] ?? 0, 'icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10', 'color' => 'from-blue-500 to-blue-600'],
                ['label' => 'Active Services', 'value' => $stats['services'] ?? 0, 'icon' => 'M13 10V3L4 14h7v7l9-11h-7z', 'color' => 'from-green-500 to-green-600'],
                ['label' => 'New Inquiries', 'value' => $stats['inquiries'] ?? 0, 'icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'color' => 'from-yellow-500 to-orange-500'],
                ['label' => 'Testimonials', 'value' => $stats['testimonials'] ?? 0, 'icon' => 'M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z', 'color' => 'from-purple-500 to-purple-600'],
            ] as $stat)
                <div class="bg-[var(--color-bg-surface)] rounded-xl p-6 border border-[var(--color-border)]">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-[var(--color-text-muted)] text-sm">{{ $stat['label'] }}</p>
                            <p class="text-3xl font-bold mt-1">{{ $stat['value'] }}</p>
                        </div>
                        <div class="w-12 h-12 rounded-lg bg-gradient-to-br {{ $stat['color'] }} flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $stat['icon'] }}"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            {{-- Recent Inquiries --}}
            <div class="bg-[var(--color-bg-surface)] rounded-xl border border-[var(--color-border)]">
                <div class="p-6 border-b border-[var(--color-border)] flex justify-between items-center">
                    <h2 class="text-lg font-semibold">Recent Inquiries</h2>
                    <a href="{{ route('admin.inquiries.index') }}" class="text-sm text-[var(--color-accent)] hover:underline">View All</a>
                </div>
                <div class="divide-y divide-[var(--color-border)]">
                    @forelse($recentInquiries ?? [] as $inquiry)
                        <div class="p-4 hover:bg-[var(--color-bg-elevated)] transition-colors">
                            <div class="flex items-center justify-between mb-2">
                                <p class="font-semibold">{{ $inquiry->name }}</p>
                                <span class="text-xs text-[var(--color-text-muted)]">{{ $inquiry->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-sm text-[var(--color-text-muted)] line-clamp-1">{{ $inquiry->message }}</p>
                        </div>
                    @empty
                        <div class="p-8 text-center text-[var(--color-text-muted)]">
                            <svg class="w-12 h-12 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <p>No inquiries yet</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Recent Projects --}}
            <div class="bg-[var(--color-bg-surface)] rounded-xl border border-[var(--color-border)]">
                <div class="p-6 border-b border-[var(--color-border)] flex justify-between items-center">
                    <h2 class="text-lg font-semibold">Recent Projects</h2>
                    <a href="{{ route('admin.projects.index') }}" class="text-sm text-[var(--color-accent)] hover:underline">View All</a>
                </div>
                <div class="divide-y divide-[var(--color-border)]">
                    @forelse($recentProjects ?? [] as $project)
                        <div class="p-4 hover:bg-[var(--color-bg-elevated)] transition-colors">
                            <div class="flex items-center gap-4">
                                @if($project->featured_image)
                                    <img src="{{ Storage::url($project->featured_image) }}" alt="{{ $project->title }}" class="w-12 h-12 rounded-lg object-cover">
                                @else
                                    <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-[var(--color-accent)] to-[var(--color-accent-2)]"></div>
                                @endif
                                <div class="flex-1 min-w-0">
                                    <p class="font-semibold truncate">{{ $project->title }}</p>
                                    <p class="text-sm text-[var(--color-text-muted)]">{{ $project->service->title ?? 'No Service' }}</p>
                                </div>
                                <span class="px-2 py-1 text-xs rounded-full {{ $project->is_featured ? 'bg-green-500/20 text-green-400' : 'bg-gray-500/20 text-gray-400' }}">
                                    {{ $project->is_featured ? 'Featured' : 'Standard' }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="p-8 text-center text-[var(--color-text-muted)]">
                            <svg class="w-12 h-12 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                            <p>No projects yet</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="bg-[var(--color-bg-surface)] rounded-xl border border-[var(--color-border)] p-6">
            <h2 class="text-lg font-semibold mb-4">Quick Actions</h2>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('admin.projects.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-[var(--color-accent)] to-[var(--color-accent-2)] text-white rounded-lg font-semibold hover:scale-105 transition-transform">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    New Project
                </a>
                <a href="{{ route('admin.services.create') }}" class="inline-flex items-center gap-2 px-4 py-2 border border-[var(--color-border)] text-white rounded-lg font-semibold hover:bg-[var(--color-bg-elevated)] transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    New Service
                </a>
                <a href="{{ route('admin.team.create') }}" class="inline-flex items-center gap-2 px-4 py-2 border border-[var(--color-border)] text-white rounded-lg font-semibold hover:bg-[var(--color-bg-elevated)] transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                    Add Team Member
                </a>
                <a href="{{ route('admin.testimonials.create') }}" class="inline-flex items-center gap-2 px-4 py-2 border border-[var(--color-border)] text-white rounded-lg font-semibold hover:bg-[var(--color-bg-elevated)] transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    Add Testimonial
                </a>
            </div>
        </div>
    </div>
</x-layouts.admin>
