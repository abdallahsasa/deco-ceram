@extends('layouts.app')

@section('title', __('messages.quote.title') ?? 'Quote Request | Deco & Ceram')

@section('content')
    <section class="pt-32 pb-24 bg-brand-white min-h-screen" x-data="quoteForm()">
        <div class="container mx-auto px-6">
            <div class="max-w-6xl mx-auto">
                <div class="mb-12 reveal reveal-up">
                    <nav class="flex mb-4 text-sm text-brand-charcoal/60" aria-label="Breadcrumb">
                        <ol class="flex items-center space-x-2">
                            <li><a href="{{ url(app()->getLocale() . '/') }}"
                                    class="hover:text-brand-sand transition-colors">Home</a></li>
                            <li><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" class="w-3 h-3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg></li>
                            <li class="text-brand-charcoal">Cart</li>
                        </ol>
                    </nav>
                    <h1 class="text-4xl md:text-5xl font-light uppercase tracking-tight">YOUR CART</h1>
                </div>

                <template x-if="$store.quoteCart.items.length === 0">
                    <div class="text-center py-24 bg-[#FAFAFA]  border border-brand-stone/20 shadow-sm reveal reveal-up">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1"
                            stroke="currentColor" class="w-16 h-16 mx-auto text-brand-charcoal/20 mb-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007z" />
                        </svg>
                        <h3 class="text-2xl font-serif mb-2">{{ __('messages.quote.empty_title') ?? 'Your cart is empty' }}
                        </h3>
                        <p class="text-brand-charcoal/60 mb-8">
                            {{ __('messages.quote.empty_subtitle') ?? 'Browse our catalog to add products to your quote request.' }}
                        </p>
                        <a href="{{ url(app()->getLocale() . '/products') }}"
                            class="bg-black text-white px-8 py-3  hover:bg-gray-800 transition-colors">{{ __('messages.products.explore_collections_btn') }}</a>
                    </div>
                </template>

                <template x-if="$store.quoteCart.items.length > 0">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 reveal reveal-up">

                        <!-- Selected Products List -->
                        <div class="lg:col-span-7">
                            <div class="bg-[#FCFCFC]  border border-[#EBEBEB] p-4 md:p-6 shadow-sm">
                                <div class="flex flex-col">
                                    <template x-for="(item, index) in $store.quoteCart.items" :key="item.cart_id">
                                        <div class="relative flex gap-5 py-6"
                                            :class="index !== $store.quoteCart.items.length - 1 ? 'border-b border-[#EBEBEB]' : ''">

                                            <!-- Product Image -->
                                            <div class="w-28 h-28 bg-[#F2F2F2] overflow-hidden shrink-0 p-2">
                                                <img :src="item.image" :alt="item.name"
                                                    class="w-full h-full object-contain mix-blend-multiply">
                                            </div>

                                            <!-- Product Info & Quantities -->
                                            <div class="flex-grow flex flex-col justify-between py-1">
                                                <div>
                                                    <h3 class="text-lg font-bold text-black leading-tight pr-8"
                                                        x-text="item.name"></h3>
                                                    <p class="text-sm text-gray-500 mt-1">Brand: <span
                                                            x-text="item.brand"></span></p>
                                                    <p class="text-sm text-brand-sand font-medium mt-1.5" x-show="item.variant_name" x-text="item.variant_name"></p>
                                                </div>

                                                <!-- Two-Way Bound Meters/Boxes adjustment inline -->
                                                <div class="flex flex-wrap items-center gap-4 mt-3" x-data="{
                                                    init() {
                                                        let match = (item.variant_name || '').match(/(\d+)\s*pcs?/i);
                                                        let parsedPcs = match ? parseInt(match[1]) : null;
                                                        if (parsedPcs && (!item.pcs_per_box || item.pcs_per_box === 1)) {
                                                            item.pcs_per_box = parsedPcs;
                                                            let sqmPerPiece = item.sqm_per_piece || window.parseSqmFromName(item.variant_name) || 1;
                                                            item.sqm_per_box = sqmPerPiece * item.pcs_per_box;
                                                            if (item.meters) {
                                                                item.boxes = Math.ceil(item.meters / item.sqm_per_box);
                                                            }
                                                            item.pcs = item.boxes * item.pcs_per_box;
                                                        }

                                                        if (!item.pcs_per_box) item.pcs_per_box = 1;
                                                        if (item.sqm_per_box === undefined || item.sqm_per_box === null || item.sqm_per_box === 0) {
                                                            let sqmPerPiece = item.sqm_per_piece || window.parseSqmFromName(item.variant_name) || 1;
                                                            item.sqm_per_box = sqmPerPiece * item.pcs_per_box;
                                                        }
                                                        if (!item.boxes) {
                                                            if (item.meters && item.sqm_per_box > 0) {
                                                                item.boxes = Math.ceil(item.meters / item.sqm_per_box);
                                                            } else {
                                                                item.boxes = item.quantity || 1;
                                                            }
                                                        }
                                                        if (!item.pcs) {
                                                            item.pcs = item.boxes * item.pcs_per_box;
                                                        }
                                                    },
                                                    updateMeters(m) {
                                                        let inputMeters = parseFloat(m) || 0;
                                                        let sqmPerBox = parseFloat(item.sqm_per_box || 0);
                                                        if (sqmPerBox > 0) {
                                                            item.boxes = Math.ceil(inputMeters / sqmPerBox);
                                                            item.meters = parseFloat((item.boxes * sqmPerBox).toFixed(2));
                                                            item.pcs = item.boxes * parseInt(item.pcs_per_box || 1);
                                                        } else {
                                                            item.meters = inputMeters;
                                                        }
                                                        item.quantity = item.pcs;
                                                        $store.quoteCart.save();
                                                    },
                                                    updateBoxes(b) {
                                                        item.boxes = Math.max(1, parseInt(b) || 1);
                                                        let sqmPerBox = parseFloat(item.sqm_per_box || 0);
                                                        if (sqmPerBox > 0) {
                                                            item.meters = parseFloat((item.boxes * sqmPerBox).toFixed(2));
                                                        }
                                                        item.pcs = item.boxes * parseInt(item.pcs_per_box || 1);
                                                        item.quantity = item.pcs;
                                                        $store.quoteCart.save();
                                                    }
                                                }">
                                                    <!-- Meters -->
                                                    <div class="flex items-center gap-1.5">
                                                        <label class="text-[10px] uppercase tracking-wider text-brand-charcoal/40 font-bold">m²</label>
                                                        <input type="number" step="any" min="0.01" 
                                                            :value="item.meters" 
                                                            @input="updateMeters($event.target.value)"
                                                            class="w-16 bg-white border border-[#EBEBEB] px-2 py-1 text-xs text-black focus:ring-1 focus:ring-black focus:border-black transition-all">
                                                    </div>

                                                    <!-- Boxes decrement/increment -->
                                                    <div class="flex items-center gap-1.5">
                                                        <label class="text-[10px] uppercase tracking-wider text-brand-charcoal/40 font-bold">boxes</label>
                                                        <div class="flex items-center bg-white border border-[#EBEBEB] px-2 py-0.5 shadow-sm gap-2">
                                                            <button type="button" @click="if(item.boxes > 1) updateBoxes(item.boxes - 1)"
                                                                class="text-sm leading-none text-black">&minus;</button>
                                                            <span class="text-xs font-semibold w-6 text-center select-none text-black"
                                                                x-text="item.boxes || 1"></span>
                                                            <button type="button"
                                                                @click="updateBoxes(parseInt(item.boxes || 1) + 1)"
                                                                class="text-sm leading-none text-black">&plus;</button>
                                                        </div>
                                                    </div>

                                                    <!-- Static display of equivalent pieces -->
                                                    <div class="flex items-center gap-1.5 text-[10px] uppercase tracking-wider text-brand-charcoal/40 font-bold">
                                                        <span x-text="item.pcs + ' pcs'"></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Trash Icon (top right) -->
                                            <button type="button" @click="$store.quoteCart.remove(item.cart_id)"
                                                class="absolute top-6 right-0 text-[#FF4B4B] hover:text-red-700 transition-colors">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    fill="currentColor" class="w-5 h-5">
                                                    <path fill-rule="evenodd"
                                                        d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>

                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>

                        <!-- Quote Request Form -->
                        <div class="lg:col-span-5">
                            <div class="bg-[#FCFCFC]  border border-[#EBEBEB] p-6 md:p-8 shadow-sm sticky top-24">
                                <h2 class="text-xl font-bold text-black mb-6">{{ __('messages.quote.contact_details') }}
                                </h2>

                                <template x-if="success">
                                    <div class="bg-green-50 text-green-800 p-4 mb-6 text-sm">
                                        {{ __('messages.quote.success_message') }}
                                    </div>
                                </template>

                                <template x-if="error">
                                    <div class="bg-red-50 text-red-800  p-4 mb-6 text-sm" x-text="error"></div>
                                </template>

                                <form @submit.prevent="submitQuote" x-show="!success" class="space-y-4">
                                    <div class="space-y-4 pb-6 border-b border-[#EBEBEB]">
                                        <div class="grid grid-cols-2 gap-3">
                                            <input type="text" x-model="form.first_name" required
                                                placeholder="{{ __('messages.quote.form_first_name') }}"
                                                class="w-full bg-white border border-[#EBEBEB]  px-4 py-3 text-black placeholder-gray-400 focus:ring-1 focus:ring-black focus:border-black transition-all text-sm">
                                            <input type="text" x-model="form.last_name" required
                                                placeholder="{{ __('messages.quote.form_last_name') }}"
                                                class="w-full bg-white border border-[#EBEBEB]  px-4 py-3 text-black placeholder-gray-400 focus:ring-1 focus:ring-black focus:border-black transition-all text-sm">
                                        </div>

                                        <input type="tel" x-model="form.phone"
                                            placeholder="{{ __('messages.quote.form_phone') }}"
                                            class="w-full bg-white border border-[#EBEBEB]  px-4 py-3 text-black placeholder-gray-400 focus:ring-1 focus:ring-black focus:border-black transition-all text-sm">

                                        <input type="email" x-model="form.email" required
                                            placeholder="{{ __('messages.quote.form_email') }}"
                                            class="w-full bg-white border border-[#EBEBEB]  px-4 py-3 text-black placeholder-gray-400 focus:ring-1 focus:ring-black focus:border-black transition-all text-sm">

                                        <input type="text" x-model="form.company"
                                            placeholder="{{ __('messages.quote.form_company') }}"
                                            class="w-full bg-white border border-[#EBEBEB]  px-4 py-3 text-black placeholder-gray-400 focus:ring-1 focus:ring-black focus:border-black transition-all text-sm">

                                        <textarea x-model="form.message" rows="3"
                                            placeholder="{{ __('messages.quote.form_message') }}"
                                            class="w-full bg-white border border-[#EBEBEB]  px-4 py-3 text-black placeholder-gray-400 focus:ring-1 focus:ring-black focus:border-black transition-all text-sm resize-none"></textarea>
                                    </div>

                                    <div class="pt-2">
                                        <button type="submit" :disabled="loading"
                                            class="w-full bg-black hover:bg-gray-900 text-white  py-4 px-6 flex items-center justify-center gap-3 transition-colors">
                                            <span x-show="!loading"
                                                class="font-medium text-base">{{ __('messages.quote.submit_btn') }}</span>
                                            <svg x-show="!loading" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                            </svg>

                                            <svg x-show="loading" class="animate-spin h-5 w-5 text-white"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                                    stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor"
                                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </template>
            </div>
        </div>
    </section>

    <script>
        function quoteForm() {
            return {
                form: {
                    first_name: '',
                    last_name: '',
                    email: '',
                    phone: '',
                    company: '',
                    message: '',
                    project_type: ''
                },
                loading: false,
                success: false,
                error: null,

                async submitQuote() {
                    this.loading = true;
                    this.error = null;

                    const payload = {
                        ...this.form,
                        items: this.$store.quoteCart.items.map(item => ({
                                product_id: item.product_id,
                                variant_name: item.variant_name || null,
                                meters: item.meters || null,
                                quantity: item.pcs || item.quantity || null,
                                boxes: item.boxes || null,
                                pcs: item.pcs || null,
                                pcs_per_box: item.pcs_per_box || null,
                                sqm_per_box: item.sqm_per_box || null
                        }))
                    };

                    try {
                        const response = await fetch('{{ route('quote.store', app()->getLocale()) }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify(payload)
                        });

                        const data = await response.json();

                        if (response.ok) {
                            this.$store.quoteCart.clear();
                            window.location.href = `/${'{{ app()->getLocale() }}'}/quote/thank-you/${data.quote_id}`;
                        } else {
                            this.error = data.message || 'An error occurred.';
                        }
                    } catch (err) {
                        this.error = 'Failed to connect to the server. Please try again.';
                    } finally {
                        this.loading = false;
                    }
                }
            }
        }
    </script>
@endsection