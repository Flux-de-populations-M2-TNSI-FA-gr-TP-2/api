<?php

namespace Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('user_firstname', 'user_lastname', 'user_email', 'user_password', 'user_birthdate');
    protected $visible = array('user_firstname', 'user_lastname', 'user_email', 'user_birthdate');
    protected $hidden = array('user_password');

    public function events()
    {
        return $this->belongsToMany('Api\Event', 'event_id');
    }

    public function authority()
    {
        return $this->belongsToMany('Api\Authority', 'authority_id');
    }

}
