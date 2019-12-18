<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Resources\Events as EventCollection;
use App\EventGroups;
use JWTAuth;

class EventGroupApiController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
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
    $event = new EventGroups();
    $event->name = $request->name;
    $event->restriction = $request->restriction;
    $event->save();

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
  public function show(EventGroups $event)
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
  public function update(Request $request, EventGroups $event)
  {
    $event->update($request->all());

    return response()->json([
      'success' => true,
      'data' => $event,
      'message' => "Groupe d'évènement modifié"
    ], 200);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy(EventGroups $event)
  {
    $event->delete();

    return response()->json([
      'success' => true,
      'message' => 'Groupe d\'évènement supprimé'
    ], 204);
  }
}
