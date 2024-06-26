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
                            <a href="{{ url('landing') }}" target="_blank" class="bg-white-100 hover:bg-red-600 hover:text-white border px-4 py-3 rounded-md text-gray-500 font-light transition-colors duration-300 ease-in-out mb-2 sm:mb-4 text-center"><i class="fas fa-robot mr-2"></i> Ir al landing/chatbot</a>
                            <div>
                                @if($currentParentId)
                                    <a href="#" wire:click="goBack" class="px-4 py-2"><i class="fas fa-arrow-left mr-2"></i> Retroceder un nivel</a>
                                @endif
                            </div>
                        </div>

                        @if (session()->has('message'))
                            <div class="bg-green-500 text-white px-4 py-2 rounded mb-4" id="sessionMessage">
                                {{ session('message') }}
                            </div>
                        @endif

                        <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                            <table class="min-w-full leading-normal">
                                <thead>
                                    <tr>
                                        <th scope="col"
                                            class="px-5 py-3 bg-gray-200 text-gray-600 uppercase text-sm leading-normal text-left border-b border-gray-200">
                                            Ref.
                                        </th>
                                        <th scope="col"
                                            class="px-5 py-3 bg-gray-200 text-gray-600 uppercase text-sm leading-normal text-left border-b border-gray-200">
                                            Escuela
                                        </th>
                                        <th scope="col"
                                            class="px-5 py-3 bg-gray-200 text-gray-600 uppercase text-sm leading-normal text-left border-b border-gray-200">
                                            Opción
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
                                                {{ $menuOption->acronym_esc }}
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                {{ $menuOption->desc_opcion }}
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                {!! $menuOption->respuesta !!}
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm" style="width: 250px;">
                                                <button wire:click="edit({{ $menuOption->id }})"
                                                    class="bg-red-700 text-white  hover:bg-red-800 px-4 py-2 rounded text-center text-white font-light transition-colors duration-300 ease-in-out">Editar</button>
                                                @if ($menuOption->hasSubOptions($menuOption->id))
                                                    <button wire:click="setParent({{ $menuOption->id }})"
                                                        class="bg-gray-700 text-white px-4 py-2 rounded">Sub-opciones</button>
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
                        <div class="bg-white p-8 w-full max-w-2xl mx-4 rounded-lg shadow-lg">
                            <h3 class="text-lg font-semibold mb-4">Editar opción de chatbot</h3>
                            <form wire:submit.prevent="update">
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">Opción</label>
                                    <input wire:model.defer="desc_opcion" type="text"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    @error('desc_opcion') <span
                                        class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">Respuesta</label>


                                    <div wire:ignore>
                                    <textarea wire:model.defer="respuesta" id="ckeditor_respuesta"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    </textarea>
                                    </div>
                                        @error('respuesta')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror

                                </div>
                                <div class="flex justify-end">
                                    <button type="button" wire:click="closeModal"
                                        class="px-4 py-2 text-gray-500 bg-gray-200 rounded mr-2">Cancelar</button>
                                    <button type="submit"
                                        class="px-4 py-2 text-white bg-red-700 text-white  hover:bg-red-800 rounded">Guardar
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
<script src="{{ asset('assets/js/ckeditor.js') }}"></script>
{{-- <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script> --}}

<script>
    document.addEventListener('livewire:init', function () {
        console.log('oooo');
        Livewire.on('oopenModal', () => {
            setTimeout(() => {

                    ClassicEditor
                        .create(document.querySelector('#ckeditor_respuesta'), {
                            extraPlugins: [ 'SourceEditing' ],
                            toolbar: {
                                items: [
                                    'sourceEditing', '|',
                                    'undo',
                                    'redo',
                                    '|',
                                    'bold',
                                    'italic',
                                    '|',
                                    'link',
                                    'bulletedList',
                                    'numberedList',
                                    '|'
                                    // Más íconos aquí según sea necesario
                                ]
                            },
                            contentCss: [
                                '{{ asset('assets/css/ckedirtor.css') }}', // Reemplaza con la ruta correcta a tu archivo CSS
                                            'https://cdn.jsdelivr.net/npm/tailwindcss@3.4.4/dist/tailwind.min.css' // Tailwind CSS

                            ]
                        })
                        //.create(document.querySelector('#ckeditor_respuesta'))
                        .then(editor => {
                            editor.model.document.on('change:data', () => {
                                @this.set('respuesta', editor.getData());
                            });
                        })
                        .catch(error => {
                            console.error(error);
                        });

            }, 100); // Ajusta el tiempo de espera según sea necesario
        });


    });
</script>
@endpush
