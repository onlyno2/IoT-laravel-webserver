<?php

use Ramsey\Uuid\Uuid;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->insert([
        'id' => Uuid::uuid4()->toString(),
        'name' => 'admin',
        'email' => 'admin@gmail.com',
        'password' => bcrypt('123456'),
      ]);
      factory(App\User::class, 3)->create();
    }
}
