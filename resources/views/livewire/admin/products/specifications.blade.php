<div>
    
    <x-card title="Atributos">

        <x-slot name="action">
            <button class="text-blue-600 hover:text-blue-500"
                wire:click="$set('open', true)">
                Agregar nuevo atributo
            </button>
        </x-slot>

        <ul class="divide-y -my-4">
            @forelse ($product->specifications()->get() as $specification)
        
                <li class="py-4 flex justify-between">
                    <span>
                        {{ $specification->name }}
                    </span>

                    <x-button icon="trash" negative wire:click="delete({{$specification->id}})">
                    </x-button>
                </li>

            @empty
                Este producto no tiene atributos
            @endforelse
        </ul>

    </x-card>

    <x-modal.card title="Agregar nuevo atributo" blur wire:model.defer="open">

        <div>
            <x-input wire:model="name" 
                label="Nombre"
                placeholder="Ingrese un nuevo atributo" />
        </div>

        <x-slot name="footer">
            <div class="flex justify-end">
                <x-button primary wire:click="save"
                    wire:click="save">
                    Guardar
                </x-button>
            </div>
        </x-slot>

    </x-modal.card>

</div>
