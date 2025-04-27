<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LearnHub - Online Learning Platform</title>
    <link rel="stylesheet" href="{{ asset('/assets/css/styles.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/css/home.css') }}" />
</head>

<body>
    <nav>
        <div class="container nav-container">
            <a href="home.html" class="nav-logo">LearnHub</a>

            <div class="search-bar">
                <input type="text" placeholder="Search for courses, topics, or instructors..." />
            </div>

            <div class="nav-links">
                <a href="#">Courses</a>
                <a href="#">Categories</a>
                <a href="#">About</a>
                @auth
                    {{-- <a href="{{ route('dashboard.index') }}" class="btn btn-outline">Dashboard</a> --}}
                @endauth
                @guest
                    <a href="{{ route('login.index') }}" class="btn btn-outline">Login</a>
                @endguest
            </div>
        </div>
    </nav>

    <div class="hero">
        <div class="container">
            <h1>Learn Without Limits</h1>
            <p>
                Access over 1,000 courses taught by industry experts. Start learning
                today!
            </p>
            <a href="#courses" class="btn btn-outline">Browse Courses</a>
        </div>
    </div>

    <div class="container" id="courses">
        <div class="courses-heading">
            <h2>Popular Courses</h2>
            <p>Explore our most sought-after courses across various categories</p>
        </div>

        <div class="course-grid">
            <!-- Course Card 1 -->
            <div class="course-card" onclick="window.location.href='course-detail.html'">
                <div class="course-image">
                    <img src="./images/web.webp" alt="Web Development Course" />
                </div>
                <div class="course-content">
                    <span class="course-category">Development</span>
                    <h3 class="course-title">Complete Web Development Bootcamp</h3>
                    <p>
                        Learn HTML, CSS, JavaScript, React, Node and more to become a
                        full-stack web developer.
                    </p>
                    <div class="course-meta">
                        <div class="course-author">
                            <span>6000 EG</span>
                        </div>
                        <div class="course-rating">30 Hours</div>
                    </div>
                </div>
            </div>

            <!-- Course Card 2 -->
            <div class="course-card" onclick="window.location.href='course-detail.html'">
                <div class="course-image">
                    <img src="./images/python.webp" alt="Data Science Course" />
                </div>
                <div class="course-content">
                    <span class="course-category">Data Science</span>
                    <h3 class="course-title">
                        Python for Data Analysis and Visualization
                    </h3>
                    <p>
                        Master Python libraries like Pandas, NumPy, and Matplotlib for
                        effective data analysis.
                    </p>
                    <div class="course-meta">
                        <div class="course-author">
                            <span>4000 EG</span>
                        </div>
                        <div class="course-rating">40 Hours</div>
                    </div>
                </div>
            </div>

            <!-- Course Card 3 -->
            <div class="course-card" onclick="window.location.href='course-detail.html'">
                <div class="course-image">
                    <img src="./images/ui.webp" alt="UX Design Course" />
                </div>
                <div class="course-content">
                    <span class="course-category">Design</span>
                    <h3 class="course-title">UI/UX Design Masterclass</h3>
                    <p>
                        Learn to create beautiful user interfaces and seamless user
                        experiences for digital products.
                    </p>
                    <div class="course-meta">
                        <div class="course-author">
                            <span>8000 EG</span>
                        </div>
                        <div class="course-rating">30 Hours</div>
                    </div>
                </div>
            </div>

            <!-- Course Card 4 -->
            <div class="course-card" onclick="window.location.href='course-detail.html'">
                <div class="course-image">
                    <img src="./images/markekting.webp" alt="Digital Marketing Course" />
                </div>
                <div class="course-content">
                    <span class="course-category">Marketing</span>
                    <h3 class="course-title">Digital Marketing Strategy</h3>
                    <p>
                        Learn SEO, social media marketing, email campaigns, and more to
                        grow your business online.
                    </p>
                    <div class="course-meta">
                        <div class="course-author">
                            <span>5000 EG</span>
                        </div>
                        <div class="course-rating">70 Hours</div>
                    </div>
                </div>
            </div>

            <!-- Course Card 5 -->
            <div class="course-card" onclick="window.location.href='course-detail.html'">
                <div class="course-image">
                    <img src="./images/anything.webp" alt="Photography Course" />
                </div>
                <div class="course-content">
                    <span class="course-category">Photography</span>
                    <h3 class="course-title">Photography Fundamentals</h3>
                    <p>
                        Master composition, lighting, and editing to take your photography
                        skills to the next level.
                    </p>
                    <div class="course-meta">
                        <div class="course-author">
                            <span>6000 EG</span>
                        </div>
                        <div class="course-rating">20 Hours</div>
                    </div>
                </div>
            </div>

            <!-- Course Card 6 -->
            <div class="course-card" onclick="window.location.href='course-detail.html'">
                <div class="course-image">
                    <img src="./images/ML.webp" alt="Machine Learning Course" />
                </div>
                <div class="course-content">
                    <span class="course-category">AI & ML</span>
                    <h3 class="course-title">Machine Learning from Scratch</h3>
                    <p>
                        Build a strong foundation in machine learning algorithms and
                        implement them using Python.
                    </p>
                    <div class="course-meta">
                        <div class="course-author">
                            <span>7000 EG</span>
                        </div>
                        <div class="course-rating">40 Hours</div>
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
</body>

</html>
