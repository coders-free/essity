<x-admin-layout :breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => route('admin.dashboard'),
    ],
    [
        'name' => 'Usuarios',
        'url' => route('admin.users.index'),
    ],

    [
        'name' => 'Editar usuario',
    ]
]">

    <form action="{{route('admin.users.update', $user)}}" method="POST">

        @csrf
        @method('PUT')

        <x-card :title="'Usuario: ' . $user->name . ' ' . $user->last_name">

            {{-- sap_number --}}
            <div class="mb-4">
                <x-inputs.number 
                    label="Número de SAP"
                    value="{{ old('sap_number', $profile->sap_number) }}"
                    name="sap_number"  />
            </div>

            {{-- crm_number --}}
            <div class="mb-4">
                <x-inputs.number 
                    label="Número de CRM"
                    value="{{ old('crm_number', $profile->crm_number) }}"
                    name="crm_number" />
            </div>

            {{-- Cluster --}}
            <div class="mb-4">
                <x-native-select label="Cluster" name="cluster_id">

                    <option @selected(!old('cluster_id')) disabled>
                        Seleccione un cluster
                    </option>

                    @foreach ($clusters as $cluster)

                        <option value="{{ $cluster->id }}" @selected(old('cluster_id', $profile->cluster_id) == $cluster->id)>
                            {{ $cluster->name }}
                        </option>
                        
                    @endforeach
                </x-native-select>
            </div>

            {{-- Delegado --}}
            <div class="mb-4">
                <x-native-select label="Delegado" name="delegate_id">

                    <option @selected(!old('delegate_id')) disabled>
                        Seleccione un delegado
                    </option>

                    @foreach ($delegates as $delegate)

                        <option value="{{ $delegate->id }}" @selected(old('delegate_id', $profile->delegate_id) == $delegate->id)>
                            {{ $delegate->name }}
                        </option>
                        
                    @endforeach
                </x-native-select>
            </div>

            {{-- Area grográfica --}}
            <div class="mb-4">
                <x-native-select label="Area geográfica" name="geographic_area_id">

                    <option value="" @selected(!old('geographic_area_id')) disabled>
                        Seleccione un area geográfica
                    </option>

                    @foreach ($geographicAreas as $geographicArea)

                        <option value="{{ $geographicArea->id }}" @selected(old('geographic_area_id', $profile->delegate_id) == $delegate->id)>
                            {{ $geographicArea->name }}
                        </option>
                        
                    @endforeach
                </x-native-select>
            </div>


            <div class="mb-4">
                {{-- Numero de pedidos máximos --}}
                <x-inputs.number 
                    label="Número de pedidos máximos al mes"
                    value="{{ old('max_orders_per_month', $profile->max_orders_per_month) }}"
                    name="max_orders_per_month" />
            </div>

            <div class="mb-4">
                <x-input 
                    label="Sales Org"
                    name="sales_org" 
                    value="{{old('sales_org', $profile->sales_org)}}" /> 
            </div>


            <div class="mb-4">
                <input type="hidden" name="unlimited" value="0">
                <x-toggle md label="Sin límite" name="unlimited" value="1" :checked="$profile->unlimited" />
            </div>

            <x-slot name="footer">
                <div class="flex justify-end">

                    @if ($user->active)
                        <button class="btn btn-magenta">
                            Actualizar
                        </button>
                    @else
                        <button class="btn btn-darkblue">
                            Dar de alta
                        </button>
                    @endif

                </div>
            </x-slot>

        </x-card>
    </form>
</x-admin-layout>