<x-admin-layout :breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => route('admin.dashboard'),
    ],
    [
        'name' => 'Orden de muestras detalle',
    ]
]">

    <x-card>
        <p>
            <b>Usuario: </b>
            {{ $orderSample->user->name }} {{ $orderSample->user->last_name }}
        </p>

        <p>
            <b>Numero NIF:</b>
            {{ $orderSample->nif }}
        </p>

        @if ($orderSample->message)
            
            <p>
                <b>Mensaje:</b>
                {{ $orderSample->message }}
            </p>

        @endif

        <p>
            <b>Fecha de creación:</b>
            {{ $orderSample->created_at->format('d/m/Y') }}
        </p>

    </x-card>

    <div class="space-y-8 mt-8 mb-12">
        @foreach ($orderSample->content as $type => $products)
            
            <section class="bg-white shadow">

                <header class="p-4 bg-darkblue-500">
                    <h1 class="text-white font-semibold uppercase">
                        {{ $type == 'free_sample' ? 'Muestras' : 'Material PLV' }}
                    </h1>
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
                                
            </section>

        @endforeach
    </div>

</x-admin-layout>