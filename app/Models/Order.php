<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Database\Factories\OrderFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Order. An order with "cart" status acts as a shopping cart.
 *
 * @property int $id
 * @property int $user_id
 * @property OrderStatus $status
 * @property float $subtotal
 * @property float $total
 * @property string|null $shipping_address
 * @property string|null $shipping_city
 * @property string|null $shipping_state
 * @property string|null $shipping_zip
 * @property string|null $shipping_country
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 *
 * @property-read User $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, OrderItem> $items
 *
 * @method static \Illuminate\Database\Eloquent\Builder<self> cart()
 * @method static \Illuminate\Database\Eloquent\Builder<self> placed()
 * @method static OrderFactory<self> factory()
 */
class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'status',
        'subtotal',
        'total',
        'shipping_address',
        'shipping_city',
        'shipping_state',
        'shipping_zip',
        'shipping_country',
        'notes',
    ];

    /**
     * Attributes that should be cast to native types.
     */
    protected function casts(): array
    {
        return [
            'status' => OrderStatus::class,
            'subtotal' => 'decimal:2',
            'total' => 'decimal:2',
        ];
    }

    /**
     * User who owns the order.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Line items that make up the order.
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Filter only orders in cart state.
     */
    public function scopeCart($query)
    {
        return $query->where('status', OrderStatus::Cart);
    }

    /**
     * Filter placed orders (all except cart and cancelled).
     */
    public function scopePlaced($query)
    {
        return $query->whereNotIn('status', [OrderStatus::Cart, OrderStatus::Cancelled]);
    }

    /**
     * Whether the order is in cart state.
     */
    public function isCart(): bool
    {
        return $this->status === OrderStatus::Cart;
    }

    /**
     * Recalculate the order's subtotal and total from the sum of its line items.
     */
    public function recalculateTotals(): void
    {
        $this->subtotal = $this->items->sum('subtotal');
        $this->total = $this->subtotal;
        $this->save();
    }
}
