<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LearnHub - Register</title>
    <link rel="stylesheet" href="{{ asset('assets/css/register.css') }}" />
</head>

<body>
    <div class="auth-container">
        <div class="auth-image"></div>
        <div class="auth-forms">
            <h2>Join LearnHub Today</h2>

            <div class="tabs">
                <div class="tab" onclick="window.location.href='{{ route('login.index') }}'">
                    Login
                </div>
                <div class="tab active">Register</div>
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

            <form id="register-form" action="{{ route('register') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" name="name" id="name" placeholder="Enter your full name" required />
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" id="email" placeholder="Enter your email" required />
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Create a password" required />
                </div>

                <div class="form-group">
                    <label for="confirm-password">Confirm Password</label>
                    <input type="password" id="confirm-password" name="password_confirmation"
                        placeholder="Confirm your password" required />
                </div>

                <button type="submit" class="btn btn-primary auth-btn">
                    Register
                </button>
            </form>

            <div class="auth-switch">
                <p>Already have an account? <a href="{{ route('login.index') }}">Login here</a></p>
            </div>
        </div>
    </div>
</body>

</html>
