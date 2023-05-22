<div>
    
    <div class="mb-4">
        <x-card>

            <div class="mb-4">
                <x-input label="Nombre" wire:model="name" placeholder="Ingrese un nombre" />
            </div>
    
            <div class="mb-4">
                <input type="file" wire:model="file" id="{{$file_id}}" />
            </div>
    
            <div class="flex justify-end">
    
                <x-button wire:click="save" pink>
                    Guardar
                </x-button>
    
            </div> 
        </x-card>
    </div>

    <div>
        <x-card>


            <ul class="divide-y -my-4">

                

                @forelse ($digital_materials as $material)
                    <li class="py-4 flex justify-between items-center">

                        <p>
                            {{$material->name}}
                        </p>

                        <div>
                            <x-button negative wire:click="destroy({{$material->id}})">
                                Eliminar
                            </x-button>

                            <x-button dark wire:click="download({{$material->id}})">
                                Descargar
                            </x-button>
                        </div>

                    </li>
                @empty
                    <li class="py-4">

                        <p>
                            No hay materiales digitales
                        </p>

                    </li>
                @endforelse

            </ul>


        </x-card>
    </div>

</div>
