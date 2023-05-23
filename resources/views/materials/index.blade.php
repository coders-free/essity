<x-app-layout>


    <x-container class="py-12">

        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6 mb-12">

            @foreach ($materials as $material)

                <article class="border border-gray-200 p-4">
                    <figure class="mb-4">
                        <img class="aspect-square object-cover object-center w-full" src="{{$material->image}}" alt="">
                    </figure>

                    <div class="h-14 mb-2">
                        <h1 class="text-lg text-darkblue font-semibold mb-2 line-clamp-2">
                            {{ $material->name }}
                        </h1>
                    </div>

                    <a href="{{route('materials.download', $material)}}"
                        class="btn btn-magenta block text-center w-full">
                        Descargar
                    </a>
                </article>

            @endforeach

        </div>


        <div>
            {{ $materials->links() }}
        </div>

    </x-container>

</x-app-layout>