@php
    $links = [
        [
            'name' => 'Pedir productos',
            'route' => route('lines.index'),
            'active' => request()->routeIs('lines.*'),
        ],

        [
            'name' => 'Historial de productos',
            'route' => route('products.history'),
            'active' => request()->routeIs('products.*'),
        ],

        [
            'name' => 'Pedir muestras y material PLV',
            'route' => "",
            'active' => false,
        ],

        [
            'name' => 'Material digital',
            'route' => "",
            'active' => false,
        ],

        [
            'name' => 'Videos',
            'route' => route('webinars.index'),
            'active' => request()->routeIs('webinars.*'),
        ],
    ];
@endphp

<nav class="bg-white border-gray-200 dark:bg-gray-900" x-data="{
    open: false,
}">
    <x-container class="flex flex-wrap items-center justify-between p-4">
        <a href="/" class="flex items-center">
            <img src="{{ asset('img/logo.png') }}" class="h-8 mr-3" alt="Flowbite Logo" />
        </a>
        <button x-on:click="open = !open" type="button"
            class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
            <span class="sr-only">Open main menu</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                    clip-rule="evenodd"></path>
            </svg>
        </button>
        <div class="hidden w-full lg:block lg:w-auto"
            x-bind:class="{'hidden': !open }"
            id="navbar-default">
            <ul class="font-medium flex flex-col p-4 lg:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 lg:flex-row lg:space-x-8 lg:mt-0 lg:border-0 lg:bg-white dark:bg-gray-800 lg:dark:bg-gray-900 dark:border-gray-700">

                @foreach ($links as $link)

                    <li>
                        <a href="{{ $link['route'] }}"
                           @class([
                            'text-sm block py-2 pl-3 pr-4 text-white bg-magenta-500 rounded lg:bg-transparent lg:text-blue-700 lg:p-0 lg:font-semibold' => $link['active'], 
                            'text-sm block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 lg:hover:bg-transparent lg:border-0 lg:hover:text-blue-700 lg:p-0 lg:font-semibold' => !$link['active'],]) >
                            {{ $link['name'] }}
                        </a>
                    </li>

                @endforeach
                
            </ul>
        </div>
    </x-container>
</nav>
