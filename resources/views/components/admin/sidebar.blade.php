<div class="flex flex-col h-full overflow-hidden" x-data="{ activeSection: 'content' }">
    {{-- Logo Section --}}
    <div class="p-6 border-b border-white/5 flex items-center justify-between">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 group">
            <div class="relative w-10 h-10">
                <div class="absolute inset-0 bg-gradient-to-br from-accent to-accent-2 rounded-xl rotate-6 opacity-50 group-hover:rotate-12 transition-transform duration-300"></div>
                <div class="relative w-full h-full bg-[var(--color-bg-elevated)] rounded-xl flex items-center justify-center border border-white/10">
                    <span class="text-accent font-bold text-xl">S</span>
                </div>
            </div>
            <div>
                <span class="text-lg font-bold font-display block">Somaticx</span>
                <span class="text-xs text-text-muted">Admin Panel</span>
            </div>
        </a>
        {{-- Mobile Close Button --}}
        <button
            @click="$parent.sidebarOpen = false"
            class="lg:hidden p-2 rounded-lg hover:bg-white/5 transition-colors"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 overflow-y-auto p-4 space-y-6 scrollbar-thin scrollbar-thumb-white/10 scrollbar-track-transparent">
        {{-- Main Section --}}
        <div>
            <h3 class="px-4 mb-3 text-xs font-semibold text-text-muted uppercase tracking-wider">Main</h3>
            <div class="space-y-1">
                <a
                    href="{{ route('admin.dashboard') }}"
                    class="group flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.dashboard') ? 'bg-gradient-to-r from-accent/20 to-transparent text-white border-l-2 border-accent' : 'text-text-muted hover:bg-white/5 hover:text-white' }} transition-all duration-300"
                >
                    <div class="w-8 h-8 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-accent/20' : 'bg-white/5 group-hover:bg-accent/10' }} flex items-center justify-center transition-colors">
                        <svg class="w-4 h-4 {{ request()->routeIs('admin.dashboard') ? 'text-accent' : 'group-hover:text-accent' }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                    </div>
                    <span class="font-medium">Dashboard</span>
                </a>

                <a
                    href="{{ route('admin.inquiries.index') }}"
                    class="group flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.inquiries.*') ? 'bg-gradient-to-r from-accent/20 to-transparent text-white border-l-2 border-accent' : 'text-text-muted hover:bg-white/5 hover:text-white' }} transition-all duration-300"
                >
                    <div class="w-8 h-8 rounded-lg {{ request()->routeIs('admin.inquiries.*') ? 'bg-accent/20' : 'bg-white/5 group-hover:bg-accent/10' }} flex items-center justify-center transition-colors relative">
                        <svg class="w-4 h-4 {{ request()->routeIs('admin.inquiries.*') ? 'text-accent' : 'group-hover:text-accent' }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <span class="font-medium flex-1">Inquiries</span>
                    @php $unreadCount = \App\Models\ContactInquiry::unread()->count(); @endphp
                    @if($unreadCount > 0)
                        <span class="px-2 py-0.5 text-xs font-semibold bg-accent/20 text-accent rounded-full">{{ $unreadCount }}</span>
                    @endif
                </a>
            </div>
        </div>

        {{-- Content Section --}}
        <div>
            <h3 class="px-4 mb-3 text-xs font-semibold text-text-muted uppercase tracking-wider">Content</h3>
            <div class="space-y-1">
                <a
                    href="{{ route('admin.projects.index') }}"
                    class="group flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.projects.*') ? 'bg-gradient-to-r from-accent/20 to-transparent text-white border-l-2 border-accent' : 'text-text-muted hover:bg-white/5 hover:text-white' }} transition-all duration-300"
                >
                    <div class="w-8 h-8 rounded-lg {{ request()->routeIs('admin.projects.*') ? 'bg-accent/20' : 'bg-white/5 group-hover:bg-accent/10' }} flex items-center justify-center transition-colors">
                        <svg class="w-4 h-4 {{ request()->routeIs('admin.projects.*') ? 'text-accent' : 'group-hover:text-accent' }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    <span class="font-medium">Projects</span>
                </a>

                <a
                    href="{{ route('admin.services.index') }}"
                    class="group flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.services.*') ? 'bg-gradient-to-r from-accent/20 to-transparent text-white border-l-2 border-accent' : 'text-text-muted hover:bg-white/5 hover:text-white' }} transition-all duration-300"
                >
                    <div class="w-8 h-8 rounded-lg {{ request()->routeIs('admin.services.*') ? 'bg-accent/20' : 'bg-white/5 group-hover:bg-accent/10' }} flex items-center justify-center transition-colors">
                        <svg class="w-4 h-4 {{ request()->routeIs('admin.services.*') ? 'text-accent' : 'group-hover:text-accent' }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <span class="font-medium">Services</span>
                </a>

                <a
                    href="{{ route('admin.testimonials.index') }}"
                    class="group flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.testimonials.*') ? 'bg-gradient-to-r from-accent/20 to-transparent text-white border-l-2 border-accent' : 'text-text-muted hover:bg-white/5 hover:text-white' }} transition-all duration-300"
                >
                    <div class="w-8 h-8 rounded-lg {{ request()->routeIs('admin.testimonials.*') ? 'bg-accent/20' : 'bg-white/5 group-hover:bg-accent/10' }} flex items-center justify-center transition-colors">
                        <svg class="w-4 h-4 {{ request()->routeIs('admin.testimonials.*') ? 'text-accent' : 'group-hover:text-accent' }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </div>
                    <span class="font-medium">Testimonials</span>
                </a>
            </div>
        </div>

        {{-- People Section --}}
        <div>
            <h3 class="px-4 mb-3 text-xs font-semibold text-text-muted uppercase tracking-wider">People</h3>
            <div class="space-y-1">
                <a
                    href="{{ route('admin.team.index') }}"
                    class="group flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.team.*') ? 'bg-gradient-to-r from-accent/20 to-transparent text-white border-l-2 border-accent' : 'text-text-muted hover:bg-white/5 hover:text-white' }} transition-all duration-300"
                >
                    <div class="w-8 h-8 rounded-lg {{ request()->routeIs('admin.team.*') ? 'bg-accent/20' : 'bg-white/5 group-hover:bg-accent/10' }} flex items-center justify-center transition-colors">
                        <svg class="w-4 h-4 {{ request()->routeIs('admin.team.*') ? 'text-accent' : 'group-hover:text-accent' }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <span class="font-medium">Team</span>
                </a>
            </div>
        </div>

        {{-- Data Section --}}
        <div>
            <h3 class="px-4 mb-3 text-xs font-semibold text-text-muted uppercase tracking-wider">Data</h3>
            <div class="space-y-1">
                <a
                    href="{{ route('admin.skills.index') }}"
                    class="group flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.skills.*') ? 'bg-gradient-to-r from-accent/20 to-transparent text-white border-l-2 border-accent' : 'text-text-muted hover:bg-white/5 hover:text-white' }} transition-all duration-300"
                >
                    <div class="w-8 h-8 rounded-lg {{ request()->routeIs('admin.skills.*') ? 'bg-accent/20' : 'bg-white/5 group-hover:bg-accent/10' }} flex items-center justify-center transition-colors">
                        <svg class="w-4 h-4 {{ request()->routeIs('admin.skills.*') ? 'text-accent' : 'group-hover:text-accent' }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                    </div>
                    <span class="font-medium">Skills</span>
                </a>

                <a
                    href="{{ route('admin.stats.index') }}"
                    class="group flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.stats.*') ? 'bg-gradient-to-r from-accent/20 to-transparent text-white border-l-2 border-accent' : 'text-text-muted hover:bg-white/5 hover:text-white' }} transition-all duration-300"
                >
                    <div class="w-8 h-8 rounded-lg {{ request()->routeIs('admin.stats.*') ? 'bg-accent/20' : 'bg-white/5 group-hover:bg-accent/10' }} flex items-center justify-center transition-colors">
                        <svg class="w-4 h-4 {{ request()->routeIs('admin.stats.*') ? 'text-accent' : 'group-hover:text-accent' }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <span class="font-medium">Stats</span>
                </a>
            </div>
        </div>

        {{-- System Section --}}
        <div>
            <h3 class="px-4 mb-3 text-xs font-semibold text-text-muted uppercase tracking-wider">System</h3>
            <div class="space-y-1">
                <a
                    href="{{ route('admin.settings.index') }}"
                    class="group flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.settings.*') ? 'bg-gradient-to-r from-accent/20 to-transparent text-white border-l-2 border-accent' : 'text-text-muted hover:bg-white/5 hover:text-white' }} transition-all duration-300"
                >
                    <div class="w-8 h-8 rounded-lg {{ request()->routeIs('admin.settings.*') ? 'bg-accent/20' : 'bg-white/5 group-hover:bg-accent/10' }} flex items-center justify-center transition-colors">
                        <svg class="w-4 h-4 {{ request()->routeIs('admin.settings.*') ? 'text-accent' : 'group-hover:text-accent' }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <span class="font-medium">Settings</span>
                </a>
            </div>
        </div>
    </nav>

    {{-- Bottom Section --}}
    <div class="p-4 border-t border-white/5 space-y-2">
        {{-- Help Card --}}
        <div class="p-4 rounded-xl bg-gradient-to-br from-accent/10 to-accent-2/10 border border-white/5">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-8 h-8 rounded-lg bg-accent/20 flex items-center justify-center">
                    <svg class="w-4 h-4 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <span class="font-medium text-sm">Need Help?</span>
            </div>
            <p class="text-xs text-text-muted mb-3">Check our documentation for guides and tutorials.</p>
            <a href="{{ route('admin.docs.index') }}" class="inline-flex items-center gap-1 text-xs text-accent hover:text-accent-2 transition-colors">
                View Docs
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
    </div>
</div>
