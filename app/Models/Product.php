<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'details',
        'image_url',
        'category_id',
        'free_sample'
    ];

    protected $casts = [
        'free_sample' => 'boolean',
    ];

    public function image(): Attribute
    {
        return Attribute::make(
            get: fn() => Storage::url($this->image_url),
        );
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //Relacion uno a muchos
    public function variants()
    {
        return $this->hasMany(Variant::class);
    }
}
