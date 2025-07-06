<?php

namespace App\Livewire\Panel\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Style;
use App\Models\Category;

class StylesView extends Component
{
    use WithPagination, WithFileUploads;

    public $name, $description, $image, $old_image;

    public $selectedCategories = [];
    public $is_additional = 'no';
    public $is_culling = false;
    public $is_skin_retouch = false;
    public $is_preview_edit = false;

    public $create_style_modal = false;
    public $update_style_modal = false;
    public $remove_style_modal = false;

    public $update_style_id = null;
    public $remove_style_id = null;

    public $search = '';
    public $perPage = 10;
    public $sortField = 'id';
    public $sortDirection = 'asc';

    protected $paginationTheme = 'bootstrap';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        $this->sortDirection = $this->sortField === $field && $this->sortDirection === 'asc' ? 'desc' : 'asc';
        $this->sortField = $field;
    }

    public function createStyleModalVisibility($input)
    {
        $this->resetInputFields();
        $this->create_style_modal = $input;
    }

    public function createStyle()
    {
        $this->validate(['name' => 'required|string|max:255']);

        $imagePath = $this->image ? $this->image->store('styles', 'public') : null;

        Style::create([
            'name' => $this->name,
            'description' => $this->description,
            'image' => $imagePath,
            'categories' => json_encode($this->selectedCategories),
            'is_additional' => $this->is_additional,
            'is_culling' => $this->is_culling,
            'is_skin_retouch' => $this->is_skin_retouch,
            'is_preview_edit' => $this->is_preview_edit,
        ]);

        $this->create_style_modal = false;
        $this->resetInputFields();
    }

    public function updateStyleModalVisibility($input, $id)
    {
        $style = Style::findOrFail($id);

        $this->name = $style->name;
        $this->description = $style->description;
        $this->selectedCategories = json_decode($style->categories, true) ?? [];
        $this->is_additional = $style->is_additional ?? 'no';
        $this->is_culling = (bool) $style->is_culling;
        $this->is_skin_retouch = (bool) $style->is_skin_retouch;
        $this->is_preview_edit = (bool) $style->is_preview_edit;
        $this->old_image = $style->image;

        $this->update_style_id = $id;
        $this->update_style_modal = $input;
    }

    public function updateStyle()
    {
        $this->validate(['name' => 'required|string|max:255']);

        $style = Style::findOrFail($this->update_style_id);

        $imagePath = $this->image ? $this->image->store('styles', 'public') : $this->old_image;

        $style->update([
            'name' => $this->name,
            'description' => $this->description,
            'image' => $imagePath,
            'categories' => json_encode($this->selectedCategories),
            'is_additional' => $this->is_additional,
            'is_culling' => $this->is_culling,
            'is_skin_retouch' => $this->is_skin_retouch,
            'is_preview_edit' => $this->is_preview_edit,
        ]);

        $this->update_style_modal = false;
        $this->resetInputFields(true);
    }

    public function closeUpdateModal()
    {
        $this->update_style_modal = false;
        $this->resetInputFields(true);
    }

    public function removeStyleModalVisibility($input, $id)
    {
        $this->remove_style_modal = $input;
        $this->remove_style_id = $id;
    }

    public function removeStyle()
    {
        Style::destroy($this->remove_style_id);
        $this->remove_style_modal = false;
    }

    public function resetInputFields($keepOldImage = false)
    {
        $this->name = $this->description = $this->image = null;
        if (!$keepOldImage) {
            $this->old_image = null;
        }
        $this->selectedCategories = [];
        $this->is_additional = 'no'; // <-- force default
        $this->is_culling = $this->is_skin_retouch = $this->is_preview_edit = false;
    }


    public function getAllCategoriesProperty()
    {
        return Category::all();
    }

    public function render()
    {
        return view('livewire.panel.admin.styles-view', [
            'styles' => Style::where('name', 'like', '%' . $this->search . '%')
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->perPage),
            'allCategories' => $this->getAllCategoriesProperty(),
        ])->layout('layouts.dashboard.main');
    }
}
