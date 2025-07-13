<div>

    <link rel="stylesheet" href="{{ asset('modified/form.css') }}">

    {{-- ------------------ Alert div ------------------ --}}

    <x-alert></x-alert>

    {{-- ------------------ Alert div ------------------ --}}


    <div class="right">

        <div class="login-box">
            <h5 class="h5_text_size" style="margin-left: 0px">General Settings</h5>

            <form method="POST" wire:submit.prevent="submitData">
                @csrf

                <label for="" class="label_data">Name</label>

                <!-- Name -->
                <input
                    id="name"
                    type="text"
                    name="name"
                    placeholder=""
                    required
                    autofocus
                    autocomplete="name"
                    wire:model="name"
                >
                @error('name')
                <div style="color: red; font-size: 13px; text-align: left">{{ $message }}</div>
                @enderror


                <!-- Phone -->
                <label for="" class="label_data">Contact Number</label>

                <input
                    id=""
                    type="text"
                    name="phone"
                    placeholder=""
                    required
                    autocomplete="phone"
                    wire:model="phone"
                >
                @error('email')
                <div style="color: red; font-size: 13px; text-align: left">{{ $message }}</div>
                @enderror

                <!-- Email Address -->
                <label for="" class="label_data">Email</label>

                <input
                    id=""
                    type="email"
                    name="email"
                    placeholder=""
                    required
                    autocomplete="email"
                    wire:model="email"
                >
                @error('email')
                <div style="color: red; font-size: 13px; text-align: left">{{ $message }}</div>
                @enderror


                <!-- Password -->

                <label for="" class="label_data">Enter Old Password</label>

                <input
                    id="password"
                    type="password"
                    name="old_password"
                    placeholder=""
                    autocomplete=""
                    wire:model="old_password"
                    required
                >
                @error('old_password')
                <div style="color: red; font-size: 13px; text-align: left">{{ $message }}</div>
                @enderror

                <label for="" class="label_data">Enter New Password</label>

                <input
                    id="password"
                    type="password"
                    name="new_password"
                    placeholder=""
                    required
                    autocomplete=""
                    wire:model="new_password"
                >
                @error('new_password')
                <div style="color: red; font-size: 13px; text-align: left">{{ $message }}</div>
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
                    wire:model="retype_password"
                >

                @error('retype_password')
                <div style="color: red; font-size: 13px; text-align: left">{{ $message }}</div>
                @enderror

                <!-- Register Button -->
                <button type="submit">Save Changes</button>

            </form>
        </div>
    </div>

</div>

