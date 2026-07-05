<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

/**
 * Handles CRUD operations for products.
 *
 * All mutating actions (create, update, delete) are restricted
 * to administrators via middleware, policy, and form request authorization.
 */
class ProductController extends Controller
{
    /**
     * Apply admin middleware to every action in this controller.
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a paginated listing of all products.
     *
     * Only accessible by administrators.
     */
    public function index(): View
    {
        Gate::authorize('viewAny', Product::class);

        $products = Product::with('category')
            ->latest()
            ->paginate(20);

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     *
     * Only accessible by administrators.
     */
    public function create(): View
    {
        Gate::authorize('create', Product::class);

        $categories = Category::active()->orderBy('name')->get();

        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created product in storage.
     *
     * Only accessible by administrators.
     */
    public function store(StoreProductRequest $request): RedirectResponse
    {
        $product = Product::create($request->validated());

        return redirect()
            ->route('admin.products.show', $product)
            ->with('success', 'Producto creado correctamente.');
    }

    /**
     * Display the specified product details.
     *
     * Only accessible by administrators.
     */
    public function show(Product $product): View
    {
        Gate::authorize('view', $product);

        $product->load('category');

        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified product.
     *
     * Only accessible by administrators.
     */
    public function edit(Product $product): View
    {
        Gate::authorize('update', $product);

        $categories = Category::active()->orderBy('name')->get();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified product in storage.
     *
     * Only accessible by administrators.
     */
    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $product->update($request->validated());

        return redirect()
            ->route('admin.products.show', $product)
            ->with('success', 'Producto actualizado correctamente.');
    }

    /**
     * Remove the specified product from storage (soft delete).
     *
     * Only accessible by administrators.
     */
    public function destroy(Product $product): RedirectResponse
    {
        Gate::authorize('delete', $product);

        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Producto eliminado correctamente.');
    }

    /**
     * Restore a soft-deleted product.
     *
     * Only accessible by administrators.
     */
    public function restore(int $id): RedirectResponse
    {
        $product = Product::onlyTrashed()->findOrFail($id);

        Gate::authorize('restore', $product);

        $product->restore();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Producto restaurado correctamente.');
    }
}
