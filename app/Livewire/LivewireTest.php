<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;

class LivewireTest extends Component
{

//    #[Layout('layouts.dashboard.main')]

    public function render()
    {
        return view('panel.dashboard.admin')->layout('layouts.dashboard.main');
    }
}
