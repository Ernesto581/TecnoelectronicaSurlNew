<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * Handles admin order management: listing, viewing, and status transitions.
 *
 * Authorization is handled at the route level via the admin middleware.
 */
class OrderController extends Controller
{
    /**
     * Display a paginated listing of placed orders (excluding carts).
     *
     * @param  Request  $request
     * @return View
     */
    public function index(Request $request): View
    {
        $query = Order::with('user')
            ->placed()
            ->latest();

        // Filter by status
        if ($request->filled('status')) {
            $status = OrderStatus::tryFrom($request->query('status'));
            if ($status) {
                $query->where('status', $status);
            }
        }

        $orders = $query->paginate(20)->withQueryString();

        $statuses = collect(OrderStatus::cases())->filter(fn ($s) => $s !== OrderStatus::Cart);

        return view('orders.index', compact('orders', 'statuses'));
    }

    /**
     * Display a single order with its items and shipping details.
     *
     * @param  Order  $order
     * @return View
     */
    public function show(Order $order): View
    {
        $order->load(['user', 'items.product']);

        return view('orders.show', compact('order'));
    }

    /**
     * Advance the order to the next status or cancel it.
     *
     * Workflow: pending → processing → shipped → delivered
     * Any non-terminal state can be cancelled.
     *
     * @param  Order    $order
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function updateStatus(Order $order, Request $request): RedirectResponse
    {
        $newStatus = OrderStatus::tryFrom($request->input('status'));

        if (!$newStatus) {
            return back()->with('error', 'Estado no válido.');
        }

        if ($newStatus === $order->status) {
            return back()->with('error', 'El pedido ya está en ese estado.');
        }

        // Prevent moving back from delivered
        if ($order->status === OrderStatus::Delivered) {
            return back()->with('error', 'No se puede modificar un pedido entregado.');
        }

        // Restore stock when cancelling
        if ($newStatus === OrderStatus::Cancelled) {
            $order->load('items.product');
            foreach ($order->items as $item) {
                $item->product->increment('stock', $item->quantity);
            }
        }

        $oldStatus = $order->status->value;
        $order->update(['status' => $newStatus]);

        return back()->with('success', "Pedido #{$order->id}: {$oldStatus} → {$newStatus->value}.");
    }

    /**
     * Display the current user's placed orders.
     *
     * @return View
     */
    public function customerOrders(): View
    {
        $orders = Auth::user()->orders()
            ->placed()
            ->withCount('items')
            ->latest()
            ->paginate(20);

        return view('pedidos.index', compact('orders'));
    }

    /**
     * Display a single order belonging to the current user.
     *
     * Aborts with 404 if the order does not belong to the authenticated user.
     *
     * @param  Order  $order
     * @return View
     */
    public function customerShow(Order $order): View
    {
        if ($order->user_id !== Auth::id()) {
            abort(404);
        }

        $order->load(['items.product']);

        return view('pedidos.show', compact('order'));
    }

    /**
     * Cancel a pending order belonging to the current user.
     *
     * Restores stock for all items. Only allowed when status is "pending".
     *
     * @param  Order  $order
     * @return RedirectResponse
     */
    public function customerCancel(Order $order): RedirectResponse
    {
        if ($order->user_id !== Auth::id()) {
            abort(404);
        }

        if ($order->status !== OrderStatus::Pending) {
            return back()->with('error', 'Solo se pueden cancelar pedidos pendientes.');
        }

        $order->load('items.product');

        foreach ($order->items as $item) {
            $item->product->increment('stock', $item->quantity);
        }

        $order->update(['status' => OrderStatus::Cancelled]);

        return redirect()->route('profile.edit')
            ->with('status', 'Pedido cancelado correctamente.');
    }
}
