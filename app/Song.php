<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
	public function reviews()
	{
		return $this->hasOne('App\Review','song_id');
	}

	public function users()
	{
		return $this->belongsTo('App\User','user_id');
	}

	public function payments()
	{
		return $this->hasOne('App\Payment');
	}

	public function profiles()
	{
		return $this->belongsTo('App\Profile','profile_id');
	}
}
