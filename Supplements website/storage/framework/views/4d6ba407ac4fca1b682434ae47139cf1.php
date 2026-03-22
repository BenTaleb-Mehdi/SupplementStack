<?php $__env->startSection('content'); ?>
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <!-- Header -->
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">Order #<?php echo e($order->id); ?></h2>
                        <p class="text-gray-600">Placed on <?php echo e($order->created_at->format('M d, Y h:i A')); ?></p>
                    </div>
                    <div class="text-right">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                            <?php if($order->status === 'pending'): ?> bg-yellow-100 text-yellow-800
                            <?php elseif($order->status === 'confirmed'): ?> bg-blue-100 text-blue-800
                            <?php elseif($order->status === 'processing'): ?> bg-purple-100 text-purple-800
                            <?php elseif($order->status === 'completed'): ?> bg-green-100 text-green-800
                            <?php else: ?> bg-red-100 text-red-800 <?php endif; ?>">
                            <?php echo e(ucfirst($order->status)); ?>

                        </span>
                    </div>
                </div>

                <!-- Order Items -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Order Items</h3>
                    <div class="bg-gray-50 rounded-lg overflow-hidden">
                        <div class="divide-y divide-gray-200">
                            <?php $__currentLoopData = $order->orderItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="p-4 flex items-center justify-between">
                                    <div class="flex items-center">
                                        <?php if($item->product->image): ?>
                                            <img src="<?php echo e($item->product->image_url); ?>" alt="<?php echo e($item->product->name); ?>" class="w-16 h-16 rounded-lg object-cover mr-4">
                                        <?php else: ?>
                                            <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center mr-4">
                                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                                </svg>
                                            </div>
                                        <?php endif; ?>
                                        <div>
                                            <h4 class="font-medium text-gray-900"><?php echo e($item->product->name); ?></h4>
                                            <p class="text-sm text-gray-600"><?php echo e(ucfirst($item->product->category)); ?></p>
                                            <p class="text-sm text-gray-600">Quantity: <?php echo e($item->quantity); ?></p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-medium text-gray-900"><?php echo e(App\Models\Setting::formatPrice($item->price)); ?> each</p>
                                        <p class="text-lg font-bold text-gray-900"><?php echo e(App\Models\Setting::formatPrice($item->total_price)); ?></p>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                    <!-- Payment & Shipping -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Payment & Shipping</h3>
                        <div class="bg-gray-50 rounded-lg p-4 space-y-3">
                            <div>
                                <p class="text-sm text-gray-600">Payment Method</p>
                                <p class="font-medium text-gray-900">
                                    <?php echo e($order->payment_type === 'cod' ? 'Cash on Delivery' : 'Card Payment'); ?>

                                </p>
                                <?php if($order->stripe_payment_id): ?>
                                    <p class="text-xs text-gray-500">Payment ID: <?php echo e($order->stripe_payment_id); ?></p>
                                <?php endif; ?>
                            </div>
                            
                            <div>
                                <p class="text-sm text-gray-600">Shipping Address</p>
                                <p class="font-medium text-gray-900"><?php echo e($order->shipping_address); ?></p>
                            </div>
                            
                            <div>
                                <p class="text-sm text-gray-600">Phone Number</p>
                                <p class="font-medium text-gray-900"><?php echo e($order->phone); ?></p>
                            </div>
                            
                            <?php if($order->notes): ?>
                                <div>
                                    <p class="text-sm text-gray-600">Order Notes</p>
                                    <p class="font-medium text-gray-900"><?php echo e($order->notes); ?></p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Order Total -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Order Total</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Subtotal:</span>
                                    <span class="font-medium"><?php echo e(App\Models\Setting::formatPrice($order->total_amount)); ?></span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Shipping:</span>
                                    <span class="font-medium text-green-600">Free</span>
                                </div>
                                <div class="border-t pt-2 flex justify-between text-lg font-bold">
                                    <span>Total:</span>
                                    <span class="text-blue-600"><?php echo e(App\Models\Setting::formatPrice($order->total_amount)); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Status Timeline -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Order Status</h3>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="flex items-center justify-between">
                            <!-- Pending -->
                            <div class="flex flex-col items-center">
                                <div class="w-8 h-8 rounded-full <?php echo e(in_array($order->status, ['pending', 'confirmed', 'processing', 'completed']) ? 'bg-blue-600' : 'bg-gray-300'); ?> flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <p class="text-xs text-gray-600 mt-1">Pending</p>
                            </div>

                            <!-- Line -->
                            <div class="flex-1 h-0.5 <?php echo e(in_array($order->status, ['confirmed', 'processing', 'completed']) ? 'bg-blue-600' : 'bg-gray-300'); ?> mx-2"></div>

                            <!-- Confirmed -->
                            <div class="flex flex-col items-center">
                                <div class="w-8 h-8 rounded-full <?php echo e(in_array($order->status, ['confirmed', 'processing', 'completed']) ? 'bg-blue-600' : 'bg-gray-300'); ?> flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <p class="text-xs text-gray-600 mt-1">Confirmed</p>
                            </div>

                            <!-- Line -->
                            <div class="flex-1 h-0.5 <?php echo e(in_array($order->status, ['processing', 'completed']) ? 'bg-blue-600' : 'bg-gray-300'); ?> mx-2"></div>

                            <!-- Processing -->
                            <div class="flex flex-col items-center">
                                <div class="w-8 h-8 rounded-full <?php echo e(in_array($order->status, ['processing', 'completed']) ? 'bg-blue-600' : 'bg-gray-300'); ?> flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <p class="text-xs text-gray-600 mt-1">Processing</p>
                            </div>

                            <!-- Line -->
                            <div class="flex-1 h-0.5 <?php echo e($order->status === 'completed' ? 'bg-blue-600' : 'bg-gray-300'); ?> mx-2"></div>

                            <!-- Completed -->
                            <div class="flex flex-col items-center">
                                <div class="w-8 h-8 rounded-full <?php echo e($order->status === 'completed' ? 'bg-green-600' : 'bg-gray-300'); ?> flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <p class="text-xs text-gray-600 mt-1">Delivered</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-between">
                    <a href="<?php echo e(route('orders.index')); ?>" class="text-gray-600 hover:text-gray-800 font-medium">
                        ← Back to Orders
                    </a>
                    
                    <div class="flex gap-4">
                        <?php if($order->status === 'pending'): ?>
                            <button class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition duration-200 font-medium">
                                Cancel Order
                            </button>
                        <?php endif; ?>
                        
                        <a href="<?php echo e(route('products.list')); ?>" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-200 font-medium">
                            Order Again
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\LENOVO\CascadeProjects\Market-Store - v2\mini-market\resources\views/orders/show.blade.php ENDPATH**/ ?>