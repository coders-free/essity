<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- Font Awesome --}}
    <script src="https://kit.fontawesome.com/e2d71e4ca2.js" crossorigin="anonymous"></script>

    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('img/favicon.png') }}">

    @stack('css')

    <!-- Scripts -->
    @wireUiScripts
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Recaptcha --}}
    <script src="https://www.google.com/recaptcha/api.js?render={{ env('RECAPTCHA_SITE_KEY') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {

            const forms = document.querySelectorAll('.g-recaptcha');

            //Escuchar evento submit en cada formulario        
            forms.forEach((form) => {

                form.addEventListener('submit', (event) => {

                    event.preventDefault();

                    grecaptcha.ready(function() {
                        grecaptcha.execute("{{ env('RECAPTCHA_SITE_KEY') }}", {
                            action: 'submit'
                        }).then(function(token) {

                            let input = document.createElement('input');

                            input.setAttribute('type', 'hidden');
                            input.setAttribute('name', 'g-recaptcha-response');
                            input.setAttribute('value', token);

                            form.appendChild(input);

                            form.submit();

                        });
                    });

                });

            });

        });
    </script>
</head>

<body class="bg-gray-50">

    <x-banner />

    <header class="bg-white shadow-lg">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <a href="/">
                <img src="{{ asset('img/logo.png') }}" alt="">
            </a>
        </div>

    </header>


    {{ $slot }}


    @include('layouts.includes.footer')

    @stack('js')
</body>

</html>
