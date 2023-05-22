@php
    $links = [
        [
            'name' => 'Dashboard',
            'icon' => 'fas fa-home',
            'route' => route('admin.dashboard'),
            'active' => request()->routeIs('admin.dashboard'),
        ],
    
        /* [
            'header' => 'Roles y privilegios',
        ], */
    
        [
            'name' => 'Roles',
            'icon' => 'fas fa-user-tag',
            'route' => route('admin.roles.index'),
            'active' => request()->routeIs('admin.roles.*'),
        ],
    
        [
            'name' => 'Empleados',
            'icon' => 'fas fa-users-cog',
            'route' => route('admin.employees.index'),
            'active' => request()->routeIs('admin.employees.*'),
        ],
    
        [
            'name' => 'Usuarios',
            'icon' => 'fas fa-users',
            'route' => route('admin.users.index'),
            'active' => request()->routeIs('admin.users.*'),
        ],
    
        /* [
            'header' => 'Productos',
        ], */

        [
            'name' => 'Opciones',
            'icon' => 'fas fa-clone',
            'route' => route('admin.options.index'),
            'active' => request()->routeIs('admin.options.*'),
        ],
    
        [
            'name' => 'Lineas',
            'icon' => 'fas fa-layer-group',
            'route' => route('admin.lines.index'),
            'active' => request()->routeIs('admin.lines.*'),
        ],
    
        [
            'name' => 'Categorías',
            'icon' => 'fas fa-tags',
            'route' => route('admin.categories.index'),
            'active' => request()->routeIs('admin.categories.*'),
        ],

        [
            'name' => 'Productos',
            'icon' => 'fas fa-boxes',
            'route' => route('admin.products.index'),
            'active' => request()->routeIs('admin.products.*'),
        ],

        [
            'name' => 'Clusters',
            'icon' => 'fa-solid fa-circle-nodes',
            'route' => route('admin.clusters.index'),
            'active' => request()->routeIs('admin.clusters.*'),
        ],

        [
            'name' => 'Ordenes',
            'icon' => 'fas fa-shopping-cart',
            'route' => route('admin.orders.index'),
            'active' => request()->routeIs('admin.orders.*'),
        ],

        [
            'name' => 'Ordenes de muestras',
            'icon' => 'fas fa-flask',
            'route' => route('admin.samples.index'),
            'active' => request()->routeIs('admin.samples.*'),
        ],

        [
            'name' => 'Videos',
            'icon' => 'fas fa-video',
            'route' => route('admin.webinars.index'),
            'active' => request()->routeIs('admin.webinars.*'),
        ],

        [
            'name' => 'Mensajes',
            'icon' => 'fas fa-envelope',
            'route' => route('admin.messages.index'),
            'active' => request()->routeIs('admin.messages.*'),
        ]
    ];
    
@endphp

<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    :class="{
        'translate-x-0 ease-out': open,
        '-translate-x-full ease-in': !open
    }"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
            @foreach ($links as $link)
                <li>
                    <a href="{{ $link['route'] }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 {{ $link['active'] ? 'bg-gray-100' : 'hover:bg-gray-100' }}">

                        <i class="{{ $link['icon'] }} text-gray-500"></i>
                        <span class="ml-3">
                            {{ $link['name'] }}
                        </span>
                    </a>
                </li>
            @endforeach

        </ul>
    </div>
</aside>