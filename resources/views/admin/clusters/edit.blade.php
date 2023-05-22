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
        'name' => 'Editar',
    ]
]">

    <x-card>

        <form action="{{route('admin.clusters.update', $cluster)}}" 
            method="POST">

            @csrf
            @method('PUT')

            <div class="mb-4">
                <x-input label="Nombre" 
                    name="name"
                    value="{{old('name', $cluster->name)}}"
                    placeholder="Escriba el nombre del cluster" />
            </div>

            <div class="flex justify-end space-x-2">

                <x-button dark
                    onclick="document.getElementById('miFormulario').submit();">
                    Eliminar
                </x-button>

                <x-button pink type="submit">
                    Actualizar
                </x-button>
            </div>

        </form>

    </x-card>

    <form action="{{route('admin.clusters.destroy', $cluster)}}" 
        method="POST" 
        id="miFormulario">
        @csrf

        @method('DELETE')
    </form>

</x-admin-layout>