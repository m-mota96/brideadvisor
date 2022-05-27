<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function event() {
        return $this->hasOne(Event::class);
    }

    public function location() {
        return $this->belongsTo(Location::class);
    }
}
