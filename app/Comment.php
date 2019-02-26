<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function reviews()
    {
        return $this->belongsTo('App\Review','review_id');
    }

    public function users()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
