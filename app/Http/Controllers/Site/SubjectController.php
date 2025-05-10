<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Level;

class SubjectController extends Controller
{
    public function index(Level $level, Grade $grade)
    {
        $grade->load([
            'subjects.teachers' => function ($query) {
                $query->where('status', 'approved');
            }
        ]);

        return view('site.subjects', compact('grade', 'level'));
    }
}
