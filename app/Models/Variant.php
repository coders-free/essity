<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Variant extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'code',
        'image_url'
    ];

    public function image(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->image_url ? Storage::url($this->image_url) : asset('img/no-image.jpg'),
        );
    }

    //Relacion muchos a muchos
    public function features()
    {
        return $this->belongsToMany(Feature::class)
            ->withTimestamps();
    }

}
