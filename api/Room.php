<?php

namespace Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model 
{

    protected $table = 'rooms';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('room_name', 'room_floor', 'location_id');
    protected $visible = array('room_name', 'room_floor', 'location_id');

    public function location()
    {
        return $this->belongsTo('Api\Location', 'location_id');
    }

}