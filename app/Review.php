<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public function users()
	{
		return $this->belongsTo('App\User','user_id');
	}

    public function songs()
	{
		return $this->belongsTo('App\Song','song_id');
	}

	public function payments()
	{
		return $this->hasOne('App\Payment');
	}

    public function scores()
	{
		return $this->hasMany('App\Score');
	}

	public function comments()
	{
		return $this->hasMany('App\Comment');
	}
}
