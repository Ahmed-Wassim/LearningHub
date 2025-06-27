<?php

namespace App\Http\Controllers\Site;

use App\Models\Grade;
use App\Models\Level;
use App\Models\Subject;
use App\Models\SubjectUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubjectUserController extends Controller
{
    public function index(Level $level, Grade $grade, Subject $subject, int $id)
    {

        $subject = SubjectUser::where('id', $id)
            ->where('status', 'approved')
            ->with('lessons', 'image', 'teacher', 'subject')
            ->first();

        // dd($subject);
        return view('site.subject-detail', compact('subject'));
    }
}
