<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Complete Web Development Bootcamp - LearnHub</title>
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/course-detail.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/lesson.css') }}" />
</head>

<body>
    <nav>
        <div class="container nav-container">
            <a href="home.html" class="nav-logo">LearnHub</a>

            <div class="search-bar">
                <input type="text" placeholder="Search for courses, topics, or instructors..." />
            </div>

            <div class="nav-links">
                <a href="{{ route('levels.index') }}">Courses</a>
                <a href="#">Categories</a>
                <a href="#">About</a>
                <a href="{{ route('login.index') }}" class="btn btn-outline">Login</a>
            </div>
        </div>
    </nav>

    <div class="course-header">
        <div class="container">
            <h1>{{ $subject->subject->name }} - {{ $subject->teacher->name }}</h1>
            <p>
                {{ $subject->bio }}
            </p>
            <div class="course-header-meta">
                <span class="course-rating">★★★★★ (4.9)</span>
                <span class="course-students">Over 10,000 students enrolled</span>
            </div>
        </div>
    </div>

    <div class="container course-details">
        <div class="course-main">
            <div class="course-description">
                <h2>About This Course</h2>
                {!! $subject->subjectUserDetail->short_description ?? '' !!}

                <h3>What You'll Learn</h3>
                <ul>
                    {!! $subject->subjectUserDetail->long_description ?? '' !!}
                </ul>
            </div>

            <div class="course-tabs">
                <div class="course-tab active" onclick="switchTab('curriculum')">
                    Curriculum
                </div>
                <div class="course-tab" onclick="switchTab('reviews')">Reviews</div>
                <div class="course-tab" onclick="switchTab('faq')">FAQ</div>
            </div>

            <div class="tab-content">
                <div class="tab-pane active" id="curriculum">
                    <h3>Course Content</h3>
                    <p>{{ count($subject->lessons) }} Lessons • 40 Hours of Video</p>

                    <div class="lesson-list">
                        @foreach ($subject->lessons as $lesson)
                            <div class="lesson-item">
                                <div class="lesson-info">
                                    <span class="lesson-number">{{ $loop->iteration }}</span>
                                    <span class="lesson-title">{{ $lesson->title }}</span>
                                    <span class="lesson-duration">{{ $lesson->duration }} mins</span>
                                </div>
                                <div class="lesson-status locked">🔒</div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="tab-pane" id="reviews">
                    <h3>Student Reviews</h3>
                    <p>Average Rating: ★★★★★ (4.9) based on 2,450 reviews</p>

                    <div class="review">
                        <div class="review-header">
                            <div class="reviewer">
                                <img src="https://placehold.co/50x50" alt="Reviewer" />
                                <div>
                                    <h4>John Smith</h4>
                                    <span>2 months ago</span>
                                </div>
                            </div>
                            <div class="review-rating">★★★★★</div>
                        </div>
                        <p>
                            This course completely transformed my career. I went from
                            knowing almost nothing about web development to landing a junior
                            developer job in just 4 months. Sarah is an amazing instructor
                            who explains complex concepts in a way that's easy to
                            understand. The projects are challenging but incredibly
                            rewarding.
                        </p>
                    </div>

                    <div class="review">
                        <div class="review-header">
                            <div class="reviewer">
                                <img src="https://placehold.co/50x50" alt="Reviewer" />
                                <div>
                                    <h4>Mary Johnson</h4>
                                    <span>1 month ago</span>
                                </div>
                            </div>
                            <div class="review-rating">★★★★★</div>
                        </div>
                        <p>
                            As someone with no technical background, I was worried this
                            course might be too advanced for me. I was pleasantly surprised
                            by how well the instructor breaks down complex topics into
                            manageable pieces. The step-by-step approach helped me build
                            confidence as I progressed through the material.
                        </p>
                    </div>

                    <div class="review">
                        <div class="review-header">
                            <div class="reviewer">
                                <img src="https://placehold.co/50x50" alt="Reviewer" />
                                <div>
                                    <h4>David Wilson</h4>
                                    <span>3 months ago</span>
                                </div>
                            </div>
                            <div class="review-rating">★★★★☆</div>
                        </div>
                        <p>
                            Great course overall with excellent projects that really
                            reinforced what I learned. The only reason I'm giving 4 stars
                            instead of 5 is that some of the Node.js content could use
                            updating to reflect the latest best practices. Otherwise, it's a
                            fantastic resource for anyone looking to become a full-stack
                            developer.
                        </p>
                    </div>
                </div>

                <div class="tab-pane" id="faq">
                    <h3>Frequently Asked Questions</h3>

                    <div class="faq-item">
                        <h4>Do I need prior programming experience for this course?</h4>
                        <p>
                            No, this course is designed for complete beginners. We start
                            with the fundamentals and gradually build up to more advanced
                            concepts. If you're already familiar with some programming
                            concepts, you can skip ahead to the sections that interest you.
                        </p>
                    </div>

                    <div class="faq-item">
                        <h4>How long will I have access to the course materials?</h4>
                        <p>
                            Once enrolled, you have lifetime access to all course content,
                            including future updates and additions.
                        </p>
                    </div>

                    <div class="faq-item">
                        <h4>Can I get a certificate after completing the course?</h4>
                        <p>
                            Yes, upon completion of all course modules, you'll receive a
                            certificate of completion that you can add to your resume or
                            LinkedIn profile.
                        </p>
                    </div>

                    <div class="faq-item">
                        <h4>What if I have questions while taking the course?</h4>
                        <p>
                            You can post your questions in the course discussion forum where
                            both the instructor and other students can provide help. The
                            instructor typically responds within 24-48 hours.
                        </p>
                    </div>

                    <div class="faq-item">
                        <h4>Are the projects in this course useful for my portfolio?</h4>
                        <p>
                            Absolutely! The course includes 12 real-world projects that you
                            can customize and add to your portfolio. These projects
                            demonstrate a range of skills from frontend to backend
                            development.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="course-sidebar">
            <div class="sidebar-content">
                <img src="{{ $subject->getImageUrl() }}" alt="Course Preview"
                    style="width: 100%; border-radius: 8px; margin-bottom: 20px" />

                <div class="course-price">
                    <h3>{{ $subject->price }} EGP</h3>
                    {{-- <p><s>$189.99</s> 53% off</p> --}}
                </div>

                <a href="{{ route('payment.checkout', $subject->id) }}" class="btn btn-primary enroll-btn">Enroll
                    Now</a>

                <div class="course-includes" style="margin-top: 20px">
                    <h4>This Course Includes:</h4>
                    <ul style="list-style: none; margin: 15px 0">
                        <li class="course-info-item">
                            <span>40 hours on-demand video</span>
                        </li>
                        <li class="course-info-item">
                            <span>30 lessons</span>
                        </li>
                        <li class="course-info-item">
                            <span>12 downloadable resources</span>
                        </li>
                        <li class="course-info-item">
                            <span>Full lifetime access</span>
                        </li>
                        <li class="course-info-item">
                            <span>Certificate of completion</span>
                        </li>
                    </ul>
                </div>

                <div class="instructor-card">
                    <img class="instructor-avatar" src="https://placehold.co/60x60" alt="Instructor" />
                    <div class="instructor-info">
                        <h4>Sarah Johnson</h4>
                        <p>Senior Web Developer & Instructor</p>
                    </div>
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
                    <li><a href="home.html">Home</a></li>
                    <li><a href="#">Courses</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h3>Categories</h3>
                <ul>
                    <li><a href="#">Development</a></li>
                    <li><a href="#">Business</a></li>
                    <li><a href="#">Marketing</a></li>
                    <li><a href="#">Design</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h3>Contact Us</h3>
                <ul>
                    <li>Email: kholudayman.132004123a@gmail.com</li>
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
        function switchTab(tabId) {
            // Hide all tab panes
            const tabPanes = document.querySelectorAll(".tab-pane");
            tabPanes.forEach((pane) => {
                pane.classList.remove("active");
            });

            // Deactivate all tabs
            const tabs = document.querySelectorAll(".course-tab");
            tabs.forEach((tab) => {
                tab.classList.remove("active");
            });

            // Activate the selected tab and tab pane
            document.getElementById(tabId).classList.add("active");
            event.target.classList.add("active");
        }
    </script>
</body>

</html>
