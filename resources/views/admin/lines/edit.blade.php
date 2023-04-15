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
        'name' => 'Editar',
    ]
]">


    <form action="{{route('admin.lines.update', $line)}}" method="POST">

        @csrf

        @method('PUT')

        <x-card title="Editar linea">

            <div class="mb-4">
                <x-input label="Nombre" name="name" :value="old('name', $line->name)" />
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