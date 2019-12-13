<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventLocation extends Model 
{

    protected $table = 'event_location';
    public $timestamps = false;
    protected $fillable = array('event_id', 'location_id');
    protected $visible = array('event_id', 'location_id');

}