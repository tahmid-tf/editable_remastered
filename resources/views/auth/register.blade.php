<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')"/>
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                          autofocus autocomplete="name"/>
            <x-input-error :messages="$errors->get('name')" class="mt-2"/>
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')"/>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                          autocomplete="username"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
        </div>

        <!-- Phone Number -->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Phone')"/>
            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required
                          autocomplete="phone"/>
            <x-input-error :messages="$errors->get('phone')" class="mt-2"/>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')"/>

            <x-text-input id="password" class="block mt-1 w-full"
                          type="password"
                          name="password"
                          required autocomplete="new-password"/>

            <x-input-error :messages="$errors->get('password')" class="mt-2"/>
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')"/>

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                          type="password"
                          name="password_confirmation" required autocomplete="new-password"/>

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
        </div>

        {{-- click validation --}}

        <div class="mt-4">
            <label class="flex items-center">
                <input type="checkbox" name="terms" id="terms" class="mr-2">
                <span class="text-sm text-gray-600">
            By checking this box, you are accepting the terms of use set by <span class="font-semibold">Editable</span>
        </span>
            </label>
            @error('terms')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
               href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4" id="register_data" disabled>
                {{ __('Register') }}
            </x-primary-button>

        </div>
    </form>
</x-guest-layout>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        const terms = document.querySelector("#terms");
        const registerBtn = document.querySelector("#register_data");

        // Initially disabled and grayed out
        registerBtn.disabled = true;
        registerBtn.classList.add('bg-gray-400', 'hover:bg-gray-400', 'cursor-not-allowed');

        terms.addEventListener('change', function (e) {
            const isChecked = e.target.checked;

            registerBtn.disabled = !isChecked;

            if (isChecked) {
                registerBtn.classList.remove('bg-gray-400', 'hover:bg-gray-400', 'cursor-not-allowed');
                registerBtn.classList.add('bg-gray-600', 'hover:bg-gray-700', 'cursor-pointer');
            } else {
                registerBtn.classList.remove('bg-gray-600', 'hover:bg-gray-700', 'cursor-pointer');
                registerBtn.classList.add('bg-gray-400', 'hover:bg-gray-400', 'cursor-not-allowed');
            }
        });
    });
</script>
