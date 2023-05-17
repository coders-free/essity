<div>

    <x-card title="Agregar variante">
        <x-slot name="action">
            <button class="text-blue-600 hover:text-blue-500"
                wire:click="$set('open', true)">
                Agregar variante
            </button>
        </x-slot>
     
        <div class="space-y-8">

            @foreach ($product->variants()->get() as $variant)

                <div class="p-6 rounded-lg border border-gray-200 relative" wire:key="variant-{{$variant->id}}">

                    <span class="absolute -top-3 px-4 bg-white">
                        Código: {{$variant->code}}
                    </span>

                    <div class="flex">
                        <ul class="space-y-4">
                            @foreach ($variant->features as $feature)
                                <li>

                                    <p class="font-semibold">
                                        {{$feature->option->name}}
                                    </p>

                                    @switch($feature->option->type)
                                        @case(App\Enums\TypeOptions::Text)

                                            <p>{{$feature->value}}</p>

                                        @break
                                        @case(App\Enums\TypeOptions::Color)
                                            

                                            <span class="inline-flex justify-center w-28 rounded-lg shadow text-white font-semibold px-4 py-2 uppercase"
                                                style="background: {{$feature->value}}">
                                                {{$feature->value}}
                                            </span>

                                            @break
                                        @default
                                            
                                    @endswitch
                                </li>
                            @endforeach
                            
                        </ul>

                        <div class="ml-auto">
                            <button class="btn btn-red" wire:click="destroy({{$variant->id}})">
                                Eliminar
                            </button>
                        </div>
                    </div>
                </div>

            @endforeach

        </div>


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
                    {{-- <x-select
                        :label="$option->name"
                        wire:model="features.{{ $option->id }}"
                        placeholder="Seleccione una opción"
                        
                        :options="$option->features()->select('value as name', 'id')->get()"

                        option-label="name"
                        option-value="id"
                    /> --}}


                    @switch($option->type)
                        @case(App\Enums\TypeOptions::Text)

                            {{-- <x-select
                                :label="$option->name"
                                wire:model="features.{{ $option->id }}"
                                placeholder="Seleccione una opción"
                                :async-data="[
                                    'api' => route('api.features.index'),
                                    'params' => [
                                        'option_id' => $option->id
                                    ]
                                ]"
                                option-label="value"
                                option-value="id"
                            /> --}}

                            <x-select
                                :label="$option->name"
                                wire:model="features.{{ $option->id }}"
                                placeholder="Seleccione una opción"
                                
                                :options="$option->features()->select('value as name', 'id')->get()"

                                option-label="name"
                                option-value="id"
                            />
                            
                            @break
                        @case(App\Enums\TypeOptions::Color)
                            
                            <x-color-picker
                                :label="$option->name"
                                wire:model="features.{{ $option->id }}"
                                placeholder="Seleccione un color"
                                :colors="$option->features->pluck('value')"
                            />

                            @break
                        @default
                            
                    @endswitch
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
