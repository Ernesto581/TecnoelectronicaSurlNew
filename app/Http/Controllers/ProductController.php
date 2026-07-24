<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
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
     * Query parameters: search, category, status, price_min, price_max.
     *
     * @param  Request  $request
     * @return View
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
     *
     * @return View
     */
    public function create(): View
    {
        $categories = Category::active()->orderBy('name')->get();

        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created product in storage.
     *
     * @param  StoreProductRequest  $request
     * @return RedirectResponse
     */
    public function store(StoreProductRequest $request): RedirectResponse
    {
        $data = $request->validated();

        // Auto-generate unique slug from name
        $data['slug'] = $this->generateUniqueSlug($data['name']);

        // Track when the price was last changed (now, since this is creation)
        $data['price_changed_at'] = now();

        // Handle image upload
        if ($request->hasFile('image')) {
            $data['image_url'] = $request->file('image')->store('products', 'public');
        }

        unset($data['image']);

        $product = Product::create($data);

        return redirect()
            ->route('products.show', $product)
            ->with('success', 'Producto creado correctamente.');
    }

    /**
     * Display the specified product details.
     *
     * @param  Product  $product
     * @return View
     */
    public function show(Product $product): View
    {
        $product->load('category');

        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified product.
     *
     * @param  Product  $product
     * @return View
     */
    public function edit(Product $product): View
    {
        $categories = Category::active()->orderBy('name')->get();

        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified product in storage.
     *
     * @param  UpdateProductRequest  $request
     * @param  Product               $product
     * @return RedirectResponse
     */
    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $data = $request->validated();

        // Regenerate slug if name changed
        if (isset($data['name'])) {
            $data['slug'] = $this->generateUniqueSlug($data['name'], $product->id);
        }

        // Track price changes for the 30-day stabilization rule
        if ($request->filled('discount_percentage') && $product->original_price !== null) {
            $discountPct = (float) $request->input('discount_percentage');
            if ($discountPct > 0) {
                $data['price'] = round($product->original_price * (1 - $discountPct / 100), 2);
            }
        }

        if (isset($data['price']) && $data['price'] != $product->price) {
            $data['price_changed_at'] = now();

            // Reset original_price if the new price is higher than the current original
            if ($product->original_price !== null && $data['price'] > $product->original_price) {
                $data['original_price'] = null;
            }
        }

        // Remove discount_percentage from data (not a model attribute)
        unset($data['discount_percentage']);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($product->image_url) {
                Storage::disk('public')->delete($product->image_url);
            }
            $data['image_url'] = $request->file('image')->store('products', 'public');
        }

        unset($data['image']);

        $product->update($data);

        return redirect()
            ->route('products.show', $product)
            ->with('success', 'Producto actualizado correctamente.');
    }

    /**
     * Generate a unique slug from the product name.
     *
     * Appends a numeric suffix if the slug already exists,
     * ignoring the product with the given ID when updating.
     *
     * @param  string    $name       Product name to slugify.
     * @param  int|null  $excludeId  Product ID to exclude from duplicate check.
     * @return string
     */
    private function generateUniqueSlug(string $name, ?int $excludeId = null): string
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $counter = 1;

        $query = Product::withTrashed()->where('slug', $slug);
        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        while ($query->exists()) {
            $slug = $originalSlug . '-' . ++$counter;
            $query = Product::withTrashed()->where('slug', $slug);
            if ($excludeId) {
                $query->where('id', '!=', $excludeId);
            }
        }

        return $slug;
    }

    /**
     * Remove the specified product from storage (soft delete).
     *
     * @param  Product  $product
     * @return RedirectResponse
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
     *
     * @param  Product  $product
     * @return RedirectResponse
     */
    public function restore(Product $product): RedirectResponse
    {
        $product->restore();

        return redirect()
            ->route('products.index')
            ->with('success', 'Producto restaurado correctamente.');
    }
}
