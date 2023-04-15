<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'line_id',
        'maximum_orders'
    ];

    //Relacion uno a muchos
    public function products(){
        return $this->hasMany(Product::class);
    }

    //Relacion uno a muchos inversa
    public function line(){
        return $this->belongsTo(Line::class);
    }

}
