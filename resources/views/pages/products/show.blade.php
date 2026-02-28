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

                    <!-- Variants (If Any) -->
                    @if($product->variants->isNotEmpty())
                        <div class="space-y-6">
                            <h4 class="text-xs uppercase tracking-[0.2em] font-bold">Available Variants</h4>
                            <div class="grid grid-cols-1 gap-4">
                                @foreach($product->variants as $variant)
                                    <div
                                        class="flex items-center justify-between p-4 border border-brand-stone bg-brand-stone/10 group hover:border-brand-sand hover:bg-white transition-all">
                                        <div class="space-y-1">
                                            <span class="text-sm font-medium block">{{ $variant->name }}</span>
                                            <span class="text-[10px] text-brand-charcoal/40 uppercase tracking-widest">
                                                {{ $variant->size }} • {{ $variant->finish }} • {{ $variant->thickness }}
                                            </span>
                                        </div>
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