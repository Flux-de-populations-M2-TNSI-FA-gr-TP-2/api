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
  public function create(RegisterAuthRequest $request)
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
    $token = $this->getTokenFromRequest($request);

    try {
      JWTAuth::invalidate($token);

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
      $users = User::all();

      return response()->json([
        "success" => true,
        "data" => $users
      ], 200);
    }
    return response()->json([
      'success' => false,
      'message' => 'Vous ne possédez pas les autorisations nécessaires.'
    ], 401);
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
      'data' => $user,
      'message' => "Utilisateur modifié"
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

      return response()->json([
        'success' => true,
        'message' => 'Utilisateur supprimé'
      ], 204);
    }
    return response()->json([
      'success' => false,
      'message' => "Seul l'administrateur peut restaurer un utilisateur"
    ], 401);
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return Response
  */
  public function show(User $user)
  {
    if (auth()->user()->isAdmin()) {
      return response()->json([
        'success' => true,
        'data' => $user
      ], 200);
    }
    return response()->json([
      'success' => false,
      'message' => "Seul l'administrateur peut afficher les infos de cet utilisateur"
    ], 401);
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
      $user = User::withTrashed()->find($id)->restore();
      if (!$user) {
        return response()->json([
          'success' => false,
          'message' => 'Utilisateur non trouvé'
        ], 404);
      }

      return response()->json([
        'success' => true,
        'data' => $user,
        'message' => 'Utilisateur restauré'
      ], 201);
    }
    return response()->json([
      'success' => false,
      'message' => "Seul l'administrateur peut restaurer un utilisateur"
    ], 401);
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
      'user' => \Auth::user(),
      'token_type' => 'bearer',
      'expires_in' => \Auth::guard('api')->factory()->getTTL() * 60
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

    if ($user) {
      return response()->json([
        'success' => true,
        'data' => $user
      ]);
    }
  }
}
