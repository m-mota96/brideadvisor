<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Wedding extends Model
{
    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }
    protected $fillable = [
        'date', 'customer_id', 'place','budget','wedding_date'
    ];

    function diff($wedding_date)
    {
            $date = new Carbon($wedding_date);
            $date->locale('es_ES');
            $now = Carbon::now();
            return $date->diffInDays($now);
    }

}
