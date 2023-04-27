<x-admin-layout :breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => route('admin.dashboard'),
    ],
    [
        'name' => 'Productos',
        'url' => route('admin.products.index'),
    ],
    [
        'name' => 'Crear',
    ]
]">

    <form action="{{route('admin.products.store')}}" method="POST" enctype="multipart/form-data">

        @csrf

        <x-input-error for="image" />

        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mb-6">

            <div class="relative">
                <figure>
                    <img class="aspect-[16/9] w-full h-full object-cover object-center"
                        src="https://s.udemycdn.com/course/750x422/placeholder.jpg"
                        id="imgPreview">
                </figure>

                <div class="absolute top-8 right-8">
                    <label class="flex items-center px-4 py-2 rounded-lg bg-white cursor-pointer">
                        <i class="fas fa-camera mr-2"></i> Actualizar imagen

                        <input class="hidden" name="image" type="file" accept="image/*" onchange="previewImage(event, '#imgPreview')">
                    </label>
                </div>

            </div>

        </div>

        <x-card>        

            <div class="mb-4">

                <x-input label="Código" 
                    name="code"
                    value="{{old('code')}}"
                    type="number"
                    placeholder="Por favor ingrese el código del producto" />

            </div>

            <div class="mb-4">

                <x-input label="Nombre" 
                    name="name"
                    value="{{old('name')}}"
                    placeholder="Por favor ingrese el nombre del producto" />

            </div>

            <div class="mb-4">

                <x-textarea label="Detalle" 
                    name="details"
                    placeholder="Por favor ingrese el detalle del producto">{{old('details')}}</x-textarea>

            </div>

            <div class="mb-4">
                <x-native-select 
                    label="Categoría" 
                    name="category_id">

                    @foreach ($categories as $category)
                        <option value="{{$category->id}}" @selected($category->id == old('category_id'))>
                            {{$category->name}}
                        </option>
                    @endforeach

                </x-native-select>
            </div>

            <div class="mb-4">
                <input type="hidden" name="free_sample" value="0">
                <x-toggle md label="Muestras gratis" name="free_sample" value="1" :checked="old('free_sample') == 1" />
            </div>

            <div class="flex justify-end">

                <button class="btn btn-magenta">
                    Guardar
                </button>

            </div>

        </x-card>

    </form>

    @push('js')
        <script>

            function previewImage(event, querySelector){
                const input = event.target;
                imgPreview = document.querySelector(querySelector);
                // Si no hay archivos salimos de la función
                if(!input.files.length) return
                file = input.files[0];
                objectURL = URL.createObjectURL(file);
                imgPreview.src = objectURL;
                
            }

        </script>
    @endpush

</x-admin-layout>