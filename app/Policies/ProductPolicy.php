<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;

/**
 * Defines authorization rules for Product operations.
 *
 * Only administrators may perform any action on products.
 * Customers and guests are denied.
 */
class ProductPolicy
{
    /**
     * Determine whether the user can view any products (admin list).
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can view a specific product.
     */
    public function view(User $user, Product $product): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can create products.
     */
    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the product.
     */
    public function update(User $user, Product $product): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the product.
     */
    public function delete(User $user, Product $product): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can restore a soft-deleted product.
     */
    public function restore(User $user, Product $product): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the product.
     */
    public function forceDelete(User $user, Product $product): bool
    {
        return $user->isAdmin();
    }
}
