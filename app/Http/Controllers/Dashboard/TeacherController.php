<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\SubjectUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = SubjectUser::with(['user', 'subject', 'image'])
            ->where('status', 'approved')
            ->get()
            ->groupBy('user_id');  // Group by teacher ID


        return view('dashboard.teachers.approved-teachers', compact('teachers'));
    }
    public function pending()
    {
        $teachers = SubjectUser::with(['user', 'subject', 'image'])
            ->where('status', 'pending')
            ->get();

        $pendingTeachers = $teachers->groupBy('user_id');
        return view('dashboard.teachers.pending-teaachers', compact('pendingTeachers'));
    }

    public function approve($id)
    {
        try {
            $user = User::findOrFail($id);

            $user->assignRole('teacher');

            SubjectUser::where('user_id', $id)
                ->where('status', 'pending')
                ->update(['status' => 'approved']);

            return redirect()->back()->with('success', 'All requests for this teacher approved!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Bulk approval failed: ' . $e->getMessage());
        }
    }

    public function reject($id)
    {
        try {
            SubjectUser::where('user_id', $id)
                ->where('status', 'pending')
                ->update(['status' => 'rejected']);

            return redirect()->back()->with('success', 'All requests for this teacher rejected!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Bulk rejection failed: ' . $e->getMessage());
        }
    }
}
