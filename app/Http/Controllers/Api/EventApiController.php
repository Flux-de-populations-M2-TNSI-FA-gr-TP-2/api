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
    $events = Event::all();

    return response()->json([
      'success' => true,
      'data' => $events
    ], 201);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    $event = Event::find($id);

    return response()->json([
      'success' => true,
      'data' => $event
    ], 201);
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

    return response()->json([
      'success' => true,
      'data' => $event
    ], 201);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {
    $event = Event::findOrFail($id);

    $event->name = $request->name;
    $event->start = $request->start;
    $event->end = $request->end;
    $event->status = $request->status;

    $event -> save();

    return response()->json([
      'success' => true,
      'data' => $event
    ], 201);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    $event = Event::findOrFail($id);

    $event -> deleted_at = \Carbon\Carbon::now();
    $event -> save();

    return response()->json([
      'success' => true,
      'data' => $event
    ], 201);
  }
}
