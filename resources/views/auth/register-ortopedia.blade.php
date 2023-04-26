<x-guest-layout>

    @push('css')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

        <style>
            .select2-selection__rendered {
                line-height: 42px !important;
            }

            .select2-container .select2-selection--single {
                height: 42px !important;
            }

            .select2-selection__arrow {
                height: 42px !important;
            }
        </style>
    @endpush

    <x-container class="px-4 py-12">

        <div class="card">
            <div class="card-body">
                <h1 class="text-3xl text-darkblue mb-4">Registro</h1>

                <div class="bg-gray-50 p-4 mb-4">
                    <p class="text-darkblue text-lg font-semibold">Detalles de ortopedia</p>
                </div>


                <form action="{{route('register.store')}}" method="POST" class="g-recaptcha">

                    @csrf

                    <x-validation-errors class="mb-4" />

                    
                    @include('auth.register-form')

                    {{-- Role --}}
                    <input type="hidden" name="role" value="ortopedia">

                    {{-- Checkbox --}}
                    <div class="my-10">

                        <label class="flex items-center">

                            <x-checkbox id="terms" name="terms" class="mr-2" :checked="old('terms')" />

                            <p>Lee y acepta la <a href="{{route('privacy-policy')}}" target="_blank" class="text-magenta-500 font-semibold">política y privacidad</a></p>

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
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


        <script>
            $(document).ready(function() {
                $('#provinces').select2({
                    placeholder: 'Seleccione un municipio',

                    ajax: {
                        url: "{{ route('select2.provinces') }}",
                        dataType: 'json',
                        data: function(params) {
                            return {
                                term: params.term,
                            }
                        },
                        processResults: function(data, page) {
                            return {
                                results: data
                            };
                        },
                    }

                });


                $('#towns').select2({
                    placeholder: 'Seleccione una población',

                    ajax: {
                        url: "{{ route('select2.towns') }}",
                        dataType: 'json',
                        data: function(params) {
                            return {
                                term: params.term,
                                province_id: $('#provinces').val()
                            }
                        },
                        processResults: function(data, page) {
                            return {
                                results: data
                            };
                        },
                    }

                });

                //Si cambia la provincia, se vacía el select de poblaciones
                $('#provinces').on('change', function() {
                    $('#towns').val(null).trigger('change');
                });
            });



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

</x-guest-layout>