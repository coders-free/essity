<x-app-layout>

    <section class="grid grid-cols-1 lg:grid-cols-5 mb-12">
        <div class="lg:col-span-2">
            <img src="{{asset('img/home/TENA-Women-Lights-Range-1.png')}}" alt="" class="w-full">
        </div>

        <div class="lg:col-span-3 bg-darkblue-500">
            <div class="p-16 text-white">
                <h1 class="text-7xl mb-6">
                    Tena Lights liner <br/> for sensitive skin
                </h1>

                <p class="text-lg mb-6">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus neque nihil est asperiores quos? Odio at excepturi repellendus ipsam quia fugit accusamus atque facilis delectus praesentium aut, labore adipisci laudantium.</p>

                <a href="" class="btn btn-magenta">
                    Saber más
                </a>
            </div>
        </div>
    </section>

    <x-container class="px-4">
        {{-- Servicios más usados --}}
        <section class="mb-12">
            <h2 class="text-4xl text-darkblue-500 mb-4">
                Servicios más usados
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="card">
                    <a class="aspect-square flex flex-col justify-center items-center">
                        
                        <img src="{{asset('img/home/frame/1.png')}}" class="mb-8" alt="">

                        <span class="text-magenta-500 text-xl font-semibold">
                            Pedir productos
                        </span>
                        
                    </a>
                </div>

                <div class="card">
                    <a class="aspect-square flex flex-col justify-center items-center">
                        
                        <img src="{{asset('img/home/frame/2.png')}}" class="mb-8" alt="">

                        <span class="text-magenta-500 text-xl font-semibold">
                            Pedir muestras
                        </span>
                        
                    </a>
                </div>

                <div class="card">
                    <a class="aspect-square flex flex-col justify-center items-center">
                        
                        <img src="{{asset('img/home/frame/3.png')}}" class="mb-8" alt="">

                        <span class="text-magenta-500 text-xl font-semibold">
                            Pedir material PLV
                        </span>
                        
                    </a>
                </div>

                <div class="card">
                    <a class="aspect-square flex flex-col justify-center items-center">
                        
                        <img src="{{asset('img/home/frame/4.png')}}" class="mb-8" alt="">

                        <span class="text-magenta-500 text-xl font-semibold">
                            Videos
                        </span>
                        
                    </a>
                </div>
            </div>
        </section>  

        {{-- Nuevos productos --}}
        <section class="mb-12">
            <div class="grid md:grid-cols-2">
                <div class="p-16 bg-darkblue-500 text-white">
                    <h1 class="text-5xl mb-6">
                        New releases.
                    </h1>

                    <p class="mb-8">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nesciunt cumque in facilis odio exercitationem doloribus nemo, perferendis quis, delectus hic ipsam corporis quod</p>

                    <a href="" class="btn btn-magenta">
                        READ MORE
                    </a>
                </div>

                <div>
                    <img class="h-full object-cover object-center" src="{{asset('img/home/Pro_Skin_DSC1855_R01-Fix 2.png')}}" alt="">
                </div>
            </div>
        </section>

        {{-- Historial de pedidos --}}
        @if ($orders->count())
        
            <section class="mb-24">

                <div class="flex justify-between mb-4">
                    <h2 class="text-4xl text-darkblue-500">
                        Historial de pedidos
                    </h2>

                    <a class="text-magenta-500" href="{{route('products.history')}}">Ver todo el historial</a>
                </div>

                <div class="overflow-auto bg-white shadow">

                    <table class="w-full">
                        <thead class="bg-darkblue-500 text-white">
                            <tr>
                                <th class="py-2 px-4 text-left">Pedido ID</th>
                                <th class="py-2 px-4 text-left">Fecha de pedido</th>
                                <th class="py-2 px-4 text-left">Estatus</th>
                                <th class="py-2 px-4 text-left">Vendedor</th>
                                <th class="py-2 px-4">Volver a pedir</th>
                                <th class="py-2 px-4">Ver</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            @foreach ($orders as $order)
                            
                                <tr>
                                    <td class="py-2 px-4">
                                        {{ str_pad($order->id, 8, '0', STR_PAD_LEFT) }}
                                    </td>
                                    <td class="py-2 px-4">
                                        {{ $order->created_at->format('d/m/y') }}
                                    </td>
                                    <td class="py-2 px-4">
                                        {{ $order->status ? 'Aprobado' : 'Pendiente' }}
                                    </td>
                                    <td class="py-2 px-4">
                                        Nombre del vendedor
                                    </td>
                                    <td class="py-2 px-4">
                                        <div class="flex justify-center">
                                        
                                            <a href="">
                                                <img src="{{asset('img/icons/Reorder2.svg')}}" alt="">
                                            </a>

                                        </div>
                                    </td>
                                    <td class="py-2 px-4">
                                        <div class="flex justify-center">
                                        
                                            <a href="{{route('products.history', [
                                                'order' => $order->id
                                            ])}}">
                                                <img src="{{asset('img/icons/Visibility.svg')}}" alt="">
                                            </a>

                                        </div>
                                    </td>
                                </tr>

                            @endforeach
                        </tbody>
                    </table>

                </div>

            </section>

        @endif

    </x-container>

</x-app-layout>