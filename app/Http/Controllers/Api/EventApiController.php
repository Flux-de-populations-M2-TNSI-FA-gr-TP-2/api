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
  // TODO: A compléter
  public function create(Request $request)
  {
    $event = new Event();
    $event->name = $request->name;


    $event->save();

    return response()->json([
      'success' => true,
      'data' => $event
    ], 201);
  }
}
