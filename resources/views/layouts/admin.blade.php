@props([
    'breadcrumb' => [],
    'create' => ''
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

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

    @include('layouts.includes.admin.navigation')

    @include('layouts.includes.admin.sidebar')

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
