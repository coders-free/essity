<x-admin-layout :breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => route('admin.dashboard'),
    ],
    [
        'name' => 'Lineas',
    ]
]"
:create="route('admin.lines.create')">

    @livewire('line-table')

</x-admin-layout>