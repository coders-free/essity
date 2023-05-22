<div>
    
    @if ($instance == 'shopping')
            
        <div class="space-y-8 mb-12">

            @forelse ($this->lines as $line => $categories)
                
                <section class="bg-white shadow">

                    <header class="p-4 bg-darkblue-500">
                        <h1 class="text-white font-semibold uppercase">{{ $line }}</h1>
                    </header>

                    @foreach ($categories as $category => $products)
                        <article>
                            <header class="px-4 py-2 bg-gray-50">
                                <h2 class="text-darkblue-500 font-semibold">{{ $category }}</h2>
                            </header>

                            <div class="overflow-auto">
                                <table class="w-full">

                                    <thead>
                                        <tr class="text-darkblue-500 border-b border-gray-200">
                                            <th class="px-4 py-2">
                                                C.N
                                            </th>
                                            <th class="px-4 py-2">
                                                Producto
                                            </th>
                                            <th class="px-4 py-2">
                                                Cantidad
                                            </th>
                                            <th class="px-4 py-2">
                                                Sales unit
                                            </th>
                                            <th class="px-4 py-2">
                                                Borrar
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody class="divide-y divide-gray-200">
                                        @foreach ($products as $product)

                                            <tr wire:key="{{$product->rowId}}">
                                                <td class="px-4 py-2 text-center md:w-1/5">
                                                    {{ $product->options->code }}
                                                </td>
                                                <td class="px-4 py-2 text-center md:w-1/5">
                                                    {{ $product->name }}
                                                </td>
                                                <td class="px-4 py-2 text-center md:w-1/5">
                                                    <div class="whitespace-nowrap">
                                                        <button class="disabled:opacity-25" wire:click="decrease('{{$product->rowId}}')" wire:loading.attr="disabled" wire:target="decrease('{{$product->rowId}}')">
                                                            <i class="fa-solid fa-circle-minus text-xl text-magenta-500"></i>
                                                        </button>
                                
                                                        <span class="inline-flex justify-center w-10 text-lg">
                                                            {{ $product->qty }}
                                                        </span>
                                
                                                        <button class="disabled:opacity-25" wire:click="increase('{{$product->rowId}}')" wire:loading.attr="disabled" wire:target="increase('{{$product->rowId}}')">
                                                            <i class="fa-solid fa-circle-plus text-xl text-magenta-500"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                                <td class="px-4 py-2 text-center md:w-1/5">
                                                    CON
                                                </td>
                                                <td class="px-4 py-2 text-center md:w-1/5">
                                                
                                                    <button class="disabled:opacity-25" wire:click="remove('{{$product->rowId}}')" wire:loading.attr="disabled" wire:target="remove('{{$product->rowId}}')">
                                                        <i class="fa-solid fa-circle-xmark text-xl text-magenta-500"></i>
                                                    </button>

                                                </td>
                                            </tr>

                                        @endforeach
                                    </tbody>

                                </table>
                            </div>

                        </article>
                    @endforeach
                    
                </section>

            @empty

                <section>

                    <h1 class="text-4xl text-darkblue-500 font-semibold text-center">Parece que no tiene items agregados</h1>
        
                    <figure class="flex justify-center mb-24">
                        <img class="max-w-lg" src="{{asset('img/no-funciona.svg')}}" alt="">
                    </figure>

                </section>
            
            @endforelse

        </div>

        <div class="flex">

            <x-button pink outline href="{{route('orders.lines.index')}}">
                VOLVER
            </x-button>

            @if (count($this->lines))
                <x-button pink outline class="ml-auto" wire:click="destroy()">
                    VACIAR CARRITO
                </x-button>

                <x-button href="{{route('orders.cart.checkout')}}" pink class="ml-2">
                    CONFIRMAR PEDIDO
                </x-button>

            @endif

        </div>

    @endif

    @if ($instance == 'sample')
        
        <div class="space-y-8 mb-12">

            @forelse ($this->types as $type => $products)
                
                <section class="bg-white shadow">

                    <header class="p-4 bg-darkblue-500">
                        <h1 class="text-white font-semibold uppercase">
                            {{ $type == 'free_sample' ? 'Muestras' : 'Material PLV' }}
                        </h1>
                    </header>
                        
                    <article>

                        <table class="w-full">

                            <thead>
                                <tr class="text-darkblue-500 border-b border-gray-200">
                                    <th class="px-4 py-2">
                                        C.N
                                    </th>
                                    <th class="px-4 py-2">
                                        Producto
                                    </th>
                                    <th class="px-4 py-2">
                                        Cantidad
                                    </th>
                                    <th class="px-4 py-2">
                                        Sales unit
                                    </th>
                                    <th class="px-4 py-2">
                                        Borrar
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200">
                                @foreach ($products as $product)

                                    <tr wire:key="{{$product->rowId}}">
                                        <td class="px-4 py-2 text-center w-1/5">
                                            {{ $product->options->code }}
                                        </td>
                                        <td class="px-4 py-2 text-center w-1/5">
                                            {{ $product->name }}
                                        </td>
                                        <td class="px-4 py-2 text-center w-1/5">

                                            <div class="whitespace-nowrap">

                                                <button class="disabled:opacity-25" wire:click="decrease('{{$product->rowId}}')" wire:loading.attr="disabled" wire:target="decrease('{{$product->rowId}}')">
                                                    <i class="fa-solid fa-circle-minus text-xl text-magenta-500"></i>
                                                </button>
                        
                                                <span class="inline-flex justify-center w-10 text-lg">
                                                    {{ $product->qty }}
                                                </span>
                        
                                                <button class="disabled:opacity-25" wire:click="increase('{{$product->rowId}}')" wire:loading.attr="disabled" wire:target="increase('{{$product->rowId}}')">
                                                    <i class="fa-solid fa-circle-plus text-xl text-magenta-500"></i>
                                                </button>

                                            </div>
                                        </td>
                                        <td class="px-4 py-2 text-center w-1/5">
                                            CON
                                        </td>
                                        <td class="px-4 py-2 text-center w-1/5">
                                        
                                            <button class="disabled:opacity-25" wire:click="remove('{{$product->rowId}}')" wire:loading.attr="disabled" wire:target="remove('{{$product->rowId}}')">
                                                <i class="fa-solid fa-circle-xmark text-xl text-magenta-500"></i>
                                            </button>

                                        </td>
                                    </tr>

                                @endforeach
                            </tbody>

                        </table>

                    </article>

                </section>

            @empty

                <section>
                    <h1 class="text-4xl text-darkblue-500 font-semibold text-center">Parece que no tiene items agregados</h1>
            
                    <figure class="flex justify-center mb-24">
                        <img class="max-w-lg" src="{{asset('img/no-funciona.svg')}}" alt="">
                    </figure>
                </section>
            
            @endforelse

        </div>

        <div class="flex">

            <x-button pink outline href="{{route('samples.index')}}">
                VOLVER
            </x-button>

            @if (count($this->lines))
                <x-button pink outline class="ml-auto" wire:click="destroy()">
                    VACIAR CARRITO
                </x-button>

                <x-button href="{{route('samples.cart.checkout')}}" pink class="ml-2">
                    CONFIRMAR PEDIDO
                </x-button>

            @endif

        </div>

    @endif

</div>
