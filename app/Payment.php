<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'event_id', 'provider_id', 'reference', 'email', 'amount', 'coupon', 'status', 
    ];
}
