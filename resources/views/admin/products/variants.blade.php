<x-admin-layout>


    <form action="{{route('admin.products.variants.update', [$product, $variant])}}" 
        method="POST" 
        enctype="multipart/form-data">

        @csrf

        @method('PUT')

        <x-input-error for="image" />
        
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mb-6">

            <div class="relative">
                <figure>
                    <img class="aspect-[16/9] w-full h-full object-cover object-center"
                        src="{{$variant->image}}"
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
                    placeholder="Ingrese un código para la variante"
                    name="code"
                    value="{{old('code', $variant->code)}}" />
            </div>


            <div class="flex justify-end">
                <x-button pink type="submit">
                    Guardar
                </x-button>
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