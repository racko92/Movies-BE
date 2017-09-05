<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{

    public function getGenresAttribute($value){

        return json_dencode($value, true);
    }

    public function setGenresAttribute($value){
        $this->attributes['genres'] = json_encode($value);
    }
}
