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
  // TODO: A compléter
  public function create(Request $request)
  {
    $location = new Location();
    $location->name = $request->name;


    $location->save();

    return response()->json([
      'success' => true,
      'data' => $location
    ], 201);
  }
}
