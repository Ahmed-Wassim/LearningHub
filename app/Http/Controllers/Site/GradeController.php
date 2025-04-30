<?php

namespace App\Http\Controllers\Site;

use App\Models\Grade;
use App\Models\Level;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GradeController extends Controller
{
    public function index(Level $level)
    {
        $level->load('grades')->loadCount('grades');

        return view('site.grades', compact('level'));
    }
}
