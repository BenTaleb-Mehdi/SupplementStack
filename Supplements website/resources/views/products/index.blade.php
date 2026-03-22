@extends('layouts.main')

@section('title', 'Mini Market - Premium Health & Wellness')

@section('content')
<!-- Hero Section -->
<div class="relative {{ App\Models\Setting::get('home_hero_height', 'min-h-[95vh]') }} flex items-center bg-white overflow-hidden">
    
    <div class="absolute inset-0 z-0">
        @php $homeHeroImage = App\Models\Setting::get('home_hero_image'); @endphp
        <img class="w-full h-full object-cover transition-transform duration-[10s] hover:scale-110" 
             src="{{ $homeHeroImage ? asset('storage/' . $homeHeroImage) : 'https://images.unsplash.com/photo-1534438327276-14e5300c3a48?q=80&w=2070&auto=format&fit=crop' }}" 
             alt="Athlete Fitness">
        
        <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/20 to-transparent"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-transparent to-white"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8">
        <div class="flex flex-col items-start gap-8">
            
            <div class="backdrop-blur-md bg-white/10 border border-white/20 px-4 py-2 rounded-full flex items-center gap-3">
                <span class="flex h-2 w-2 rounded-full bg-primary-500 shadow-[0_0_10px_#primary-500]"></span>
                <span class="text-[10px] font-bold text-white uppercase tracking-[0.3em]">{{ App\Models\Setting::get('home_hero_badge', 'Scientific Performance') }}</span>
            </div>

            <div class="space-y-2">
                <h1 class="text-6xl md:text-[7rem] font-black text-white leading-none tracking-tighter drop-shadow-2xl">
                    {!! App\Models\Setting::get('home_hero_title', 'PUSH <br> <span class="text-primary-500">BEYOND.</span>') !!}
                </h1>
            </div>

            <div class="backdrop-blur-xl bg-black/30 border border-white/10 p-8 rounded-[2rem] max-w-xl">
                <p class="text-gray-100 text-lg font-light leading-relaxed">
                    {{ App\Models\Setting::get('home_hero_subtitle', 'Premium formulas designed for those who measure success in sweat and results. Your elite journey starts with the right fuel.') }}
                </p>
                
                <div class="mt-8 flex flex-wrap gap-4">
                    <a href="#products" class="bg-white text-black px-10 py-4 rounded-full font-black uppercase text-xs tracking-widest hover:bg-primary-500 hover:text-white transition-all shadow-xl shadow-black/20">
                        {{ App\Models\Setting::get('home_hero_cta_text', 'Shop Now') }}
                    </a>
                    <a href="#about" class="group flex items-center gap-3 text-white font-bold uppercase text-[10px] tracking-widest">
                        <span class="w-10 h-10 rounded-full border border-white/30 flex items-center justify-center group-hover:bg-white group-hover:text-black transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/></svg>
                        </span>
                        Watch Science
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="absolute top-1/2 right-12 -translate-y-1/2 hidden xl:block space-y-4">
        <div class="w-1 h-12 bg-white/20 rounded-full relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-1/2 bg-primary-500"></div>
        </div>
        <p class="text-white font-black text-xs vertical-text rotate-180 uppercase tracking-widest opacity-50">Discovery</p>
    </div>
</div>

<style>
    .vertical-text {
        writing-mode: vertical-rl;
    }
</style>

