<x-app-layout>

    <x-container class="px-4 py-12">
        <div class="card" x-data="{
            step: 1,
        }">
            <div class="card-body">

                <div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
                    <ul class="flex flex-wrap -mb-px">
                        <li class="mr-2">
                            <button x-on:click="step = 1" x-bind:class="step == 1 ? 'text-magenta-500 border-magenta-500' : 'border-transparent hover:text-gray-600 hover:border-gray-300'" 
                                class="inline-block p-4 border-b-2 rounded-t-lg active" aria-current="page">
                                Detalles de usuario
                            </button>
                        </li>
                        <li class="mr-2">
                            <button x-on:click="step = 2" x-bind:class="step == 2 ? 'text-magenta-500 border-magenta-500' : 'border-transparent hover:text-gray-600 hover:border-gray-300'" 
                                class="inline-block p-4 border-b-2 rounded-t-lg active" aria-current="page">
                                Cambiar contraseña
                            </button>
                        </li>
                        <li class="mr-2">
                            <button x-on:click="step = 3" x-bind:class="step == 3 ? 'text-magenta-500 border-magenta-500' : 'border-transparent hover:text-gray-600 hover:border-gray-300'" 
                                class="inline-block p-4 border-b-2 rounded-t-lg active" aria-current="page">
                                Cooperativas habituales
                            </button>
                        </li>
                        <li class="mr-2">
                            <button x-on:click="step = 4" x-bind:class="step == 4 ? 'text-magenta-500 border-magenta-500' : 'border-transparent hover:text-gray-600 hover:border-gray-300'" 
                                class="inline-block p-4 border-b-2 rounded-t-lg active" aria-current="page">
                                Preferencia de correo electronico
                            </button>
                        </li>
                    </ul>
                </div>
            
                <div class="pt-8">

                    {{-- Step 1 --}}
                    <div x-show="step == 1">
                        @livewire('profile.update-profile-information')
                    </div>

                    {{-- Step 2 --}}
                    <div x-show="step == 2" style="display: none;">
                        @livewire('profile.update-password-form')
                    </div>

                    {{-- Step 3 --}}
                    <div x-show="step == 3" style="display: none;">
                        @livewire('profile.usual-cooperatives')
                    </div>

                    {{-- Step 4 --}}
                    <div x-show="step == 4" style="display: none;">
                        Step 4
                    </div>

                </div>
            </div>
        </div>
    </x-container>

</x-app-layout>
