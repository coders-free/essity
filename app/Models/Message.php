<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        "pharmacy_name",
        "address",
        "postal_code",
        "city",
        "province",
        "phone",
        "nif_1",
        "nif_2",
        "name",
        "last_name",
        "email",
        "body",
    ];
}
