<?php $__env->startSection('title', 'Admin Dashboard - Mini Market'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    <!-- Welcome Header -->
    <div class="bg-gradient-to-r from-primary-600 to-primary-800 rounded-lg p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold mb-2">Welcome back, <?php echo e(Auth::user()->name); ?>!</h1>
                <p class="text-primary-100">Here's what's happening with your mini market today.</p>
            </div>
            <div class="hidden md:block">
                <svg class="w-16 h-16 text-primary-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Products -->
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Products</p>
                    <p class="text-3xl font-bold text-gray-900"><?php echo e($stats['total_products']); ?></p>
                    <p class="text-sm text-green-600"><?php echo e($stats['in_stock_products']); ?> in stock</p>
                </div>
                <div class="bg-blue-100 p-3 rounded-full">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Orders -->
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Orders</p>
                    <p class="text-3xl font-bold text-gray-900"><?php echo e($stats['total_orders']); ?></p>
                    <p class="text-sm text-green-600"><?php echo e($stats['pending_orders']); ?> pending</p>
                </div>
                <div class="bg-green-100 p-3 rounded-full">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Revenue -->
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-yellow-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Revenue</p>
                    <p class="text-3xl font-bold text-gray-900"><?php echo e(App\Models\Setting::formatPrice($stats['total_revenue'])); ?></p>
                    <p class="text-sm text-green-600"><?php echo e($stats['paid_orders']); ?> paid orders</p>
                </div>
                <div class="bg-yellow-100 p-3 rounded-full">
                    <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Low Stock Alert -->
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-red-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Low Stock Items</p>
                    <p class="text-3xl font-bold text-gray-900"><?php echo e($stats['low_stock_products']); ?></p>
                    <p class="text-sm text-red-600">Need attention</p>
                </div>
                <div class="bg-red-100 p-3 rounded-full">
                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts and Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Orders -->
        <div class="bg-white rounded-lg shadow-md">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">Recent Orders</h3>
                    <a href="<?php echo e(route('admin.orders.index')); ?>" class="text-primary-600 hover:text-primary-700 text-sm font-medium">
                        View All →
                    </a>
                </div>
            </div>
            <div class="p-6">
                <?php if($recent_orders->count() > 0): ?>
                    <div class="space-y-4">
                        <?php $__currentLoopData = $recent_orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                <div class="flex-1">
                                    <h4 class="font-medium text-gray-900"><?php echo e($order->user->name ?? 'Guest'); ?></h4>
                                    <p class="text-sm text-gray-600">
                                        <?php if($order->orderItems->count() > 0): ?>
                                            <?php $__currentLoopData = $order->orderItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($item->product): ?>
                                                    <?php if($item->product->trashed()): ?>
                                                        <span class="text-orange-600"><?php echo e($item->product->name); ?> (Deleted)</span>
                                                    <?php else: ?>
                                                        <?php echo e($item->product->name); ?>

                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <span class="text-red-600">Product Not Found</span>
                                                <?php endif; ?>
                                                (<?php echo e($item->quantity); ?>x)<?php echo e(!$loop->last ? ', ' : ''); ?>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <span class="text-red-600">No items</span>
                                        <?php endif; ?>
                                    </p>
                                    <p class="text-xs text-gray-500"><?php echo e($order->created_at->diffForHumans()); ?></p>
                                </div>
                                <div class="text-right">
                                    <span class="px-2 py-1 text-xs font-medium rounded-full
                                        <?php if($order->payment_status === 'pending'): ?> bg-yellow-100 text-yellow-800
                                        <?php elseif($order->payment_status === 'paid'): ?> bg-green-100 text-green-800
                                        <?php else: ?> bg-red-100 text-red-800 <?php endif; ?>">
                                        <?php echo e(ucfirst($order->payment_status)); ?>

                                    </span>
                                    <p class="text-sm font-medium text-gray-900 mt-1"><?php echo e(App\Models\Setting::formatPrice($order->total_amount)); ?></p>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-8">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No orders yet</h3>
                        <p class="mt-1 text-sm text-gray-500">Get started by adding products to your inventory.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Low Stock Products -->
        <div class="bg-white rounded-lg shadow-md">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">Low Stock Alert</h3>
                    <a href="<?php echo e(route('admin.products.index')); ?>" class="text-primary-600 hover:text-primary-700 text-sm font-medium">
                        Manage Products →
                    </a>
                </div>
            </div>
            <div class="p-6">
                <?php if($low_stock_products->count() > 0): ?>
                    <div class="space-y-4">
                        <?php $__currentLoopData = $low_stock_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="flex items-center justify-between p-4 bg-red-50 rounded-lg border border-red-200">
                                <div class="flex-1">
                                    <h4 class="font-medium text-gray-900"><?php echo e($product->name); ?></h4>
                                    <p class="text-sm text-gray-600"><?php echo e(App\Models\Setting::formatPrice($product->price)); ?></p>
                                </div>
                                <div class="text-right">
                                    <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">
                                        <?php echo e($product->stock); ?> left
                                    </span>
                                    <div class="mt-2">
                                        <a href="<?php echo e(route('admin.products.edit', $product->id)); ?>" class="text-xs text-primary-600 hover:text-primary-700">
                                            Update Stock
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-8">
                        <svg class="mx-auto h-12 w-12 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">All products well stocked!</h3>
                        <p class="mt-1 text-sm text-gray-500">No products are running low on inventory.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="<?php echo e(route('admin.products.create')); ?>" class="flex items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition duration-200">
                <div class="bg-blue-500 p-2 rounded-full mr-4">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </div>
                <div>
                    <h4 class="font-medium text-gray-900">Add New Product</h4>
                    <p class="text-sm text-gray-600">Add products to your inventory</p>
                </div>
            </a>

            <a href="<?php echo e(route('admin.orders.index')); ?>" class="flex items-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition duration-200">
                <div class="bg-green-500 p-2 rounded-full mr-4">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <div>
                    <h4 class="font-medium text-gray-900">Manage Orders</h4>
                    <p class="text-sm text-gray-600">View and update customer orders</p>
                </div>
            </a>

            <a href="<?php echo e(route('products.index')); ?>" class="flex items-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition duration-200">
                <div class="bg-purple-500 p-2 rounded-full mr-4">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                </div>
                <div>
                    <h4 class="font-medium text-gray-900">View Website</h4>
                    <p class="text-sm text-gray-600">See how customers view your store</p>
                </div>
            </a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\LENOVO\CascadeProjects\Market-Store - v2\mini-market\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>