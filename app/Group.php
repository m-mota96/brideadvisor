<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('name', 'like', '%'.$query.'%');
    }
    public function invitation()
    {
        return $this->belongsTo('App\Invitation');
    }
}
