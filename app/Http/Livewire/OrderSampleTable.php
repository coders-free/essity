<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\OrderSample;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class OrderSampleTable extends DataTableComponent
{
    protected $model = OrderSample::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Usuario", "user.name")
                ->sortable()
                ->searchable(),
            Column::make("NIF", "nif")
                ->sortable()
                ->searchable(),
            Column::make("Fecha creación", "created_at")
                ->sortable()
                ->format(fn($value) => $value->format('d/m/Y H:i:s')),

            LinkColumn::make("Action")
                ->title(fn() => "Detalle")
                ->location(fn($row) => route('admin.samples.show', $row->id))
                ->attributes(fn() => ['class' => 'btn btn-darkblue']),
        ];
    }
}
