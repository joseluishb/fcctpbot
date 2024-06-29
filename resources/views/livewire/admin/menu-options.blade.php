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

                        <div class="flex justify-between items-center mb-4">
                            @if ($parent_name)
                                Opción padre: {{ $parent_name }}
                            @endif
                        </div>


                        <div class="inline-block min-w-full shadow rounded-lg ">
                            <table class="min-w-full leading-normal">
                                <thead>
                                    <tr>
                                        <th scope="col"
                                            class="px-5 py-3 bg-gray-200 text-gray-600 uppercase text-sm leading-normal text-left border-b border-gray-200">
                                            ID
                                        </th>
                                        <th scope="col"
                                            class="px-5 py-3 bg-gray-200 text-gray-600 uppercase text-sm leading-normal text-left border-b border-gray-200">
                                            Ref.
                                        </th>
                                        <th scope="col"
                                            class="px-5 py-3 bg-gray-200 text-gray-600 uppercase text-sm leading-normal text-left border-b border-gray-200">

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
                                            Instrucciones
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
                                                {{ $menuOption->id }}
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                {{ $menuOption->id_proceso }}
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                {{ $menuOption->acronym_esc }}
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm relative">
                                                {{ $menuOption->desc_opcion }}

                                                <p class="italic relative">
                                                    {!! $menuOption->executes_system_process ? '<a href="javascript:" class="relative group"><i class="fas fa-exclamation-circle"></i> Ejecuta proceso interno<span class="absolute left-1/2 transform -translate-x-1/2 bottom-full mb-2 w-48 p-2 text-sm text-white bg-black rounded opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-500">' . $menuOption->exec_system_process_instructions . '</span></a>': '' !!}
                                                    {{ $menuOption->is_system_option ? 'Opción para proceso interno': '' }}
                                                </p>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                @if($menuOption->requires_response)
                                                    <i class="fas fa-comment-dots"></i>
                                                @endif
                                                {!! $menuOption->respuesta !!}

                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <span style="font-size: 12px;">{!! $menuOption->instructivo !!}</span>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm" style="width: 290px;">
                                                <button wire:click="edit({{ $menuOption->id }})"
                                                    class="bg-red-700 text-white  hover:bg-red-800 px-4 py-2 rounded text-center text-white font-light transition-colors duration-300 ease-in-out">Editar</button>
                                                @if ($menuOption->hasSubOptions($menuOption->id))
                                                    <button wire:click="setParent({{ $menuOption->id }})"
                                                        class="bg-gray-700 text-white  hover:bg-gray-800 px-4 py-2 rounded text-center text-white font-light transition-colors duration-300 ease-in-out">Sub-opciones</button>
                                                @endif
                                                <button wire:click="showTreeDiagram({{ $menuOption->id }})"
                                                    class="bg-gray-700 text-white  hover:bg-gray-800 px-4 py-2 rounded text-center text-white font-light transition-colors duration-300 ease-in-out"><i class="fas fa-project-diagram"></i></button>
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
                                <div class="mb-4">
                                    <div class="bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3" role="alert">
                                        <p class="font-bold">Instrucciones de respuesta</p>
                                        <p class="text-sm italic">{{ ($instructivo != '') ? $instructivo : 'Sin instrucciones' }}</p>
                                    </div>
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

                {{-- Modal para ver el diagrama de las sub-opciones del option padre --}}
                @if($isModalOpenOptionRoot)
                    {{-- <div class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-75">
                        <div class="bg-white p-8 w-full max-w-2xl mx-4 rounded-lg shadow-lg">
                            <h3 class="text-lg font-semibold mb-4">Root</h3>

                            <div class="mermaid" id="menu-diagram">
                                <!-- Aquí se inyectará el diagrama de Mermaid -->
                            </div>
                        </div>
                    </div> --}}

                    <div class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-75">
                        <div class="bg-white w-full max-w-screen-xl mx-auto rounded-lg shadow-lg">
                            <div class="flex flex-col h-full">

                                <div class="bg-white px-4 py-2 flex justify-between items-center rounded-t-lg">

                                    <h3 class="text-lg font-semibold mb-4">Vista diagrama</h3>
                                    <button class="text-gray-600 hover:text-gray-800 focus:outline-none" wire:click="closeModalDiagram">
                                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                                <div class="mermaid flex-1 p-8">
                                    <!-- Aquí se inyectará el diagrama de Mermaid -->
                                    <div id="menu-diagram" class="h-full" >
                                        <!-- Contenido del diagrama -->
                                    </div>
                                </div>
                            </div>
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
        console.log('oooohhhhh');
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

            }, 100);
        });


    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        Livewire.on('ooopenModal', (event) => {
            let menuJson = event[0].menuJson;

            if (!Array.isArray(menuJson)) {
                menuJson = JSON.parse(menuJson); // Convertir a array si es un objeto JSON
            }



            setTimeout(() => {
                console.log(menuJson );

                renderMermaidDiagram(menuJson, 'menu-diagram');
            }, 100);
        });
    });
</script>
@endpush
