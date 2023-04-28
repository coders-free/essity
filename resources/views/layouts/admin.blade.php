@props([
    'breadcrumb' => [],
    'create' => ''
])

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
            'name' => 'Variantes',
            'icon' => 'fas fa-clone',
            'route' => route('admin.variants.index'),
            'active' => request()->routeIs('admin.variants.*'),
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
        ]
    ];
    
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- Font Awesome --}}
    <script src="https://kit.fontawesome.com/e2d71e4ca2.js" crossorigin="anonymous"></script>

    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('img/favicon.png') }}">

    @stack('css')

    <!-- Scripts -->
    @wireUiScripts
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles

    <style>
        .z-60 {
            z-index: 60;
        }
    </style>

</head>

<body class="bg-gray-50" x-data="{
    open: false,
}">


    <x-notifications z-index="z-60" />

    <div style="display: none" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-20 sm:hidden" x-on:click="open = false" x-show="open">
    </div>

    <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start">

                    {{-- Boton para abrir el menu lateral --}}
                    <button x-on:click="open = !open" data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar"
                        aria-controls="logo-sidebar" type="button"
                        class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                            </path>
                        </svg>
                    </button>

                    {{-- Logotipo --}}
                    <a href="/admin" class="flex ml-2 md:mr-24">
                        <img src="{{ asset('img/logo.png') }}" class="h-8 mr-3" alt="{{config('app.name')}}" />
                    </a>
                </div>
                <div class="flex items-center">

                    <x-dropdown>

                        <x-slot name="trigger">
                            <img class="w-8 h-8 rounded-full"
                                    src="{{ auth()->user()->profile_photo_url }}"
                                    alt="user photo">
                        </x-slot>

                        <x-dropdown.item>
                            
                            <form action="{{route('logout')}}" method="POST">

                                @csrf

                                <button class="text-sm text-gray-700">
                                    Cerrar sesión
                                </button>

                            </form>

                        </x-dropdown.item>

                    </x-dropdown>
                </div>
            </div>
        </div>
    </nav>

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
                        <a href="{{$link['route']}}"
                            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 {{$link['active'] ? 'bg-gray-100' : 'hover:bg-gray-100'}}">

                            <i class="{{$link['icon']}} text-gray-500"></i>
                            <span class="ml-3">
                                {{$link['name']}}
                            </span>
                        </a>
                    </li>

                @endforeach

            </ul>
        </div>
    </aside>

    <div class="p-4 sm:ml-64">
        
        <div class="mt-14">

            <div class="flex items-center">
                @if ($breadcrumb)
                
                    <nav class="mb-4">
                        <!-- breadcrumb -->
                        <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">

                            @foreach ($breadcrumb as $item)
                                <li
                                    class="text-sm leading-normal capitalize text-slate-700 {{ $loop->first ? '' : "pl-2 before:float-left before:pr-2 before:text-gray-600 before:content-['/']" }}">

                                    @isset($item['url'])
                                        <a class="opacity-50 " href="{{ $item['url'] }}">
                                            {{ $item['name'] }}
                                        </a>
                                    @else
                                        {{ $item['name'] }}
                                    @endisset

                                </li>
                            @endforeach
                        </ol>

                        @if (count($breadcrumb) > 1)
                            <h6 class="mb-0 font-bold capitalize">
                                {{ end($breadcrumb)['name'] }}
                            </h6>
                        @endif
                    </nav>

                @endif

                @if ($create)
                
                    <div class="ml-auto">
                        <a href="{{$create}}" class="btn btn-magenta">
                            Nuevo
                        </a>
                    </div>

                @endif
            </div>


            {{ $slot }}
        </div>

        {{-- <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">

            Hola

        </div> --}}
    </div>

    @stack('modals')

    @livewireScripts

    @stack('js')

    @if (session('flash.alert'))
        <script>
            window.addEventListener('load', function() {
                window.$wireui.notify({
                    title: "{{ ucfirst(session('flash.alertStyle') ?? 'success') }} Notification",
                    description: "{{ session('flash.alert') }}",
                    icon: "{{ session('flash.alertStyle') ?? 'success' }}"
                });
            });
        </script>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>

        /* Swal.fire({
            icon: 'success',
            title: 'Oops...',
            text: 'Something went wrong!',
        }) */

        /* Livewire.on('sweetalert2Error', message => {

            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: message,
            })

        })

        Livewire.on('sweetalert2Success', message => {

          Swal.fire(
            'Deleted!',
            message,
            'success'
          )

        }) */


        Livewire.on('sweetAlert', (icon, title, text) => {
                
            Swal.fire({
                icon: icon,
                title: title,
                text: text,
            })

        })
    </script>

</body>

</html>
