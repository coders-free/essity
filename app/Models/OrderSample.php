<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderSample extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nif',
        'message',
        'content',
    ];

    protected $casts = [
        'content' => 'object',
    ];

    //Relacion uno a muchos inversa
    public function user(){
        return $this->belongsTo(User::class);
    }
}
