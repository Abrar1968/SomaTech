@props(['images' => [], 'columns' => 3])

@if(count($images) > 0)
<div
    class="grid grid-cols-2 md:grid-cols-{{ $columns }} gap-4"
    x-data="{ lightbox: null, activeImage: 0 }"
>
    @foreach($images as $index => $image)
        <a
            href="{{ $image }}"
            class="glightbox group relative aspect-video rounded-2xl overflow-hidden border border-white/5 hover:border-accent/30 transition-all duration-500"
            data-gallery="project-gallery"
            x-data="{ visible: false }"
            x-intersect.once="setTimeout(() => visible = true, {{ $index * 80 }})"
            :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
            style="transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);"
        >
            {{-- Image --}}
            <img
                src="{{ $image }}"
                alt="Gallery image {{ $index + 1 }}"
                loading="lazy"
                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
            />

            {{-- Gradient overlay --}}
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

            {{-- Hover content --}}
            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-500">
                <span class="flex items-center justify-center w-16 h-16 rounded-2xl bg-white/10 backdrop-blur-sm border border-white/20 transform scale-50 group-hover:scale-100 transition-transform duration-500">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                    </svg>
                </span>
            </div>

            {{-- Image number indicator --}}
            <div class="absolute bottom-4 right-4 px-3 py-1 rounded-lg bg-black/50 backdrop-blur-sm text-white text-sm font-medium opacity-0 group-hover:opacity-100 transition-opacity duration-500 transform translate-y-2 group-hover:translate-y-0">
                {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}/{{ str_pad(count($images), 2, '0', STR_PAD_LEFT) }}
            </div>

            {{-- Corner accent --}}
            <div class="absolute -top-12 -right-12 w-24 h-24 bg-accent/30 rounded-full blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
        </a>
    @endforeach
</div>

{{-- Gallery counter bar --}}
@if(count($images) > 3)
<div class="mt-8 flex items-center justify-center gap-2">
    <span class="text-sm text-text-muted">{{ count($images) }} images in gallery</span>
    <span class="text-text-muted">•</span>
    <span class="text-sm text-accent">Click to view fullscreen</span>
</div>
@endif
@endif

@pushOnce('scripts')
<script>
    // GLightbox will be initialized in app.js after the library is loaded
</script>
@endPushOnce
