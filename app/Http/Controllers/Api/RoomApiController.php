<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Room;

class RoomApiController extends Controller
{

	public function index()
	{
		$rooms = Room::get();
	    return response()->json([
			'success' => true,
			'data'    => $rooms
	    ], 201);
	}

	public function create(Request $request)
	{
		$room              = new Room();
		$room->name        = $request->name;
		$room->floor       = $request->floor;
		$room->location_id = $request->location_id;

		$room->save();

		return response()->json([
			'success' => true,
			'data'    => $room
		], 201);
	}

	public function update(Request $request, $id)
	{
		$room              = Room::findOrFail($id);
		$room->name        = $request->name;
		$room->floor       = $request->floor;
		$room->location_id = $request->location_id;

		$room->save();

		return response()->json([
			'success' => true,
			'data'    => $room
		], 201);
	}

	public function delete(Request $request, $id)
	{
		$room             = Room::findOrFail($id);
		$room->deleted_at = \Carbon\Carbon::now();
		$room->save();

		return response()->json([
			'success' => true,
			'data'    => $room
		], 201);
	}
}
