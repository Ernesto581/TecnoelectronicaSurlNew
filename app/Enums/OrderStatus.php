<?php

namespace App\Enums;

/**
 * States an order goes through during its lifecycle.
 */
enum OrderStatus: string
{
    /** Active shopping cart, not yet confirmed. */
    case Cart = 'cart';

    /** Order confirmed, pending processing. */
    case Pending = 'pending';

    /** Order being prepared. */
    case Processing = 'processing';

    /** Order shipped to the customer. */
    case Shipped = 'shipped';

    /** Order delivered successfully. */
    case Delivered = 'delivered';

    /** Order cancelled. */
    case Cancelled = 'cancelled';
}
