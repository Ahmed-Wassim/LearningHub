<?php

namespace App\Http\Controllers\Site;

use App\Models\Level;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LevelController extends Controller
{
    public function index()
    {
        $levels = Level::withCount('grades')->get();

        return view('site.levels', compact('levels'));
    }
}
