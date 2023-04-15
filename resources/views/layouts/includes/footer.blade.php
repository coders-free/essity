<footer class="bg-darkblue-500 mt-auto">
    <x-container class="px-4">


        <div class="md:flex py-8 text-white space-y-8 md:space-y-0">
            <figure>
                <img src="{{asset('img/logo_w.png')}}" class="mr-12" alt="">
            </figure>

            <ul class="space-y-2 mr-12 text-sm">
                <li>
                    <a href="{{route('rules-of-use')}}">Normas de uso</a>
                </li>

                <li>
                    <a href="{{route('privacy-policy')}}">Politicas de privacidad</a>
                </li>

                <li>
                    <a href="{{route('cookie-policy')}}">Politicas de Cookies</a>
                </li>
            </ul>

            <ul class="space-y-2 text-sm">
                <li>
                    <a href="{{route('contact.index')}}">Contacto</a>
                </li>

                <li>
                    <a href="{{route('privacy-policy')}}">Sitemap</a>
                </li>

                <li>
                    <a href="{{route('faq')}}">FAQ</a>
                </li>
            </ul>

            <div class="ml-auto self-end">
                <p class="text-sm text-gray-50">© {{now()->format('Y')}}. Essity.</p>
            </div>

        </div>

    </x-container>
</footer>