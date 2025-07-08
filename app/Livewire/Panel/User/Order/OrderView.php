<?php

namespace App\Livewire\Panel\User\Order;

use App\Models\Category;
use App\Models\Style;
use Livewire\Component;

class OrderView extends Component
{
    public $order_modal_1_visibility = false;

    public $order_modal_2_visibility = false;
    public $title;
    public $categories;
    public $step;

    // ----------------- order name and category data -----------------

    public $order_name;
    public $selectedCategoryId = "";

    public function mount()
    {
        $this->categories = Category::all();
    }

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


    public function goToOrderCreationPage()
    {
        $data = $this->validate([
            'title' => 'required',
            'order_name' => 'required',
            'selectedCategoryId' => 'required',
        ]);

//        $this->step = 'create_order';

        $category = Category::find($this->selectedCategoryId);
        $styles = Style::whereJsonContains('categories', $category->name)->where('is_additional', "no")->get();
        $styles_additional = Style::whereJsonContains('categories', $category->name)->where('is_additional', "yes")->get();
        $title = $this->title;

        session([
            'category' => $category,
            'styles' => $styles,
            'styles_additional' => $styles_additional,
            'title' => $title,
        ]);

        return redirect(route('users.orders.make'));

    }

    public function render()
    {

//        if ($this->step === 'create_order') {
//
//            $category = Category::find($this->selectedCategoryId);
//            $styles = Style::whereJsonContains('categories', $category->name)->where('is_additional', "no")->get();
//            $styles_additional = Style::whereJsonContains('categories', $category->name)->where('is_additional', "yes")->get();
//            $title = $this->title;
//
//            return view('livewire.panel.user.order.make-order', [
//                'category' => $category,
//                'styles' => $styles,
//                'styles_additional' => $styles_additional,
//                'title' => $title,
//            ])
//                ->layout('layouts.dashboard.main');
//        }

        return view('livewire.panel.user.order.order-view')->layout('layouts.dashboard.main');
    }
}
