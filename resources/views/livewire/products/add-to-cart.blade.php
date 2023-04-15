<div class="card">
    <div class="card-body">

        <div class="grid grid-cols-5 gap-6">

            <div class="col-span-2">
                <figure>
                    <img src="{{ $product->image }}" alt="">
                </figure>
            </div>

            <div class="col-span-3">
                <h1 class="text-4xl font-bold text-darkblue-500">
                    {{ $product->name }}
                </h1>
                
                <p class="py-2">CN: {{ $product->code }}</p>

                <hr class="magentadmb-4">

                <div class="flex justify-end items-center mb-4" x-data="{
                    qty: @entangle('qty').defer
                }">
                    <button x-on:click="qty = qty - 1" x-bind:disabled="qty == 0" disabled class="disabled:opacity-25">
                        <i class="fa-solid fa-circle-minus text-xl text-magenta-500"></i>
                    </button>

                    <span class="inline-flex justify-center w-10 text-lg" x-text="qty">
                    </span>

                    <button x-on:click="qty = qty + 1">
                        <i class="fa-solid fa-circle-plus text-xl text-magenta-500"></i>
                    </button>

                    <button class="btn btn-magenta ml-6" x-bind:disabled="qty == 0" wire:click="add_to_cart()">
                        Agregar al carrito
                    </button>
                </div>

                <h2 class="text-xl font-semibold mb-4">Detalle</h2>

                {!! $product->details !!}
            </div>

        </div>

    </div>
</div>