<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{

  /**
  * Display a listing of the resource.
  *
  * @return Response
  */
  public function index()
  {
    return User::all();
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return Response
  */
  public function create()
  {

  }

  /**
  * Store a newly created resource in storage.
  *
  * @return Response
  */
  public function store(Request $request)
  {
    $user = User::create($request->all());

    return response()->json($user, 201);
  }

  /**
  * Display the specified resource.
  *
  * @param  User  $user
  * @return Response
  */
  public function show(User $user)
  {
    return $user;
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return Response
  */
  public function edit($id)
  {

  }

  /**
  * Update the specified resource in storage.
  *
  * @param  User  $user
  * @return Response
  */
  public function update(Request $request, User $user)
  {
    $user->update($request->all());

    return response()->json($user, 200);
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  User  $user
  * @return Response
  */
  public function destroy(User $user)
  {
      $user->delete();

      return response()->json(null, 204);
  }

}

?>
