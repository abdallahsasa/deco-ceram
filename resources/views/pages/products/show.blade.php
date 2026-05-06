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

            <div class="space-y-24">
                <!-- 1. Hero Gallery Section -->
                <div class="space-y-8 reveal reveal-up">
                    <div class="aspect-[21/9] bg-brand-stone overflow-hidden shadow-2xl">
                        <img src="{{ $product->primary_image_url }}" alt="{{ $product->name }}"
                            class="w-full h-full object-cover">
                    </div>
                    @if(count($product->gallery_urls) > 1)
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                            @foreach(array_slice($product->gallery_urls, 1) as $image)
                                <div class="aspect-[4/3] bg-brand-stone overflow-hidden cursor-pointer hover:opacity-80 transition-opacity">
                                    <img src="{{ $image }}" alt="{{ $product->name }} view" class="w-full h-full object-cover">
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- 2. Product Information & Description -->
                <div class="max-w-4xl mx-auto text-center space-y-12 reveal reveal-up">
                    <div class="space-y-6">
                        <div class="flex items-center justify-center gap-4">
                            <span class="text-xs uppercase tracking-[0.3em] text-brand-sand font-black">{{ $brand->name }}</span>
                            <span class="w-1.5 h-1.5 bg-brand-stone rounded-full"></span>
                            <span class="text-xs uppercase tracking-[0.3em] text-brand-charcoal/40 font-medium">{{ $collection->name }}</span>
                        </div>
                        <h1 class="text-5xl md:text-7xl font-serif leading-tight">{{ $product->name }}</h1>
                        <p class="text-brand-charcoal/60 text-xl font-light leading-relaxed max-w-2xl mx-auto italic">
                            {{ $product->description }}
                        </p>
                    </div>

                    <!-- Technical Quick Specs Bar -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-8 border-y border-brand-stone py-10">
                        <div class="space-y-1">
                            <span class="text-[10px] uppercase tracking-[0.2em] text-brand-charcoal/40 block font-bold">Material</span>
                            <span class="text-sm font-medium tracking-tight">{{ $product->material }}</span>
                        </div>
                        <div class="space-y-1">
                            <span class="text-[10px] uppercase tracking-[0.2em] text-brand-charcoal/40 block font-bold">Look</span>
                            <span class="text-sm font-medium tracking-tight">{{ $product->look }}</span>
                        </div>
                        <div class="space-y-1">
                            <span class="text-[10px] uppercase tracking-[0.2em] text-brand-charcoal/40 block font-bold">Finish</span>
                            <span class="text-sm font-medium tracking-tight">{{ $product->finish }}</span>
                        </div>
                        <div class="space-y-1">
                            <span class="text-[10px] uppercase tracking-[0.2em] text-brand-charcoal/40 block font-bold">Thickness</span>
                            <span class="text-sm font-medium tracking-tight">{{ $product->thickness }}</span>
                        </div>
                    </div>
                </div>

                <!-- 3. Formats & Specifications Grid -->
                @if($product->variants->isNotEmpty())
                    <div class="space-y-12 reveal reveal-up">
                        <div class="text-center space-y-2">
                            <h2 class="text-3xl font-serif">Available Formats</h2>
                            <p class="text-[10px] uppercase tracking-[0.3em] text-brand-charcoal/40">Technical Specifications per Size</p>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                            @foreach($product->variants as $variant)
                                <div class="bg-white border border-brand-stone p-8 space-y-8 hover:shadow-xl transition-all duration-500 group">
                                    <!-- Header -->
                                    <div class="space-y-2">
                                        <div class="flex justify-between items-start">
                                            <span class="text-[10px] font-mono text-brand-charcoal/30 uppercase tracking-tighter">{{ $variant->sku ?? 'No SKU' }}</span>
                                            <span class="text-[9px] uppercase tracking-widest text-brand-sand font-black px-2 py-1 bg-brand-sand/5">{{ $variant->finish }}</span>
                                        </div>
                                        <h5 class="text-2xl font-serif group-hover:text-brand-sand transition-colors">{{ $variant->sizeModel?->name ?? $variant->size }}</h5>
                                    </div>

                                    <!-- Specs Grid -->
                                    <div class="grid grid-cols-2 gap-8 pt-6 border-t border-brand-stone/40">
                                        <!-- Box -->
                                        <div class="space-y-4">
                                            <h6 class="text-[9px] uppercase tracking-[0.3em] font-black text-brand-charcoal/30">Box Packaging</h6>
                                            <div class="space-y-2">
                                                <div class="flex justify-between text-xs">
                                                    <span class="text-brand-charcoal/40">Pieces</span>
                                                    <span class="font-bold tracking-tighter">{{ $variant->sizeModel?->pcs_per_box ?? '-' }}</span>
                                                </div>
                                                <div class="flex justify-between text-xs">
                                                    <span class="text-brand-charcoal/40">Surface</span>
                                                    <span class="font-bold tracking-tighter">{{ number_format($variant->sizeModel?->sqm_per_box ?? 0, 2) }} m²</span>
                                                </div>
                                                <div class="flex justify-between text-xs">
                                                    <span class="text-brand-charcoal/40">Weight</span>
                                                    <span class="font-bold tracking-tighter">~{{ $variant->sizeModel?->kg_per_box ?? '-' }} kg</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Pallet -->
                                        <div class="space-y-4">
                                            <h6 class="text-[9px] uppercase tracking-[0.3em] font-black text-brand-charcoal/30">Pallet Packaging</h6>
                                            <div class="space-y-2">
                                                <div class="flex justify-between text-xs">
                                                    <span class="text-brand-charcoal/40">Boxes</span>
                                                    <span class="font-bold tracking-tighter">{{ $variant->sizeModel?->boxes_per_pallet ?? '-' }}</span>
                                                </div>
                                                <div class="flex justify-between text-xs">
                                                    <span class="text-brand-charcoal/40">Surface</span>
                                                    <span class="font-bold tracking-tighter">{{ number_format($variant->sizeModel?->sqm_per_pallet ?? 0, 2) }} m²</span>
                                                </div>
                                                <div class="flex justify-between text-xs">
                                                    <span class="text-brand-charcoal/40">Weight</span>
                                                    <span class="font-bold tracking-tighter">~{{ $variant->sizeModel?->kg_per_pallet ?? '-' }} kg</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- 4. Final Details & Action -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 pt-12 border-t border-brand-stone reveal reveal-up">
                    <!-- Left: Technical Specs Table -->
                    @if(!empty($product->technical_specs))
                        <div class="space-y-8">
                            <h4 class="text-xs uppercase tracking-[0.2em] font-bold">Comprehensive Technical Data</h4>
                            <div class="space-y-0">
                                @foreach($product->technical_specs as $key => $value)
                                    <div class="flex justify-between py-5 border-b border-brand-stone/40">
                                        <span class="text-[10px] uppercase tracking-widest text-brand-charcoal/60">{{ $key }}</span>
                                        <span class="text-sm font-bold tracking-tight">{{ $value }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Right: Downloads & CTA -->
                    <div class="space-y-12">
                        @if(!empty($product->downloads))
                            <div class="space-y-8">
                                <h4 class="text-xs uppercase tracking-[0.2em] font-bold">Resources & Downloads</h4>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    @foreach($product->downloads as $download)
                                        <a href="{{ $download['url'] }}"
                                            class="flex items-center justify-between p-6 border border-brand-stone hover:bg-brand-stone/10 transition-all group">
                                            <span class="text-[10px] uppercase tracking-widest font-bold">{{ $download['name'] }}</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" class="w-4 h-4 text-brand-sand group-hover:translate-y-1 transition-transform">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                            </svg>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div class="space-y-6">
                            <h4 class="text-xs uppercase tracking-[0.2em] font-bold">Start your project</h4>
                            <div class="flex flex-col sm:flex-row gap-4">
                                <a href="{{ route('contact', ['locale' => app()->getLocale(), 'subject' => 'Quote Request: ' . $product->name]) }}"
                                    class="btn-premium flex-1 text-center py-6">
                                    Request a Quote
                                </a>
                                <a href="{{ route('contact', ['locale' => app()->getLocale(), 'subject' => 'Sample Request: ' . $product->name]) }}"
                                    class="btn-premium-outline flex-1 text-center py-6">
                                    Order Physical Sample
                                </a>
                            </div>
                            <p class="text-[9px] text-brand-charcoal/40 uppercase tracking-widest text-center mt-4">Typical response time: < 24 hours</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection