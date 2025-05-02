@extends('site.layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('/assets/css/grades.css') }}" />
@endsection

@section('title')
    {{ $level->name }} - LearnHub
@endsection

@section('hero')
    <div class="hero">
        <div class="container">
            <h1>{{ $level->name }}</h1>
            <p>
                Foundational learning experiences designed for students in grades 1 -
                {{ $level->grades_count }}
            </p>
            <div class="breadcrumbs">
                <a href="education-levels.html">Education Levels</a> > {{ $level->name }}
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container" id="grades">
        <div class="grades-grid">
            @foreach ($level->grades as $grade)
                <!-- Grade 1 -->
                <div class="grade-card" onclick="window.location.href='grade-courses.html?level=primary&grade=1'">
                    <div class="grade-content">
                        <h3 class="grade-title">Grade {{ $loop->iteration }}</h3>
                        <ul class="grade-subjects">
                            <li>Mathematics</li>
                            <li>Science</li>
                            <li>Language Arts</li>
                            <li>Social Studies</li>
                        </ul>
                        <a href="{{ route('levels.grades.subjects', [$level->slug, $grade->slug]) }}"
                            class="btn btn-primary grade-btn">Browse
                            Courses</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
