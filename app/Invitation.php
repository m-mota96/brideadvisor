<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    protected $fillable = ['firstname', 'lastname', 'email', 'cellphone', 'wedding_id', 'status'];
    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('firstname', 'like', '%'.$query.'%')
                ->orWhere('id', 'like', '%'.$query.'%');
    }

    public function group()
    {
        return $this->belongsTo('App\Group');
    }
    public function table()
    {
        return $this->belongsTo('App\Table');
    }
}
