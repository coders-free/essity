<div>
    <table class="w-full mb-12">
        <thead class="border-b border-gray-200">
            <tr>
                <th class="text-left p-2">
                    Cooperativa habitual
                </th>

                <th class="text-left p-2">
                    Numero de cooperante
                </th>

                <th class="p-2">
                    Borrar
                </th>
            </tr>
        </thead>

        <tbody>

            @foreach (auth()->user()->cooperatives as $cooperative)
                <tr class="border-b border-gray-200">
                    <td class="p-2">
                        {{ $cooperative->name }}
                    </td>

                    <td class="p-2">
                        {{ $cooperative->pivot->cooperative_number }}
                    </td>

                    <td class="flex justify-center p-2">
                        <button wire:click="deleteCooperative({{ $cooperative->id }})" class="disabled:opacity-25" wire:loading.attr="disabled" wire:target="deleteCooperative({{ $cooperative->id }})">
                            <i class="fa-solid fa-circle-xmark text-magenta-500 text-xl"></i>
                        </button>
                    </td>
                </tr>
                
            @endforeach

            <tr class="border-b border-gray-200">
                <td class="py-4">

                </td>
            </tr>
                
            <tr class="border-b border-gray-200">
                <td class="py-4 px-2">
                    <x-select
                        wire:model.defer="cooperative_id"
                        placeholder="Agregar una cooperativa"
                        :async-data="route('select2.cooperatives')"
                        option-label="text"
                        option-value="id"
                    />
                </td>

                <td class="py-4 px-2">
                    <x-input type="number" wire:model="cooperative_number" placeholder="Numero de cooperante" />
                </td>

                <td class="flex justify-center items-center pt-5 px-2">
                    {{-- <button wire:click="save">
                        <i class="fa-solid fa-circle-check text-darkblue text-xl"></i>
                    </button> --}}
                </td>
            </tr>

        </tbody>
    </table>


    <div class="flex justify-end">
        <button class="btn btn-magenta disabled:opacity-25" wire:loading.attr="disabled" wire:target="save" wire:click="save">
            GUARDAR CAMBIOS
        </button>
    </div>

</div>
