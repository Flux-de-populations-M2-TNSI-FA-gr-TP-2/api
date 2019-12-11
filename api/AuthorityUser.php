<?php

namespace Api;

use Illuminate\Database\Eloquent\Model;

class AuthorityUser extends Model 
{

    protected $table = 'authority_user';
    public $timestamps = false;
    protected $fillable = array('authority_id', 'user_id');
    protected $visible = array('authority_id', 'user_id');

}