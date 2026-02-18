<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login | {{ config('app.name') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }
        @keyframes float-delay {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-15px) rotate(-5deg); }
        }
        .float-animation { animation: float 6s ease-in-out infinite; }
        .float-animation-delay { animation: float-delay 8s ease-in-out infinite; }
    </style>
</head>
<body class="antialiased bg-[var(--color-bg-primary)] min-h-screen flex" x-data="{ loaded: false }" x-init="setTimeout(() => loaded = true, 100)">
    {{-- Left Side - Banner (hidden on mobile) --}}
    <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-gradient-to-br from-[var(--color-bg-surface)] to-[var(--color-bg-primary)]">
        {{-- Background elements --}}
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-1/4 left-1/4 w-[400px] h-[400px] bg-accent/20 rounded-full blur-3xl float-animation"></div>
            <div class="absolute bottom-1/4 right-1/4 w-[300px] h-[300px] bg-accent-2/20 rounded-full blur-3xl float-animation-delay"></div>
            <div class="absolute inset-0 opacity-30" style="background-image: radial-gradient(circle at 1px 1px, rgba(255,255,255,0.03) 1px, transparent 0); background-size: 40px 40px;"></div>
        </div>
        
        {{-- Content --}}
        <div class="relative z-10 flex flex-col justify-center items-center w-full p-16">
            <div 
                class="max-w-md text-center"
                :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                style="transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1) 0.2s;"
            >
                {{-- Logo --}}
                <div class="inline-flex items-center gap-3 mb-12">
                    <div class="relative w-16 h-16">
                        <div class="absolute inset-0 bg-gradient-to-br from-accent to-accent-2 rounded-2xl rotate-6 opacity-50"></div>
                        <div class="relative w-full h-full bg-[var(--color-bg-elevated)] rounded-2xl flex items-center justify-center border border-white/10">
                            <span class="text-accent font-bold text-3xl font-display">S</span>
                        </div>
                    </div>
                    <span class="text-3xl font-bold font-display">Somaticx</span>
                </div>
                
                <h2 class="text-3xl font-bold font-display mb-4">Welcome to the Admin Portal</h2>
                <p class="text-text-muted text-lg leading-relaxed mb-12">
                    Manage your portfolio, services, and client inquiries all in one place.
                </p>
                
                {{-- Features --}}
                <div class="space-y-4 text-left">
                    @foreach([
                        ['icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', 'text' => 'Secure authentication'],
                        ['icon' => 'M13 10V3L4 14h7v7l9-11h-7z', 'text' => 'Lightning fast performance'],
                        ['icon' => 'M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z', 'text' => 'Intuitive dashboard'],
                    ] as $feature)
                        <div class="flex items-center gap-3 p-4 rounded-xl bg-white/5 border border-white/5">
                            <div class="w-10 h-10 rounded-lg bg-accent/20 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $feature['icon'] }}"></path>
                                </svg>
                            </div>
                            <span class="text-white/80">{{ $feature['text'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    
    {{-- Right Side - Login Form --}}
    <div class="w-full lg:w-1/2 flex items-center justify-center p-6 lg:p-16 relative">
        {{-- Background elements (mobile only) --}}
        <div class="absolute inset-0 pointer-events-none lg:hidden">
            <div class="absolute top-20 left-0 w-[300px] h-[300px] bg-accent/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-0 w-[200px] h-[200px] bg-accent-2/10 rounded-full blur-3xl"></div>
        </div>
        
        <div 
            class="w-full max-w-md relative z-10"
            :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
            style="transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1) 0.4s;"
        >
            {{-- Mobile Logo --}}
            <div class="text-center mb-8 lg:hidden">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2">
                    <div class="w-12 h-12 bg-gradient-to-br from-accent to-accent-2 rounded-xl flex items-center justify-center">
                        <span class="text-white font-bold text-2xl">S</span>
                    </div>
                    <span class="text-2xl font-bold font-display">Somaticx</span>
                </a>
            </div>
            
            {{-- Header --}}
            <div class="text-center lg:text-left mb-8">
                <h1 class="text-3xl font-bold font-display mb-2">Admin Login</h1>
                <p class="text-text-muted">Sign in to access the admin panel</p>
            </div>

            {{-- Login Form --}}
            <form method="POST" action="{{ route('login.store') }}" class="relative rounded-3xl overflow-hidden bg-[var(--color-bg-elevated)] border border-white/5">
                {{-- Decorative header --}}
                <div class="h-1.5 bg-gradient-to-r from-accent to-accent-2"></div>
                
                <div class="p-8">
                    @csrf

                    {{-- Error Message --}}
                    @if ($errors->any())
                        <div class="mb-6 p-4 rounded-xl bg-red-500/10 border border-red-500/20 flex items-start gap-3">
                            <svg class="w-5 h-5 text-red-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-red-400 text-sm">{{ $errors->first() }}</p>
                        </div>
                    @endif

                    {{-- Email --}}
                    <div class="mb-6">
                        <label for="email" class="block text-sm font-medium mb-2">Email Address</label>
                        <div class="relative">
                            <div class="absolute left-4 top-1/2 -translate-y-1/2">
                                <svg class="w-5 h-5 text-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                class="w-full pl-12 pr-4 py-4 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent focus:ring-1 focus:ring-accent/50 transition-all duration-300 text-white placeholder-text-muted"
                                placeholder="your@email.com"
                                required
                                autofocus
                            />
                        </div>
                    </div>

                    {{-- Password --}}
                    <div class="mb-6">
                        <label for="password" class="block text-sm font-medium mb-2">Password</label>
                        <div class="relative" x-data="{ show: false }">
                            <div class="absolute left-4 top-1/2 -translate-y-1/2">
                                <svg class="w-5 h-5 text-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                            <input
                                :type="show ? 'text' : 'password'"
                                id="password"
                                name="password"
                                class="w-full pl-12 pr-12 py-4 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent focus:ring-1 focus:ring-accent/50 transition-all duration-300 text-white placeholder-text-muted"
                                placeholder="Enter your password"
                                required
                            />
                            <button 
                                type="button" 
                                @click="show = !show"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-text-muted hover:text-white transition-colors"
                            >
                                <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                <svg x-show="show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-cloak>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- Remember Me --}}
                    <div class="mb-8 flex items-center justify-between">
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <div class="relative">
                                <input
                                    type="checkbox"
                                    id="remember"
                                    name="remember"
                                    class="peer sr-only"
                                />
                                <div class="w-5 h-5 rounded-md border border-white/20 bg-[var(--color-bg-primary)] peer-checked:bg-accent peer-checked:border-accent transition-all duration-300 flex items-center justify-center">
                                    <svg class="w-3 h-3 text-white opacity-0 peer-checked:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                            </div>
                            <span class="text-sm text-text-muted group-hover:text-white transition-colors">Remember me</span>
                        </label>
                    </div>

                    {{-- Submit --}}
                    <button
                        type="submit"
                        class="group relative w-full py-4 overflow-hidden rounded-xl font-semibold text-white transition-all duration-300"
                    >
                        <span class="absolute inset-0 bg-gradient-to-r from-accent to-accent-2"></span>
                        <span class="absolute inset-0 bg-gradient-to-r from-accent-2 to-accent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></span>
                        <span class="relative flex items-center justify-center gap-2">
                            Sign In
                            <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </span>
                    </button>
                </div>
            </form>

            {{-- Back Link --}}
            <div class="text-center mt-8">
                <a href="{{ route('home') }}" class="group inline-flex items-center gap-2 text-text-muted hover:text-white transition-colors">
                    <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"></path>
                    </svg>
                    Back to website
                </a>
            </div>
        </div>
    </div>
</body>
</html>
