<?php $__env->startSection('title', 'Order Confirmed - Mini Market'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-gray-50 min-h-[calc(100vh-80px)] py-12 flex items-center justify-center">
    <div class="max-w-3xl w-full mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-3xl shadow-lg overflow-hidden border border-gray-100">
            <div class="relative bg-primary-600 px-6 py-10 md:py-12 text-center text-white overflow-hidden">
                <!-- Background Pattern -->
                <div class="absolute inset-0 opacity-10">
                    <svg class="h-full w-full" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none">
                         <pattern id="grid-pattern" width="10" height="10" patternUnits="userSpaceOnUse">
                            <path d="M10 0 L0 10 M0 0 L10 10" fill="none" stroke="white" stroke-width="0.5"/>
                         </pattern>
                         <rect width="100%" height="100%" fill="url(#grid-pattern)"/>
                    </svg>
                </div>
                
                <div class="relative z-10">
                    <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-white text-primary-600 mb-6 shadow-xl animate-scale-in">
                        <svg class="h-10 w-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-heading font-bold mb-2">Order Confirmed!</h1>
                    <p class="text-primary-100 text-lg">Thank you for shopping with us.</p>
                </div>
            </div>

            <div class="p-8 md:p-10">
                <div class="text-center mb-10">
                    <p class="text-gray-600">Your order <span class="font-bold text-gray-900">#<?php echo e($order->id); ?></span> has been placed successfully.</p>
                    <p class="text-gray-500 text-sm mt-1">We've sent a confirmation email to <span class="font-medium text-gray-700"><?php echo e(Auth::user()->email); ?></span></p>
                </div>

                <!-- Order Details Card -->
                <div class="bg-gray-50 rounded-2xl p-6 mb-8 border border-gray-100">
                    <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-4 border-b border-gray-200 pb-2">Order Details</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-8 text-sm">
                        <div class="flex justify-between md:block">
                            <span class="text-gray-500 block">Order Date</span>
                            <span class="font-medium text-gray-900"><?php echo e($order->created_at->format('M d, Y h:i A')); ?></span>
                        </div>
                        
                        <div class="flex justify-between md:block">
                            <span class="text-gray-500 block">Payment Method</span>
                            <span class="font-medium text-gray-900 flex items-center gap-2 md:justify-start justify-end">
                                <?php if($order->payment_type === 'cod'): ?>
                                    <svg class="w-4 h-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    Cash on Delivery
                                <?php else: ?>
                                    <svg class="w-4 h-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>
                                    Card Payment
                                <?php endif; ?>
                            </span>
                        </div>
                        
                        <div class="flex justify-between md:block">
                             <span class="text-gray-500 block">Shipping Status</span>
                             <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                Processing
                            </span>
                        </div>

                         <div class="flex justify-between md:block">
                            <span class="text-gray-500 block">Total Amount</span>
                            <span class="font-bold text-primary-600 text-lg"><?php echo e(App\Models\Setting::formatPrice($order->total_amount)); ?></span>
                        </div>
                    </div>
                </div>

                <!-- Next Steps -->
                <div class="space-y-4 mb-10">
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 mt-0.5">
                            1
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 text-sm">Order Processing</h4>
                            <p class="text-sm text-gray-500">Our team is currently preparing your items for shipment.</p>
                        </div>
                    </div>
                     <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-400 mt-0.5">
                            2
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 text-sm">Shipping</h4>
                            <p class="text-sm text-gray-500">You will receive a notification when your order is on its way.</p>
                        </div>
                    </div>
                     <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-400 mt-0.5">
                            3
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 text-sm">Delivery</h4>
                            <p class="text-sm text-gray-500">Estimated delivery within 2-3 business days.</p>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="<?php echo e(route('orders.show', $order)); ?>" class="inline-flex justify-center items-center px-6 py-3 border border-gray-300 shadow-sm text-base font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                        View Order Details
                    </a>
                    <a href="<?php echo e(route('products.list')); ?>" class="inline-flex justify-center items-center px-8 py-3 border border-transparent text-base font-bold rounded-xl text-white bg-primary-600 hover:bg-primary-700 shadow-lg hover:shadow-primary-500/30 transition-all transform hover:-translate-y-0.5">
                        Continue Shopping
                    </a>
                </div>
            </div>
            
            <div class="bg-gray-50 px-6 py-4 border-t border-gray-100 text-center">
                <p class="text-sm text-gray-500">Need help? <a href="<?php echo e(route('contact')); ?>" class="text-primary-600 hover:text-primary-700 font-medium">Contact Support</a></p>
            </div>
        </div>
    </div>
</div>

<style>
@keyframes scale-in {
    0% { transform: scale(0); opacity: 0; }
    100% { transform: scale(1); opacity: 1; }
}
.animate-scale-in {
    animation: scale-in 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
}
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\LENOVO\CascadeProjects\Market-Store - v2\mini-market\resources\views/checkout/success.blade.php ENDPATH**/ ?>