<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class DeviceClient extends Model
{
  protected $table = "device_client";
  protected $primaryKey = 'id';
  protected $keyType = 'string';
  public $incrementing = false;

  protected $fillable = ["id", "user_id", "status", "xaxis", "yaxis"];

  // protected static function boot()
  // {
  //     parent::boot();
  //     static::creating(function (DeviceClient $model) {
  //         $model->setAttribute($model->getKeyName(), Uuid::uuid4());
  //     });
  // }
}
