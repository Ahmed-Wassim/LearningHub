@extends('site.layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('/assets/css/levels.css') }}" />
@endsection

@section('title')
    LearnHub - Online Learning Platform
@endsection

@section('hero')
    <div class="hero">
        <div class="container">
            <h1>Choose Your Education Level</h1>
            <p>
                Access specialized courses designed for different education levels
            </p>
        </div>
    </div>
@endsection

@section('content')
    <div class="container" id="education-levels">
        <div class="levels-grid">
            @foreach ($levels as $level)
                <div class="level-card" onclick="window.location.href='{{ route('levels.grades', $level->slug) }}'">
                    <div class="level-image">
                        <img src="{{ $level->image ? asset('storage/' . $level->image) : asset('default/school.jpg') }}"
                            alt="Primary School" />
                    </div>
                    <div class="level-content">
                        <h3 class="level-title">{{ $level->name }}</h3>
                        <p>
                            {{ $level->description }}
                        </p>
                        <div class="level-info">
                            <span>{{ $level->grades_count }} Grades</span>
                            <span>Ages {{ $level->min_age }}-{{ $level->max_age }}</span>
                        </div>
                        <a href="{{ route('levels.grades', $level->slug) }}" class="btn btn-primary level-btn">View
                            Grades</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
