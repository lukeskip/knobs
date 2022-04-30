<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Profile extends Model
{
    public function users()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function getImageUrlAttribute(){
        return env('APP_URL').'/storage/profile_images/'.$this->picture;
    }

    public function getSummaryLimitedAttribute(){
        return Str::words($this->summary,10).' ...';
    }

    public function getExperticeAttribute($value)
    {
        switch($value){
            case 'musician': 
                return $this->attributes['expertice'] = "Músico";
                break;
            case 'producer': 
                return $this->attributes['expertice'] = "Productor";
                break;
            case 'composer': 
                return $this->attributes['expertice'] = "Compositor";
                break;
            default: 
                return $this->attributes['expertice'] = "Hola";
        }
        
    }

    public function getPricingAttribute($value)
    {
        return $this->attributes['pricing'] = $value + ($value * get_option('comission'));
    }


    
}
