@extends('layouts.app')

@section('title', $collection->name . ' - ' . $brand->name . ' | Deco & Ceram')

@section('content')
    <!-- Collection Header -->
    <section class="pt-32 pb-16 bg-brand-stone/30">
        <div class="container mx-auto px-6">
            <nav class="flex mb-8 text-xs uppercase tracking-widest text-brand-charcoal/40" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2">
                    <li><a href="{{ route('products', app()->getLocale()) }}" class="hover:text-brand-sand transition-colors">Products</a></li>
                    <li><span class="mx-2">/</span></li>
                    <li><a href="{{ route('products.brand', ['locale' => app()->getLocale(), 'brand' => $brand->slug]) }}" class="hover:text-brand-sand transition-colors">{{ $brand->name }}</a></li>
                    <li><span class="mx-2">/</span></li>
                    <li class="text-brand-charcoal">{{ $collection->name }}</li>
                </ol>
            </nav>

            <div class="max-w-4xl space-y-4 reveal reveal-up">
                <h1 class="text-4xl md:text-6xl font-serif">Series: {{ $collection->name }}</h1>
                <p class="text-brand-charcoal/60 text-lg font-light leading-relaxed">
                    {{ $collection->description }}
                </p>
            </div>
        </div>
    </section>

    <!-- Catalog Section -->
    <section class="py-24">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row gap-16">
                <!-- Filters Sidebar -->
                <aside class="w-full lg:w-64 space-y-12 shrink-0 reveal reveal-left">
                    <form action="{{ url()->current() }}" method="GET" class="space-y-12">
                        <!-- Filter Group -->
                        <div class="space-y-6">
                            <h4 class="text-xs uppercase tracking-[0.2em] font-bold border-b border-brand-stone pb-4">Look</h4>
                            <div class="space-y-3">
                                @foreach($looks as $look)
                                    <label class="flex items-center group cursor-pointer">
                                        <input type="checkbox" name="look" value="{{ $look }}" 
                                            {{ request('look') == $look ? 'checked' : '' }}
                                            class="hidden" onchange="this.form.submit()">
                                        <span class="w-4 h-4 border border-brand-stone mr-3 flex items-center justify-center group-hover:border-brand-sand transition-colors {{ request('look') == $look ? 'bg-brand-sand border-brand-sand' : '' }}">
                                            @if(request('look') == $look)
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="white" class="w-3 h-3"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                                            @endif
                                        </span>
                                        <span class="text-sm text-brand-charcoal/80 group-hover:text-brand-charcoal transition-colors">{{ $look }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="space-y-6">
                            <h4 class="text-xs uppercase tracking-[0.2em] font-bold border-b border-brand-stone pb-4">Finish</h4>
                            <div class="space-y-3">
                                @foreach($finishes as $finish)
                                    <label class="flex items-center group cursor-pointer">
                                        <input type="checkbox" name="finish" value="{{ $finish }}" 
                                            {{ request('finish') == $finish ? 'checked' : '' }}
                                            class="hidden" onchange="this.form.submit()">
                                        <span class="w-4 h-4 border border-brand-stone mr-3 flex items-center justify-center group-hover:border-brand-sand transition-colors {{ request('finish') == $finish ? 'bg-brand-sand border-brand-sand' : '' }}">
                                            @if(request('finish') == $finish)
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="white" class="w-3 h-3"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                                            @endif
                                        </span>
                                        <span class="text-sm text-brand-charcoal/80 group-hover:text-brand-charcoal transition-colors">{{ $finish }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="space-y-6">
                            <h4 class="text-xs uppercase tracking-[0.2em] font-bold border-b border-brand-stone pb-4">Size</h4>
                            <div class="space-y-3">
                                @foreach($sizes as $size)
                                    <label class="flex items-center group cursor-pointer">
                                        <input type="checkbox" name="size" value="{{ $size }}" 
                                            {{ request('size') == $size ? 'checked' : '' }}
                                            class="hidden" onchange="this.form.submit()">
                                        <span class="w-4 h-4 border border-brand-stone mr-3 flex items-center justify-center group-hover:border-brand-sand transition-colors {{ request('size') == $size ? 'bg-brand-sand border-brand-sand' : '' }}">
                                             @if(request('size') == $size)
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="white" class="w-3 h-3"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                                            @endif
                                        </span>
                                        <span class="text-sm text-brand-charcoal/80 group-hover:text-brand-charcoal transition-colors">{{ $size }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        @if(request()->anyFilled(['look', 'finish', 'size']))
                            <a href="{{ url()->current() }}" class="text-[10px] uppercase tracking-widest text-brand-sand hover:text-brand-charcoal transition-colors block">
                                Clear All Filters
                            </a>
                        @endif
                    </form>
                </aside>

                <!-- Product Grid -->
                <div class="flex-1 space-y-12">
                    <div class="flex justify-between items-center text-xs uppercase tracking-widest text-brand-charcoal/40 border-b border-brand-stone pb-4">
                        <span>Showing {{ $products->count() }} surfaces</span>
                    </div>

                    @if($products->isEmpty())
                        <div class="py-24 text-center space-y-4 reveal reveal-up">
                            <p class="text-lg font-serif">No products match your current filters.</p>
                            <a href="{{ url()->current() }}" class="text-sm text-brand-sand underline">Reset all filters</a>
                        </div>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-x-12 gap-y-16">
                            @foreach($products as $product)
                                <x-product.card :product="$product" />
                            @endforeach
                        </div>

                        <div class="pt-12">
                            {{ $products->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
