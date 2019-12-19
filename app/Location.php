<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{

    protected $table = 'locations';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name', 'address', 'image');
    protected $visible = array('id', 'name', 'address', 'image');

    public function rooms()
    {
        return $this->hasMany('App\Room', 'location_id');
    }

    public function groups()
    {
        return $this->belongsToMany('App\EventGroups', 'group_location', 'location_id', 'group_id');
    }

    public function sensors()
    {
        return $this->hasManyThrough('App\Sensor', 'App\Room');
    }

    public function logs()
    {
        return $this->hasMany('App\DbLog', 'location_id');
    }

    public function toArray() {
        $data = parent::toArray();
        $data['rooms'] = $this->rooms;
        $events = array();
        foreach ($this->groups as $eventGroup) {
          // dd($eventGroup);
          $events[] = $eventGroup->events;
        }
        $data['events'] = $events;
        return $data;
    }

}
