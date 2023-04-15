<x-guest-layout>

    <x-container class="px-4 py-12">


        <img src="{{asset('img/auth/login/FullImage.png')}}" alt="" class="mb-8">

        <div class="card form-login">
            <div class="card-body">
                

                <div class="grid grid-cols-1 md:grid-cols-2 gap-12">

                    <div>
                        <h2 class="text-darkblue-500 text-2xl font-semibold mb-6">
                            Iniciar sesión en tu cuenta
                        </h2>

                        {{-- <x-validation-errors class="mb-4" /> --}}

                        <form method="POST" action="{{ route('login') }}">

                            @csrf

                            <div class="mb-4">
                                <x-label class="mb-1">
                                    Correo electrónico
                                </x-label>

                                <x-input type="email" name="email" class="w-full" />
                            </div>

                            <div class="mb-4">
                                <x-label class="mb-1">
                                    Contraseña
                                </x-label>

                                <x-input type="password" name="password" class="w-full" />
                            </div>

                            <div class="block mb-4">
                                <label for="remember_me" class="flex items-center">
                                    <x-checkbox id="remember_me" name="remember" />
                                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                </label>
                            </div>

                            <div class="mb-6 text-darkblue-500 flex items-center">
                                <i class="fa-solid fa-circle-info"></i>

                                <a class="ml-2 underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            </div>


                            <div>
                                <button class="btn btn-magenta">
                                    INICIAR SESIÓN
                                </button>
                            </div>

                        </form>

                    </div>

                    <div class="flex flex-col">
                        <h2 class="text-darkblue-500 text-2xl font-semibold mb-6">
                            ¿Por qué registrarse?
                        </h2>

                        <p class="mb-4">
                            ¿No tiene cuenta? registrate ahora y aprovecha las ventajas de
                        </p>

                        <ul class="space-y-2">
                            <li>
                                <i class="fa-solid fa-circle-check text-magenta-500 mr-2"></i>
                                Lorem ipsum dolor sit amet.
                            </li>

                            <li>
                                <i class="fa-solid fa-circle-check text-magenta-500 mr-2"></i>
                                Lorem ipsum dolor sit amet.
                            </li>

                            <li>
                                <i class="fa-solid fa-circle-check text-magenta-500 mr-2"></i>
                                Lorem ipsum dolor sit amet.
                            </li>

                            <li>
                                <i class="fa-solid fa-circle-check text-magenta-500 mr-2"></i>
                                Lorem ipsum dolor sit amet.
                            </li>
                        </ul>

                        <div class="mt-6 md:mt-auto pb-1.5">
                            
                            <a href="/register" class="btn btn-outline-magenta">
                                REGISTRATE AHORA
                            </a>

                        </div>
                    </div>

                </div>

                <div class="mt-8 md:mt-16">
                    <p>Esta página web es exclusiva para productos farmaceuticos. Si eres farmaceutico, te invitamos a visitar la página web de <a href="">TENA</a></p>
                </div>

            </div>
        </div>

    </x-container>

    @push('js')
        
        @if ($errors->any())
            <script>
                //Hacer scroll hacia el div con class form-login
                const formLogin = document.querySelector('.form-login');

                formLogin.scrollIntoView({
                    behavior: 'smooth'
                });
            </script>
        @endif
    @endpush

</x-guest-layout>
