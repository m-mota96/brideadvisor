<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GalleryPromotion extends Model
{
    protected $fillable = [
        'promotion_id', 'name', 
    ];

    public $timestamps = false;
}
