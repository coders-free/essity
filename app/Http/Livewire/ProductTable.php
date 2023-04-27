<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Product;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class ProductTable extends DataTableComponent
{
    protected $model = Product::class;

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

            Column::make("Code", "code")
                ->searchable()
                ->sortable(),

            Column::make("Nombre", "name")
                ->searchable()
                ->sortable(),
            
            Column::make("Categoría", "category.name")
                ->searchable()
                ->sortable(),

            BooleanColumn::make('Muestra gratis', 'free_sample'),

            LinkColumn::make("Action")
                ->title(fn() => "Editar")
                ->location(fn($row) => route('admin.products.edit', $row->id))
                ->attributes(fn() => ['class' => 'btn btn-darkblue']),
            
        ];
    }
}
