<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class SensorData extends Model
{
  protected $connection = 'mongodb';

  protected $collection = 'sensor_data';

  protected $fillable = ['date', 'values'];
}
