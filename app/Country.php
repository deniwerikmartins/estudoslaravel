<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    //
    
    public function posts()
    {
    	return $this->hasManyThrough('App\Post', 'App\User');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
