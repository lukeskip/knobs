<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function reviews()
    {
        return $this->belongsTo('App\Review');
    }

    public function scores()
    {
        return $this->hasMany('App\Score');
    }
}
