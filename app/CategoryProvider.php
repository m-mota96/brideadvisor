<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryProvider extends Model
{
    public function customers()
    {
        return $this->belongsToMany('App\Customer', 'category_customer', 'category_id', 'customer_id');
    }

    public function promotion() {
        return $this->hasMany(Promotion::class);
    }
}
