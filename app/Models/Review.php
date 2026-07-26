<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * A user's rating and review for a product.
 *
 * @property int $id
 * @property int $user_id
 * @property int $product_id
 * @property int $rating  1-5
 * @property string|null $comment
 */
class Review extends Model
{
    protected $fillable = ['user_id', 'product_id', 'rating', 'comment'];

    protected function casts(): array
    {
        return [
            'rating' => 'integer',
        ];
    }

    /**
     * The user who wrote the review.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The product being reviewed.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Recalculate the average rating and review count for the given product.
     */
    public static function recalculateForProduct(Product $product): void
    {
        $stats = self::where('product_id', $product->id)
            ->selectRaw('COALESCE(AVG(rating), 0) as avg_rating, COUNT(*) as count')
            ->first();

        $product->update([
            'rating' => round($stats->avg_rating, 2),
            'reviews_count' => $stats->count,
        ]);
    }
}
