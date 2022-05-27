<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable = [
        'provider_id', 'category_provider_id', 'name', 'description','price_initial', 'price_final', 'expiration', 'addresses', 
    ];

    public function provider() {
        return $this->belongsTo(Provider::class);
    }

    public function category() {
        return $this->belongsTo(CategoryProvider::class);
    }

    public function gallery() {
        return $this->hasMany(GalleryPromotion::class);
    }
}
