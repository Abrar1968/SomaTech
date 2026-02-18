@props(['name', 'icon' => null, 'variant' => 'default', 'size' => 'sm'])

@php
    $baseClasses = 'inline-flex items-center gap-1.5 font-medium transition-all duration-300';

    $sizeClasses = match($size) {
        'xs' => 'px-2 py-0.5 text-[10px] rounded',
        'sm' => 'px-3 py-1 text-xs rounded-md',
        'md' => 'px-4 py-1.5 text-sm rounded-lg',
        'lg' => 'px-5 py-2 text-base rounded-xl',
        default => 'px-3 py-1 text-xs rounded-md',
    };

    $variantClasses = match($variant) {
        'primary' => 'bg-accent/20 text-accent border border-accent/20 hover:bg-accent/30 hover:border-accent/40',
        'secondary' => 'bg-accent-2/20 text-accent-2 border border-accent-2/20 hover:bg-accent-2/30 hover:border-accent-2/40',
        'outline' => 'bg-transparent text-white border border-white/20 hover:border-white/40 hover:bg-white/5',
        'glass' => 'bg-white/10 backdrop-blur-sm text-white border border-white/10 hover:bg-white/15',
        'solid' => 'bg-accent text-white border border-accent hover:bg-accent/90',
        'gradient' => 'bg-gradient-to-r from-accent/20 to-accent-2/20 text-white border border-white/10 hover:from-accent/30 hover:to-accent-2/30',
        default => 'bg-white/5 text-text-muted border border-white/5 hover:border-accent/30 hover:text-accent',
    };
@endphp

<span {{ $attributes->merge(['class' => "$baseClasses $sizeClasses $variantClasses"]) }}>
    @if($icon)
        <span class="w-3.5 h-3.5 flex-shrink-0">{!! $icon !!}</span>
    @else
        <span class="w-1.5 h-1.5 rounded-full bg-current opacity-60 animate-pulse"></span>
    @endif
    {{ $name }}
</span>
