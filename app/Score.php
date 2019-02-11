<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{

    protected $fillable = [
        'score'
    ];

	public function reviews()
    {
        return $this->belongsTo('App\Review');
    }

    public function users()
    {
        return $this->belongsTo('App\User');
    }

    public function categories()
    {
        return $this->belongsTo('App\Category','category_id');
    }
    
}
