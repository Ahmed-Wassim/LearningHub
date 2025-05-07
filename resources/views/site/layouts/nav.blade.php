<nav>
    <div class="container nav-container">
        <a href="home.html" class="nav-logo">LearnHub</a>

        <div class="search-bar">
            <input type="text" placeholder="Search for courses, topics, or instructors..." />
        </div>

        <div class="nav-links">
            <a href="home.html">Courses</a>
            <a href="education-levels.html">Education Levels</a>
            <a href="#">About</a>
            @guest
                <a href="{{ route('login.index') }}" class="btn btn-outline">Login</a>
            @endguest
            @auth
                @if (auth()->user()->hasRole('teacher'))
                @else
                    <a href="{{ route('teacher.show') }}" class="btn btn-outline">Become A Teacher</a>
                @endif

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline" style="margin-left: 10px">Logout</button>
                </form>
            @endauth
        </div>
    </div>
</nav>
