<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Spatie\Permission\Models\Role;

class RoleTable extends DataTableComponent
{
    protected $model = Role::class;

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

            Column::make("Name", "name")
                ->sortable()
                ->searchable(),

            /* Column::make("Role")
                ->label(fn($row) => $row->name), */

            Column::make("Fecha creación", "created_at")
                ->sortable()
                ->format(fn($value) => $value->format('d/m/Y')),

            LinkColumn::make('Action')
                ->title(fn($row) => 'Editar')
                ->location(fn($row) => route('admin.roles.edit', $row))
                ->attributes(fn($row) => [
                    'class' => 'btn btn-darkblue',
                ]),
        ];
    }
}
