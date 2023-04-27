<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Line extends Model
{

    use HasFactory;

    protected $fillable = [
        'name',
        'image_url',
    ];

    //Mutadores y Accesores

    public function image(): Attribute
    {
        return Attribute::make(
            get: fn() => Storage::url($this->image_url),
        );
    }

    public function name(): Attribute
    {
        return Attribute::make(
            get: fn($value) => ucfirst($value),
            set: fn($value) => strtolower($value)
        );
    }


    //Relacion uno a muchos
    public function categories(){
        return $this->hasMany(Category::class);
    }

    //Relacion muchos a muchos
    public function variants(){
        return $this->belongsToMany(Variant::class)
            ->withTimestamps();
    }
}
