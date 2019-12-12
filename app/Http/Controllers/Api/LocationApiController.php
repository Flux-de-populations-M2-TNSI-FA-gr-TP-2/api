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
    $locations = \App\Location::get();
    return response()->json([
      'success' => true,
      'data'    => $locations
    ], 201);
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

  public function update(Request $request, $id)
  {
    $location          = Location::findOrFail($id);
    $location->name    = $request->name;
    $location->address = $request->address;

    $location->save();

    return response()->json([
      'success' => true,
      'data'    => $location
    ], 201);
  }

  public function delete(Request $request, $id)
  {
    $location             = Location::findOrFail($id);
    $location->deleted_at = \Carbon\Carbon::now();

    $location->save();

    return response()->json([
      'success' => true,
      'data'    => $location
    ], 201);
  }
}
