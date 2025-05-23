@extends('site.layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/home.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/grade-courses.css') }}" />
@endsection

@section('hero')
    <div class="hero" id="grade-hero">
        <div class="container">
            <h1 id="grade-title">Subjects</h1>
            <p id="grade-description">
                Browse available courses for your selected grade
            </p>
            <div class="breadcrumbs" id="grade-breadcrumbs">
                <a href="{{ route('levels.index') }}">Levels</a> >
                <a href="{{ route('levels.grades', $level) }}" id="level-link">Grades</a> >
                <span id="grade-breadcrumb">Subjects</span>
            </div>
        </div>
    </div>
@endsection


@section('content')
    <div class="container" id="courses">
        <div class="filter-section">
            <div class="filter-options">
                <select id="subject-filter">
                    <option value="all">All Subjects</option>
                    <option value="math">Mathematics</option>
                    <option value="science">Science</option>
                    <option value="language">Language Arts</option>
                    <option value="social">Social Studies</option>
                </select>
                <select id="sort-filter">
                    <option value="popular">Most Popular</option>
                    <option value="newest">Newest</option>
                    <option value="price-low">Price: Low to High</option>
                    <option value="price-high">Price: High to Low</option>
                </select>
            </div>
        </div>

        <div class="course-grid" id="grade-courses">
            <!-- Course cards will be added dynamically -->

            @foreach ($grade->subjects as $subject)
                <div class="course-card" onclick="window.location.href='lesson-course.html'">
                    <div class="course-image">
                        <img src="{{ $subject->getImageUrl() }}" alt="Mathematics Course" />
                    </div>
                    <div class="course-content">
                        <span class="course-category">Teachers</span>
                        <h3 class="course-title">{{ $subject->name }}</h3>
                        <p>
                            Explore foundational concepts through engaging activities that develop critical thinking across
                            diverse academic disciplines.
                        </p>
                        <div class="course-meta">
                            {{-- <div class="course-author">
                            <span>2000 EG</span>
                        </div> --}}
                            <div class="course-rating">15 Hours</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
