<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'cluster_id',
        'discountable_id',
        'discountable_type',
        'content',
    ];

    protected $casts = [
        'content' => 'object',
    ];

    public function discountable()
    {
        return $this->morphTo();
    }
}
