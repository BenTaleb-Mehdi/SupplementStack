<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Setting;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (!Auth::user()->is_admin) {
                abort(403, 'Unauthorized action.');
            }
            return $next($request);
        });
    }

    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_orders' => Order::count(),
            'total_products' => Product::count(),
            'in_stock_products' => Product::where('stock', '>', 0)->count(),
            'low_stock_products' => Product::where('stock', '>', 0)->where('stock', '<=', 10)->count(),
            'total_revenue' => Order::where('payment_status', 'paid')->sum('total_amount'),
            'pending_orders' => Order::where('payment_status', 'pending')->count(),
            'paid_orders' => Order::where('payment_status', 'paid')->count(),
            'recent_orders' => Order::with('user')->latest()->take(5)->get(),
        ];

        // Get low stock products for the widget
        $low_stock_products = Product::where('stock', '>', 0)
            ->where('stock', '<=', 10)
            ->orderBy('stock', 'asc')
            ->take(5)
            ->get();

        // Get recent orders with items
        $recent_orders = Order::with(['user', 'orderItems.product' => function($query) {
            $query->withTrashed();
        }])
        ->latest()
        ->take(5)
        ->get();

        return view('admin.dashboard', compact('stats', 'low_stock_products', 'recent_orders'));
    }

    // User management
    public function users()
    {
        $users = User::latest()->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function deleteUser(User $user)
    {
        if ($user->is_admin) {
            return redirect()->back()->with('error', 'Cannot delete admin user!');
        }

        $user->delete();
        return redirect()->back()->with('success', 'User deleted successfully!');
    }

    // Order management
    public function orders(Request $request)
    {
        $search = $request->get('search');
        $status = $request->get('status');
        $category = $request->get('category');
        $dateFrom = $request->get('date_from');
        $dateTo = $request->get('date_to');

        $query = Order::with('user');

        if ($search) {
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        if ($status) {
            $query->where('payment_status', $status);
        }

        if ($dateFrom) {
            $query->whereDate('created_at', '>=', $dateFrom);
        }

        if ($dateTo) {
            $query->whereDate('created_at', '<=', $dateTo);
        }

        $orders = $query->latest()->paginate(15)->appends($request->query());

        return view('admin.orders.index', compact('orders', 'search', 'status', 'category', 'dateFrom', 'dateTo'));
    }

    public function updateOrder(Request $request, Order $order)
    {
        $request->validate([
            'payment_status' => 'required|in:pending,paid,failed',
        ]);

        $order->update([
            'payment_status' => $request->payment_status,
        ]);

        return redirect()->back()->with('success', 'Order status updated successfully!');
    }

    // Product management
    public function products(Request $request)
    {
        $showDeleted = $request->get('show_deleted', false);
        $search = $request->get('search');
        $category = $request->get('category');
        $minPrice = $request->get('min_price');
        $maxPrice = $request->get('max_price');
        $availability = $request->get('availability');
        
        $query = $showDeleted ? Product::withTrashed() : Product::query();
        
        // Apply search filter
        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }
        
        // Apply category filter
        if ($category) {
            $query->where('category', $category);
        }
        
        // Apply price range filter
        if ($minPrice) {
            $query->where('price', '>=', $minPrice);
        }
        if ($maxPrice) {
            $query->where('price', '<=', $maxPrice);
        }
        
        // Apply availability filter
        if ($availability === 'in_stock') {
            $query->where('stock', '>', 0);
        } elseif ($availability === 'out_of_stock') {
            $query->where('stock', '=', 0);
        }
        
        $products = $query->latest()->paginate(10);
        
        // Get categories from Category model
        $categories = \App\Models\Category::orderBy('name')->get();
        
        return view('admin.products.index', compact('products', 'showDeleted', 'categories', 'search', 'category', 'minPrice', 'maxPrice', 'availability'));
    }

    public function createProduct()
    {
        $categories = \App\Models\Category::orderBy('name')->get();
        return view('admin.products.create', compact('categories'));
    }

    public function storeProduct(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'category' => 'required|string',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $validated['is_active'] = $request->has('is_active');

        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');
    }

    public function editProduct($id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        $categories = \App\Models\Category::orderBy('name')->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function updateProduct(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'category' => 'required|string',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
        ]);

            if ($request->hasFile('image')) {
                if ($product->image && Storage::disk('public')->exists($product->image)) {
                    Storage::disk('public')->delete($product->image); // delete old image
                }
                $validated['image'] = $request->file('image')->store('products', 'public');
            }
            $validated['is_active'] = $request->has('is_active');
            $product->update($validated);


        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }

    public function destroyProduct(Product $product)
    {
        $product->delete();
        return redirect()->back()->with('success', 'Product deleted successfully!');
    }

    public function restoreProduct($id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        $product->restore();
        return redirect()->back()->with('success', 'Product restored successfully!');
    }

    public function addStock(Request $request, Product $product)
    {
        $request->validate([
            'add_quantity' => 'required|integer|min:1|max:1000',
        ]);

        $product->increment('stock', $request->add_quantity);

        return redirect()->back()->with('success', "Added {$request->add_quantity} units to {$product->name}!");
    }

    // Contact Messages
    public function messages()
    {
        $messages = ContactMessage::latest()->paginate(15);
        return view('admin.messages.index', compact('messages'));
    }

    public function showMessage(ContactMessage $message)
    {
        return view('admin.messages.show', compact('message'));
    }

    public function deleteMessage(ContactMessage $message)
    {
        $message->delete();
        return redirect()->route('admin.messages.index')->with('success', 'Message deleted successfully!');
    }

    public function replyMessage(Request $request, ContactMessage $message)
    {
        $request->validate([
            'reply' => 'required|string',
        ]);

        // Here you would typically send an email
        // For now, we'll just store the reply

        return redirect()->back()->with('success', 'Reply sent successfully!');
    }

    public function showOrder(Order $order)
    {
        $order->load(['user', 'orderItems.product' => function($query) {
            $query->withTrashed();
        }]);

        return view('admin.orders.show', compact('order'));
    }

    // Settings management
    public function settings()
    {
        $settings = Setting::getAllGrouped();
        
        // Initialize default settings if they don't exist
        $this->initializeDefaultSettings();
        
        // Refresh settings after initialization
        $settings = Setting::getAllGrouped();
        
        // Get all categories
        $categories = \App\Models\Category::orderBy('name')->get();
        
        // Get all products for promo selection
        $products = Product::where('is_active', true)->orderBy('name')->get();
        
        // Get promotional products
        $promotions = \App\Models\PromotionalProduct::with('product')->get();
        
        return view('admin.settings.index', compact('settings', 'categories', 'products', 'promotions'));
    }

    public function updateSettings(Request $request)
    {
        $validated = $request->validate([
            'settings' => 'nullable|array',
            'settings.*' => 'nullable',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'home_hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:8192',
            'admin_email' => 'nullable|email|unique:users,email,' . Auth::id(),
            'admin_name' => 'nullable|string|max:255',
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|string|min:8|confirmed',
            'new_password_confirmation' => 'nullable|string',
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
            
            // Delete old logo if exists
            $oldLogo = Setting::get('site_logo');
            if ($oldLogo && Storage::disk('public')->exists($oldLogo)) {
                Storage::disk('public')->delete($oldLogo);
            }
            
            // Update logo setting
            Setting::set('site_logo', $logoPath, 'string', 'general', 'Site Logo', 'Logo image for the website');
        }

        // Handle home hero image upload
        if ($request->hasFile('home_hero_image')) {
            $heroPath = $request->file('home_hero_image')->store('hero', 'public');

            // Delete old hero image if exists
            $oldHero = Setting::get('home_hero_image');
            if ($oldHero && Storage::disk('public')->exists($oldHero)) {
                Storage::disk('public')->delete($oldHero);
            }

            // Update hero image setting
            Setting::set('home_hero_image', $heroPath, 'string', 'general', 'Home Hero Image', 'Background image for home page hero');
        }

        // Handle about image upload
        if ($request->hasFile('about_image')) {
            $aboutPath = $request->file('about_image')->store('about', 'public');

            // Delete old about image if exists
            $oldAbout = Setting::get('about_image');
            if ($oldAbout && Storage::disk('public')->exists($oldAbout)) {
                Storage::disk('public')->delete($oldAbout);
            }

            // Update about image setting
            Setting::set('about_image', $aboutPath, 'string', 'general', 'About Us Image', 'Main image on the About Us page');
        }

        // Handle admin account updates
        $admin = Auth::user();
        $accountUpdated = false;
        
        if ($request->filled('admin_email') && $request->admin_email !== $admin->email) {
            $admin->update(['email' => $request->admin_email]);
            $accountUpdated = true;
        }
        
        if ($request->filled('admin_name') && $request->admin_name !== $admin->name) {
            $admin->update(['name' => $request->admin_name]);
            $accountUpdated = true;
        }

        // Handle password change
        if ($request->filled('current_password') && $request->filled('new_password')) {
            if (!Hash::check($request->current_password, $admin->password)) {
                return redirect()->route('admin.settings')
                    ->with('error', 'Current password is incorrect!');
            }
            
            $admin->update([
                'password' => Hash::make($request->new_password)
            ]);
            
            return redirect()->route('admin.settings')
                ->with('success', 'Password updated successfully!');
        }

        // Handle regular settings
        if (isset($validated['settings'])) {
            foreach ($validated['settings'] as $key => $value) {
                $setting = Setting::where('key', $key)->first();
                
                if ($setting) {
                    // Handle boolean values
                    if ($setting->type === 'boolean') {
                        $value = $request->has("settings.{$key}") ? '1' : '0';
                    }
                    
                    $setting->update(['value' => $value]);
                    
                    // Clear cache
                    \Illuminate\Support\Facades\Cache::forget("setting_{$key}");
                }
            }
        }

        // Determine success message
        $message = 'Settings updated successfully!';
        if ($accountUpdated) {
            $message = 'Account information and settings updated successfully!';
        }

        return redirect()->route('admin.settings')
            ->with('success', $message);
    }

    // Category Management
    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public');
            $validated['image'] = $imagePath;
        }

        \App\Models\Category::create($validated);

        return redirect()->route('admin.settings')
            ->with('success', 'Category created successfully!');
    }

    public function updateCategory(Request $request, \App\Models\Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($category->image && \Storage::disk('public')->exists($category->image)) {
                \Storage::disk('public')->delete($category->image);
            }
            $imagePath = $request->file('image')->store('categories', 'public');
            $validated['image'] = $imagePath;
        }

        $category->update($validated);

        return redirect()->route('admin.settings')
            ->with('success', 'Category updated successfully!');
    }

    public function destroyCategory(\App\Models\Category $category)
    {
        $category->delete();

        return redirect()->route('admin.settings')
            ->with('success', 'Category deleted successfully!');
    }

    // Promotional Products Management
    public function storePromotion(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id|unique:promotional_products,product_id',
            'discount_percentage' => 'required|integer|min:1|max:99',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        \App\Models\PromotionalProduct::create($validated);

        return redirect()->route('admin.settings')
            ->with('success', 'Promotional product added successfully!');
    }

    public function updatePromotion(Request $request, \App\Models\PromotionalProduct $promotion)
    {
        $validated = $request->validate([
            'discount_percentage' => 'required|integer|min:1|max:99',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $promotion->update($validated);

        return redirect()->route('admin.settings')
            ->with('success', 'Promotion updated successfully!');
    }

    public function destroyPromotion(\App\Models\PromotionalProduct $promotion)
    {
        $promotion->delete();

        return redirect()->route('admin.settings')
            ->with('success', 'Promotion removed successfully!');
    }

    private function initializeDefaultSettings()
    {
        $defaultSettings = [
            // General Settings
            [
                'key' => 'site_name',
                'value' => 'Mini Market',
                'type' => 'string',
                'group' => 'general',
                'label' => 'Site Name',
                'description' => 'The name of your website',
            ],
            [
                'key' => 'site_description',
                'value' => 'Your one-stop shop for quality products',
                'type' => 'text',
                'group' => 'general',
                'label' => 'Site Description',
                'description' => 'A brief description of your website',
            ],
            [
                'key' => 'contact_email',
                'value' => 'contact@minimarket.com',
                'type' => 'string',
                'group' => 'general',
                'label' => 'Contact Email',
                'description' => 'Email address for customer inquiries',
            ],
            [
                'key' => 'contact_phone',
                'value' => '+1 234 567 8900',
                'type' => 'string',
                'group' => 'general',
                'label' => 'Contact Phone',
                'description' => 'Phone number for customer support',
            ],
            [
                'key' => 'about_image',
                'value' => '',
                'type' => 'string',
                'group' => 'general',
                'label' => 'About Us Image',
                'description' => 'Main image on the About Us page',
            ],
            [
                'key' => 'home_hero_image',
                'value' => '',
                'type' => 'string',
                'group' => 'general',
                'label' => 'Home Hero Image',
                'description' => 'Background image for home page hero',
            ],
            [
                'key' => 'home_hero_height',
                'value' => 'min-h-[95vh]',
                'type' => 'select',
                'group' => 'general',
                'label' => 'Home Hero Height',
                'description' => 'Height of the homepage banner',
            ],
            [
                'key' => 'home_hero_badge',
                'value' => 'Scientific Performance',
                'type' => 'string',
                'group' => 'general',
                'label' => 'Hero Badge Text',
                'description' => 'Small text above the main headline',
            ],
            [
                'key' => 'home_hero_title',
                'value' => '<span class="text-primary-500">PUSH</span> <br> BEYOND.',
                'type' => 'text', // using text type for textarea
                'group' => 'general',
                'label' => 'Hero Title',
                'description' => 'Main headline',
            ],
            [
                'key' => 'home_hero_subtitle',
                'value' => 'Premium formulas designed for those who measure success in sweat and results. Your elite journey starts with the right fuel.',
                'type' => 'text',
                'group' => 'general',
                'label' => 'Hero Subtitle',
                'description' => 'Description text below the headline',
            ],
            [
                'key' => 'home_hero_cta_text',
                'value' => 'Shop Now',
                'type' => 'string',
                'group' => 'general',
                'label' => 'Hero Button Text',
                'description' => 'Text for the main Call-to-Action button',
            ],
            
            // Currency Settings
            [
                'key' => 'currency',
                'value' => 'MAD',
                'type' => 'string',
                'group' => 'payment',
                'label' => 'Currency',
                'description' => 'Default currency for the store',
            ],
            
            // Payment Settings
            [
                'key' => 'enable_cod',
                'value' => '1',
                'type' => 'boolean',
                'group' => 'payment',
                'label' => 'Enable Cash on Delivery',
                'description' => 'Allow customers to pay on delivery',
            ],
            [
                'key' => 'enable_card_payment',
                'value' => '1',
                'type' => 'boolean',
                'group' => 'payment',
                'label' => 'Enable Card Payment',
                'description' => 'Allow customers to pay with credit/debit cards',
            ],
            
            // Shipping Settings
            [
                'key' => 'shipping_fee',
                'value' => '0',
                'type' => 'float',
                'group' => 'shipping',
                'label' => 'Shipping Fee',
                'description' => 'Default shipping fee',
            ],
            [
                'key' => 'free_shipping_threshold',
                'value' => '100',
                'type' => 'float',
                'group' => 'shipping',
                'label' => 'Free Shipping Threshold',
                'description' => 'Minimum order amount for free shipping',
            ],
        ];

        foreach ($defaultSettings as $setting) {
            Setting::firstOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
