<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Handles CRUD operations for products.
 *
 * Authorization is handled at the route level via the admin middleware.
 */
class ProductController extends Controller
{
    /**
     * Display a paginated listing of all products.
     */
    public function index(): View
    {
        $products = Product::with('category')
            ->latest()
            ->paginate(20);

        return view('profile.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create(): View
    {
        $categories = Category::active()->orderBy('name')->get();

        return view('profile.products.create', compact('categories'));
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(StoreProductRequest $request): RedirectResponse
    {
        $product = Product::create($request->validated());

        return redirect()
            ->route('profile.products.show', $product)
            ->with('success', 'Producto creado correctamente.');
    }

    /**
     * Display the specified product details.
     */
    public function show(Product $product): View
    {
        $product->load('category');

        return view('profile.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product): View
    {
        $categories = Category::active()->orderBy('name')->get();

        return view('profile.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $product->update($request->validated());

        return redirect()
            ->route('profile.products.show', $product)
            ->with('success', 'Producto actualizado correctamente.');
    }

    /**
     * Remove the specified product from storage (soft delete).
     */
    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()
            ->route('profile.products.index')
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
            ->route('profile.products.index')
            ->with('success', 'Producto restaurado correctamente.');
    }
}
