<?php

namespace App\Http\Controllers\Site;

use App\Models\Grade;
use App\Models\Level;
use App\Models\Subject;
use App\Models\SubjectUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubjectTeacherController extends Controller
{
    public function index(Level $level, Grade $grade, Subject $subject)
    {
        $subjectTeachers = SubjectUser::with(['user', 'image'])
            ->where('subject_id', $subject->id)
            ->where('status', 'approved')
            ->get()
            ->groupBy('user_id');

        return view('site.teachers', [
            'level' => $level,
            'grade' => $grade,
            'subject' => $subject,
            'subjectTeachers' => $subjectTeachers,
        ]);
    }
}
