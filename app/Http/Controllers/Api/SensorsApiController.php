<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Request;
use App\Http\Resources\Users as UserCollection;
use JWTAuth;
use GuzzleHttp\Client;

class SensorsApiController extends Controller
{
  private $access_token = "eyJhbGciOiJFUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6IjU1ODJlZmZiLWNiNDMtNDdlNC05NDA3LWIxZThlOTYzMmU2ZSJ9.eyJjbGllbnRfaWQiOiJsb2NhbC10b2tlbiIsInJvbGUiOiJhY2Nlc3NfdG9rZW4iLCJzY29wZSI6Ii90aGluZ3M6cmVhZHdyaXRlIiwiaWF0IjoxNTc2MTM5MzAzLCJpc3MiOiJodHRwczovL3BpLXNlbnNvcnMubW96aWxsYS1pb3Qub3JnIn0.iP41jAwSKyTUW6ectYFPTdjmrbmxU5nUxKMdXH33EpRS9TGqr89xR40_-DdISqFKxgTLu2cn4II8pk3BSP0MwQ";
  /**
  * List all users
  *
  * @return Response
  */
  public function index()
  {
    $client = new Client();
    $res = $client->request('GET', 'https://pi-sensors.mozilla-iot.org/things', [
      'headers' =>
      [
        'Authorization' => "Bearer eyJhbGciOiJFUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6IjU1ODJlZmZiLWNiNDMtNDdlNC05NDA3LWIxZThlOTYzMmU2ZSJ9.eyJjbGllbnRfaWQiOiJsb2NhbC10b2tlbiIsInJvbGUiOiJhY2Nlc3NfdG9rZW4iLCJzY29wZSI6Ii90aGluZ3M6cmVhZHdyaXRlIiwiaWF0IjoxNTc2MTM5MzAzLCJpc3MiOiJodHRwczovL3BpLXNlbnNvcnMubW96aWxsYS1pb3Qub3JnIn0.iP41jAwSKyTUW6ectYFPTdjmrbmxU5nUxKMdXH33EpRS9TGqr89xR40_-DdISqFKxgTLu2cn4II8pk3BSP0MwQ"
      ]
    ]);
    if ($res->getStatusCode() == 200) {
      return response()->json([
        "success" => true,
        "data" => $res->getBody()
      ], 200);
    }
  }
}
