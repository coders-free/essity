<x-admin-layout :breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => route('admin.dashboard'),
    ],
    [
        'name' => 'Clusters',
        'url' => route('admin.clusters.index'),
    ],
    [
        'name' => 'Crear',
    ]
]">

    <x-card>

        <form action="{{route('admin.clusters.store')}}" 
            method="POST">

            @csrf

            <div class="mb-4">
                <x-input label="Nombre" 
                    name="name"
                    value="{{old('name')}}"
                    placeholder="Escriba el nombre del cluster" />
            </div>

            <div class="flex justify-end">
                <x-button pink type="submit">
                    Crear
                </x-button>
            </div>

        </form>

    </x-card>

</x-admin-layout>