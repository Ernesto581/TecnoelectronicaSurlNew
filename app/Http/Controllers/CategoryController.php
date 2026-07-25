<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

/**
 * Handles CRUD operations for product categories.
 *
 * Authorization is handled at the route level via the admin middleware.
 */
class CategoryController extends Controller
{
    /**
     * Display a paginated listing of all categories.
     *
     * @return View
     */
    public function index(): View
    {
        $categories = Category::withCount('products')
            ->latest()
            ->paginate(20);

        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     *
     * @return View
     */
    public function create(): View
    {
        return view('categories.create');
    }

    /**
     * Store a newly created category in storage.
     *
     * @param  StoreCategoryRequest  $request
     * @return RedirectResponse
     */
    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = $this->generateUniqueSlug($data['name']);

        // Handle image upload
        if ($request->hasFile('image')) {
            $data['image_url'] = $request->file('image')->store('categories', 'public');
        }

        unset($data['image']);

        $category = Category::create($data);

        return redirect()
            ->route('categories.show', $category)
            ->with('success', 'Categoría creada correctamente.');
    }

    /**
     * Display the specified category details.
     *
     * @param  Category  $category
     * @return View
     */
    public function show(Category $category): View
    {
        $category->loadCount('products');

        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified category.
     *
     * @param  Category  $category
     * @return View
     */
    public function edit(Category $category): View
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified category in storage.
     *
     * @param  UpdateCategoryRequest  $request
     * @param  Category               $category
     * @return RedirectResponse
     */
    public function update(UpdateCategoryRequest $request, Category $category): RedirectResponse
    {
        $data = $request->validated();

        if (isset($data['name'])) {
            $data['slug'] = $this->generateUniqueSlug($data['name'], $category->id);
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            if ($category->image_url) {
                Storage::disk('public')->delete($category->image_url);
            }
            $data['image_url'] = $request->file('image')->store('categories', 'public');
        }

        unset($data['image']);

        $category->update($data);

        return redirect()
            ->route('categories.show', $category)
            ->with('success', 'Categoría actualizada correctamente.');
    }

    /**
     * Remove the specified category (soft delete).
     *
     * @param  Category  $category
     * @return RedirectResponse
     */
    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        return redirect()
            ->route('categories.index')
            ->with('success', 'Categoría eliminada correctamente.');
    }

    /**
     * Restore a soft-deleted category.
     *
     * The route uses withTrashed() so the model is resolved including trashed records.
     *
     * @param  Category  $category
     * @return RedirectResponse
     */
    public function restore(Category $category): RedirectResponse
    {
        $category->restore();

        return redirect()
            ->route('categories.index')
            ->with('success', 'Categoría restaurada correctamente.');
    }

    /**
     * Generate a unique slug from the category name.
     *
     * @param  string    $name
     * @param  int|null  $excludeId
     * @return string
     */
    private function generateUniqueSlug(string $name, ?int $excludeId = null): string
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $counter = 1;

        $query = Category::withTrashed()->where('slug', $slug);
        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        while ($query->exists()) {
            $slug = $originalSlug . '-' . ++$counter;
            $query = Category::withTrashed()->where('slug', $slug);
            if ($excludeId) {
                $query->where('id', '!=', $excludeId);
            }
        }

        return $slug;
    }
}
