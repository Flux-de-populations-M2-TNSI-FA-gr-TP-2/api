<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Resources\Events as EventCollection;
use App\Event;
use App\EventGroups;
use App\User;
use App\Location;
use App\Room;
use App\Sensor;
use App\Type;
use JWTAuth;

class GeneralApiController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function count(Request $request)
  {
    $data = array();
    $users = User::count();
    $events = Event::count();
    $groups = EventGroups::count();
    $locations = Location::count();
    $rooms = Room::count();
    $sensors = Sensor::count();
    $types = Type::count();
    // if (!$request->has('data')) {
      $data['users'] = $users;
      $data['event_groups'] = $groups;
      $data['events'] = $events;
      $data['locations'] = $locations;
      $data['rooms'] = $rooms;
      $data['sensors'] = $sensors;
      $data['sensor_types'] = $types;
    // }


    return response()->json([
      'success' => true,
      'data' => $data
    ], 200);
  }
}
