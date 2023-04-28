<div>

    <form wire:submit.prevent="save()">

        <x-input label="Nombre" 
            placeholder="Escriba el nombre de la variante"
            wire:model="variant.name"
            class="mb-4"
        />

        <div class="flex justify-end">
            <x-button pink class="btn btn-magenta">
                Actualizar
            </x-button>
        </div>

    </form>

    {{-- <x-card class="p-8" title="Atributos">

        @if ($attributes->count())

            <form wire:submit.prevent="update">

                <ul class="space-y-2">
                    @foreach ($attributes as $index => $attribute)
                        <li wire:key="attribute-field-{{ $index }}">

                            <div class="flex">
                                <x-input wire:model.defer="attributes.{{ $index }}.name" />

                                <div class="flex border border-l-0 border-gray-300 rounded-r  divide-x divide-gray-300">

                                    <div class="flex items-center px-2 cursor-pointer hover:text-red-500"
                                        x-on:click="destroyAttribute({{ $attribute->id }})">
                                        <i class="far fa-trash-alt"></i>
                                    </div>

                                    <div class="flex items-center px-2 cursor-move">
                                        <i class="fas fa-bars"></i>
                                    </div>
                                </div>

                            </div>

                            <x-input-error for="attributes.{{ $index }}.name" />
                        </li>
                    @endforeach
                </ul>

                <div class="flex justify-end items-center mt-3">
                    <x-action-message class="mr-3" on="saved">
                        Atributos actualizadas
                    </x-action-message>

                    <x-button>
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

            <form wire:submit.prevent="saveAttribute" class="bg-gray-100 rounded-lg shadow-lg p-6 mt-4 mb-6 hidden"
                :class="{ 'hidden': !open }">

                <x-input label="Nuevo atributo"
                    wire:model.defer="attributeName"
                    placeholder="Ingrese el nombre de una sección" />

                <div class="flex justify-end mt-4">
                    <x-danger-button x-on:click="open = false">
                        Cancelar
                    </x-danger-button>

                    <x-button type="submit" class="ml-2">
                        Agregar
                    </x-button>
                </div>
            </form>
        </div>

    </x-card> --}}

</div>
