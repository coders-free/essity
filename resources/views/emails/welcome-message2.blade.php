<x-guest-layout>


    <img src="{{asset('img/emails/Frame 40.png')}}" class="w-full" alt="">

    <x-container class="px-4 py-12">

        <h1 class="text-4xl mb-6">
            Bienvenido a Essity
        </h1>

        <p class="text-lg mb-3">Gracias por darte de alta</p>

        <p class="text-lg mb-3">Antes de hacer tu primer pedido el administrador tendrá que verificar tu usuario.</p>

        <p class="text-lg mb-3">Te llegará un email cuando este verificado</p>

        <p class="text-lg mb-3">Atentamente,</p>

        <p class="text-lg mb-3">Essity</p>

    </x-container>

    <footer class="bg-darkblue mt-auto">
        <x-container class="px-4">
    
    
            <div class="py-8 text-white space-y-8 md:space-y-0">

                <div class="flex items-center">

                    <div>
                        <figure class="mb-6">
                            <img src="{{asset('img/logo_w.png')}}" class="mr-12" alt="">
                        </figure>
        
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima aperiam voluptatum fugiat cumque, sunt neque blanditiis doloremque fuga nam repellendus minus incidunt expedita similique saepe, quis vitae quaerat quod laborum.</p>
                    </div>

                    <div class="ml-4">
                        <a href="" class="btn btn-outline-white">CONTACTO</a>
                    </div>

                </div>

                <div class="flex justify-end mt-4">
                    <p class="text-sm text-gray-50">© {{now()->format('Y')}}. Essity.</p>
                </div>
                
    
            </div>
    
        </x-container>
    </footer>

</x-guest-layout>