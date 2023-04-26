<x-admin-layout :breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => route('admin.dashboard'),
    ],
    [
        'name' => 'Roles',
    ]
]"
:create="route('admin.roles.create')">

    @livewire('role-table')

</x-admin-layout>