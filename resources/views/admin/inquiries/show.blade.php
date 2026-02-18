<x-layouts.admin title="View Inquiry">
    <div class="space-y-6">
        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.inquiries.index') }}" class="p-2 rounded-xl bg-white/5 hover:bg-white/10 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </a>
                <div>
                    <h1 class="text-2xl font-bold font-display">Inquiry from {{ $inquiry->name }}</h1>
                    <p class="text-text-muted mt-1">Received {{ $inquiry->created_at->format('F j, Y \a\t g:i A') }}</p>
                </div>
            </div>
            <div class="flex gap-3">
                <a href="mailto:{{ $inquiry->email }}?subject=Re: {{ urlencode($inquiry->subject ?? 'Your inquiry') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-accent to-accent-2 text-white rounded-xl font-semibold hover:shadow-lg hover:shadow-accent/25 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    Reply
                </a>
            </div>
        </div>

        <div class="grid lg:grid-cols-3 gap-6">
            {{-- Main Content --}}
            <div class="lg:col-span-2 space-y-6">
                {{-- Message --}}
                <div class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-6 space-y-4">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-semibold">Message</h2>
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
                    </div>

                    @if($inquiry->subject)
                        <div class="pb-4 border-b border-white/5">
                            <p class="text-sm text-text-muted mb-1">Subject</p>
                            <p class="font-medium">{{ $inquiry->subject }}</p>
                        </div>
                    @endif

                    <div class="prose prose-invert max-w-none">
                        <p class="whitespace-pre-wrap text-text-muted leading-relaxed">{{ $inquiry->message }}</p>
                    </div>
                </div>

                {{-- Status Actions --}}
                <div class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-6">
                    <h2 class="text-lg font-semibold mb-4">Update Status</h2>
                    <form action="{{ route('admin.inquiries.update', $inquiry) }}" method="POST" class="flex flex-wrap gap-3">
                        @csrf
                        @method('PATCH')
                        <button type="submit" name="status" value="unread" class="px-4 py-2.5 rounded-xl border transition-colors font-medium {{ $inquiry->status === 'unread' ? 'bg-accent/10 border-accent/20 text-accent' : 'bg-white/5 border-white/10 hover:bg-white/10' }}">
                            Mark Unread
                        </button>
                        <button type="submit" name="status" value="read" class="px-4 py-2.5 rounded-xl border transition-colors font-medium {{ $inquiry->status === 'read' ? 'bg-gray-500/10 border-gray-500/20 text-gray-400' : 'bg-white/5 border-white/10 hover:bg-white/10' }}">
                            Mark Read
                        </button>
                        <button type="submit" name="status" value="replied" class="px-4 py-2.5 rounded-xl border transition-colors font-medium {{ $inquiry->status === 'replied' ? 'bg-emerald-500/10 border-emerald-500/20 text-emerald-400' : 'bg-white/5 border-white/10 hover:bg-white/10' }}">
                            Mark Replied
                        </button>
                    </form>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="space-y-6">
                {{-- Contact Info --}}
                <div class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-6 space-y-5">
                    <h2 class="text-lg font-semibold">Contact Information</h2>

                    <div class="space-y-4">
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-accent/20 to-accent-2/20 flex items-center justify-center shrink-0">
                                <span class="text-sm font-bold text-accent">{{ strtoupper(substr($inquiry->name, 0, 1)) }}</span>
                            </div>
                            <div>
                                <p class="font-semibold">{{ $inquiry->name }}</p>
                                <p class="text-sm text-text-muted">Contact Name</p>
                            </div>
                        </div>

                        <a href="mailto:{{ $inquiry->email }}" class="flex items-center gap-3 p-3 bg-white/5 rounded-xl hover:bg-white/10 transition-colors group">
                            <div class="w-10 h-10 rounded-lg bg-white/5 flex items-center justify-center">
                                <svg class="w-5 h-5 text-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm text-text-muted">Email</p>
                                <p class="text-accent truncate">{{ $inquiry->email }}</p>
                            </div>
                        </a>

                        @if($inquiry->phone)
                            <a href="tel:{{ $inquiry->phone }}" class="flex items-center gap-3 p-3 bg-white/5 rounded-xl hover:bg-white/10 transition-colors group">
                                <div class="w-10 h-10 rounded-lg bg-white/5 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm text-text-muted">Phone</p>
                                    <p class="text-accent">{{ $inquiry->phone }}</p>
                                </div>
                            </a>
                        @endif

                        @if($inquiry->company)
                            <div class="flex items-center gap-3 p-3 bg-white/5 rounded-xl">
                                <div class="w-10 h-10 rounded-lg bg-white/5 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm text-text-muted">Company</p>
                                    <p>{{ $inquiry->company }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Meta Information --}}
                <div class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-6 space-y-4">
                    <h2 class="text-lg font-semibold">Details</h2>

                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between py-2 border-b border-white/5">
                            <span class="text-text-muted">Inquiry ID</span>
                            <span>#{{ $inquiry->id }}</span>
                        </div>
                        <div class="flex justify-between py-2 border-b border-white/5">
                            <span class="text-text-muted">Received</span>
                            <span>{{ $inquiry->created_at->format('M j, Y') }}</span>
                        </div>
                        <div class="flex justify-between py-2 border-b border-white/5">
                            <span class="text-text-muted">Time</span>
                            <span>{{ $inquiry->created_at->format('g:i A') }}</span>
                        </div>
                        @if($inquiry->service)
                            <div class="flex justify-between py-2 border-b border-white/5">
                                <span class="text-text-muted">Service</span>
                                <span>{{ $inquiry->service->title ?? 'N/A' }}</span>
                            </div>
                        @endif
                        @if($inquiry->ip_address)
                            <div class="flex justify-between py-2">
                                <span class="text-text-muted">IP Address</span>
                                <span class="font-mono text-xs">{{ $inquiry->ip_address }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Danger Zone --}}
                <div class="bg-red-500/5 rounded-2xl border border-red-500/10 p-6 space-y-4">
                    <h2 class="text-lg font-semibold text-red-400">Danger Zone</h2>
                    <p class="text-sm text-text-muted">Permanently delete this inquiry.</p>
                    <form action="{{ route('admin.inquiries.destroy', $inquiry) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure you want to delete this inquiry?')" class="w-full px-4 py-2.5 bg-red-500/10 border border-red-500/20 text-red-400 rounded-xl hover:bg-red-500/20 transition-colors font-medium">
                            Delete Inquiry
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>
