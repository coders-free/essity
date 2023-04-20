<x-admin-layout :breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => route('admin.dashboard'),
    ],
    [
        'name' => 'Empleados',
    ]
]">


    <div class="flex justify-end mb-4">

        <a href="{{route('admin.employees.create')}}" class="btn btn-magenta">
            Nuevo usuario
        </a>

    </div>

    @livewire('employee-table')

</x-admin-layout>