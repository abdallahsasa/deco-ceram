<footer class="bg-brand-charcoal text-white pt-20 pb-10">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-20">
            <!-- Brand Info -->
            <div class="space-y-6">
                <a href="{{ url(app()->getLocale() . '/') }}" class="flex items-center gap-2">
                    <img src="/images/logo.png" alt="Deco & Ceram Logo"
                        class="h-14 w-auto object-contain brightness-0 invert">
                </a>
                <p class="text-white/60 text-sm leading-relaxed max-w-xs">
                    {{ __('messages.footer.technical_desc') }}
                </p>
                <div class="flex gap-4">
                    <!-- Social Icons (Placeholders) -->
                    <a href="#"
                        class="w-8 h-8 rounded-full border border-white/20 flex items-center justify-center hover:bg-brand-sand transition-colors">
                        <span class="sr-only">Instagram</span>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                        </svg>
                    </a>
                    <a href="#"
                        class="w-8 h-8 rounded-full border border-white/20 flex items-center justify-center hover:bg-brand-sand transition-colors">
                        <span class="sr-only">Pinterest</span>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 0c-6.627 0-12 5.372-12 12 0 5.084 3.163 9.426 7.627 11.174-.105-.949-.2-2.405.042-3.441.218-.937 1.407-5.965 1.407-5.965s-.359-.719-.359-1.782c0-1.668.967-2.914 2.171-2.914 1.023 0 1.518.769 1.518 1.69 0 1.029-.655 2.568-.994 3.995-.283 1.194.599 2.169 1.777 2.169 2.133 0 3.772-2.249 3.772-5.495 0-2.873-2.064-4.882-5.012-4.882-3.414 0-5.418 2.561-5.418 5.207 0 1.031.397 2.138.893 2.738.098.119.112.224.083.345l-.333 1.36c-.053.22-.174.267-.402.161-1.499-.698-2.436-2.889-2.436-4.649 0-3.785 2.75-7.261 7.929-7.261 4.162 0 7.398 2.967 7.398 6.93 0 4.136-2.607 7.464-6.227 7.464-1.216 0-2.359-.631-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146 1.124.347 2.317.535 3.554.535 6.627 0 12-5.373 12-12 0-6.628-5.373-12-12-12z" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Main Links -->
            <div>
                <h4 class="text-sm font-bold uppercase tracking-widest mb-6">{{ __('messages.footer.company') }}</h4>
                <ul class="space-y-4 text-sm text-white/60">
                    <li><a href="{{ url(app()->getLocale() . '/about') }}"
                            class="hover:text-brand-sand transition-colors">{{ __('messages.nav.about') }}</a></li>
                    <li><a href="{{ url(app()->getLocale() . '/projects') }}"
                            class="hover:text-brand-sand transition-colors">{{ __('messages.nav.projects') }}</a></li>
                    <li><a href="{{ url(app()->getLocale() . '/professionals') }}"
                            class="hover:text-brand-sand transition-colors">{{ __('messages.nav.professionals') }}</a>
                    </li>
                    <li><a href="{{ url(app()->getLocale() . '/contact') }}"
                            class="hover:text-brand-sand transition-colors">{{ __('messages.nav.contact') }}</a></li>
                </ul>
            </div>

            <!-- Products -->
            <div>
                <h4 class="text-sm font-bold uppercase tracking-widest mb-6">{{ __('messages.nav.products') }}</h4>
                <ul class="space-y-4 text-sm text-white/60">
                    <li><a href="{{ url(app()->getLocale() . '/products?category=tiles') }}"
                            class="hover:text-brand-sand transition-colors">{{ __('messages.categories.tiles') }}</a>
                    </li>
                    <li><a href="{{ url(app()->getLocale() . '/products?category=large-slabs') }}"
                            class="hover:text-brand-sand transition-colors">{{ __('messages.categories.large-slabs') }}</a>
                    </li>
                    <li><a href="{{ url(app()->getLocale() . '/products?category=natural-stone') }}"
                            class="hover:text-brand-sand transition-colors">{{ __('messages.categories.natural-stone') }}</a>
                    </li>
                    <li><a href="{{ url(app()->getLocale() . '/products?category=outdoor-20mm') }}"
                            class="hover:text-brand-sand transition-colors">{{ __('messages.categories.outdoor-20mm') }}</a>
                    </li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h4 class="text-sm font-bold uppercase tracking-widest mb-6">{{ __('messages.footer.contact') }}</h4>
                <ul class="space-y-4 text-sm text-white/60">
                    <li class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5 text-brand-sand">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                        </svg>
                        <a href="mailto:contact@deco-ceram.fr"
                            class="hover:text-white transition-colors">contact@deco-ceram.fr</a>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5 text-brand-sand">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                        </svg>
                        <a href="tel:+33684130952" class="hover:text-white transition-colors">+33 6 84 13 09 52</a>
                    </li>
                    <li class="pt-4">
                        <a href="https://wa.me/33684130952"
                            class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 text-white rounded-md text-xs font-bold uppercase tracking-widest hover:bg-green-700 transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.067 2.877 1.215 3.076.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                            </svg>
                            {{ __('messages.contact.whatsapp_support') }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Secondary Bottom -->
        <div class="border-t border-white/10 pt-10 flex flex-col md:flex-row justify-between items-center gap-6">
            <p class="text-xs text-white/40 uppercase tracking-widest">
                &copy; {{ date('Y') }} Deco & Ceram. {{ __('messages.footer.rights') }}
            </p>
            <div class="flex gap-8 text-xs text-white/40 uppercase tracking-widest">
                <a href="{{ url(app()->getLocale() . '/legal') }}"
                    class="hover:text-white transition-colors">{{ __('messages.footer.legal') }}</a>
                <a href="{{ url(app()->getLocale() . '/privacy') }}"
                    class="hover:text-white transition-colors">{{ __('messages.footer.privacy') }}</a>
            </div>
        </div>
    </div>
</footer>