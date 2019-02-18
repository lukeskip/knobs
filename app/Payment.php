<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

	protected $fillable = [
        'status',
    ];

    public function songs()
	{
		return $this->belongsTo('App\Song','song_id');
	}

	public function reviews()
	{
		return $this->belongsTo('App\Review','review_id');
	}

	public function users()
	{
		return $this->belongsTo('App\User','user_id');
	}
}
