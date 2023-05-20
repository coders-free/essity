<x-app-layout>

    <x-container class="px-4 py-12">


        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            @foreach ($lines as $line)
            
                <a href="{{route('lines.show', $line)}}" class="bg-white rounded-lg shadow py-12 px-6">
                    <div class="flex justify-center">
                        <img class="h-[300px]" src="{{$line->image}}" alt="">
                    </div>
                </a>

            @endforeach
        </div>

    </x-container>

</x-app-layout>