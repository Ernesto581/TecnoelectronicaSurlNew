<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
        $action = $request->input('action');

        // Advance to the next status
        if ($action === 'advance') {
            $next = match ($order->status) {
                OrderStatus::Pending => OrderStatus::Processing,
                OrderStatus::Processing => OrderStatus::Shipped,
                OrderStatus::Shipped => OrderStatus::Delivered,
                default => null,
            };

            if (!$next) {
                return back()->with('error', 'No se puede avanzar este pedido.');
            }

            $order->update(['status' => $next]);
            return back()->with('success', "Pedido #{$order->id} actualizado a {$next->value}.");
        }

        // Cancel the order and restore stock
        if ($action === 'cancel') {
            if ($order->status === OrderStatus::Delivered || $order->status === OrderStatus::Cart) {
                return back()->with('error', 'No se puede cancelar este pedido.');
            }

            // Restore product stock
            foreach ($order->items as $item) {
                $item->product->increment('stock', $item->quantity);
            }

            $order->update(['status' => OrderStatus::Cancelled]);
            return back()->with('success', "Pedido #{$order->id} cancelado. Stock restaurado.");
        }

        return back()->with('error', 'Acción no válida.');
    }
}
