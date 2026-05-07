@extends('layouts.app')

@section('title', 'Deco & Ceram | Quiet Luxury Surfaces')

@section('content')
    <!-- Hero Section: Cinematic Entrance -->
    <section class="relative h-screen overflow-hidden bg-brand-charcoal">
        <div class="absolute inset-0 scale-105">
            <img src="/images/hero/luxury_interior.png" alt="Luxury Interior"
                class="w-full h-full object-cover opacity-60 animate-fade-in transition-transform duration-[10000ms] ease-out group-hover:scale-100">
        </div>

        <div class="absolute inset-0 bg-gradient-to-b from-brand-charcoal/40 via-transparent to-brand-charcoal/60"></div>

        <div class="absolute inset-0 flex items-center">
            <div class="container mx-auto px-6">
                <div class="max-w-3xl space-y-10 reveal reveal-up">
                    <div class="space-y-4">
                        <span class="inline-block text-[10px] uppercase tracking-[0.5em] text-brand-sand-light font-bold">EST. 1988</span>
                        <h1 class="text-white text-6xl md:text-8xl font-serif leading-[1.1] tracking-tight">
                            {{ __('messages.home.hero_title') }} <br>
                            <span class="italic text-brand-sand-light">{{ __('messages.home.hero_subtitle') }}</span>
                        </h1>
                    </div>
                    <p class="text-white/70 text-xl font-light tracking-wide max-w-xl leading-relaxed">
                        {{ __('messages.home.hero_desc') }}
                    </p>
                    <div class="flex flex-wrap gap-6 pt-6">
                        <a href="{{ url(app()->getLocale() . '/products') }}" class="btn-premium">
                            {{ __('messages.cta.browse') }}
                        </a>
                        <a href="{{ url(app()->getLocale() . '/contact') }}"
                            class="btn-premium-outline !border-white/30 !text-white hover:!bg-white hover:!text-brand-charcoal">
                            {{ __('messages.cta.quote') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Animated Scroll Indicator -->
        <div class="absolute bottom-12 left-1/2 -translate-x-1/2 flex flex-col items-center gap-4">
            <span class="text-[9px] uppercase tracking-[0.4em] text-white/30 font-bold">{{ __('messages.home.scroll') }}</span>
            <div class="w-px h-16 bg-gradient-to-b from-brand-sand/60 to-transparent"></div>
        </div>
    </section>

    <!-- Brand Showcase: Trust & Heritage -->
    <section class="py-12 bg-white border-b border-brand-stone/50 overflow-hidden">
        <div class="container mx-auto px-6">
            <div class="flex flex-wrap justify-center items-center gap-12 md:gap-24 opacity-40 grayscale hover:grayscale-0 transition-all duration-700">
                <img src="/images/brands/caesar-logo.png" alt="Caesar" class="h-8 w-auto object-contain">
                <span class="h-1 w-1 bg-brand-stone rounded-full"></span>
                <h3 class="text-[10px] uppercase tracking-[0.3em] font-bold text-brand-charcoal/60">Official Partner of Excellence</h3>
                <span class="h-1 w-1 bg-brand-stone rounded-full"></span>
                <img src="/images/logo.png" alt="Deco & Ceram" class="h-6 w-auto object-contain">
            </div>
        </div>
    </section>

    <!-- Solutions Section: Editorial Layout -->
    <section class="section-spacing bg-brand-white">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-center gap-20">
                <!-- Left: Interactive Image Composition -->
                <div class="w-full lg:w-1/2 relative group">
                    <div class="aspect-[4/5] overflow-hidden quiet-shadow reveal reveal-left">
                        <img src="/images/solutions/main_banner.jpg" alt="Design Solutions" class="w-full h-full object-cover transition-transform duration-[2000ms] group-hover:scale-105">
                    </div>
                    <div class="absolute -bottom-10 -right-10 w-2/3 aspect-video bg-brand-charcoal overflow-hidden shadow-2xl reveal reveal-up delay-300 hidden md:block">
                        <img src="/images/solutions/pool.jpg" alt="Outdoor Excellence" class="w-full h-full object-cover opacity-80">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <span class="text-[10px] text-white uppercase tracking-[0.4em] font-bold">Outdoor Living</span>
                        </div>
                    </div>
                </div>

                <!-- Right: Content -->
                <div class="w-full lg:w-1/2 space-y-10 reveal reveal-right">
                    <div class="space-y-4">
                        <span class="text-xs uppercase tracking-[0.4em] text-brand-sand font-bold">Architectural Vision</span>
                        <h2 class="text-5xl md:text-6xl font-serif leading-tight">Solutions designed to <br>bring your projects to life</h2>
                    </div>
                    <p class="text-editorial max-w-lg">
                        We curate the world's most sophisticated porcelain surfaces, providing architects and designers with the technical precision and aesthetic depth needed to create timeless spaces.
                    </p>
                    <div class="pt-6 grid grid-cols-2 gap-8 border-t border-brand-stone pt-10">
                        <div class="space-y-2">
                            <h4 class="text-sm uppercase tracking-widest font-bold text-brand-charcoal">Tailored Consult</h4>
                            <p class="text-xs text-brand-charcoal/50 leading-relaxed">Dedicated experts for every project phase.</p>
                        </div>
                        <div class="space-y-2">
                            <h4 class="text-sm uppercase tracking-widest font-bold text-brand-charcoal">Global Logistics</h4>
                            <p class="text-xs text-brand-charcoal/50 leading-relaxed">Seamless delivery for international developments.</p>
                        </div>
                    </div>
                    <div class="pt-8">
                        <a href="{{ url(app()->getLocale() . '/products') }}" class="btn-premium">
                            Explore All Inspirations
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Application Gallery: Interactive Grid -->
    <section class="section-spacing bg-white border-y border-brand-stone/30">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                @php
                    $solutions = [
                        ['id' => 'bathroom', 'title' => 'Bathroom Sanctuary', 'desc' => 'Waterproof excellence meets refined textures.'],
                        ['id' => 'kitchen', 'title' => 'Culinary Canvas', 'desc' => 'Durable surfaces for the heart of the home.'],
                        ['id' => 'pool', 'title' => 'Aquatic Horizon', 'desc' => 'Anti-slip technology for outdoor elegance.'],
                        ['id' => 'retail', 'title' => 'Retail Experience', 'desc' => 'High-traffic durability with premium finish.'],
                    ];
                @endphp

                @foreach($solutions as $index => $sol)
                    <div class="group relative aspect-[3/4] overflow-hidden bg-brand-stone reveal reveal-up" style="transition-delay: {{ $index * 150 }}ms;">
                        <img src="/images/solutions/{{ $sol['id'] }}.jpg" alt="{{ $sol['title'] }}" class="w-full h-full object-cover transition-transform duration-[1500ms] group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-brand-charcoal/90 via-brand-charcoal/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-700 flex flex-col justify-end p-8">
                            <h3 class="text-white text-2xl font-serif mb-2 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">{{ $sol['title'] }}</h3>
                            <p class="text-white/60 text-[10px] uppercase tracking-widest leading-relaxed transform translate-y-8 group-hover:translate-y-0 transition-transform duration-700 delay-100">{{ $sol['desc'] }}</p>
                        </div>
                        <div class="absolute top-8 left-8">
                             <span class="text-[9px] uppercase tracking-[0.3em] text-white/40 border-l border-white/40 pl-3">0{{ $index + 1 }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Collections Spotlight: Curated Gallery -->
    <section class="section-spacing bg-brand-white">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-end mb-20 gap-8">
                <div class="space-y-4 reveal reveal-up">
                    <span class="text-xs uppercase tracking-[0.4em] text-brand-sand font-bold">Curated Selections</span>
                    <h2 class="text-5xl md:text-6xl font-serif">Featured Series</h2>
                </div>
                <div class="reveal reveal-up">
                    <a href="{{ url(app()->getLocale() . '/products') }}" class="group inline-flex items-center gap-4 text-[10px] uppercase tracking-[0.4em] font-bold text-brand-charcoal/60 hover:text-brand-charcoal transition-colors">
                        View Entire Catalog
                        <span class="w-12 h-px bg-brand-stone group-hover:w-20 group-hover:bg-brand-sand transition-all duration-500"></span>
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
                @foreach($collections as $collection)
                    <x-product.collection-card :collection="$collection" />
                @endforeach
            </div>
        </div>
    </section>

    <!-- Iconic Projects: Full Width Cinematic -->
    <section class="section-spacing bg-brand-charcoal text-white">
        <div class="container mx-auto px-6">
            <div class="flex flex-col items-center text-center mb-20 space-y-6 reveal reveal-up">
                <span class="text-xs uppercase tracking-[0.5em] text-brand-sand font-bold">Portfolio</span>
                <h2 class="text-5xl md:text-7xl font-serif">Iconic Projects</h2>
                <p class="text-white/50 max-w-xl font-light">Witness the transformation of international spaces through the lens of Deco & Ceram.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-1 reveal reveal-up">
                @foreach($featuredProjects as $index => $project)
                    <div class="group relative aspect-[4/5] overflow-hidden">
                        <img src="{{ $project['image'] ?? '/images/placeholder.jpg' }}" alt="{{ $project['name'] }}" class="w-full h-full object-cover opacity-60 transition-all duration-1000 group-hover:opacity-100 group-hover:scale-105">
                        <div class="absolute inset-0 flex flex-col justify-end p-12 translate-y-10 group-hover:translate-y-0 transition-transform duration-700">
                            <span class="text-[10px] uppercase tracking-[0.3em] text-brand-sand font-bold mb-4">{{ $project['location'] ?? 'International' }}</span>
                            <h3 class="text-3xl font-serif mb-6">{{ $project['name'] }}</h3>
                            <a href="{{ route('projects.show', ['locale' => app()->getLocale(), 'id' => $project['id']]) }}" class="inline-block text-[9px] uppercase tracking-[0.4em] border-b border-brand-sand pb-1 self-start">
                                Explore Project
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Professionals: High Contrast Call -->
    <section class="relative section-spacing overflow-hidden">
        <div class="absolute inset-0 bg-brand-white"></div>
        <div class="absolute top-0 right-0 w-1/2 h-full bg-brand-charcoal transform skew-x-[-12deg] translate-x-1/3 hidden lg:block"></div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
                <div class="space-y-10 reveal reveal-left">
                    <div class="space-y-4">
                        <span class="text-xs uppercase tracking-[0.4em] text-brand-sand font-bold">B2B Partners</span>
                        <h2 class="text-5xl md:text-6xl font-serif">{{ __('messages.home.pros_subtitle') }}</h2>
                    </div>
                    <p class="text-editorial max-w-lg">
                        {{ __('messages.home.pros_desc') }}
                    </p>
                    <div class="flex gap-4">
                        <a href="{{ url(app()->getLocale() . '/professionals') }}" class="btn-premium">
                            {{ __('messages.cta.discover_b2b') }}
                        </a>
                        <a href="mailto:contact@deco-ceram.fr" class="btn-premium-outline">
                            Request Samples
                        </a>
                    </div>
                </div>
                <div class="relative reveal reveal-right hidden lg:block">
                    <div class="aspect-square bg-brand-stone/30 p-12">
                        <img src="/images/hero/luxury_interior.png" alt="Professional Tools" class="w-full h-full object-cover quiet-shadow">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Final CTA: Minimalist Close -->
    <section class="py-32 bg-white text-center">
        <div class="container mx-auto px-6 max-w-4xl space-y-12 reveal reveal-up">
            <h2 class="text-5xl md:text-7xl font-serif leading-tight">Ready to transform <br>your next space?</h2>
            <div class="flex flex-wrap justify-center gap-6">
                <a href="{{ url(app()->getLocale() . '/contact') }}" class="btn-premium">
                    Request a Custom Quote
                </a>
                <a href="https://wa.me/33684130952" class="btn-premium-outline flex items-center gap-3">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    WhatsApp Support
                </a>
            </div>
        </div>
    </section>
@endsection