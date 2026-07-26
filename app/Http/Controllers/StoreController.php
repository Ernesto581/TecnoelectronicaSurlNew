<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

/**
 * Public storefront controller.
 *
 * Handles product listing, search, detail, and category filtering
 * for the customer-facing store pages.
 */
class StoreController extends Controller
{
    /**
     * Display the full product catalog with optional search.
     *
     * @param  Request  $request  Incoming request with optional ?q= search query.
     * @return View
     */
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
            'image_url' => $this->resolveImageUrl($p->image_url),
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

    /**
     * Display a single product detail page.
     *
     * Aborts with 404 if the product is not active (hidden from public catalog).
     *
     * @param  Product  $product  Resolved via route model binding (slug).
     * @return View
     */
    public function show(Product $product): View
    {
        $product->load('category');

        if (!$product->is_active) {
            abort(404);
        }

        $discount = $product->original_price
            ? round((($product->original_price - $product->price) / $product->original_price) * 100)
            : 0;

        // Related products: same category, active, excluding current product
        $related = Product::with('category')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->latest()
            ->take(4)
            ->get();

        return view('pages.tienda-producto', compact('product', 'discount', 'related'));
    }

    /**
     * Display products belonging to a specific category.
     *
     * @param  Category  $category  Resolved via route model binding (slug).
     * @return View
     */
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
                'image_url' => $this->resolveImageUrl($p->image_url),
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

    /**
     * Resolve an image path to a full URL, supporting both external URLs
     * and local storage paths.
     *
     * @param  string|null  $imageUrl
     * @return string|null
     */
    private function resolveImageUrl(?string $imageUrl): ?string
    {
        if (!$imageUrl) {
            return null;
        }

        if (Str::startsWith($imageUrl, 'http')) {
            return $imageUrl;
        }

        return Storage::url($imageUrl);
    }
}
