<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class Sensor extends Model
{

  protected $table = 'sensors';
  public $timestamps = true;

  use SoftDeletes;

  protected $dates = ['deleted_at'];
  protected $fillable = array('name', 'type', 'token', 'room_id', 'url');
  protected $visible = array('id','name', 'type', 'token', 'room_id', 'url');

  protected $access_token;

  public function __construct()
  {
    $this->access_token = env('SENSOR_TOKEN', null);
  }

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
    $data['infos'] = $this->infos;
    return $data;
  }

  public function getInfosAttribute()
  {
    $client = new Client();
    $headers = [
      'Authorization' => 'Bearer '.$this->access_token,
      'Accept'        => 'application/json',
    ];
    try {
      $res = $client->request('GET', $this->url, [
        'headers' => $headers
      ]);
      if ($res->getStatusCode() == 200) {
        $response = json_decode($res->getBody()->getContents());
        return $response;
      }
    } catch (RequestException $e) {
      return null;
    }
  }
}
