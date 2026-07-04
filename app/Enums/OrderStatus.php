<?php

namespace App\Enums;

enum OrderStatus: string
{
    case Cart = 'cart';
    case Pending = 'pending';
    case Processing = 'processing';
    case Shipped = 'shipped';
    case Delivered = 'delivered';
    case Cancelled = 'cancelled';
}
