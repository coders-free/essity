<div>
    
    <x-card title="Descuentos">

        <x-slot name="action">
            <button class="text-blue-600 hover:text-blue-500"
                wire:click="$set('open', true)">
                Agregar nueva descuento
            </button>
        </x-slot>

        <ul class="divide-y -my-4">

            @forelse ($cluster->discounts()->get() as $discount)
                
                <li class="py-4">
                    
                    <x-button.circle negative icon="x" 2xs 
                        wire:click="destroyDiscount({{$discount->id}})"
                        wire:target="destroyDiscount({{$discount->id}})" />

                    @switch($discount->discountable_type)
                        @case('App\Models\Line')
                            
                            <p class="mb-1">
                                <span class="font-semibold">
                                    Linea: 
                                </span>

                                {{App\Models\Line::find($discount->discountable_id)->name}}
                            </p>
                            
                            @break
                        @case('App\Models\Category')

                            <p class="mb-1">
                                <span class="font-semibold">
                                    Categoría:
                                </span>

                                {{App\Models\Category::find($discount->discountable_id)->name}}
                            </p>
                                                        
                            @break
                        @default
                            
                    @endswitch

                    <ul class="flex">

                        @foreach ($discount->content as $item)
                            
                            <li class="px-4 border border-gray-200">
                                
                                <span class="font-semibold">{{$item->discount}}%</span>
                                <span class="font-semibold">x</span>
                                <span class="font-semibold">{{$item->quantity}} o más</span>
                                
                            </li>

                        @endforeach

                    </ul>
                    
                </li>

            @empty
                
                <li class="py-4">
                    Este cluster no tiene descuentos
                </li>

            @endforelse

        </ul>

    </x-card>

    <x-modal.card title="Agregar nuevo descuento" blur wire:model.defer="open">


        <div class="mb-4">
            <x-toggle wire:model="discount_category" label="Descuento a categoría" />
        </div>

        <div class="mb-4">

            <x-native-select label="Linea" wire:model="line_id">

                @foreach ($lines as $line)

                    <option value="{{$line->id}}">{{$line->name}}</option>
                    
                @endforeach

            </x-native-select>

        </div>

        @if ($discount_category)

            <x-native-select label="Categorías" wire:model="category_id">

                <option value="">Seleccione una categoría</option>

                @foreach ($this->categories as $category)

                    <option value="{{$category->id}}">{{$category->name}}</option>
                    
                @endforeach

            </x-native-select>

        @endif

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

                    <div class="grid grid-cols-2 gap-6">

                        <div>
                            <x-input label="Cantidad" 
                                type="number"
                                wire:model="fields.{{$index}}.quantity" />
                        </div>

                        <div>

                            <x-input label="Descuento" 
                                type="number"
                                wire:model="fields.{{$index}}.discount" />

                        </div>

                    </div>

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
                <x-button primary wire:click="addDiscount"
                    wire:click="addDiscount">
                    Guardar
                </x-button>
            </div>
        </x-slot>

    </x-modal.card>

</div>
