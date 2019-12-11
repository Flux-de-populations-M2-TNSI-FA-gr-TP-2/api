<?php

namespace Api;

use Illuminate\Database\Eloquent\Model;

class EventUser extends Model 
{

    protected $table = 'event_user';
    public $timestamps = false;
    protected $fillable = array('event_id', 'user_id');
    protected $visible = array('event_id', 'user_id');

}