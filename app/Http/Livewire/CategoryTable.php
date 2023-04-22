<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Category;
use App\Models\Line;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class CategoryTable extends DataTableComponent
{
    /* protected $model = Category::class; */

    public function configure(): void
    {
        $this->setPrimaryKey('id');

        $this->setBulkActions([
            'deleteSelected' => 'Eliminar',
        ]);
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
                ->attributes(fn() => ['class' => 'btn btn-darkblue']),
        ];
    }

    public function deleteSelected(){

        $error = false;

        $categories = Category::whereIn('id', $this->getSelected())
                    ->with('products')
                    ->get();

        foreach ($categories as $category) {
            if($category->products->count() > 0){
                $error = true;
                continue;
            }

            $category->delete();
        }

        if($error){
            $this->emit('sweetalert2Error', 'Uno o más registros no se pudieron eliminar.');
        }else{
            $this->emit('sweetalert2Success', 'Registros eliminados correctamente.');
        }


        $this->clearSelected();

    }

    public function builder(): Builder
    {
        return Category::query();
    }

}
