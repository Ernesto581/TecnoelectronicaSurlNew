<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StoreController extends Controller
{
    public function index(Request $request): View
    {
        $query = Product::with('category')->where('is_active', true);

        if ($q = $request->query('q')) {
            $query->where(function ($qry) use ($q) {
                $qry->where('name', 'like', "%{$q}%")
                    ->orWhere('description', 'like', "%{$q}%");
            });
        }

        $products = $query->latest()->get()->map(fn($p) => [
            'id' => $p->id,
            'slug' => $p->slug,
            'name' => $p->name,
            'description' => $p->description,
            'price' => $p->price,
            'original_price' => $p->original_price,
            'image_url' => $p->image_url,
            'badge' => $p->badge,
            'rating' => $p->rating,
            'reviews_count' => $p->reviews_count,
            'categoryName' => $p->category->name ?? 'General',
        ]);

        return view('pages.tienda', [
            'productsJson' => $products,
            'categories' => Category::all(),
            'searchQuery' => $request->query('q', ''),
        ]);
    }

    public function show(Product $product): View
    {
        $product->load('category');

        if (!$product->is_active) {
            abort(404);
        }

        $discount = $product->original_price
            ? round((($product->original_price - $product->price) / $product->original_price) * 100)
            : 0;

        return view('pages.tienda-producto', compact('product', 'discount'));
    }

    public function category(Category $category): View
    {
        $products = $category->products()
            ->where('is_active', true)
            ->latest()
            ->get()
            ->map(fn($p) => [
                'id' => $p->id,
                'name' => $p->name,
                'slug' => $p->slug,
                'description' => $p->description,
                'price' => $p->price,
                'original_price' => $p->original_price,
                'image_url' => $p->image_url,
                'badge' => $p->badge,
                'rating' => $p->rating,
                'reviews_count' => $p->reviews_count,
            ]);

        return view('pages.tienda-categoria', [
            'products' => $products,
            'categoria' => $category->name,
            'category' => $category,
        ]);
    }
}
