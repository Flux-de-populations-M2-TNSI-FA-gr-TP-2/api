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
    protected $fillable = array('name', 'address');
    protected $visible = array('name', 'address');

    public function rooms()
    {
        return $this->hasMany('Room', 'location_id');
    }

    public function events()
    {
        return $this->belongsToMany('App\Event', 'event_id');
    }

    public function sensors()
    {
        return $this->hasManyThrough('App\Sensor', 'App\Room');
    }

}