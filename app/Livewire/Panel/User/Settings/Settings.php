<?php

namespace App\Livewire\Panel\User\Settings;

use Livewire\Component;

class Settings extends Component
{

    public $name;
    public $phone;
    public $email;
    public $old_password;
    public $new_password;
    public $retype_password;


    public function mount()
    {
        $this->name = old('name', auth()->user()->name);
        $this->phone = old('name', auth()->user()->phone);
        $this->email = old('email', auth()->user()->email);
    }

    public function submitData()
    {

        // 1️⃣ Validate inputs
        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email',
            'old_password' => 'required|string',
            'new_password' => 'required|string|min:8',
            'retype_password' => 'required|string|same:new_password',
        ]);

        $user = auth()->user();

        // 2️⃣ Verify old password
        if (!\Hash::check($this->old_password, $user->password)) {
            $this->addError('old_password', 'The old password is incorrect.');
            return;
        }

        // 3️⃣ Update user details
        $user->update([
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'password' => bcrypt($this->new_password),
        ]);

        // 4️⃣ Flash success
        session()->flash('success', 'Your profile has been updated successfully.');

    }

    public function render()
    {
        return view('livewire.panel.user.settings.settings')->layout('layouts.dashboard.main');
    }
}
