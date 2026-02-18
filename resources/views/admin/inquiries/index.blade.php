<x-layouts.admin title="Contact Inquiries">
    <div class="space-y-6" x-data="{ deleteModal: false, deleteId: null }">
        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold font-display">Contact Inquiries</h1>
                <p class="text-text-muted mt-1">Manage incoming contact form submissions</p>
            </div>
            <div class="flex items-center gap-3">
                <span class="px-3 py-1.5 bg-accent/10 text-accent rounded-lg text-sm font-medium">
                    {{ $unreadCount ?? 0 }} unread
                </span>
            </div>
        </div>

        {{-- Filters --}}
        <div class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-4">
            <form method="GET" class="flex flex-col sm:flex-row gap-4">
                <div class="flex-1">
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search by name, email, or subject..."
                        class="w-full px-4 py-2.5 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors"
                    >
                </div>
                <select name="status" class="px-4 py-2.5 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors">
                    <option value="">All Status</option>
                    <option value="unread" {{ request('status') === 'unread' ? 'selected' : '' }}>Unread</option>
                    <option value="read" {{ request('status') === 'read' ? 'selected' : '' }}>Read</option>
                    <option value="replied" {{ request('status') === 'replied' ? 'selected' : '' }}>Replied</option>
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
                            <th class="text-left px-6 py-4 text-sm font-semibold text-text-muted">Contact</th>
                            <th class="text-left px-6 py-4 text-sm font-semibold text-text-muted hidden md:table-cell">Subject</th>
                            <th class="text-left px-6 py-4 text-sm font-semibold text-text-muted">Status</th>
                            <th class="text-left px-6 py-4 text-sm font-semibold text-text-muted hidden lg:table-cell">Received</th>
                            <th class="text-right px-6 py-4 text-sm font-semibold text-text-muted">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse($inquiries as $inquiry)
                            <tr class="hover:bg-white/5 transition-colors {{ $inquiry->status === 'unread' ? 'bg-accent/5' : '' }}">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-accent/20 to-accent-2/20 flex items-center justify-center">
                                            <span class="text-sm font-bold text-accent">{{ strtoupper(substr($inquiry->name, 0, 1)) }}</span>
                                        </div>
                                        <div>
                                            <p class="font-semibold {{ $inquiry->status === 'unread' ? 'text-white' : '' }}">{{ $inquiry->name }}</p>
                                            <p class="text-sm text-text-muted">{{ $inquiry->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 hidden md:table-cell">
                                    <p class="{{ $inquiry->status === 'unread' ? 'font-medium' : 'text-text-muted' }}">
                                        {{ Str::limit($inquiry->subject ?? 'No subject', 40) }}
                                    </p>
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $statusStyles = [
                                            'unread' => 'bg-accent/10 text-accent border-accent/20',
                                            'read' => 'bg-gray-500/10 text-gray-400 border-gray-500/20',
                                            'replied' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20',
                                        ];
                                    @endphp
                                    <span class="px-2.5 py-1 text-xs rounded-full border {{ $statusStyles[$inquiry->status] ?? $statusStyles['unread'] }}">
                                        {{ ucfirst($inquiry->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-text-muted hidden lg:table-cell">
                                    {{ $inquiry->created_at->diffForHumans() }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.inquiries.show', $inquiry) }}" class="p-2 rounded-lg hover:bg-accent/10 text-text-muted hover:text-accent transition-colors" title="View">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </a>
                                        <a href="mailto:{{ $inquiry->email }}" class="p-2 rounded-lg hover:bg-emerald-500/10 text-text-muted hover:text-emerald-400 transition-colors" title="Reply">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                            </svg>
                                        </a>
                                        <button
                                            @click="deleteModal = true; deleteId = {{ $inquiry->id }}"
                                            class="p-2 rounded-lg hover:bg-red-500/10 text-text-muted hover:text-red-400 transition-colors"
                                            title="Delete"
                                        >
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="w-16 h-16 rounded-2xl bg-white/5 flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-8 h-8 text-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <p class="text-text-muted">No inquiries found</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($inquiries->hasPages())
                <div class="px-6 py-4 border-t border-white/5">
                    {{ $inquiries->links() }}
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
                <h3 class="text-lg font-semibold text-center mb-2">Delete Inquiry</h3>
                <p class="text-text-muted text-center mb-6">Are you sure you want to delete this inquiry? This action cannot be undone.</p>
                <div class="flex gap-3">
                    <button @click="deleteModal = false" class="flex-1 px-4 py-2.5 bg-white/5 border border-white/10 rounded-xl hover:bg-white/10 transition-colors font-medium">
                        Cancel
                    </button>
                    <form :action="'/admin/inquiries/' + deleteId" method="POST" class="flex-1">
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
