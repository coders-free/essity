<x-admin-layout :breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => route('admin.dashboard'),
    ],
    [
        'name' => 'Categorías',
        'url' => route('admin.categories.index'),
    ],
    [
        'name' => 'Crear',
    ]
]">
</x-admin-layout>