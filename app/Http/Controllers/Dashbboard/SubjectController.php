<?php

namespace App\Http\Controllers\Dashbboard;

use App\Models\Grade;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubjectController extends Controller
{

    public function index()
    {
        $subjects = Subject::all();
        return view('dashboard.subjects.index', compact('subjects'));
    }


    public function create()
    {
        $grades = Grade::all();
        return view('dashboard.subjects.create', compact('grades'));
    }

    public function store(Request $request)
    {
        Subject::create([
            'name' => $request->name,
            'grade_id' => $request->grade,
            'price' => $request->price ?? 0.0,
            'is_free' => $request->is_free == 'on' ? true : false,
        ]);

        return redirect()->route('admin.subjects.index')->with('success', 'Subject created successfully');
    }



    public function edit(string $id)
    {
        $subject = Subject::findOrFail($id);
        $grades = Grade::all();
        return view('dashboard.subjects.edit', compact('grades', 'subject'));
    }

    public function update(Request $request, string $id)
    {
        $subject = Subject::findOrFail($id);

        $subject->update([
            'name' => $request->name,
            'grade_id' => $request->grade,
            'price' => $request->price ?? 0.0,
            'is_free' => $request->is_free == 'on' ? true : false,
        ]);

        return redirect()->route('admin.subjects.index')->with('success', 'Subject updated successfully');
    }


    public function destroy(string $id)
    {
        Subject::destroy($id);
        return redirect()->route('admin.subjects.index')->with('success', 'Subject deleted successfully');
    }
}
