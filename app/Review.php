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

	public function ratings()
	{
		return $this->hasOne('App\Rating');
	}

	public function comments()
	{
		return $this->hasMany('App\Comment');
	}

	public function admin_comments()
	{
		return $this->hasMany('App\AdminComment');
	}

	public function guests()
	{
		return $this->hasOne('App\Guest');
	}
}
