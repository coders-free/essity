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
            @forelse ($options as $option)
                
                <div class="p-6 rounded-lg border border-gray-200 relative" wire:key="option-{{$option->id}}">

                    <div class="absolute -top-3 px-4 bg-white">
                        <button class="mr-2" wire:click="removeOption({{$option->id}})">
                            <i class="fa-solid fa-trash-can text-red-500 hover:text-red-600"></i>
                        </button>

                        <span>
                            {{$option->name}}
                        </span>
                    </div>

                    {{-- Valores --}}
                    <div class="flex mb-2 flex-wrap">
                        @foreach ($option->features as $feature)
                            
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
                        {{-- Valor --}}
                        <div class="flex-1">
                            
                            @switch($option->type)
                                @case(App\Enums\TypeOptions::Text)
                                    
                                    <x-input 
                                        label="Valor"
                                        placeholder="Valor de opcion de {{$option->name}}"
                                        wire:model="new_feature.{{$option->id}}.value" />

                                    @break
                                @case(App\Enums\TypeOptions::Color)                                    

                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-400 mb-1">
                                        Valor
                                    </label>

                                    <div class="relative dark:bg-secondary-800 dark:text-secondary-400 border border-secondary-300  dark:border-secondary-600 form-input block w-full sm:text-sm rounded-md transition ease-in-out duration-100 shadow-sm pr-[4.25rem]">
                                        <p>{{$new_feature[$option->id]['value'] ?? "Valor de opcion de {$option->name}"}}</p>

                                        <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                                            <input
                                                type="color"
                                                wire:model="new_feature.{{$option->id}}.value" />
                                        </div>
                                    </div>

                                    @break
                                @default
                                    
                            @endswitch
                        </div>

                        {{-- Descripción --}}
                        <div class="flex-1">
                            <x-input 
                                label="Descripción"
                                placeholder="Descripción de opcion para {{$option->name}}"
                                wire:model="new_feature.{{$option->id}}.description" />
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

    <x-modal.card blur
        wire:model.defer="openModal"
        title="Crear nueva opción">

        <div class="grid grid-cols-2 gap-6">

            <x-input label="Nombre" 
                placeholder="Por ejemplo: Tamaño, Color"
                wire:model="new_option.name" />

            <x-native-select label="Tipo"
                wire:model="new_option.type">

                @foreach (App\Enums\TypeOptions::cases() as $case)
                    
                    <option value="{{$case->value}}">{{$case->name}}</option>

                @endforeach

            </x-native-select>

        </div>

        <div class="mt-4 mb-6 flex items-center">
            <hr class="flex-1">

            <span class="mx-4">Valores</span>

            <hr class="flex-1">
        </div>

        <div class="mb-4 space-y-4">
            @foreach ($fields as $index => $field)

                <div class="p-6 rounded-lg border border-gray-200 relative" wire:key="feature-{{$index}}">

                    <button class="absolute -top-3 px-4 bg-white"
                        wire:click="remove_field({{$index}})"    
                    >
                        <i class="fa-solid fa-trash-can text-red-500"></i>
                    </button>

                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            

                            @switch($new_option['type'])
                                @case(App\Enums\TypeOptions::Text->value)
                                    
                                    <x-input
                                        label="Valor"
                                        wire:model="fields.{{$index}}.value"
                                        placeholder="Ingrese el valor de la opción"
                                    />

                                    @break
                                @case(App\Enums\TypeOptions::Color->value)
                                    
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-400 mb-1">
                                        Valor
                                    </label>

                                    <div class="relative dark:bg-secondary-800 dark:text-secondary-400 border border-secondary-300  dark:border-secondary-600 form-input block w-full sm:text-sm rounded-md transition ease-in-out duration-100 shadow-sm pr-[4.25rem]">
                                        <p>{{$new_feature[$option->id]['value'] ?? "Seleccione un color"}}</p>

                                        <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                                            <input
                                                type="color"
                                                wire:model="fields.{{$index}}.value" />
                                        </div>
                                    </div>

                                    @break
                                @default
                                    
                            @endswitch
                        </div>

                        <div>
                            <x-input
                                label="Etiqueta"
                                wire:model="fields.{{$index}}.description"
                                placeholder="Ingrese la etiqueta de la opción"
                            />
                        </div>
                    </div>

                </div>

            @endforeach
        </div>

        <div class="mb-4 flex justify-end">
            <x-button pink wire:click="add_new_field">
                Agregar nuevo campo
            </x-button>
        </div>

        <x-slot name="footer">
            <div class="flex justify-end">
                <x-button primary wire:click="addOption">
                    Agregar
                </x-button>
            </div>
        </x-slot>

    </x-modal.card>

</div>
