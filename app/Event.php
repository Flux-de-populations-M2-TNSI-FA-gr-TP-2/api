<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model 
{

    protected $table = 'events';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name', 'start', 'end', 'status');
    protected $visible = array('name', 'start', 'end', 'status');

    public function users()
    {
        return $this->belongsToMany('App\User', 'user_id');
    }

    public function locations()
    {
        return $this->belongsToMany('App\Location', 'location_id');
    }

}