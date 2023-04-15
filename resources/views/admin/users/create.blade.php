<x-admin-layout :breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => route('admin.dashboard'),
    ],
    [
        'name' => 'Usuarios',
        'url' => route('admin.users.index'),
    ],

    [
        'name' => 'Nuevo usuario',
    ]
]">


    <div>
        <x-card>

            <form action="{{route('admin.users.store')}}" method="POST">

                @csrf
                
                <div class="mb-4">
                    <x-input label="Nombres" name="name" placeholder="Escriba el nombre del usuario" />
                </div>

                <div class="mb-4">
                    <x-input label="Apellidos" name="last_name" placeholder="Escriba los apellidos del usuario" />
                </div>

                <div class="mb-4">
                    <x-input label="Email" type="email" name="email" placeholder="Escriba el email del usuario" />
                </div>

                {{-- Password --}}
                <div class="mb-4">
                    <x-input label="Contraseña" type="password" name="password" placeholder="Escriba la contraseña del usuario" />
                </div>

                {{-- Confirmar contraseña --}}
                <div class="mb-4">
                    <x-input label="Confirmar contraseña" type="password" name="password_confirmation" placeholder="Confirme la contraseña del usuario" />
                </div>

                <div class="flex justify-end">
                    <button class="btn btn-magenta">
                        Guardar
                    </button>
                </div>

            </form>
        </x-card>
    </div>

</x-admin-layout>