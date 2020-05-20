<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FramesController extends CustomController
{
  public function index(Request $request)
  {
    try {
      $user = auth()->user();
      return $this->response('Ok', $user->frames, 200);
    } catch(Exception $e) {
      Log::error($e);
      return $this->response('Error', [], 500);
    }
  }
}
