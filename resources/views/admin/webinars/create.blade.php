<x-admin-layout :breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => route('admin.dashboard'),
    ],
    [
        'name' => 'Videos',
        'url' => route('admin.webinars.index'),
    ],
    [
        'name' => 'Crear',
    ]
]">

    <x-card>

        <form action="{{route('admin.webinars.store')}}" method="POST">

            @csrf

            <div class="mb-4">
                <x-input label="Título" name="title" value="{{old('title')}}" />
            </div>

            <div class="mb-4">
                <x-input label="Subtítulo" name="subtitle" value="{{old('subtitle')}}" />
            </div>

            <div class="mb-4">
                <x-textarea label="Descripción" name="description">{{old('description')}}</x-textarea>
            </div>

            <div class="mb-4">
                <x-input label="URL del video" name="video_url" value="{{old('video_url')}}" />
            </div>

            <div class="flex justify-end">
                <x-button pink type="submit">
                    Guardar
                </x-button>
            </div>
        </form>
    </x-card>

</x-admin-layout>