<x-admin-layout :breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => route('admin.dashboard'),
    ],
    [
        'name' => 'Empleados',
    ]
]"
:create="route('admin.employees.create')">

    @livewire('employee-table')

</x-admin-layout>