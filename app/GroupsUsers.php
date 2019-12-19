<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupsUsers extends Model 
{

    protected $table = 'group_users';
    public $timestamps = false;
    protected $fillable = array('group_id', 'user_id');
    protected $visible = array('group_id', 'user_id');

}