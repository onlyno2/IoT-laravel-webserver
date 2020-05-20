<?php

use App\Models\Frame;
use App\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class FramesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $faker = Factory::create();
    $user = User::all()->first();
    foreach (range(1, 10) as $index) {
      Frame::create([
        'user_id' => $user->id,
        'name' => $faker->word()
      ]);
    }
  }
}
