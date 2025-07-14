<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Login to Editable</title>
    <link rel="stylesheet" href="{{ asset('modified/login.css') }}">

    <!-- Urbanist -->
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *{
            font-family: "urbanist";
        }
    </style>
</head>
<body>
<div class="left"></div>
<div class="right">
    <div class="login-box">
        <h2>Login to Editable</h2>

        <!-- Session Status -->
        @if (session('status'))
            <div style="color: green; margin-bottom: 10px;">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <label for="" class="label_data">Your Email</label>

            <!-- Email Address -->
            <input
                id="email"
                type="email"
                name="email"
                placeholder=""
                value=""
                required
                autofocus
                autocomplete="username"
            >
            @error('email')
            <div style="color: red; font-size: 13px;">{{ $message }}</div>
            @enderror

            <!-- Password -->

            <label for="" class="label_data">Password</label>

            <input
                id="password"
                type="password"
                name="password"
                placeholder=""
                required
                autocomplete="current-password"
            >
            @error('password')
            <div style="color: red; font-size: 13px;">{{ $message }}</div>
            @enderror

            <!-- Remember Me -->
            <div class="remember-me">
                <label for="remember_me" class="checkbox-label">
                    <input id="remember_me" type="checkbox" name="remember" class="custom-checkbox">
                    <span>Remember me</span>
                </label>
            </div>


            <!-- Submit Button -->
            <button type="submit">Login</button>

            <!-- Forgot Password Link -->
            <div class="options">
                @if (Route::has('password.request'))
                    Forgot your password? <a href="{{ route('password.request') }}" style="text-decoration: none"><span
                            style="color: #001AFF">Click Here</span></a>
                @endif
            </div>

            <div class="options">
                @if (Route::has('password.request'))
                    Don’t have an account? <a href="{{ route('register') }}" style="text-decoration: none"><span
                            style="color: #001AFF">Sign up</span></a>
                @endif
            </div>

        </form>
    </div>
</div>
</body>
</html>
