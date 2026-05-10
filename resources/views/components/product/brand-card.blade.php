@props(['brand'])

<div class="group reveal reveal-up">
    <a href="{{ route('products.brand', ['locale' => app()->getLocale(), 'brand' => $brand->slug]) }}" class="block">
        <div class="relative aspect-video overflow-hidden bg-brand-stone mb-6">
            <img src="{{ $brand->hero_image_url }}" alt="{{ $brand->name }}"
                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
            <div class="absolute inset-0 bg-brand-charcoal/40 flex items-center justify-center">
                <div class="bg-white/90 p-6 backdrop-blur-sm">
                    <img src="{{ $brand->logo_url }}" alt="{{ $brand->name }} Logo" class="h-12 w-auto object-contain">
                </div>
            </div>
            @if($brand->official_distributor)
                <div class="absolute top-4 right-4 animate-fade-in">
                    <span
                        class="bg-brand-charcoal text-white text-[10px] uppercase tracking-[0.2em] px-3 py-1.5 backdrop-blur-md bg-opacity-80 border border-white/20">
                        {{ __('messages.products.official_distributor') }}
                    </span>
                </div>
            @endif
        </div>
        <div class="space-y-2">
            <h3 class="text-xl font-serif">{{ $brand->name }}</h3>
            <p class="text-sm text-brand-charcoal/60 line-clamp-2 leading-relaxed">
                {{ $brand->description }}
            </p>
            <span
                class="inline-block text-xs uppercase tracking-widest border-b border-brand-charcoal/20 pb-1 mt-4 group-hover:border-brand-charcoal transition-colors">
                {{ __('messages.products.explore_collections_btn') }}
            </span>
        </div>
    </a>
</div>