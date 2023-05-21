<x-app-layout>

    <x-container class="px-4 pt-16 pb-24">
        @if ($product->variants->count())
            @livewire('products.add-to-cart-variants', ['product' => $product])
        @else
            @livewire('products.add-to-cart', ['product' => $product])
        @endif
    </x-container>

</x-app-layout>