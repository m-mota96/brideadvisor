<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'provider_id', 'city_id', 'address', 'postal_code','name_contact', 'email_contact', 'phone', 'cellphone', 'active', 
    ];

    public function city() {
        return $this->belongsTo(City::class);
    }
}
