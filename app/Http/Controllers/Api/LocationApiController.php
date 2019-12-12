<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Location;
use JWTAuth;

class LocationApiController extends Controller
{

  public function index()
  {
    $locations = Location::get();
    return response()->json([
      'success' => true,
      'data'    => $locations
    ], 200);
  }

  public function create(Request $request)
  {
    $location          = new Location();
    $location->name    = $request->name;
    $location->address = $request->address;
    $location->save();

    return response()->json([
      'success' => true,
      'data'    => $location
    ], 201);
  }

  public function update(Request $request, Location $location)
  {
    $location->update($request->all());

    return response()->json([
      'success' => true,
      'data'    => $location,
      'message' => "Batiment modifié"
    ], 200);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show(Location $location)
  {
    return response()->json([
      'success' => true,
      'data' => $location
    ], 200);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy(Location $location)
  {
    $location->delete();

    return response()->json([
      'success' => true,
      'message' => 'Batiment supprimé'
    ], 204);
  }
}
