<?php

namespace App\Http\Controllers;

use App\Data;
use Exception;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DataController extends CustomController
{
  public function index(Request $request)
  {
    return $this->response('', Data::all(), 200);
  }

  public function store(Request $request)
  {
    $data = $request->only(['temprature', 'humidity', 'device_id', 'time']);
    try {
      $data = Data::create($data);
      return $this->response('', [], 201);
    } catch(Exception $e) {
      Log::error('DataController error: ' . $e->getMessage());
      return $this->response($e->getMessage(), [], 500);
    }
  }
}
