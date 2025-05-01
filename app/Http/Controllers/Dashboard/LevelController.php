<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Level;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $levels = Level::all();

        return view('dashboard.levels.index', compact('levels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.levels.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            $level = Level::create([
                'name' => $request->name,
                'description' => $request->description,
                'min_age' => $request->min_age,
                'max_age' => $request->max_age,
            ]);


            if ($request->hasFile('image')) {
                $level->uploadImage($request);
            }



            flash()->success('Level created successfully');

            return redirect()->route('admin.levels.index');
        } catch (\Exception $e) {
            flash()->error('Error creating level');
            return redirect()->route('admin.levels.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $level = Level::findOrFail($id);

        return view('dashboard.levels.edit', compact('level'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $level = Level::findOrFail($id);

            $level->update([
                'name' => $request->name,
                'description' => $request->description,
                'min_age' => $request->min_age,
                'max_age' => $request->max_age,
                'image' => $request->image,
            ]);

            if ($request->hasFile('image')) {
                $level->replaceImage($request);
            }

            flash()->success('Level updated successfully');
            return redirect()->route('admin.levels.index');
        } catch (\Exception $e) {
            flash()->error('Error updating level');
            return redirect()->route('admin.levels.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $level = Level::findOrFail($id);

            $level->deleteImage();

            $level->delete();

            return redirect()->route('admin.levels.index')->with('success', 'Level deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('admin.levels.index')->with('error', 'Error deleting level');
        }
    }
}
