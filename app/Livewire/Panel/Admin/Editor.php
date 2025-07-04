<?php

namespace App\Livewire\Panel\Admin;

use Livewire\Component;
use Livewire\WithPagination;

class Editor extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 5;
    public $sortField = 'name';
    public $sortDirection = 'asc';

    public $create_editor_modal = false;
    public $update_editor_modal = false;
    public $remove_editor_modal = false;

    public $name;
    public $update_editor_id = null;
    public $remove_editor_id = null;

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

    public function createEditorModalVisibility($input)
    {
        $this->create_editor_modal = $input;
    }

    public function createEditor()
    {
        $this->validate([
            'name' => 'required|unique:editors,name',
        ]);

        \App\Models\Editor::create([
            'name' => $this->name,
        ]);

        $this->create_editor_modal = false;
        $this->name = null;
    }

    public function updateEditorModalVisibility($input, $id)
    {
        $this->resetValidation();

        $this->update_editor_modal = $input;
        $this->update_editor_id = $id;
        $this->name = \App\Models\Editor::find($id)?->name ?? '';
    }

    public function updateEditor()
    {
        $this->validate([
            'name' => 'required|unique:editors,name,' . $this->update_editor_id,
        ]);

        \App\Models\Editor::find($this->update_editor_id)?->update([
            'name' => $this->name,
        ]);

        $this->update_editor_modal = false;
        $this->name = null;
    }

    public function removeEditorModalVisibility($input, $id)
    {
        $this->remove_editor_modal = $input;
        $this->remove_editor_id = $id;
    }

    public function removeEditor()
    {
        \App\Models\Editor::destroy($this->remove_editor_id);

        $this->remove_editor_modal = false;
    }

    public function render()
    {
        $editors = \App\Models\Editor::query()
            ->when($this->search, fn ($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.panel.admin.editor', [
            'editors' => $editors,
        ])->layout('layouts.dashboard.main');
    }
}
