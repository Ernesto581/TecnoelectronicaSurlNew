<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

/**
 * Public-facing store controller.
 *
 * Provides read-only views of the product catalog.
 * No authentication required.
 */
class StoreController extends Controller
{
    /**
     * Display the main store page with all active products.
     */
    public function index(): View
    {
        $products = Product::active()
            ->with('category')
            ->latest()
            ->paginate(24);

        $categories = Category::active()
            ->withCount(['products' => fn ($q) => $q->active()])
            ->orderBy('name')
            ->get();

        return view('pages.tienda', compact('products', 'categories'));
    }

    /**
     * Display a single product detail page.
     *
     * Automatically resolves the product by its slug via route model binding.
     */
    public function show(Product $product): View
    {
        $product->load('category');

        return view('pages.tienda-producto', compact('product'));
    }

    /**
     * Display products belonging to a specific category.
     *
     * Automatically resolves the category by its slug via route model binding.
     */
    public function category(Category $category): View
    {
        $products = $category->products()
            ->active()
            ->latest()
            ->paginate(24);

        return view('pages.tienda-categoria', [
            'products' => $products,
            'categoria' => $category,
        ]);
    }
}
