<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    public $directory = "/images/";
    //
    protected $fillable = ['nome','organizacao','email','grupo','endereco','path'];
    //protected $fillable = ['nome','organizacao','email','grupo','endereco'];


    public function getPathAttribute($value)
    {
    	return $this->directory . $value;
    }

    public function telefones()
    {
    	return $this->hasMany('App\Telefone');
    }
    
}
