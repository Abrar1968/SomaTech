<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow"> {{-- SRS CONST-007 --}}

    <title>{{ $title ?? 'Dashboard' }} - SomaTech Admin</title>

    {{-- Preconnect for fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@600;700;800&family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/admin.js'])
</head>
<body class="bg-[var(--color-bg-surface)]">
    <div class="flex h-screen">
        {{-- Sidebar --}}
        <aside class="w-64 bg-[var(--color-bg-primary)] border-r border-[var(--color-border)] flex-shrink-0">
            <x-admin.sidebar />
        </aside>

        {{-- Main Content --}}
        <div class="flex-1 flex flex-col overflow-hidden">
            {{-- Top Bar --}}
            <header class="h-16 bg-[var(--color-bg-surface)] border-b border-[var(--color-border)] flex items-center justify-between px-6 flex-shrink-0">
                <h1 class="text-xl font-semibold">{{ $title ?? 'Dashboard' }}</h1>
                <x-admin.user-menu />
            </header>

            {{-- Content Area --}}
            <main class="flex-1 overflow-y-auto p-6">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>
