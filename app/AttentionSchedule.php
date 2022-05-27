<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttentionSchedule extends Model
{
    protected $fillable = [
        'provider_id', 'days', 'schedules', 
    ];
}
