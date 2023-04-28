<x-admin-layout :breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => route('admin.dashboard'),
    ],
    [
        'name' => 'Ordenes',
    ]
]">


    @livewire('order-table')

</x-admin-layout>