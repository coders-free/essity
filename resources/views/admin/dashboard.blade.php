<x-admin-layout :breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => '',
    ],
    [
        'name' => 'Dashboard',
    ]
]">

    {{-- <h1 class="text-xl font-semibold mb-6">Dashboard</h1> --}}

    <div class="grid grid-cols-2 gap-6">

        
        <x-card class="flex items-center">
            
            <x-avatar lg src="{{ auth()->user()->profile_photo_url }}" />

            <div class="ml-4">
                <h2 class="text-lg font-semibold">
                    Bienvenido, {{ Auth::user()->name }}
                </h2>

                <form action="{{route('logout')}}" method="POST">
                    @csrf
                    <button class="hover:text-magenta-500 text-sm">
                        Cerrar sesión
                    </button>
                </form>
            </div>
            
        </x-card>

        <x-card class="flex flex-col items-center justify-center">

            <h2 class="text-xl font-semibold">
                {{config('app.name')}}
            </h2>

        </x-card>
        

    </div>

</x-admin-layout>