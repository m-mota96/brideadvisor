<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $fillable = ['name', 'quantity'];

    public function invitation()
    {
        return $this->hasMany('App\Invitation');
    }
}
