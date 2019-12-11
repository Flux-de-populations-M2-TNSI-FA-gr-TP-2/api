<?php

namespace Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model 
{

    protected $table = 'events';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('event_name', 'event_start', 'event_end', 'event_status');
    protected $visible = array('event_name', 'event_start', 'event_end', 'event_status');

    public function users()
    {
        return $this->belongsToMany('Api\User', 'user_id');
    }

    public function locations()
    {
        return $this->belongsToMany('Api\Location', 'location_id');
    }

}