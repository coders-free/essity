<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class UserTable extends DataTableComponent
{

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Nombres", "name")
                ->sortable(),
            Column::make("Apellidos", "last_name")
                ->sortable(),
            Column::make("Email", "email")
                ->sortable(),

            LinkColumn::make('Actions')
                ->title(fn() => 'Editar')
                ->location(fn($row) => route('admin.users.edit', $row->id))
                ->attributes(fn($row) => [
                    'class' => 'btn btn-darkblue',
                ]),
        ];
    }

    public function builder(): Builder
    {
        //Recuperar los usuarios que tienen el rol administrador
        return User::role('admin');
    }
}
