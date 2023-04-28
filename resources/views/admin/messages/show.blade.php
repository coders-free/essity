<x-admin-layout>

    <div class="mb-6">
        <x-card>

            <div class="grid grid-cols-2 gap-6">

                <div>
                    <p class="font-semibold">
                        Nombre de farmacia: 
                    </p>
                    <p>
                        {{ $message->pharmacy_name }}
                    </p>
                </div>

                <div>
                    <p class="font-semibold">
                        Dirección:
                    </p>
                    <p>
                        {{ $message->address }}
                    </p>
                </div>

                <div>
                    <p class="font-semibold">
                        Código postal:
                    </p>
                    <p>
                        {{ $message->postal_code }}
                    </p>
                </div>

                <div>
                    <p class="font-semibold">
                        Ciudad:
                    </p>
                    <p>
                        {{ $message->city }}
                    </p>
                </div>

                <div>
                    <p class="font-semibold">
                        Provincia:
                    </p>
                    <p>
                        {{ $message->province }}
                    </p>
                </div>

                <div>
                    <p class="font-semibold">
                        Teléfono:
                    </p>
                    <p>
                        {{ $message->phone }}
                    </p>
                </div>

                <div>
                    <p class="font-semibold">
                        Nif 1:
                    </p>
                    <p>
                        {{ $message->nif_1 }}
                    </p>
                </div>

                <div>
                    <p class="font-semibold">
                        Nif 2:
                    </p>
                    <p>
                        {{ $message->nif_2 }}
                    </p>
                </div>

                <div>
                    <p class="font-semibold">
                        Nombre:
                    </p>
                    <p>
                        {{ $message->name }}
                    </p>
                </div>

                <div>
                    <p class="font-semibold">
                        Apellido:
                    </p>
                    <p>
                        {{ $message->last_name }}
                    </p>
                </div>

                <div>
                    <p class="font-semibold">
                        Email:
                    </p>
                    <p>
                        {{ $message->email }}
                    </p>
                </div>

            </div>

        </x-card>
    </div>

    <div class="mb-6">
        <x-card title="Mensaje">
            {{ $message->body }}
        </x-card>
    </div>

    @if ($message->responded)

        <x-card title="Respuesta">
            <div class="mb-6">
                <p class="font-semibold">
                    Asunto: 
                </p>
                <p>
                    {{ $message->subject }}
                </p>
            </div>

            <div>
                <p class="font-semibold">
                    Mensaje: 
                </p>
                <p>
                    {{ $message->response }}
                </p>
            </div>

        </x-card>

    @else

        <div>
            <form action="{{route('admin.messages.update', $message)}}" method="POST">

                @csrf

                @method('PUT')

                <x-card title="Respuesta">

                    <x-input name="subject" label="Asunto" class="mb-4" />

                    <x-textarea name="body" label="Mensaje" class="mb-4" />

                    <div class="flex justify-end">
                        <x-button type="submit" pink>
                            Enviar
                        </x-button>
                    </div>

                </x-card>


            </form>
        </div>
        
    @endif
</x-admin-layout>