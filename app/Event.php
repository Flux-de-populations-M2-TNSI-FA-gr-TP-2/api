<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model 
{

    protected $table = 'events';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name', 'start', 'end', 'status');
    protected $visible = array('name', 'start', 'end', 'status');

    public function groups()
    {
        return $this->belongsToMany('App\EventGroups', 'event_groups', 'event_id', 'group_id');
    }

    public function locations()
    {
        return $this->belongsToMany('App\Location', 'event_location', 'event_id', 'location_id');
    }

}