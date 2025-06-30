<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Register to Editable</title>
    <link rel="stylesheet" href="{{ asset('modified/login.css') }}">
</head>
<body>
<div class="left"></div>
<div class="right">
    <div class="login-box">
        <h2>Signup to Editable</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <label for="" class="label_data">Your Name</label>

            <!-- Name -->
            <input
                id="name"
                type="text"
                name="name"
                placeholder=""
                value="{{ old('name') }}"
                required
                autofocus
                autocomplete="name"
            >
            @error('name')
            <div style="color: red; font-size: 13px;">{{ $message }}</div>
            @enderror

            <!-- Email Address -->
            <label for="" class="label_data">Your Email</label>

            <input
                id="email"
                type="email"
                name="email"
                placeholder=""
                value="{{ old('email') }}"
                required
                autocomplete="username"
            >
            @error('email')
            <div style="color: red; font-size: 13px;">{{ $message }}</div>
            @enderror


            <!-- Phone Number -->
            <label for="" class="label_data">Your Whatsapp Number</label>

            <input
                id="phone"
                type="text"
                name="phone"
                placeholder=""
                value="{{ old('phone') }}"
                required
                autocomplete="phone"
            >
            @error('phone')
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
                autocomplete="new-password"
            >
            @error('password')
            <div style="color: red; font-size: 13px;">{{ $message }}</div>
            @enderror

            <!-- Confirm Password -->

            <label for="" class="label_data">Retype Password</label>


            <input
                id="password_confirmation"
                type="password"
                name="password_confirmation"
                placeholder=""
                required
                autocomplete="new-password"
            >
            @error('password_confirmation')
            <div style="color: red; font-size: 13px;">{{ $message }}</div>
            @enderror

            <!-- Terms Checkbox -->
            <div class="remember-me" style="margin-top: 10px;">
                <label for="terms" class="checkbox-label">
                    <input id="terms" type="checkbox" name="terms" class="custom-checkbox">
                    <span style="text-align: left">
                     By checking this box, you are accepting the <span style="color: #001AFF">terms of use </span>set by Editable
                    </span>
                </label>
            </div>

            @error('terms')
            <div style="color: red; font-size: 13px;">{{ $message }}</div>
            @enderror

            <!-- Register Button -->
            <button type="submit" id="register_button" disabled>Register</button>

            <!-- Already Registered Link -->
            <div class="options">
                Already registered?
                <a href="{{ route('login') }}" style="text-decoration: none">
                    <span style="color: #001AFF">Login here</span>
                </a>
            </div>

        </form>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const terms = document.querySelector("#terms");
        const registerBtn = document.querySelector("#register_button");

        registerBtn.disabled = true;
        registerBtn.style.opacity = 0.5;
        registerBtn.style.cursor = "not-allowed";

        terms.addEventListener('change', function (e) {
            const isChecked = e.target.checked;
            registerBtn.disabled = !isChecked;
            if (isChecked) {
                registerBtn.style.opacity = 1;
                registerBtn.style.cursor = "pointer";
            } else {
                registerBtn.style.opacity = 0.5;
                registerBtn.style.cursor = "not-allowed";
            }
        });
    });
</script>

</body>
</html>
