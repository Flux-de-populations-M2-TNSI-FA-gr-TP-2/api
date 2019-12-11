<?php

namespace Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model 
{

    protected $table = 'locations';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('location_name', 'location_address');
    protected $visible = array('location_name', 'location_address');

    public function rooms()
    {
        return $this->hasMany('Room', 'location_id');
    }

    public function events()
    {
        return $this->belongsToMany('Api\Event', 'event_id');
    }

}