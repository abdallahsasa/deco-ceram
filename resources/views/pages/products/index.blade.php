@extends('layouts.app')

@section('title', 'Product Catalog | Deco & Ceram')

@section('content')
    <div class="bg-brand-white py-12 border-b border-brand-stone">
        <div class="container mx-auto px-6">
            <h1 class="text-4xl md:text-5xl font-serif mb-4">{{ __('messages.products.catalog') }}</h1>
            <p class="text-brand-charcoal/60 uppercase tracking-widest text-xs">{{ __('messages.products.sub_title') }}</p>
        </div>
    </div>

    <section class="py-20">
        <div class="container mx-auto px-6">
            <form action="{{ url(app()->getLocale() . '/products') }}" method="GET" id="filter-form"
                class="flex flex-col lg:flex-row gap-16">
                <!-- Sidebar Filters -->
                <aside class="w-full lg:w-64 space-y-12 h-fit lg:sticky lg:top-32">
                    <!-- Categories -->
                    <div class="space-y-6">
                        <h4 class="text-xs font-bold uppercase tracking-widest border-b border-brand-stone pb-2">
                            {{ __('messages.products.filters.category') }}
                        </h4>
                        <ul class="space-y-3 text-sm">
                            <li>
                                <label class="flex items-center justify-between cursor-pointer group">
                                    <input type="radio" name="category" value="" class="hidden"
                                        onchange="this.form.submit()" @if(!Request::has('category') || Request::get('category') == '') checked @endif>
                                    <span
                                        class="group-hover:text-brand-sand transition-colors @if(!Request::has('category') || Request::get('category') == '') text-brand-sand font-medium @endif">
                                        {{ __('messages.products.filters.all') }}
                                    </span>
                                </label>
                            </li>
                            @foreach($categories as $category)
                                <li>
                                    <label class="flex items-center justify-between cursor-pointer group">
                                        <input type="radio" name="category" value="{{ $category['id'] }}" class="hidden"
                                            onchange="this.form.submit()" @if(Request::get('category') == $category['id']) checked @endif>
                                        <span
                                            class="group-hover:text-brand-sand transition-colors @if(Request::get('category') == $category['id']) text-brand-sand font-medium @endif">
                                            {{ __('messages.categories.' . $category['id']) }}
                                        </span>
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Material -->
                    <div class="space-y-6">
                        <h4 class="text-xs font-bold uppercase tracking-widest border-b border-brand-stone pb-2">
                            {{ __('messages.products.filters.material') }}
                        </h4>
                        <div class="space-y-3">
                            @foreach(['Ceramic', 'Porcelain', 'Natural Stone'] as $material)
                                <label class="flex items-center gap-3 text-sm cursor-pointer group">
                                    <input type="checkbox" name="material[]" value="{{ $material }}"
                                        onchange="this.form.submit()"
                                        @if(is_array(Request::get('material')) && in_array($material, Request::get('material'))) checked @endif
                                        class="w-4 h-4 rounded-none border-brand-stone text-brand-charcoal focus:ring-0">
                                    <span class="group-hover:text-brand-sand transition-colors">
                                        {{ $material }}
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Look -->
                    <div class="space-y-6">
                        <h4 class="text-xs font-bold uppercase tracking-widest border-b border-brand-stone pb-2">
                            {{ __('messages.products.filters.look') }}</h4>
                        <div class="space-y-3">
                            @foreach(['Marble', 'Stone', 'Concrete', 'Wood', 'Terrazzo'] as $look)
                                <label class="flex items-center gap-3 text-sm cursor-pointer group">
                                    <input type="checkbox" name="look[]" value="{{ $look }}"
                                        onchange="this.form.submit()"
                                        @if(is_array(Request::get('look')) && in_array($look, Request::get('look'))) checked @endif
                                        class="w-4 h-4 rounded-none border-brand-stone text-brand-charcoal focus:ring-0">
                                    <span class="group-hover:text-brand-sand transition-colors">
                                        {{ $look }}
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </aside>

                <!-- Product Grid -->
                <div class="flex-1 space-y-12">
                    <!-- Toolbar -->
                    <div
                        class="flex flex-col sm:flex-row justify-between items-center gap-4 border-b border-brand-stone pb-6">
                        <p class="text-sm text-brand-charcoal/60 italic">{{ count($products) }}
                            {{ __('messages.products.found') }}</p>
                        <div class="flex items-center gap-4">
                            <span
                                class="text-xs uppercase tracking-widest font-bold">{{ __('messages.products.filters.sort_by') }}</span>
                            <select name="sort" onchange="this.form.submit()"
                                class="bg-transparent border-none text-sm focus:ring-0 uppercase tracking-tighter cursor-pointer">
                                <option value="popular" @if(Request::get('sort') == 'popular') selected @endif>{{ __('messages.products.filters.popular') }}</option>
                                <option value="new" @if(Request::get('sort') == 'new') selected @endif>{{ __('messages.products.filters.new') }}</option>
                                <option value="alphabetical" @if(Request::get('sort') == 'alphabetical') selected @endif>{{ __('messages.products.filters.alphabetical') }}</option>
                            </select>
                        </div>
                    </div>

                    <!-- Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-x-8 gap-y-16">
                        @forelse($products as $product)
                            <x-product.card :product="$product" />
                        @empty
                            <div class="col-span-full py-20 text-center">
                                <p class="text-brand-charcoal/60 italic">{{ __('messages.products.no_results') ?? 'No products found matching your criteria.' }}</p>
                                <a href="{{ url(app()->getLocale() . '/products') }}" class="text-brand-sand underline mt-4 inline-block">
                                    {{ __('messages.products.clear_filters') ?? 'Clear all filters' }}
                                </a>
                            </div>
                        @endforelse
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection