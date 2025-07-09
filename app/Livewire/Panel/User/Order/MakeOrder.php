<?php

namespace App\Livewire\Panel\User\Order;

use App\Models\Style;
use Livewire\Component;

class MakeOrder extends Component
{
    public $styles;
    public $styles_additional;
    public $title;
    public $category;

    public $final_result;

    // ----------- common dropdowns -----------
    public $styles_array = [];

    public $cullingCheckbox;
    public $skin_retouch;

    // -----****** main dropdowns ******-----
    public $is_culling = false;
    public $is_skin_retouching = false;
    public $preview_edits = false;

    public function mount()
    {
        $this->styles = session('styles');
        $this->styles_additional = session('styles_additional');
        $this->title = session('title');
        $this->category = session('category');
    }

    // -------------------------------------- calculated options --------------------------------------
    public int $selected_main_id = 0;
    public array $selected_additional_ids = [];

    public function selectMain($id)
    {
        $this->selected_main_id = $id;
        $this->calculateResult();
    }

    public function toggleAdditional($id)
    {
        if (in_array($id, $this->selected_additional_ids)) {
            $this->selected_additional_ids = array_diff($this->selected_additional_ids, [$id]);
        } else {
            $this->selected_additional_ids[] = $id;
        }
        $this->calculateResult();
    }

    public function calculateResult()
    {
        $main = Style::find($this->selected_main_id);

        if (!$main) {
            $this->final_result = [
                'is_culling' => false,
                'is_skin_retouch' => false,
                'is_preview_edit' => false,
            ];
            return;
        }

        $result = [
            'is_culling' => (bool)$main->is_culling,
            'is_skin_retouch' => (bool)$main->is_skin_retouch,
            'is_preview_edit' => (bool)$main->is_preview_edit,
        ];

        $additional = Style::whereIn('id', $this->selected_additional_ids)->get();

        foreach ($additional as $add) {
            if ($add->is_culling) $result['is_culling'] = true;
            if ($add->is_skin_retouch) $result['is_skin_retouch'] = true;
            if ($add->is_preview_edit) $result['is_preview_edit'] = true;
        }

        $this->final_result = $result;

        $this->is_culling = $result['is_culling'];
        $this->is_skin_retouching = $result['is_skin_retouch'];
        $this->preview_edits = $result['is_preview_edit'];
    }

    // --------------------------------------- cart calculations ------------------------------------------

    public $total_price = 0; // final total (base + express)
    public $base_total_price = 0; // base price before express
    public $express_delivery_fee = 0;

    public $number_culling_items = 0;
    public $culling_price = 0;

    public $number_skin_retouching_items = 0;
    public $skin_retouch_price = 0;

    public $culling_items = 0;
    public $skin_retouch_items = 0;

    public $express_delivery_checkbox;

    public function culling_images_by_user()
    {
        $previous = $this->culling_price ?? 0;

        $this->number_culling_items = $this->culling_items;
        $this->culling_price = $this->category->culling_price * (int) $this->number_culling_items;

        $this->base_total_price -= $previous;
        $this->base_total_price += $this->culling_price;

        $this->updateTotalPrice();
    }

    public function skin_retouch_images_by_user()
    {
        $previous = $this->skin_retouch_price ?? 0;

        $this->number_skin_retouching_items = $this->skin_retouch_items;
        $this->skin_retouch_price = $this->category->skin_retouch_price * (int) $this->number_skin_retouching_items;

        $this->base_total_price -= $previous;
        $this->base_total_price += $this->skin_retouch_price;

        $this->updateTotalPrice();
    }

    public function culling_calculation_checkbox_change()
    {
        if ($this->cullingCheckbox == false) {
            $this->base_total_price -= $this->culling_price;
            $this->culling_price = 0;
            $this->number_culling_items = 0;
            $this->culling_items = 0;

            $this->updateTotalPrice();
        }
    }

    public function skin_calculation_checkbox_change()
    {
        if ($this->skin_retouch == false) {
            $this->base_total_price -= $this->skin_retouch_price;
            $this->skin_retouch_price = 0;
            $this->number_skin_retouching_items = 0;
            $this->skin_retouch_items = 0;

            $this->updateTotalPrice();
        }
    }

    public function express_delivery_calculation_change()
    {
//        if ($this->express_delivery_checkbox) {
//            $this->express_delivery_fee = $this->base_total_price * 0.30;
//        } else {
//            $this->express_delivery_fee = 0;
//        }

        $this->updateTotalPrice();
    }

    public function updateTotalPrice()
    {
        if ($this->express_delivery_checkbox) {
            $this->express_delivery_fee = $this->base_total_price * 0.30;
        } else {
            $this->express_delivery_fee = 0;
        }

        $this->total_price = $this->base_total_price + $this->express_delivery_fee;
    }

    // --------------------------------------- cart calculations ------------------------------------------

    public function render()
    {
        return view('livewire.panel.user.order.make-order')->layout('layouts.dashboard.main');
    }
}
