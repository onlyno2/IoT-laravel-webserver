<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class TemperatureData extends Model
{
  protected $connection = 'mongodb';

  protected $collection = 'temperature_data';
}
