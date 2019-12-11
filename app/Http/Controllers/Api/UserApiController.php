<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\RegisterAuthRequest;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserApiController extends Controller
{
  public $loginAfterSignUp = true;

  public function register(RegisterAuthRequest $request)
  {
      $user = new User();
      $user->firstname = $request->firstname;
      $user->lastname = $request->lastname;
      $user->email = $request->email;
      $user->role = "admin";
      $user->password = Hash::make($request->password);
      $user->save();

      if ($this->loginAfterSignUp) {
          return $this->login($request);
      }

      return response()->json([
          'success' => true,
          'data' => $user
      ], 200);
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

      return response()->json([
          'success' => true,
          'token' => $jwt_token,
      ]);
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

  public function getAuthUser(Request $request)
  {
      $this->validate($request, [
          'token' => 'required'
      ]);

      $user = JWTAuth::authenticate($request->token);

      return response()->json(['user' => $user]);
  }
}
