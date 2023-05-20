<x-app-layout>

    <x-container class="py-12">


        @livewire('lines.filter', [
            'line' => $line, 
            'lines' => $lines
        ], key($line->id))

    </x-container>

</x-app-layout>