<section id="about" class="py-32 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        
        <div class="flex flex-col lg:flex-row lg:items-end justify-between mb-24 gap-8">
            <div class="max-w-2xl">
                <h2 class="text-[10px] font-black uppercase tracking-[0.4em] text-primary-500 mb-4">Engineering Excellence</h2>
                <h3 class="text-5xl md:text-7xl font-black text-slate-900 leading-[0.9] tracking-tighter">
                    BUILT FOR <br> PERFORMANCE.
                </h3>
            </div>
            <p class="text-slate-500 text-lg max-w-sm leading-relaxed font-light">
                We provide the precision fuel you need to crush your limits and redefine what’s possible.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-16">
            
            <div class="group relative">
                <div class="mb-8 overflow-hidden rounded-3xl bg-slate-50 p-12 transition-all duration-500 group-hover:bg-slate-900">
                    <svg class="w-12 h-12 text-primary-500 transition-transform duration-500 group-hover:scale-110 group-hover:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h4 class="text-2xl font-black text-slate-900 mb-4 tracking-tight group-hover:text-primary-600 transition-colors">Maximum Potency</h4>
                <p class="text-slate-500 leading-relaxed font-light">Scientifically formulated ingredients to deliver peak performance and verified results in every serving.</p>
                <div class="mt-6 w-8 h-1 bg-slate-100 group-hover:w-20 group-hover:bg-primary-500 transition-all duration-500"></div>
            </div>

            <div class="group relative">
                <div class="mb-8 overflow-hidden rounded-3xl bg-slate-50 p-12 transition-all duration-500 group-hover:bg-slate-900">
                    <svg class="w-12 h-12 text-primary-500 transition-transform duration-500 group-hover:scale-110 group-hover:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h4 class="text-2xl font-black text-slate-900 mb-4 tracking-tight group-hover:text-primary-600 transition-colors">Lab Tested Purity</h4>
                <p class="text-slate-500 leading-relaxed font-light">Every batch is third-party tested for banned substances and impurities. Safe for professional sport.</p>
                <div class="mt-6 w-8 h-1 bg-slate-100 group-hover:w-20 group-hover:bg-primary-500 transition-all duration-500"></div>
            </div>

            <div class="group relative">
                <div class="mb-8 overflow-hidden rounded-3xl bg-slate-50 p-12 transition-all duration-500 group-hover:bg-slate-900">
                    <svg class="w-12 h-12 text-primary-500 transition-transform duration-500 group-hover:scale-110 group-hover:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h4 class="text-2xl font-black text-slate-900 mb-4 tracking-tight group-hover:text-primary-600 transition-colors">Fast Recovery</h4>
                <p class="text-slate-500 leading-relaxed font-light">Advanced formulas designed to help your muscles recover faster so you can train harder, sooner.</p>
                <div class="mt-6 w-8 h-1 bg-slate-100 group-hover:w-20 group-hover:bg-primary-500 transition-all duration-500"></div>
            </div>

        </div>
    </div>
</section>

