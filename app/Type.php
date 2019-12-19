<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type extends Model 
{

    protected $table = 'types';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name', 'unity');
    protected $visible = array('name', 'unity');

    public function sensors()
    {
        return $this->belongsToMany('App\Sensor', 'sensor_types', 'type_id', 'sensor_id');
    }

}