<div>
    <div class="flex items-center">
        <x-select
        class="flex-1"
        wire:model.defer="product_id"
        placeholder="Buscar producto..."
        :async-data="route('api.products.index')"
        option-label="name"
        option-value="id"
        />

        <button class="px-4" wire:click="redirect2()">
            <img class="h-6" src="{{asset('img/icons/magnifying-glass-24pink.svg')}}" alt="">
        </button>

        <a href="{{route('cart.index')}}">
            <img class="h-6" src="{{asset('img/icons/cart-shopping-24pink.svg')}}" alt="">
        </a>

    </div>
</div>