<section class="py-24 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
            <div>
                <h2 class="text-[10px] font-black uppercase tracking-[0.4em] text-primary-600 mb-4">The Collection</h2>
                <h3 class="text-4xl md:text-6xl font-black text-slate-900 tracking-tighter">BROWSE <span class="italic font-light text-slate-400">by</span> CATEGORY</h3>
            </div>
            <p class="text-slate-500 max-w-xs font-light leading-relaxed">
                Precision-engineered supplements tailored for your specific fitness goals.
            </p>
        </div>

        @if($categories->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach($categories as $category)
                    <a href="{{ route('products.list', ['category' => $category->slug]) }}" 
                       class="group relative h-[450px] w-full overflow-hidden rounded-[2rem] bg-slate-100 flex flex-col justify-end p-8 transition-all duration-700 hover:shadow-2xl hover:shadow-primary-900/20">
                        
                        <div class="absolute inset-0 z-0 transition-transform duration-1000 group-hover:scale-110">
                            @if($category->image)
                                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-slate-200 flex items-center justify-center">
                                     <svg class="w-16 h-16 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/20 to-transparent opacity-80 group-hover:opacity-90 transition-opacity"></div>
                        </div>

                        <div class="relative z-10">
                            <h3 class="text-2xl font-black text-white tracking-tight mb-2 group-hover:text-primary-400 transition-colors">
                                {{ $category->name }}
                            </h3>
                            
                            @if($category->description)
                                <p class="text-slate-300 text-sm font-light line-clamp-2 mb-6 opacity-0 group-hover:opacity-100 transition-all duration-500 translate-y-4 group-hover:translate-y-0">
                                    {{ $category->description }}
                                </p>
                            @endif

                            <div class="flex items-center gap-2 text-white text-[10px] font-bold uppercase tracking-[0.2em]">
                                <span>Explore All</span>
                                <div class="w-8 h-px bg-white group-hover:w-12 transition-all group-hover:bg-primary-500"></div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="text-center py-24 bg-slate-50 rounded-[3rem] border-2 border-dashed border-slate-200">
                <p class="text-slate-400 font-medium">No categories found in our laboratory yet.</p>
            </div>
        @endif
    </div>
</section>

@if($promotions->count() > 0)
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6 border-b border-slate-100 pb-12">
            <div>
                <h2 class="text-[10px] font-black uppercase tracking-[0.4em] text-red-600 mb-4 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-red-600 animate-ping"></span>
                    Limited Time
                </h2>
                <h3 class="text-4xl md:text-6xl font-black text-slate-900 tracking-tighter uppercase">
                    Special <span class="italic font-light text-slate-400">Offers</span>
                </h3>
            </div>
            <p class="text-slate-500 max-w-xs font-light leading-relaxed">
                Premium performance, exceptional value. Grab your essentials before the clock runs out.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">
            @foreach($promotions as $promo)
                @if($promo->product && $promo->product->is_active)
                <div class="group flex flex-col h-full relative">
                    <div class="absolute top-4 left-4 z-20">
                        <span class="bg-red-600 text-white text-[10px] font-black px-4 py-1.5 rounded-full tracking-widest shadow-xl">
                            -{{ $promo->discount_percentage }}%
                        </span>
                    </div>

                    <div class="relative aspect-[4/5] overflow-hidden rounded-[2.5rem] bg-slate-50 border border-slate-100 transition-all duration-500 group-hover:shadow-2xl group-hover:shadow-slate-200">
                        @if($promo->product->image)
                            <img src="{{ $promo->product->image_url }}" alt="{{ $promo->product->name }}" 
                                 class="w-full h-full object-contain p-8 transition-transform duration-700 group-hover:scale-110">
                        @else
                            <div class="flex items-center justify-center h-full bg-slate-100 text-slate-300">
                                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        @endif

                        <div class="absolute bottom-6 left-1/2 -translate-x-1/2 translate-y-8 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500">
                            <a href="{{ route('products.show', $promo->product) }}" class="bg-slate-900 text-white px-8 py-3 rounded-full text-[10px] font-bold uppercase tracking-widest whitespace-nowrap shadow-2xl">
                                Quick Shop
                            </a>
                        </div>
                    </div>

                    <div class="mt-8 space-y-3 px-2">
                        <h3 class="text-xl font-black text-slate-900 tracking-tight group-hover:text-primary-600 transition-colors line-clamp-1 italic uppercase">
                            {{ $promo->product->name }}
                        </h3>
                        
                        <div class="flex items-center gap-3">
                            <span class="text-2xl font-black text-slate-900">
                                {{ \App\Models\Setting::formatPrice($promo->discounted_price) }}
                            </span>
                            <span class="text-sm text-slate-400 line-through font-light">
                                {{ \App\Models\Setting::formatPrice($promo->product->price) }}
                            </span>
                        </div>

                        <div class="flex items-center gap-2 pt-2">
                            <div class="flex-1 h-[2px] bg-slate-100">
                                <div class="h-full bg-slate-900 transition-all duration-1000" style="width: {{ min(($promo->product->stock / 50) * 100, 100) }}%"></div>
                            </div>
                            <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">
                                {{ $promo->product->stock }} Left
                            </span>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
        </div>
    </div>
</section>
@endif

<section id="products" class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-20 gap-6">
            <div class="space-y-2">
                <h2 class="text-[10px] font-black uppercase tracking-[0.4em] text-primary-600">The Laboratory</h2>
                <h3 class="text-4xl md:text-6xl font-black text-slate-900 tracking-tighter uppercase">
                    Featured <span class="italic font-light text-slate-400">Products</span>
                </h3>
            </div>
            <a href="{{ route('products.list') }}" class="group flex items-center gap-3 text-slate-900 font-bold uppercase text-[10px] tracking-widest border-b-2 border-slate-900 pb-2 hover:border-primary-500 transition-all">
                View Entire Collection
                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>

        @if($products->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-x-8 gap-y-16">
                @foreach($products as $product)
                    <div class="group flex flex-col h-full">
                        
                        <div class="relative aspect-[1/1] mb-8 bg-slate-50 rounded-[2.5rem] overflow-hidden transition-all duration-500 group-hover:shadow-[0_30px_60px_-15px_rgba(0,0,0,0.1)]">
                            <div class="absolute top-6 right-6 z-10">
                                @if($product->stock < 5 && $product->stock > 0)
                                    <span class="bg-orange-500 text-white text-[8px] font-black px-3 py-1 rounded-full uppercase tracking-widest shadow-lg">Low Stock</span>
                                @elseif(!$product->stock)
                                    <span class="bg-slate-900 text-white text-[8px] font-black px-3 py-1 rounded-full uppercase tracking-widest">Sold Out</span>
                                @endif
                            </div>

                            @if($product->image)
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" 
                                     class="w-full h-full object-contain p-10 transition-transform duration-700 group-hover:scale-110">
                            @else
                                <div class="flex items-center justify-center h-full bg-slate-50">
                                    <svg class="w-12 h-12 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                </div>
                            @endif

                            <div class="absolute inset-0 bg-slate-950/5 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-[2px]">
                                @if($product->stock > 0)
                                    @auth
                                        <form action="{{ route('cart.add', $product) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" class="bg-white text-slate-900 px-8 py-3 rounded-full font-black text-[10px] uppercase tracking-widest shadow-2xl hover:bg-primary-500 hover:text-white transition-all transform translate-y-4 group-hover:translate-y-0 duration-500">
                                                Add to Cart
                                            </button>
                                        </form>
                                    @else
                                        <a href="{{ route('login') }}" class="bg-white text-slate-900 px-8 py-3 rounded-full font-black text-[10px] uppercase tracking-widest shadow-2xl">
                                            Login to Shop
                                        </a>
                                    @endauth
                                @endif
                            </div>
                        </div>

                        <div class="flex flex-col flex-1 px-2 text-center">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">{{ $product->category->name ?? 'Supplement' }}</p>
                            <h4 class="text-xl font-black text-slate-900 tracking-tight mb-2 group-hover:text-primary-600 transition-colors">
                                <a href="{{ route('products.show', $product) }}">{{ $product->name }}</a>
                            </h4>
                            
                            <div class="mt-auto">
                                <span class="text-2xl font-black text-slate-900 tracking-tighter italic">
                                    {{ App\Models\Setting::formatPrice($product->price) }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-32 bg-slate-50 rounded-[3rem] border border-slate-100">
                <p class="text-slate-400 font-light italic text-lg">Inventory currently empty. Scientific restock in progress.</p>
            </div>
        @endif
    </div>
</section>

<section id="contact" class="bg-white py-32 overflow-hidden border-t border-slate-50">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-24 items-start">
            
            <div class="space-y-12">
                <div class="space-y-4">
                    <h2 class="text-[10px] font-black uppercase tracking-[0.4em] text-primary-600">Support Center</h2>
                    <h3 class="text-4xl md:text-7xl font-black text-slate-900 tracking-tighter leading-[0.9]">
                        HAVE A <br> <span class="italic font-light text-slate-400">Question?</span>
                    </h3>
                    <p class="text-slate-500 text-lg font-light leading-relaxed max-w-md pt-4">
                        Our experts are on standby to help you optimize your performance and nutrition strategy.
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                    <div class="group">
                        <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Phone Support</p>
                        <p class="text-xl font-bold text-slate-900 group-hover:text-primary-600 transition-colors">
                            {{ App\Models\Setting::get('contact_phone', '+1 (555) 123-4567') }}
                        </p>
                    </div>
                    <div class="group">
                        <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Email Inquiry</p>
                        <p class="text-xl font-bold text-slate-900 group-hover:text-primary-600 transition-colors underline decoration-slate-200 underline-offset-8">
                            {{ App\Models\Setting::get('contact_email', 'hello@minimarket.com') }}
                        </p>
                    </div>
                </div>

                <div class="pt-8 border-t border-slate-100">
                    <p class="text-sm italic text-slate-400 font-light">"The difference between the impossible and the possible lies in a person's determination."</p>
                </div>
            </div>

            <div class="relative">
                <div class="absolute -top-12 -right-12 w-64 h-64 bg-slate-50 rounded-full z-0 opacity-50"></div>

                <div class="relative z-10 bg-white border border-slate-100 p-10 sm:p-12 rounded-[3rem] shadow-[0_50px_100px_-20px_rgba(0,0,0,0.05)]">
                    <h4 class="text-2xl font-black text-slate-900 mb-8 tracking-tight">Send a Message</h4>
                    
                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-8">
                        @csrf
                        <div class="group relative border-b border-slate-200 focus-within:border-primary-500 transition-all">
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400">Full Name</label>
                            <input type="text" name="name" required 
                                   class="w-full bg-transparent border-none px-0 py-3 text-slate-900 placeholder:text-slate-300 focus:ring-0 text-lg" 
                                   placeholder="Your name">
                        </div>

                        <div class="group relative border-b border-slate-200 focus-within:border-primary-500 transition-all">
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400">Email Address</label>
                            <input type="email" name="email" required 
                                   class="w-full bg-transparent border-none px-0 py-3 text-slate-900 placeholder:text-slate-300 focus:ring-0 text-lg" 
                                   placeholder="Your@email.com">
                        </div>

                        <div class="group relative border-b border-slate-200 focus-within:border-primary-500 transition-all">
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400">Your Message</label>
                            <textarea name="message" rows="3" required 
                                      class="w-full bg-transparent border-none px-0 py-3 text-slate-900 placeholder:text-slate-300 focus:ring-0 text-lg resize-none" 
                                      placeholder="How can we assist?"></textarea>
                        </div>

                        <button type="submit" class="w-full bg-slate-900 text-white font-black py-5 rounded-2xl shadow-xl hover:bg-primary-600 transition-all transform hover:-translate-y-1 uppercase tracking-[0.2em] text-xs">
                            Send Inquiry
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
