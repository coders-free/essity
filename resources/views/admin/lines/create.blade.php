<x-admin-layout :breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => route('admin.dashboard'),
    ],
    [
        'name' => 'Lineas',
        'url' => route('admin.lines.index'),
    ],
    [
        'name' => 'Crear',
    ]
]">

    <form action="{{route('admin.lines.store')}}" method="POST" enctype="multipart/form-data">

        @csrf

        <x-card title="Crear linea">

            <div class="mb-4">
                
                <x-input label="Nombre" name="name" :value="old('name')" placeholder="Escriba el nombre de la linea" />

            </div>

            <div class="mb-4">
                <x-select
                    label="Selecione variantes"
                    placeholder="Seleccione variantes"
                    multiselect
                    name="variants"
                    value="{{old('variants')}}"
                    :options="$variants"
                    option-label="name"
                    option-value="id" 
                />
            </div>

             {{-- Imagen --}}
            <div>

                <x-label class="mb-1">
                    Imagen
                </x-label>

                <div class="grid lg:grid-cols-2 gap-4 lg:gap-8">

                    <figure>
                        <img id="imgPreview" class="object-cover object-center aspect-[16/9]"
                            src="https://s.udemycdn.com/course/750x422/placeholder.jpg">
                    </figure>

                    <div>
                        <p class="mb-2">Carga la imagen de tu curso aquí. Para ser aceptada, debe cumplir nuestros
                            <a href="" class="text-indigo-500">estándares de calidad para las imágenes de los
                                cursos</a>. Directrices importantes: 750 x 422 píxeles; formato .jpg, .jpeg, .gif, o
                            .png.; y sin texto en la imagen.
                        </p>

                        <x-input name="image" type="file" accept="image/*" onchange="previewImage(event, '#imgPreview')" class="rounded" />
                    </div>

                </div>

            </div>

            <x-slot name="footer">

                <div class="flex justify-end">

                    <button class="btn btn-magenta">
                        Crear
                    </button>

                </div>

            </x-slot>

        </x-card> 
    </form>

    @push('js')
        <script>
            function previewImage(event, querySelector) {
                //Recuperamos el input que desencadeno la acción
                const input = event.target;
                //Recuperamos la etiqueta img donde cargaremos la imagen
                $imgPreview = document.querySelector(querySelector);
                // Verificamos si existe una imagen seleccionada
                if (!input.files.length) return
                //Recuperamos el archivo subido
                file = input.files[0];
                //Creamos la url
                objectURL = URL.createObjectURL(file);
                //Modificamos el atributo src de la etiqueta img
                $imgPreview.src = objectURL;
            }
        </script>
    @endpush

</x-admin-layout>