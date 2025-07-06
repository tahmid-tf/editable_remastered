<?php

namespace App\Livewire\Panel\Admin;

use Livewire\Component;
use Livewire\WithPagination;

class Categories extends Component
{
    use WithPagination;

    public $name;

    public $style_price, $style_threshold;
    public $culling_price, $culling_threshold;
    public $skin_retouch_price, $skin_retouch_threshold;
    public $preview_edit_price, $preview_edit_threshold;

    public $create_category_modal = false;
    public $update_category_modal = false;
    public $remove_category_modal = false;

    public $update_category_id = null;
    public $remove_category_id = null;

    public $search = '';
    public $perPage = 10;
    public $sortField = 'id';
    public $sortDirection = 'asc';

    protected $paginationTheme = 'bootstrap'; // or 'tailwind'

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

    public function createCategoryModalVisibility($input)
    {
        if (!is_bool($input)) {
            throw new \InvalidArgumentException("Modal visibility must be a boolean.");
        }

        $this->resetInputFields();
        $this->create_category_modal = $input;
    }

    public function createCategory()
    {
        $this->validate([
            'name' => 'required|unique:categories,name',
            'style_price' => 'required|numeric',
            'style_threshold' => 'required',
            'culling_price' => 'required|numeric',
            'culling_threshold' => 'required',
            'skin_retouch_price' => 'required|numeric',
            'skin_retouch_threshold' => 'required',
            'preview_edit_price' => 'required|numeric',
            'preview_edit_threshold' => 'required',
        ]);

        \App\Models\Category::create([
            'name' => $this->name,
            'style_price' => $this->style_price,
            'style_threshold' => $this->style_threshold,
            'culling_price' => $this->culling_price,
            'culling_threshold' => $this->culling_threshold,
            'skin_retouch_price' => $this->skin_retouch_price,
            'skin_retouch_threshold' => $this->skin_retouch_threshold,
            'preview_edit_price' => $this->preview_edit_price,
            'preview_edit_threshold' => $this->preview_edit_threshold,
        ]);

        $this->create_category_modal = false;
        $this->resetInputFields();
    }

    public function updateCategoryModalVisibility($input, $id)
    {
        $this->resetValidation();

        if (!is_bool($input)) {
            throw new \InvalidArgumentException("Modal visibility must be a boolean.");
        }

        $category = \App\Models\Category::find($id);

        if ($category) {
            $this->name = $category->name;
            $this->style_price = $category->style_price;
            $this->style_threshold = $category->style_threshold;
            $this->culling_price = $category->culling_price;
            $this->culling_threshold = $category->culling_threshold;
            $this->skin_retouch_price = $category->skin_retouch_price;
            $this->skin_retouch_threshold = $category->skin_retouch_threshold;
            $this->preview_edit_price = $category->preview_edit_price;
            $this->preview_edit_threshold = $category->preview_edit_threshold;
        }

        $this->update_category_modal = $input;
        $this->update_category_id = $id;
    }

    public function updateCategory()
    {
        $this->validate([
            'name' => 'required|unique:categories,name,' . $this->update_category_id,
            'style_price' => 'required|numeric',
            'style_threshold' => 'required',
            'culling_price' => 'required|numeric',
            'culling_threshold' => 'required',
            'skin_retouch_price' => 'required|numeric',
            'skin_retouch_threshold' => 'required',
            'preview_edit_price' => 'required|numeric',
            'preview_edit_threshold' => 'required',
        ]);

        \App\Models\Category::find($this->update_category_id)?->update([
            'name' => $this->name,
            'style_price' => $this->style_price,
            'style_threshold' => $this->style_threshold,
            'culling_price' => $this->culling_price,
            'culling_threshold' => $this->culling_threshold,
            'skin_retouch_price' => $this->skin_retouch_price,
            'skin_retouch_threshold' => $this->skin_retouch_threshold,
            'preview_edit_price' => $this->preview_edit_price,
            'preview_edit_threshold' => $this->preview_edit_threshold,
        ]);

        $this->update_category_modal = false;
        $this->resetInputFields();
    }

    public function removeCategoryModalVisibility($input, $id)
    {
        if (!is_bool($input)) {
            throw new \InvalidArgumentException("Modal visibility must be a boolean.");
        }

        $this->remove_category_modal = $input;
        $this->remove_category_id = $id;
    }

    public function removeCategory()
    {
        \App\Models\Category::destroy($this->remove_category_id);
        $this->remove_category_modal = false;
    }

    public function resetInputFields()
    {
        $this->name = null;
        $this->style_price = null;
        $this->style_threshold = null;
        $this->culling_price = null;
        $this->culling_threshold = null;
        $this->skin_retouch_price = null;
        $this->skin_retouch_threshold = null;
        $this->preview_edit_price = null;
        $this->preview_edit_threshold = null;
    }

    public function render()
    {
        $categories = \App\Models\Category::query()
            ->when($this->search, fn ($q) => $q->where('name', 'like', '%' . $this->search . '%'))
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.panel.admin.categories', [
            'categories' => $categories,
        ])->layout('layouts.dashboard.main');
    }
}
