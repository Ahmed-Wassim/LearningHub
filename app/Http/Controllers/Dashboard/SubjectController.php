<?php

namespace App\Http\Controllers\Dashboard;

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
        try {
            $subject = Subject::create([
                'name' => $request->name,
                'grade_id' => $request->grade,
                'price' => $request->price ?? 0.0,
                'is_free' => $request->is_free == 'on' ? true : false,
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

    public function update(Request $request, string $id)
    {
        try {
            $subject = Subject::findOrFail($id);

            $subject->update([
                'name' => $request->name,
                'grade_id' => $request->grade,
                'price' => $request->price ?? 0.0,
                'is_free' => $request->is_free == 'on' ? true : false,
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
