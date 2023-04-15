<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'cooperative_id',
        'nif',
        'message',
        'status',
        'content',
    ];

    protected $casts = [
        'content' => 'object',
    ];

    public function scopeFilter($query, $filters){

        $query->when($filters['order_id'] ?? false, function($query, $order_id){
            $query->where('id', $order_id);
        })->when($filters['status'] ?? false, function($query, $status){
            $query->where('status', $status);
        })->when($filters['from_date'] ?? false, function($query, $from_date){
            $query->where('created_at', '>=', $from_date);
        })->when($filters['to_date'] ?? false, function($query, $to_date){
            $query->where('created_at', '<=', $to_date);
        });

    }
}
