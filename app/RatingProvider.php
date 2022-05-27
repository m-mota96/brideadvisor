<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RatingProvider extends Model
{
    protected $fillable = [
        'provider_id', 'customer_id', 'price', 'quality', 'professionalism', 'attention', 'message', 
    ];

    public function customer() {
        return $this->belongsTo(Customer::class);
    }
}
