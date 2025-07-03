<?php

namespace App\Livewire\Panel\Admin;

use Livewire\Component;

class Editor extends Component
{

    public $name;
    public $create_editor_modal = false;
    public $editors;

    public function mount(){
        $this->editors = \App\Models\Editor::all();
    }

    public function refreshEditors()
    {
        $this->editors = \App\Models\Editor::all();
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
        $inputs =  $this->validate([
            'name' => 'required|unique:editors,name',
        ]);

        \App\Models\Editor::create([
            'name' => $this->name,
        ]);

        $this->create_editor_modal = false;
        $this->refreshEditors();
    }




    public function render()
    {
        return view('livewire.panel.admin.editor')->layout('layouts.dashboard.main');
    }
}
