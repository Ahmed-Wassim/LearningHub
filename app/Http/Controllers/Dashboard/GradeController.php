<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Grade;
use App\Models\Level;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $levels = Level::all();
        $grades = Grade::orderByRaw("
        CASE
            WHEN name LIKE 'p-%' THEN 1
            WHEN name LIKE 's-%' THEN 2
            WHEN name LIKE 'h-%' THEN 3
            ELSE 4
        END
    ")->orderByRaw("CAST(SUBSTRING_INDEX(name, '-', -1) AS UNSIGNED)")->get();
        ;

        return view('dashboard.grades.index', compact('levels', 'grades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'level_id' => ['required'],
            'grade_count' => ['required', 'numeric', 'min:3'],
        ]);

        try {
            $level = Level::findOrFail($request->level_id);

            for ($i = 1; $i <= $request->grade_count; $i++) {
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
            return back()->with('success', 'Grades created successfully');

        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $grade = Grade::findOrFail($id);

        $grade->delete();

        return redirect()->route('admin.grades.index')->with('warning', 'Grade Deleted Successfully');
    }
}
