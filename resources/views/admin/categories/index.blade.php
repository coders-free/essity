<x-admin-layout :breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => route('admin.dashboard'),
    ],
    [
        'name' => 'Categorías',
    ]
]">

    @livewire('category-table')

</x-admin-layout>