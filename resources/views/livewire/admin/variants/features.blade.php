<div x-data="data">
    
    @if ($features->count())
        <form wire:submit.prevent="update">
            <ul class="space-y-2">

                @foreach ($features as $index => $feature)

                    <li wire:key="feature-field-{{ $index }}">

                        <div class="flex">
                            

                            @switch($option->type)
                                @case(App\Enums\TypeOptions::Text)

                                    <x-jet-input class="w-full mr-2" type="text"
                                        wire:model.defer="features.{{ $index }}.value" />
                                    
                                    @break
                                @case(App\Enums\TypeOptions::Color)
                                    
                                    <x-color-picker 
                                        class="w-full mr-2"
                                        wire:model.defer="features.{{ $index }}.value"
                                        placeholder="Select the car color" />

                                    @break
                                @default
                                    
                            @endswitch

                            <div class="flex border border-gray-300 rounded-lg divide-x divide-gray-300">

                                <div class="flex items-center px-2 cursor-pointer hover:text-red-500"
                                    x-on:click="destroyFeature({{ $feature->id }})">
                                    <i class="far fa-trash-alt"></i>
                                </div>

                            </div>

                        </div>

                        <x-input-error for="features.{{ $index }}.name" />

                    </li>

                @endforeach

            </ul>

            <div class="flex justify-end items-center mt-3">
                <x-action-message class="mr-3" on="saved">
                    Atributos actualizadas
                </x-action-message>

                <x-button type="submit" pink>
                    Actualizar
                </x-button>
            </div>
        </form>
    @endif

    <div x-data="{
        open: false,
    }">
        <div x-on:click="open = !open"
            class="h-6 w-12 bg-indigo-200 flex items-center justify-center cursor-pointer"
            style="clip-path: polygon(75% 0%, 100% 50%, 75% 100%, 0% 100%, 0 51%, 0% 0%);">

            <i class="-ml-2 text-sm fas fa-plus transition duration-300" :class="{ 'transform rotate-45': open }"></i>
        </div>

        <form wire:submit.prevent="store" class="bg-gray-100 rounded-lg shadow-lg p-6 mt-4 mb-6 hidden"
            :class="{ 'hidden': !open }">

            @switch($option->type)
                @case(App\Enums\TypeOptions::Text)

                    <x-input label="Nuevo atributo"
                        wire:model.defer="value"
                        placeholder="Ingrese el nombre de una sección" />
                    
                    @break
                @case(App\Enums\TypeOptions::Color)
                    
                    <x-color-picker label="Select a Color" 
                        wire:model.defer="value"
                        placeholder="Select the car color" />

                    @break
                @default
                    
            @endswitch


            <div class="flex justify-end mt-4">
                <x-button negative x-on:click="open = false">
                    Cancelar
                </x-button>

                <x-button dark type="submit" class="ml-2">
                    Agregar
                </x-button>
            </div>
        </form>
    </div>

    @push('js')

        {{-- sweetalert2 --}}
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        
        <script>
            function data() {
                return {
                    destroyFeature(id){

                        Swal.fire({
                            title: '¿Estas seguro?',
                            text: "¡No podrás revertir esto.!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: '¡Si, eliminar!',
                            cancelButtonText: 'Cancelar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                )
                                @this.destroy(id);
                            }
                        })
                    }
                }
            }
        </script>

    @endpush

</div>
