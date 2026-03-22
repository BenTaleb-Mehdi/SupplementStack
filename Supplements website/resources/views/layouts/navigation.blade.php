<nav x-data="{ open: false }" 
     class="fixed w-full z-[60] bg-white/90 backdrop-blur-xl border-b border-slate-50 transition-all duration-300">
    
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">
            
            <div class="flex items-center">
                <a href="{{ route('products.index') }}" class="group">
                    <span class="text-2xl font-[900] tracking-tighter uppercase italic text-slate-900 group-hover:text-primary-600 transition-colors">
                        Mini<span class="font-light text-slate-400">Market</span>
                    </span>
                </a>
            </div>

            <div class="hidden sm:flex space-x-10 items-center">
                <a href="{{ route('products.list') }}" class="text-[10px] font-black uppercase tracking-[0.2em] {{ request()->routeIs('products.list') ? 'text-primary-600' : 'text-slate-400 hover:text-slate-900' }}">The Market</a>
                <a href="{{ route('dashboard') }}" class="text-[10px] font-black uppercase tracking-[0.2em] {{ request()->routeIs('dashboard') ? 'text-primary-600' : 'text-slate-400 hover:text-slate-900' }}">Dashboard</a>
            </div>

            <div class="flex items-center space-x-5">
                @auth
                <a href="{{ route('cart.index') }}" class="relative p-2 text-slate-900">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    <span class="absolute top-1 right-0 bg-primary-600 text-white text-[7px] font-black w-4 h-4 rounded-full flex items-center justify-center">
                        {{ Auth::user()->cartItems->sum('quantity') ?? 0 }}
                    </span>
                </a>
                @endauth

                <button @click="open = true" class="p-2 text-slate-900 sm:hidden">
                    <div class="space-y-1.5">
                        <span class="block w-6 h-0.5 bg-slate-900"></span>
                        <span class="block w-4 h-0.5 bg-slate-900"></span>
                    </div>
                </button>

                <div class="hidden sm:block">
                    @guest
                        <a href="{{ route('login') }}" class="bg-slate-900 text-white text-[10px] font-black uppercase tracking-widest px-6 py-3 rounded-full hover:bg-primary-600 transition-all">Join Us</a>
                    @else
                        <a href="{{ route('profile.edit') }}" class="text-[10px] font-black uppercase tracking-widest text-slate-900 border border-slate-200 px-5 py-2.5 rounded-full hover:bg-slate-50 transition-all italic">Profile</a>
                    @endguest
                </div>
            </div>
        </div>
    </div>

    <div x-show="open" 
         x-transition:enter="transition ease-in-out duration-300"
         x-transition:enter-start="translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition ease-in-out duration-300"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="translate-x-full"
         class="fixed inset-y-0 right-0 w-[80%] max-w-sm bg-white shadow-2xl z-[70] flex flex-col p-10 sm:hidden"
         @click.away="open = false"
         style="display: none;">
        
        <button @click="open = false" class="self-end p-2 mb-10 text-slate-400 hover:text-slate-900 transition-colors">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>

        <div class="flex-1 space-y-8">
            <div class="space-y-1">
                <span class="text-[10px] font-black text-slate-300 uppercase tracking-widest">Navigation</span>
                <a href="{{ route('products.index') }}" class="block text-4xl font-black text-slate-900 uppercase italic tracking-tighter hover:text-primary-600 transition-colors">Home</a>
                <a href="{{ route('products.list') }}" class="block text-4xl font-black text-slate-900 uppercase italic tracking-tighter hover:text-primary-600 transition-colors">Market</a>
                <a href="{{ route('dashboard') }}" class="block text-4xl font-black text-slate-900 uppercase italic tracking-tighter hover:text-primary-600 transition-colors">Account</a>
            </div>

            @auth
            <div class="pt-8 border-t border-slate-50">
                <span class="text-[10px] font-black text-slate-300 uppercase tracking-widest block mb-4">Member Area</span>
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-12 h-12 bg-slate-100 rounded-full flex items-center justify-center font-black text-slate-400">{{ substr(Auth::user()->name, 0, 1) }}</div>
                    <div>
                        <p class="font-black text-slate-900 uppercase text-sm italic">{{ Auth::user()->name }}</p>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-[10px] font-black uppercase text-red-500 tracking-widest">Sign Out</button>
                        </form>
                    </div>
                </div>
            </div>
            @else
            <div class="pt-10 flex flex-col gap-4">
                <a href="{{ route('login') }}" class="text-center py-5 border-2 border-slate-900 rounded-2xl font-black uppercase tracking-widest text-xs">Login</a>
                <a href="{{ route('register') }}" class="text-center py-5 bg-slate-900 text-white rounded-2xl font-black uppercase tracking-widest text-xs shadow-xl">Join the Club</a>
            </div>
            @endauth
        </div>

        <div class="mt-auto">
            <p class="text-[10px] font-black text-slate-200 uppercase tracking-widest">Mini Market Drop 2026</p>
        </div>
    </div>

    <div x-show="open" 
         x-transition:enter="transition opacity ease-in duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition opacity ease-out duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-slate-950/20 backdrop-blur-sm z-[65] sm:hidden"
         @click="open = false"
         style="display: none;">
    </div>
</nav>

<div class="h-20"></div>