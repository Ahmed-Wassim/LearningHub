<?php

namespace App\Http\Controllers\Site;

use App\Models\Lesson;
use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class LessonController extends Controller
{
    public function store(Request $request)
    {
        $lesson = Lesson::create([
            'subject_user_id' => $request->input('subject_user_id'),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'duration' => $request->input('duration'),
        ]);

        $resourceData = [];

        if ($request->hasFile('pdf_file')) {
            $pdfPath = $request->file('pdf_file')->store('lessons/pdf', 'public');
            $resourceData['pdf'] = $pdfPath;
        }

        if ($request->hasFile('word_file')) {
            $wordPath = $request->file('word_file')->store('lessons/word', 'public');
            $resourceData['word'] = $wordPath;
        }

        if ($request->hasFile('excel_file')) {
            $excelPath = $request->file('excel_file')->store('lessons/excel', 'public');
            $resourceData['excel'] = $excelPath;
        }

        if ($request->filled('video_url')) {
            $resourceData['video'] = $request->input('video');
        }


        if (!empty($resourceData)) {
            $resourceData['lesson_id'] = $lesson->id;
            $lesson->resource()->create($resourceData);
            // Resource::create($resourceData);
        }

        return redirect()->route('teacher.dashboard')
            ->with('success', 'Lesson created successfully!');
    }

    public function download(Request $request)
    {
        $filePath = $request->query('path');

        if (!$filePath || !Storage::disk('public')->exists($filePath)) {
            abort(404, 'File not found.');
        }

        return Storage::disk('public')->download($filePath);
    }
}

