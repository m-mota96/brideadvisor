<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GalleryProvider extends Model
{
    protected $fillable = [
        'provider_id', 'name_image', 'type'
    ];

    function provider() {
        return $this->belongsTo(Provider::class);
    }
}
