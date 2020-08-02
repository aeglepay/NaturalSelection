<?php

use App\User;
use Faker\Factory;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        for ($i=0; $i < 100; $i++) { 
            User::create(
                [
                    'name'              => $faker->name,
                    'email'             => $faker->unique()->safeEmail,
                    'email_verified_at' => now(),
                    'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                    'remember_token'    => Str::random(10),
                    'phone'             => $faker->unique()->phoneNumber,
                    'role'              => 'customer',
                    'active'            => true,
                    'bio'               => $faker->sentence(),
                    'avatar'            => "https://api.adorable.io/avatars/285/" . Str::random(5),
                ]
            );
        }
    }
}
