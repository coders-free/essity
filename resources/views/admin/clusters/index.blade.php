<x-admin-layout :breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => route('admin.dashboard'),
    ],
    [
        'name' => 'Clusters',
    ]
]"
:create="route('admin.clusters.create')">

    @livewire('cluster-table')

</x-admin-layout>