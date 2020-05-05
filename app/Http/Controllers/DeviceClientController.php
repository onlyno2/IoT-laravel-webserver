<?php

namespace App\Http\Controllers;

use App\Models\DeviceClient;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Ramsey\Uuid\Uuid;
use Tymon\JWTAuth\Facades\JWTAuth;

class DeviceClientController extends CustomController
{
  public function index(Request $request)
  {
    return $this->response('', DeviceClient::all(), 200);
  }

  public function store(Request $request)
  {
    try {
      $credentials = $request->input('auth');
      $token = $this->unauthorized($credentials);
      if (!$token) {
        return $this->response('', ['Error' => 'Unauthorized'], 401);
      }
      $user = JWTAuth::setToken($token)->authenticate();
      $createParams = $request->only(['id', 'status', 'xaxis', 'yaxis']);
      $createParams['user_id'] = $user['id'];
      $device = DeviceClient::firstOrNew($createParams);
      $device->save();
    } catch (Exception $e) {
      Log::error($e);
      return $this->response('Error', [], 500);
    }
  }

  public function data($deviceId)
  {
    $result = DB::connection('mongodb')
      ->collection('sensor_data')
      ->where('deviceId', $deviceId)
      ->orderBy('date', 'desc')->first();
    return $this->response('Ok', $result, 200);
  }
}
