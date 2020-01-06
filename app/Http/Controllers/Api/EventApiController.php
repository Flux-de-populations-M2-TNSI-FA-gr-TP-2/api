<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Resources\Events as EventCollection;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use App\Event;
use App\EventGroups;
use JWTAuth;

class EventApiController extends Controller
{
  private $app_id = "1f3fc8c5-f4e3-483b-b223-cc9ce06a39a6";
  private $access_token = "ZGY2MzQyMDEtZWFmOS00ZGNmLWI0ODMtYmE5OTM2OGUxY2Iw";

  /**
  * Display a listing of the resource.
  *
  * @return Response
  */
  public function index()
  {
    $events = Event::all();

    return response()->json([
      'success' => true,
      'data' => $events
    ], 200);
  }

  /**
  * Display a listing of the resource.
  *
  * @return Response
  */
  public function indexGroups()
  {
    $events = EventGroups::all();

    return response()->json([
      'success' => true,
      'data' => $events
    ], 200);
  }

  /**
  * Store a newly created resource in storage.
  *
  * @return Response
  */
  public function create(Request $request)
  {
    $event = new Event();
    $event->name = $request->name;
    $event->start = $request->start;
    $event->end = $request->end;
    $event->status = $request->status;
    $event->save();

    $event->groups()->sync($request->groups);

    $client = new Client();
    $headers = [
      'Authorization' => 'Basic '.$this->access_token,
      'Accept'        => 'application/json',
      'Content-Type' => 'application/x-www-form-urlencoded',
    ];
    $content = array(
      "en" => $event->name.' from '.$event->start.' by '.$event->end.'.',
      "fr" => $event->name.' du '.$event->start.' au '.$event->end.'.',
    );
    $segment = array('All');

    try {
      $res = $client->request('POST', 'https://onesignal.com/api/v1/notifications', [
        'headers' => $headers,
        'form_params' => [
          'app_id' => $this->app_id,
          'included_segments' => json_encode($segment),
          'contents' => $content
        ]
      ]);
    } catch (RequestException $e) {
      return response()->json([
        "success" => false,
        "data" => null,
        "message" => "La notification n'a pas pu être envoyée."
      ], 200);
    }

    return response()->json([
      'success' => true,
      'data' => $event
    ], 201);
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return Response
  */
  public function show(Event $event)
  {
    return response()->json([
      'success' => true,
      'data' => $event
    ], 200);
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  int  $id
  * @return Response
  */
  public function update(Request $request, Event $event)
  {
    $event->update($request->all());

    return response()->json([
      'success' => true,
      'data' => $event,
      'message' => "Évènement modifié"
    ], 200);
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return Response
  */
  public function destroy(Event $event)
  {
    $event->delete();

    return response()->json([
      'success' => true,
      'message' => 'Évènement supprimé'
    ], 204);
  }
}
