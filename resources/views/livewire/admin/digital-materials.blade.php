<div>
    
    <div class="mb-4">
        <x-card>


            <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mb-6">

                <div class="relative">
                    <figure>
                        <img class="aspect-[16/9] w-full h-full object-cover object-center"
                            src="{{ $image ? $image->temporaryUrl() : asset('img/no-image.jpg')}}"
                            id="imgPreview">
                    </figure>
    
                    <div class="absolute inset-0 flex justify-center items-center"
                        wire:loading.flex="image" wire:target="image">
                        
                        <div role="status">
                            <svg aria-hidden="true" class="w-12 h-12 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                            </svg>
                            <span class="sr-only">Loading...</span>
                        </div>

                    </div>

                    <div class="absolute top-8 right-8">
                        <label class="flex items-center px-4 py-2 rounded-lg bg-white cursor-pointer">
                            <i class="fas fa-camera mr-2"></i> Agregar imagen
    
                            <input class="hidden" name="image" wire:model="image" type="file" accept="image/*">
                        </label>
                    </div>
    
                </div>
    
            </div>




            <div class="mb-4">
                <x-input label="Nombre" wire:model="name" placeholder="Ingrese un nombre" />
            </div>
    
            <div class="mb-4">
                <input type="file" wire:model="file" id="{{$file_id}}" />
            </div>
    
            <div class="flex justify-end">
    
                <x-button wire:click="save" pink>
                    Guardar
                </x-button>
    
            </div> 
        </x-card>
    </div>

    <div>
        <x-card>


            <ul class="divide-y -my-4">

                

                @forelse ($digital_materials as $material)
                    <li class="py-4 flex justify-between items-center">

                        <p>
                            {{$material->name}}
                        </p>

                        <div>
                            <x-button negative wire:click="destroy({{$material->id}})">
                                Eliminar
                            </x-button>

                            <x-button dark wire:click="download({{$material->id}})">
                                Descargar
                            </x-button>
                        </div>

                    </li>
                @empty
                    <li class="py-4">

                        <p>
                            No hay materiales digitales
                        </p>

                    </li>
                @endforelse

            </ul>


        </x-card>
    </div>

</div>
