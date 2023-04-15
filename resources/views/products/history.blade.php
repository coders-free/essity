<x-app-layout>

    <x-container class="px-4 py-12">

        <h1 class="text-5xl font-semibold text-darkblue-500 mb-8">Historial de pedidos</h1>


        <div class="mb-24">
            <h2 class="text-3xl mb-4">Filtrar pedidos</h1>

            <form action="{{route('products.history')}}">

                <div class="grid grid-cols-3 gap-6">

                    <div>
                        <x-input label="Vendedor" type="text" />
                    </div>

                    <div>
                        <x-label class="mb-1">
                            Pedido ID
                        </x-label>

                        <x-input value="{{request('order_id')}}" name="order_id" type="number" />
                    </div>
                    <div>
                        <x-label class="mb-1">
                            Status
                        </x-label>

                        <x-native-select name="status">
                            <option @selected(request('status') == 0) value="0">Pendiente</option>
                            <option @selected(request('status') == 1) value="1">Aprobado</option>
                        </x-native-select>
                    </div>
                    <div>
                        <x-label class="mb-1">
                            Desde fecha
                        </x-label>

                        <x-input value="{{request('from_date')}}" name="from_date" type="date" />
                    </div>
                    <div>
                        <x-label class="mb-1">
                            Hasta fecha
                        </x-label>

                        <x-input value="{{request('to_date')}}" name="to_date" type="date" />
                    </div>

                </div>

                <div class="mt-6 flex items-center">
                    <button class="btn btn-magenta mr-2">
                        FILTRAR PEDIDOS
                    </button>

                    <a href="{{route('products.history')}}" class="btn btn-outline-magenta">
                        BORRAR FILTROS
                    </a>
                </div>
            </form>
        </div>

        <div>
            <h2 class="text-3xl mb-4">Pedidos</h1>

            @if ($orders->count())
            
                <div>

                    @foreach ($orders as $order)
                        
                        <section class="bg-white shadow" x-data="{
                            open: false
                        }">
                            <header class="p-4 bg-darkblue-500">
                                <h1 class="text-white font-semibold uppercase">
                                    Pedido ID: 
                                    {{ str_pad($order->id, 8, '0', STR_PAD_LEFT) }}
                                </h1>
                            </header>

                            <table class="w-full">
                                <tbody class="text-darkblue-500 divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-4 py-2 font-semibold">
                                            Fecha de pedido
                                        </td>
                                        <td class="px-4 py-2">
                                            {{ $order->created_at->format('d/m/Y') }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="px-4 py-2 font-semibold">
                                            Nombre del distribuidor
                                        </td>
                                        <td class="px-4 py-2">
                                            No se ha asignado
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="px-4 py-2 font-semibold">
                                            Nombre de farmacia
                                        </td>
                                        <td class="px-4 py-2">
                                            {{ auth()->user()->profile->pharmacy_name }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="px-4 py-2 font-semibold">
                                            Telefono
                                        </td>
                                        <td class="px-4 py-2">
                                            {{ auth()->user()->profile->phone }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="px-4 py-2 font-semibold">
                                            Telefono
                                        </td>
                                        <td class="px-4 py-2">
                                            {{ $order->status ? 'Aprobado' : 'Pendiente' }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="px-4 py-2 font-semibold">
                                            Correo electronico
                                        </td>
                                        <td class="px-4 py-2">
                                            {{ auth()->user()->email }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="px-4 py-2 font-semibold">
                                            Número VAT (NIF)
                                        </td>
                                        <td class="px-4 py-2">
                                            {{ $order->nif }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="px-4 py-2 font-semibold">
                                            Código promocional aplicado
                                        </td>
                                        <td class="px-4 py-2">
                                            No
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <button x-on:click="open = !open" class="w-full flex justify-between items-center px-4 py-2 border-y border-gray-200 text-magenta-500 font-semibold">
                                Mostrar productos

                                <i class="fa-solid" x-bind:class="open == true ? 'fa-angle-up' : 'fa-angle-down'"></i>
                            </button>

                            <div x-show="open" style="display: none">
                                @foreach ($order->content as $line => $categories)
                                    
                                    <article>
                                        <header class="p-4 bg-gray-300">
                                            <h1 class="text-darkblue-500 font-semibold uppercase">
                                                {{ $line }}
                                            </h1>
                                        </header>

                                        @foreach ($categories as $category => $products)

                                            <article>
                                                <header class="px-4 py-2 bg-gray-50">
                                                    <h2 class="text-darkblue-500 font-semibold">{{ $category }}</h2>
                                                </header>

                                                <table class="w-full">

                                                    <thead>
                                                        <tr class="text-darkblue-500 border-b border-gray-200">
                                                            <th class="px-4 py-2 text-left">
                                                                C.N
                                                            </th>
                                                            <th class="px-4 py-2 text-left">
                                                                Producto
                                                            </th>
                                                            <th class="px-4 py-2">
                                                                Cantidad
                                                            </th>
                                                            <th class="px-4 py-2">
                                                                Sales unit
                                                            </th>
                                                        </tr>
                                                    </thead>
                    
                                                    <tbody class="divide-y divide-gray-200">
                                                        @foreach ($products as $product)
                    
                                                            <tr wire:key="{{$product->rowId}}">
                                                                <td class="px-4 py-2 w-1/5">
                                                                    {{ $product->options->code }}
                                                                </td>
                                                                <td class="px-4 py-2 w-1/5">
                                                                    {{ $product->name }}
                                                                </td>
                                                                <td class="px-4 py-2 text-center w-1/5">
                                            
                                                                    {{ $product->qty }}
                                        
                                                                </td>
                                                                <td class="px-4 py-2 text-center w-1/5">
                                                                    CON
                                                                </td>
                                                            </tr>
                    
                                                        @endforeach
                                                    </tbody>
                    
                                                </table>
                                                
                                            </article>

                                        @endforeach
                                    </article>

                                @endforeach
                            </div>
                        </section>


                    @endforeach

                </div>

            @else

                <div class="flex p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                    <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Info</span>
                    <div>
                        No se encontró historial de pedidos
                    </div>
                </div>

            @endif
        </div>

    </x-container>

</x-app-layout>