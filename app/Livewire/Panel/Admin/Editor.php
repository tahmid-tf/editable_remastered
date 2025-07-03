<?php

namespace App\Livewire\Panel\Admin;

use Livewire\Component;

class Editor extends Component
{
    public function render()
    {
        return view('livewire.panel.admin.editor')->layout('layouts.dashboard.main');
    }
}
