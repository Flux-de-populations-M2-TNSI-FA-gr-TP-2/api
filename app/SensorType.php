<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SensorType extends Model 
{

    protected $table = 'sensor_types';
    public $timestamps = false;
    protected $fillable = array('sensor_id', 'type_id');
    protected $visible = array('sensor_id', 'type_id');

}