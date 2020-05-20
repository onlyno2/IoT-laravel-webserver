<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceClient extends Model
{
  protected $table = "device_client";
  protected $primaryKey = 'id';
  protected $keyType = 'string';
  public $incrementing = false;

  protected $fillable = ["id", "status", "xaxis", "yaxis", "frame_id", "device_type_id"];

  public function type()
  {
    return $this->belongsTo(DeviceType::class, 'device_type_id', 'id');
  }

  public function commands()
  {
    return $this->type->commands;
  }

  public function frame()
  {
    return $this->belongsTo(Frame::class, 'frame_id', 'id');
  }
}
