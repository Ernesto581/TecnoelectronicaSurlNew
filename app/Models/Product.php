<?php

namespace App\Models;

use App\Enums\ProductBadge;
use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Catalog product.
 *
 * @property int $id
 * @property int|null $category_id
 * @property string $name
 * @property string $slug
 * @property string|null $description
 * @property float $price
 * @property float|null $original_price
 * @property string|null $sku
 * @property int $stock
 * @property string|null $image_url
 * @property ProductBadge|null $badge
 * @property bool $is_active
 * @property bool $is_featured
 * @property float $rating
 * @property int $reviews_count
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 *
 * @property-read Category|null $category
 * @property-read int|null $discount_percentage
 * @property-read bool $is_in_stock
 *
 * @method static \Illuminate\Database\Eloquent\Builder<self> active()
 * @method static \Illuminate\Database\Eloquent\Builder<self> featured()
 * @method static \Illuminate\Database\Eloquent\Builder<self> inStock()
 * @method static ProductFactory<self> factory()
 */
class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'original_price',
        'sku',
        'stock',
        'image_url',
        'badge',
        'is_active',
        'is_featured',
        'rating',
        'reviews_count',
    ];

    /**
     * Attributes that should be cast to native types.
     */
    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'original_price' => 'decimal:2',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'rating' => 'decimal:2',
            'stock' => 'integer',
            'reviews_count' => 'integer',
            'badge' => ProductBadge::class,
        ];
    }

    /**
     * Category the product belongs to.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Filter only active products.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Filter only featured and active products.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true)->where('is_active', true);
    }

    /**
     * Filter only products with available stock.
     */
    public function scopeInStock($query)
    {
        return $query->where('stock', '>', 0);
    }

    /**
     * Discount percentage relative to the original price.
     * Returns null if there is no discount or the original price is lower than or equal to the current price.
     */
    public function getDiscountPercentageAttribute(): ?int
    {
        if (!$this->original_price || $this->original_price <= $this->price) {
            return null;
        }

        return (int) round((($this->original_price - $this->price) / $this->original_price) * 100);
    }

    /**
     * Whether the product has available stock.
     */
    public function getIsInStockAttribute(): bool
    {
        return $this->stock > 0;
    }

    /**
     * Route key used for route model binding (uses slug instead of id).
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
