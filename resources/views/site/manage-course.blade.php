<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Manage Course - LearnHub</title>
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}" />
    <!-- TinyMCE for Rich Text Editor -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.0/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://www.youtube.com/iframe_api"></script>
    <style>
        /* Additional styles for manage course page */
        .course-header {
            background-color: #4361ee;
            color: white;
            padding: 30px 0;
            margin-bottom: 30px;
        }

        .course-title {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .course-meta-info {
            display: flex;
            gap: 30px;
            margin-top: 15px;
        }

        .course-meta-item {
            display: flex;
            align-items: center;
        }

        .course-meta-icon {
            margin-right: 8px;
            font-size: 1.2rem;
        }

        .lesson-list {
            margin-bottom: 30px;
        }

        .lesson-item {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
            padding: 20px;
            margin-bottom: 15px;
            display: flex;
            align-items: flex-start;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .lesson-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.12);
        }

        .lesson-number {
            background-color: #4361ee;
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            margin-right: 20px;
            flex-shrink: 0;
        }

        .lesson-content {
            flex: 1;
        }

        .lesson-title {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 10px;
        }

        .lesson-title h3 {
            font-size: 1.2rem;
            margin: 0;
        }

        .lesson-duration {
            background-color: #f0f3ff;
            color: #4361ee;
            padding: 4px 12px;
            border-radius: 4px;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .lesson-description {
            color: #666;
            font-size: 0.95rem;
            margin-bottom: 15px;
            line-height: 1.5;
        }

        .lesson-resources {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 15px;
        }

        .resource-badge {
            display: flex;
            align-items: center;
            padding: 5px 12px;
            border-radius: 4px;
            font-size: 0.85rem;
            background-color: #f5f5f5;
            color: #333;
            text-decoration: none;
            transition: background-color 0.2s ease;
        }

        .resource-badge:hover {
            background-color: #e5e7eb;
        }

        .resource-icon {
            margin-right: 5px;
        }

        .pdf-badge {
            background-color: #fee2e2;
            color: #dc2626;
        }

        .pdf-badge:hover {
            background-color: #fecaca;
        }

        .word-badge {
            background-color: #dbeafe;
            color: #2563eb;
        }

        .word-badge:hover {
            background-color: #bfdbfe;
        }

        .excel-badge {
            background-color: #d1fae5;
            color: #059669;
        }

        .excel-badge:hover {
            background-color: #a7f3d0;
        }

        .video-badge {
            background-color: #fef3c7;
            color: #d97706;
        }

        .video-badge:hover {
            background-color: #fde68a;
        }

        .lesson-actions {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }

        .lesson-actions button {
            padding: 6px 12px;
            font-size: 0.9rem;
        }

        .add-lesson-section {
            margin-top: 40px;
        }

        .tabs {
            display: flex;
            border-bottom: 1px solid #e5e7eb;
            margin-bottom: 30px;
        }

        .tab {
            padding: 12px 25px;
            cursor: pointer;
            font-weight: 500;
            color: #666;
            border-bottom: 3px solid transparent;
            transition: all 0.3s ease;
        }

        .tab:hover {
            color: #4361ee;
        }

        .tab.active {
            color: #4361ee;
            border-bottom-color: #4361ee;
        }

        /* Modal for editing lessons */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            overflow-y: auto;
        }

        .modal-content {
            position: relative;
            background-color: white;
            width: 90%;
            max-width: 800px;
            margin: 50px auto;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .close-modal {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 1.5rem;
            background: none;
            border: none;
            cursor: pointer;
        }

        .modal-title {
            font-size: 1.5rem;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        /* Additional styles for YouTube player */
        .video-preview-container {
            margin-top: 15px;
            width: 100%;
            background-color: #f5f5f5;
            border-radius: 8px;
            overflow: hidden;
        }

        .video-preview {
            width: 100%;
            height: 0;
            padding-bottom: 56.25%;
            /* 16:9 aspect ratio */
            position: relative;
            display: none;
            /* Initially hidden until a video is loaded */
        }

        .video-preview iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }

        .video-play-button {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 8px 15px;
            background-color: #4361ee;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: background-color 0.2s ease;
            margin-right: 8px;
        }

        .video-play-button:hover {
            background-color: #3a51cc;
        }

        .play-icon {
            margin-right: 5px;
        }

        .lesson-video-preview {
            margin-top: 15px;
            width: 100%;
            max-height: 200px;
            overflow: hidden;
            border-radius: 8px;
            display: none;
        }

        .lesson-video-thumbnail {
            width: 100%;
            height: auto;
            position: relative;
            cursor: pointer;
        }

        .lesson-video-thumbnail img {
            width: 100%;
            height: auto;
        }

        .play-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(0, 0, 0, 0.3);
            transition: background-color 0.2s ease;
        }

        .play-overlay:hover {
            background-color: rgba(0, 0, 0, 0.5);
        }

        .play-overlay i {
            font-size: 48px;
            color: white;
        }

        .youtube-video-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            z-index: 2000;
            align-items: center;
            justify-content: center;
        }

        .youtube-modal-content {
            width: 80%;
            max-width: 900px;
            position: relative;
        }

        .youtube-video-container {
            width: 100%;
            padding-bottom: 56.25%;
            position: relative;
        }

        .youtube-video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }

        .close-youtube-modal {
            position: absolute;
            top: -40px;
            right: 0;
            color: white;
            font-size: 30px;
            background: none;
            border: none;
            cursor: pointer;
        }

        .video-badge {
            cursor: pointer;
        }

        .description-container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
            padding: 25px;
            margin-bottom: 30px;
        }

        /* Form styles */
        .form-control {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
            transition: border-color 0.2s;
        }

        .form-control:focus {
            border-color: #4361ee;
            outline: none;
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
        }

        .char-count {
            text-align: right;
            color: #666;
            font-size: 0.85rem;
            margin-top: 5px;
        }

        /* Style for TinyMCE editor */
        .tox-tinymce {
            border-radius: 4px !important;
        }

        /* Button styling */
        #saveDescriptionBtn {
            padding: 8px 16px;
            font-weight: 500;
        }

        /* Alert styling */
        .alert {
            padding: 12px 15px;
            border-radius: 4px;
            margin-top: 15px;
        }

        .alert-success {
            background-color: #d1fae5;
            color: #059669;
            border: 1px solid #a7f3d0;
        }

        .alert-danger {
            background-color: #fee2e2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }

        /* Spinner for loading state */
        .spinner-border {
            display: inline-block;
            width: 1rem;
            height: 1rem;
            vertical-align: text-bottom;
            border: 0.2em solid currentColor;
            border-right-color: transparent;
            border-radius: 50%;
            animation: spinner-border .75s linear infinite;
        }

        @keyframes spinner-border {
            to {
                transform: rotate(360deg);
            }
        }

        @media (max-width: 768px) {
            .lesson-item {
                flex-direction: column;
            }

            .lesson-number {
                margin-bottom: 15px;
            }

            .lesson-title {
                flex-direction: column;
                gap: 10px;
            }

            .course-meta-info {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>

<body>
    <nav>
        <div class="container nav-container">
            <a href="home.html" class="nav-logo">LearnHub</a>

            <div class="search-bar">
                <input type="text" placeholder="Search for courses, topics, or lessons..." />
            </div>

            <div class="nav-links">
                <a href="#">My Courses</a>
                <a href="#">Students</a>
                <a href="#">Messages</a>
                <div class="teacher-profile">
                    <img src="https://placehold.co/40x40" alt="Teacher" />
                    <span>Sarah Johnson</span>
                </div>
            </div>
        </div>
    </nav>

    <div class="course-header">
        <div class="container">
            <div class="course-title">Complete Web Development Bootcamp</div>
            <p>Learn HTML, CSS, JavaScript, React, Node and more</p>

            <div class="course-meta-info">
                <div class="course-meta-item">
                    <span class="course-meta-icon">👨‍👩‍👧‍👦</span>
                    <span>10,234 students enrolled</span>
                </div>
                <div class="course-meta-item">
                    <span class="course-meta-icon">⭐</span>
                    <span>4.9 average rating</span>
                </div>
                <div class="course-meta-item">
                    <span class="course-meta-icon">📚</span>
                    <span>18 Lessons</span>
                </div>
                <div class="course-meta-item">
                    <span class="course-meta-icon">⏱️</span>
                    <span>35 hours total duration</span>
                </div>
            </div>
        </div>
    </div>

    <div class="container dashboard-layout">
        <!-- Sidebar -->
        <div class="dashboard-sidebar">
            <div class="teacher-info">
                <img src="https://placehold.co/120x120" alt="Sarah Johnson" class="teacher-avatar" />
                <h2>Sarah Johnson</h2>
                <p>Senior Web Developer & Instructor</p>
                <div class="teacher-stats">
                    <div class="stat-item">
                        <span class="stat-value">4</span>
                        <span class="stat-label">Courses</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-value">12.5k</span>
                        <span class="stat-label">Students</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-value">4.9</span>
                        <span class="stat-label">Rating</span>
                    </div>
                </div>
            </div>
            <div class="sidebar-menu">
                <a href="#" class="menu-item">
                    <span class="menu-icon">📊</span>
                    <span>Dashboard</span>
                </a>
                <a href="#" class="menu-item active">
                    <span class="menu-icon">📚</span>
                    <span>My Courses</span>
                </a>
                <a href="#" class="menu-item">
                    <span class="menu-icon">👥</span>
                    <span>Students</span>
                </a>
                <a href="#" class="menu-item">
                    <span class="menu-icon">💬</span>
                    <span>Messages</span>
                </a>
                <a href="#" class="menu-item">
                    <span class="menu-icon">📝</span>
                    <span>Reviews</span>
                </a>
                <a href="#" class="menu-item">
                    <span class="menu-icon">💰</span>
                    <span>Earnings</span>
                </a>
                <a href="#" class="menu-item">
                    <span class="menu-icon">⚙️</span>
                    <span>Settings</span>
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="dashboard-main">
            <!-- Tabs -->
            <div class="tabs">
                <div class="tab active">Lessons</div>
                <div class="tab">Students</div>
                <div class="tab">Reviews</div>
                <div class="tab">Settings</div>
            </div>

            <!-- Course Stats -->
            <div class="stats-container">
                <div class="stat-card">
                    <h3>Total Students</h3>
                    <p class="stat-number">10,234</p>
                </div>
                <div class="stat-card">
                    <h3>Total Lessons</h3>
                    <p class="stat-number">{{ count($subject->lessons) }}</p>
                </div>
                <div class="stat-card">
                    <h3>Average Rating</h3>
                    <p class="stat-number">4.9</p>
                </div>
                <div class="stat-card">
                    <h3>Course Earnings</h3>
                    <p class="stat-number">$15,480</p>
                </div>
            </div>

            <!-- Course Description Section -->
            <div class="dashboard-section">
                <div class="section-header">
                    <h2>Course Description</h2>
                    <button class="btn btn-primary" id="saveDescriptionBtn" type="button">Save Changes</button>
                </div>

                <div class="description-container">
                    <form id="courseDescriptionForm">
                        @csrf
                        <input type="hidden" name="subject_id" value="{{ $subject->id }}">

                        <!-- Short Description Field -->
                        <div class="form-group full-width">
                            <label for="course-short-description">Short Description:</label>
                            <input type="text" id="course-short-description" name="short_description"
                                value="{{ $subject->subjectUserDetail->short_description ?? 'Learn HTML, CSS, JavaScript, React, Node and more' }}"
                                placeholder="Enter a brief, compelling description of your course" maxlength="150"
                                class="form-control" />
                            <div class="char-count"><span id="short-desc-count">0</span>/150</div>
                        </div>

                        <!-- Long Description Field with Rich Text Editor -->
                        <div class="form-group full-width">
                            <label for="course-long-description">Detailed Description:</label>
                            <textarea id="course-long-description" name="long_description" class="form-control">{{ $subject->subjectUserDetail->long_description ?? 'This comprehensive web development bootcamp takes you from absolute beginner to professional developer. You\'ll learn HTML, CSS, JavaScript, React, Node.js, Express, MongoDB and more through hands-on projects and real-world applications. By the end of this course, you\'ll have built multiple portfolio-worthy projects and gained the skills needed for a career in web development.' }}</textarea>
                        </div>

                        <!-- Success or error messages -->
                        <div id="description-alert" class="alert" style="display: none;"></div>
                    </form>
                </div>
            </div>

            <!-- Lesson List Section -->
            <div class="dashboard-section">
                <div class="section-header">
                    <h2>Course Lessons</h2>
                    <a href="{{ route('lessons.store') }}" class="btn btn-primary" id="addLessonBtn">Add New
                        Lesson</a>
                </div>

                <div class="lesson-list">
                    @foreach ($subject->lessons as $lesson)
                        <!-- Lesson 1 -->
                        <div class="lesson-item">
                            <div class="lesson-number">{{ $loop->iteration }}</div>
                            <div class="lesson-content">
                                <div class="lesson-title">
                                    <h3>{{ $lesson->title }}</h3>
                                    <span class="lesson-duration">{{ $lesson->duration }} mins</span>
                                </div>
                                <div class="lesson-description">
                                    {{ Str::words($lesson->description, 20) }}
                                </div>
                                <div class="lesson-resources">
                                    @if ($lesson->resource && $lesson->resource->pdf)
                                        <a href="{{ route('download-resource', ['path' => $lesson->resource->pdf]) }}"
                                            class="resource-badge pdf-badge">
                                            <span class="resource-icon">📄</span>
                                            <span>Course Outline.pdf</span>
                                        </a>
                                    @endif
                                    @if ($lesson->resource && $lesson->resource->word)
                                        <a href="{{ route('download-resource', ['path' => $lesson->resource->word]) }}"
                                            class="resource-badge word-badge">
                                            <span class="resource-icon">📝</span>
                                            <span>Reading Notes.docx</span>
                                        </a>
                                    @endif
                                    @if ($lesson->resource && $lesson->resource->video)
                                        <a href="#" class="resource-badge video-badge">
                                            <span class="resource-icon">🎬</span>
                                            <span>Introduction Video</span>
                                        </a>
                                    @endif
                                </div>
                                <div class="lesson-actions">
                                    <button class="btn btn-outline edit-lesson-btn" data-lesson-id="1">Edit</button>
                                    <button class="btn btn-outline delete-lesson-btn">Delete</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Lesson Modal -->
    <div id="editLessonModal" class="modal">
        <div class="modal-content">
            <button class="close-modal">&times;</button>
            <h2 class="modal-title">Edit Lesson</h2>

            <div class="add-lesson-form">
                <div class="form-group">
                    <label for="edit-lesson-title">Lesson Title:</label>
                    <input type="text" id="edit-lesson-title"
                        value="JavaScript Basics: Variables, Data Types, and Functions" />
                </div>

                <div class="form-group">
                    <label for="edit-lesson-duration">Duration (minutes):</label>
                    <input type="number" id="edit-lesson-duration" value="120" min="1" />
                </div>

                <div class="form-group full-width">
                    <label for="edit-lesson-description">Description:</label>
                    <textarea id="edit-lesson-description" rows="3">Introduction to JavaScript programming language, including variables, data types, operators, and functions.</textarea>
                </div>

                <div class="form-group full-width">
                    <label for="edit-lesson-content">Lesson Content:</label>
                    <textarea id="edit-lesson-content"></textarea>
                </div>

                <div class="form-section">
                    <h3>Resources</h3>

                    <div class="form-group">
                        <label for="edit-youtube-url">YouTube Video URL:</label>
                        <input type="url" id="edit-youtube-url" value="https://youtube.com/watch?v=abcdef123" />
                    </div>

                    <div class="form-group file-upload">
                        <label>Upload Files:</label>
                        <div class="upload-area">
                            <div class="upload-box" id="edit-pdf-upload">
                                <span class="upload-icon">📄</span>
                                <span>Upload PDF</span>
                                <input type="file" accept=".pdf" />
                            </div>
                            <div class="upload-box" id="edit-word-upload">
                                <span class="upload-icon">📝</span>
                                <span>Upload Word</span>
                                <input type="file" accept=".doc,.docx" />
                            </div>
                            <div class="upload-box" id="edit-excel-upload">
                                <span class="upload-icon">📊</span>
                                <span>Upload Excel</span>
                                <input type="file" accept=".xls,.xlsx" />
                            </div>
                        </div>
                    </div>

                    <div class="uploaded-files">
                        <h4>Current Resources:</h4>
                        <ul class="file-list">
                            <li class="file-item">
                                <span class="file-icon">📄</span>
                                <span class="file-name">JS Fundamentals.pdf</span>
                                <span class="file-actions">
                                    <button class="btn-icon">📋</button>
                                    <button class="btn-icon">❌</button>
                                </span>
                            </li>
                            <li class="file-item">
                                <span class="file-icon">📝</span>
                                <span class="file-name">Practice Exercises.docx</span>
                                <span class="file-actions">
                                    <button class="btn-icon">📋</button>
                                    <button class="btn-icon">❌</button>
                                </span>
                            </li>
                            <li class="file-item">
                                <span class="file-icon">🎬</span>
                                <span class="file-name">JavaScript Introduction (YouTube)</span>
                                <span class="file-actions">
                                    <button class="btn-icon">📋</button>
                                    <button class="btn-icon">❌</button>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="form-actions">
                    <button class="btn btn-outline">Cancel</button>
                    <button class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="container footer-container">
            <div class="footer-section">
                <h3>LearnHub</h3>
                <p>Quality education accessible to everyone, anywhere, anytime.</p>
            </div>

            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="#">My Courses</a></li>
                    <li><a href="#">Students</a></li>
                    <li><a href="#">Settings</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h3>Help & Support</h3>
                <ul>
                    <li><a href="#">Teaching Center</a></li>
                    <li><a href="#">Contact Support</a></li>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Community</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h3>Contact Us</h3>
                <ul>
                    <li>Email: support@learnhub.com</li>
                    <li>Phone: 01018060199</li>
                    <li>Address: Mansoura, Egypt</li>
                </ul>
            </div>
        </div>

        <div class="container copyright">
            <p>&copy; 2025 LearnHub. All rights reserved.</p>
        </div>
    </footer>

    <!-- Edit Lesson Modal (with additional YouTube preview) -->
    <div id="editLessonModal" class="modal">
        <div class="modal-content">
            <button class="close-modal">&times;</button>
            <h2 class="modal-title">Edit Lesson</h2>

            <div class="add-lesson-form">
                <!-- Existing form content -->

                <div class="form-section">
                    <h3>Resources</h3>

                    <div class="form-group">
                        <label for="edit-youtube-url">YouTube Video URL:</label>
                        <div style="display: flex; gap: 10px;">
                            <input type="url" id="edit-youtube-url" value="https://youtube.com/watch?v=abcdef123"
                                style="flex: 1;" />
                            <button id="preview-youtube-btn" class="video-play-button">
                                <span class="play-icon">▶️</span>
                                <span>Preview</span>
                            </button>
                        </div>

                        <!-- YouTube video preview container -->
                        <div class="video-preview-container">
                            <div class="video-preview" id="youtube-preview"></div>
                        </div>
                    </div>

                    <!-- Rest of the existing form content -->
                </div>

                <!-- Existing form actions -->
            </div>
        </div>
    </div>

    <!-- YouTube Video Modal (for fullscreen viewing) -->
    <div id="youtubeVideoModal" class="youtube-video-modal">
        <div class="youtube-modal-content">
            <button class="close-youtube-modal">&times;</button>
            <div class="youtube-video-container">
                <iframe id="youtube-modal-iframe" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
    </div>


    <script>
        // Initialize TinyMCE editor for rich text
        tinymce.init({
            selector: '#edit-lesson-content',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
            height: 300,
        });

        // Modal functionality
        const modal = document.getElementById('editLessonModal');
        const editBtns = document.querySelectorAll('.edit-lesson-btn');
        const closeModal = document.querySelector('.close-modal');
        const cancelBtn = document.querySelector('.form-actions .btn-outline');

        // Open modal when edit button is clicked
        editBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const lessonId = this.getAttribute('data-lesson-id');
                // Here you would fetch the lesson data based on the ID
                // For now, we'll just show the modal
                modal.style.display = 'block';
            });
        });

        // Close modal functions
        function closeModalFunc() {
            modal.style.display = 'none';
        }

        closeModal.addEventListener('click', closeModalFunc);
        cancelBtn.addEventListener('click', closeModalFunc);

        // Close modal when clicking outside
        window.addEventListener('click', function(event) {
            if (event.target === modal) {
                closeModalFunc();
            }
        });

        // Add lesson button - would open a similar modal but empty
        document.getElementById('addLessonBtn').addEventListener('click', function(e) {
            e.preventDefault();
            // For now, we'll just show the edit modal as an example
            modal.style.display = 'block';
        });

        // Delete lesson confirmation
        document.querySelectorAll('.delete-lesson-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                if (confirm('Are you sure you want to delete this lesson? This action cannot be undone.')) {
                    // Delete action would go here
                    console.log('Lesson deleted');
                }
            });
        });

        // File upload preview
        document.querySelectorAll('.upload-box input[type="file"]').forEach(input => {
            input.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const fileType = this.getAttribute('accept');
                    const fileName = this.files[0].name;

                    // Create new file item
                    const fileList = document.querySelector('.file-list');
                    const newFileItem = document.createElement('li');
                    newFileItem.className = 'file-item';

                    let fileIcon = '📄';
                    if (fileType.includes('doc')) fileIcon = '📝';
                    else if (fileType.includes('xls')) fileIcon = '📊';

                    newFileItem.innerHTML = `
              <span class="file-icon">${fileIcon}</span>
              <span class="file-name">${fileName}</span>
              <span class="file-actions">
                <button class="btn-icon">📋</button>
                <button class="btn-icon">❌</button>
              </span>
            `;

                    fileList.appendChild(newFileItem);
                }
            });
        });
    </script>
    <script>
        // YouTube API related variables
        let youtubePlayer;
        let youtubeModalPlayer;

        // Function to extract YouTube video ID from URL
        function getYouTubeVideoId(url) {
            if (!url) return null;

            // Handle different YouTube URL formats
            const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/;
            const match = url.match(regExp);

            return (match && match[2].length === 11) ? match[2] : null;
        }

        // Initialize YouTube API
        function onYouTubeIframeAPIReady() {
            // We'll create players as needed
            console.log('YouTube API Ready');
        }

        // Create YouTube preview player in edit modal
        function createYouTubePreviewPlayer(videoId) {
            const previewContainer = document.getElementById('youtube-preview');

            // Destroy existing player if any
            if (youtubePlayer) {
                youtubePlayer.destroy();
                youtubePlayer = null;
            }

            // Show preview container
            previewContainer.style.display = 'block';

            // Create new player
            youtubePlayer = new YT.Player('youtube-preview', {
                height: '100%',
                width: '100%',
                videoId: videoId,
                playerVars: {
                    'autoplay': 0,
                    'controls': 1,
                    'modestbranding': 1,
                    'rel': 0
                }
            });
        }

        // Initialize TinyMCE for long description
        tinymce.init({
            selector: '#course-long-description',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
            height: 300,
        });

        // Character count for short description
        const shortDescInput = document.getElementById('course-short-description');
        const shortDescCount = document.getElementById('short-desc-count');

        // Update character count on load
        shortDescCount.textContent = shortDescInput.value.length;

        // Update character count on input
        shortDescInput.addEventListener('input', function() {
            shortDescCount.textContent = this.value.length;
        });

        // Save description form functionality
        document.getElementById('saveDescriptionBtn').addEventListener('click', function() {
            const form = document.getElementById('courseDescriptionForm');
            const formData = new FormData(form);

            // Get the TinyMCE content and add it to the form data
            formData.set('long_description', tinymce.get('course-long-description').getContent());

            // Show loading state
            this.disabled = true;
            this.innerHTML =
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...';

            // AJAX request to save the description
            fetch('{{ route('course-description.store', $subject->id) }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    }
                })
                .then(response => response.json())
                .then(data => {
                    // Reset button state
                    this.disabled = false;
                    this.textContent = 'Save Changes';

                    // Show success message
                    const alertBox = document.getElementById('description-alert');
                    alertBox.className = data.success ? 'alert alert-success' : 'alert alert-danger';
                    alertBox.textContent = data.message;
                    alertBox.style.display = 'block';

                    // Hide the alert after 3 seconds
                    setTimeout(() => {
                        alertBox.style.display = 'none';
                    }, 30000);
                })
                .catch(error => {
                    console.error('Error:', error);

                    // Reset button state
                    this.disabled = false;
                    this.textContent = 'Save Changes';

                    // Show error message
                    const alertBox = document.getElementById('description-alert');
                    alertBox.className = 'alert alert-danger';
                    alertBox.textContent = 'An error occurred while saving the description. Please try again.';
                    alertBox.style.display = 'block';
                });
        });

        // Create YouTube modal player for fullscreen viewing
        function createYouTubeModalPlayer(videoId) {
            const modal = document.getElementById('youtubeVideoModal');
            const iframe = document.getElementById('youtube-modal-iframe');

            // Set the iframe src with YouTube embed URL
            iframe.src = `https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0`;

            // Show modal
            modal.style.display = 'flex';
        }

        // Generate YouTube video thumbnail URL
        function getYouTubeThumbnailUrl(videoId) {
            return `https://img.youtube.com/vi/${videoId}/hqdefault.jpg`;
        }

        // Add YouTube thumbnail and play button to lesson
        function addYouTubeThumbnailToLesson(lessonElement, videoId) {
            // Create video preview container if it doesn't exist
            let previewContainer = lessonElement.querySelector('.lesson-video-preview');
            if (!previewContainer) {
                previewContainer = document.createElement('div');
                previewContainer.className = 'lesson-video-preview';
                lessonElement.querySelector('.lesson-content').appendChild(previewContainer);
            }

            // Add thumbnail with play overlay
            previewContainer.innerHTML = `
          <div class="lesson-video-thumbnail" data-video-id="${videoId}">
            <img src="${getYouTubeThumbnailUrl(videoId)}" alt="Video Thumbnail">
            <div class="play-overlay">
              <i>▶️</i>
            </div>
          </div>
        `;

            // Show the container
            previewContainer.style.display = 'block';

            // Add click event to play the video
            previewContainer.querySelector('.lesson-video-thumbnail').addEventListener('click', function() {
                const videoId = this.getAttribute('data-video-id');
                createYouTubeModalPlayer(videoId);
            });
        }

        // Document ready function
        document.addEventListener('DOMContentLoaded', function() {
            // Make sure the YouTube modal is hidden initially
            document.getElementById('youtubeVideoModal').style.display = 'none';

            // Existing initialization code from your script

            // Add YouTube preview functionality
            document.getElementById('preview-youtube-btn').addEventListener('click', function() {
                const youtubeUrl = document.getElementById('edit-youtube-url').value;
                const videoId = getYouTubeVideoId(youtubeUrl);

                if (videoId) {
                    createYouTubePreviewPlayer(videoId);
                } else {
                    alert('Please enter a valid YouTube URL');
                }
            });

            // Close YouTube modal when close button is clicked
            document.querySelector('.close-youtube-modal').addEventListener('click', function() {
                document.getElementById('youtubeVideoModal').style.display = 'none';
                document.getElementById('youtube-modal-iframe').src = '';
            });

            // Close YouTube modal when clicking outside the video
            document.getElementById('youtubeVideoModal').addEventListener('click', function(event) {
                if (event.target === this) {
                    this.style.display = 'none';
                    document.getElementById('youtube-modal-iframe').src = '';
                }
            });

            // Add click event to video badges
            document.querySelectorAll('.video-badge').forEach(badge => {
                badge.addEventListener('click', function(e) {
                    e.preventDefault();
                    // In a real application, you would get the actual video ID from your backend
                    // For demo purposes, we'll use a sample video ID
                    const sampleVideoId = 'dQw4w9WgXcQ'; // Example video ID
                    createYouTubeModalPlayer(sampleVideoId);
                });
            });

            // Initialize video previews for existing lessons with videos
            // This would typically come from your backend data
            // For demo purposes, we'll add thumbnails to lessons that have video badges
            document.querySelectorAll('.lesson-item').forEach(lesson => {
                const hasVideo = lesson.querySelector('.video-badge');
                if (hasVideo) {
                    // In a real application, you would get the actual video ID from your backend
                    // For demo purposes, we'll use sample video IDs
                    const sampleVideoIds = ['dQw4w9WgXcQ', '9bZkp7q19f0', 'fJ9rUzIMcZQ'];
                    const randomId = sampleVideoIds[Math.floor(Math.random() * sampleVideoIds.length)];
                    addYouTubeThumbnailToLesson(lesson, randomId);
                }
            });
        });
    </script>
</body>

</html>
