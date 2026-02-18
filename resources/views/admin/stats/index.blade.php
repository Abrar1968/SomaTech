<x-layouts.admin title="Stats">
    <div class="space-y-6">
        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold font-display">Stats</h1>
                <p class="text-text-muted mt-1">Manage statistics displayed on your homepage</p>
            </div>
            <a href="{{ route('admin.stats.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-accent to-accent-2 text-white rounded-xl font-semibold hover:shadow-lg hover:shadow-accent/25 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Add Stat
            </a>
        </div>

        {{-- Stats Grid --}}
        @if($stats->count() > 0)
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach($stats as $stat)
                    <div class="group bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-6 hover:border-accent/30 transition-all">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center gap-3">
                                @if($stat->icon)
                                    <span class="text-3xl">{{ $stat->icon }}</span>
                                @else
                                    <div class="w-12 h-12 rounded-xl bg-accent/10 text-accent flex items-center justify-center">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                <a href="{{ route('admin.stats.edit', $stat) }}" class="p-2 hover:bg-white/10 rounded-lg transition-colors" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>
                                <form action="{{ route('admin.stats.destroy', $stat) }}" method="POST" onsubmit="return confirm('Delete this stat?')">
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

                        {{-- Value Display --}}
                        <div class="text-center">
                            <div class="text-3xl font-bold font-display bg-gradient-to-r from-accent to-accent-2 bg-clip-text text-transparent">
                                {{ $stat->prefix }}{{ number_format($stat->value) }}{{ $stat->suffix }}
                            </div>
                            <p class="text-text-muted mt-1">{{ $stat->label }}</p>
                        </div>

                        {{-- Sort Order Badge --}}
                        <div class="mt-4 flex justify-center">
                            <span class="px-2 py-1 text-xs bg-white/5 rounded-lg text-text-muted">
                                Order: {{ $stat->sort_order }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-12 text-center">
                <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-white/5 flex items-center justify-center">
                    <svg class="w-8 h-8 text-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold mb-2">No Stats Yet</h3>
                <p class="text-text-muted mb-6">Add statistics to display on your homepage.</p>
                <a href="{{ route('admin.stats.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-accent to-accent-2 text-white rounded-xl font-semibold">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Add Stat
                </a>
            </div>
        @endif

        {{-- Preview Section --}}
        @if($stats->count() > 0)
            <div class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-6">
                <h2 class="text-lg font-semibold mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    Homepage Preview
                </h2>
                <div class="bg-[var(--color-bg-primary)] rounded-xl p-6">
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 text-center">
                        @foreach($stats as $stat)
                            <div>
                                <div class="text-2xl lg:text-3xl font-bold font-display bg-gradient-to-r from-accent to-accent-2 bg-clip-text text-transparent">
                                    {{ $stat->prefix }}{{ number_format($stat->value) }}{{ $stat->suffix }}
                                </div>
                                <p class="text-sm text-text-muted mt-1">{{ $stat->label }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-layouts.admin>
