<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    public $directory = "/images/";
    //
    protected $fillable = ['nome','organizacao','telefone','email','grupo','endereco','path'];


    public function getPathAttribute($value)
    {
    	return $this->directory . $value;
    }
    
}
