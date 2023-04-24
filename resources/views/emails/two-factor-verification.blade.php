<x-mail::message>
# Bienvenido a {{ config('app.name') }}

Este es el código de verificación para entrar a la web:

<x-mail::panel>
<b>{{ $code }}</b>
</x-mail::panel>

Atentamente,<br>
{{ config('app.name') }}
</x-mail::message>
