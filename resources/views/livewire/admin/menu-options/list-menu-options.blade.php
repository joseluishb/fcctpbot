<div class="mx-auto py-4">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl">Opciones de Menú</h2>
        <div>
            @if($currentParentId)
                <button wire:click="goBack" class="bg-gray-500 text-white px-4 py-2 rounded">Atrás</button>
            @endif
            <button wire:click="create" class="bg-blue-500 text-white px-4 py-2 rounded">Crear Opción</button>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-500 text-white px-4 py-2 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <table class="table-auto w-full">
        <thead>
            <tr>
                <th class="px-4 py-2">Descripción</th>
                <th class="px-4 py-2">Respuesta</th>
                <th class="px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($menuOptions as $menuOption)
                <tr>
                    <td class="border px-4 py-2">{{ $menuOption->desc_opcion }}</td>
                    <td class="border px-4 py-2">{{ $menuOption->respuesta }}</td>
                    <td class="border px-4 py-2">
                        <button wire:click="edit({{ $menuOption->id }})" class="bg-yellow-500 text-white px-4 py-2 rounded">Editar</button>
                        <button wire:click="delete({{ $menuOption->id }})" class="bg-red-500 text-white px-4 py-2 rounded">Eliminar</button>
                        <button wire:click="setParent({{ $menuOption->id }})" class="bg-green-500 text-white px-4 py-2 rounded">Sub-opciones</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($isModalOpen)
        @include('livewire.create-menu-option')
    @endif

    @if($isEditModalOpen)
        @include('livewire.edit-menu-option')
    @endif
</div>
