<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo('App\Role');
    } 

    public function roles()
    {
        // to costumize table names and columns followe the format below
        //return $this->belongsToMany('App\Role', 'user_roles', 'user_id', 'role_id');
        
        return $this->belongsToMany('App\Role')->withPivot(['created_at', 'updated_at']);

    } 

    public function isAdmin()
    {
        if ($this->role->name == 'administrator') {
            return true;
        }

        return false;
    }

    public function post()
    {
        return $this->hasOne('App\Post');
    }

    public function posts()
    {
        return $this->hasMany('App\Post');
    }

}
