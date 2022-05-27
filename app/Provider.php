<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $fillable = [
        'user_id', 'category_id', 'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function location() {
        return $this->hasMany(Location::class)->where('active', 1);
    }

    public function category() {
        return $this->belongsTo(CategoryProvider::class);
    }

    public function event() {
        return $this->belongsToMany(Event::class)->withPivot('id', 'quantity_staff', 'staff_completed', 'email');
    }

    public function profile() {
        return $this->hasOne(GalleryProvider::class)->where('profile', 1);
    }

    public function gallery() {
        return $this->hasMany(GalleryProvider::class);
    }

    public function rating() {
        return $this->hasMany(RatingProvider::class)->where('active', 1);
    }

    public function statistic() {
        return $this->hasMany(StatisticProvider::class);
    }

    public function promotion() {
        return $this->hasMany(Promotion::class);
    }

    public function attention() {
        return $this->hasOne(AttentionSchedule::class);
    }
}
