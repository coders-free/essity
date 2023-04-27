<x-app-layout>


    <x-container class="py-12">


        <div class="mb-4">
            
            <div class="flex">
                <form action="" class="flex-1 flex items-center">
                    <x-select
                        class="flex-1"
                        placeholder="Buscar producto..."
                        :async-data="route('api.products.index')"
                        option-label="name"
                        option-value="id"
                        x-on:selected="window.location.href = '/products/' + $event.detail.value"
                        
                    />

                    <button class="px-4">
                        <i class="fa-solid fa-magnifying-glass text-magenta-500 text-2xl"></i>
                    </button>
                </form>
            </div>

        </div>

        <div class="card card-body">

            <h1 class="text-4xl text-darkblue mb-4">Haz tu pedido <span class="uppercase">{{ $line->name }}</span></h1>

            {{-- Tab lineas --}}
            <div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 mb-12">
                <ul class="flex flex-wrap -mb-px">

                    @foreach ($lines as $item)

                        <li class="mr-2">
                            <a href="{{route('lines.show', $item)}}"
                                class="inline-block p-4 border-b-2 rounded-t-lg active uppercase {{ request()->url() == route('lines.show', [$item]) ? 'text-magenta-500 border-magenta-500' : 'border-transparent hover:text-gray-600 hover:border-gray-300'}}">
                                {{ $item->name }}
                            </a>
                        </li>

                    @endforeach
                    
                </ul>
            </div>

            {{-- Categorías --}}
            <div class="mb-12">
                <x-dropdown>

                    <x-slot name="trigger">
                        <span class="text-lg font-semibold uppercase flex items-center">
                            Familia de productos
                            <i class="fa-solid fa-angle-down ml-1"></i>
                        </span>
                    </x-slot>

                    @foreach ($categories as $item)
                    
                        <x-dropdown.item href="{{route('lines.show', [
                                $line,
                                'category_id' => $item->id
                            ])}}">
                            {{ $item->name }}
                        </x-dropdown.item>
                        
                    @endforeach

                </x-dropdown>
            </div>

            {{-- Productos --}}
            <div class="space-y-16">
                
                @foreach ($line->categories as $item)
                
                    <section>
                        <h1 class="uppercase mb-4">
                            {{ $item->name }}
                        </h1>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

                            @foreach ($item->products as $product)
                            
                                <article class="border border-gray-200 p-4">

                                    <figure class="mb-4">
                                        <img src="{{$product->image}}" alt="">
                                    </figure>

                                    <p class="font-semibold">
                                        C.N. {{ $product->code }}
                                    </p>

                                    <h1 class="text-lg text-darkblue font-semibold mb-2">
                                        {{ $product->name }}
                                    </h1>

                                    <a href="{{route('products.show', $product)}}" class="btn btn-magenta block text-center w-full">
                                        VER PRODUCTO
                                    </a>

                                </article>

                            @endforeach

                        </div>

                    </section>

                @endforeach
            </div>

        </div>

    </x-container>

</x-app-layout>