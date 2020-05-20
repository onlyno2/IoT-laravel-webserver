<?php

namespace App\Http\Controllers;

use App\Data;
use App\Models\SensorData;
use App\Models\TemperatureData;
use Carbon\Carbon;
use Exception;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
    } catch (Exception $e) {
      Log::error('DataController error: ' . $e->getMessage());
      return $this->response($e->getMessage(), [], 500);
    }
  }

  public function getData(Request $request)
  {
    return $this->response('', SensorData::all(), 200);
  }

  public function clearData(Request $request)
  {
    return $this->response('', SensorData::truncate(), 200);
  }

  public function storeData(Request $request)
  {
    try {
      $credentials = $request->input('auth');
      if(!$this->unauthorized($credentials)) {
        return $this->response('', ['Error' => 'Unauthorized'], 401);
      }

      $dataSet = $request->input('resources');
      $date = Carbon::parse($dataSet[0]["payload"]["date"])->format("d/m/Y H:i:s");
      $insertData = [];
      foreach ($dataSet as $data) {
        $values = [
          'temprature' => $data["payload"]["temperature"],
          'humidity' => $data["payload"]["humidity"]
        ];
        array_push($insertData, [
          $data["client_id"] => $values
        ]);
      }
      $date = SensorData::create([$date]);
      $date->push('values', $insertData);
      return $this->response('ok', [], 200);
    } catch (Exception $e) {
      Log::error($e);
      return $this->response('Error', $e, 500);
    }
  }
}
