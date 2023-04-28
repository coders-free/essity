<x-app-layout>

    <x-container class="py-16">
        <div class="card">
            <div class="card-body">


                <x-validation-errors class="mb-4" />

                <h1 class="text-3xl text-darkblue-500 mb-4">
                    Contact us
                </h1>

                

                <form action="{{route('contact.store')}}" method="POST" class="g-recaptcha">

                    @csrf

                    <div class="bg-gray-100 p-4 mb-4">
                        <p class="text-darkblue-500 font-semibold">Pharmacy details</p>
                    </div>

                    <div class="mb-4">
                        <x-label class="mb-1">
                            Nombre de farmacia
                        </x-label>

                        <x-input type="text" value="{{old('pharmacy_name')}}" name="pharmacy_name" class="w-full" />
                    </div>

                    <div class="mb-4">
                        <x-label class="mb-1">
                            Dirección
                        </x-label>

                        <x-input type="text" value="{{old('address')}}" name="address" class="w-full" />
                    </div>

                    <div class="mb-4">
                        <x-label class="mb-1">
                            Código postal
                        </x-label>

                        <x-input type="text" value="{{old('postal_code')}}" name="postal_code" class="w-full" />
                    </div>

                    <div class="mb-4">
                        <x-label class="mb-1">
                            Ciudad
                        </x-label>

                        <x-input type="text" value="{{old('city')}}" name="city" class="w-full" />
                    </div>

                    <div class="mb-4">
                        <x-label class="mb-1">
                            Provincia
                        </x-label>

                        <x-input type="text" value="{{old('province')}}" name="province" class="w-full" />
                    </div>
                    
                    <div class="mb-4">
                        <x-label class="mb-1">
                            Número de teléfono
                        </x-label>

                        <x-input type="text" value="{{old('phone')}}" name="phone" class="w-full" />
                    </div>

                    <div class="mb-4">
                        <x-label class="mb-1">
                            CIF/NIF
                        </x-label>

                        <x-input type="text" value="{{old('nif_1')}}" name="nif_1" class="w-full" />
                    </div>

                    <div class="mb-12">
                        <x-label class="mb-1">
                            CIF/NIF 2 <span class="text-gray-400">(Opcional)</span>
                        </x-label>

                        <x-input type="text" value="{{old('nif_2')}}" name="nif_2" class="w-full" />
                    </div>

                    <div class="bg-gray-100 p-4 mb-4">
                        <p class="text-darkblue-500 font-semibold">Detalle de usuario</p>
                    </div>

                    <div class="mb-4">
                        <x-label class="mb-1">
                            Nombre
                        </x-label>

                        <x-input type="text" value="{{old('name')}}" name="name" class="w-full" />
                    </div>

                    <div class="mb-4">
                        <x-label class="mb-1">
                            Apellido
                        </x-label>

                        <x-input type="text" value="{{old('last_name')}}" name="last_name" class="w-full" />
                    </div>

                    <div class="mb-12">
                        <x-label class="mb-1">
                            Email
                        </x-label>

                        <x-input type="email" value="{{old('email')}}" name="email" class="w-full" />
                    </div>

                    <div class="bg-gray-100 p-4 mb-4">
                        <p class="text-darkblue-500 font-semibold">Mensaje</p>
                    </div>

                    <div class="mb-12">
                        <x-label class="mb-1">
                            Mensaje
                        </x-label>

                        <x-textarea name="body">
                            {{old('body')}}
                        </x-textarea>
                    </div>

                    {{-- Checkbox --}}
                    <div class="my-10">

                        <label class="flex items-center">

                            <x-checkbox id="terms" name="terms" class="mr-2" :checked="old('terms')" />

                            <p>Lee y acepta la <a href="#" class="text-magenta-500">política y privacidad</a></p>

                        </label>

                        <label class="flex items-center">

                            <x-checkbox id="oferts" name="oferts" class="mr-2" />

                            <p>Me gustaría recibir ofertas exclusivas e información sobre las novedades de TENA por correo
                            electronico <span class="text-gray-400">(Opcional)</span></p>

                        </label>

                    </div>

                    {{-- Buttons --}}
                    <div class="flex justify-between">
                        <a href="/register" class="btn btn-outline-magenta">
                            Volver
                        </a>

                        <button class="btn btn-darkblue" id="submitButton" @disabled(old('terms') == null)>
                            Enviar
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </x-container>

    @push('js')
        <script>
            const termsCheckbox = document.getElementById("terms");
            const submitButton = document.getElementById("submitButton");

            termsCheckbox.addEventListener("click", function() {
                if (termsCheckbox.checked) {
                    submitButton.disabled = false;
                } else {
                    submitButton.disabled = true;
                }
            });
        </script>
    @endpush

</x-app-layout>