<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupLocation extends Model 
{

    protected $table = 'group_location';
    public $timestamps = false;
    protected $fillable = array('group_id', 'location_id');
    protected $visible = array('group_id', 'location_id');

}