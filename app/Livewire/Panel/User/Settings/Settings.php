<?php

namespace App\Livewire\Panel\User\Settings;

use Livewire\Component;

class Settings extends Component
{

    public string $successMessage = '';

    public function testData()
    {
        session()->flash("success","Data has been saved");
    }

    public function render()
    {
        return view('livewire.panel.user.settings.settings')->layout('layouts.dashboard.main');
    }
}
