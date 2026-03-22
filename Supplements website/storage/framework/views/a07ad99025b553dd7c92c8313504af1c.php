<?php $__env->startSection('title', $product->name . ' — Exclusive Details'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-white min-h-screen">
    <nav class="py-6 border-b border-slate-50">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <ol class="flex items-center space-x-4 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">
                <li><a href="<?php echo e(route('products.index')); ?>" class="hover:text-primary-600 transition-colors">Home</a></li>
                <li class="text-slate-200">/</li>
                <li><a href="<?php echo e(route('products.list')); ?>" class="hover:text-primary-600 transition-colors">Market</a></li>
                <li class="text-slate-200">/</li>
                <li class="text-slate-900 italic font-light lowercase tracking-normal text-sm"><?php echo e($product->name); ?></li>
            </ol>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-12 lg:py-24">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-start">
            
            <div class="lg:col-span-7">
                <div class="relative aspect-square bg-slate-50 rounded-[3rem] overflow-hidden group">
                    <?php if($product->image): ?>
                        <img src="<?php echo e($product->image_url); ?>" alt="<?php echo e($product->name); ?>" 
                             class="w-full h-full object-contain p-12 transition-transform duration-1000 group-hover:scale-110">
                    <?php else: ?>
                        <div class="flex items-center justify-center h-full text-slate-200">
                            <svg class="w-32 h-32" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="0.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    <?php endif; ?>

                    <div class="absolute top-10 left-10">
                        <span class="bg-white/80 backdrop-blur-md border border-slate-100 px-6 py-2 rounded-full text-[10px] font-black uppercase tracking-widest text-slate-900 shadow-sm">
                            <?php echo e($product->category->name ?? 'Premium Series'); ?>

                        </span>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-5 space-y-10 sticky top-32">
                <div class="space-y-4">
                    <div class="flex items-center gap-4">
                        <?php if($product->stock > 0): ?>
                            <span class="flex items-center text-[9px] font-black uppercase tracking-widest text-green-500">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-500 mr-2 animate-pulse"></span> Available in Inventory
                            </span>
                        <?php else: ?>
                            <span class="text-[9px] font-black uppercase tracking-widest text-red-500">Currently Archived</span>
                        <?php endif; ?>
                    </div>
                    
                    <h1 class="text-5xl md:text-6xl font-black text-slate-900 tracking-tighter leading-[0.9] uppercase italic">
                        <?php echo e($product->name); ?>

                    </h1>
                    
                    <div class="pt-4 flex items-baseline gap-4">
                        <span class="text-4xl font-light text-primary-600 tracking-tighter">
                            <?php echo e(App\Models\Setting::formatPrice($product->price)); ?>

                        </span>
                    </div>
                </div>

                <div class="prose prose-slate prose-sm max-w-none border-t border-slate-50 pt-8">
                    <p class="text-slate-500 font-light text-lg leading-relaxed italic">
                        "<?php echo e($product->description); ?>"
                    </p>
                </div>

                <div class="pt-6">
                    <?php if($product->is_active && $product->stock > 0): ?>
                        <?php if(auth()->guard()->check()): ?>
                            <form action="<?php echo e(route('cart.add', $product)); ?>" method="POST" class="space-y-6">
                                <?php echo csrf_field(); ?>
                                <div class="flex items-center gap-6">
                                    <div class="flex items-center bg-slate-50 rounded-2xl p-2 border border-slate-100">
                                        <button type="button" onclick="decrement()" class="w-10 h-10 flex items-center justify-center text-slate-400 hover:text-slate-900 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                                        </button>
                                        <input type="number" id="quantity" name="quantity" min="1" max="<?php echo e(min(10, $product->stock)); ?>" value="1" 
                                               class="w-12 text-center bg-transparent border-none focus:ring-0 font-black text-slate-900" readonly>
                                        <button type="button" onclick="increment()" class="w-10 h-10 flex items-center justify-center text-slate-400 hover:text-slate-900 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                        </button>
                                    </div>

                                    <button type="submit" class="flex-1 bg-slate-900 text-white font-black py-5 rounded-2xl shadow-[0_20px_40px_-10px_rgba(0,0,0,0.2)] hover:bg-primary-600 transition-all transform hover:-translate-y-1 uppercase tracking-[0.2em] text-xs">
                                        Acquire Item
                                    </button>
                                </div>
                            </form>
                        <?php endif; ?>
                        
                        <?php if(auth()->guard()->guest()): ?>
                            <a href="<?php echo e(route('login')); ?>" class="block w-full text-center bg-slate-900 text-white font-black py-5 rounded-2xl uppercase tracking-widest text-xs hover:bg-primary-600 transition-all">
                                Login to Purchase
                            </a>
                        <?php endif; ?>
                    <?php else: ?>
                        <div class="w-full text-center py-5 border-2 border-dashed border-slate-100 rounded-2xl">
                            <span class="text-[10px] font-black uppercase tracking-widest text-slate-300 italic">Inventory Depleted</span>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="grid grid-cols-2 gap-4 pt-10">
                    <div class="p-4 bg-slate-50 rounded-2xl flex items-start gap-3">
                        <div class="w-2 h-2 rounded-full bg-primary-600 mt-1.5"></div>
                        <div>
                            <p class="text-[10px] font-black uppercase tracking-widest text-slate-900">Eco-Conscious</p>
                            <p class="text-[10px] text-slate-400 uppercase leading-relaxed mt-1">Sustainably sourced</p>
                        </div>
                    </div>
                    <div class="p-4 bg-slate-50 rounded-2xl flex items-start gap-3">
                        <div class="w-2 h-2 rounded-full bg-primary-600 mt-1.5"></div>
                        <div>
                            <p class="text-[10px] font-black uppercase tracking-widest text-slate-900">Swift Reserve</p>
                            <p class="text-[10px] text-slate-400 uppercase leading-relaxed mt-1">Ready for pickup</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function increment() {
        const input = document.getElementById('quantity');
        const max = parseInt(input.getAttribute('max'));
        const val = parseInt(input.value);
        if (val < max) input.value = val + 1;
    }
    
    function decrement() {
        const input = document.getElementById('quantity');
        const val = parseInt(input.value);
        if (val > 1) input.value = val - 1;
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\LENOVO\CascadeProjects\Market-Store - v2\mini-market\resources\views/products/show.blade.php ENDPATH**/ ?>