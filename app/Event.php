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
  protected $visible = array('id', 'name', 'start', 'end', 'status');

  public function groups()
  {
    return $this->belongsToMany('App\EventGroups', 'event_groups', 'event_id', 'group_id');
  }

  public function toArray() {
    // get the original array to be displayed
    $data = parent::toArray();
    $data['event_groups'] = $this->groups;
    return $data;
  }

}
