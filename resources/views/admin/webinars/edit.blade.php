<x-admin-layout>

    
    <x-card>

        <iframe class="w-full aspect-[16/9] mb-4"  src="{{$webinar->video}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>

        <form action="{{route('admin.webinars.update', $webinar)}}" method="POST">

            @csrf
            @method('PUT')

            <div class="mb-4">
                <x-input label="Título" name="title" value="{{old('title', $webinar->title)}}" />
            </div>

            <div class="mb-4">
                <x-input label="Subtítulo" name="subtitle" value="{{old('subtitle', $webinar->subtitle)}}" />
            </div>

            <div class="mb-4">
                <x-textarea label="Descripción" name="description">{{old('description', $webinar->description)}}</x-textarea>
            </div>

            <div class="mb-4">
                <x-input label="URL del video" name="video_url" value="{{old('video_url', $webinar->video_url)}}" />
            </div>

            <div class="flex justify-end space-x-2">

                <x-button negative 
                    onclick="document.getElementById('miFormulario').submit();">
                    Eliminar
                </x-button>

                <x-button pink type="submit">
                    Guardar
                </x-button>
            </div>
        </form>
    </x-card>

    <form action="{{route('admin.webinars.destroy', $webinar)}}" 
        method="POST" 
        id="miFormulario">
        @csrf

        @method('DELETE')
    </form>

</x-admin-layout>