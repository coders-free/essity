<x-admin-layout>

    <div class="mb-8">
        <x-card title="Variante">
            @livewire('admin.options.edit', ['option' => $option])
        </x-card>
    </div>

    <div>
        <x-card title="Atributos">
            @livewire('admin.options.features', ['option' => $option])
        </x-card>
    </div>

</x-admin-layout>