<?php

namespace App\Enums;

/**
 * States an order goes through during its lifecycle.
 */
enum OrderStatus: string
{
    /** Active shopping cart, not yet confirmed. */
    case Cart = 'cart';

    /** Order confirmed, awaiting shipment. */
    case Pending = 'pending';

    /** Order shipped to the customer. */
    case Shipped = 'shipped';

    /** Order delivered successfully. */
    case Delivered = 'delivered';

    /** Order cancelled. */
    case Cancelled = 'cancelled';

    /**
     * Human-readable Spanish label.
     */
    public function label(): string
    {
        return match ($this) {
            self::Cart => 'Carrito',
            self::Pending => 'Pendiente',
            self::Shipped => 'Enviado',
            self::Delivered => 'Entregado',
            self::Cancelled => 'Cancelado',
        };
    }
}
