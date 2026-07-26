<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * Handles shopping cart operations and checkout flow.
 *
 * A cart is an Order with status "cart". Items are OrderItem records.
 * Stock is only deducted on checkout, not when adding to cart.
 */
class CartController extends Controller
{
    /**
     * Display the current user's cart with its items.
     *
     * @return View
     */
    public function index(): View
    {
        $cart = $this->getOrCreateCart();
        $cart->load('items.product');

        return view('pages.cart', compact('cart'));
    }

    /**
     * Add a product to the cart.
     *
     * If the product is already in the cart, the quantity is incremented.
     *
     * @param  Product  $product
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function add(Product $product, Request $request): RedirectResponse
    {
        if (!config('app.cart_enabled', true)) {
            return back()->with('cart_error', 'Las compras estarán disponibles próximamente.');
        }

        $quantity = max(1, (int) $request->input('quantity', 1));

        if ($product->stock <= 0) {
            return back()->with('cart_error', 'Este producto está agotado.');
        }

        if ($quantity > $product->stock) {
            return back()->with('cart_error', "Solo quedan {$product->stock} unidades disponibles.");
        }

        $cart = $this->getOrCreateCart();

        $existingItem = $cart->items()->where('product_id', $product->id)->first();

        if ($existingItem) {
            $newQuantity = $existingItem->quantity + $quantity;

            if ($newQuantity > $product->stock) {
                return back()->with('cart_error', "Ya tienes {$existingItem->quantity} en el carrito. Solo quedan {$product->stock} en total.");
            }

            $existingItem->update([
                'quantity' => $newQuantity,
                'subtotal' => $product->price * $newQuantity,
            ]);
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => $quantity,
                'unit_price' => $product->price,
                'subtotal' => $product->price * $quantity,
            ]);
        }

        $cart->recalculateTotals();

        return back()->with('cart_success', "{$product->name} añadido al carrito.");
    }

    /**
     * Update the quantity of a cart item.
     *
     * @param  OrderItem  $item
     * @param  Request    $request
     * @return RedirectResponse
     */
    public function update(OrderItem $item, Request $request): RedirectResponse
    {
        if (!config('app.cart_enabled', true)) {
            return back()->with('cart_error', 'Las compras estarán disponibles próximamente.');
        }

        $quantity = max(1, (int) $request->input('quantity', 1));
        $product = $item->product;

        if ($quantity > $product->stock) {
            return back()->with('cart_error', "Solo quedan {$product->stock} unidades de {$product->name}.");
        }

        $item->update([
            'quantity' => $quantity,
            'subtotal' => $item->unit_price * $quantity,
        ]);

        $item->order->recalculateTotals();

        return back()->with('cart_success', 'Carrito actualizado.');
    }

    /**
     * Remove an item from the cart.
     *
     * If the cart becomes empty, the order is deleted.
     *
     * @param  OrderItem  $item
     * @return RedirectResponse
     */
    public function destroy(OrderItem $item): RedirectResponse
    {
        $order = $item->order;

        $item->delete();

        if ($order->items()->count() === 0) {
            $order->delete();
        } else {
            $order->recalculateTotals();
        }

        return back()->with('cart_success', 'Producto eliminado del carrito.');
    }

    /**
     * Convert the cart into a placed order (cart → pending).
     *
     * Deducts stock for each item. If any product has insufficient stock,
     * the operation is aborted and the user is notified.
     *
     * @return RedirectResponse
     */
    public function checkout(): RedirectResponse
    {
        if (!config('app.cart_enabled', true)) {
            return redirect()->route('cart.index')->with('cart_error', 'Las compras estarán disponibles próximamente.');
        }

        $cart = Auth::user()->cart();

        if (!$cart || $cart->items()->count() === 0) {
            return redirect()->route('cart.index')->with('cart_error', 'El carrito está vacío.');
        }

        $cart->load('items.product');

        // Verify stock for all items
        $insufficientStock = [];
        foreach ($cart->items as $item) {
            if ($item->quantity > $item->product->stock) {
                $insufficientStock[] = $item->product->name;
            }
        }

        if (!empty($insufficientStock)) {
            return back()->with(
                'cart_error',
                'Stock insuficiente para: ' . implode(', ', $insufficientStock) . '. Revisa las cantidades.'
            );
        }

        // Deduct stock and place order
        foreach ($cart->items as $item) {
            $item->product->decrement('stock', $item->quantity);
        }

        $cart->update(['status' => OrderStatus::Pending]);

        return redirect()->route('cart.index')
            ->with('cart_success', '¡Pedido confirmado! Te contactaremos pronto.');
    }

    /**
     * Get the current user's active cart, or create a new one.
     *
     * @return Order
     */
    private function getOrCreateCart(): Order
    {
        $cart = Auth::user()->cart();

        if (!$cart) {
            $cart = Order::create([
                'user_id' => Auth::id(),
                'status' => OrderStatus::Cart,
                'subtotal' => 0,
                'total' => 0,
            ]);
        }

        return $cart;
    }
}
