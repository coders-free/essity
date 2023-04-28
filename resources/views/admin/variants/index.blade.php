<x-admin-layout :breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => route('admin.dashboard'),
    ],
    [
        'name' => 'Variantes',
    ]
]"
:create="route('admin.variants.create')">

    @livewire('variant-table')

</x-admin-layout>