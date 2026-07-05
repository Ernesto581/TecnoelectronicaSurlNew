<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;

/**
 * Defines authorization rules for Order operations.
 *
 * Administrators may perform any action on any order.
 * Customers may only view and cancel their own orders.
 * Guests are denied.
 */
class OrderPolicy
{
    /**
     * Determine whether the user can view any orders (admin list).
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can view a specific order.
     *
     * Administrators may view any order. Customers may only view their own.
     */
    public function view(User $user, Order $order): bool
    {
        return $user->isAdmin() || $order->user_id === $user->id;
    }

    /**
     * Determine whether the user can create orders.
     */
    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the order.
     */
    public function update(User $user, Order $order): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can delete (cancel) the order.
     *
     * Administrators may cancel any order. Customers may only cancel their own.
     */
    public function delete(User $user, Order $order): bool
    {
        return $user->isAdmin() || $order->user_id === $user->id;
    }

    /**
     * Determine whether the user can restore a soft-deleted order.
     */
    public function restore(User $user, Order $order): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the order.
     */
    public function forceDelete(User $user, Order $order): bool
    {
        return $user->isAdmin();
    }
}
