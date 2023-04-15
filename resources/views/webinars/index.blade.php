<x-app-layout>

    <x-container class="px-4 py-12">

        <div class="card card-body">
            <h1 class="text-4xl text-darkblue-500 mb-6">Webinar videos</h1>

            <ul class="space-y-6">
                @foreach ($webinars as $webinar)
                    
                    <li class="grid grid-cols-2 gap-6">
                       
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/{{iframe_url($webinar->video_url)}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>

                        <div>
                            <h2 class="text-xl font-semibold mb-2">
                                {{ $webinar->title }}
                            </h2>

                            <h3 class="texl-lg mb-4">
                                {{ $webinar->subtitle }}
                            </h3>

                            <p>
                                {{ $webinar->description }}
                            </p>
                        </div>

                    </li>

                @endforeach
            </ul>

            <div class="mt-8">
                {{ $webinars->links() }}
            </div>
        </div>

    </x-container>

</x-app-layout>