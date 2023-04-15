<x-guest-layout>

    <x-container class="px-4 py-24">


        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <div class="card">

                <a href="{{route('register.farmacia')}}" class="py-20 flex flex-col items-center">

                    <img class="mb-4" src="{{asset('img/auth/register/farmacia.png')}}" alt="">

                    <p class="text-xl text-magenta">Registro</p>
                    <p class="text-xl text-magenta">Farmacia</p>

                </a>

            </div>

            <div class="card">

                <a href="{{route('register.ortopedia')}}" class="py-20 flex flex-col items-center">
                    <img class="mb-4" src="{{asset('img/auth/register/ortopedia.png')}}" alt="">

                    <p class="text-xl text-magenta">Registro</p>
                    <p class="text-xl text-magenta">Ortopedia</p>
                </a>

            </div>

        </div>            

    </x-container>

</x-guest-layout>
