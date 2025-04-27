<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LearnHub - Login</title>
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}" />
</head>

<body>
    <div class="auth-container">
        <div class="auth-image"></div>
        <div class="auth-forms">
            <h2>Welcome to LearnHub</h2>

            <div class="tabs">
                <div class="tab active">Login</div>
                <div class="tab" onclick="window.location.href='{{ route('register.index') }}'">
                    Register
                </div>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form id="login-form" action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" id="email" placeholder="Enter your email" required />
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter your password" required />
                    <a href="#" class="forgot-password">Forgot Password?</a>
                </div>

                <button type="submit" class="btn btn-primary auth-btn">
                    Login
                </button>
            </form>

            <div class="auth-switch">
                <p>
                    Don't have an account?
                    <a href="{{ route('register.index') }}">Register here</a>
                </p>
            </div>
        </div>
    </div>
</body>

</html>
