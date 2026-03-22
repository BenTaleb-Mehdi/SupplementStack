<?php $__env->startSection('title', 'Our Story - Mini Market'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-white overflow-hidden">
    
    <div class="relative py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-16 items-center">
                
                <div class="w-full lg:w-1/2 relative">
                    <div class="relative z-10 rounded-[2rem] overflow-hidden shadow-2xl transform -rotate-2 hover:rotate-0 transition-transform duration-500 bg-gray-100">
                        <?php
                            $aboutImage = App\Models\Setting::get('about_image');
                            $defaultAboutImage = 'https://images.unsplash.com/photo-1576091160550-2173bdd99602?q=80&w=1000&auto=format&fit=crop';
                            $aboutImageUrl = $aboutImage ? asset('storage/' . $aboutImage) : $defaultAboutImage;
                        ?>
                        <img src="<?php echo e($aboutImageUrl); ?>" 
                             alt="Our Market" 
                             class="w-full h-[500px] object-cover"
                             onerror="this.src='<?php echo e($defaultAboutImage); ?>'">
                    </div>
                    
                    <div class="absolute -bottom-10 -right-6 z-20 bg-white p-8 rounded-3xl shadow-xl max-w-xs border border-gray-100 hidden md:block">
                        <p class="italic text-gray-600 text-lg leading-relaxed">"Pure supplements, sourced with integrity for your health."</p>
                        <div class="mt-4 flex items-center gap-2">
                            <span class="h-px w-8 bg-primary-500"></span>
                            <span class="font-bold text-gray-900 uppercase tracking-widest text-xs">Mini Market</span>
                        </div>
                    </div>
                    
                    <div class="absolute -top-10 -left-10 w-64 h-64 bg-[#b0b0b0] rounded-full mix-blend-multiply filter blur-3xl opacity-70"></div>
                </div>

                <div class="w-full lg:w-1/2 space-y-8">
                    <div class="space-y-4">
                        <h3 class="text-primary-600 font-bold tracking-[0.2em] uppercase text-sm italic">Pure Supplements</h3>
                        <h2 class="text-5xl font-black text-gray-900 leading-tight">
                            Crafting a <span class="relative inline-block">
                                <span class="relative z-10 text-primary-700">Healthier</span>
                                <span class="absolute bottom-2 left-0 w-full h-4 bg-primary-100 -z-10"></span>
                            </span> Future
                        </h2>
                    </div>
                    <p class="text-xl text-gray-600 leading-relaxed font-light">
                        We are more than just a store. We are a community dedicated to bringing the finest organic products and high-quality dietary supplements to your table.
                    </p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4">
                        <div class="flex gap-4 items-start p-4 rounded-2xl bg-slate-50 border border-slate-100">
                            <div class="flex-shrink-0 w-10 h-10 bg-primary-600 text-white rounded-xl flex items-center justify-center font-bold shadow-lg shadow-primary-200">01</div>
                            <p class="text-sm text-gray-500 leading-snug"><span class="block font-bold text-gray-900 mb-1">Premium Quality</span> Lab-tested supplements for maximum efficacy.</p>
                        </div>
                        <div class="flex gap-4 items-start p-4 rounded-2xl bg-slate-50 border border-slate-100">
                            <div class="flex-shrink-0 w-10 h-10 bg-primary-600 text-white rounded-xl flex items-center justify-center font-bold shadow-lg shadow-primary-200">02</div>
                            <p class="text-sm text-gray-500 leading-snug"><span class="block font-bold text-gray-900 mb-1">Expert Support</span> Personalized advice for your wellness journey.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-24 mt-12">
        <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-slate-200/50 border border-gray-100 p-10 md:p-16">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-y-12 gap-x-8">
                
                <div class="flex flex-col items-center lg:items-start">
                    <span class="text-5xl font-black text-slate-900 tracking-tighter">500<span class="text-primary-500">+</span></span>
                    <span class="mt-3 text-xs font-bold text-slate-400 uppercase tracking-widest">Happy Customers</span>
                </div>

                <div class="flex flex-col items-center lg:items-start lg:pl-10 lg:border-l lg:border-gray-100">
                    <span class="text-5xl font-black text-slate-900 tracking-tighter">12k</span>
                    <span class="mt-3 text-xs font-bold text-slate-400 uppercase tracking-widest">Premium Units Sold</span>
                </div>

                <div class="flex flex-col items-center lg:items-start lg:pl-10 lg:border-l lg:border-gray-100">
                    <span class="text-5xl font-black text-slate-900 tracking-tighter">100<span class="text-primary-500">%</span></span>
                    <span class="mt-3 text-xs font-bold text-slate-400 uppercase tracking-widest">Organic Certified</span>
                </div>

                <div class="flex flex-col items-center lg:items-start lg:pl-10 lg:border-l lg:border-gray-100">
                    <span class="text-5xl font-black text-slate-900 tracking-tighter">24<span class="text-primary-500">/7</span></span>
                    <span class="mt-3 text-xs font-bold text-slate-400 uppercase tracking-widest">Health Support</span>
                </div>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\LENOVO\CascadeProjects\Market-Store - v2\mini-market\resources\views/pages/about.blade.php ENDPATH**/ ?>