<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\MenuOption;

class MenuOptions extends Component
{
    ///public $menuOptions;
    public $currentParentId = null;
    public $menuOptionId;
    public $desc_opcion;
    public $respuesta;
    public $isModalOpen = false;

    public $message;

    protected $rules = [
        'desc_opcion' => 'required',
        'respuesta' => 'required',
    ];
    protected $listeners = ['setParent'];

    public function mount()
    {

    }

    public function render()
    {
        $menuOptions = $this->getMenuOptions($this->currentParentId);
        //dd($menuOptions);
        return view('livewire.admin.menu-options')->with(['menu_options' => $menuOptions]);
    }

    public function getMenuOptions($parentId)
    {
        return MenuOption::where('parent_id', $parentId)->orderBy('num_opcion')->get();
    }

    public function setParent($id)
    {
        // Actualizar el identificador del padre actual y las opciones de menú
        $this->currentParentId = $id;
    }

    public function goBack()
    {
        // Ir hacia atrás al nivel anterior del menú
        if ($this->currentParentId) {
            $parent = MenuOption::find($this->currentParentId)->parent_id;
            $this->currentParentId = $parent;
        }
    }

    public function edit($id)
    {
        $menuOption = MenuOption::findOrFail($id);
        $this->menuOptionId = $id;
        $this->desc_opcion = $menuOption->desc_opcion;
        $this->respuesta = $menuOption->respuesta;

        $this->openModal();

    }

    public function update()
    {
        $this->validate([
            'desc_opcion' => 'required',
            //'respuesta' => 'required', // Esta línea ha sido eliminada
        ]);

        if ($this->menuOptionId) {
            $menuOption = MenuOption::findOrFail($this->menuOptionId);
            $menuOption->update([
                'desc_opcion' => $this->desc_opcion,
                'respuesta' => $this->respuesta,
            ]);
        }

        session()->flash('message', 'Opción de menú actualizada.');

        $this->closeModal();
        $this->resetForm();
    }

    public function openModal()
    {
        $this->isModalOpen = true;
        $this->dispatch('oopenModal');
    }

    public function closeModal()
    {
        $this->isModalOpen = false;

    }

    private function resetForm()
    {
        $this->menuOptionId = null;
        $this->desc_opcion = '';
        $this->respuesta = '';
    }


}
