<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            "name" => "wassim",
            "email" => "wasim@gmail.com",
            "password" => bcrypt("123456789"),
        ]);

        $admin->assignRole("super-admin");

        $teacher = User::create([
            "name" => "teacher",
            "email" => "teacher@gmail.com",
            "password" => bcrypt("123456789"),
        ]);
        $teacher->assignRole("teacher");
    }
}
