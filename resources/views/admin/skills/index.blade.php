<x-layouts.admin title="Skills">
    <div class="space-y-6">
        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold font-display">Skills</h1>
                <p class="text-text-muted mt-1">Manage your technical skills and proficiency levels</p>
            </div>
            <a href="{{ route('admin.skills.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-accent to-accent-2 text-white rounded-xl font-semibold hover:shadow-lg hover:shadow-accent/25 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Add Skill
            </a>
        </div>

        {{-- Category Filter --}}
        <div class="flex flex-wrap gap-2">
            @php $categories = $skills->pluck('category')->unique()->filter()->values(); @endphp
            <a href="{{ route('admin.skills.index') }}" class="px-4 py-2 rounded-xl text-sm font-medium transition-colors {{ !request('category') ? 'bg-accent text-white' : 'bg-white/5 hover:bg-white/10' }}">
                All
            </a>
            @foreach($categories as $cat)
                <a href="{{ route('admin.skills.index', ['category' => $cat]) }}" class="px-4 py-2 rounded-xl text-sm font-medium transition-colors {{ request('category') === $cat ? 'bg-accent text-white' : 'bg-white/5 hover:bg-white/10' }}">
                    {{ $cat }}
                </a>
            @endforeach
        </div>

        {{-- Skills Grid --}}
        @if($skills->count() > 0)
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($skills as $skill)
                    <div class="group bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-5 hover:border-accent/30 transition-all">
                        <div class="flex items-start justify-between gap-4 mb-4">
                            <div class="flex items-center gap-3">
                                @if($skill->icon)
                                    <span class="text-2xl">{{ $skill->icon }}</span>
                                @else
                                    <div class="w-10 h-10 rounded-xl bg-accent/10 text-accent flex items-center justify-center font-bold">
                                        {{ strtoupper(substr($skill->name, 0, 2)) }}
                                    </div>
                                @endif
                                <div>
                                    <h3 class="font-semibold">{{ $skill->name }}</h3>
                                    @if($skill->category)
                                        <span class="text-sm text-text-muted">{{ $skill->category }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                <a href="{{ route('admin.skills.edit', $skill) }}" class="p-2 hover:bg-white/10 rounded-lg transition-colors" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>
                                <form action="{{ route('admin.skills.destroy', $skill) }}" method="POST" onsubmit="return confirm('Delete this skill?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 hover:bg-red-500/10 hover:text-red-400 rounded-lg transition-colors" title="Delete">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>

                        {{-- Proficiency Bar --}}
                        <div class="space-y-2">
                            <div class="flex justify-between text-sm">
                                <span class="text-text-muted">Proficiency</span>
                                <span class="font-medium text-accent">{{ $skill->proficiency }}%</span>
                            </div>
                            <div class="h-2 bg-white/5 rounded-full overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-accent to-accent-2 rounded-full transition-all" style="width: {{ $skill->proficiency }}%"></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-12 text-center">
                <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-white/5 flex items-center justify-center">
                    <svg class="w-8 h-8 text-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold mb-2">No Skills Yet</h3>
                <p class="text-text-muted mb-6">Add your first skill to showcase your expertise.</p>
                <a href="{{ route('admin.skills.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-accent to-accent-2 text-white rounded-xl font-semibold">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Add Skill
                </a>
            </div>
        @endif
    </div>
</x-layouts.admin>
