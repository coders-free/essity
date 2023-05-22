<x-app-layout>

    <x-container class="px-4 py-12">

        <x-card>

            <h1 class="text-5xl text-darkblue-500 mb-6">Gracias por escoger Essity</h1>

            <p class="text-lg mb-12">Su pedido con el número {{$orderSample->id}} ha sido registrado, en breve se le enviará una confirmación por correo electrónico.</p>

            <div class="flex space-x-4">
                <x-button pink href="{{route('samples.index')}}">
                    HACER OTRO PEDIDO
                </x-button>
            </div>

        </x-card>

    </x-container>

</x-app-layout>