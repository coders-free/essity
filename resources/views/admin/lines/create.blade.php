<x-admin-layout :breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => route('admin.dashboard'),
    ],
    [
        'name' => 'Lineas',
        'url' => route('admin.lines.index'),
    ],
    [
        'name' => 'Crear',
    ]
]">

    <form action="{{route('admin.lines.store')}}" method="POST">

        @csrf

        <x-card title="Crear linea">

            <div class="mb-4">
                
                <x-input label="Nombre" name="name" :value="old('name')" placeholder="Escriba el nombre de la linea" />

            </div>

            <x-slot name="footer">

                <div class="flex justify-end">

                    <button class="btn btn-magenta">
                        Crear
                    </button>

                </div>

            </x-slot>

        </x-card> 
    </form>

</x-admin-layout>