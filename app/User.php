<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{

    protected $table = 'users';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('firstname', 'lastname', 'email', 'password', 'birthdate', 'role');
    protected $visible = array('firstname', 'lastname', 'email', 'birthdate', 'role');
    protected $hidden = array('password');

    public function eventsSubscription()
    {
        return $this->belongsToMany('App\EventGroups', 'group_users', 'user_id', 'group_id');
    }
	
	/**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Return admin state
     *
     * @return boolean
     */
    public function isAdmin()
    {
        if ($this->role === 'admin') {
          return true;
        }
        return false;
    }
}