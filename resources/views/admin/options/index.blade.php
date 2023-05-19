<x-admin-layout :breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => route('admin.dashboard'),
    ],
    [
        'name' => 'Opciones',
    ]
]">

    @livewire('admin.options')

</x-admin-layout>