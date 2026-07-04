<?php

namespace App\Enums;

enum ProductBadge: string
{
    case New_ = 'Nuevo';
    case Offer = 'Oferta';
    case Featured = 'Destacado';
    case SoldOut = 'Agotado';
}
