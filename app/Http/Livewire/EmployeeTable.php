<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class EmployeeTable extends DataTableComponent
{

    public function configure(): void
    {
        $this->setPrimaryKey('id');

        $this->setDefaultSort('id', 'desc');
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

            Column::make('Rol')
                ->label(fn($row) => $row->roles->first()->name),

            LinkColumn::make('Actions')
                ->title(fn() => 'Editar')
                ->location(fn($row) => route('admin.employees.edit', $row->id))
                ->attributes(fn($row) => [
                    'class' => 'btn btn-darkblue',
                ]),
        ];
    }

    public function builder(): Builder
    {
        //Recuperar los usuarios que tienen el rol administrador
        return User::role(['admin', 'super-admin']);
    }
}
