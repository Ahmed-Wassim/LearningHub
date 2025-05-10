@extends('site.layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/home.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/teachers.css') }}" />
@endsection

@section('hero')
    <div class="hero" id="subject-hero">
        <div class="container">
            <h1 id="subject-title">{{ $subject->name }} Teachers</h1>
            <p id="subject-description">
                Browse available teachers for {{ $subject->name }}
            </p>
            <div class="breadcrumbs" id="subject-breadcrumbs">
                <a href="{{ route('levels.index') }}">Levels</a> >
                <a href="{{ route('levels.grades', $level) }}">Grades</a> >
                <a href="{{ route('levels.grades.subjects', [$level->slug, $grade->slug]) }}">Subjects</a> >
                <span id="teachers-breadcrumb">Teachers</span>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container" id="teachers">
        <div class="teacher-grid">
            @forelse ($subjectTeachers as $user_id => $teacherEntries)
                @php
                    $teacherEntry = $teacherEntries->first();
                    $teacher = $teacherEntry->user;
                    $image = $teacherEntry->getImageUrl();
                    $bio = $teacherEntry->bio;
                @endphp

                <div class="teacher-card">
                    <div class="teacher-image">
                        @if ($image)
                            <img src="{{ asset($image) }}" alt="{{ $teacher->name }}" />
                        @else
                            <img src="{{ asset('default/Haha.jpg') }}" alt="{{ $teacher->name }}" />
                        @endif
                    </div>
                    <div class="teacher-content">
                        <h3 class="teacher-name">{{ $teacher->name }}</h3>
                        <p class="teacher-bio">{{ $bio ?? 'No biography available.' }}</p>
                        <div class="teacher-meta">
                            <div class="teacher-subjects">
                                <strong>Experience:</strong> {{ $teacher->experience ?? 'Not specified' }}
                            </div>
                            <div class="teacher-rating">
                                <span class="rating-value">{{ $teacher->rating ?? '4.5' }}</span>
                                <span class="rating-stars">★★★★☆</span>
                            </div>
                        </div>
                        {{-- <a href="{{ route('teachers.show', $teacher->id) }}" class="btn btn-primary">View Profile</a> --}}
                    </div>
                </div>
            @empty
                <div class="no-teachers">
                    <h3>No teachers available for this subject yet</h3>
                    <p>Please check back later or explore other subjects.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
