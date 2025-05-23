<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Level;

class SubjectController extends Controller
{
    public function index(Level $level, Grade $grade)
    {
        $grade->load('subjects');
        return view('site.subjects', compact('grade', 'level'));
    }
}
