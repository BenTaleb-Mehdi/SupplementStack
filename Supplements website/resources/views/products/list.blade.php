@extends('layouts.main')

@section('title', 'The Catalog - Premium Supplements')

@section('content')
<div class="bg-white min-h-screen">
    <div class="pt-24 pb-16 border-b border-slate-50">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center space-y-4">
            <h1 class="text-[10px] font-black uppercase tracking-[0.5em] text-primary-600">Inventory Drop 2026</h1>
            <h2 class="text-5xl md:text-7xl font-black text-slate-900 tracking-tighter uppercase">
                Explore The <span class="italic font-light text-slate-400">Market</span>
            </h2>
            <p class="max-w-xl mx-auto text-slate-500 font-light text-lg">
                High-performance formulas curated for elite results.
            </p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-16">
        <div class="flex flex-col lg:flex-row gap-16">
            
            <div class="w-full lg:w-1/4">
                <div class="sticky top-32 space-y-12">
                    <form method="GET" action="{{ route('products.list') }}" id="filterForm">
                        
                        <div class="group border-b border-slate-200 focus-within:border-primary-500 transition-all pb-2 mb-12">
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 block mb-2">Search Catalog</label>
                            <div class="relative">
                                <input type="text" name="search" value="{{ request('search') }}" placeholder="Find your fuel..." 
                                       class="w-full bg-transparent border-none p-0 text-slate-900 placeholder:text-slate-200 focus:ring-0 text-lg">
                            </div>
                        </div>

                        <div class="mb-12">
                            <h3 class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-6">Categories</h3>
                            <div class="space-y-4 font-bold text-sm tracking-tight uppercase">
                                <label class="flex items-center group cursor-pointer">
                                    <input type="radio" name="category" value="" class="hidden" {{ request('category') == '' ? 'checked' : '' }}>
                                    <span class="relative pb-1 {{ request('category') == '' ? 'text-slate-950 border-b-2 border-slate-950' : 'text-slate-300 group-hover:text-slate-500' }} transition-all">All Collections</span>
                                </label>
                                @foreach($categories as $cat)
                                    <label class="flex items-center group cursor-pointer uppercase">
                                        <input type="radio" name="category" value="{{ $cat->slug }}" class="hidden" {{ request('category') == $cat->slug ? 'checked' : '' }}>
                                        <span class="relative pb-1 {{ request('category') == $cat->slug ? 'text-slate-950 border-b-2 border-slate-950' : 'text-slate-300 group-hover:text-slate-500' }} transition-all">
                                            {{ $cat->name }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="mb-12">
                            <h3 class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-6">Price Range</h3>
                            <div class="flex items-center gap-4">
                                <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="MIN" 
                                       class="w-full bg-slate-50 border-none rounded-xl py-3 px-4 text-xs font-bold focus:ring-1 focus:ring-primary-500">
                                <span class="text-slate-200">—</span>
                                <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="MAX" 
                                       class="w-full bg-slate-50 border-none rounded-xl py-3 px-4 text-xs font-bold focus:ring-1 focus:ring-primary-500">
                            </div>
                        </div>

                        <div class="mb-12">
                            <h3 class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-6">Sort Preference</h3>
                            <select name="sort" class="w-full bg-transparent border-b border-slate-200 border-x-0 border-t-0 p-0 pb-2 text-sm font-bold uppercase focus:ring-0 focus:border-primary-500">
                                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest Arrivals</option>
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low-High</option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High-Low</option>
                            </select>
                        </div>

                        <a href="{{ route('products.list') }}" class="text-[9px] font-black uppercase tracking-widest text-red-500 hover:text-red-700 transition-colors">
                            Reset All Filters
                        </a>
                    </form>
                </div>
            </div>

            <div class="w-full lg:w-3/4">
                 @if($products->count() > 0)
                    <div class="mb-10 flex items-center justify-between border-b border-slate-50 pb-6">
                         <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                            Catalogue / <span class="text-slate-900 underline underline-offset-4">{{ $products->count() }} Items found</span>
                         </p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-10 gap-y-20">
                        @foreach($products as $product)
                            <div class="group flex flex-col h-full">
                                <div class="relative aspect-[1/1] mb-6 rounded-[2.5rem] bg-slate-50 overflow-hidden transition-all duration-700 group-hover:shadow-[0_40px_80px_-20px_rgba(0,0,0,0.1)]">
                                    @if($product->image)
                                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" 
                                             class="w-full h-full object-contain p-8 transition-transform duration-700 group-hover:scale-110">
                                    @else
                                        <div class="flex items-center justify-center h-full bg-slate-50 text-slate-200">
                                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                    @endif

                                    <div class="absolute top-6 left-6">
                                        @if($product->stock < 5 && $product->stock > 0)
                                            <span class="bg-orange-500 text-white text-[8px] font-black px-3 py-1 rounded-full uppercase tracking-widest">Low Stock</span>
                                        @elseif(!$product->stock)
                                            <span class="bg-slate-900 text-white text-[8px] font-black px-3 py-1 rounded-full uppercase tracking-widest italic font-light">Archived</span>
                                        @endif
                                    </div>

                                    <div class="absolute inset-0 bg-slate-950/5 opacity-0 group-hover:opacity-100 transition-opacity flex items-end justify-center pb-8 backdrop-blur-[2px]">
                                        <a href="{{ route('products.show', $product) }}" class="bg-white text-slate-950 px-8 py-3 rounded-full text-[10px] font-black uppercase tracking-[0.2em] shadow-2xl translate-y-4 group-hover:translate-y-0 transition-all duration-500">
                                            View Profile
                                        </a>
                                    </div>
                                </div>

                                <div class="px-2">
                                    <p class="text-[9px] font-black text-primary-600 uppercase tracking-widest mb-2">{{ $product->category->name ?? 'Series' }}</p>
                                    <h3 class="text-xl font-black text-slate-900 tracking-tighter uppercase italic line-clamp-1 mb-4">
                                        <a href="{{ route('products.show', $product) }}">{{ $product->name }}</a>
                                    </h3>
                                    <div class="flex items-center justify-between">
                                        <span class="text-2xl font-black tracking-tighter text-slate-900 italic">
                                            {{ App\Models\Setting::formatPrice($product->price) }}
                                        </span>
                                        
                                        @if($product->stock > 0 && $product->is_active)
                                            <form action="{{ route('cart.add', $product) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="quantity" value="1">
                                                <button type="submit" class="group/btn relative w-10 h-10 bg-slate-950 rounded-full flex items-center justify-center transition-all hover:bg-primary-600">
                                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="mt-20 border-t border-slate-50 pt-10">
                        {{ $products->appends(request()->query())->links() }}
                    </div>
                @else
                    <div class="py-40 text-center bg-slate-50 rounded-[3rem] border border-slate-100">
                        <h3 class="text-2xl font-black text-slate-300 uppercase italic tracking-widest italic">Inventory Empty</h3>
                        <a href="{{ route('products.list') }}" class="mt-4 inline-block text-[10px] font-black uppercase tracking-widest underline underline-offset-8">Clear all filters</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterForm = document.getElementById('filterForm');
    if (filterForm) {
        // Auto-submit logic (Optimized)
        const inputs = filterForm.querySelectorAll('input[type="radio"], select');
        inputs.forEach(input => {
            input.addEventListener('change', () => filterForm.submit());
        });

        let timeout;
        const textInputs = filterForm.querySelectorAll('input[type="text"], input[type="number"]');
        textInputs.forEach(input => {
            input.addEventListener('input', () => {
                clearTimeout(timeout);
                timeout = setTimeout(() => filterForm.submit(), 1000);
            });
        });
    }
});
</script>
@endsection