<x-layouts.admin title="Edit Skill">
    <div class="space-y-6">
        {{-- Header --}}
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.skills.index') }}" class="p-2 rounded-xl bg-white/5 hover:bg-white/10 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold font-display">Edit Skill</h1>
                <p class="text-text-muted mt-1">{{ $skill->name }}</p>
            </div>
        </div>

        <form action="{{ route('admin.skills.update', $skill) }}" method="POST" class="max-w-2xl">
            @csrf
            @method('PUT')

            <div class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-6 space-y-5">
                <div class="grid sm:grid-cols-2 gap-5">
                    <div class="space-y-2">
                        <label for="name" class="text-sm font-medium text-text-muted">Skill Name *</label>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            value="{{ old('name', $skill->name) }}"
                            class="w-full px-4 py-3 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors"
                            placeholder="Laravel"
                            required
                        >
                        @error('name')
                            <p class="text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="category" class="text-sm font-medium text-text-muted">Category</label>
                        <input
                            type="text"
                            name="category"
                            id="category"
                            value="{{ old('category', $skill->category) }}"
                            list="categories"
                            class="w-full px-4 py-3 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors"
                            placeholder="Backend"
                        >
                        <datalist id="categories">
                            <option value="Frontend">
                            <option value="Backend">
                            <option value="Database">
                            <option value="DevOps">
                            <option value="Tools">
                            <option value="Design">
                        </datalist>
                    </div>
                </div>

                <div class="space-y-2" x-data="{ proficiency: {{ old('proficiency', $skill->proficiency) }} }">
                    <label for="proficiency" class="text-sm font-medium text-text-muted">Proficiency Level *</label>
                    <div class="flex items-center gap-4">
                        <input
                            type="range"
                            name="proficiency"
                            id="proficiency"
                            x-model="proficiency"
                            min="0"
                            max="100"
                            class="flex-1 h-2 bg-white/10 rounded-lg appearance-none cursor-pointer accent-accent"
                        >
                        <span class="w-12 text-right font-medium text-accent" x-text="proficiency + '%'"></span>
                    </div>
                    <div class="h-2 bg-white/5 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-accent to-accent-2 rounded-full transition-all" :style="'width: ' + proficiency + '%'"></div>
                    </div>
                    @error('proficiency')
                        <p class="text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid sm:grid-cols-2 gap-5">
                    <div class="space-y-2">
                        <label for="icon" class="text-sm font-medium text-text-muted">Icon (emoji)</label>
                        <input
                            type="text"
                            name="icon"
                            id="icon"
                            value="{{ old('icon', $skill->icon) }}"
                            class="w-full px-4 py-3 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors text-2xl text-center"
                            placeholder="⚡"
                        >
                        <p class="text-xs text-text-muted">Use an emoji to represent this skill</p>
                    </div>

                    <div class="space-y-2">
                        <label for="sort_order" class="text-sm font-medium text-text-muted">Sort Order</label>
                        <input
                            type="number"
                            name="sort_order"
                            id="sort_order"
                            value="{{ old('sort_order', $skill->sort_order) }}"
                            class="w-full px-4 py-3 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors"
                            min="0"
                        >
                    </div>
                </div>

                <div class="flex gap-3 pt-4">
                    <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-accent to-accent-2 text-white rounded-xl font-semibold hover:shadow-lg hover:shadow-accent/25 transition-all">
                        Update Skill
                    </button>
                    <a href="{{ route('admin.skills.index') }}" class="px-6 py-2.5 bg-white/5 border border-white/10 rounded-xl font-semibold hover:bg-white/10 transition-colors">
                        Cancel
                    </a>
                </div>
            </div>
        </form>

        {{-- Danger Zone --}}
        <div class="max-w-2xl bg-red-500/5 rounded-2xl border border-red-500/10 p-6">
            <h2 class="text-lg font-semibold text-red-400 mb-2">Danger Zone</h2>
            <p class="text-sm text-text-muted mb-4">Permanently delete this skill.</p>
            <form action="{{ route('admin.skills.destroy', $skill) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Are you sure you want to delete this skill?')" class="px-4 py-2.5 bg-red-500/10 border border-red-500/20 text-red-400 rounded-xl hover:bg-red-500/20 transition-colors font-medium">
                    Delete Skill
                </button>
            </form>
        </div>
    </div>
</x-layouts.admin>
