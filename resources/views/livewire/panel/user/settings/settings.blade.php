<div>

    <link rel="stylesheet" href="{{ asset('modified/form.css') }}">

    {{-- ------------------ Alert div ------------------ --}}

    <x-alert></x-alert>

    {{-- ------------------ Alert div ------------------ --}}


    <div class="right">

        <div class="login-box">
            <h5>General Settings</h5>

            <form method="POST" wire:submit.prevent="testData">
                @csrf

                <label for="" class="label_data">Name</label>

                <!-- Name -->
                <input
                    id="name"
                    type="text"
                    name="name"
                    placeholder=""
                    value="{{ old('name', auth()->user()->name) }}"
                    required
                    autofocus
                    autocomplete="name"
                >
                @error('name')
                <div style="color: red; font-size: 13px;">{{ $message }}</div>
                @enderror


                <!-- Phone -->
                <label for="" class="label_data">Contact Number</label>

                <input
                    id="email"
                    type="text"
                    name="phone"
                    placeholder=""
                    value="{{ old('phone', auth()->user()->phone) }}"
                    required
                    autocomplete="phone"
                >
                @error('email')
                <div style="color: red; font-size: 13px;">{{ $message }}</div>
                @enderror

                <!-- Email Address -->
                <label for="" class="label_data">Email</label>

                <input
                    id="email"
                    type="email"
                    name="email"
                    placeholder=""
                    value="{{ old('email', auth()->user()->email) }}"
                    required
                    autocomplete="email"
                >
                @error('email')
                <div style="color: red; font-size: 13px;">{{ $message }}</div>
                @enderror


                <!-- Password -->

                <label for="" class="label_data">Enter Old Password</label>

                <input
                    id="password"
                    type="password"
                    name="old_password"
                    placeholder=""
                    required
                    autocomplete=""
                >
                @error('old_password')
                <div style="color: red; font-size: 13px;">{{ $message }}</div>
                @enderror

                <label for="" class="label_data">Enter New Password</label>

                <input
                    id="password"
                    type="password"
                    name="new_password"
                    placeholder=""
                    required
                    autocomplete=""
                >
                @error('new_password')
                <div style="color: red; font-size: 13px;">{{ $message }}</div>
                @enderror

                <!-- Confirm Password -->

                <label for="" class="label_data">Retype Password</label>

                <input
                    id="password_confirmation"
                    type="password"
                    name="retype_password"
                    placeholder=""
                    required
                    autocomplete=""
                >
                @error('retype_password')
                <div style="color: red; font-size: 13px;">{{ $message }}</div>
                @enderror

                <!-- Register Button -->
                <button type="submit">Save Changes</button>
                
            </form>
        </div>
    </div>

</div>

