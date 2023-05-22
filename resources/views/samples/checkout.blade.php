<x-app-layout>

    <x-container class="px-4 py-12">

        <div class="card">
            <div class="card-body">
                <form action="{{route('samples.cart.store')}}" method="POST">

                    @csrf

                    <x-validation-errors class="mb-4" />

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
                            Usuario
                        </p>
                    </div>

                    <div class="mb-4">
                        <p class="text-lg font-semibold mb-2">
                            {{ auth()->user()->name }} {{ auth()->user()->last_name }}
                        </p>

                        <p>
                            {{ auth()->user()->email }}
                        </p>
                    </div>

                    <div class="bg-gray-100 p-4 mb-4">
                        <p class="text-darkblue font-semibold">
                            Otros
                        </p>
                    </div>

                    <div class="mb-8">
                        <x-textarea label="Mensaje (Opcional)" name="message" />
                    </div>

                    <div class="flex justify-between">
                        <x-button pink outline href="{{route('orders.cart.index')}}">
                            Volver
                        </x-button>

                        <x-button pink type="submit">
                            Hacer pedido
                        </x-button>
                    </div>

                </form>
            </div>
        </div>

    </x-container>

</x-app-layout>