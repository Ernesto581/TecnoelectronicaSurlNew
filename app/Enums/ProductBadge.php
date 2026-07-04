<?php

namespace App\Enums;

/**
 * Visual labels to highlight products in the store.
 */
enum ProductBadge: string
{
    /** Recently added to the catalog. */
    case New_ = 'Nuevo';

    /** Product with a temporary discount. */
    case Offer = 'Oferta';

    /** Featured on the home page. */
    case Featured = 'Destacado';

    /** Out of stock. */
    case SoldOut = 'Agotado';
}
