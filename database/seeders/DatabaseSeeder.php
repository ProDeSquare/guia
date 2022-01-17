<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i <= 15; $i++) {
            Student::create([
                'name' => Str::random(10),
                'email' => Str::random(10).'@gmail.com',
                'password' => Hash::make('hamza123'),
                'username' => Str::random(3),
                'roll_no' => rand(1000, 9999),
                'created_by' => 1,
            ]);
        }
    }
}
