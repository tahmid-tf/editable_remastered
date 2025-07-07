<?php

namespace App\Livewire\Panel\User\Order;

use Livewire\Component;

class OrderView extends Component
{
    public $order_modal_1_visibility = false;

    public $order_modal_2_visibility = false;
    public $title;

    public function order_modal_1_visibility_function()
    {
        $this->order_modal_1_visibility = !$this->order_modal_1_visibility;
    }

    public function order_modal_2_visibility_function($title = null)
    {
        $this->title = $title;
        $this->order_modal_1_visibility = false;
        $this->order_modal_2_visibility = !$this->order_modal_2_visibility;
    }

    public function render()
    {
        return view('livewire.panel.user.order.order-view')->layout('layouts.dashboard.main');
    }
}
