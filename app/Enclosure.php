<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enclosure extends Model
{
    protected $fillable = [
        'name', 'address', 'description', 'map', 'image', 'logo', 
    ];

    public function event() {
        return $this->hasOne(Event::class);
    }
}
