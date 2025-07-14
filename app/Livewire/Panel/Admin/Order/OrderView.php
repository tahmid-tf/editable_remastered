<?php

namespace App\Livewire\Panel\Admin\Order;

use App\Models\Category;
use App\Models\Order;
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

    //----------------

    public $order_completion_modal = false;


    // ------------------------------- Assigning Editor-------------------------------


    public function assign_editor($editor_id, $order_id)
    {


        $order = Order::find($order_id);

        if ($order) {
            $order->update(['editors_id' => $editor_id]);

        }
    }


    // ------------------------------- payment status -------------------------------

    public function update_payment_status($selected_value, $order_id)
    {
        $allowed_statuses = ['pending', 'successful', 'failed'];

        if (!in_array($selected_value, $allowed_statuses)) {
            abort(403, 'Invalid payment status.');
        }

        $order = Order::findOrFail($order_id);

        $order->update([
            'payment_status' => $selected_value,
        ]);
    }


    // ------------------------------- order status -------------------------------

    public $update_order_id = null;
    public $update_drive_link;

    public function update_order_status($selected_value, $order_id)
    {
        $allowed_statuses = ['pending', 'completed', 'cancelled'];

        if (!in_array($selected_value, $allowed_statuses)) {
            abort(403, 'Invalid payment status.');
        }

        if ($selected_value === 'completed') {
            $this->update_order_id = $order_id;
            $this->order_completion_modal_function();
            return;
        }

        $order = Order::findOrFail($order_id);

        $order->update([
            'order_status' => $selected_value,
        ]);
    }


    // ------------------------------- payment information modal-------------------------------

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
        } catch (\Exception $exception) {
            $this->payment_info_modal = false;
        }

    }

    // ------------------------------- payment information modal-------------------------------


    // ----------------- order name and category data -----------------

    public $order_name;
    public $selectedCategoryId = "";


    // ---------------------- order completion form modal ----------------------

    public function order_completion_modal_function()
    {
        $this->order_completion_modal = !$this->order_completion_modal;

    }

    public function complete_order_submission()
    {
        Order::where('id', $this->update_order_id)->update([
            'file_uploaded_by_admin_after_edit' => $this->update_drive_link,
            'order_status' => 'completed', // ✅ Must update this
        ]);

        $this->order_completion_modal = false;

        $this->resetPage();

    }


    public function mount()
    {
        $this->categories = Category::all();
    }


    public function render()
    {
        $orders = \App\Models\Order::query()
            ->when($this->search, fn($q) => $q->where('order_name', 'like', "%{$this->search}%"))
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.panel.admin.order.order-view', [
            'orders' => $orders,
        ])->layout('layouts.dashboard.main');
    }
}
