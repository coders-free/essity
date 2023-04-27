<div>
    

    <form>

        <x-card title="Editar linea">

            <div class="mb-4">
                <x-input label="Nombre" name="name" wire:model="line.name" />
            </div>

            <div class="mb-4">
                <x-select
                    label="Selecciona una variante"
                    placeholder="Select one status"
                    multiselect
                    :options="$variants"
                    option-label="name"
                    option-value="id"
                    wire:model="selectedVariants"
                />
            </div>

        </x-card>

    </form>


    {{-- @dump($selectedVariants) --}}
</div>
