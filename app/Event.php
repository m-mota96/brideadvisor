<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'city_id', 'event_type_id', 'enclosure_id', 'name', 'organized_by', 'active', 'initial_date', 'final_date', 'entry_sat', 'entry_sun', 'ticket_price', 'img_pdf', 'img_mail', 
    ];

    public function event_type() {
        return $this->belongsTo(EventType::class);
    }
    public function enclosure() {
        return $this->belongsTo(Enclosure::class);
    }
    public function city() {
        return $this->belongsTo(City::class)->orderBy('city');
    }
    public function activitie() {
        return $this->hasMany(Activitie::class)->where('status', 1);
    }
    public function provider() {
        return $this->belongsToMany(Provider::class)->withPivot('id', 'quantity_staff', 'staff_completed', 'email');
    }
}
