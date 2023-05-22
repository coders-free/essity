<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Cluster;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class ClusterTable extends DataTableComponent
{
    protected $model = Cluster::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),

            Column::make("Nombre", "name")
                ->sortable(),

            Column::make("Fecha creación", "created_at")
                ->sortable()
                ->format(fn($value) => $value->format('d/m/Y H:i:s')),

            LinkColumn::make('Action')
                ->title(fn() => 'Editar')
                ->location(fn($row) => route('admin.clusters.edit', $row->id))
                ->attributes(fn() => ['class' => 'btn btn-darkblue']),
        ];
    }
}
