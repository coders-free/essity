<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class DigitalMaterial extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image_url', // 'image_url' is the name of the column in the database
        'path',
    ];

    //Mutators
    public function image(): Attribute
    {
        return Attribute::make(
            get: fn() => Storage::url($this->image_url),
        );
    }
}
