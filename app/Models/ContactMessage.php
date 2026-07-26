<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * A contact inquiry submitted through the website.
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $message
 * @property bool $is_resolved
 */
class ContactMessage extends Model
{
    protected $fillable = ['name', 'email', 'message'];

    protected function casts(): array
    {
        return [
            'is_resolved' => 'boolean',
        ];
    }
}
