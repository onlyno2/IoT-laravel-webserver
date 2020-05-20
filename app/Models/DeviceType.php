<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceType extends Model
{
  protected $table = "device_types";

  protected $fillable = ["name", "description"];

  public function commands()
  {
    return $this->hasMany(DeviceCommand::class, 'device_type_id', 'id');
  }
}
