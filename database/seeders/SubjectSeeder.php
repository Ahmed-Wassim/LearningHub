<?php

namespace Database\Seeders;

use App\Models\Level;
use App\Models\Subject;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $secondary = Level::where('name', 'Secondary School')->first();

        foreach ($secondary->grades as $grade) {
            Subject::create([
                'grade_id' => $grade->id,
                'name' => 'English',
            ]);

            Subject::create([
                'grade_id' => $grade->id,
                'name' => 'Mathematics',
            ]);

            Subject::create([
                'grade_id' => $grade->id,
                'name' => 'Science',
            ]);

            Subject::create([
                'grade_id' => $grade->id,
                'name' => 'Social Studies',
            ]);

            Subject::create([
                'grade_id' => $grade->id,
                'name' => 'Arabic',
            ]);
        }

        $high = Level::where('name', 'High School')->first();

        $h1 = $high->grades()->where('name', 'h-1')->first();

        if ($h1) {
            $h1->subjects()->createMany([
                ['name' => 'Arabic'],
                ['name' => 'English'],
                ['name' => 'Mathematics'],
                ['name' => 'Science'],
                ['name' => 'History'],
            ]);
        }

        $h2 = $high->grades()->where('name', 'h-2')->first();

        if ($h2) {
            $h2->subjects()->createMany([
                ['name' => 'Arabic'],
                ['name' => 'English'],
                ['name' => 'Mathematics'],
                ['name' => 'Chemistry'],
                ['name' => 'Physics'],
                ['name' => 'Biology'],
                ['name' => 'History'],
                ['name' => 'Geography'],
            ]);
        }

        $h3 = $high->grades()->where('name', 'h-3')->first();

        if ($h3) {
            $h3->subjects()->createMany([
                ['name' => 'Arabic'],
                ['name' => 'English'],
                ['name' => 'Mathematics'],
                ['name' => 'Chemistry'],
                ['name' => 'Physics'],
                ['name' => 'Biology'],
                ['name' => 'History'],
                ['name' => 'Geography'],
            ]);
        }
    }
}
