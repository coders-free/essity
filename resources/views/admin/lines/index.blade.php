<x-admin-layout :breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => route('admin.dashboard'),
    ],
    [
        'name' => 'Lineas',
    ]
]">

    <div class="flex justify-end mb-4">
        <a href="{{route('admin.lines.create')}}" class="btn btn-blue">
            Nuevo
        </a>
    </div>

    @livewire('line-table')

</x-admin-layout>