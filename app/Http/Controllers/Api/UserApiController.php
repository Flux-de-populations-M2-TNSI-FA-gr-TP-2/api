<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\RegisterAuthRequest;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Resources\Users as UserCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserApiController extends Controller
{
  public function register(RegisterAuthRequest $request)
  {
    $user = new User();
    $user->firstname = $request->firstname;
    $user->lastname = $request->lastname;
    $user->email = $request->email;
    $user->role = ($request->role) ? $request->role : 'user';
    $user->birthdate = ($request->birthdate) ? date('Y-m-d', strtotime($request->birthdate)) : NULL;
    $user->password = Hash::make($request->password);
    $user->save();

    if ($request->loginAfterRegister) {
      return $this->login($request);
    }

    return response()->json([
      'success' => true,
      'data' => $user
    ], 201);
  }

  public function login(Request $request)
  {
    $input = $request->only('email', 'password');
    $jwt_token = null;

    if (!$jwt_token = JWTAuth::attempt($input)) {
      return response()->json([
        'success' => false,
        'message' => 'E-mail ou Mot de passe invalide.',
      ], 401);
    }

    return $this->respondWithToken($jwt_token);
  }

  public function logout(Request $request)
  {
    $this->validate($request, [
      'token' => 'required'
    ]);

    try {
      JWTAuth::invalidate($request->token);

      return response()->json([
        'success' => true,
        'message' => 'Utilisateur déconnecté'
      ]);
    } catch (JWTException $exception) {
      return response()->json([
        'success' => false,
        'message' => 'L\'utilisateur n\'a pu être déconnecté'
      ], 500);
    }
  }

  /**
  * List all users
  *
  * @return Response
  */
  public function index()
  {
    if (auth()->user()->isAdmin()) {
      $users = UserCollection::collection(User::paginate());

      return response()->json([
        "success" => true,
        "data" => $users
      ], 200);
    }
    return response()->json(null, 401);
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  User  $user
  * @return Response
  */
  public function update(Request $request, User $user)
  {
    $input = $request->all();
    if (!auth()->user()->isAdmin()) {
      $user = auth()->user();
      $input = $request->except('role');
    }
    $user->update($input);

    return response()->json([
      'success' => true,
      'data' => $user
    ], 200);
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  User  $user
  * @return Response
  */
  public function destroy(User $user)
  {
    if (auth()->user()->isAdmin()) {
      $user->delete();

      return response()->json(null, 204);
    }
    return response()->json(null, 401);
  }

  /**
  * Restore the specified resource from storage.
  *
  * @param  User  $user
  * @return Response
  */
  public function restore($id)
  {
    if (auth()->user()->isAdmin()) {
      User::withTrashed()->find($id)->restore();

      return response()->json(null, 201);
    }
    return response()->json(null, 401);
  }

  /**
  * Get the token array structure.
  *
  * @param  string $token
  *
  * @return \Illuminate\Http\JsonResponse
  */
  protected function respondWithToken($token)
  {
    return response()->json([
      'success' => true,
      'access_token' => $token,
      'token_type' => 'bearer',
      'expires_in' => auth()->factory()->getTTL() * 60
    ]);
  }

  /**
  * Get the authenticated User.
  *
  * @return \Illuminate\Http\JsonResponse
  */
  public function me()
  {
    return response()->json(auth()->user());
  }

  public function getTokenFromRequest(Request $request)
  {
    if (!$token = $request->bearerToken()) {
      $this->validate($request, [
        'token' => 'required'
      ]);
      $token = $request->token;
    }
    return $token;
  }

  public function getAuthUser(Request $request)
  {
    $user = JWTAuth::authenticate($this->getTokenFromRequest($request));

    return response()->json(['user' => $user]);
  }
}
