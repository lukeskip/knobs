<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public function users()
	{
		return $this->belongsTo('App\User');
	}

    public function songs()
	{
		return $this->belongsTo('App\Song');
	}

    public function score()
	{
		return $this->hasOne('App\Score');
	}

	public function comments()
	{
		return $this->hasMany('App\Comment');
	}
}
