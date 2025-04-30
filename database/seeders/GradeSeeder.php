<?php

namespace Database\Seeders;

use App\Models\Grade;
use App\Models\Level;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $levels = Level::all();


        foreach ($levels as $level) {
            $count = $level->name == 'Primary School' ? 6 : 3;
            for ($i = 1; $i <= $count; $i++) {
                $name = strtolower($level->name[0]) . '-' . $i;

                $exists = Grade::where('level_id', $level->id)
                    ->where('name', $name)
                    ->exists();

                if (!$exists) {
                    Grade::create([
                        'level_id' => $level->id,
                        'name' => $name
                    ]);
                }

            }
        }
    }
}
