{{-- Nombre --}}
<div class="mb-4">
    <x-label>
        Nombre
    </x-label>

    <x-input type="text" name="name" value="{{old('name')}}" class="block mt-1 w-full" />
</div>

{{-- Apellido --}}
<div class="mb-4">
    <x-label>
        Apellido
    </x-label>

    <x-input type="text" name="last_name" value="{{old('last_name')}}" class="block mt-1 w-full" />
</div>

{{-- Nombre de farmacia --}}
<div class="mb-4">
    <x-label>
        Nombre de farmacia
    </x-label>

    <x-input type="text" name="pharmacy_name" value="{{old('pharmacy_name')}}" class="block mt-1 w-full" />
</div>

{{-- Dirección --}}
<div class="mb-4">
    <x-label>
        Dirección
    </x-label>

    <x-input type="text" name="address" value="{{old('address')}}" class="block mt-1 w-full" />
</div>

{{-- CP --}}
<div class="mb-4">
    <x-label>
        CP
    </x-label>

    <x-input type="number" name="cp" value="{{old('cp')}}" class="block mt-1 w-full" />
</div>

{{-- Provincia --}}
<div class="mb-4">
    <x-label>
        Provincia
    </x-label>

    <select name="province_id" value="{{old('province_id')}}" id="provinces" style="width: 100%">

        @if ($province_old)
            <option value="{{$province_old->id}}" selected>{{$province_old->name}}</option>                                
        @endif

    </select>
</div>

{{-- Comunidades --}}
<div class="mb-4">
    <x-label>
        Población
    </x-label>

    <select name="town_id" value="{{old('town_id')}}" id="towns" style="width: 100%">

        @if ($town_old)
            <option value="{{$town_old->id}}" selected>{{$town_old->name}}</option>                                
        @endif

    </select>
</div>

{{-- Telefono --}}
<div class="mb-4">
    <x-label>
        Teléfono
    </x-label>

    <x-input type="number" name="phone" value="{{old('phone')}}" class="block mt-1 w-full" />
</div>

{{-- Email --}}
<div class="mb-4">
    <x-label>
        Correo electrónico
    </x-label>

    <x-input type="email" name="email" value="{{old('email')}}" class="block mt-1 w-full" />
</div>

{{-- Password --}}
<div class="mb-4">
    <x-label>
        Contraseña
    </x-label>

    <x-input type="password" name="password" class="block mt-1 w-full" />

</div>

{{-- Confirm Password --}}
<div class="mb-4">
    <x-label>
        Confirmar contraseña
    </x-label>

    <x-input type="password" name="password_confirmation" class="block mt-1 w-full" />

</div>

{{-- NIF 1 --}}
<div class="mb-4">
    <x-label>
        NIF 1
    </x-label>

    <x-input type="text" name="nif_1" value="{{old('nif_1')}}" class="block mt-1 w-full" />
</div>

{{-- NIF 2 --}}
<div class="mb-4">
    <x-label>
        NIF 2
    </x-label>

    <x-input type="text" name="nif_2" value="{{old('nif_2')}}" class="block mt-1 w-full" />
</div>