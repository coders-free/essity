<x-admin-layout :breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => route('admin.dashboard'),
    ],
    [
        'name' => 'Materiales digitales',
    ]
]">

    @livewire('admin.digital-materials')

</x-admin-layout>