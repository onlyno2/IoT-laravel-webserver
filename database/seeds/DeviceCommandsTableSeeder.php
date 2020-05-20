<?php

use App\Models\DeviceCommand;
use Faker\Factory;
use Illuminate\Database\Seeder;

class DeviceCommandsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $faker = Factory::create();

    foreach (range(1, 40) as $index) {
      DeviceCommand::create([
        'device_type_id' => $faker->numberBetween(1, 4),
        'name' => $faker->word(),
        'description' => $faker->sentence()
      ]);
    }
  }
}
