<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sensor extends Model
{

    protected $table = 'sensors';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name', 'type', 'unity', 'token', 'room_id');
    protected $visible = array('id', 'name', 'type', 'unity', 'token', 'room_id');

    public function room()
    {
        return $this->belongsTo('App\Room', 'id');
    }

}
