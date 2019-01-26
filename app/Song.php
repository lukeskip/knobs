<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
	public function reviews()
	{
		return $this->hasMany('App\Review');
	}

	public function users()
	{
		return $this->belongsTo('App\User');
	}
}
