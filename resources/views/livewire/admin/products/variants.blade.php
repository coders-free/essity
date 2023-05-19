<div>

    <x-card title="Opciones">
        <x-slot name="action">
            <button class="text-blue-600 hover:text-blue-500"
                wire:click="$set('openModal', true)">
                Agregar nueva opción
            </button>
        </x-slot>

        {{-- Opciones --}}
        <div class="space-y-6">
            @forelse ($product->options()->get() as $option)
                
                <div class="p-6 rounded-lg border border-gray-200 relative" wire:key="option-{{$option->id}}">

                    <div class="absolute -top-3 px-4 bg-white">
                        <button class="mr-2">
                            <i class="fa-solid fa-trash-can text-red-500 hover:text-red-600"></i>
                        </button>

                        <span>
                            {{$option->name}}
                        </span>
                    </div>

                    {{-- Valores --}}
                    <div class="flex mb-2 flex-wrap">
                        @foreach ($option->pivot->features as $feature)
                            
                            @switch($option->type)
                                @case(App\Enums\TypeOptions::Text)
                                    
                                    <x-badge md outline :label="$feature->description" class="flex-shrink-0 mr-4 mb-2">
                                        <x-slot name="append" class="relative flex items-center w-2 h-2">
                                            
                                            <i class="fa-solid fa-xmark cursor-pointer hover:text-red-500"
                                                wire:click="removeFeature({{$feature->id}})"
                                            ></i>
                                            
                                        </x-slot>
                                    </x-badge>

                                    @break
                                @case(App\Enums\TypeOptions::Color)
                                    
                                    <span class="flex-shrink-0 inline-block h-6 w-6 shadow-lg rounded-full border-2 border-gray-300 mr-4 mb-2" 
                                        style="background-color: {{$feature->value}}">
                                    </span>

                                    @break
                                @default
                                    
                            @endswitch

                        @endforeach
                    </div>

                    {{-- Nuevos valores --}}
                    <div class="space-y-4 lg:space-y-0 lg:flex lg:space-x-4">
                        
                        <div class="flex-1">
                            
                            <x-native-select label="Valor"
                                wire:model="new_feature.{{$option->id}}"
                                placeholder="Valor de opcion de {{$option->name}}">

                                <option value="">
                                    Seleccione un valor
                                </option>

                                @foreach ($this->getFeatures($option->id) as $feature)
                                    <option value="{{ $feature->id }}">
                                        {{ $feature->description }}
                                    </option>
                                @endforeach

                            </x-native-select>

                        </div>

                        <div class="lg:pt-6">
                            <x-button
                                pink 
                                wire:click="addFeature({{$option->id}})">
                                Guardar
                            </x-button>
                        </div>
                            
                    </div>

                </div> 

            @empty
                <p class="text-gray-600">Este producto no tiene opciones.</p>
            @endforelse
        </div>
 
    </x-card>

    <x-button primary wire:click="generate_variant">
        Generar variantes
    </x-button>

    <x-modal.card blur
        wire:model.defer="openModal"
        title="Agregar nueva opción">

        <div>
            <x-native-select label="Nombre" wire:model="option_id">

                @foreach ($options as $option)
                    <option value="{{$option->id}}">
                        {{$option->name}}
                    </option>
                @endforeach

            </x-native-select>
        </div>

        <div class="mt-4 mb-6 flex items-center">
            <hr class="flex-1">

            <span class="mx-4">Valores</span>

            <hr class="flex-1">
        </div>

        <div class="mb-4 space-y-4">
            @foreach ($fields as $index => $value)

                <div class="p-6 rounded-lg border border-gray-200 relative" wire:key="field-{{$index}}">

                    <button class="absolute -top-3 px-4 bg-white"
                        wire:click="removeField({{$index}})"
                    >
                        <i class="fa-solid fa-trash-can text-red-500"></i>
                    </button>

                    {{-- <div class="grid grid-cols-2 gap-6">
                        <div>
                            <x-input
                                label="Valor"
                                wire:model="fields.{{$index}}.value"
                                placeholder="Ingrese el valor de la opción"
                            />
                        </div>

                        <div>
                            <x-input
                                label="Etiqueta"
                                wire:model="fields.{{$index}}.label"
                                placeholder="Ingrese la etiqueta de la opción"
                            />
                        </div>
                    </div> --}}

                    <x-native-select label="Valores" 
                        wire:model="fields.{{$index}}.id"
                        wire:change="field_change({{$index}})">

                        <option value="">
                            Seleccione una opción
                        </option>

                        @foreach ($this->features as $feature)
                            
                            <option value="{{$feature->id}}">
                                {{$feature->description}}
                            </option>

                        @endforeach

                    </x-native-select>

                </div>

            @endforeach
        </div>

        <div class="mb-4 flex justify-end">
            <x-button pink wire:click="addField">
                Agregar nuevo campo
            </x-button>
        </div>

        <x-slot name="footer">
            <div class="flex justify-end">
                <x-button primary wire:click="addOption"
                    wire:click="addOption">
                    Guardar
                </x-button>
            </div>
        </x-slot>
        
    </x-modal.card>
</div>
