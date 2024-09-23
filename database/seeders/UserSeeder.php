<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'gender' => $faker->randomElement(['Nam', 'Nữ']),
                'user_agent' => $faker->randomElement(['Cộng tác viên', 'Quản trị viên']),
                'phone' => '0' . $faker->numerify('#########'),
                'birthday' => $faker->date('Y-m-d', '2005-12-31'),
                'password' => Hash::make('123456789'),
                'province_id' => rand(1, 20),
                'district_id' => rand(1, 20),
                'ward_id' => rand(1, 20),
                'address'=> $faker->address,
            ]);
        }
    }
}


