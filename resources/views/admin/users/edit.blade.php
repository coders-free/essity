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
        'name' => 'Editar usuario',
    ]
]">

    <form action="{{route('admin.users.update', $user)}}" method="POST">

        @csrf
        @method('PUT')

        <x-card title="Editar usuario">

            {{-- Nombre --}}
            <div class="mb-4">
                <x-input label="Nombres" 
                    name="name" 
                    value="{{old('name', $user->name)}}" 
                    placeholder="Escriba el nombre del usuario" />
            </div>

            {{-- Apellidos --}}
            <div class="mb-4">
                <x-input label="Apellidos" 
                    name="last_name" 
                    value="{{old('last_name', $user->last_name)}}" 
                    placeholder="Escriba el apellido del usuario" />
            </div>

            {{-- Email --}}
            <div class="mb-4">
                <x-input label="Email" 
                    type="email"
                    name="email" 
                    value="{{old('email', $user->email)}}" 
                    placeholder="Escriba el email del usuario" />
            </div>

            {{-- Contraseña --}}
            <div class="mb-4">
                <x-input label="Contraseña" 
                    type="password"
                    name="password" 
                    placeholder="Escriba la contraseña del usuario" />
            </div>

            {{-- Confirmar contraseña --}}
            <div class="mb-4">
                <x-input label="Confirmar contraseña" 
                    type="password"
                    name="password_confirmation" 
                    placeholder="Confirme la contraseña del usuario" />
            </div>

            <x-slot name="footer">

                <div class="flex justify-end">
                    <button class="btn btn-magenta">
                        Guardar
                    </button>
                </div>

            </x-slot>

        

        </x-card>
    </form>
</x-admin-layout>