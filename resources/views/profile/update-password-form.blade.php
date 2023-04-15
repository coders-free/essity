<form wire:submit.prevent="updatePassword">

    <div class="mb-4">
        <x-input label="{{ __('Current Password') }}" id="current_password" type="password" class="mt-1 block w-full" wire:model.defer="state.current_password" autocomplete="current-password" />
        <x-input-error for="current_password" class="mt-2" />
    </div>

    <div class="mb-4">
        <x-input label="{{ __('New Password') }}" id="password" type="password" class="mt-1 block w-full" wire:model.defer="state.password" autocomplete="new-password" />
        <x-input-error for="password" class="mt-2" />
    </div>

    <div class="mb-4">
        <x-input label="{{ __('Confirm Password') }}" id="password_confirmation" type="password" class="mt-1 block w-full" wire:model.defer="state.password_confirmation" autocomplete="new-password" />
        <x-input-error for="password_confirmation" class="mt-2" />
    </div>

    <div class="flex justify-end items-center">
        <x-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>
    
        <button class="btn btn-magenta">
            {{ __('Save') }}
        </button>
    </div>

</form>