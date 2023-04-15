<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pharmacy_name',
        'address',
        'cp',
        'town_id',
        'province_id',
        'phone',
        'nif_1',
        'nif_2',
        'sap_number',
        'cmr_number',
        'account_type',
        'cluster_id',
        'delegate_id',
        'geographic_area_id',
        'max_orders_per_month',
        'unlimited',
        'sales_org',
    ];

    public function province(){
        return $this->belongsTo(Province::class);
    }

    public function town(){
        return $this->belongsTo(Town::class);
    }

}
