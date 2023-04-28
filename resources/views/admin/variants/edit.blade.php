<x-admin-layout>

    

    <div class="mb-8">
        <x-card title="Variante">
            @livewire('admin.variants.edit', ['variant' => $variant])
        </x-card>
    </div>

    <div>
        <x-card title="Atributos">
            @livewire('admin.variants.features', ['variant' => $variant])
        </x-card>
    </div>


</x-admin-layout>