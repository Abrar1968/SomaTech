<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow"> {{-- SRS CONST-007 --}}

    <title>{{ $title ?? 'Dashboard' }} - Somaticx Admin</title>

    {{-- Preconnect for fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@600;700;800&family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/admin.js'])
    
    <style>
        .sidebar-transition { transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.3s ease; }
        .content-transition { transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
    </style>
</head>
<body class="bg-[var(--color-bg-primary)] text-white antialiased" x-data="{ sidebarOpen: window.innerWidth >= 1024, loaded: false }" x-init="setTimeout(() => loaded = true, 100)">
    {{-- Mobile Overlay --}}
    <div 
        x-show="sidebarOpen" 
        x-transition:enter="transition-opacity ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="sidebarOpen = false"
        class="fixed inset-0 bg-black/60 backdrop-blur-sm z-40 lg:hidden"
        x-cloak
    ></div>

    <div class="flex h-screen overflow-hidden">
        {{-- Sidebar --}}
        <aside 
            class="fixed lg:static inset-y-0 left-0 z-50 w-72 bg-[var(--color-bg-surface)] border-r border-white/5 flex-shrink-0 sidebar-transition"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
        >
            <x-admin.sidebar />
        </aside>

        {{-- Main Content --}}
        <div class="flex-1 flex flex-col overflow-hidden min-w-0">
            {{-- Top Bar --}}
            <header class="h-16 bg-[var(--color-bg-surface)]/80 backdrop-blur-xl border-b border-white/5 flex items-center justify-between px-4 lg:px-6 flex-shrink-0 sticky top-0 z-30">
                <div class="flex items-center gap-4">
                    {{-- Mobile Menu Toggle --}}
                    <button 
                        @click="sidebarOpen = !sidebarOpen"
                        class="lg:hidden p-2 rounded-xl hover:bg-white/5 transition-colors"
                    >
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path x-show="!sidebarOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16"></path>
                            <path x-show="sidebarOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12" x-cloak></path>
                        </svg>
                    </button>
                    
                    {{-- Page Title & Breadcrumb --}}
                    <div>
                        <h1 class="text-lg lg:text-xl font-semibold font-display">{{ $title ?? 'Dashboard' }}</h1>
                        @if(isset($breadcrumb))
                            <nav class="text-sm text-text-muted hidden sm:block">
                                <ol class="flex items-center gap-2">
                                    <li><a href="{{ route('admin.dashboard') }}" class="hover:text-white transition-colors">Admin</a></li>
                                    <li><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg></li>
                                    <li class="text-white/60">{{ $title ?? 'Dashboard' }}</li>
                                </ol>
                            </nav>
                        @endif
                    </div>
                </div>
                
                <div class="flex items-center gap-2 lg:gap-4">
                    {{-- Search (Desktop) --}}
                    <div class="hidden md:block relative" x-data="{ searchFocused: false }">
                        <div class="absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none">
                            <svg class="w-4 h-4 text-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input 
                            type="text" 
                            placeholder="Search..." 
                            class="w-48 lg:w-64 pl-10 pr-4 py-2 bg-white/5 border border-white/10 rounded-xl text-sm focus:outline-none focus:border-accent focus:bg-white/10 transition-all duration-300"
                            @focus="searchFocused = true"
                            @blur="searchFocused = false"
                        >
                    </div>
                    
                    {{-- Notifications --}}
                    <button class="relative p-2.5 rounded-xl hover:bg-white/5 transition-colors group">
                        <svg class="w-5 h-5 text-text-muted group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                        <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-accent rounded-full ring-2 ring-[var(--color-bg-surface)]"></span>
                    </button>
                    
                    {{-- View Site --}}
                    <a 
                        href="{{ route('home') }}" 
                        target="_blank"
                        class="hidden sm:flex items-center gap-2 px-3 py-2 text-sm rounded-xl bg-white/5 hover:bg-white/10 transition-colors group"
                    >
                        <svg class="w-4 h-4 text-text-muted group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                        <span class="text-text-muted group-hover:text-white transition-colors">View Site</span>
                    </a>
                    
                    {{-- User Menu --}}
                    <x-admin.user-menu />
                </div>
            </header>

            {{-- Content Area --}}
            <main 
                class="flex-1 overflow-y-auto p-4 lg:p-6"
                :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'"
                style="transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1) 0.2s;"
            >
                {{-- Flash Messages --}}
                @if(session('success'))
                    <div 
                        x-data="{ show: true }" 
                        x-show="show" 
                        x-init="setTimeout(() => show = false, 5000)"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-2"
                        class="mb-6 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-between"
                    >
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-emerald-500/20 flex items-center justify-center">
                                <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <p class="text-emerald-400">{{ session('success') }}</p>
                        </div>
                        <button @click="show = false" class="text-emerald-400/60 hover:text-emerald-400 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                @endif
                
                @if(session('error'))
                    <div 
                        x-data="{ show: true }" 
                        x-show="show"
                        x-transition
                        class="mb-6 p-4 rounded-xl bg-red-500/10 border border-red-500/20 flex items-center justify-between"
                    >
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-red-500/20 flex items-center justify-center">
                                <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <p class="text-red-400">{{ session('error') }}</p>
                        </div>
                        <button @click="show = false" class="text-red-400/60 hover:text-red-400 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                @endif

                {{ $slot }}
            </main>
            
            {{-- Footer --}}
            <footer class="px-4 lg:px-6 py-4 border-t border-white/5 text-center text-sm text-text-muted">
                &copy; {{ date('Y') }} Somaticx. Admin Panel v1.0
            </footer>
        </div>
    </div>
</body>
</html>
