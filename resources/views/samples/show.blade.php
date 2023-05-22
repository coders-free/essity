<x-app-layout>

    <x-container class="px-4 pt-16 pb-24">
        @if ($product->variants->count())
            @livewire('products.add-to-cart-variants', [
                'product' => $product,
                'instance' => 'sample',
                'type' => $type
            ])
        @else
            @livewire('products.add-to-cart', [
                'product' => $product,
                'instance' => 'sample',
                'type' => $type
            ])
        @endif
    </x-container>

</x-app-layout>