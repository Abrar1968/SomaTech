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
</head>
<body class="antialiased bg-[var(--color-bg-primary)] min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md px-6">
        {{-- Logo --}}
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-flex items-center space-x-2">
                <div class="w-12 h-12 bg-gradient-to-br from-[var(--color-accent)] to-[var(--color-accent-2)] rounded-xl flex items-center justify-center">
                    <span class="text-white font-bold text-2xl">S</span>
                </div>
                <span class="text-2xl font-bold font-display">Somaticx</span>
            </a>
            <h1 class="text-2xl font-semibold mt-6">Admin Login</h1>
            <p class="text-[var(--color-text-muted)] mt-2">Sign in to access the admin panel</p>
        </div>

        {{-- Login Form --}}
        <form method="POST" action="{{ route('login.store') }}" class="glass rounded-2xl p-8 border border-[var(--color-border)]">
            @csrf

            {{-- Error Message --}}
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 rounded-lg">
                    <p class="text-red-400 text-sm">{{ $errors->first() }}</p>
                </div>
            @endif

            {{-- Email --}}
            <div class="mb-6">
                <label for="email" class="block text-sm font-medium mb-2">Email Address</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="w-full px-4 py-3 bg-[var(--color-bg-surface)] border border-[var(--color-border)] rounded-lg focus:outline-none focus:border-[var(--color-accent)] transition-colors"
                    required
                    autofocus
                />
            </div>

            {{-- Password --}}
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium mb-2">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="w-full px-4 py-3 bg-[var(--color-bg-surface)] border border-[var(--color-border)] rounded-lg focus:outline-none focus:border-[var(--color-accent)] transition-colors"
                    required
                />
            </div>

            {{-- Remember Me --}}
            <div class="mb-6 flex items-center">
                <input
                    type="checkbox"
                    id="remember"
                    name="remember"
                    class="w-4 h-4 rounded border-[var(--color-border)] bg-[var(--color-bg-surface)] text-[var(--color-accent)] focus:ring-[var(--color-accent)]"
                />
                <label for="remember" class="ml-2 text-sm text-[var(--color-text-muted)]">Remember me</label>
            </div>

            {{-- Submit --}}
            <button
                type="submit"
                class="w-full px-6 py-3 bg-gradient-to-r from-[var(--color-accent)] to-[var(--color-accent-2)] text-white rounded-lg font-semibold hover:scale-[1.02] transition-transform"
            >
                Sign In
            </button>
        </form>

        {{-- Back Link --}}
        <div class="text-center mt-6">
            <a href="{{ route('home') }}" class="text-[var(--color-text-muted)] hover:text-white text-sm transition-colors">
                &larr; Back to website
            </a>
        </div>
    </div>
</body>
</html>
