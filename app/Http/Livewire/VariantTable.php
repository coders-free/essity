<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Variant;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class VariantTable extends DataTableComponent
{
    protected $model = Variant::class;

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
                ->sortable(),

            Column::make("Created at", "created_at")
                ->sortable()
                ->format(fn($value) => $value->format('d/m/Y')),

            LinkColumn::make("Action")
                ->title(fn() => "Editar")
                ->location(fn($row) => route('admin.variants.edit', $row->id))
                ->attributes(fn() => ['class' => 'btn btn-darkblue']),
        ];
    }
}
