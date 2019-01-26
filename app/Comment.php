<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function reviews()
    {
        return $this->belongsTo('App\Review');
    }

    public function users()
    {
        return $this->belongsTo('App\User');
    }
}
