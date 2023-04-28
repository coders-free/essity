<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class OrderTable extends DataTableComponent
{
    protected $model = Order::class;

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

            Column::make("Cooperativa", "cooperative.name")
                ->sortable()
                ->searchable(),

            Column::make("NIF", "nif")
                ->sortable()
                ->searchable(),

            BooleanColumn::make("Status", "status")
                ->sortable(),

            Column::make("Fecha creación", "created_at")
                ->sortable()
                ->format(fn($value) => $value->format('d/m/Y H:i:s')),

            LinkColumn::make("Action")
                ->title(fn() => "Gestionar")
                ->location(fn($row) => route('admin.orders.show', $row->id))
                ->attributes(fn() => ['class' => 'btn btn-darkblue']),
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
                        $builder->where('status', true);
                    } elseif ($value === '0') {
                        $builder->where('status', false);
                    }
                }),
        ];
    }
}
