<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('is_active', true)
            ->latest()
            ->get();
        $categories = \App\Models\Category::orderBy('name')->get();
        
        // Get active promotional products
        $promotions = \App\Models\PromotionalProduct::with('product')
            ->active()
            ->take(8)
            ->get();
        
        return view('products.index', compact('products', 'categories', 'promotions'));
    }

    public function list(Request $request)
    {
        $query = Product::where('is_active', true);
        
        // Initialize variables
        $search = $request->get('search');
        $category = $request->get('category');
        $sort = $request->get('sort');

        // Search by name or description
        if ($request->filled('search')) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filter by price range
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Sort products
        switch ($request->sort) {
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'newest':
                $query->latest();
                break;
            default:
                $query->latest();
        }

        $products = $query->paginate(12)->appends($request->query());

        // Get categories for filter
        $categories = \App\Models\Category::orderBy('name')->get();

        return view('products.list', compact('products', 'search', 'category', 'sort', 'categories'));
    }

    public function show(Product $product)
    {
        // Check if product is active and available
        if (!$product->is_active || $product->trashed()) {
            abort(404, 'Product not found or unavailable');
        }
        
        return view('products.show', compact('product'));
    }

    public function about()
    {
        return view('pages.about');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function storeContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        ContactMessage::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'Thank you for your message! We will get back to you soon.');
    }
}
