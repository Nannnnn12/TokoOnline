<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'images'])->where('status', 'active');

        // Filter by category
        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }

        // Search by name or description
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('product_name', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        // Sort options
        $sortBy = $request->get('sort', 'product_name');

        switch ($sortBy) {
            case 'price':
                $query->orderBy('sell_price', 'desc');
                break;
            case 'product_name':
            default:
                $query->orderBy('product_name', 'asc');
                break;
        }

        $products = $query->paginate(12);
        $categories = Category::all();

        return view('user.products.index', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        // Check if product is active
        if ($product->status !== 'active') {
            abort(404);
        }

        $product->load(['category', 'images']);
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', 'active')
            ->limit(4)
            ->get();

        return view('user.products.show', compact('product', 'relatedProducts'));
    }
}
