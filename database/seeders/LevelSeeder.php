<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Level::create([
            "name" => 'Primary School',
            'description' => 'Learning foundations for grades 1-6 with interactive lessons and activities.',
            'min_age' => 6,
            'max_age' => 12
        ]);

        Level::create([
            "name" => 'Secondary School',
            'description' => 'Intermediate education for grades 7-9 covering core subjects and skills.',
            'min_age' => 12,
            'max_age' => 15
        ]);

        Level::create([
            "name" => 'High School',
            'description' => 'Advanced curriculum for grades 10-12 preparing students for higher education.',
            'min_age' => 15,
            'max_age' => 18,
        ]);
    }
}
