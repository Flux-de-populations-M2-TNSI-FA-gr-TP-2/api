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
		], 200);
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

	/**
	* Display the specified resource.
	*
	* @param  int  $id
	* @return Response
	*/
	public function show(Room $room)
	{
		return response()->json([
			'success' => true,
			'data' => $room
		], 200);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, Room $room)
	{
		$room->update($request->all());

		return response()->json([
			'success' => true,
			'data' => $room,
			'message' => "Salle modifiée"
		], 200);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Room $room)
	{
		$room->delete();

		return response()->json([
			'success' => true,
			'message' => 'Salle supprimée'
		], 204);
	}
}
