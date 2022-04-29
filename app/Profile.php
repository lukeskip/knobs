<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    public function users()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function getImageUrlAttribute(){
        return env('APP_URL').'/storage/profile_images/'.$this->picture;
    }
}
