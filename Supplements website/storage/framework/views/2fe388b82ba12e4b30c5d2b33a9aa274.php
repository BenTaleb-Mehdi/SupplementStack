

<?php $__env->startSection('title', 'Order Details - Admin Dashboard'); ?>
<?php $__env->startSection('page-title', 'Order #' . str_pad($order->id, 6, '0', STR_PAD_LEFT)); ?>
<?php $__env->startSection('page-description', 'View complete order information'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    <!-- Back Button -->
    <div>
        <a href="<?php echo e(route('admin.orders.index')); ?>" class="inline-flex items-center text-primary-600 hover:text-primary-700 font-medium">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Orders
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Order Details -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Order Items -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Order Items</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <?php $__currentLoopData = $order->orderItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="flex items-center space-x-4 pb-4 border-b border-gray-100 last:border-0 last:pb-0">
                                <div class="w-16 h-16 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                                    <?php if($item->product && $item->product->image): ?>
                                        <img src="<?php echo e($item->product->image_url); ?>" alt="<?php echo e($item->product->name ?? 'Product'); ?>" class="w-full h-full object-cover">
                                    <?php else: ?>
                                        <div class="w-full h-full flex items-center justify-center text-gray-400">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-sm font-medium text-gray-900">
                                        <?php if($item->product): ?>
                                            <?php echo e($item->product->name); ?>

                                        <?php else: ?>
                                            <span class="text-red-500">Product Deleted</span>
                                        <?php endif; ?>
                                    </h4>
                                    <p class="text-sm text-gray-500">Quantity: <?php echo e($item->quantity); ?></p>
                                    <p class="text-sm text-gray-500">Price: <?php echo e(App\Models\Setting::formatPrice($item->price)); ?></p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-semibold text-gray-900"><?php echo e(App\Models\Setting::formatPrice($item->subtotal)); ?></p>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <!-- Order Total -->
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-bold text-gray-900">Total Amount</span>
                            <span class="text-2xl font-bold text-primary-600"><?php echo e(App\Models\Setting::formatPrice($order->total_amount)); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Info Sidebar -->
        <div class="space-y-6">
            <!-- Customer & Delivery Information -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-6 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-900">Customer & Delivery Information</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Customer Name</p>
                        <p class="text-sm font-medium text-gray-900"><?php echo e($order->user->name ?? 'Guest'); ?></p>
                    </div>
                    <?php if($order->user): ?>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Email</p>
                            <p class="text-sm text-gray-900"><?php echo e($order->user->email); ?></p>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Phone Number - Highlighted -->
                    <?php if($order->phone): ?>
                        <div class="bg-primary-50 border border-primary-200 rounded-lg p-3">
                            <p class="text-xs text-primary-700 uppercase tracking-wide mb-1 font-semibold">📞 Phone Number</p>
                            <p class="text-base text-primary-900 font-bold"><?php echo e($order->phone); ?></p>
                        </div>
                    <?php else: ?>
                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-3">
                            <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Phone Number</p>
                            <p class="text-sm text-gray-400 italic">Not provided</p>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Shipping Address - Highlighted -->
                    <?php if($order->shipping_address): ?>
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-3">
                            <p class="text-xs text-blue-700 uppercase tracking-wide mb-1 font-semibold">📍 Delivery Address</p>
                            <p class="text-sm text-blue-900 leading-relaxed"><?php echo e($order->shipping_address); ?></p>
                        </div>
                    <?php else: ?>
                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-3">
                            <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Delivery Address</p>
                            <p class="text-sm text-gray-400 italic">Not provided</p>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Order Notes -->
                    <?php if($order->notes): ?>
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3">
                            <p class="text-xs text-yellow-700 uppercase tracking-wide mb-1 font-semibold">📝 Order Notes</p>
                            <p class="text-sm text-yellow-900 leading-relaxed"><?php echo e($order->notes); ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Payment Information -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-6 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-900">Payment Information</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Payment Method</p>
                        <p class="text-sm font-medium text-gray-900">
                            <?php if($order->payment_type === 'cod'): ?>
                                Cash on Delivery
                            <?php else: ?>
                                Card Payment
                            <?php endif; ?>
                        </p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Payment Status</p>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            <?php if($order->payment_status === 'paid'): ?> bg-green-100 text-green-800
                            <?php elseif($order->payment_status === 'failed'): ?> bg-red-100 text-red-800
                            <?php else: ?> bg-yellow-100 text-yellow-800
                            <?php endif; ?>">
                            <?php echo e(ucfirst($order->payment_status)); ?>

                        </span>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Order Date</p>
                        <p class="text-sm text-gray-900"><?php echo e($order->created_at->format('M d, Y')); ?></p>
                        <p class="text-xs text-gray-500"><?php echo e($order->created_at->format('g:i A')); ?></p>
                    </div>

                    <!-- Update Payment Status -->
                    <div class="pt-4 border-t border-gray-200">
                        <form method="POST" action="<?php echo e(route('admin.orders.update', $order)); ?>">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <label class="block text-xs text-gray-500 uppercase tracking-wide mb-2">Update Status</label>
                            <div class="flex space-x-2">
                                <select name="payment_status" class="flex-1 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                                    <option value="pending" <?php echo e($order->payment_status === 'pending' ? 'selected' : ''); ?>>Pending</option>
                                    <option value="paid" <?php echo e($order->payment_status === 'paid' ? 'selected' : ''); ?>>Paid</option>
                                    <option value="failed" <?php echo e($order->payment_status === 'failed' ? 'selected' : ''); ?>>Failed</option>
                                </select>
                                <button type="submit" class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition text-sm font-medium">
                                    Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\LENOVO\CascadeProjects\Market-Store - v2\mini-market\resources\views/admin/orders/show.blade.php ENDPATH**/ ?>