<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\DbLog;
use JWTAuth;

class LogApiController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $logs = DbLog::all();

    return response()->json([
      'success' => true,
      'data' => $logs
    ], 200);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function create(Request $request)
  {
    $log = new DbLog();
    $log->name = $request->name;
    $log->data = $request->data;
    $log->location_id = $request->location_id;
    $log->save();

    return response()->json([
      'success' => true,
      'data' => $log
    ], 201);
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return Response
  */
  public function show(DbLog $log)
  {
    return response()->json([
      'success' => true,
      'data' => $log
    ], 200);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request, DbLog $log)
  {
    $log->update($request->all());

    return response()->json([
      'success' => true,
      'data' => $log,
      'message' => "Log modifié"
    ], 200);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy(DbLog $log)
  {
    $log->delete();

    return response()->json([
      'success' => true,
      'message' => 'Log supprimé'
    ], 204);
  }
}
