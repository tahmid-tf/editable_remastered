<?php

namespace App\Livewire\Panel\User\Order;

use App\Models\Style;
use Livewire\Component;
use function PHPUnit\Framework\isType;

class MakeOrder extends Component
{

    public $styles;
    public $styles_additional;
    public $title;
    public $category;

    public $final_result;

//   ----------- common dropdowns -----------

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


//    -------------------------------------- calculated options --------------------------------------
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
            // Maybe you want to clear the result if no main is selected
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

//    -------------------------------------- calculated options --------------------------------------


// ----------------------------- cart calculations -----------------------------

    public $total_price = 0; // total price

    public $number_culling_items = 0; // total selected culling items from view
    public $culling_price = 0; // total culling price

    public $number_skin_retouching_items = 0; // total skin retouch selected culling items from view
    public $skin_retouch_price = 0; // total skin retouch price

    public $culling_items = 0; // wire live input from view
    public $skin_retouch_items = 0; // wire live input from view


    // ---------- cart calculations

    public function culling_images_by_user()
    {
        $previous_culling_price = $this->culling_price ?? 0;
        $this->number_culling_items = $this->culling_items;
        $this->culling_price = $this->category->culling_price * (int) $this->number_culling_items;
        $this->total_price -= $previous_culling_price; // Remove old
        $this->total_price += $this->culling_price;    // Add new
    }


    public function skin_retouch_images_by_user()
    {
        $previous_skin_retouch_price = $this->skin_retouch_price ?? 0;
        $this->number_skin_retouching_items = $this->skin_retouch_items;
        $this->skin_retouch_price = $this->category->skin_retouch_price * (int) $this->number_skin_retouching_items;
        $this->total_price -= $previous_skin_retouch_price; // remove old
        $this->total_price += $this->skin_retouch_price;    // add new
    }


    public function culling_calculation_checkbox_change()
    {
        if ($this->cullingCheckbox == false) {
            $this->total_price -= $this->culling_price; // remove it from total
            $this->number_culling_items = 0;
            $this->culling_price = 0;
            $this->culling_items = 0;
        }
    }

    public function skin_calculation_checkbox_change()
    {
        if ($this->skin_retouch == false) {
            $this->total_price -= $this->skin_retouch_price; // remove old portion
            $this->skin_retouch_items = 0;
            $this->skin_retouch_price = 0;
            $this->number_skin_retouching_items = 0;
        }
    }



    public function render()
    {
        return view('livewire.panel.user.order.make-order')->layout('layouts.dashboard.main');
    }
}
