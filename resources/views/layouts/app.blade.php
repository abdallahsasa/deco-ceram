<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Deco & Ceram | ' . __('messages.products.sub_title'))</title>
    <link rel="icon" type="image/png" href="/favicon.png">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Noto+Kufi+Arabic:wght@300;400;600&display=swap"
        rel="stylesheet">

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        window.parseSqmFromName = function(name) {
            if (!name) return 0;
            let cleanName = name.replace(/,/g, '.').toLowerCase();
            let match = cleanName.match(/(\d+(?:\.\d+)?)\s*x\s*(\d+(?:\.\d+)?)/);
            if (match) {
                let w = parseFloat(match[1]);
                let h = parseFloat(match[2]);
                let isMm = cleanName.includes('mm') || (w > 200 && h > 200 && !cleanName.includes('cm'));
                let factor = isMm ? 1000 : 100;
                return (w / factor) * (h / factor);
            }
            return 0;
        };

        document.addEventListener('alpine:init', () => {
            Alpine.store('cart', {
                items: JSON.parse(localStorage.getItem('cart')) || [],

                get count() {
                    return this.items.length;
                },

                get total() {
                    return this.items.reduce((sum, item) => sum + (parseFloat(item.total) || 0), 0);
                },

                get subtotal() {
                    return this.items.reduce((sum, item) => sum + (parseFloat(item.total) || 0), 0);
                },

                add(item) {
                    const existingItemIndex = this.items.findIndex(i => 
                        i.product_id === item.product_id && 
                        i.variant_name === item.variant_name
                    );

                    if (existingItemIndex > -1) {
                        this.items[existingItemIndex].boxes = (this.items[existingItemIndex].boxes || 0) + (item.boxes || 0);
                        this.items[existingItemIndex].meters = (this.items[existingItemIndex].meters || 0) + (item.meters || 0);
                        this.items[existingItemIndex].pcs = (this.items[existingItemIndex].pcs || 0) + (item.pcs || 0);
                        this.items[existingItemIndex].quantity = (this.items[existingItemIndex].quantity || 0) + (item.quantity || 0);
                        this.items[existingItemIndex].total = (this.items[existingItemIndex].total || 0) + (item.total || 0);
                    } else {
                        item.cart_id = Date.now().toString() + Math.random().toString(36).substr(2, 9);
                        this.items.push(item);
                    }

                    this.save();
                    window.dispatchEvent(new CustomEvent('cart-added'));
                },

                remove(cart_id) {
                    this.items = this.items.filter(item => item.cart_id !== cart_id);
                    this.save();
                },

                update(cart_id, key, value) {
                    const item = this.items.find(i => i.cart_id === cart_id);
                    if (item) {
                        item[key] = value;
                        this.save();
                    }
                },

                clear() {
                    this.items = [];
                    this.save();
                },

                save() {
                    localStorage.setItem('cart', JSON.stringify(this.items));
                }
            });
        });
    </script>
</head>

<body class="bg-brand-white text-brand-charcoal antialiased overflow-x-hidden">
    <x-layout.header />

    <main>
        @yield('content')
    </main>

    <!-- Global Toast Notification -->
    <div x-data="{ show: false, message: '' }"
         @cart-added.window="message = $event.detail + ' added to quote'; show = true; setTimeout(() => show = false, 3000)"
         class="fixed bottom-8 left-1/2 -translate-x-1/2 z-50 transition-all duration-300"
         :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8 pointer-events-none'">
        <div class="bg-brand-charcoal text-white px-6 py-3 rounded-full shadow-2xl flex items-center gap-3 text-sm font-medium">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-[#F97316]">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
            </svg>
            <span x-text="message"></span>
        </div>
    </div>

    <x-layout.footer />

    <!-- Scroll Animation Observer -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const observerOptions = {
                threshold: 0.1
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
        });
    </script>
</body>

</html>