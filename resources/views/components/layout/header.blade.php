<header
    class="fixed top-0 left-0 right-0 z-50 bg-brand-white/80 backdrop-blur-md border-b border-brand-stone transition-all duration-300">
    <div class="container mx-auto px-6 h-20 flex items-center justify-between">
        <a href="{{ url(app()->getLocale() . '/') }}" class="flex items-center gap-4 group">
            <img src="/images/logo.png" alt="Deco & Ceram Logo" class="h-12 w-auto object-contain">
        </a>

        <!-- Desktop Navigation -->
        <nav class="hidden lg:flex items-center gap-8">
            <a href="{{ url(app()->getLocale() . '/products/brand/caesar') }}"
                class="text-sm uppercase tracking-widest hover:text-brand-sand transition-colors @if(Request::is('*/products*')) text-brand-sand @endif">{{ __('messages.nav.products') }}</a>
            <a href="{{ url(app()->getLocale() . '/projects') }}"
                class="text-sm uppercase tracking-widest hover:text-brand-sand transition-colors @if(Request::is('*/projects*')) text-brand-sand @endif">{{ __('messages.nav.projects') }}</a>
            <a href="{{ url(app()->getLocale() . '/professionals') }}"
                class="text-sm uppercase tracking-widest hover:text-brand-sand transition-colors @if(Request::is('*/professionals*')) text-brand-sand @endif">{{ __('messages.nav.professionals') }}</a>
            <a href="{{ url(app()->getLocale() . '/about') }}"
                class="text-sm uppercase tracking-widest hover:text-brand-sand transition-colors @if(Request::is('*/about*')) text-brand-sand @endif">{{ __('messages.nav.about') }}</a>
            <a href="{{ url(app()->getLocale() . '/contact') }}"
                class="text-sm uppercase tracking-widest hover:text-brand-sand transition-colors @if(Request::is('*/contact*')) text-brand-sand @endif">{{ __('messages.nav.contact') }}</a>
        </nav>

        <!-- Right Side: Lang + CTA -->
        <div class="flex items-center gap-6">
            <!-- Language Switcher -->
            <div class="flex items-center gap-2 text-xs font-medium uppercase tracking-tighter">
                <a href="{{ url('fr' . substr(Request::path(), 2)) }}"
                    class="@if(app()->getLocale() == 'fr') text-brand-sand @else text-brand-charcoal/50 hover:text-brand-charcoal @endif transition-colors">FR</a>
                <span class="text-brand-stone">|</span>
                <a href="{{ url('ar' . substr(Request::path(), 2)) }}"
                    class="@if(app()->getLocale() == 'ar') text-brand-sand @else text-brand-charcoal/50 hover:text-brand-charcoal @endif transition-colors">AR</a>
                <span class="text-brand-stone">|</span>
                <a href="{{ url('en' . substr(Request::path(), 2)) }}"
                    class="@if(app()->getLocale() == 'en') text-brand-sand @else text-brand-charcoal/50 hover:text-brand-charcoal @endif transition-colors">EN</a>
            </div>

            <!-- Quote Cart Icon -->
            <a href="{{ url(app()->getLocale() . '/quote') }}"
                class="relative flex flex-col items-center justify-center text-brand-charcoal hover:text-brand-sand transition-colors"
                x-data="{ animate: false }" @cart-added.window="animate = true; setTimeout(() => animate = false, 400)">

                <div class="relative transition-transform duration-300 ease-out"
                    :class="animate ? 'scale-125 -translate-y-1 text-brand-sand' : 'scale-100'">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                    </svg>

                    <span x-show="$store.quoteCart.count > 0" x-text="$store.quoteCart.count" x-cloak
                        class="absolute -bottom-2.5 left-1/2 -translate-x-1/2 text-brand-charcoal text-[10px] font-bold px-1 py-0.5 rounded-full min-w-[16px] text-center bg-white border border-brand-stone/30 shadow-sm leading-none">
                    </span>
                </div>
            </a>

            <!-- CTA -->
            <a href="{{ url(app()->getLocale() . '/contact') }}" class="btn-premium hidden sm:block">
                {{ __('messages.cta.quote') }}
            </a>

            <!-- Mobile Menu Toggle -->
            <button class="lg:hidden p-2 text-brand-charcoal">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>
        </div>
    </div>
</header>

<!-- Spacer to prevent content from jumping due to fixed header -->
<div class="h-20"></div>