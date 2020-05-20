<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class CustomController extends Controller
{
  protected $mongoConnection;

  public function __construct() {
    $this->mongoConnection = DB::connection('mongodb');
  }

  public function response($message = '', $data = [], $status_code = 200)
  {
    return response()->json([
      'message' => $message,
      'data' => $data
    ], $status_code);
  }


  public function unauthorized($credentials)
  {
    return auth('api')->attempt($credentials);
  }

  public function getUserId($credentials)
  {
    $token = $this->unauthorized($credentials);
    if (!$token) {
      return null;
    }
    $user = JWTAuth::setToken($token)->authenticate();
    return $user->id;
  }
}
