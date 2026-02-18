<x-layouts.admin title="Edit Stat">
    <div class="space-y-6">
        {{-- Header --}}
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.stats.index') }}" class="p-2 rounded-xl bg-white/5 hover:bg-white/10 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold font-display">Edit Stat</h1>
                <p class="text-text-muted mt-1">{{ $stat->label }}</p>
            </div>
        </div>

        <form action="{{ route('admin.stats.update', $stat) }}" method="POST" class="max-w-2xl" x-data="statForm()">
            @csrf
            @method('PUT')

            <div class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-6 space-y-5">
                {{-- Preview --}}
                <div class="p-6 bg-white/5 rounded-xl text-center">
                    <span class="text-2xl block mb-2" x-text="icon || '📊'"></span>
                    <div class="text-3xl font-bold font-display bg-gradient-to-r from-accent to-accent-2 bg-clip-text text-transparent">
                        <span x-text="prefix"></span><span x-text="value || '0'"></span><span x-text="suffix"></span>
                    </div>
                    <div class="text-text-muted mt-1" x-text="label || 'Stat Label'"></div>
                </div>

                <div class="grid sm:grid-cols-2 gap-5">
                    <div class="space-y-2">
                        <label for="label" class="text-sm font-medium text-text-muted">Label *</label>
                        <input
                            type="text"
                            name="label"
                            id="label"
                            value="{{ old('label', $stat->label) }}"
                            x-model="label"
                            class="w-full px-4 py-3 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors"
                            placeholder="Projects Completed"
                            required
                        >
                        @error('label')
                            <p class="text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="value" class="text-sm font-medium text-text-muted">Value *</label>
                        <input
                            type="number"
                            name="value"
                            id="value"
                            value="{{ old('value', $stat->value) }}"
                            x-model="value"
                            class="w-full px-4 py-3 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors"
                            placeholder="150"
                            required
                        >
                        @error('value')
                            <p class="text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid sm:grid-cols-3 gap-5">
                    <div class="space-y-2">
                        <label for="prefix" class="text-sm font-medium text-text-muted">Prefix</label>
                        <input
                            type="text"
                            name="prefix"
                            id="prefix"
                            value="{{ old('prefix', $stat->prefix) }}"
                            x-model="prefix"
                            class="w-full px-4 py-3 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors"
                            placeholder="$"
                        >
                        <p class="text-xs text-text-muted">e.g., $, £</p>
                    </div>

                    <div class="space-y-2">
                        <label for="suffix" class="text-sm font-medium text-text-muted">Suffix</label>
                        <input
                            type="text"
                            name="suffix"
                            id="suffix"
                            value="{{ old('suffix', $stat->suffix) }}"
                            x-model="suffix"
                            class="w-full px-4 py-3 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors"
                            placeholder="+"
                        >
                        <p class="text-xs text-text-muted">e.g., +, %, K</p>
                    </div>

                    <div class="space-y-2">
                        <label for="icon" class="text-sm font-medium text-text-muted">Icon (emoji)</label>
                        <input
                            type="text"
                            name="icon"
                            id="icon"
                            value="{{ old('icon', $stat->icon) }}"
                            x-model="icon"
                            class="w-full px-4 py-3 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors text-2xl text-center"
                            placeholder="🚀"
                        >
                    </div>
                </div>

                <div class="space-y-2">
                    <label for="sort_order" class="text-sm font-medium text-text-muted">Sort Order</label>
                    <input
                        type="number"
                        name="sort_order"
                        id="sort_order"
                        value="{{ old('sort_order', $stat->sort_order) }}"
                        class="w-full px-4 py-3 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors"
                        min="0"
                    >
                </div>

                <div class="flex gap-3 pt-4">
                    <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-accent to-accent-2 text-white rounded-xl font-semibold hover:shadow-lg hover:shadow-accent/25 transition-all">
                        Update Stat
                    </button>
                    <a href="{{ route('admin.stats.index') }}" class="px-6 py-2.5 bg-white/5 border border-white/10 rounded-xl font-semibold hover:bg-white/10 transition-colors">
                        Cancel
                    </a>
                </div>
            </div>
        </form>

        {{-- Danger Zone --}}
        <div class="max-w-2xl bg-red-500/5 rounded-2xl border border-red-500/10 p-6">
            <h2 class="text-lg font-semibold text-red-400 mb-2">Danger Zone</h2>
            <p class="text-sm text-text-muted mb-4">Permanently delete this stat.</p>
            <form action="{{ route('admin.stats.destroy', $stat) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Are you sure you want to delete this stat?')" class="px-4 py-2.5 bg-red-500/10 border border-red-500/20 text-red-400 rounded-xl hover:bg-red-500/20 transition-colors font-medium">
                    Delete Stat
                </button>
            </form>
        </div>
    </div>

    <script>
        function statForm() {
            return {
                label: '{{ old('label', $stat->label) }}',
                value: '{{ old('value', $stat->value) }}',
                prefix: '{{ old('prefix', $stat->prefix) }}',
                suffix: '{{ old('suffix', $stat->suffix) }}',
                icon: '{{ old('icon', $stat->icon) }}'
            }
        }
    </script>
</x-layouts.admin>
