<x-admin-layout :breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => route('admin.dashboard'),
    ],
    [
        'name' => 'Variantes',
        'url' => route('admin.options.index'),
    ],
    [
        'name' => 'Crear',
    ]
]">

    <x-card title="Nueva variante">

        <form action="{{route('admin.options.store')}}" method="POST">

            @csrf

            <div class="mb-4">

                <x-input label="Nombre" 
                    name="name" 
                    :value="old('name')" 
                    placeholder="Escriba el nombre de la variante" />

            </div>

            <div class="mb-4">
                <x-native-select label="Seleccionar tipo"
                    name="type">

                    @foreach (App\Enums\TypeOptions::cases() as $case)
                        <option value="{{ $case->value }}">
                            {{ $case->name }}
                        </option>
                    @endforeach

                </x-native-select>
            </div>

            <div class="flex justify-end">

                <x-button type="submit" pink>
                    Crear
                </x-button>

            </div>
        </form>
    </x-card>

</x-admin-layout>