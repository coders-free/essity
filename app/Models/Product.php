<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'details',
        'image_url',
        'category_id',
        'free_sample',
        'plv_material'
    ];

    protected $casts = [
        'free_sample' => 'boolean',
    ];

    //Mutators
    public function image(): Attribute
    {
        return Attribute::make(
            get: fn() => Storage::url($this->image_url),
        );
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    //Query scopes
    public function scopePublishedVariants($query)
    {
        $query->whereDoesntHave('variants', function ($query){

            $query->where(function($query){
                $query->whereNull('code')
                    ->orWhereNull('image_url');
            });

        });
    }

    //Relacion uno a muchos
    public function variants()
    {
        return $this->hasMany(Variant::class);
    }

    public function specifications()
    {
        return $this->hasMany(Specification::class);
    }

    //Relacion muchos a muchos
    public function options()
    {
        return $this->belongsToMany(Option::class)
            ->using(OptionProduct::class)
            ->withPivot('features')
            ->withTimestamps()
            ->orderByPivot('created_at', 'asc');;
    }
}
