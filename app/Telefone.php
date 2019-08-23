<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telefone extends Model
{
    //
    //
    public function contato()
    {
    	return $this->belongsTo('App\Contato');
    }
}
