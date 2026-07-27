<?php

namespace App\Http\Controllers;

use App\Enums\Rol;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * Handles user account management for administrators.
 *
 * Admins can view user data, change roles, search, and filter.
 * Passwords are never exposed.
 */
class UserController extends Controller
{
    /**
     * Display a paginated listing of users with search and role filter.
     *
     * @param  Request  $request
     * @return View
     */
    public function index(Request $request): View
    {
        $query = User::withCount(['orders' => fn ($q) => $q->placed()]);

        // Status filter: show all by default, filter only when explicitly selected
        if ($request->query('status') === 'active') {
            $query->where('is_active', true);
        } elseif ($request->query('status') === 'inactive') {
            $query->where('is_active', false);
        }

        // Text search by name or email
        if ($search = $request->query('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Role filter
        if ($request->filled('rol')) {
            $query->where('rol', $request->query('rol'));
        }

        $users = $query->latest()->paginate(20)->withQueryString();

        // Counters
        $totalAdmins = User::where('rol', Rol::Admin)->where('is_active', true)->count();
        $totalCustomers = User::where('rol', Rol::Customer)->where('is_active', true)->count();
        $totalInactive = User::where('is_active', false)->count();

        return view('users.index', compact('users', 'totalAdmins', 'totalCustomers', 'totalInactive'));
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

    /**
     * Toggle the user's role between admin and customer.
     *
     * @param  User  $user
     * @return RedirectResponse
     */
    public function toggleRole(User $user): RedirectResponse
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'No puedes cambiar tu propio rol.');
        }

        $newRole = $user->isAdmin() ? Rol::Customer : Rol::Admin;
        $user->update(['rol' => $newRole]);

        return back()->with('success',
            "Rol de {$user->name} cambiado a " . $newRole->label() . "."
        );
    }

    /**
     * Toggle the user's active status.
     *
     * @param  User  $user
     * @return RedirectResponse
     */
    public function toggleActive(User $user): RedirectResponse
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'No puedes desactivar tu propia cuenta.');
        }

        $user->update(['is_active' => !$user->is_active]);

        $action = $user->is_active ? 'activado' : 'desactivado';

        return back()->with('success', "Cuenta de {$user->name} {$action} correctamente.");
    }
}
