<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Essa\APIToolKit\Api\ApiResponse;

class AuthController extends Controller
{
  use ApiResponse;

    public function login(Request $request)
    {
      $credentials = $request->only('email', 'password');
      if (Auth::attempt($credentials)) {
          $user = Auth::user();
          $token = $user->createToken('authToken')->plainTextToken;
          return response()->json(['token' => $token], 200);
      }
      return response()->json(['message' => 'Unauthorized'], 401);
    }
  
    public function logout(Request $request)
    {
      $request->user()->currentAccessToken()->delete();
      return response()->json(['message' => 'Logged out'], 200);
    }
}
