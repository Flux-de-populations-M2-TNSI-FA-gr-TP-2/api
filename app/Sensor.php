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
    protected $fillable = array('name', 'type', 'token', 'room_id', 'url');
    protected $visible = array('name', 'type', 'token', 'room_id', 'url');

    // public $appends = ['infos'];
    //
    // public function getInfosAttribute(){
    //   return $this->UserAdvertisementView->sum('total_view');
    // }

    public function room()
    {
        return $this->belongsTo('App\Room', 'id');
    }

    public function types()
    {
        return $this->belongsToMany('App\Type', 'sensor_types', 'sensor_id', 'type_id');
    }

    public function toArray() {
        $data = parent::toArray();
        $data['types'] = $this->types;
        return $data;
    }
}
