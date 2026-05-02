@extends('layouts.app')

@section('title', $product->name . ' - ' . $collection->name . ' | Deco & Ceram')

@section('content')
    <section class="pt-32 pb-24">
        <div class="container mx-auto px-6">
            <!-- Breadcrumb -->
            <nav class="flex mb-12 text-xs uppercase tracking-widest text-brand-charcoal/40" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2">
                    <li><a href="{{ route('products', app()->getLocale()) }}"
                            class="hover:text-brand-sand transition-colors">Products</a></li>
                    <li><span class="mx-2">/</span></li>
                    <li><a href="{{ route('products.brand', ['locale' => app()->getLocale(), 'brand' => $brand->slug]) }}"
                            class="hover:text-brand-sand transition-colors">{{ $brand->name }}</a></li>
                    <li><span class="mx-2">/</span></li>
                    <li><a href="{{ route('products.collection', ['locale' => app()->getLocale(), 'brand' => $brand->slug, 'collection' => $collection->slug]) }}"
                            class="hover:text-brand-sand transition-colors">{{ $collection->name }}</a></li>
                    <li><span class="mx-2">/</span></li>
                    <li class="text-brand-charcoal font-medium">{{ $product->name }}</li>
                </ol>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-20">
                <!-- Gallery -->
                <div class="space-y-6 reveal reveal-left">
                    <div class="aspect-[4/5] bg-brand-stone overflow-hidden">
                        <img src="{{ $product->images[0] ?? '/images/placeholder.jpg' }}" alt="{{ $product->name }}"
                            class="w-full h-full object-cover">
                    </div>
                    <div class="grid grid-cols-4 gap-4">
                        @foreach($product->images as $image)
                            <div
                                class="aspect-square bg-brand-stone overflow-hidden cursor-pointer hover:opacity-80 transition-opacity">
                                <img src="{{ $image }}" alt="{{ $product->name }} view" class="w-full h-full object-cover">
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Info -->
                <div class="space-y-12 reveal reveal-right">
                    <div class="space-y-4">
                        <div class="flex items-center gap-4">
                            <span
                                class="text-xs uppercase tracking-widest text-brand-sand font-bold">{{ $product->collection->brand->name }}</span>
                            <span class="w-1 h-1 bg-brand-stone rounded-full"></span>
                            <span
                                class="text-xs uppercase tracking-widest text-brand-charcoal/40">{{ $product->collection->name }}</span>
                        </div>
                        <h1 class="text-4xl md:text-5xl font-serif">{{ $product->name }}</h1>
                        <p class="text-brand-charcoal/60 text-lg font-light leading-relaxed">
                            {{ $product->description }}
                        </p>
                    </div>

                    <!-- Technical Quick Specs -->
                    <div class="grid grid-cols-2 gap-y-8 gap-x-12 border-y border-brand-stone py-8">
                        <div>
                            <span
                                class="text-[10px] uppercase tracking-widest text-brand-charcoal/40 block mb-1">Material</span>
                            <span class="text-sm font-medium">{{ $product->material }}</span>
                        </div>
                        <div>
                            <span
                                class="text-[10px] uppercase tracking-widest text-brand-charcoal/40 block mb-1">Look</span>
                            <span class="text-sm font-medium">{{ $product->look }}</span>
                        </div>
                        <div>
                            <span
                                class="text-[10px] uppercase tracking-widest text-brand-charcoal/40 block mb-1">Finish</span>
                            <span class="text-sm font-medium">{{ $product->finish }}</span>
                        </div>
                        <div>
                            <span
                                class="text-[10px] uppercase tracking-widest text-brand-charcoal/40 block mb-1">Thickness</span>
                            <span class="text-sm font-medium">{{ $product->thickness }}</span>
                        </div>
                    </div>

                    <!-- Variants & Sizes -->
                    @if($product->variants->isNotEmpty())
                        <div class="space-y-6">
                            <h4 class="text-xs uppercase tracking-[0.2em] font-bold">{{ __('messages.products.variants.title') }}</h4>
                            <div class="space-y-4">
                                @foreach($product->variants as $variant)
                                    <div class="border border-brand-stone bg-brand-stone/5 overflow-hidden">
                                        <div class="p-4 bg-brand-stone/10 border-b border-brand-stone flex justify-between items-center">
                                            <div>
                                                <span class="text-sm font-bold">{{ $variant->sizeModel?->name ?? $variant->size }}</span>
                                                <span class="mx-2 text-brand-charcoal/20">|</span>
                                                <span class="text-xs uppercase tracking-widest text-brand-charcoal/60">{{ $variant->finish }}</span>
                                            </div>
                                            @if($variant->price_full_pallet)
                                                <div class="text-right">
                                                    <span class="text-[10px] uppercase tracking-tighter text-brand-charcoal/40 block">{{ __('messages.products.variants.starting_from') }}</span>
                                                    <span class="text-sm font-bold text-brand-sand">{{ $variant->price_full_pallet }}€ / m²</span>
                                                </div>
                                            @endif
                                        </div>
                                        
                                        @if($variant->sizeModel)
                                            <div class="px-5 py-12 border-t border-brand-stone bg-brand-stone/5">
                                                <div class="flex flex-col md:flex-row gap-16 md:gap-24 px-2">
                                                    <!-- Box Specs -->
                                                    <div class="flex-1 space-y-6">
                                                        <h5 class="text-[8px] uppercase tracking-[0.3em] font-black text-brand-charcoal/40 mb-8 border-b border-brand-stone pb-2">Packaging / Box</h5>
                                                        <div class="flex items-center justify-between">
                                                            <div class="flex items-center gap-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-brand-charcoal/30"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M3 9h18"/><path d="M3 15h18"/><path d="M9 3v18"/><path d="M15 3v18"/></svg>
                                                                <span class="text-[9px] uppercase tracking-widest text-brand-charcoal/60">Pieces</span>
                                                            </div>
                                                            <span class="text-xs font-bold text-brand-charcoal">{{ $variant->sizeModel->pcs_per_box }}</span>
                                                        </div>
                                                        <div class="flex items-center justify-between">
                                                            <div class="flex items-center gap-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-brand-charcoal/30"><path d="M21 3H3v18h18V3z"/><path d="M3 9h18"/><path d="M9 3v18"/></svg>
                                                                <span class="text-[9px] uppercase tracking-widest text-brand-charcoal/60">Surface</span>
                                                            </div>
                                                            <span class="text-xs font-bold text-brand-charcoal">{{ number_format($variant->sizeModel->sqm_per_box, 2) }} m²</span>
                                                        </div>
                                                        <div class="flex items-center justify-between">
                                                            <div class="flex items-center gap-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-brand-charcoal/30"><path d="m12 2 10 7L12 16 2 9l10-7Z"/><path d="M2 9v7l10 7 10-7V9"/><path d="m2 9 10 7 10-7"/></svg>
                                                                <span class="text-[9px] uppercase tracking-widest text-brand-charcoal/60">Weight</span>
                                                            </div>
                                                            <span class="text-xs font-bold text-brand-charcoal">~{{ $variant->sizeModel->kg_per_box ?? '-' }} kg</span>
                                                        </div>
                                                    </div>

                                                    <!-- Pallet Specs -->
                                                    <div class="flex-1 space-y-6">
                                                        <h5 class="text-[8px] uppercase tracking-[0.3em] font-black text-brand-charcoal/40 mb-8 border-b border-brand-stone pb-2">Packaging / Pallet</h5>
                                                        <div class="flex items-center justify-between">
                                                            <div class="flex items-center gap-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-brand-charcoal/30"><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><path d="m3.3 7 8.7 5 8.7-5"/><path d="M12 22V12"/></svg>
                                                                <span class="text-[9px] uppercase tracking-widest text-brand-charcoal/60">Boxes</span>
                                                            </div>
                                                            <span class="text-xs font-bold text-brand-charcoal">{{ $variant->sizeModel->boxes_per_pallet }}</span>
                                                        </div>
                                                        <div class="flex items-center justify-between">
                                                            <div class="flex items-center gap-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-brand-charcoal/30"><path d="M21 3H3v18h18V3z"/><path d="M3 9h18"/><path d="M9 3v18"/></svg>
                                                                <span class="text-[9px] uppercase tracking-widest text-brand-charcoal/60">Surface</span>
                                                            </div>
                                                            <span class="text-xs font-bold text-brand-charcoal">{{ number_format($variant->sizeModel->sqm_per_pallet, 2) }} m²</span>
                                                        </div>
                                                        <div class="flex items-center justify-between">
                                                            <div class="flex items-center gap-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-brand-charcoal/30"><path d="m12 2 10 7L12 16 2 9l10-7Z"/><path d="M2 9v7l10 7 10-7V9"/><path d="m2 9 10 7 10-7"/></svg>
                                                                <span class="text-[9px] uppercase tracking-widest text-brand-charcoal/60">Weight</span>
                                                            </div>
                                                            <span class="text-xs font-bold text-brand-charcoal">~{{ $variant->sizeModel->kg_per_pallet ?? '-' }} kg</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        
                                        @if($variant->price_partial_pallet && $variant->price_partial_pallet != $variant->price_full_pallet)
                                            <div class="px-4 pb-4 flex justify-end">
                                                <div class="text-[10px] text-brand-charcoal/40 italic">
                                                    {{ __('messages.products.variants.partial_pallet') }} <span class="text-brand-charcoal font-medium not-italic">{{ $variant->price_partial_pallet }}€ / m²</span>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- CTAs -->
                    <div class="flex flex-wrap gap-4 pt-4">
                        <a href="{{ route('contact', ['locale' => app()->getLocale(), 'subject' => 'Quote Request: ' . $product->name]) }}"
                            class="btn-premium flex-1 text-center">
                            Request a Quote
                        </a>
                        <a href="{{ route('contact', ['locale' => app()->getLocale(), 'subject' => 'Sample Request: ' . $product->name]) }}"
                            class="btn-premium-outline flex-1 text-center">
                            Request Sample
                        </a>
                    </div>

                    <!-- Technical Details Table -->
                    @if(!empty($product->technical_specs))
                        <div class="space-y-6 pt-8">
                            <h4 class="text-xs uppercase tracking-[0.2em] font-bold">Technical Specifications</h4>
                            <div class="border-t border-brand-stone">
                                @foreach($product->technical_specs as $key => $value)
                                    <div class="flex justify-between py-4 border-b border-brand-stone/40">
                                        <span class="text-xs uppercase tracking-widest text-brand-charcoal/60">{{ $key }}</span>
                                        <span class="text-xs font-bold">{{ $value }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Downloads -->
                    @if(!empty($product->downloads))
                        <div class="space-y-6 pt-8">
                            <h4 class="text-xs uppercase tracking-[0.2em] font-bold">Downloads</h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                @foreach($product->downloads as $download)
                                    <a href="{{ $download['url'] }}"
                                        class="flex items-center gap-3 p-4 border border-brand-stone hover:bg-brand-stone/20 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                            stroke="currentColor" class="w-5 h-5 text-brand-sand">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                        </svg>
                                        <span
                                            class="text-[10px] uppercase tracking-widest font-medium">{{ $download['name'] }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection