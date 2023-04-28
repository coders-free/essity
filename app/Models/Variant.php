<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Variant extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    //Mutadores y Accesores
    public function name(): Attribute
    {
        return Attribute::make(
            get: fn($value) => ucfirst($value),
            set: fn($value) => strtolower($value)
        );
    }

    public function features(){
        return $this->hasMany(Feature::class);
    }

    //Relacion muchos a muchos
    public function lines(){
        return $this->belongsToMany(Line::class)
                    ->withTimestamps();
    }
}
