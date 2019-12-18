<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{

    protected $table = 'rooms';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name', 'floor', 'location_id');
    protected $visible = array('id', 'name', 'floor', 'location_id');

    public function location()
    {
        return $this->belongsTo('App\Location', 'location_id');
    }

    public function sensors()
    {
        return $this->hasMany('App\Sensor');
    }

}
