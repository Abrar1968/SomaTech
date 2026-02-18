@props(['items' => []])

@php
    $crumbs = $items;
    $jsonLd = [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => collect($crumbs)->map(function ($crumb, $index) {
            return [
                '@type' => 'ListItem',
                'position' => $index + 1,
                'name' => $crumb['label'],
                'item' => $crumb['url'] ?? null,
            ];
        })->toArray(),
    ];
@endphp

@if(count($crumbs) > 0)
<nav
    aria-label="Breadcrumb"
    class="mb-8"
    x-data="{ visible: false }"
    x-intersect.once="visible = true"
    :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-2'"
    style="transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);"
>
    <ol class="flex items-center flex-wrap gap-1 text-sm">
        {{-- Home icon --}}
        <li class="flex items-center">
            <a href="{{ route('home') }}" class="group flex items-center justify-center w-8 h-8 rounded-lg hover:bg-white/5 text-text-muted hover:text-accent transition-all duration-300" aria-label="Home">
                <svg class="w-4 h-4 transform group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
            </a>
        </li>

        @foreach($crumbs as $index => $crumb)
            {{-- Skip "Home" if it's already shown as an icon --}}
            @if(strtolower($crumb['label']) === 'home')
                @continue
            @endif

            <li class="flex items-center">
                {{-- Separator --}}
                <svg class="w-4 h-4 text-white/20 mx-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>

                @if($loop->last)
                    <span class="px-3 py-1.5 rounded-lg bg-white/5 text-white font-medium border border-white/10" aria-current="page">
                        {{ $crumb['label'] }}
                    </span>
                @else
                    <a
                        href="{{ $crumb['url'] }}"
                        class="group relative px-3 py-1.5 rounded-lg text-text-muted hover:text-white transition-colors duration-300"
                    >
                        <span class="relative z-10">{{ $crumb['label'] }}</span>
                        <span class="absolute inset-0 rounded-lg bg-white/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                    </a>
                @endif
            </li>
        @endforeach
    </ol>
</nav>

{{-- Structured Data - JSON-LD --}}
<script type="application/ld+json">
    {!! json_encode($jsonLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@endif
