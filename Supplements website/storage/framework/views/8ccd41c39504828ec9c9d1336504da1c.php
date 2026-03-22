<?php $__env->startSection('title', 'Contact Us - Mini Market'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-white min-h-screen font-sans">
    
    <div class="pt-20 pb-16 text-center">
        <h1 class="text-4xl md:text-5xl font-black text-slate-900 tracking-tight mb-4">Get in touch</h1>
        <p class="text-slate-500 text-lg">We're here to help you live a healthier life.</p>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-24">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            
            <div class="lg:col-span-4 space-y-10">
                <div>
                    <h3 class="text-xs font-black uppercase tracking-[0.2em] text-primary-600 mb-6">Contact Details</h3>
                    <div class="space-y-6">
                        <div class="flex gap-4">
                            <div class="text-slate-400"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg></div>
                            <div>
                                <p class="font-bold text-slate-900">Email us</p>
                                <p class="text-slate-500 text-sm"><?php echo e(App\Models\Setting::get('contact_email', 'hello@minimarket.com')); ?></p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="text-slate-400"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg></div>
                            <div>
                                <p class="font-bold text-slate-900">Visit us</p>
                                <p class="text-slate-500 text-sm leading-relaxed"><?php echo e(App\Models\Setting::get('store_address', '123 Wellness Ave, Casablanca, Morocco')); ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="rounded-3xl overflow-hidden shadow-sm border border-slate-100 h-64 grayscale hover:grayscale-0 transition-all duration-700">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3323.846351111!2d-7.6325!3d33.5731!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzPCsDM0JzIzLjIiTiA3wrAzNyc1Ny4wIlc!5e0!3m2!1sen!2sma!4v1625560000000!5m2!1sen!2sma" 
                        class="w-full h-full border-0" 
                        allowfullscreen="" 
                        loading="lazy">
                    </iframe>
                </div>
            </div>

            <div class="lg:col-span-8 bg-slate-50 rounded-[2.5rem] p-8 md:p-12">
                <form action="<?php echo e(route('contact.store')); ?>" method="POST" class="space-y-8">
                    <?php echo csrf_field(); ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label class="text-[11px] font-bold uppercase tracking-widest text-slate-400 ml-1">Your Name</label>
                            <input type="text" name="name" required class="w-full bg-white border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-primary-500 transition-all shadow-sm placeholder:text-slate-300" placeholder="John Doe">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[11px] font-bold uppercase tracking-widest text-slate-400 ml-1">Email Address</label>
                            <input type="email" name="email" required class="w-full bg-white border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-primary-500 transition-all shadow-sm placeholder:text-slate-300" placeholder="john@example.com">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[11px] font-bold uppercase tracking-widest text-slate-400 ml-1">Message</label>
                        <textarea name="message" rows="5" required class="w-full bg-white border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-primary-500 transition-all shadow-sm placeholder:text-slate-300 resize-none" placeholder="Tell us more about your needs..."></textarea>
                    </div>

                    <button type="submit" class="inline-flex items-center justify-center px-10 py-4 bg-slate-900 text-white font-bold rounded-2xl hover:bg-primary-600 transition-all shadow-lg hover:shadow-primary-200 transform hover:-translate-y-1">
                        Send message
                        <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\LENOVO\CascadeProjects\Market-Store - v2\mini-market\resources\views/pages/contact.blade.php ENDPATH**/ ?>