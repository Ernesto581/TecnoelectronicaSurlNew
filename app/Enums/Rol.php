<?php

namespace App\Enums;

/**
 * Roles available for system users.
 */
enum Rol: string
{
    /** Administrator with access to the management panel. */
    case Admin = 'admin';

    /** Customer who purchases from the store. */
    case Customer = 'customer';

    /**
     * Human-readable Spanish label.
     */
    public function label(): string
    {
        return match ($this) {
            self::Admin => 'Administrador',
            self::Customer => 'Cliente',
        };
    }
}
