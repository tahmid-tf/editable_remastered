<?php

namespace App\Livewire\Panel\User\Order;

use Livewire\Component;

class OrderView extends Component
{
    public function render()
    {
        return view('livewire.panel.user.order.order-view')->layout('layouts.dashboard.main');
    }
}
