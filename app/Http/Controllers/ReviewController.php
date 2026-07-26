<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

/**
 * Handles product reviews and ratings.
 */
class ReviewController extends Controller
{
    /**
     * Store or update a review for a product.
     *
     * @param  Product  $product
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Product $product, Request $request): RedirectResponse
    {
        $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['nullable', 'string', 'max:1000'],
        ]);

        Review::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'product_id' => $product->id,
            ],
            [
                'rating' => $request->input('rating'),
                'comment' => $request->input('comment'),
            ]
        );

        Review::recalculateForProduct($product);

        return back()->with('review_success', '¡Gracias por tu valoración!');
    }
}
