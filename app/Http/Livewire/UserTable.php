<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

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

            BooleanColumn::make('Activo', 'active'),

            Column::make('Rol')
                ->label(fn($row) => $row->roles->first()->name), 

            Column::make('Actions')
                ->label(
                    fn($row) => view('admin.users.table.actions', ['user' => $row])
                )
        ];
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Activo')
                ->options([
                    '' => 'Todos',
                    '1' => 'Si',
                    '0' => 'No',
                ])->filter(function(Builder $builder, string $value) {
                    if ($value === '1') {
                        $builder->where('active', true);
                    } elseif ($value === '0') {
                        $builder->where('active', false);
                    }
                }),
        ];
    }

    public function builder(): Builder
    {
        //Recuperar los usuarios que tienen el rol administrador
        return User::role(['farmacia', 'ortopedia']);
    }
}
