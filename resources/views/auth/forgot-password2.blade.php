<x-guest-layout>

    <x-container class="px-4 py-12" width="3xl">

        <div class="card">
            <div class="card-body">

                <form action="{{ route('password.email') }}" method="POST">
                    @csrf

                    <h1 class="text-2xl text-darkblue mb-4">
                        Introduce tu correo para reestablecer la contraseña
                    </h1>

                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="mb-6">

                        <x-label class="mb-1">
                            Email
                        </x-label>

                        <x-input type="email" name="email" class="block w-full" />

                    </div>

                    <button class="btn btn-magenta">
                        RESTABLECER CONTRASEÑA
                    </button>
                </form>
            </div>
        </div>

    </x-container>

</x-guest-layout>
