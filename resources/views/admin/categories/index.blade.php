<x-admin-layout :breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => route('admin.dashboard'),
    ],
    [
        'name' => 'Categorías',
    ]
]"
:create="route('admin.categories.create')">

    @livewire('category-table')

</x-admin-layout>