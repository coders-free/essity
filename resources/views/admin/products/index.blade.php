<x-admin-layout :breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => route('admin.dashboard'),
    ],
    [
        'name' => 'Productos',
    ]
]"
:create="route('admin.products.create')">

    @livewire('product-table')

</x-admin-layout>