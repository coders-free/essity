<x-admin-layout :breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => route('admin.dashboard'),
    ],
    [
        'name' => 'Ordenes muestra',
    ]
]">

    @livewire('order-sample-table')

</x-admin-layout>