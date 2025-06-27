<?php

namespace App\Http\Controllers\Site;

use App\Models\SubjectUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $subjects = SubjectUser::with(['teacher', 'subject.grade', 'image'])
            ->where("user_id", Auth::user()->id)
            ->where('status', 'approved')
            ->get();

        return view('site.dashboard', compact('subjects'));
    }

    public function manageSubject(int $id)
    {

        $subject = SubjectUser::where('id', $id)
            ->where('status', 'approved')
            ->with(['lessons.resource', 'subjectUserDetail'])
            ->first();


        // dd($subject);
        return view('site.manage-course', compact('subject'));
    }
}
