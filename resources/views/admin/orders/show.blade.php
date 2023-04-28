<x-admin-layout :breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => route('admin.dashboard'),
    ],
    [
        'name' => 'Orden detalle',
    ]
]">


    <x-card>
        <p>
            <b>Usuario: </b>
            {{ $order->user->name }}
        </p>

        <p>
            <b>Cooperativa:</b>
            {{ $order->cooperative->name }}
        </p>

        <p>
            <b>Numero NIF:</b>
            {{ $order->nif }}
        </p>

        @if ($order->message)
            
            <p>
                <b>Mensaje:</b>
                {{ $order->message }}
            </p>

        @endif

        <p>
            <b>Status:</b>
            {{ $order->status ? 'Aprobado' : 'Pendiente' }}
        </p>

        <p>
            <b>Fecha de creación:</b>
            {{ $order->created_at->format('d/m/Y') }}
        </p>


        @if ($order->status)
            
            <p>
                <b>Fecha de aprobación:</b>
                {{ $order->updated_at->format('d/m/Y') }}
            </p>
            
        @endif

        @if (!$order->status)
            
            <form action="{{route('admin.orders.approve', $order)}}" 
                class="mt-2"
                method="POST">

                @csrf

                <x-button type="submit" pink>
                    Aprobar
                </x-button>
            </form>

        @endif

    </x-card>

    <div class="space-y-8 mt-8 mb-12">
        @foreach ($order->content as $line => $categories)
            
            <section class="bg-white shadow">

                <header class="p-4 bg-darkblue-500">
                    <h1 class="text-white font-semibold uppercase">{{ $line }}</h1>
                </header>

                @foreach ($categories as $category => $products)
                    <article>
                        <header class="px-4 py-2 bg-gray-50">
                            <h2 class="text-darkblue-500 font-semibold">{{ $category }}</h2>
                        </header>


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
                    
                                            <span class="inline-flex justify-center w-10 text-lg">
                                                {{ $product->qty }}
                                            </span>
                                            
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
                
            </section>

        @endforeach
    </div>

</x-admin-layout>