<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <?php
        $siteName = App\Models\Setting::get('site_name', 'Mini Market');
        $siteDescription = App\Models\Setting::get('site_description', 'Premium Dietary Supplements & Health Products');
    ?>
    <title><?php echo $__env->yieldContent('title', $siteName . ' - ' . $siteDescription); ?></title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        heading: ['Plus Jakarta Sans', 'sans-serif'],
                    },
                    colors: {
                        primary: { 50: '#fff5f5', 100: '#ffe3e3', 200: '#ffc9c9', 300: '#ffa4a4', 400: '#ff6b6b', 500: '#e10909', 600: '#c50707', 700: '#a30404', 800: '#850505', 900: '#6e0707', 950: '#3d0202' },
                        secondary: { 50: '#f5f5f5', 100: '#e5e5e5', 200: '#d4d4d4', 300: '#a3a3a3', 400: '#737373', 500: '#525252', 600: '#404040', 700: '#262626', 800: '#171717', 900: '#0a0a0a', 950: '#030303' },
                        accent: { 50: '#fffbeb', 100: '#fef3c7', 200: '#fde68a', 300: '#fcd34d', 400: '#fbbf24', 500: '#f59e0b', 600: '#d97706', 700: '#b45309', 800: '#92400e', 900: '#78350f', 950: '#451a03' }
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.3s ease-out forwards',
                        'slide-down': 'slideDown 0.3s ease-out forwards',
                    },
                    keyframes: {
                        fadeIn: { '0%': { opacity: '0' }, '100%': { opacity: '1' } },
                        slideDown: { '0%': { transform: 'translateY(-10px)', opacity: '0' }, '100%': { transform: 'translateY(0)', opacity: '1' } }
                    }
                }
            }
        }
    </script>
    <style>
        .glass { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); }
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #f1f1f1; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #e11d48; border-radius: 10px; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased flex flex-col min-h-screen selection:bg-primary-100 selection:text-primary-900">

    <nav class="fixed w-full z-50 transition-all duration-300" id="navbar">
        <div class="absolute inset-0 bg-white/95 backdrop-blur-md shadow-sm opacity-0 transition-opacity duration-300" id="navbar-bg"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="flex justify-between items-center h-20">
                
                <div class="flex-shrink-0 flex items-center">
                    <a href="<?php echo e(route('products.index')); ?>" class="flex items-center gap-2 group">
                        <?php $siteLogo = App\Models\Setting::get('site_logo'); ?>
                        <?php if($siteLogo): ?>
                            <img src="<?php echo e(asset('storage/' . $siteLogo)); ?>" alt="<?php echo e($siteName); ?>" class="h-10 w-auto object-contain transition-transform group-hover:scale-105">
                        <?php else: ?>
                            <div class="bg-gradient-to-tr from-primary-600 to-secondary-500 text-white p-2 rounded-lg shadow-lg">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                                </svg>
                            </div>
                        <?php endif; ?>
                        <span class="font-heading font-bold text-xl tracking-tight text-gray-900 group-hover:text-primary-600 transition-colors">
                            <?php echo e($siteName); ?>

                        </span>
                    </a>
                </div>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="<?php echo e(route('products.index')); ?>" class="text-sm font-semibold text-gray-600 hover:text-primary-600 transition-colors">Home</a>
                    <a href="<?php echo e(route('products.list')); ?>" class="text-sm font-semibold text-gray-600 hover:text-primary-600 transition-colors">Shop</a>
                    <a href="<?php echo e(route('about')); ?>" class="text-sm font-semibold text-gray-600 hover:text-primary-600 transition-colors">About</a>
                    <a href="<?php echo e(route('contact')); ?>" class="text-sm font-semibold text-gray-600 hover:text-primary-600 transition-colors">Contact</a>
                </div>

                <div class="flex items-center space-x-2 md:space-x-5">
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(route('messages.inbox')); ?>" class="text-gray-500 hover:text-primary-600 transition-colors relative p-2" onclick="clearMessageCounter(this, event)">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            <?php
                                $userMessages = App\Models\Message::where('user_id', Auth::id())
                                    ->orWhere('email', Auth::user()->email)
                                    ->where('status', 'replied')
                                    ->where('updated_at', '>', Auth::user()->last_message_check ?? '1970-01-01')
                                    ->count();
                            ?>
                            <?php if($userMessages > 0): ?>
                                <span class="absolute top-2 right-2 h-2.5 w-2.5 bg-red-500 rounded-full border-2 border-white message-counter"></span>
                            <?php endif; ?>
                        </a>

                        <a href="<?php echo e(route('cart.view')); ?>" class="text-gray-500 hover:text-primary-600 transition-colors relative p-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            <?php 
                                $cartCount = array_sum(session('cart', []));
                            ?>
                            <?php if($cartCount > 0): ?>
                                <span class="absolute top-1 right-1 h-4 w-4 bg-accent-500 text-white text-[10px] font-bold rounded-full flex items-center justify-center">
                                    <?php echo e($cartCount); ?>

                                </span>
                            <?php endif; ?>
                        </a>

                        <div class="hidden md:block relative group">
                            <button class="flex items-center gap-2 pl-2 border-l border-gray-200 ml-2">
                                <div class="w-8 h-8 rounded-full bg-primary-100 flex items-center justify-center text-primary-700 font-bold text-xs uppercase">
                                    <?php echo e(substr(Auth::user()->name, 0, 2)); ?>

                                </div>
                            </button>
                            <div class="absolute right-0 mt-2 w-56 bg-white rounded-2xl shadow-xl border border-gray-100 py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform origin-top-right">
                                <a href="<?php echo e(route('profile.edit')); ?>" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-primary-600">My Profile</a>
                                <a href="<?php echo e(route('orders.index')); ?>" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-primary-600">Order History</a>
                                <form method="POST" action="<?php echo e(route('logout')); ?>" class="mt-1 border-t border-gray-50">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-red-50 font-medium">Logout</button>
                                </form>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="hidden md:flex items-center gap-4">
                            <a href="<?php echo e(route('login')); ?>" class="text-sm font-bold text-gray-600 hover:text-primary-600">Log in</a>
                            <a href="<?php echo e(route('register')); ?>" class="bg-primary-600 text-white px-6 py-2.5 rounded-full text-sm font-bold hover:bg-primary-700 shadow-md">Join</a>
                        </div>
                    <?php endif; ?>

                    <button id="mobile-menu-btn" class="md:hidden p-2 text-gray-600 focus:outline-none relative z-50">
                        <svg id="menu-icon-open" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                        <svg id="menu-icon-close" class="hidden w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            </div>
        </div>

        <div id="mobile-menu" class="hidden md:hidden absolute top-full left-0 w-full bg-white border-t border-gray-100 shadow-2xl animate-slide-down">
            <div class="px-4 py-6 space-y-1">
                <a href="<?php echo e(route('products.index')); ?>" class="block px-4 py-3 rounded-xl font-bold text-gray-700 hover:bg-gray-50 hover:text-primary-600 transition-colors">Home</a>
                <a href="<?php echo e(route('products.list')); ?>" class="block px-4 py-3 rounded-xl font-bold text-gray-700 hover:bg-gray-50 hover:text-primary-600 transition-colors">Shop</a>
                <a href="<?php echo e(route('about')); ?>" class="block px-4 py-3 rounded-xl font-bold text-gray-700 hover:bg-gray-50 hover:text-primary-600 transition-colors">About Us</a>
                <a href="<?php echo e(route('contact')); ?>" class="block px-4 py-3 rounded-xl font-bold text-gray-700 hover:bg-gray-50 hover:text-primary-600 transition-colors">Contact</a>
                
                <div class="pt-4 mt-4 border-t border-gray-100">
                    <?php if(auth()->guard()->check()): ?>
                        <div class="px-4 py-3 mb-2 flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center text-primary-700 font-bold">
                                <?php echo e(substr(Auth::user()->name, 0, 1)); ?>

                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-900"><?php echo e(Auth::user()->name); ?></p>
                                <p class="text-xs text-gray-500"><?php echo e(Auth::user()->email); ?></p>
                            </div>
                        </div>
                        <a href="<?php echo e(route('profile.edit')); ?>" class="block px-4 py-2 text-sm text-gray-600">My Profile</a>
                        <a href="<?php echo e(route('orders.index')); ?>" class="block px-4 py-2 text-sm text-gray-600">Order History</a>
                        <form method="POST" action="<?php echo e(route('logout')); ?>" class="mt-4">
                            <?php echo csrf_field(); ?>
                            <button class="w-full text-center py-3 text-sm font-bold text-red-500 bg-red-50 rounded-xl">Logout</button>
                        </form>
                    <?php else: ?>
                        <div class="grid grid-cols-2 gap-3 px-2">
                            <a href="<?php echo e(route('login')); ?>" class="text-center py-3 font-bold text-gray-700 border border-gray-200 rounded-xl">Login</a>
                            <a href="<?php echo e(route('register')); ?>" class="text-center py-3 font-bold bg-primary-600 text-white rounded-xl shadow-lg shadow-primary-200">Join Now</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow pt-20">
        <?php if(session('success')): ?>
            <div class="max-w-7xl mx-auto px-4 mt-6 animate-fade-in">
                <div class="bg-emerald-50 border border-emerald-100 text-emerald-700 px-4 py-3 rounded-2xl flex items-center justify-between shadow-sm">
                    <span class="text-sm font-medium"><?php echo e(session('success')); ?></span>
                    <button onclick="this.parentElement.remove()" class="text-emerald-400 hover:text-emerald-600">×</button>
                </div>
            </div>
        <?php endif; ?>
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <script>
        const btn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');
        const openIcon = document.getElementById('menu-icon-open');
        const closeIcon = document.getElementById('menu-icon-close');
        const navbarBg = document.getElementById('navbar-bg');

        // Logic to handle scroll background and menu visibility
        function updateNavbar() {
            if (window.scrollY > 30 || !menu.classList.contains('hidden')) {
                navbarBg.classList.remove('opacity-0');
            } else {
                navbarBg.classList.add('opacity-0');
            }
        }

        // Toggle Mobile Menu
        btn.addEventListener('click', () => {
            const isOpened = menu.classList.toggle('hidden');
            openIcon.classList.toggle('hidden', !isOpened);
            closeIcon.classList.toggle('hidden', isOpened);
            updateNavbar();
        });

        // Close menu when clicking outside (optional but recommended)
        window.addEventListener('scroll', updateNavbar);

        // Clear Messages Counter
        function clearMessageCounter(element, event) {
            event.preventDefault();
            const counter = element.querySelector('.message-counter');
            if(counter) counter.remove();
            
            fetch('<?php echo e(route("messages.clear-notifications")); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            }).finally(() => window.location.href = element.href);
        }
    </script>
</body>
</html><?php /**PATH C:\Users\LENOVO\CascadeProjects\Market-Store - v2\mini-market\resources\views/layouts/main.blade.php ENDPATH**/ ?>