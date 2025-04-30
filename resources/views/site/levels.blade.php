<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LearnHub - Online Learning Platform</title>
    <link rel="stylesheet" href="{{ asset('/assets/css/styles.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/css/levels.css') }}" />
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
                    @if (auth()->user()->hasRole('admin'))
                        <a href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
                    @elseif(auth()->user()->hasRole('teacher'))
                        {{-- <a href="{{ route('teacher.dashboard') }}">Teacher Dashboard</a> --}}
                    @endif

                    <form method="POST" action="{{ route('logout') }}" style="display: inline; margin-left: 20px;">
                        @csrf
                        <button type="submit" class="btn btn-outline">Logout</button>
                    </form>
                @endauth

                @guest
                    <a href="{{ route('login.index') }}" class="btn btn-outline">Login</a>
                @endguest
            </div>
        </div>
    </nav>

    <div class="hero">
        <div class="container">
            <h1>Choose Your Education Level</h1>
            <p>
                Access specialized courses designed for different education levels
            </p>
        </div>
    </div>

    <div class="container" id="education-levels">
        <div class="levels-grid">
            @foreach ($levels as $level)
                <div class="level-card" onclick="window.location.href='primary-school.html'">
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
                            <span>6 Grades</span>
                            <span>Ages {{ $level->min_age }}-{{ $level->max_age }}</span>
                        </div>
                        <a href="primary-school.html" class="btn btn-primary level-btn">View Grades</a>
                    </div>
                </div>
            @endforeach
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
