@extends('layouts.app')

@section('title', $product['name'] . ' | Deco & Ceram')

@section('content')
    <div class="py-8 bg-brand-white border-b border-brand-stone">
        <div class="container mx-auto px-6">
            <nav class="flex text-xs uppercase tracking-widest gap-2 text-brand-charcoal/40 mb-4">
                <a href="{{ url(app()->getLocale() . '/') }}"
                    class="hover:text-brand-charcoal transition-colors">{{ __('messages.nav.about') }}</a>
                <span>/</span>
                <a href="{{ url(app()->getLocale() . '/products') }}"
                    class="hover:text-brand-charcoal transition-colors">{{ __('messages.products.catalog') }}</a>
                <span>/</span>
                <span>{{ __('messages.categories.' . Str::slug($product->category->id ?? $product['category'])) }}</span>
            </nav>
            <h1 class="text-3xl md:text-4xl font-serif">{{ $product['name'] }}</h1>
        </div>
    </div>

    <section class="py-20 lg:py-32">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-20">
                <!-- Gallery -->
                <div class="space-y-4 reveal animate-fade-in">
                    <div class="aspect-[4/5] bg-brand-stone overflow-hidden">
                        <img src="{{ $product['images'][0] ?? '/images/placeholder.jpg' }}" alt="{{ $product['name'] }}"
                            class="w-full h-full object-cover">
                    </div>
                    <div class="grid grid-cols-4 gap-4">
                        @foreach($product['images'] as $image)
                            <div
                                class="aspect-square bg-brand-stone overflow-hidden cursor-pointer hover:opacity-80 transition-opacity">
                                <img src="{{ $image }}" alt="{{ $product['name'] }}" class="w-full h-full object-cover">
                            </div>
                        @endforeach
                        <!-- Add a few placeholders if only one image -->
                        @if(count($product['images']) < 4)
                            @for($i = 0; $i < 4 - count($product['images']); $i++)
                                <div
                                    class="aspect-square bg-brand-stone/50 border border-brand-stone flex items-center justify-center">
                                    <span class="text-[10px] uppercase tracking-tighter opacity-20 italic">Sample View</span>
                                </div>
                            @endfor
                        @endif
                    </div>
                </div>

                <!-- Product Info -->
                <div class="space-y-12 reveal reveal-up">
                    <div class="space-y-6">
                        <div class="space-y-2">
                            <span
                                class="text-xs uppercase tracking-widest text-brand-sand font-bold">{{ $product['collection'] }}</span>
                            <h2 class="text-4xl font-serif">{{ $product['name'] }}</h2>
                        </div>
                        <p class="text-lg text-brand-charcoal/80 font-light leading-relaxed">
                            {{ $product['description'] }}
                        </p>
                    </div>

                    <!-- Applications -->
                    <div class="space-y-4">
                        <h4 class="text-xs font-bold uppercase tracking-widest border-b border-brand-stone pb-2">
                            {{ __('messages.products.applications') }}
                        </h4>
                        <div class="flex flex-wrap gap-2">
                            @foreach($product['applications'] as $app)
                                <span
                                    class="px-4 py-1 bg-brand-stone/40 text-[10px] uppercase tracking-widest font-medium">{{ $app }}</span>
                            @endforeach
                        </div>
                    </div>

                    <!-- Technical Specs -->
                    <div class="space-y-4">
                        <h4 class="text-xs font-bold uppercase tracking-widest border-b border-brand-stone pb-2">
                            {{ __('messages.products.specs') }}
                        </h4>
                        <table class="w-full text-sm">
                            <tr class="border-b border-brand-stone/50">
                                <td class="py-4 text-brand-charcoal/50 uppercase tracking-tighter text-[11px]">
                                    {{ __('messages.products.attributes.material') }}
                                </td>
                                <td class="py-4 text-right font-medium">{{ $product['material'] }}</td>
                            </tr>
                            <tr class="border-b border-brand-stone/50">
                                <td class="py-4 text-brand-charcoal/50 uppercase tracking-tighter text-[11px]">
                                    {{ __('messages.products.attributes.finish') }}
                                </td>
                                <td class="py-4 text-right font-medium">{{ $product['finish'] }}</td>
                            </tr>
                            <tr class="border-b border-brand-stone/50">
                                <td class="py-4 text-brand-charcoal/50 uppercase tracking-tighter text-[11px]">
                                    {{ __('messages.products.attributes.size') }}
                                </td>
                                <td class="py-4 text-right font-medium">{{ $product['size'] }}</td>
                            </tr>
                            <tr class="border-b border-brand-stone/50">
                                <td class="py-4 text-brand-charcoal/50 uppercase tracking-tighter text-[11px]">
                                    {{ __('messages.products.attributes.thickness') }}
                                </td>
                                <td class="py-4 text-right font-medium">{{ $product['thickness'] }}</td>
                            </tr>
                            <tr class="border-b border-brand-stone/50">
                                <td class="py-4 text-brand-charcoal/50 uppercase tracking-tighter text-[11px]">
                                    {{ __('messages.products.attributes.look') }}
                                </td>
                                <td class="py-4 text-right font-medium">{{ $product['look'] }}</td>
                            </tr>
                        </table>
                    </div>

                    <!-- Downloads -->
                    <div class="space-y-4">
                        <h4 class="text-xs font-bold uppercase tracking-widest border-b border-brand-stone pb-2">Downloads
                        </h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <a href="#"
                                class="flex items-center justify-between p-4 border border-brand-stone hover:bg-brand-stone/20 transition-colors group">
                                <div class="flex items-center gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-brand-charcoal/40">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m.75 12l3 3m0 0l3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                    </svg>
                                    <span class="text-xs uppercase tracking-widest font-bold">Technical Sheet</span>
                                </div>
                                <span class="text-[10px] text-brand-charcoal/40">PDF</span>
                            </a>
                            <a href="#"
                                class="flex items-center justify-between p-4 border border-brand-stone hover:bg-brand-stone/20 transition-colors group">
                                <div class="flex items-center gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-brand-charcoal/40">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m.75 12l3 3m0 0l3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                    </svg>
                                    <span class="text-xs uppercase tracking-widest font-bold">Catalog 2024</span>
                                </div>
                                <span class="text-[10px] text-brand-charcoal/40">PDF</span>
                            </a>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-10">
                        <a href="{{ url(app()->getLocale() . '/contact') }}" class="btn-premium text-center">
                            {{ __('messages.cta.quote') }}
                        </a>
                        <a href="https://wa.me/33123456789"
                            class="btn-premium-outline text-center flex items-center justify-center gap-3">
                            {{ __('messages.cta.request_sample') }}
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Products Placeholder -->
    <section class="py-24 border-t border-brand-stone bg-brand-stone/10">
        <div class="container mx-auto px-6">
            <h3 class="text-3xl font-serif mb-12">{{ __('messages.products.related') }}</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-12">
                <!-- We can inject featured products here or similar products -->
                <p class="text-brand-charcoal/40 italic">Coming soon...</p>
            </div>
        </div>
    </section>
@endsection