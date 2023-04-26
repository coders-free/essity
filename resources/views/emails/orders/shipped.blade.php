<x-mail::message>

# Gracias por su orden

Fecha de orden: {{ $order->created_at->format('d M Y') }}
<br>
Número de orden: {{ $order->id }}

Hemos recibido tu pedido {{ $order->id }} correctamente y te lo entregará el distribuidor que hayas elegido, a
continuación puedes ver un resumen.

## Resumen del pedido

@foreach ($order->content as $line => $categories)
<div style="padding: 0.5rem 1rem; background-color: #00005A; color: white; font-weight: 600;">
{{ $line }}
</div>

@foreach ($categories as $category => $products)
<div style="padding: 0.5rem 1rem; background-color:  rgb(249 250 251); color: #00005A; font-weight: 600;">
{{ $category }}
</div>

<x-mail::table>
| C.N | Producto | Cantidad | Sales unit |
| --- | :------: | :------: | :--------: |
@foreach ($products as $product)
| {{ $product->options->code }} | {{ $product->name }} | {{ $product->qty }} | CON |
@endforeach
</x-mail::table>
@endforeach

@endforeach

Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet quibusdam accusamus, neque ut excepturi, impedit consequatur recusandae quisquam earum assumenda et rerum nihil? Vero dicta exercitationem quos dolores et! Ea!

</x-mail::message>
