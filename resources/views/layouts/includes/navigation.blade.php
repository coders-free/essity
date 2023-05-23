@php
    $links = [
        [
            'name' => 'Pedir productos',
            'route' => route('orders.lines.index'),
            'active' => request()->routeIs('orders.*'),
            'submenu' => [
                [
                    'name' => 'Tena',
                    'route' => route('orders.lines.show', 1),
                ],
                [
                    'name' => 'Leukoplast',
                    'route' => route('orders.lines.show', 2),
                ],
    
                [
                    'name' => 'Actimove',
                    'route' => route('orders.lines.show', 3),
                ],
    
                [
                    'name' => 'Jobst',
                    'route' => route('orders.lines.show', 4),
                ],
            ],
        ],
    
        [
            'name' => 'Historial de productos',
            'route' => route('history'),
            'active' => request()->routeIs('history'),
        ],
    
        [
            'name' => 'Pedir muestras y material PLV',
            'route' => route('samples.index'),
            'active' => request()->routeIs('samples.*'),
        ],
    
        [
            'name' => 'Material digital',
            'route' => route('materials.index'),
            'active' => request()->routeIs('materials.*'),
        ],
    
        [
            'name' => 'Videos',
            'route' => route('webinars.index'),
            'active' => request()->routeIs('webinars.*'),
        ],
    ];
@endphp

<nav class="bg-white border-gray-200 dark:bg-gray-900 dark:border-gray-700" x-data="{
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
            x-bind:class="{'hidden': !open }">

            <ul class="flex flex-col font-medium p-4 lg:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 lg:flex-row lg:space-x-8 lg:mt-0 lg:border-0 lg:bg-white dark:bg-gray-800 lg:dark:bg-gray-900 dark:border-gray-700">

                @foreach ($links as $link)

                    @isset($link['submenu'])
                    
                        <li x-data="{
                                open: false
                            }">
                            <button x-on:click="open = !open" 

                                @class([
                                    'flex items-center justify-between w-full py-2 pl-3 pr-4 text-white bg-magenta-500 rounded lg:bg-transparent lg:text-magenta-500 lg:p-0 lg:dark:text-blue-500 dark:bg-blue-600 lg:dark:bg-transparent' => $link['active'],
                                    'flex items-center justify-between w-full py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 lg:hover:bg-transparent lg:border-0 lg:hover:text-blue-700 lg:p-0 dark:text-white lg:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent' => !$link['active']
                                ])

                                >
                                
                                {{$link['name']}}

                                <svg class="w-5 h-5 ml-1" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                            <!-- Dropdown menu -->
                            <div x-bind:class="{'hidden' : !open}" class="z-10 hidden absolute font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-400">
                                    @foreach ($link['submenu'] as $item)
                                        <li>
                                            <a href="{{ $item['route'] }}"
                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                {{ $item['name'] }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </li>

                    @else

                        <li>
                            <a href="{{ $link['route'] }}"

                                @class([
                                    'block py-2 pl-3 pr-4 text-white bg-magenta-500 rounded lg:bg-transparent lg:text-magenta-500 lg:p-0 lg:dark:text-blue-500 dark:bg-blue-600 lg:dark:bg-transparent' => $link['active'],
                                    'block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 lg:hover:bg-transparent lg:border-0 lg:hover:text-blue-700 lg:p-0 dark:text-white lg:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent' => !$link['active']
                                ])

                            >
                                {{ $link['name'] }}
                            </a>
                        </li>

                    @endisset

                @endforeach
                
            </ul>

        </div>
    </x-container>
</nav>