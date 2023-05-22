<x-app-layout>

    <x-container class="px-4 py-12">


        @livewire('lines.filter', [
            'line' => $line, 
            'lines' => $lines,
            'dcto_total' => $dcto_total,
        ], key($line->id))

    </x-container>

</x-app-layout>