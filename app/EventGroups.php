<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventGroups extends Model 
{

    protected $table = 'eventsGroups';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name', 'restriction');
    protected $visible = array('name', 'restriction');

    public function users()
    {
        return $this->belongsToMany('App\User', 'group_users', 'group_id', 'user_id');
    }

    public function events()
    {
        return $this->belongsToMany('App\Event', 'event_groups', 'group_id', 'event_id');
    }

}