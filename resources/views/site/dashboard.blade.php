<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Teacher Dashboard - LearnHub</title>
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}" />
    <!-- TinyMCE for Rich Text Editor -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.0/tinymce.min.js" referrerpolicy="origin"></script>
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

    <div class="teacher-header">
        <div class="container">
            <h1>Teacher Dashboard</h1>
            <p>Manage your courses and teaching materials</p>
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
                        <span class="stat-value">{{ count($subjects) }}</span>
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
                <a href="#" class="menu-item active">
                    <span class="menu-icon">📊</span>
                    <span>Dashboard</span>
                </a>
                <a href="#" class="menu-item">
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
            <!-- Quick Stats -->
            <div class="stats-container">
                <div class="stat-card">
                    <h3>Total Students</h3>
                    <p class="stat-number">12,543</p>
                    <p class="stat-change positive">+125 this week</p>
                </div>
                <div class="stat-card">
                    <h3>Total Earnings</h3>
                    <p class="stat-number">$34,280</p>
                    <p class="stat-change positive">+$1,200 this month</p>
                </div>
                <div class="stat-card">
                    <h3>Average Rating</h3>
                    <p class="stat-number">4.9</p>
                    <p class="stat-change">+0.1 since last month</p>
                </div>
                <div class="stat-card">
                    <h3>Total Courses</h3>
                    <p class="stat-number">{{ count($subjects) }}</p>
                    <p class="stat-change">1 in progress</p>
                </div>
            </div>

            <!-- Courses Section -->
            <div class="dashboard-section">
                <div class="section-header">
                    <h2>My Courses</h2>
                    <a href="#" class="btn btn-outline" id="createCourseBtn">Create New Course</a>
                </div>

                <div class="courses-grid">
                    @foreach ($subjects as $subject)
                        <div class="course-card">
                            <div class="course-image">
                                <img src="{{ $subject->getImageUrl() }}" alt="Unknown Course" />
                                <span
                                    class="course-status published">{{ $subject->status ? 'published' : 'draft' }}</span>
                            </div>
                            <div class="course-info">
                                <h3>{{ $subject->subject->name }} - {{ $subject->subject->grade->name }}</h3>
                                <p>{{ $subject->bio }}</p>
                                <div class="course-meta">
                                    <span>150 lessons</span>
                                    <span>10,234 students</span>
                                </div>
                                <a href="{{ route('manage-course', [$subject->id]) }}"
                                    class="btn btn-primary manage-course-btn">Manage
                                    Course</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <form action="{{ route('lessons.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <!-- Add Lesson Section -->
                <div class="dashboard-section">
                    <div class="section-header">
                        <h2>Add New Lesson</h2>
                        <div class="course-selector">
                            <label for="course-select">Select Course:</label>
                            <select name="subject_user_id" id="course-select">
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->subject->name }} -
                                        {{ $subject->subject->grade->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="add-lesson-form">
                        <div class="form-group">
                            <label for="lesson-title">Lesson Title:</label>
                            <input name="title" type="text" id="lesson-title"
                                placeholder="Enter lesson title" />
                        </div>

                        <div class="form-group">
                            <label for="lesson-duration">Duration (minutes):</label>
                            <input name="duration" type="number" id="lesson-duration" placeholder="e.g. 15"
                                min="1" />
                        </div>
                        {{--
                        <div class="form-group">
                            <label for="lesson-short-desc">Short Description:</label>
                            <textarea id="lesson-short-desc" rows="3" name="short_description"
                                placeholder="Enter a brief description of this lesson (max 150 characters)"></textarea>
                        </div> --}}

                        <div class="form-group full-width">
                            <label for="lesson-content">Lesson Content:</label>
                            <textarea name="description" id="lesson-content" placeholder="Enter detailed lesson content..."></textarea>
                        </div>

                        <div class="form-section">
                            <h3>Additional Resources</h3>

                            <div class="form-group">
                                <label for="youtube-url">YouTube Video URL:</label>
                                <input type="url" id="youtube-url"
                                    placeholder="https://youtube.com/watch?v=..." />
                            </div>

                            <div class="form-group file-upload">
                                <label>Upload Files:</label>
                                <div class="upload-area">
                                    <div class="upload-box" id="pdf-upload">
                                        <span class="upload-icon">📄</span>
                                        <span>Upload PDF</span>
                                        <input name="pdf_file" type="file" accept=".pdf" />
                                    </div>
                                    <div class="upload-box" id="word-upload">
                                        <span class="upload-icon">📝</span>
                                        <span>Upload Word</span>
                                        <input name="word_file" type="file" accept=".doc,.docx" />
                                    </div>
                                    <div class="upload-box" id="excel-upload">
                                        <span class="upload-icon">📊</span>
                                        <span>Upload Excel</span>
                                        <input name="excel_file" type="file" accept=".xls,.xlsx" />
                                    </div>
                                </div>
                            </div>

                            <div class="uploaded-files">
                                <h4>Uploaded Files:</h4>
                                <ul class="file-list">
                                </ul>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Publish Lesson</button>
                        </div>
                    </div>
                </div>
            </form>
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

    <script>
        // Initialize TinyMCE editor for rich text
        tinymce.init({
            selector: '#lesson-content',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
            height: 400,
        });

        // Add event listener for file deletion buttons (existing files)
        document.querySelectorAll('.delete-file').forEach(button => {
            button.addEventListener('click', function() {
                // Get the parent list item and remove it
                const fileItem = this.closest('.file-item');
                if (fileItem) {
                    fileItem.remove();
                }
            });
        });

        // File upload preview with delete functionality
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
                <button class="btn-icon delete-file">❌</button>
              </span>
            `;

                    fileList.appendChild(newFileItem);

                    // Add event listener to the newly created delete button
                    const deleteButton = newFileItem.querySelector('.delete-file');
                    deleteButton.addEventListener('click', function() {
                        newFileItem.remove();
                    });
                }
            });
        });

        // Create a MutationObserver to watch for dynamically added elements
        const fileListObserver = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.type === 'childList') {
                    // Look for new delete buttons without event listeners
                    mutation.addedNodes.forEach(node => {
                        if (node.nodeType === 1) { // Element node
                            const newDeleteButtons = node.querySelectorAll(
                                '.delete-file:not([data-has-listener])');
                            newDeleteButtons.forEach(button => {
                                button.addEventListener('click', function() {
                                    const fileItem = this.closest('.file-item');
                                    if (fileItem) {
                                        fileItem.remove();
                                    }
                                });
                                // Mark as having a listener
                                button.setAttribute('data-has-listener', 'true');
                            });
                        }
                    });
                }
            });
        });

        // Start observing the file list for added nodes
        const fileList = document.querySelector('.file-list');
        fileListObserver.observe(fileList, {
            childList: true
        });
    </script>
</body>

</html>
