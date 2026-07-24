<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Handles CRUD operations for products.
 *
 * Authorization is handled at the route level via the admin middleware.
 */
class ProductController extends Controller
{
    /**
     * Display a paginated listing of products with optional filters.
     *
     * Query parameters:
     * - search: text search across name, slug, sku, and description
     * - category: filter by category ID
     * - status: active (default), inactive, or trashed
     * - price_min: minimum price
     * - price_max: maximum price
     */
    public function index(Request $request): View
    {
        $query = Product::with('category');

        // Text search
        if ($search = $request->query('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('slug', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Category filter
        if ($request->filled('category')) {
            $query->where('category_id', $request->query('category'));
        }

        // Price range
        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->query('price_min'));
        }
        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->query('price_max'));
        }

        // Status filter
        if ($request->query('status') === 'trashed') {
            $query->onlyTrashed();
        } elseif ($request->query('status') === 'inactive') {
            $query->where('is_active', false);
        } else {
            // Show only active products by default
            $query->where('is_active', true);
        }

        $products = $query->latest()->paginate(20)->withQueryString();

        $categories = Category::active()->orderBy('name')->get();

        return view('products.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create(): View
    {
        $categories = Category::active()->orderBy('name')->get();

        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(StoreProductRequest $request): RedirectResponse
    {
        $product = Product::create($request->validated());

        return redirect()
            ->route('products.show', $product)
            ->with('success', 'Producto creado correctamente.');
    }

    /**
     * Display the specified product details.
     */
    public function show(Product $product): View
    {
        $product->load('category');

        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product): View
    {
        $categories = Category::active()->orderBy('name')->get();

        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $product->update($request->validated());

        return redirect()
            ->route('products.show', $product)
            ->with('success', 'Producto actualizado correctamente.');
    }

    /**
     * Remove the specified product from storage (soft delete).
     */
    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Producto eliminado correctamente.');
    }

    /**
     * Restore a soft-deleted product.
     *
     * The route uses withTrashed() so the model is resolved including trashed records.
     */
    public function restore(Product $product): RedirectResponse
    {
        $product->restore();

        return redirect()
            ->route('products.index')
            ->with('success', 'Producto restaurado correctamente.');
    }
}
