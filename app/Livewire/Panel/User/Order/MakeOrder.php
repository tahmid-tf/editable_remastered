<?php

namespace App\Livewire\Panel\User\Order;

use Livewire\Component;

class MakeOrder extends Component
{

   public $styles;
   public $styles_additional;
   public $title;
   public $category;

   public function mount()
   {
       $this->styles = session('styles');
       $this->styles_additional = session('styles_additional');
       $this->title = session('title');
       $this->category = session('category');
   }



    public function render()
    {
        return view('livewire.panel.user.order.make-order')->layout('layouts.dashboard.main');
    }
}
