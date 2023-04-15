<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Category;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class CategoryTable extends DataTableComponent
{
    protected $model = Category::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Name", "name")
                ->sortable()
                ->searchable(),

            Column::make("Linea", "line.name")
                ->sortable()
                ->searchable()
                ->format(fn($value) => ucfirst($value)),

            Column::make("Maximum orders", "maximum_orders")
                ->sortable(),

            Column::make("Fecha creación", "created_at")
                ->sortable()
                ->format(fn($value) => $value->format('d-m-Y')),

            LinkColumn::make('Action')
                ->title(fn() => 'Editar')
                ->location(fn($row) => route('admin.categories.edit', $row->id))
                ->attributes(fn() => ['class' => 'btn btn-blue']),
        ];
    }

    public function line()
    {
        return $this->belongsTo(Line::class);
    }
}
