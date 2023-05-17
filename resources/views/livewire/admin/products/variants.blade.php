<div>

    <x-card title="Agregar variante">
        <x-slot name="action">
            <button class="text-blue-600 hover:text-blue-500"
                wire:click="$set('open', true)">
                Agregar variante
            </button>
        </x-slot>
     
        {{-- This product doesn't have any options --}}



        @foreach ($product->variants()->get() as $variant)
            {{-- {{$loop->iteration}} --}}


            <div class="p-6 rounded-lg border border-gray-200 relative">

                <span class="absolute -top-3 px-4 bg-white">
                    Variante {{$loop->iteration}}
                </span>

                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae quasi quisquam distinctio deserunt, reiciendis expedita laboriosam obcaecati explicabo asperiores sint natus alias doloremque veritatis quis velit est a quas accusantium!</p>
            </div>

        @endforeach


    </x-card>

    <x-modal.card blur
        wire:model.defer="open"
        title="Crear nueva variante">

        <div class="mb-8">
            <x-input
                label="Código"
                wire:model.defer="code"
                placeholder="Ingrese el código del producto"
            />
        </div>

        <div class="flex items-center mb-6">
            <hr class="flex-1">

            <span class="mx-4">
                Detalle de la variante
            </span>

            <hr class="flex-1">
        </div>

        <div class="space-y-4">

            @foreach ($options as $option)
            
                <div>
                    <x-select
                        :label="$option->name"
                        wire:model.defer="features.{{ $option->id }}"
                        placeholder="Seleccione una opción"
                        :async-data="[
                            'api' => route('api.features.index'),
                            'params' => [
                                'option_id' => $option->id
                            ]
                        ]"
                        option-label="value"
                        option-value="id"
                    />
                </div>

            @endforeach

        </div>

        <x-slot name="footer">
            <x-button pink wire:click="save" 
                wire:click="save">
                Guardar
            </x-button>
        </x-slot>
        
    </x-modal.card>
</div>
