<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;

/**
 * Defines authorization rules for Category operations.
 *
 * Only administrators may perform any action on categories.
 * Customers and guests are denied.
 */
class CategoryPolicy
{
    /**
     * Determine whether the user can view any categories (admin list).
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can view a specific category.
     */
    public function view(User $user, Category $category): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can create categories.
     */
    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the category.
     */
    public function update(User $user, Category $category): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the category.
     */
    public function delete(User $user, Category $category): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can restore a soft-deleted category.
     */
    public function restore(User $user, Category $category): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the category.
     */
    public function forceDelete(User $user, Category $category): bool
    {
        return $user->isAdmin();
    }
}
