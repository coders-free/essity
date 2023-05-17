<x-admin-layout :breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => route('admin.dashboard'),
    ],
    [
        'name' => 'Variantes',
    ]
]"
:create="route('admin.options.create')">

    @livewire('option-table')

</x-admin-layout>