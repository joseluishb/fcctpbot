<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\MenuOption;

class MenuOptions extends Component
{
    public $isModalOpen = false;
    public $isModalOpenOptionRoot = false;
    public $currentParentId = null;
    public $menuOptionId;
    public $desc_opcion;
    public $respuesta;
    public $instructivo;
    public $is_system_option;
    public $executes_system_process;


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

        return view('livewire.admin.menu-options')->with(['menu_options' => $menuOptions]);
    }

    public function getMenuOptions($parentId)
    {
        return MenuOption::where('parent_id', $parentId)->orderBy('id_proceso')->get();
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
        $this->instructivo = $menuOption->instructivo;
        $this->is_system_option = $menuOption->is_system_option;
        $this->executes_system_process = $menuOption->executes_system_process;

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

    public function closeModalDiagram()
    {
        $this->isModalOpenOptionRoot = false;
    }

    private function resetForm()
    {
        $this->menuOptionId = null;
        $this->desc_opcion = '';
        $this->respuesta = '';
    }

    public function showTreeDiagram($id)
    {

        // Obtener los datos del árbol de opciones de menú
        $menuData = $this->getMenuOptionsTree($id);

        // Convertir a JSON
        //$menuJson = json_encode($menuData);
        $menuJson = json_encode($menuData, JSON_PRETTY_PRINT);

        $this->isModalOpenOptionRoot = true;



        $this->dispatch('ooopenModal', ['menuJson' => $menuJson]);
    }

    public function getMenuOptionsTree($rootId)
    {
        $sql = "
        WITH RECURSIVE AllChildren AS (
            SELECT
                id,
                parent_id,
                desc_opcion
            FROM
                menu_options
            WHERE
                id = :rootId

            UNION ALL

            SELECT
                child.id,
                child.parent_id,
                child.desc_opcion
            FROM
                menu_options child
            INNER JOIN AllChildren parent ON
                child.parent_id = parent.id
        )

        SELECT
            id,
            parent_id as parent,
            desc_opcion as name
        FROM
            AllChildren;
      ";

        $menuData = DB::select($sql, ['rootId' => $rootId]);

        $menuFormatted = [];
        foreach ($menuData as $item) {
            if ($item->parent === null) {
                $menuFormatted[] = [
                    'key' => $item->id,
                    'name' => $item->name,
                ];
            } else {
                $menuFormatted[] = [
                    'key' => $item->id,
                    'parent' => $item->parent,
                    'name' => $item->name,
                ];
            }
        }

        return $menuFormatted;
    }

}
