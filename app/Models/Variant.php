<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    //Relacion uno a muchos
    /* public function attributes(){
        return $this->hasMany(Attribute::class);
    } */

    public function features(){
        return $this->hasMany(Feature::class);
    }

    //Relacion muchos a muchos
    public function lines(){
        return $this->belongsToMany(Line::class)
                    ->withTimestamps();
    }
}
