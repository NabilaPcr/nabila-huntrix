<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateFirstUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        // User pertama (manual)
        // User::create([
        //     'name' => 'Bella',
        //     'email' => 'bellahadi@pcr.ac.id',
        //     'password' => Hash::make('Nabilaahh'),
        //     'profile_picture' => null
        // ]);

        // User kedua (manual) - tambahkan user manual lainnya jika perlu
        // User::create([
        //     'name' => 'Admin',
        //     'email' => 'admin@pcr.ac.id',
        //     'password' => Hash::make('admin123'),
        //     'profile_picture' => null
        // ]);

        // Generate 20 user dummy
        foreach (range(1, 20) as $index) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password123'),
                'profile_picture' => null
            ]);
        }
    }
}
