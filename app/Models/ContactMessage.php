<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
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
    use HasFactory;
    protected $fillable = ['name', 'email', 'message', 'is_resolved'];

    protected function casts(): array
    {
        return [
            'is_resolved' => 'boolean',
        ];
    }
}
