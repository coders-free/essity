<div>
    
    <div class="card">
        <div class="card-body">

            <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">

                <div class="lg:col-span-2">
                    <figure>
                        <img src="{{ $this->variant->image }}" 
                            class="aspect-square object-cover object-center w-full" 
                            alt="">
                    </figure>
                </div>

                <div class="lg:col-span-3">
                    <h1 class="text-4xl font-bold text-darkblue-500">
                        {{ $product->name }}
                    </h1>
                    
                    <p class="py-2">CN: {{ $this->variant->code }}</p>

                    <hr class="mb-4">

                    @if ($product->specifications)
                        
                        <ul class="-mt-4 mb-4">
                            @foreach ($product->specifications as $specification)
                            
                                <li class="py-2 border-b border-gray-200">
                                    <span class="font-semibold mr-2">
                                        Atributo {{$loop->iteration}}:
                                    </span>

                                    {{ $specification->name }}
                                </li>

                            @endforeach
                        </ul>

                    @endif

                    <div class="flex flex-wrap">
                        @foreach ($product->options as $option)
                            <div class="mr-4 mb-4">
                                <p class="font-semibold text-lg mb-2">
                                    {{ $option->name }}
                                </p>

                                <ul class="flex items-center space-x-4">
                                    @foreach ($option->pivot->features as $feature)
                                        <li>
                                            
                                            @switch($option->type)
                                                @case(App\Enums\TypeOptions::Text)
                                                    
                                                    <button class="w-20 h-8 font-semibold uppercase text-sm rounded-lg {{$selectedFeatures[$option->id] == $feature->id ? 'bg-magenta-500 text-white' : 'border border-gray-200 text-gray-700'}}"
                                                        wire:click="$set('selectedFeatures.{{$option->id}}', {{$feature->id}})">
                                                        {{ $feature->value }}
                                                    </button>

                                                    @break
                                                @case(App\Enums\TypeOptions::Color)
                                                    
                                                    <div class="p-0.5 border-4 rounded-lg -mt-1.5 {{$selectedFeatures[$option->id] == $feature->id ? 'border-magenta-500' : 'border-transparent'}}">
                                                        <button class="w-20 h-8 rounded-lg border border-gray-200"
                                                            style="background-color: {{$feature->value}}; color: {{$feature->value}}"
                                                            wire:click="$set('selectedFeatures.{{$option->id}}', {{$feature->id}})">
                                                            a
                                                        </button>
                                                    </div>

                                                    @break
                                                @default
                                                    
                                            @endswitch

                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>

                    <div class="flex justify-end items-center mb-4" x-data="{
                        qty: @entangle('qty').defer
                    }">
                        <button x-on:click="qty = qty - 1" x-bind:disabled="qty == 0" disabled class="disabled:opacity-25">
                            <i class="fa-solid fa-circle-minus text-xl text-magenta-500"></i>
                        </button>

                        <span class="inline-flex justify-center w-10 text-lg" x-text="qty">
                        </span>

                        <button x-on:click="qty = qty + 1">
                            <i class="fa-solid fa-circle-plus text-xl text-magenta-500"></i>
                        </button>

                        <x-button pink spinner class="ml-6" x-bind:disabled="qty == 0" wire:click="add_to_cart()">
                            Agregar al carrito
                        </x-button>
                    </div>

                    <h2 class="text-xl font-semibold mb-4">Detalle</h2>

                    {!! $product->details !!}
                </div>

            </div>

        </div>
    </div>

</div>