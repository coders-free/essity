<x-admin-layout :breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => route('admin.dashboard'),
    ],
    [
        'name' => 'Categorías',
        'url' => route('admin.categories.index'),
    ],
    [
        'name' => 'Editar',
    ]
]">

    <form action="{{route('admin.categories.update', $category)}}" method="POST">

        @csrf

        @method('PUT')

        <x-card title="Editar categoría">


            <div class="mb-4">
                <x-input label="Nombre" 
                    name="name"
                    value="{{old('name', $category->name)}}"
                    placeholder="Escriba el nombre de la categoría" />
            </div>

            <div class="mb-4">
                <x-native-select label="Select Status" name="line_id">

                    @foreach ($lines as $line)
                        <option value="{{$line->id}}" @selected($line->id == old('line_id', $category->line_id))>
                            {{$line->name}}
                        </option>
                    @endforeach

                </x-native-select>
            </div>

            <div>
                <x-inputs.number label="Máximo de pedidos por orden" 
                    name="maximum_orders"
                    value="{{old('maximum_orders', $category->maximum_orders)}}"
                    placeholder="Ingrese la máxima cantidad de productos que puede pedir por orden" />
            </div>

            <x-slot name="footer">
                <div class="flex justify-end">
                    <button class="btn btn-magenta">
                        Actualizar
                    </button>
                </div>
            </x-slot>

        </x-card>

    </form>

</x-admin-layout>