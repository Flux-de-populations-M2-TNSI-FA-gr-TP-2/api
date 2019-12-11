<?php

namespace Api;

use Illuminate\Database\Eloquent\Model;

class Authority extends Model 
{

    protected $table = 'authorities';
    public $timestamps = false;
    protected $fillable = array('id', 'name');
    protected $visible = array('id', 'name');

    public function users()
    {
        return $this->belongsToMany('Api\User', 'user_id');
    }

}