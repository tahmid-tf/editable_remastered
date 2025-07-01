<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Forgot Password</title>
    <link rel="stylesheet" href="{{ asset('modified/login.css') }}">
</head>
<body>
<div class="left"></div>
<div class="right">
    <div class="login-box">
        <h2 style="text-align: center">Forgot Your Password?</h2>

        <p style="font-size: 14px; margin-bottom: 15px; color: #555;">
            No problem. Enter your email address below and we’ll send you a link to reset your password.
        </p>

        <!-- Session Status -->
        @if (session('status'))
            <div style="color: green; margin-bottom: 10px;">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <input
                id="email"
                type="email"
                name="email"
                placeholder="Email"
                value="{{ old('email') }}"
                required
                autofocus
            >
            @error('email')
            <div style="color: red; font-size: 13px;">{{ $message }}</div>
            @enderror

            <!-- Submit Button -->
            <button type="submit">Send Password Reset Link</button>

            <!-- Back to login link -->
            <div class="options">
                Remembered your password?
                <a href="{{ route('login') }}" style="text-decoration: none;">
                    <span style="color: #001AFF">Login here</span>
                </a>
            </div>
        </form>
    </div>
</div>
</body>
</html>
