<div>
    
    <form wire:submit.prevent="updateProfileInformation">

        <x-validation-errors class="mb-4" />

        <div class="mb-4">
            <x-label>
                Nombres
            </x-label>

            <x-input type="text" name="name" wire:model.defer="user.name" class="block mt-1 w-full" />
        </div>

        <div class="mb-4">
            <x-label>
                Apellidos
            </x-label>

            <x-input type="text" name="name" wire:model.defer="user.last_name" class="block mt-1 w-full" />
        </div>

        <div class="mb-4">
            <x-label>
                Nombre de la farmacia
            </x-label>

            <x-input type="text" name="name" wire:model.defer="profile.pharmacy_name" class="block mt-1 w-full" />
        </div>

        <div class="mb-4">
            <x-label>
                Dirección
            </x-label>

            <x-input type="text" name="name" wire:model.defer="profile.address" class="block mt-1 w-full" />
        </div>

        <div class="mb-4">
            <x-label>
                CP
            </x-label>

            <x-input type="text" name="name" wire:model.defer="profile.cp" class="block mt-1 w-full" />
        </div>

        <div class="mb-4">
            <x-label>
                Provincia
            </x-label>

            <x-select
                wire:model="profile.province_id"
                placeholder="Selecciona una provincia"
                :async-data="route('select2.provinces')"
                option-label="text"
                option-value="id"
            />
        </div>

        <div class="mb-4">
            <x-label>
                Población
            </x-label>

            <x-select
                wire:model.defer="profile.town_id"
                placeholder="Selecciona una población"
                :async-data="route('select2.towns', [
                    'province_id' => $profile->province_id
                ])"
                option-label="text"
                option-value="id"
            />
        </div>

        <div class="mb-4">
            <x-label>
                Teléfono
            </x-label>

            <x-input type="text" name="name" wire:model.defer="profile.phone" class="block mt-1 w-full" />
        </div>

        <div class="mb-4">
            <x-label>
                NIF 1
            </x-label>

            <x-input type="text" name="name" wire:model.defer="profile.nif_1" class="block mt-1 w-full" />
        </div>

        <div class="mb-6">
            <x-label>
                NIF 2
            </x-label>

            <x-input type="text" name="name" wire:model.defer="profile.nif_2" class="block mt-1 w-full" />
        </div>

        <div class="flex justify-end items-center">
            <x-action-message class="mr-3" on="saved">
                {{ __('Saved.') }}
            </x-action-message>


            <button class="btn btn-magenta" wire:loading.attr="disabled" wire:target="updateProfileInformation">
                GUARDAR CAMBIOS
            </button>

        </div>

    </form>

</div>
