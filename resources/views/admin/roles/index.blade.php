<x-admin-layout :breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => route('admin.dashboard'),
    ],
    [
        'name' => 'Roles',
    ]
]">

    <div class="flex justify-end mb-4">
        <a href="{{route('admin.roles.create')}}" class="btn btn-magenta">
            Nuevo rol
        </a>
    </div>

    @livewire('role-table')

</x-admin-layout>