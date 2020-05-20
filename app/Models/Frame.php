<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Frame extends Model
{
  protected $table = "frames";

  protected $fillable = ['user_id', 'name'];

  public function devices()
  {
    return $this->hasMany(DeviceClient::class, 'frame_id', 'id');
  }
}
