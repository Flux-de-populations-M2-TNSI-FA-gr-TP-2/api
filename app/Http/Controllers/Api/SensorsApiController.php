<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Request;
use App\Http\Resources\Users as UserCollection;
use JWTAuth;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use App\Sensor;

class SensorsApiController extends Controller
{
  private $access_token = "eyJhbGciOiJFUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6Ijk3ODk4ZWU1LWM1MzAtNGFmZC1iODM2LWEwNWQ5YjNlZGI0YyJ9.eyJjbGllbnRfaWQiOiJsb2NhbC10b2tlbiIsInJvbGUiOiJhY2Nlc3NfdG9rZW4iLCJzY29wZSI6Ii90aGluZ3M6cmVhZHdyaXRlIiwiaWF0IjoxNTc2MTY5MTI1LCJpc3MiOiJodHRwczovL3BpLXNlbnNvcnMubW96aWxsYS1pb3Qub3JnIn0.KolFPDYOWutwMh4qth4DccBasTi3zVd1cMh4_kKAnJRS1JZmpfRW52HXcok8NubpOu-hqM5qEOxYkXkRxMfjCQ";

  /**
  * List all users
  *
  * @return Response
  */
  public function index()
  {
    $client = new Client();
    $headers = [
      'Authorization' => 'Bearer '.$this->access_token,
      'Accept'        => 'application/json',
    ];
    try {
      $res = $client->request('GET', 'https://pi-sensors.mozilla-iot.org/things', [
        'headers' => $headers
      ]);
      if ($res->getStatusCode() == 200) {
        $sensors = json_decode($res->getBody()->getContents());
        foreach ($sensors as $sensorApi) {
          $type = "@type";
          $link = "https://pi-sensors.mozilla-iot.org".$sensorApi->links[0]->href;
          // $sensor = Sensor::create(array('name' => $sensorApi->title, 'type' => $sensorApi->$type[0], 'token' => $sensorApi->title));
          if (in_array("TemperatureSensor", $sensorApi->$type)) {
            // code...
            $req = $client->request('GET', $link, [
              'headers' => $headers
            ]);
            return response()->json(json_decode($req->getBody()->getContents()));
          }
        }
        return response()->json([
          "success" => true,
          "data" => $links
        ], 200);
      }
    } catch (RequestException $e) {
      return response()->json([
        "success" => false,
        "data" => null,
        "message" => "Aucune information n'est disponible actuellement."
      ], 200);
    }

  }
}
