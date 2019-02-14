<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function accounts(){
        return $this->hasMany('App\LinkedSocialAccount');
    }

    public function profiles()
    {
        return $this->hasOne('App\Profile');
    }

    public function reviews()
    {
        return $this->hasMany('App\Review');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    public function songs()
    {
        return $this->hasMany('App\Song');
    }

    public function comments()
    {
        return $this->hasMany('App\Song');
    }

    public function scores()
    {
        return $this->hasMany('App\Score');
    }

    public function payments()
    {
        return $this->hasMany('App\Payment');
    }
}
