<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'code'
    ];

    //Relacion muchos a muchos
    public function features()
    {
        return $this->belongsToMany(Feature::class)
            ->withTimestamps();
    }

}
