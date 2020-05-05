<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomController extends Controller
{
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
}
