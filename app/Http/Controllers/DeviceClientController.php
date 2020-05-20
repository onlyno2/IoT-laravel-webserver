<?php

namespace App\Http\Controllers;

use App\Models\DeviceCommand;
use App\Models\DeviceType;
use App\Models\Frame;
use App\Models\DeviceClient;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DeviceClientController extends CustomController
{
  public function index(Request $request)
  {
    $user = auth()->user();
    $frameId = $request->input('frame_id');

    $frame = $user->frames->find($frameId);
    if(!$frame) {
      return $this->response('Error', [], 500);
    }

    try {
      $devices = $frame->devices;
      return $this->response('Ok', $devices, 200);
    } catch (Exception $e) {
      Log::error($e);
      return $this->response('Error', [], 500);
    }
  }

  public function store(Request $request)
  {
    $credentials = $request->input(['auth']);
    if(!$credentials) {
      return $this->response('Error', [], 401);
    }

    $userId = $this->getUserId($credentials);
    if (!$userId) {
      return $this->response('Error', [], 401);
    }
    $createParams = $request->only(['id', 'status', 'xaxis', 'yaxis']);
    $frame = $request->input('frame');
    $type = $request->input('type');

    try {
      $frameId = Frame::where('name', $frame)->first()->id;
      $typeId = DeviceType::where('name', $type)->first()->id;
      $createParams['device_type_id'] = $typeId;
      $createParams['frame_id'] = $frameId;
    } catch(Exception $e) {
      Log::error($e);
      return $this->response('Error', [], 500);
    }

    try {
      $device = DeviceClient::find($createParams['id']);
      if (!$device) {
        $device = DeviceClient::create($createParams);
      } else {
        $device['status'] = true;
        $device->save();
      }

      return $this->response('Ok', $device, 200);
    } catch (Exception $e) {
      Log::error($e);
      return $this->response('Error', [], 500);
    }
  }

  public function update(Request $request, $deviceId)
  {
    $updateDeviceStatus = $request->all();
    $credentials = $request->input(['auth']);
    $userId = $this->getUserId($credentials);
    if (!$userId) {
      return $this->response('Error', [], 401);
    }
    try {
      $device = DeviceClient::firstOrCreate($deviceId);
      $device->update($updateDeviceStatus);
    } catch (Exception $e) {
      Log::error($e);
      return $this->response('Error', [], 500);
    }
  }

  public function trackDeviceStatus(Request $request, $deviceId)
  {
    $updateDeviceStatus = $request->only(['status']);

    try {
      $device = DeviceClient::findOrFail($deviceId);
      $device->update($updateDeviceStatus);
    } catch (Exception $e) {
      Log::error($e);
      return $this->response('Error', [], 500);
    }
  }

  public function data($deviceId)
  {
    // TODO check user privilage to track sensor data
    $result = $this->mongoConnection
      ->collection('sensor_data')
      ->where('deviceId', $deviceId)
      ->orderBy('date', 'desc')->first();
    return $this->response('Ok', $result, 200);
  }

  public function test()
  {
    return $this->response('', ['frames' => Frame::all()]);
  }
}
