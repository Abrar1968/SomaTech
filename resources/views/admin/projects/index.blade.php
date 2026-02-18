<x-layouts.admin title="Projects">
    <div class="space-y-6" x-data="{ deleteModal: false, deleteId: null, deleteName: '' }">
        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold font-display">Projects</h1>
                <p class="text-text-muted mt-1">Manage your portfolio projects</p>
            </div>
            <a href="{{ route('admin.projects.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-accent to-accent-2 text-white rounded-xl font-semibold hover:shadow-lg hover:shadow-accent/25 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v16m8-8H4"></path>
                </svg>
                Add Project
            </a>
        </div>

        {{-- Filters --}}
        <div class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-4">
            <form method="GET" class="flex flex-col sm:flex-row gap-4">
                <div class="flex-1">
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search projects..."
                        class="w-full px-4 py-2.5 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors"
                    >
                </div>
                <select name="status" class="px-4 py-2.5 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors">
                    <option value="">All Status</option>
                    <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Published</option>
                    <option value="featured" {{ request('status') === 'featured' ? 'selected' : '' }}>Featured</option>
                </select>
                <button type="submit" class="px-5 py-2.5 bg-white/5 border border-white/10 rounded-xl hover:bg-white/10 transition-colors font-medium">
                    Filter
                </button>
            </form>
        </div>

        {{-- Table --}}
        <div class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-white/5">
                            <th class="text-left px-6 py-4 text-sm font-semibold text-text-muted">Project</th>
                            <th class="text-left px-6 py-4 text-sm font-semibold text-text-muted hidden md:table-cell">Category</th>
                            <th class="text-left px-6 py-4 text-sm font-semibold text-text-muted">Status</th>
                            <th class="text-left px-6 py-4 text-sm font-semibold text-text-muted hidden lg:table-cell">Created</th>
                            <th class="text-right px-6 py-4 text-sm font-semibold text-text-muted">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse($projects as $project)
                            <tr class="hover:bg-white/5 transition-colors {{ $project->trashed() ? 'opacity-50' : '' }}">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        @if($project->thumbnail)
                                            <img src="{{ Storage::url($project->thumbnail) }}" alt="{{ $project->title }}" class="w-12 h-12 rounded-xl object-cover ring-2 ring-white/5">
                                        @else
                                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-accent/20 to-accent-2/20 flex items-center justify-center">
                                                <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                        @endif
                                        <div>
                                            <p class="font-semibold">{{ $project->title }}</p>
                                            <p class="text-sm text-text-muted">{{ Str::limit($project->short_description, 50) }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 hidden md:table-cell">
                                    <span class="px-2.5 py-1 text-xs rounded-full bg-white/5 text-text-muted">
                                        {{ $project->category->name ?? 'Uncategorized' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $statusStyles = [
                                            'draft' => 'bg-gray-500/10 text-gray-400 border-gray-500/20',
                                            'published' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20',
                                            'featured' => 'bg-amber-500/10 text-amber-400 border-amber-500/20',
                                        ];
                                    @endphp
                                    <span class="px-2.5 py-1 text-xs rounded-full border {{ $statusStyles[$project->status] ?? $statusStyles['draft'] }}">
                                        {{ ucfirst($project->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-text-muted hidden lg:table-cell">
                                    {{ $project->created_at->format('M j, Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end gap-2">
                                        @if($project->trashed())
                                            <form action="{{ route('admin.projects.restore', $project->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="p-2 rounded-lg hover:bg-emerald-500/10 text-text-muted hover:text-emerald-400 transition-colors" title="Restore">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        @else
                                            <a href="{{ route('portfolio.show', $project->slug) }}" target="_blank" class="p-2 rounded-lg hover:bg-white/5 text-text-muted hover:text-white transition-colors" title="View">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                                </svg>
                                            </a>
                                            <a href="{{ route('admin.projects.edit', $project) }}" class="p-2 rounded-lg hover:bg-accent/10 text-text-muted hover:text-accent transition-colors" title="Edit">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                            </a>
                                            <button
                                                @click="deleteModal = true; deleteId = {{ $project->id }}; deleteName = '{{ addslashes($project->title) }}'"
                                                class="p-2 rounded-lg hover:bg-red-500/10 text-text-muted hover:text-red-400 transition-colors"
                                                title="Delete"
                                            >
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="w-16 h-16 rounded-2xl bg-white/5 flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-8 h-8 text-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                        </svg>
                                    </div>
                                    <p class="text-text-muted mb-2">No projects found</p>
                                    <a href="{{ route('admin.projects.create') }}" class="text-accent hover:text-accent-2 transition-colors">Create your first project</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($projects->hasPages())
                <div class="px-6 py-4 border-t border-white/5">
                    {{ $projects->links() }}
                </div>
            @endif
        </div>

        {{-- Delete Modal --}}
        <div
            x-show="deleteModal"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center p-4"
            x-cloak
        >
            <div
                @click.outside="deleteModal = false"
                x-show="deleteModal"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-6 max-w-md w-full"
            >
                <div class="w-12 h-12 rounded-xl bg-red-500/10 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-center mb-2">Delete Project</h3>
                <p class="text-text-muted text-center mb-6">Are you sure you want to delete "<span x-text="deleteName" class="text-white"></span>"? This action can be undone from trash.</p>
                <div class="flex gap-3">
                    <button @click="deleteModal = false" class="flex-1 px-4 py-2.5 bg-white/5 border border-white/10 rounded-xl hover:bg-white/10 transition-colors font-medium">
                        Cancel
                    </button>
                    <form :action="'/admin/projects/' + deleteId" method="POST" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full px-4 py-2.5 bg-red-500/10 border border-red-500/20 text-red-400 rounded-xl hover:bg-red-500/20 transition-colors font-medium">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>
