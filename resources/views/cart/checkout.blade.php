<x-app-layout>

    <x-container class="px-4 py-12">

        <div class="card">
            <div class="card-body">

                <form action="{{route('cart.store')}}" method="POST">

                    @csrf

                    <x-validation-errors class="mb-4" />

                    @role('farmacia')

                        <div class="bg-gray-100 p-4 mb-4">
                            <p class="text-darkblue font-semibold">
                                Distribuidor
                            </p>
                        </div>

                        <div class="mb-8">
                            <x-native-select label="Distribuidor" name="cooperative_id">

                                @foreach (auth()->user()->cooperatives as $cooperative)
                                    <option value="{{ $cooperative->id }}">
                                        {{ $cooperative->name }}
                                    </option>
                                @endforeach

                            </x-native-select>
                        </div>

                    @endrole

                    <div class="bg-gray-100 p-4 mb-4">
                        <p class="text-darkblue font-semibold">
                            Farmacia
                        </p>
                    </div>

                    <div class="mb-4">
                        <p class="text-lg font-semibold">
                            {{ auth()->user()->profile->pharmacy_name }}
                        </p>

                        <p>
                            {{ auth()->user()->profile->address }}
                        </p>

                        <p>
                            {{ auth()->user()->profile->province->name }}
                        </p>

                        <p>
                            {{ auth()->user()->profile->town->name }}
                        </p>

                        <p>
                            {{ auth()->user()->profile->phone }}
                        </p>
                    </div>

                    {{-- Nif --}}
                    <div class="mb-8">
                        <x-native-select label="CIF/NIF" name="nif">

                            <option value="{{ auth()->user()->profile->nif_1 }}">
                                {{ auth()->user()->profile->nif_1 }}
                            </option>

                            <option value="{{ auth()->user()->profile->nif_2 }}">
                                {{ auth()->user()->profile->nif_2 }}
                            </option>

                        </x-native-select>
                    </div>

                    <div class="bg-gray-100 p-4 mb-4">
                        <p class="text-darkblue font-semibold">
                            Promociones
                        </p>
                    </div>

                    <div class="flex mb-8">


                        <div class="flex-1">
                            <x-input label="Codigo promocional (Opcional)" type="text" />
                        </div>

                    </div>

                    <div class="bg-gray-100 p-4 mb-4">
                        <p class="text-darkblue font-semibold">
                            Otros
                        </p>
                    </div>

                    <div class="mb-8">
                        <x-textarea label="Mensaje (Opcional)" name="message" />
                    </div>

                    <div class="mb-8">
                        <label class="flex items-center">

                            <x-checkbox id="oferts" name="oferts" class="mr-2" />

                            <p>Me gustaría recibir ofertas exclusivas e información sobre las novedades de TENA por correo
                            electronico <span class="text-gray-400">(Opcional)</span></p>

                        </label>
                    </div>

                    <div class="flex justify-between">
                        <a href="{{route('cart.index')}}" class="btn btn-outline-magenta">
                            Volver
                        </a>

                        <button class="btn btn-blue">
                            Enviar
                        </button>
                    </div>
                </form>

            </div>
        </div>

    </x-container>

</x-app-layout>