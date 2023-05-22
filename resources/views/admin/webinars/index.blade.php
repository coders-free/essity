<x-admin-layout :breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => route('admin.dashboard'),
    ],
    [
        'name' => 'Videos',
    ]
]"
:create="route('admin.webinars.create')">

    @livewire('webinar-table')

</x-admin-layout>