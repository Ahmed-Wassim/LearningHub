<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Grade;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;

class SubjectController extends Controller
{

    public function index(Request $request)
    {
        $query = Subject::query();

        if ($request->filled('grade')) {
            $query->join('grades', 'subjects.grade_id', '=', 'grades.id')
                ->where('grades.slug', $request->grade)
                ->select('subjects.*');
        }

        $subjects = $query->get();
        $grades = Grade::all();

        return view('dashboard.subjects.index', compact('subjects', 'grades'));
    }


    public function create()
    {
        $grades = Grade::all();
        return view('dashboard.subjects.create', compact('grades'));
    }

    public function store(StoreSubjectRequest $request)
    {
        try {
            $subject = Subject::create([
                'name' => $request->name,
                'grade_id' => $request->grade,
            ]);

            if ($request->hasFile('image')) {
                $subject->uploadImage($request);
            }

            return redirect()->route('admin.subjects.index')->with('success', 'Subject created successfully');
        } catch (\Exception $e) {
            flash()->error('Error creating subject');
            return redirect()->route('admin.subjects.index');
        }

    }



    public function edit(string $id)
    {
        $subject = Subject::findOrFail($id);
        $grades = Grade::all();
        return view('dashboard.subjects.edit', compact('grades', 'subject'));
    }

    public function update(UpdateSubjectRequest $request, string $id)
    {
        try {
            $subject = Subject::findOrFail($id);

            $subject->update([
                'name' => $request->name,
                'grade_id' => $request->grade,
            ]);

            if ($request->hasFile('image')) {
                $subject->replaceImage($request);
            }

            return redirect()->route('admin.subjects.index')->with('success', 'Subject updated successfully');
        } catch (\Exception $e) {
            flash()->error('Error updating subject');
            return redirect()->route('admin.subjects.index');
        }
    }


    public function destroy(string $id)
    {
        try {
            $subject = Subject::findOrFail($id);

            $subject->deleteImage();

            $subject->delete();
            return redirect()->route('admin.subjects.index')->with('success', 'Subject deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('admin.subjects.index')->with('error', 'Error deleting subject');
        }
    }
}
