<?php

namespace App\Http\Controllers\Site;

use App\Models\Grade;
use App\Models\SubjectUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function show()
    {
        $grades = Grade::with('subjects')->get();
        return view('site.become-teacher', compact('grades'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $syncData = [];
        foreach ($request['subjects'] as $item) {
            $syncData[$item['subject_id']] = [
                'price' => $item['price'],
                'active' => $item['active'] ?? false,
                'status' => $item['status'] ?? 'pending',
            ];

        }

        Auth::user()
            ->subjects()
            ->syncWithoutDetaching($syncData);

        foreach ($request['subjects'] as $subjectId => $item) {
            // Find the pivot record
            $subjectUser = SubjectUser::where('user_id', Auth::id())
                ->where('subject_id', $item['subject_id'])
                ->first();

            // Upload image if provided
            if (isset($item['image']) && $request->hasFile("subjects.{$subjectId}.image")) {

                $fakeRequest = new Request();
                $fakeRequest->files->set('image', $request->file('subjects')[$subjectId]['image']);

                $subjectUser->uploadImage($fakeRequest);
            }
        }

        return redirect()->route('levels.index')->with('success', 'Your Application Has Been Send');
    }
}
