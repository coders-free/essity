<x-admin-layout :breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => route('admin.dashboard'),
    ],
    [
        'name' => 'Roles',
        'url' => route('admin.roles.index'),
    ],
    [
        'name' => 'Nuevo rol',
    ]
]">

    <x-card>

        <form action="{{route('admin.roles.store')}}" method="POST">

            @csrf

            <div class="mb-4">
                <x-input name="name" label="Nombre" placeholder="Esriba el nombre del rol" />
            </div>

            <div class="flex justify-end">
                <button class="btn btn-magenta">
                    Guardar
                </button>
            </div>
        </form>
    </x-card>


</x-admin-layout>