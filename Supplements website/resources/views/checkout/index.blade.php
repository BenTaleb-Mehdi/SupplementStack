@extends('layouts.main')

@section('title', 'Secure Checkout - Mini Market')

@section('content')
<div class="bg-gray-50 min-h-[calc(100vh-80px)] py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-8">
            
            <!-- Left Column: Payment & Shipping -->
            <div class="flex-1">
                <div class="mb-8">
                    <h1 class="text-3xl font-heading font-bold text-gray-900">Checkout</h1>
                    <p class="text-gray-500 mt-2">Complete your order securely.</p>
                </div>

                <form id="payment-form" class="space-y-6">
                    @csrf
                    
                    <!-- Customer Information Card -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 lg:p-8">
                         <div class="flex items-center mb-6">
                            <div class="w-8 h-8 rounded-full bg-primary-100 flex items-center justify-center text-primary-600 mr-3">
                                <span class="font-bold">1</span>
                            </div>
                            <h2 class="text-xl font-bold text-gray-900">Shipping Information</h2>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <label for="cardholder_name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                                <input type="text" id="cardholder_name" name="cardholder_name" value="{{ Auth::user()->name }}" class="w-full rounded-xl border-gray-200 focus:border-primary-500 focus:ring-primary-500 bg-gray-50 focus:bg-white transition-colors py-3" required>
                            </div>

                            <div class="md:col-span-2">
                                <label for="shipping_address" class="block text-sm font-medium text-gray-700 mb-2">Shipping Address</label>
                                <textarea id="shipping_address" name="shipping_address" rows="3" class="w-full rounded-xl border-gray-200 focus:border-primary-500 focus:ring-primary-500 bg-gray-50 focus:bg-white transition-colors py-3" required>{{ Auth::user()->address }}</textarea>
                            </div>

                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                                <input type="tel" id="phone" name="phone" value="{{ Auth::user()->phone }}" class="w-full rounded-xl border-gray-200 focus:border-primary-500 focus:ring-primary-500 bg-gray-50 focus:bg-white transition-colors py-3" required>
                            </div>

                             <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                                <input type="email" value="{{ Auth::user()->email }}" class="w-full rounded-xl border-gray-200 bg-gray-100 text-gray-500 py-3 cursor-not-allowed" readonly disabled>
                            </div>

                            <div class="md:col-span-2">
                                <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Order Notes <span class="text-gray-400 font-normal">(Optional)</span></label>
                                <textarea id="notes" name="notes" rows="2" class="w-full rounded-xl border-gray-200 focus:border-primary-500 focus:ring-primary-500 bg-gray-50 focus:bg-white transition-colors py-3" placeholder="Any special instructions for delivery..."></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Method Card -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 lg:p-8">
                         <div class="flex items-center mb-6">
                            <div class="w-8 h-8 rounded-full bg-primary-100 flex items-center justify-center text-primary-600 mr-3">
                                <span class="font-bold">2</span>
                            </div>
                            <h2 class="text-xl font-bold text-gray-900">Payment Method</h2>
                        </div>

                        <div class="space-y-4">
                            <label class="relative flex items-start p-4 cursor-pointer rounded-xl border border-gray-200 hover:border-primary-500 hover:bg-primary-50 transition-all group">
                                <div class="flex items-center h-5">
                                    <input type="radio" name="payment_method" value="card" class="focus:ring-primary-500 h-5 w-5 text-primary-600 border-gray-300" checked>
                                </div>
                                <div class="ml-3 text-sm flex-1">
                                    <div class="font-medium text-gray-900 group-hover:text-primary-700">Credit / Debit Card</div>
                                    <p class="text-gray-500">Secure payment via Stripe</p>
                                </div>
                                <div class="flex items-center gap-2">
                                     <svg class="h-6 w-auto text-gray-400" viewBox="0 0 38 24" fill="none"><path d="M35 0H3C1.3 0 0 1.3 0 3v18c0 1.7 1.4 3 3 3h32c1.7 0 3-1.3 3-3V3c0-1.7-1.4-3-3-3z" fill="#00579f"/><path d="M4 10h5v3H4v-3z" fill="#fff"/><path d="M38 3v18c0 1.7-1.3 3-3 3H3c-1.7 0-3-1.3-3-3V3c0-1.7 1.3-3 3-3h32c1.7 0 3 1.3 3 3z" fill="none" stroke="#e6e9ec" stroke-opacity=".1" stroke-width="2"/></svg>
                                </div>
                            </label>

                            <label class="relative flex items-start p-4 cursor-pointer rounded-xl border border-gray-200 hover:border-primary-500 hover:bg-primary-50 transition-all group">
                                <div class="flex items-center h-5">
                                    <input type="radio" name="payment_method" value="cod" class="focus:ring-primary-500 h-5 w-5 text-primary-600 border-gray-300">
                                </div>
                                <div class="ml-3 text-sm flex-1">
                                    <div class="font-medium text-gray-900 group-hover:text-primary-700">Cash on Delivery</div>
                                    <p class="text-gray-500">Pay when you receive your order</p>
                                </div>
                                 <div class="flex items-center gap-2">
                                      <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                </div>
                            </label>
                        </div>

                        <!-- Stripe Element -->
                        <div id="card-container" class="mt-6 pt-6 border-t border-gray-100 animate-fade-in">
                            <label class="block text-sm font-medium text-gray-700 mb-3">Card Details</label>
                            <div id="card-element" class="p-4 rounded-xl border border-gray-200 bg-white shadow-sm focus-within:ring-2 focus-within:ring-primary-500 focus-within:border-primary-500 transition-all">
                                <!-- Stripe Element injected here -->
                            </div>
                            <div id="card-errors" class="mt-2 text-sm text-red-600" role="alert"></div>
                        </div>
                    </div>
                    
                    <!-- Form Actions Container (Hidden, controlled by script) -->
                     <div class="hidden">
                        <button type="submit" id="submit-trigger">Submit</button>
                    </div>
                </form>

                 <!-- Payment Messages -->
                <div id="payment-message" class="hidden mt-6 p-4 rounded-xl border">
                    <p class="text-sm font-medium flex items-center gap-2">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span id="message-text"></span>
                    </p>
                </div>
            </div>

            <!-- Right Column: Order Summary -->
            <div class="w-full lg:w-1/3">
                <div class="sticky top-24 space-y-6">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="p-6 bg-gray-50 border-b border-gray-100">
                             <h3 class="text-lg font-bold text-gray-900">Order Summary</h3>
                        </div>
                        
                        <div class="p-6">
                            <div class="flow-root">
                                <ul class="-my-4 divide-y divide-gray-100">
                                    @foreach($cartItems as $item)
                                        <li class="flex py-4">
                                            <div class="h-16 w-16 flex-shrink-0 overflow-hidden rounded-lg border border-gray-200">
                                                @if($item['product']->image)
                                                    <img src="{{ $item['product']->image_url }}" alt="{{ $item['product']->name }}" class="h-full w-full object-cover object-center" onerror="this.onerror=null; this.src='{{ asset('images/placeholder.svg') }}';">
                                                @else
                                                     <div class="h-full w-full bg-gray-100 flex items-center justify-center">
                                                        <svg class="w-6 h-6 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="ml-4 flex flex-1 flex-col">
                                                <div>
                                                    <div class="flex justify-between text-base font-medium text-gray-900">
                                                        <h3 class="line-clamp-1"><a href="#">{{ $item['product']->name }}</a></h3>
                                                        <p class="ml-4">{{ App\Models\Setting::formatPrice($item['subtotal']) }}</p>
                                                    </div>
                                                    <p class="mt-1 text-sm text-gray-500">{{ ucfirst($item['product']->category) }}</p>
                                                </div>
                                                <div class="flex flex-1 items-end justify-between text-sm">
                                                    <p class="text-gray-500">Qty {{ $item['quantity'] }}</p>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="border-t border-gray-100 mt-6 pt-6 space-y-4">
                                <div class="flex items-center justify-between">
                                    <p class="text-sm text-gray-600">Subtotal</p>
                                    <p class="font-medium text-gray-900">{{ App\Models\Setting::formatPrice($total) }}</p>
                                </div>
                                <div class="flex items-center justify-between">
                                    <p class="text-sm text-gray-600">Shipping</p>
                                    <p class="font-medium text-green-600">Free</p>
                                </div>
                                <div class="flex items-center justify-between border-t border-gray-100 pt-4">
                                    <p class="text-base font-bold text-gray-900">Total</p>
                                    <p class="text-xl font-bold text-primary-600">{{ App\Models\Setting::formatPrice($total) }}</p>
                                </div>
                            </div>
                        </div>

                         <div class="p-6 bg-gray-50 border-t border-gray-100">
                            <button type="button" id="submit-button" class="w-full bg-primary-600 text-white font-bold py-4 rounded-xl shadow-lg hover:bg-primary-700 hover:shadow-primary-500/30 transition-all transform hover:-translate-y-0.5 flex items-center justify-center">
                                <svg id="loading-spinner" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <span id="button-text">Confirm Payment</span>
                            </button>
                            
                            <p class="mt-4 text-center text-xs text-gray-500 flex items-center justify-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                Secure Encrypted Transaction
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script>
    // Initialize Stripe
    const stripe = Stripe('{{ env('STRIPE_KEY', 'pk_test_demo') }}');
    const elements = stripe.elements();
    
    // Create card element with custom styling to match Tailwind
    const cardElement = elements.create('card', {
        style: {
            base: {
                fontSize: '16px',
                color: '#1f2937', // gray-900
                fontFamily: '"Inter", sans-serif',
                '::placeholder': {
                    color: '#9ca3af', // gray-400
                },
                iconColor: '#10b981', // primary-500
            },
        },
    });
    
    cardElement.mount('#card-element');
    
    // Handle real-time validation errors
    cardElement.on('change', ({error}) => {
        const displayError = document.getElementById('card-errors');
        if (error) {
            displayError.textContent = error.message;
        } else {
            displayError.textContent = '';
        }
    });

    // Form elements
    const form = document.getElementById('payment-form');
    const submitBtn = document.getElementById('submit-button'); // The external button
    const buttonText = document.getElementById('button-text');
    const loadingSpinner = document.getElementById('loading-spinner');
    const cardContainer = document.getElementById('card-container');
    const paymentMessage = document.getElementById('payment-message');
    const messageText = document.getElementById('message-text');

    // Link external submit button to form submit
    submitBtn.addEventListener('click', () => {
        form.dispatchEvent(new Event('submit'));
    });

    // Toggle Payment Method
    document.querySelectorAll('input[name="payment_method"]').forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === 'card') {
                cardContainer.style.display = 'block';
                buttonText.textContent = 'Confirm Payment';
            } else {
                cardContainer.style.display = 'none';
                buttonText.textContent = 'Place Order';
            }
        });
    });

    function showLoading() {
        submitBtn.disabled = true;
        submitBtn.classList.add('opacity-75', 'cursor-not-allowed');
        loadingSpinner.classList.remove('hidden');
        buttonText.textContent = 'Processing...';
    }

    function hideLoading() {
        submitBtn.disabled = false;
        submitBtn.classList.remove('opacity-75', 'cursor-not-allowed');
        loadingSpinner.classList.add('hidden');
        const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;
        buttonText.textContent = paymentMethod === 'card' ? 'Confirm Payment' : 'Place Order';
    }

    function showMessage(msg, isError = true) {
        paymentMessage.classList.remove('hidden', 'bg-red-50', 'border-red-200', 'text-red-800', 'bg-green-50', 'border-green-200', 'text-green-800');
        
        if (isError) {
            paymentMessage.classList.add('bg-red-50', 'border-red-200', 'text-red-800');
        } else {
            paymentMessage.classList.add('bg-green-50', 'border-green-200', 'text-green-800');
        }
        
        messageText.textContent = msg;
        paymentMessage.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    form.addEventListener('submit', async (event) => {
        event.preventDefault();
        
        const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;
        const shippingAddress = document.getElementById('shipping_address').value;
        const phone = document.getElementById('phone').value;
        const cardholderName = document.getElementById('cardholder_name').value;
        
        if (!shippingAddress || !phone || !cardholderName) {
            showMessage('Please fill in all required fields.');
            return;
        }

        showLoading();

        try {
            if (paymentMethod === 'cod') {
                const response = await fetch('{{ route('payment.cod') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: JSON.stringify({
                        shipping_address: shippingAddress,
                        phone: phone,
                        notes: document.getElementById('notes').value
                    })
                });
                
                const result = await response.json();
                if (result.success) {
                    window.location.href = `{{ route('checkout.success') }}?order=${result.order_id}`;
                } else {
                    throw new Error(result.error || 'Failed to process order');
                }
            } else {
                // Card Payment
                const intentResponse = await fetch('{{ route('payment.create-intent') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    }
                });
                
                const { client_secret, error: intentError } = await intentResponse.json();
                if (intentError) throw new Error(intentError);
                
                const { error, paymentIntent } = await stripe.confirmCardPayment(client_secret, {
                    payment_method: {
                        card: cardElement,
                        billing_details: {
                            name: cardholderName,
                            phone: phone
                        },
                    }
                });
                
                if (error) throw new Error(error.message);
                
                if (paymentIntent.status === 'succeeded') {
                     const confirmResponse = await fetch('{{ route('payment.confirm') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                        },
                        body: JSON.stringify({
                            payment_intent_id: paymentIntent.id,
                            shipping_address: shippingAddress,
                            phone: phone,
                            notes: document.getElementById('notes').value
                        })
                    });
                    
                    const confirmResult = await confirmResponse.json();
                    if (confirmResult.success) {
                        window.location.href = `{{ route('checkout.success') }}?order=${confirmResult.order_id}`;
                    } else {
                        throw new Error(confirmResult.error || 'Failed to confirm order');
                    }
                }
            }
        } catch (error) {
            console.error(error);
            showMessage(error.message);
        } finally {
            hideLoading();
        }
    });
</script>
@endsection
