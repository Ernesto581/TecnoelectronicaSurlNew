<?php

namespace App\Models;

use Database\Factories\OrderItemFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Order line item. Stores a snapshot of the product price at the time it was added to the cart.
 *
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property int $quantity
 * @property float $unit_price
 * @property float $subtotal
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 *
 * @property-read Order $order
 * @property-read Product $product
 *
 * @method static OrderItemFactory<self> factory()
 */
class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'unit_price',
        'subtotal',
    ];

    /**
     * Attributes that should be cast to native types.
     */
    protected function casts(): array
    {
        return [
            'quantity' => 'integer',
            'unit_price' => 'decimal:2',
            'subtotal' => 'decimal:2',
        ];
    }

    /**
     * Order this line item belongs to.
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Product associated with this line item (price snapshot in unit_price).
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
