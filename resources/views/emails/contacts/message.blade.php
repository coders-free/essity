<x-mail::message>
# Hola {{$message->name}} {{$message->last_name}}

Tienes un nuevo mensaje

{{$message->response}}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
