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
use App\Type;

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
          $sensor = Sensor::firstOrCreate(array('name' => $sensorApi->title, 'token' => $sensorApi->title, 'url' => $link ));
          $stypes = array();
          foreach ($sensorApi->$type as $sensorType) {
            switch ($sensorType) {
              case 'TemperatureSensor':
                $unity = "°C";
                break;

              default:
                $unity = null;
                break;
            }
            $stypes[] = Type::firstOrCreate(array('name' => $sensorType, 'unity' => $unity))->id;
          }
          $sensor->types()->sync($stypes);
        }
        return response()->json([
          "success" => true,
          "data" => Sensor::get()
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

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return Response
  */
  public function show(Sensor $sensor)
  {
    $client = new Client();
    $headers = [
      'Authorization' => 'Bearer '.$this->access_token,
      'Accept'        => 'application/json',
    ];
    try {
      $res = $client->request('GET', $sensor->url, [
        'headers' => $headers
      ]);
      if ($res->getStatusCode() == 200) {
        $response = json_decode($res->getBody()->getContents());
        return response()->json([
          'success' => true,
          'data' => $sensor
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

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request, Sensor $sensor)
  {
    $sensor->update($request->all());

    return response()->json([
      'success' => true,
      'data' => $sensor,
      'message' => "Capteur modifié"
    ], 200);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy(Sensor $sensor)
  {
    $sensor->delete();

    return response()->json([
      'success' => true,
      'message' => 'Capteur supprimé'
    ], 204);
  }
}
