@props(['product'])

<div class="group reveal reveal-up">
    <div class="relative aspect-[4/5] overflow-hidden bg-brand-stone mb-6">
        <img src="{{ $product['images'][0] ?? '/images/placeholder.jpg' }}" alt="{{ $product['name'] }}"
            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
        <div
            class="absolute inset-0 bg-brand-charcoal/0 group-hover:bg-brand-charcoal/5 transition-colors duration-500">
        </div>
    </div>
    <div class="space-y-2">
        <div class="flex justify-between items-start">
            <h3 class="text-lg font-serif">{{ $product['name'] }}</h3>
            <span
                class="text-xs uppercase tracking-widest text-brand-charcoal/40">{{ $product->category->name ?? $product['category'] }}</span>
        </div>
        <p class="text-xs text-brand-charcoal/60 uppercase tracking-tighter">{{ $product['finish'] }} •
            {{ $product['size'] }}
        </p>
        <a href="{{ url(app()->getLocale() . '/products/' . $product['id']) }}"
            class="inline-block text-xs uppercase tracking-widest border-b border-brand-charcoal/20 pb-1 mt-4 hover:border-brand-charcoal transition-colors">
            {{ __('messages.cta.browse') }}
        </a>
    </div>
</div>