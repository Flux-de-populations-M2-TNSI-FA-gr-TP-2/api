<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Event;
use JWTAuth;

class EventApiController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $events = Event::get();

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
    $event->locations()->sync($request->locations);

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
