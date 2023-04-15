<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Webinar extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'video_url',
    ];

    //Mutadores y accesores
    protected function video():Attribute
    {
        return new Attribute(
            get: function() {

                $url = $this->video_url;
                $regex = '%^(?:https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/embed/|/v/|/watch\?v=))([\w-]{10,12})$%x';
                
                if (preg_match($regex, $url, $matches)) {
                    return $matches[1];
                }

                return $this->video_url;

            },
        );
    }
}
