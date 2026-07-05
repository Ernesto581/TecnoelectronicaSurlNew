<?php

namespace App\Http\View\Composers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * Composes additional data for the profile edit view.
 *
 * When the authenticated user is an admin, it injects a paginated
 * product list and active categories into the profile page.
 */
class ProfileComposer
{
    /**
     * Bind data to the profile edit view.
     */
    public function compose(View $view): void
    {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            return;
        }

        $view->with([
            'products' => Product::with('category')
                ->latest()
                ->paginate(15),
            'categories' => Category::active()->orderBy('name')->get(),
        ]);
    }
}
