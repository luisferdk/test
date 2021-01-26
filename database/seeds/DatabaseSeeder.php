<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;

use App\User;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run(Faker $faker)
  {
    /* Users */
    DB::table('users')->truncate();

    User::create([
      "name"=>'luis',
      "email" => 'luis@example.com',
      "password" => bcrypt("luis")
    ]);

    for ($i = 0; $i < 100; $i++) {
      DB::table('users')->insert([
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10)
      ]);
    }

    /* Posts */
    DB::table('posts')->truncate();
    for ($i = 0; $i < 200; $i++) {
      DB::table('posts')->insert([
        'title' => $faker->text(20),
        'description' => $faker->paragraph(20),
        'user_id' => $faker->numberBetween(1, 20)
      ]);
    }

    /* Comments */
    DB::table('comments')->truncate();
    for ($i = 0; $i < 500; $i++) {
      DB::table('comments')->insert([
        'description' => $faker->sentence(20, true),
        'user_id' => $faker->numberBetween(1, 20),
        'post_id' => $faker->numberBetween(1, 20)
      ]);
    }
  }
}
