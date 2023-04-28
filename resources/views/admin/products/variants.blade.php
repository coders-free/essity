<x-admin-layout>

    @push('css')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endpush


    <x-card title="Variantes">

        <form action="">
            @foreach ($line->variants as $variant)

                <div class="mb-4">
                    <x-label>
                        {{ Str::of($variant->name)->ucfirst() }}
                    </x-label>

                    <select class="{{Str::slug($variant->name)}}" 
                        name="features[]" 
                        multiple="multiple" 
                        style="width: 100%">
                    </select>
                </div>

            @endforeach

            <div class="flex justify-end">
                <x-button pink>
                    Guardar
                </x-button>
            </div>

        </form>

    </x-card>

    @push('js')
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        @foreach ($line->variants as $variant)

            <script>
                $('.' + '{{Str::slug($variant->name)}}').select2({
                    placeholder: "Selecciona una opción",
                    ajax: {
                        url: "{{ route('api.features.index') }}",
                        dataType: 'json',
                        
                        delay: 250,

                        data: function(params) {
                            return {
                                term: params.term,
                                variant_id: {{ $variant->id }}
                            }
                        },

                        processResults: function (data, page) {
                            return {
                                results: data
                            };
                        },
                    }
                });
            </script>

        @endforeach
    @endpush

</x-admin-layout>