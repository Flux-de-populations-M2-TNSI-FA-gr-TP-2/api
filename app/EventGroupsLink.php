<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventGroupsLink extends Model 
{

    protected $table = 'event_groups';
    public $timestamps = false;
    protected $fillable = array('event_id', 'group_id');
    protected $visible = array('event_id', 'group_id');

}