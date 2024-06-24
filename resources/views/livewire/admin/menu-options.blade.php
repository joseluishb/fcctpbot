<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Manejo de opciones del bot') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">

                    <div class="-mx-4 overflow-x-auto">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-2xl">Opciones</h2>
                            <div>
                                @if($currentParentId)
                                    <button wire:click="goBack" class="bg-gray-500 text-white px-4 py-2 rounded">Retroceder un nivel</button>
                                @endif
                            </div>
                        </div>

                        @if (session()->has('message'))
                            <div class="bg-green-500 text-white px-4 py-2 rounded mb-4">
                                {{ session('message') }}
                            </div>
                        @endif

                        <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                            <table class="min-w-full leading-normal">
                                <thead>
                                    <tr>
                                        <th scope="col"
                                            class="px-5 py-3 bg-gray-200 text-gray-600 uppercase text-sm leading-normal text-left border-b border-gray-200">
                                            Referencia
                                        </th>
                                        <th scope="col"
                                            class="px-5 py-3 bg-gray-200 text-gray-600 uppercase text-sm leading-normal text-left border-b border-gray-200">
                                            Pregunta
                                        </th>
                                        <th scope="col"
                                            class="px-5 py-3 bg-gray-200 text-gray-600 uppercase text-sm leading-normal text-left border-b border-gray-200">
                                            Respuesta
                                        </th>
                                        <th scope="col"
                                            class="px-5 py-3 bg-gray-200 text-gray-600 uppercase text-sm leading-normal text-left border-b border-gray-200">
                                            Acciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($menu_options as $menuOption)
                                        <tr wire:key="tr_option_{{ $menuOption->id }}">
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                {{ $menuOption->id_proceso }}
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                {{ $menuOption->desc_opcion }}
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                {{ $menuOption->respuesta }}
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <button wire:click="edit({{ $menuOption->id }})"
                                                    class="bg-yellow-500 text-white px-4 py-2 rounded">Editar</button>
                                                @if ($menuOption->hasSubOptions($menuOption->id))
                                                    <button wire:click="setParent({{ $menuOption->id }})"
                                                        class="bg-green-500 text-white px-4 py-2 rounded">Sub-opciones</button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                {{-- Modal para editar --}}
                @if($isModalOpen)
                    <div class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-75">
                        <div class="bg-white p-8 w-full max-w-4xl mx-4 rounded-lg shadow-lg">
                            <h3 class="text-lg font-semibold mb-4">Editar Opción de Menú</h3>
                            <form wire:submit.prevent="update">
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">Descripción</label>
                                    <input wire:model.defer="desc_opcion" type="text"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    @error('desc_opcion') <span
                                        class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">Respuesta</label>
                                    <textarea wire:model.defer="respuesta" id="respuesta"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    </textarea>
                                        @error('respuesta')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                </div>
                                <div class="flex justify-end">
                                    <button type="button" wire:click="closeModal"
                                        class="px-4 py-2 text-gray-500 bg-gray-200 rounded mr-2">Cancelar</button>
                                    <button type="submit"
                                        class="px-4 py-2 text-white bg-blue-500 rounded">Guardar
                                        Cambios</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>

    @push('scripts')

    @endpush
