<div class="flex space-x-2">
    <a href="{{route('admin.users.edit', $user)}}" class="btn btn-darkblue">
        Editar
    </a>

    <form action="{{route('admin.users.ban', $user)}}" method="POST">
        @csrf

        @if($user->isBanned())

            <button class="btn btn-green">
                Desbloquear
            </button>
            
        @else

            <button class="btn btn-red">
                Bloquear
            </button>
        @endif
    </form>
</div>