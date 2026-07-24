<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;

/**
 * Handles read-only access to user accounts for administrators.
 *
 * Admins can view user data (name, email, role, orders) but cannot
 * modify it. Passwords are never exposed.
 */
class UserController extends Controller
{
    /**
     * Display a paginated listing of all users with placed order counts.
     *
     * @return View
     */
    public function index(): View
    {
        $users = User::withCount(['orders' => fn ($q) => $q->placed()])
            ->latest()
            ->paginate(20);

        return view('users.index', compact('users'));
    }

    /**
     * Display the specified user's details and order history.
     *
     * @param  User  $user
     * @return View
     */
    public function show(User $user): View
    {
        $user->load(['orders' => fn ($q) => $q->placed()->latest()]);

        return view('users.show', compact('user'));
    }
}
