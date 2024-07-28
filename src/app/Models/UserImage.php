<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * @property $image
*/
class UserImage extends Model
{
    use HasFactory;

    protected $table = 'user_images';

    protected $fillable = [
        'image',
    ];

    protected function imageUrl(): Attribute
    {
        return Attribute::make(
            get: fn(mixed $value, array $attributes) => Storage::url($attributes['image'])
        );
    }
}
