<?php

namespace App\Models;

use App\Enums\Rol;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * System user.
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property Rol $rol
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Order> $orders
 * @property-read Order|null $cart
 *
 * @method static UserFactory<self> factory()
 */
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'rol',
        'newsletter',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Attributes that should be cast to native types.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'rol' => Rol::class,
            'newsletter' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Determine if the user is an administrator.
     */
    public function isAdmin(): bool
    {
        return $this->rol === Rol::Admin;
    }

    /**
     * Determine if the user is a customer.
     */
    public function isCustomer(): bool
    {
        return $this->rol === Rol::Customer;
    }

    /**
     * All orders belonging to the user.
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Return the user's active cart (order with "cart" status), or null if none exists.
     */
    public function cart(): ?Order
    {
        return $this->orders()->cart()->first();
    }
}
