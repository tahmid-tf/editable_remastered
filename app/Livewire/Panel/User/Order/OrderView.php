<?php

namespace App\Livewire\Panel\User\Order;

use App\Models\Category;
use App\Models\Style;
use Livewire\Component;
use Livewire\WithPagination;

class OrderView extends Component
{
    // ---------- pagination ----------

    use WithPagination;

    public $search = '';
    public $perPage = 5;
    public $sortField = 'id';
    public $sortDirection = 'asc';

    protected $paginationTheme = 'bootstrap'; // or 'tailwind' if you prefer

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    // ---------- pagination ----------


    public $order_modal_1_visibility = false;

    public $order_modal_2_visibility = false;
    public $title;
    public $categories;

    public $payment_info_modal = false;

    //----------------

    public $amount_data;
    public $order_name_data;
    public $category_name;
    public $styles_data;
    public $culling_data;
    public $skin_retouching;
    public $preview_edit;
    public $payment_status;
    public $order_id;

    public function payment_info_modal_visibility($model)
    {
        try {
            $this->amount_data = $model['amount'];
            $this->order_name_data = $model['order_name'];
            $this->category_name = $model['category_name'];
            $this->styles_data = $model['styles'];
            $this->culling_data = $model['culling'];
            $this->skin_retouching = $model['skin_retouching'];
            $this->preview_edit = $model['preview_edits'];
            $this->payment_status = $model['payment_status'];
            $this->order_id = $model['id'];

            $this->payment_info_modal = !$this->payment_info_modal;
        }catch (\Exception $exception){
            $this->payment_info_modal = false;
        }

    }


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


    // ------------------------------- payment information modal-------------------------------


    // ------------------------------- payment information modal-------------------------------

    public function render()
    {

        $orders = \App\Models\Order::query()
            ->when($this->search, fn($q) => $q->where('order_name', 'like', "%{$this->search}%"))
            ->orderBy($this->sortField, $this->sortDirection)
            ->where('user_id', auth()->id())
            ->paginate($this->perPage);

        return view('livewire.panel.user.order.order-view', [
            'orders' => $orders,
        ])->layout('layouts.dashboard.main');
    }
}
