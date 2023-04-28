<div>
    <form action="{{route('admin.products.store')}}" method="POST">

        @csrf

        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mb-6">

            <div class="relative">

                <div class="absolute inset-0 bg-black bg-opacity-40 justify-center items-center" wire:loading.flex wire:target="image">
                    <x-spinner size="12" />
                </div>

                <figure>
                    <img class="aspect-[16/9] w-full h-full object-cover object-center"
                        src="{{ $image ? $image->temporaryUrl() : 'https://s.udemycdn.com/course/750x422/placeholder.jpg' }}"
                        id="imgPreview">
                </figure>

                <div class="absolute top-8 right-8">
                    <label class="flex items-center px-4 py-2 rounded-lg bg-white cursor-pointer">
                        <i class="fas fa-camera mr-2"></i> Actualizar imagen

                        <input class="hidden" 
                            wire:model="image"
                            name="image"
                            type="file" 
                            accept="image/*">
                    </label>
                </div>

            </div>

        </div>

        <x-card>        

            <div class="mb-4">

                <x-input label="Código" 
                    wire:model="product.code"
                    name="code"
                    value="{{old('code')}}"
                    type="number"
                    placeholder="Por favor ingrese el código del producto" />

            </div>

            <div class="mb-4">

                <x-input label="Nombre" 
                    wire:model="product.name"
                    name="name"
                    value="{{old('name')}}"
                    placeholder="Por favor ingrese el nombre del producto" />

            </div>

            <div class="mb-4">

                <x-textarea label="Detalle" 
                    wire:model="product.details"
                    name="details"
                    placeholder="Por favor ingrese el detalle del producto">{{old('details')}}</x-textarea>

            </div>

            <div class="mb-4">
                <x-native-select 
                    label="Categoría" 
                    :options="$categories"
                    option-label="name"
                    option-value="id"
                    wire:model="product.category_id"
                    name="category_id"
                    selected="2"
                    />
            </div>


            @if ($this->line)
                
                @foreach ($this->line->variants as $variant)
                    
                    <div class="mb-4">
                        {{-- {{$variant->name}} --}}

                        <x-select :label="ucfirst($variant->name)"
                            value="[1, 2]"
                            placeholder="Seleccione un atributo"
                            multiselect
                            :async-data="[
                                'api' => route('api.features.index'),
                                'params' => [
                                    'variant_id' => $variant->id,
                                ]
                            ]"
                            option-label="name"
                            option-value="id" 
                            name="{{strtolower($variant->name)}}"
                            
                            />

                    </div>

                @endforeach


            @endif

            <div class="mb-4">
                <x-toggle md label="Muestras gratis" wire:model="product.free_sample" value="1" />
            </div>

            <div class="flex justify-end">

                <button class="btn btn-magenta">
                    Guardar
                </button>

            </div>

        </x-card>

    </form>
</div>
