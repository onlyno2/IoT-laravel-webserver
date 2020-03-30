<?php

namespace App\Http\Controllers;

use App\Data;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DataController extends CustomController
{
  public function index(Request $request)
  {
    return $this->response('', DB::table('data')->paginate(15), 200);
  }

  public function store(Request $request)
  {
    $resources = $request->input(['resources']);
    $data = [];
    foreach ($resources as $resource) {
      // Log::info('resource', $resource);
      if ($resource) {
        $resource['payload']['date'] = Carbon::createFromTimeString($resource['payload']['date']);
        array_push($data, $resource['payload']);
      }
    }
    try {
      if ($data)
        Data::insert($data);
      return $this->response('', [], 201);
    } catch (Exception $e) {
      Log::error('DataController error: ' . $e->getMessage());
      return $this->response($e->getMessage(), [], 500);
    }
  }
}
