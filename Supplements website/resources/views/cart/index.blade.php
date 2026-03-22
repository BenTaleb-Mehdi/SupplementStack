@extends('layouts.main')

@section('title', 'Shopping Cart - Mini Market')

@section('content')
<div class="bg-gray-50 min-h-[calc(100vh-80px)] py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-heading font-bold text-gray-900 mb-8">Shopping Cart</h1>

        @if(count($cartItems) > 0)
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Cart Items List -->
                <div class="flex-1">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="p-6">
                            <div class="flex justify-between items-center mb-6 border-b border-gray-100 pb-4">
                                <h2 class="text-lg font-bold text-gray-900">Cart Items ({{ count($cartItems) }})</h2>
                                <form method="POST" action="{{ route('cart.clear') }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm text-red-600 hover:text-red-700 font-medium hover:underline" onclick="return confirm('Are you sure you want to clear your cart?')">
                                        Clear All
                                    </button>
                                </form>
                            </div>

                            <div class="space-y-6">
                                @foreach($cartItems as $item)
                                    <div class="flex flex-col sm:flex-row items-center gap-6 pb-6 border-b border-gray-100 last:border-0 last:pb-0">
                                        <!-- Product Image -->
                                        <div class="w-24 h-24 flex-shrink-0 bg-gray-100 rounded-xl overflow-hidden border border-gray-200">
                                            @if($item['product']->image)
                                                <img src="{{ $item['product']->image_url }}" alt="{{ $item['product']->name }}" class="w-full h-full object-cover" onerror="this.onerror=null; this.src='{{ asset('images/placeholder.svg') }}';">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Product Details -->
                                        <div class="flex-1 text-center sm:text-left">
                                            <h3 class="text-lg font-bold text-gray-900 mb-1">
                                                <a href="{{ route('products.show', $item['product']) }}" class="hover:text-primary-600 transition-colors">
                                                    {{ $item['product']->name }}
                                                </a>
                                            </h3>
                                            <p class="text-sm text-gray-500 mb-2">{{ ucfirst($item['product']->category) }}</p>
                                            <div class="text-primary-600 font-bold">
                                                {{ App\Models\Setting::formatPrice($item['product']->price) }}
                                            </div>
                                        </div>

                                        <!-- Quantity Controls -->
                                        <div class="flex items-center gap-3">
                                            <form method="POST" action="{{ route('cart.update', $item['product']) }}" class="flex items-center bg-gray-50 rounded-lg p-1 border border-gray-200">
                                                @csrf
                                                @method('PATCH')
                                                <button type="button" onclick="decrementQuantity(this)" class="w-8 h-8 flex items-center justify-center rounded-md bg-white text-gray-600 shadow-sm hover:bg-gray-100 transition-colors">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                                                </button>
                                                
                                                <input type="number" 
                                                       name="quantity" 
                                                       value="{{ $item['quantity'] }}" 
                                                       min="1" 
                                                       max="{{ $item['product']->stock }}"
                                                       class="w-12 text-center bg-transparent border-0 focus:ring-0 p-0 text-sm font-bold text-gray-900"
                                                       readonly>
                                                
                                                <button type="button" onclick="incrementQuantity(this)" class="w-8 h-8 flex items-center justify-center rounded-md bg-white text-gray-600 shadow-sm hover:bg-gray-100 transition-colors">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                                </button>
                                            </form>
                                            
                                            <form method="POST" action="{{ route('cart.remove', $item['product']) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 text-gray-400 hover:text-red-600 transition-colors" title="Remove item">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </div>

                                        <!-- Subtotal -->
                                        <div class="sm:text-right min-w-[100px]">
                                            <p class="text-xs text-gray-500 mb-1">Subtotal</p>
                                            <p class="text-lg font-bold text-gray-900">{{ App\Models\Setting::formatPrice($item['subtotal']) }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('products.list') }}" class="inline-flex items-center text-primary-600 hover:text-primary-700 font-medium transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                            Continue Shopping
                        </a>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="w-full lg:w-1/3">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sticky top-24">
                        <h2 class="text-lg font-bold text-gray-900 mb-6">Order Summary</h2>
                        
                        <div class="space-y-4 mb-6">
                            <div class="flex justify-between items-center text-gray-600">
                                <span>Subtotal</span>
                                <span class="font-medium text-gray-900">{{ App\Models\Setting::formatPrice($total) }}</span>
                            </div>
                            <div class="flex justify-between items-center text-gray-600">
                                <span>Shipping</span>
                                <span class="text-green-600 font-medium">Free</span>
                            </div>
                            <div class="border-t border-gray-100 pt-4 flex justify-between items-center text-lg font-bold text-gray-900">
                                <span>Total</span>
                                <span class="text-primary-600">{{ App\Models\Setting::formatPrice($total) }}</span>
                            </div>
                        </div>

                        <a href="{{ route('checkout.index') }}" class="w-full block bg-primary-600 text-white text-center font-bold py-4 rounded-xl shadow-lg hover:bg-primary-700 hover:shadow-primary-500/30 transition-all transform hover:-translate-y-0.5">
                            Proceed to Checkout
                        </a>
                        
                        <div class="mt-6 flex items-center justify-center gap-4 text-gray-400">
                            <!-- Trust Badges (Icons) -->
                            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-24 bg-white rounded-2xl border border-gray-100 shadow-sm">
                <div class="bg-primary-50 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Your cart is empty</h2>
                <p class="text-gray-500 mb-8 max-w-md mx-auto">Looks like you haven't added anything to your cart yet. Browse our products to find something you'll love.</p>
                <a href="{{ route('products.list') }}" class="inline-flex items-center px-8 py-3 bg-primary-600 text-white font-bold rounded-xl hover:bg-primary-700 shadow-lg hover:shadow-primary-500/30 transition-all transform hover:-translate-y-0.5">
                    Start Shopping
                </a>
            </div>
        @endif
    </div>
</div>

<script>
    function incrementQuantity(button) {
        const input = button.form.querySelector('input[name="quantity"]');
        const max = parseInt(input.getAttribute('max'));
        const current = parseInt(input.value);
        
        if (current < max) {
            input.value = current + 1;
            // Create a hidden input to submit the form
            let hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'quantity';
            hiddenInput.value = current + 1;
            button.form.appendChild(hiddenInput);
            button.form.submit();
        }
    }

    function decrementQuantity(button) {
        const input = button.form.querySelector('input[name="quantity"]');
        const current = parseInt(input.value);
        
        if (current > 1) {
            input.value = current - 1;
            // Create a hidden input to submit the form
            let hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'quantity';
            hiddenInput.value = current - 1;
            button.form.appendChild(hiddenInput);
            button.form.submit();
        }
    }
</script>
@endsection
