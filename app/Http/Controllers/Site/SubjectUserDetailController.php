<?php

namespace App\Http\Controllers\Site;

use App\Models\Subject;
use Illuminate\Http\Request;
use App\Models\SubjectUserDetail;
use App\Http\Controllers\Controller;
use App\Models\SubjectUser;

class SubjectUserDetailController extends Controller
{
    public function store(Request $request, string $id)
    {

        $subject = SubjectUser::findOrFail($id);
        // Validate the request
        $validated = $request->validate([
            'short_description' => 'required|string|max:150',
            'long_description' => 'required|string',
        ]);

        // Find or create the subject user detail
        $subjectDetail = SubjectUserDetail::updateOrCreate(
            ['subject_user_id' => $subject->id],
            [
                'short_description' => $validated['short_description'],
                'long_description' => $validated['long_description'],
            ]
        );



        // Return a success response
        return response()->json([
            'success' => true,
            'message' => 'Course description updated successfully',
            'data' => [
                'short_description' => $subjectDetail->short_description,
                'long_description' => $subjectDetail->long_description,
            ]
        ]);
    }
}
