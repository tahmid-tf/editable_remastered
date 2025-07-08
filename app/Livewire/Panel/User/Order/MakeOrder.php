<?php

namespace App\Livewire\Panel\User\Order;

use Livewire\Component;

class MakeOrder extends Component
{
    public function render()
    {
        return view('livewire.panel.user.order.make-order')->layout('layouts.dashboard.main');;
    }
}
