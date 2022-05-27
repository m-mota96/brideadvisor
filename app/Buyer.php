<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    protected $fillable = [
        'payment_id', 'folio', 'name', 'email', 'phone', 'date_event', 'hour', 'birthdate', 'age', 'sex', 'size','category', 'saturday_entry', 'sunday_entry'
    ];
}
