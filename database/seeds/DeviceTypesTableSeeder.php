<?php

use App\Models\DeviceType;
use Faker\Factory;
use Illuminate\Database\Seeder;

class DeviceTypesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = Factory::create();
		DeviceType::create([
			'name' => 'A',
			'description' => $faker->sentence()
		]);
		DeviceType::create([
			'name' => 'B',
			'description' => $faker->sentence()
		]);
		DeviceType::create([
			'name' => 'C',
			'description' => $faker->sentence()
		]);
		DeviceType::create([
			'name' => 'D',
			'description' => $faker->sentence()
		]);
	}
}
