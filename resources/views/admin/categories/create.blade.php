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
        'name' => 'Crear',
    ],
]">

    <form action="{{route('admin.categories.store')}}" method="POST">

        @csrf

        <x-card title="Crear categoría">

            <div class="mb-4">
                <x-input label="Nombre" 
                    name="name"
                    value="{{old('name')}}"
                    placeholder="Escriba el nombre de la categoría" />
            </div>

            <div class="mb-4">
                <x-native-select label="Select Status" name="line_id">

                    @foreach ($lines as $line)
                        <option value="{{$line->id}}" @selected($line->id == old('line_id'))>
                            {{$line->name}}
                        </option>
                    @endforeach

                </x-native-select>
            </div>

            <div>
                <x-inputs.number label="Máximo de pedidos por orden" 
                    name="maximum_orders"
                    value="{{old('maximum_orders')}}"
                    placeholder="Ingrese la máxima cantidad de productos que puede pedir por orden" />
            </div>

            <x-slot name="footer">
                <div class="flex justify-end">
                    <button class="btn btn-magenta">
                        Guardar
                    </button>
                </div>
            </x-slot>

        </x-card>

    </form>

</x-admin-layout>
