<div>
    <div class="mb-4">
        <x-input wire:model="search" placeholder="Buscar producto" class="pr-20">

            <x-slot name="append">
                <div class="absolute inset-y-0 right-0 flex items-center">
                    <button>
                        <i class="fa-solid fa-magnifying-glass text-magenta-500 text-lg"></i>
                    </button>

                    <a href="{{route('orders.cart.index')}}" class="mx-4">
                        <i class="fa-solid fa-cart-shopping text-magenta-500 text-lg"></i>
                    </a>
                </div>
            </x-slot>

        </x-input>
    </div>

    <div class="lg:flex">

        <div class="mb-8 lg:flex-shrink-0 lg:ml-8 lg:w-80 lg:order-2">
            <x-card>

                <h2 class="text-darkblue-500 font-semibold text-lg">
                    Descuentos acumulados
                </h2>

                <p class="my-2 text-sm">
                    Actualmente aún no tiene ningún descuento basado en los articulos en su carro
                </p>

                <button class="text-magenta-500 font-semibold flex items-center text-sm">
                    <i class="fa-solid fa-angle-right mr-2"></i>
                    Ver todos los descuentos
                </button>

            </x-card>
        </div>

        <div class="lg:flex-1 lg:order-1">
            <x-card>
                <h1 class="text-3xl text-darkblue mb-4">Haz tu pedido <span class="uppercase">{{ $line->name }}</span></h1>

                {{-- Tab lineas --}}
                <div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 mb-12" wire:ignore>
                    <ul class="flex flex-wrap -mb-px">

                        @foreach ($lines as $item)

                            <li class="mr-2">
                                <a href="{{route('orders.lines.show', $item)}}"
                                    class="inline-block p-4 border-b-2 rounded-t-lg active uppercase {{ request()->url() == route('orders.lines.show', [$item]) ? 'text-magenta-500 border-magenta-500' : 'border-transparent hover:text-gray-600 hover:border-gray-300'}}">
                                    {{ $item->name }}
                                </a>
                            </li>

                        @endforeach
                        
                    </ul>
                </div>

                {{-- Filtros --}}
                <div class="mb-12 flex space-x-4">
                    <x-dropdown :persistent="true">

                        <x-slot name="trigger">
                            <span class="font-semibold uppercase flex items-center">
                                Familia de productos
                                <i class="fa-solid fa-angle-down ml-1"></i>
                            </span>
                        </x-slot>
    
                        @foreach ($this->available_categories as $item)
                        
                            <x-dropdown.item>
                                <x-checkbox :label="$item->name" 
                                    :value="$item->id"
                                    id="category_{{$item->id}}"
                                    wire:model="selected_categories" />

                            </x-dropdown.item>
                            
                        @endforeach
    
                    </x-dropdown>

                    @foreach ($this->options as $item)
                        
                        <x-dropdown :persistent="true">

                            <x-slot name="trigger">
                                <span class="font-semibold uppercase flex items-center">
                                    {{ $item->name }}
                                    <i class="fa-solid fa-angle-down ml-1"></i>
                                </span>
                            </x-slot>
        
                            @foreach ($item->features as $feature)
                            
                                <x-dropdown.item>
                                    <x-checkbox :label="$feature->description" 
                                        :value="$feature->id"
                                        id="feature_{{$feature->id}}"
                                        wire:model="selected_features" />
    
                                </x-dropdown.item>
                                
                            @endforeach

                        </x-dropdown>

                    @endforeach
                </div>

                {{-- Filtros aplicados --}}
                @if (count($selected_categories) || count($selected_features))
                
                    <div class="flex items-center -mt-6 mb-6">

                        <x-button outline dark xs class="mr-4" wire:click="clearFilters">
                            <i class="fa-solid fa-trash-can mr-2"></i>
                            BORRAR FILTROS
                        </x-button>

                        @if (count($selected_categories))
                            
                            @foreach ($selected_categories as $item)
                                <x-badge dark outline class="mr-4">
                                    {{ $this->available_categories->find($item)->name }}

                                    <x-slot name="append" class="relative flex items-center w-2 h-2">
                                        <button type="button" wire:click="remove_category_filter({{$item}})">
                                            <x-icon name="x" class="w-4 h-4" />
                                        </button>
                                    </x-slot>
                                </x-badge>
                            @endforeach

                        @endif

                        @if (count($selected_features))
                            
                            @foreach ($selected_features as $item)
                                <x-badge dark outline class="mr-4">
                                    
                                    {{ $this->options->pluck('features')->flatten()->where('id', $item)->first()->description }}

                                    <x-slot name="append" class="relative flex items-center w-2 h-2">
                                        <button type="button" wire:click="remove_feature_filter({{$item}})">
                                            <x-icon name="x" class="w-4 h-4" />
                                        </button>
                                    </x-slot>
                                </x-badge>
                            @endforeach
                            
                        @endif

                    </div>

                @endif

                {{-- Productos --}}
                <div class="space-y-16">

                    @forelse ($this->filtered_categories as $item)
                    
                        <section>
                            <h1 class="uppercase mb-4">
                                {{ $item->name }}
                            </h1>

                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

                                @foreach ($item->products as $product)
                                
                                    <article class="border border-gray-200 p-4">

                                        <figure class="mb-4">
                                            <img class="aspect-square object-cover object-center" src="{{$product->image}}" alt="">
                                        </figure>

                                        <p class="text-gray-500">
                                            C.N. {{ $product->code }}
                                        </p>

                                        <div class="h-14 mb-2">
                                            <h1 class="text-lg text-darkblue font-semibold mb-2 line-clamp-2">
                                                {{ $product->name }}
                                            </h1>
                                        </div>

                                        <a href="{{route('orders.products.show', $product)}}" class="btn btn-magenta block text-center w-full">
                                            VER PRODUCTO
                                        </a>

                                    </article>

                                @endforeach

                            </div>

                        </section>

                    @empty

                        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                            <span class="font-medium">¡No se encontró registros!</span> Por favor intente con otros filtros de búsqueda.
                        </div>
                        
                    @endforelse
                </div>
            </x-card>

            {{-- @dump($this->filtered_categories) --}}
        </div>

    </div>
</div>
