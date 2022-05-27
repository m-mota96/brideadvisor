<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Auth;


class User extends Authenticatable implements MustVerifyEmail{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'email_verified_at', 'password','role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function category()
    {
        return $this->hasOne('App\Provider');
    }

    public function customer()
    {
        return $this->hasOne('App\Customer');
    }

    public function hasRole()
    {
        $role_id = Auth::user()->role_id;
        return Role::find($role_id)->name;
    }

    public function provider() {
        return $this->hasOne(Provider::class);
    }
}
