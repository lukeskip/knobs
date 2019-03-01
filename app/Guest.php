<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    public function reviews()
	{
		return $this->belongsTo('App\Review','review_id');
	}
}
