<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatisticProvider extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'provider_id', 'type', 'quantity', 'created_at', 
    ];

    public function provider() {
        return $this->belongsTo(Provider::class);
    }
}
