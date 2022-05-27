<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'name'
    ];

    public $timestamps = false;

    public function customers()
    {
        return $this->belongsToMany('App\Customer');
    }
}
