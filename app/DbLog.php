<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DbLog extends Model 
{

    protected $table = 'logs';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('data', 'name', 'location_id');
    protected $visible = array('data', 'name', 'location_id');

    public function locations()
    {
        return $this->belongsTo('App\Location');
    }

}