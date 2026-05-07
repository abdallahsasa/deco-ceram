@extends('layouts.app')

@section('title', 'Deco & Ceram | Quiet Luxury Surfaces')

@section('content')
    <!-- Hero Section -->
    <section class="relative h-[90vh] overflow-hidden bg-brand-charcoal">
        <img src="/images/hero/luxury_interior.png" alt="Luxury Interior"
            class="w-full h-full object-cover opacity-80 animate-fade-in">

        <div class="absolute inset-0 flex items-center">
            <div class="container mx-auto px-6">
                <div class="max-w-2xl space-y-8 reveal reveal-up">
                    <h1 class="text-white text-5xl md:text-7xl font-serif leading-tight">
                        {{ __('messages.home.hero_title') }} <br>
                        <span class="italic text-brand-sand-light">{{ __('messages.home.hero_subtitle') }}</span>
                    </h1>
                    <p class="text-white/80 text-lg md:text-xl font-light tracking-wide max-w-lg">
                        {{ __('messages.home.hero_desc') }}
                    </p>
                    <div class="flex flex-wrap gap-4 pt-4">
                        <a href="{{ url(app()->getLocale() . '/products') }}" class="btn-premium">
                            {{ __('messages.cta.browse') }}
                        </a>
                        <a href="{{ url(app()->getLocale() . '/contact') }}"
                            class="btn-premium-outline !border-white !text-white hover:!bg-white hover:!text-brand-charcoal">
                            {{ __('messages.cta.quote') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 animate-bounce">
            <span class="text-[10px] uppercase tracking-widest text-white/40">{{ __('messages.home.scroll') }}</span>
            <div class="w-px h-10 bg-white/20"></div>
        </div>
    </section>

    <!-- Solutions Section -->
    <section class="relative overflow-hidden bg-white">
        <div class="flex flex-col lg:flex-row">
            <!-- Left: Cinematic Image -->
            <div class="w-full lg:w-1/2 h-[50vh] lg:h-[70vh] reveal reveal-left">
                <img src="/images/solutions/main_banner.jpg" alt="Design Solutions" class="w-full h-full object-cover">
            </div>
            <!-- Right: Content -->
            <div class="w-full lg:w-1/2 flex items-center justify-center p-12 lg:p-24 bg-brand-white reveal reveal-right">
                <div class="max-w-md space-y-6">
                    <h2 class="text-4xl md:text-5xl font-serif leading-tight">Solutions designed to bring your projects to life</h2>
                    <p class="text-brand-charcoal/60 text-lg font-light leading-relaxed">
                        Here are some concrete examples of how we can help you turn your ideas into results.
                    </p>
                    <div class="pt-4">
                        <a href="{{ url(app()->getLocale() . '/products') }}" class="btn-premium-outline">
                            Explore all inspirations
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Application Cards Row -->
        <div class="container mx-auto px-6 -mt-16 relative z-10">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Bathroom -->
                <div class="bg-white p-4 shadow-xl reveal reveal-up" style="transition-delay: 100ms;">
                    <div class="aspect-[4/3] overflow-hidden mb-6">
                        <img src="/images/solutions/bathroom.jpg" alt="Bathroom" class="w-full h-full object-cover transition-transform duration-700 hover:scale-110">
                    </div>
                    <div class="space-y-3">
                        <h3 class="text-lg font-serif text-center">Porcelain bathroom tiles</h3>
                        <p class="text-[10px] text-brand-charcoal/50 leading-relaxed line-clamp-3">
                            Caesar porcelain bathroom tiles guarantee excellent performance and aesthetic return, whether used for floor or wall.
                        </p>
                    </div>
                </div>

                <!-- Kitchen -->
                <div class="bg-white p-4 shadow-xl reveal reveal-up" style="transition-delay: 200ms;">
                    <div class="aspect-[4/3] overflow-hidden mb-6">
                        <img src="/images/solutions/kitchen.jpg" alt="Kitchen" class="w-full h-full object-cover transition-transform duration-700 hover:scale-110">
                    </div>
                    <div class="space-y-3">
                        <h3 class="text-lg font-serif text-center">Porcelain kitchen tiles</h3>
                        <p class="text-[10px] text-brand-charcoal/50 leading-relaxed line-clamp-3">
                            The porcelain kitchen tiles by Caesar combine technical quality and meticulous design for the most demanding projects.
                        </p>
                    </div>
                </div>

                <!-- Pool -->
                <div class="bg-white p-4 shadow-xl reveal reveal-up" style="transition-delay: 300ms;">
                    <div class="aspect-[4/3] overflow-hidden mb-6">
                        <img src="/images/solutions/pool.jpg" alt="Pool" class="w-full h-full object-cover transition-transform duration-700 hover:scale-110">
                    </div>
                    <div class="space-y-3">
                        <h3 class="text-lg font-serif text-center">Porcelain tiles for pools</h3>
                        <p class="text-[10px] text-brand-charcoal/50 leading-relaxed line-clamp-3">
                            The pool tiles in the Aquae collections by Caesar guarantee design freedom with all the advanced technical features.
                        </p>
                    </div>
                </div>

                <!-- Retail -->
                <div class="bg-white p-4 shadow-xl reveal reveal-up" style="transition-delay: 400ms;">
                    <div class="aspect-[4/3] overflow-hidden mb-6">
                        <img src="/images/solutions/retail.jpg" alt="Retail" class="w-full h-full object-cover transition-transform duration-700 hover:scale-110">
                    </div>
                    <div class="space-y-3">
                        <h3 class="text-lg font-serif text-center">Retail</h3>
                        <p class="text-[10px] text-brand-charcoal/50 leading-relaxed line-clamp-3">
                            The Caesar collections of porcelain tile for commercial and public use make for seductive, durable and easy-to-clean spaces.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Browse by Collection -->
    <section class="py-24 border-t border-brand-stone">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-4">
                <div class="space-y-2 reveal reveal-up">
                    <span
                        class="text-xs uppercase tracking-widest text-brand-sand font-bold">Featured Series</span>
                    <h2 class="text-4xl md:text-5xl font-serif">Explore Collections</h2>
                </div>
                <div class="reveal reveal-up">
                    <a href="{{ url(app()->getLocale() . '/products') }}" class="text-xs uppercase tracking-widest border-b border-brand-sand pb-1 hover:text-brand-sand transition-colors">
                        View All Products
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($collections as $collection)
                    <x-product.collection-card :collection="$collection" />
                @endforeach
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="py-24 bg-brand-stone/30">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-center mb-16 gap-6">
                <div class="text-center md:text-left reveal reveal-up">
                    <h2 class="text-4xl md:text-5xl font-serif">{{ __('messages.home.selected_surfaces') }}</h2>
                </div>
                <div class="reveal reveal-up">
                    <a href="{{ url(app()->getLocale() . '/products') }}" class="btn-premium-outline">
                        {{ __('messages.cta.explore_catalog') }}
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-12">
                @foreach($featuredProducts as $product)
                    <x-product.card :product="$product" />
                @endforeach
            </div>
        </div>
    </section>

    <!-- Projects Teaser -->
    <section class="py-24">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 space-y-4 reveal reveal-up">
                <span
                    class="text-xs uppercase tracking-widest text-brand-sand font-bold">{{ __('messages.home.gallery_title') }}</span>
                <h2 class="text-4xl md:text-5xl font-serif">{{ __('messages.home.iconic_projects') }}</h2>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-16">
                @foreach($featuredProjects as $project)
                    <x-project.card :project="$project" />
                @endforeach
            </div>

            <div class="text-center reveal reveal-up">
                <a href="{{ url(app()->getLocale() . '/projects') }}"
                    class="inline-flex items-center gap-2 text-sm uppercase tracking-[0.2em] font-medium hover:text-brand-sand transition-colors group">
                    {{ __('messages.cta.see_all') }}
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4 transform group-hover:translate-x-2 transition-transform">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Professionals Teaser -->
    <section class="py-24 bg-brand-charcoal text-white overflow-hidden relative">
        <div class="absolute top-0 right-0 w-1/3 h-full bg-brand-sand/5 transform skew-x-12 translate-x-1/2"></div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="max-w-3xl space-y-8 reveal reveal-up">
                <span
                    class="text-xs uppercase tracking-widest text-brand-sand font-bold">{{ __('messages.home.pros_title') }}</span>
                <h2 class="text-4xl md:text-6xl font-serif">{{ __('messages.home.pros_subtitle') }}</h2>
                <p class="text-white/60 text-lg font-light leading-relaxed">
                    {{ __('messages.home.pros_desc') }}
                </p>
                <div class="pt-4">
                    <a href="{{ url(app()->getLocale() . '/professionals') }}"
                        class="btn-premium !bg-brand-sand !text-brand-charcoal hover:!bg-white transition-all">
                        {{ __('messages.cta.discover_b2b') }}
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact CTA Band -->
    <section class="py-12 bg-white border-y border-brand-stone">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row items-center justify-between gap-8">
                <h3 class="text-2xl font-serif text-center md:text-left">{{ __('messages.home.ready_title') }}</h3>
                <div class="flex gap-4">
                    <a href="{{ url(app()->getLocale() . '/contact') }}" class="btn-premium">
                        {{ __('messages.cta.quote') }}
                    </a>
                    <a href="https://wa.me/33684130952" class="btn-premium-outline flex items-center gap-2">
                        {{ __('messages.contact.whatsapp_support') }}
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection