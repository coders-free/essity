<div>

    <form wire:submit.prevent="save()">

        <x-input label="Nombre" 
            placeholder="Escriba el nombre de la variante"
            wire:model="option.name"
            class="mb-4"
        />

        <div class="flex justify-end">
            <x-button pink type="submit">
                Actualizar
            </x-button>
        </div>

    </form>

</div>
