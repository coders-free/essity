<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        header {
            --tw-bg-opacity: 1;
            background-color: rgb(255 255 255 / var(--tw-bg-opacity));
            --tw-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --tw-shadow-colored: 0 10px 15px -3px var(--tw-shadow-color), 0 4px 6px -4px var(--tw-shadow-color);
            box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
        }

        header>div {
            padding-top: 1rem
                /* 16px */
            ;
            padding-bottom: 1rem
                /* 16px */
            ;
        }

        .container {
            max-width: 80rem;
            margin-left: auto;
            margin-right: auto;
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .portada {
            width: 100% !important;
        }

        .content {
            padding-top: 3rem
                /* 48px */
            ;
            padding-bottom: 3rem
                /* 48px */
            ;
        }

        .content h1 {
            font-size: 2.25rem
                /* 36px */
            ;
            line-height: 2.5rem
                /* 40px */
            ;
        }

        .content p {
            font-size: 1.125rem
                /* 18px */
            ;
            line-height: 1.75rem
                /* 28px */
            ;
        }


        footer {
            background-color: #00005A;
            color: rgb(255 255 255);
        }

        footer .container {
            padding-top: 2rem
                /* 32px */
            ;
            padding-bottom: 2rem
                /* 32px */
            ;
        }

        .footer .caja1 {
            display: flex;
            justify-content: space-between;
        }

        .footer .subcaja1-1 img {

            margin-bottom: 1.5rem
                /* 24px */
            ;
            margin-right: 3rem
                /* 48px */
            ;
        }

        .footer .subcaja1-2 {
            margin-left: 1rem
                /* 16px */
            ;
        }

        .footer .caja2 {
            display: flex;
            justify-content: flex-end;
            margin-top: 1rem
                /* 16px */
            ;
        }

        .footer .caja2 p {
            font-size: 0.875rem
                /* 14px */
            ;
            line-height: 1.25rem
                /* 20px */
            ;
            --tw-text-opacity: 1;
            color: rgb(249 250 251 / var(--tw-text-opacity));
        }

        .btn {
            font-weight: 600;
            padding: 0.5rem 1rem;

            border-radius: 0.25rem;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out, color 0.2s ease-in-out,
                border-color 0.2s ease-in-out;
        }

        footer a{

        }

        .btn-outline-blue {
            background-color: transparent;
            color: #4299e1;
            border: 1px solid #4299e1;
        }

        .btn-outline-blue:hover {
            background-color: #4299e1;
            color: #fff;
        }

        .btn-outline-white {
            background-color: transparent;
            color: white;
            border: 1px solid white;
        }

        .btn-outline-white:hover {
            background-color: white;
            color: #00005A;
        }
    </style>

</head>

<body>


    <header>

        <div class="container">
            <a href="/">
                <img src="{{ asset('img/logo.png') }}" alt="">
            </a>
        </div>

    </header>

    <img class="portada" src="{{ asset('img/emails/Frame 40.png') }}" alt="">

    <div class="container content">

        <h1>
            Bienvenido a Essity
        </h1>

        <p>Gracias por darte de alta</p>

        <p>Antes de hacer tu primer pedido el administrador tendrá que verificar tu usuario.</p>

        <p>Te llegará un email cuando este verificado</p>

        <p>Atentamente,</p>

        <p>Essity</p>

    </div>

    <footer>
        <div class="container" style="padding-left: 1rem; padding-right: 1rem;">
          <div style="color: #fff; padding-top: 2rem; padding-bottom: 2rem;">
            <div style="display: flex; align-items: center;">
              <div>
                
                <img style="margin-bottom: 1.5rem;" src="{{asset('img/logo_w.png')}}" alt="">
                
                <p style="font-size: 1.125rem; line-height: 1.75rem;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima aperiam voluptatum fugiat cumque, sunt neque blanditiis doloremque fuga nam repellendus minus incidunt expedita similique saepe, quis vitae quaerat quod laborum.</p>
              </div>
              <div style="margin-left: 1rem;">
                <a href="" style="background-color: transparent; color: #fff; border: 1px solid #fff; border-radius: 0.25rem; padding: 0.5rem 1rem; font-weight: 600; cursor: pointer; transition: background-color 0.2s ease-in-out, color 0.2s ease-in-out, border-color 0.2s ease-in-out;">CONTACTO</a>
              </div>
            </div>
            <div style="display: flex; justify-content: flex-end; margin-top: 1rem;">
              <p style="font-size: 0.875rem; color: #a0aec0;">© {{now()->format('Y')}}. Essity.</p>
            </div>
          </div>
        </div>
    </footer>

</body>

</html>
