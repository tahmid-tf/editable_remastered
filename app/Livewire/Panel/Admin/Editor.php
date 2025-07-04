<?php

namespace App\Livewire\Panel\Admin;

use Livewire\Component;

class Editor extends Component
{

    public $name;
    public $create_editor_modal = false;
    public $remove_editor_modal = false;
    public $remove_editor_id = null;

    // ----------- update editor block

    public $update_editor_modal = false;
    public $update_editor_id = null;

    public $search;

    public $editors;

    public function mount()
    {
        $this->editors = \App\Models\Editor::latest();
    }

    public function refreshEditors()
    {
        $this->editors = \App\Models\Editor::latest();
    }


//    ---------- create editor modal and method

    public function createEditorModalVisibility($input)
    {
        if (!is_bool($input)) {
            throw new \InvalidArgumentException("Modal visibility must be a boolean.");
        }

        $this->create_editor_modal = $input;
    }

    public function createEditor()
    {
        $inputs = $this->validate([
            'name' => 'required|unique:editors,name',
        ]);

        \App\Models\Editor::create([
            'name' => $this->name,
        ]);

        $this->create_editor_modal = false;
        $this->refreshEditors();
    }


//    ---------- update editor modal and method

    public function updateEditorModalVisibility($input, $id)
    {
        $this->resetValidation(); // ← clear previous errors

        if (!is_bool($input)) {
            throw new \InvalidArgumentException("Modal visibility must be a boolean.");
        }

        $this->name = \App\Models\Editor::find($id)->name ?? null;

        $this->update_editor_modal = $input;
        $this->update_editor_id = $id;
    }

    public function updateEditor(){

        $inputs = $this->validate([
            'name' => 'required|unique:editors,name,' . $this->update_editor_id,
        ]);

        \App\Models\Editor::find($this->update_editor_id)->update([
            'name' => $this->name,
        ]);

        $this->update_editor_modal = false;
        $this->refreshEditors();
    }


//    ---------- remove editor method ----------

    public function removeEditorModalVisibility($input, $id)
    {
        if (!is_bool($input)) {
            throw new \InvalidArgumentException("Modal visibility must be a boolean.");
        }
        $this->remove_editor_modal = $input;
        $this->remove_editor_id = $id;
    }

    public function removeEditor()
    {
        \App\Models\Editor::destroy($this->remove_editor_id);
        $this->remove_editor_modal = false;
        $this->refreshEditors();
    }


//    -------------- render with live search --------------

    public function render()
    {
        $this->editors = \App\Models\Editor::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy('Id','desc')->get();

        return view('livewire.panel.admin.editor')->layout('layouts.dashboard.main');
    }

}
